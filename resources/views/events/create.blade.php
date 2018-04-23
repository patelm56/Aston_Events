@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">

            <h1><b>Post event</b></h1>

            <hr />

            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">

                {{ csrf_field() }}

                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Name of the Event" required>
                </div>

                <div class="form-group">
                    <textarea class="form-control" name="description" rows="4" placeholder="Description..." required></textarea>
                </div>

                <div class="form-group">
                    <input type="date" class="form-control"  name= "due_date" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control"  name= "time" placeholder=" Enter Time" required>
                </div>


                <div class="form-group">
                    <input type="text" class="form-control" name="contact" placeholder="Contact Number" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="venue" placeholder="Venue" required>
                </div>

                <div class="form-group">
                    <label for="exampleSelect2">Event Type</label>
                    <select class="form-control" name="type" required>
                    <option value="">(pick event type)</option>
                    <option>sport</option>
                    <option>culture</option>
                    <option>other</option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="file" class="form-control" name="thumbnail_path" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block">POST</button>
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
