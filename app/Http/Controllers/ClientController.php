<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Day;
use App\Models\File;
use App\Models\Month;
use App\Models\Note;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->input('search');

        $clients = Client::where(function ($query) use ($search) {
            $query->where('name_client', 'like', "%$search%");
        })->orderBy('position', 'ASC')->paginate();

        $months = Month::all();


        return view('admin.clients.index', compact('clients', 'months'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $months = Month::all();
        return view('admin.clients.create', compact('months'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name_client' => 'required',
            'surname_client' => 'required'
        ], [
            'name_client.required' => 'Il nome è obbligatorio',
            'surname_client.required' => 'Il cognome è obbligatorio'
        ]);



        //CLIENT TABLE
        $client = new Client();
        $client->user_id = Auth::id();
        $client->name_client = $request->name_client;
        $client->surname_client = $request->surname_client;
        $client->date_of_birth = $request->date_of_birth;
        $client->city_of_birth = $request->city_of_birth;
        $client->address = $request->address;
        $client->cap = $request->cap;

        if (array_key_exists('img_url', $request->all())) {
            $url = Storage::put('/img_client', $request['img_url']);
            $client->img_url = $url;
        }


        $client->save();

        return redirect()->route('admin.clients.index')->with('message', 'Il cliente è stato correttamente inserito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        $months = Month::all();

        return view('admin.clients.edit', compact('client', 'months'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {

        $request->validate([
            'name_client' => 'required',
            'surname_client' => 'required'
        ], [
            'name_client.required' => 'Il nome è obbligatorio',
            'surname_client.required' => 'Il cognome è obbligatorio'
        ]);

        if ($request->hasfile('img_url')) {
            if ($client->img_url == true) {
                Storage::delete($client->img_url);
            }

            $url = Storage::put('/img_client', $request->file('img_url'));
            $client->img_url = $url;
        }
        
        $client->update([
            'name_client' => $request->name_client,
            'surname_client' => $request->surname_client,
            'date_of_birth' => $request->date_of_birth,
            'city_of_birth' => $request->city_of_birth,
            'address' => $request->address,
            'cap' => $request->cap,
        ]);




        return redirect()->route('admin.clients.index')->with('message', 'Il cliente è stato correttamente aggiornato');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        if ($client) {
            foreach ($client->files as $file) {
                if ($file->url_file) {
                    Storage::delete($file->url_file);
                }
                $file->delete();
            }
            $client->delete();
        }

        return back()->with('message', 'Il cliente è stato correttamente eliminato');
    }

    public function delete_Allfile(Client $client)
    {
        foreach ($client->files as $file) {

            if ($file->url_file) {
                Storage::delete($file->url_file);
                $file->url_file = null;
                $file->save();
            }

            $file->delete();
        }

        return back()->with('message', 'Tutti i file sono stati correttamente eliminati');
    }

    public function delete_file(Client $client, File $file)
    {

        // mi assicuro che il file appartenga al cliente
        if ($client->id !== $file->client_id) {
            abort(403, 'Azione non autorizzata');
        }

        if ($file->url_file) {
            Storage::delete($file->url_file);
        }

        $file->delete();

        return back()->with('message', 'Il file è stato correttamente eliminato');
    }

    public function downloadFile(Client $client, File $file)
    {
        if ($client->id == $file->client_id && $file->id) {

            $filePath = public_path('storage/' . $file->url_file);
        }

        return response()->download($filePath, '');
    }


    public function changeClientPosition(Request $request, Client $client)
    {

        //prendo la osizione esistente
        $positionEsistente = $client->position;
        //prendo la osizione nuova dall'input
        $positionNuova =  intval($request->new_position);
        //prendo dove posizine ha la posizione nuova
        $clientWithPosition2  = Client::where('position', $positionNuova)->first();

        //aggiorno la posizione con la posizione nuova
        $client->position = $positionNuova;
        $client->save();

        //aggiorno la posizione con la posizione eisistente
        $clientWithPosition2->position = $positionEsistente;
        $clientWithPosition2->save();

        //mando giù le categorie ordinate 
        $clients = Client::orderBy('position', 'ASC')->get();

        return redirect()->back()->with(['clients' => $clients])->with('message', "Il cliente $client->name_client $client->surname_client è stato correttamente spostato alla posizione $client->position");
    }
}
