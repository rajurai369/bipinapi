<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\FileUpload;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           $fileuploads=FileUpload::all();
           return response()->json($fileuploads);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fileupload=new FileUpload();
        if($request->hasFile('image')){
            $file=$request->image;
            $newName=time() . '.' .$file->getClientOriginalExtension();
            $file->move('images',$newName);
            $fileupload->image="images/$newName";
          }
          $fileupload->save();
          return response()->json(['message'=>'file is uploaded']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fileupload=FileUpload::find($id);
        return response()->json($fileupload);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fileupload= FileUpload::find($id);
        if($request->hasFile('image')){
            $file=$request->image;
            $newName=time() . '.' .$file->getClientOriginalExtension();
            $file->move('images',$newName);
            $fileupload->image="images/$newName";
          }
          $fileupload->update();
          return response()->json(['message'=>'file is updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fileupload=FileUpload::find($id);
        $fileupload->delete();
        return response()->json(['message'=>'File Deleted']);
    }
}
