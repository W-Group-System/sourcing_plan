<?php

namespace App\Http\Controllers;
use App\Upload;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UploadController extends Controller
{
    //
    public function index() 
    {
        $signeds = Upload::all();
        return view('upload.index', compact('signeds')); 
    }

    public function create(Request $request)
    {   
        $request->validate([
            'file' => 'max:10240', 
        ]);

        $new_signed = new Upload;
        $new_signed->type = $request->type;

        $file =  $request->file;
        $filename = time(). '_' .$file->getClientOriginalName();
        $request->file->move('assets',$filename);
        $new_signed->file = $filename;
        
        $new_signed->save();
        Alert::success('Success Title', 'Success Message');
        return back();
    }

    public function view($id) 
    {
        $signed = Upload::find($id);

        $filePath = public_path('assets/' . $signed->file);
        if (file_exists($filePath)) {
            return response()->file($filePath, ['Content-Type' => 'application/pdf']);
        } else {
            abort(404);
        }
    }

    public function delete($id)
    {
        $signed = Upload::find($id);

        if ($signed) {
            $signed->delete();
            Alert::success('Success Title', 'Success Message');
        } else {
            Alert::error('Error Title', 'Record not found');
        }

        return back();
    }
}
