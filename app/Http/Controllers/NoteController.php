<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Month;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Client $client)
    {
        $months = Month::all();
        $notes = Note::where('client_id', $client->id)->orderBy('id', 'DESC')->get();
        return view('admin.notes.index', compact('notes', 'client', 'months'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Client $client)
    {
        $months = Month::all();

        return view('admin.notes.create', compact('client', 'months'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Client $client)
    {

        $note = new Note();
        $note->client_id = $client->id;
        $note->title = $request->title;
        $note->description = $request->description;
        $note->save();

        $data = $request->all();

      

        //MONTH_NOTE CLIENT TABLE
        if (array_key_exists('months', $data)) {
            $note->months()->attach($data['months']);
        }

        return redirect()->route('admin.notes.index', compact('client'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note, Client $client)
    {
        $months = Month::all();
        $current_month = $note->months->pluck('id')->toArray();

        return view('admin.notes.edit', compact('note', 'client', 'months', 'current_month'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note, Client $client)
    {

        $note->update([
            'title' => $request->title,
            'description' => $request->description
        ]);

        $data = $request->all();

        if (array_key_exists('months', $request->all())) $note->months()->sync($data['months']);
        else $note->months()->detach();

        return redirect()->route('admin.notes.index', compact('client'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return back();
    }

    public function destroyAllNote(Client $client)
    {
        $notes = Note::all();
        foreach ($notes as $note) {
            if ($client->id == $note->client_id) {
                $note->delete();
            }
        }

        return back();
    }

    public function isCompletedNote(Note $note)
    {

        if ($note->is_active == 0) {
            $isCompleted = 1;
        } else {
            $isCompleted = 0;
        }

        $note->is_active = $isCompleted;
        $note->save();

        return back();
    }

    public function getMonthNote(Month $month, Client $client)
    {
        $months = Month::all();
        /* $notes = $month->notes; */

        //mi fa vedere solo le note di un determinato mese di un determinato cliente
        $notes = $client->notes()
        ->whereHas('months', function ($query) use ($month) {
            $query->where('months.id', $month->id);
        })
        ->get();

        return view('admin.notes.index', compact('notes', 'month', 'months', 'client'));
    }
}
