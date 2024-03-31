<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FileResource;
use App\Http\Resources\FolderResource;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        try {

            $folders = Folder::withCount(['subFolders'])->where(['user_id' => request()->user()->id, 'sub_folder' => NULL])->latest()->paginate(10);

            $files = File::where(['user_id' => request()->user()->id])->latest()->paginate(10);

            return $this->success('', [
                'folders' => FolderResource::collection($folders),
                'files' => FileResource::collection($files)
            ]);

        } catch(Exception $e) {

            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
