<?php

namespace App\Http\Controllers\User\File;

use Exception;
use App\Models\File;
use App\Helpers\Helper;
use App\Helpers\viewHelper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\User\File\CreateFileRequest;
use App\Http\Requests\User\File\UpdateFileRequest;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

            $files = File::query()
            ->where(['user_id' => auth('web')->id()])
            ->when($request->filled('search'), function($query) {
                $query->where(function($query) {
                    $query->where('name', "LIKE", "%" . request('search') . "%");
                });
            })
            ->latest()
            ->paginate(20);

            return view('users.files.index')->with(compact(['files']));

        } catch(Exception $e) {

            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateFileRequest $request
     */
    public function store(CreateFileRequest $request)
    {
        try {

            $file = DB::transaction(function () use($request) {

                foreach($request->file as $file) {

                    $name = $temp_file_name = $request->name ?: (string)Str::uuid();

                    $alias = 1;

                    $file_type = $file->getClientOriginalExtension();

                    while (File::where(['user_id' => auth('web')->id(), 'name' => $name, 'file_type' => $file_type])->exists()) {
                        $name = "$temp_file_name($alias)";
                        $alias++;
                    };

                    $folder_path = auth('web')->id() . '/' . FILE_BANK_FILE_PATH;

                    $url = Helper::deposit_file($file, $folder_path, $name);

                    $file_info = [
                        'name' => $name,
                        'url' => $url,
                        'file_type' => $file_type,
                        'size' => (new viewHelper)->bytes_to_mb(Storage::disk('public')->size("$folder_path/$name.$file_type"))
                    ];

                    $file = File::Create($request->validated() + $file_info);

                    throw_if(!$file, new Exception(__('messages.user.files.file_upload_failed')));
                }

                return $file;
            });

            return redirect()->route('user.files.show', $file)->with('success', (__('messages.user.files.file_upload_success')));

        } catch(Exception $e) {

            return back()->withInput()->with('error', $e->getMessage())->with('file_upload_error', true);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {   
        abort_if($file->user_id != auth('web')->id(), 404);

        return view('users.files.show')->with(compact(['file']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        //
    }
}
