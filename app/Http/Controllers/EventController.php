<?php

namespace App\Http\Controllers;

use Image;
use App\Event;
use Illuminate\Http\Request;
use App\Filters\EventFilters;

class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['create','store','edit','update','destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     //This will display all of the events
    public function index(EventFilters $filters)
    {
        $events = Event::with('eventOrganiser')->filter($filters)->latest()->paginate(24);

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     //This creates an events view
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     //This will save the events on the database
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'due_date' => 'required',
            'time' => 'required',
            'contact' => 'required',
            'venue' => 'required',
            'type' => 'required|in:sport,culture,other',
            'thumbnail_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $image = $request->thumbnail_path;
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('photos/' . $filename);
        // width - height
        Image::make($image)->resize(640, 480)->save($location);

        $event = auth()->user()->events()->create([
            'name' => $request->name,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'time' => $request->time,
            'contact' => $request->contact,
            'venue' => $request->venue ,
            'type' => $request->type,
            'thumbnail_path' => $filename

        ]);

        return redirect(route('events.show', $event));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
     //This will allow you to show all the events
    public function show(Event $event)
    {
        $event = $event->load(['photos', 'favorites']);

        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
     //This allows you to edit the event
    public function edit(Event $event)
    {
        $this->authorize('update',$event);

        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
     //This allows you to update the event
    public function update(Request $request, Event $event)
    {
        $this->authorize('update',$event);

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'due_date' => 'required',
            'time' => 'required',
            'contact' => 'required',
            'venue' => 'required',
            'type' => 'required|in:sport,culture,other',
            'thumbnail_path' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        if($request->thumbnail_path != null ) {

            $image = $request->thumbnail_path;
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('photos/' . $filename);
            // width - height
            Image::make($image)->resize(640, 480)->save($location);
        }


        $event->update([
            'name' => $request->name,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'time' => $request->time,
            'contact' => $request->contact,
            'venue' => $request->venue ,
            'type' => $request->type,
            'thumbnail_path' => $request->thumbnail_path? $filename: $event->thumbnail_path

        ]);

        return redirect(route('events.show', $event));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
     // This will delete an event
    public function destroy(Event $event)
    {
        $this->authorize('update',$event);

        $event->delete();

        return back();
    }
}
