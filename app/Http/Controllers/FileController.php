<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Client $client)
    {
        $files = File::where('client_id', '=', $client->id)->get();

        return view('admin.files.index', compact('files', 'client'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Client $client)
    {
        $request->validate([
            'url_file' => 'required',
            'name_file' => 'required|string|max:20',
        ],[
            'name_file.required' => 'Il nome del file è obbligatorio',
            'name_file.max' => 'Il nome del file non deve superare i 20 caratteri',
        ]);

        $file = new File();
        $file->client_id = $client->id;
        $file->name_file = $request->name_file;
        if (array_key_exists('url_file', $request->all())) {
            $url = Storage::put('/files_client', $request['url_file']);
            $file->url_file = $url;
        }
        $file->save();

        return back()->with('message','Il file è stato correttamente inserito');
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        //
    }
}
