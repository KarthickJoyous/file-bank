<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        try {

            $folders = Folder::withCount(['subFolders'])->where(['user_id' => auth('web')->id(), 'sub_folder' => NULL])->latest()->paginate(10);

            $files = File::where(['user_id' => auth('web')->id()])->latest()->paginate(10);

            return view('users.home')->with(compact(['folders', 'files']));

        } catch(Exception $e) {

            return back()->with('error', $e->getMessage());
        }
    }
}
