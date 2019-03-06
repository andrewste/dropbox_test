<?php

namespace App\Http\Controllers;

use App\Http\Requests\Files\UpdateRequest;
use Storage;
use App\File;
use App\Http\Requests\Files\StoreRequest;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::paginate(8);

        return view('files.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @param File $file
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, File $file)
    {
        $path = $request->file('file')
            ->store('files', 'dropbox');

        $file->create([
            'name' => $request->file('file')->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $request->file('file')->getMimeType(),
            'size' => $request->file('file')->getSize(),
        ]);

        return redirect()->route('files.index');
    }

    /**
     * Display the specified resource.
     *
     * @param File $file
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function show(File $file)
    {
        return Storage::disk('dropbox')->response($file->path);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param File $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        return view('files.edit', compact('file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param File $file
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, File $file)
    {
        Storage::disk('dropbox')->delete($file->path);

        $path = $request->file('file')
            ->store('files', 'dropbox');

        $file->update([
            'name' => $request->file('file')->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $request->file('file')->getMimeType(),
            'size' => $request->file('file')->getSize()
        ]);

        return redirect()->route('files.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param File $file
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(File $file)
    {
        Storage::disk('dropbox')->delete($file->path);

        $file->delete();

        return redirect()->route('files.index');
    }
}
