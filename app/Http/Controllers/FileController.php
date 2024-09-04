<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Models\File;


class FileController extends Controller
{
    public $resource = "Working Files";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = "View Working Files";
        $action = "View Working Files";
        $resource = $this->resource;
        $files = File::all();
        return view('admin.files.index', compact('pageTitle', 'resource', 'action', 'files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Upload Working Files";
        $action = "View Working Files";
        $resource = $this->resource;
        return view('admin.files.create', compact('pageTitle', 'resource', 'action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFileRequest $request)
    {
        // Validate Form Data 
        $data = $request->validated();
        //Upload File
        if ($request->hasFile('file_url')) {
            $uploadedFile = $request->file_url;
            $extention = $uploadedFile->getClientOriginalExtension();
            $filename = $data['title'] . '.' . $extention;
            $destination = 'uploads/workingFiles/';

            if ($uploadedFile->move($destination, $filename)) {
                $data['file_url'] = $destination . $filename;
            }
        }
        $data['uniqueid'] = Str()->random(7);
        $data['uploaded_by'] = auth()->user()->id;

        //Store Data
        if (File::create($data)) {
            $message = [
                'type' => 'success',
                'message' => 'File Uploaded Successfully'
            ];
        } else {
            $message = [
                'type' => 'error',
                'message' => 'An Error Occured, Please try again'
            ];
        }

        // Return to View with Message
        return redirect(route('admin.files.index'))->with($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        $pageTitle = $action = "Viewing File : " . $file->title;
        $resource = $this->resource;
        return view('admin.files.view', compact('file', 'pageTitle', 'action', 'resource'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        $pageTitle  = $action = "Edit File : " . $file->title;
        $resource = $this->resource;
        return view('admin.files.edit', compact('pageTitle', 'resource', 'action', 'file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFileRequest  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFileRequest $request, File $file)
    {
        // Validate Form Data 
        $data = $request->validated();
        //Upload File
        if ($request->hasFile('file_url')) {
            if (file_exists($file->file_url))
                unlink($file->file_url);

            $uploadedFile = $request->file_url;
            $extention = $uploadedFile->getClientOriginalExtension();
            $filename = $data['title'] . '.' . $extention;
            $destination = 'uploads/workingFiles/';

            if ($uploadedFile->move($destination, $filename)) {
                $data['file_url'] = $destination . $filename;
            }
        }
        //Store Data
        if ($file->update($data)) {
            $message = [
                'type' => 'success',
                'message' => 'File Updated Successfully'
            ];
        } else {
            $message = [
                'type' => 'error',
                'message' => 'An Error Occured, Please try again'
            ];
        }

        // Return to View with Message
        return redirect(route('admin.files.index'))->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        if ($file->delete()) {
            unlink($file->file_url);
            $message = [
                'type' => 'error',
                'message' => 'An Error Occured, Please try again'
            ];
        } else {
            $message = [
                'type' => 'error',
                'message' => 'An Error Occured, Please try again'
            ];
        }
        return redirect(route('admin.files.index'))->with($message);
    }
}
