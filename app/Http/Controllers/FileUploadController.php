<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class FileUploadController extends Controller
{
    public function fileUpload()
    {
        return view('fileUpload');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fileUploadPost(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,xlx,csv,docx|max:2048',
        ]);

        /** @var UploadedFile $file */
        $file = $request->files->get('file');

        $fileName = time() . '.' . $file->extension();

        $file->move(public_path('uploads'), $fileName);

        return back()
            ->with('success','You have successfully upload file.')
            ->with('file',$fileName);
    }
}
