@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">

            @foreach($events as $event)

            <div class="col-md-4 p-3">
                <a href="{{ $event->path() }}">
                    <div class="card bg-dark text-blue" style="font-family:Comic Sans MS, font-weight: bold;, cursive, sans-serif">
                        <img class="card-img" src="{{ url('/photos/' .$event->thumbnail_path) }}" style="opacity:2;">
                        <!-- <img class="card-img" src="{{ $event->thumbnail_path }}" style="opacity:2;"> -->
                        <div class="card-body">
                            <h5 class="card-title">Title: {{ $event->name }}</h5>
                            <p class="card-text"> Venue: {{ $event->venue }}</p>
                            <p class="card-text">Type: {{ $event->type }}</p>
                            <p class="card-text">Likes: {{ $event->favorites_count }}</p>
                            <p class="card-text">Due Date: {{ $event->due_date }}</p>
                            <p class="card-text">{{ $event->time }}</p>
                        </div>
                    </div>
                </a>
            </div>

            @endforeach

        </div>

        {{$events->links()}}



    </div>

@endsection
