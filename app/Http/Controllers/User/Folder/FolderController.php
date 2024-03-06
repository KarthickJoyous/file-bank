<?php

namespace App\Http\Controllers\User\Folder;

use Exception;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Folder\CreateFolderRequest;
use App\Http\Requests\User\Folder\UpdateFolderRequest;

class FolderController extends Controller
{   
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

            $folders = Folder::withCount(['subFolders'])
            ->where(['user_id' => auth('web')->id()])
            ->when($request->filled('search'), function($query) {
                $query->where(function($query) {
                    $query->where('name', "LIKE", "%" . request('search') . "%")
                    ->orWhere(function($query) {
                        $query->whereRelation('subFolders', 'name', "LIKE", "%" . request('search') . "%");
                    });
                });
            }, function($query) {
                $query->where(['sub_folder' => NULL]);
            })
            ->latest()
            ->paginate(20);

            return view('users.folders.index')->with(compact(['folders']));

        } catch(Exception $e) {

            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateFolderRequest $request
     */
    public function store(CreateFolderRequest $request)
    {
        try {

            $folder = DB::transaction(function () use($request) {

                $folder = Folder::Create($request->validated());

                throw_if(!$folder, new Exception(__('messages.user.folders.creation_failed')));

                return $folder;
            });

            return redirect()->route('user.folders.show', $folder)->with('success', (__('messages.user.folders.creation_success')));

        } catch(Exception $e) {

            return back()->withInput()->with('error', $e->getMessage())->with('create_folder_error', true);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Folder $folder)
    {   
        abort_if($folder->user_id != auth('web')->id(), 404);

        $folder->load([
            'files' => function($filesQuery) { 
                $filesQuery->latest(); 
            },
            'subFolders' => function($subFoldersQuery) { 
                $subFoldersQuery->withCount('subFolders')->latest(); 
            }
        ]);

        return view('users.folders.show')->with(compact(['folder']));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param UpdateFolderRequest $request
     */
    public function update(UpdateFolderRequest $request, Folder $folder)
    {   
        abort_if($folder->user_id != auth('web')->id(), 404);

        try {

            DB::transaction(function () use($folder, $request) {

                throw_if(!$folder->update(($request->validated())), new Exception(__('messages.user.folders.updation_failed')));
            });

            return redirect()->route('user.folders.show', $folder)->with('success', (__('messages.user.folders.updation_success')));

        } catch(Exception $e) {

            return back()->with('error', $e->getMessage())->with('update_folder_error', true);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Folder $folder)
    {   
        abort_if($folder->user_id != auth('web')->id(), 404);
        
        try {

            DB::transaction(function () use($folder) {

                throw_if(!$folder->delete(), new Exception(__('messages.user.folders.deletion_failed')));
            });

            return redirect()->route('user.folders.index')->with('success', (__('messages.user.folders.deletion_success')));

        } catch(Exception $e) {

            return back()->with('error', $e->getMessage());
        }
    }
}
