<?php

namespace App\Http\Controllers\Api\Folder;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\PassbookResource;
use App\Models\{Folder, File, Passbook};
use App\Http\Requests\Api\Folder\{CreateFolderRequest, UpdateFolderRequest, SetFolderColorRequest};
use App\Http\Resources\FolderResource;
use Illuminate\Http\JsonResponse;

class FolderController extends Controller
{   
    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {

            $base_query = Folder::withCount(['subFolders'])
            ->where(['user_id' => $request->user()->id])
            ->when($request->filled('search'), function($query) {
                $query->where(function($query) {
                    $query->where('name', "LIKE", "%" . request('search') . "%")
                    ->orWhere(function($query) {
                        $query->whereRelation('subFolders', 'name', "LIKE", "%" . request('search') . "%");
                    });
                });
            }, function($query) {
                $query->where(['sub_folder' => NULL]);
            })->latest();

            $pagination = config('app.pagination');
            
            return $this->success('', [
                'total_folders' => $base_query->count(),
                'folders' => FolderResource::collection($base_query->skip($request->input('skip', 0))->take(min($request->input('take', $pagination), $pagination))->get())
            ]);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param CreateFolderRequest $request
     * @return JsonResponse
     */
    public function store(CreateFolderRequest $request)
    {
        try {

            $folder = DB::transaction(function () use($request) {

                $folder = Folder::Create($request->validated());

                throw_if(!$folder, new Exception(__('messages.user.folders.creation_failed'), 500));

                return $folder->refresh();
            });

            return $this->success(__('messages.user.folders.creation_success'), [
                'folder' => new FolderResource($folder)
            ]);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     * 
     * @param Folder $folder
     * @return JsonResponse
     */
    public function show(Folder $folder)
    {
        try {

            throw_if($folder->user_id != request()->user()->id, new Exception('', 403));

            return $this->success('', [
                'folder' => new FolderResource($folder->loadCount(['subFolders'])->load([
                    'files' => function($filesQuery) { 
                        $filesQuery->latest(); 
                    },
                    'subFolders' => function($subFoldersQuery) { 
                        $subFoldersQuery->withCount('subFolders')->latest(); 
                    }
                ]))
            ]);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param UpdateFolderRequest $request
     * @return JsonResponse
     */
    public function update(UpdateFolderRequest $request, Folder $folder): JsonResponse
    {   
        try {

            throw_if($folder->user_id != request()->user()->id, new Exception('', 403));

            DB::transaction(function () use($folder, $request) {

                throw_if(!$folder->update(($request->validated())), new Exception(__('messages.user.folders.updation_failed'), 500));
            });

            return $this->success(__('messages.user.folders.updation_success'), [
                'folder' => new FolderResource($folder->loadCount(['subFolders'])->load([
                    'files' => function($filesQuery) { 
                        $filesQuery->latest(); 
                    },
                    'subFolders' => function($subFoldersQuery) { 
                        $subFoldersQuery->withCount('subFolders')->latest(); 
                    }
                ]))
            ]);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param Folder $folder
     * @return JsonResponse
     */
    public function destroy(Folder $folder): JsonResponse
    {
        try {

            throw_if($folder->user_id != request()->user()->id, new Exception('', 403));

            DB::transaction(function () use($folder) {

                $used_storage = File::where(['user_id' => $folder->user_id, 'folder_id' => $folder->id])->sum('size');
                
                if($used_storage) {

                    $passbook = Passbook::lockForUpdate()->firstOrCreate(['user_id' => $folder->user_id]);

                    $result = $passbook->update([
                        'used' => $passbook->used - $used_storage,
                        'remaining' => $passbook->remaining + $used_storage
                    ]);
    
                    throw_if(!$result, new Exception(__('messages.user.folders.deletion_failed'), 500));
                }

                throw_if(!$folder->delete(), new Exception(__('messages.user.folders.deletion_failed'), 500));
            });

            return $this->success(__('messages.user.folders.deletion_success'), []);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Set folder icon color.
     * 
     * @param SetFolderColorRequest $request
     * @return JsonResponse
     */
    public function set_folder_color(SetFolderColorRequest $request): JsonResponse {

        try {

            $passbook = $request->user()->passbook;

            $validated = $request->validated();

            DB::transaction(function () use($passbook, $validated) {

                throw_if(!$passbook->update($validated), 
                    new Exception(__('messages.user.folders.set_folder_color_failed'), 500)
                );
            });

            return $this->success(__('messages.user.folders.set_folder_color_success'), [
                'passbook' => new PassbookResource($passbook)
            ]);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    } 
}
