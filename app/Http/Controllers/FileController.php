<?php

namespace App\Http\Controllers;

use App\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    public function index()
    {
        $files = UploadFile::latest()->paginate(4);

        return view('file.index', compact('files'));
    }


    public function create()
    {
        return view('file.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'file_name' => 'required',
            'file' => 'required',
        ]);

        //Check and Make File Dir.
        if (!Storage::disk('public')->exists('files')) {
            Storage::disk('public')->makeDirectory('files');
        }

        //Unique Name
        $fileName = time() . '.' . request()->file->getClientOriginalExtension();

        //File URL
        $fileUrl = request()->file->move(('storage/files'), $fileName);

        $files = new UploadFile();

        $files->file_name = $request->file_name;
        $files->file = $fileUrl;
        $files->save();


        return redirect()->route('file.index')
            ->with(['message' => 'File Saved Successfully']);
    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        $file = UploadFile::find($id);

        return view('file.edit', compact('file'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'file_name' => 'required',
        ]);

        if ($request->file) {
            //Unique Name
            $fileName = time() . '.' . request()->file->getClientOriginalExtension();

            //File URL
            $fileUrl = request()->file->move(('storage/files'), $fileName);

            $file = UploadFile::find($id);

            unlink($file->file);

            $file->file_name = $request->file_name;
            $file->file = $fileUrl;
            $file->save();


            return redirect()->route('file.index')
                ->with(['message' => 'File Updated Successfully']);

        } else {

            $file = UploadFile::find($id);

            $file->file_name = $request->file_name;
            $file->save();

            return redirect()->route('file.index')
                ->with(['message' => 'File Updated Successfully']);
        }

    }


    public function destroy($id)
    {
        $file = UploadFile::findOrFail($id);

        unlink($file->file);

        $file->delete();

        return redirect()->route('file.index')
            ->with(['message' => 'File Deleted Successfully']);
    }
}
