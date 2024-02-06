<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Client $client)
    {
         return view('admin.events.index', compact('client'));
    }

    public function getEvents(Client $client)
    {
        $events = Event::where('client_id', '=', $client->id)->get();

        return response()->json($events);
    }

    public function deleteEvent(Client $client, Event $event)
    {
        if ($event->client_id == $client->id) {

            $event->delete();
        }
        return response()->json(['message' => 'Deleted']);
    }

    public function store(Request $request, Client $client)
    {

        $event = new Event();
        $event->client_id = $client->id;
        $event->title = $request->title;
        $event->description = $request->description;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->save();

        return back();
    }
    public function dateUpdate(Request $request, Client $client, Event $event)
    {

        if ($event->client_id == $client->id) {

            $event->update([
                'start' => Carbon::parse($request->input('start'))->setTimeZone('UTC'),
                'end' => Carbon::parse($request->input('end'))->setTimeZone('UTC')
            ]);
        }

        return response()->json(['message' => 'Data aggiornata']);
    }


    public function updateContent(Request $request, Client $client, Event $event)
    {
        if ($event->client_id == $client->id) {

            $event->update([
                'title' => $request->title,
                'description' => $request->description,
                'start' => $request->start,
                'end' => $request->end
            ]);
        }

        return response()->json(['message' => 'Contenuto aggiornato']);
    }

    public function search(Request $request, Client $client)
    {
        $searchKeywords = $request->input('title');
        $matchingEvents = Event::where('client_id', '=', $client->id)->where('title', 'like', '%' . $searchKeywords . '%')->get();

        return response()->json($matchingEvents);
    }
}
