@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">

            <h1><b>Edit Event</b></h1>

            <hr />

            <form action="{{ route('events.update', $event) }}" method="POST" enctype="multipart/form-data">

                {{ csrf_field() }}
                {{ method_field('PATCH')}}

                <div class="form-group">
                    <input type="text" value="{{ $event->name }}"class="form-control" name="name" placeholder="Name of the event" required>
                </div>

                <div class="form-group">
                    <textarea class="form-control" name="description" rows="4" placeholder="description..." required>{{$event->description}}</textarea>
                </div>

                <div class="form-group">
                    <input type="date" value="{{ $event->due_date }}" class="form-control"  name= "due_date" required>
                </div>

                <div class="form-group">
                    <input type="text" value="{{ $event->time }}" class="form-control"  name= "time" required>
                </div>


                <div class="form-group">
                    <input type="text" value="{{ $event->contact }}" class="form-control" name="contact" placeholder="contact number" required>
                </div>

                <div class="form-group">
                    <input type="text" value="{{ $event->venue }}" class="form-control" name="venue" placeholder="venue" required>
                </div>

                <div class="form-group">
                    <label for="exampleSelect2">Event Type</label>
                    <select class="form-control" name="type" required>
                    <option>{{ $event->type }}</option>
                    <option>sport</option>
                    <option>culture</option>
                    <option>other</option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="file" class="form-control" name="thumbnail_path">
                    <small class="form-text text-muted">Optional</small>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Update</button>
            </form>

            <!-- Errors -->
            @if(count($errors))
                <ol class ="text-center p-2">
                    @foreach($errors->all() as $error)
                        <p style='color:red'>{{$error}}</p>
                    @endforeach
                </ol>
            @endif

        </div>
    </div>
</div>

@endsection
