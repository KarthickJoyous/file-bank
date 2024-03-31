<?php

namespace App\Http\Controllers\Api\File;

use Exception;
use App\Helpers\Helper;
use App\Helpers\viewHelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\{File, Passbook};
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\FileResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Api\File\CreateFileRequest;

class FileController extends Controller
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

            $base_query = File::query()
            ->where(['user_id' => $request->user()->id])
            ->when($request->filled('search'), function($query) {
                $query->where(function($query) {
                    $query->where('name', "LIKE", "%" . request('search') . "%");
                });
            })->latest();

            $pagination = config('app.pagination');

            return $this->success('', [
                'total_files' => $base_query->count(),
                'files' => FileResource::collection($base_query->skip($request->input('skip', 0))->take(min($request->input('take', $pagination), $pagination))->get())
            ]);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param CreateFileRequest $request
     * @return JsonResponse
     */
    public function store(CreateFileRequest $request): JsonResponse
    {
        try {

            $data['files'] = DB::transaction(function () use($request) {

                foreach($request->contents as $content) {

                    $name = $temp_file_name = $request->name ?: (string)Str::uuid();

                    $alias = 1;

                    $file_type = $content->getClientOriginalExtension();

                    while (File::where(['user_id' => $request->user()->id, 'name' => $name, 'file_type' => $file_type])->exists()) {
                        $name = "$temp_file_name($alias)";
                        $alias++;
                    };

                    $folder_path = $request->user()->id . '/' . FILE_BANK_FILE_PATH;

                    $url = Helper::deposit_file($content, $folder_path, $name);

                    $file_info = [
                        'name' => $name,
                        'url' => $url,
                        'file_type' => $file_type,
                        'size' => (new viewHelper)->bytes_to_mb(Storage::disk('public')->size("$folder_path/$name.$file_type"))
                    ];

                    $file = File::Create($request->validated() + $file_info);

                    throw_if(!$file, new Exception(__('messages.user.files.file_upload_failed'), 500));

                    $passbook = Passbook::lockForUpdate()->firstOrCreate(['user_id' => $file->user_id]);
                    
                    $result = $passbook->update([
                        'used' => $passbook->used + $file_info['size'],
                        'remaining' => $passbook->remaining - $file_info['size']
                    ]);

                    throw_if(!$result, new Exception(__('messages.user.files.file_upload_failed'), 500));

                    $files[] = new FileResource($file);
                }

                return $files;
            });

            return $this->success(trans_choice('messages.user.files.file_upload_success', count($data['files'])), $data);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     * 
     * @param File $file
     * @return JsonResponse
     */
    public function show(File $file): JsonResponse
    {
        try {

            throw_if($file->user_id != request()->user()->id, new Exception('', 403));

            return $this->success('', [
                'file' => new FileResource($file)
            ]);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param File $file
     * @return JsonResponse
     */
    public function destroy(File $file): JsonResponse
    {
        try {

            throw_if($file->user_id != request()->user()->id, new Exception('', 403));

            DB::transaction(function () use($file) {

                throw_if(!$file->delete(), new Exception(__('messages.user.files.deletion_failed'), 500));

                $passbook = Passbook::lockForUpdate()->firstOrCreate(['user_id' => $file->user_id]);
                    
                $result = $passbook->update([
                    'used' => $passbook->used - $file->size,
                    'remaining' => $passbook->remaining + $file->size
                ]);

                throw_if(!$result, new Exception(__('messages.user.files.deletion_failed'), 500));
            });

            return $this->success(__('messages.user.files.deletion_success'), []);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
