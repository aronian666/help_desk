@extends('layouts.app')

@section('content')
    <section class='container'>
        <div class="row">
            <div class="col-md-1">
                <img style="width: 100%" src="https://images.vexels.com/media/users/3/153290/isolated/lists/de05a2ea2ab342b4f6df780059ac003f-processor-colored-stroke-icon.png" alt="hardware">
            </div>
            <h1 class="col-md-11">{{ e($ticket->title) }}</h1>
        </div>
        <div class="row">
            
        </div>
        <p>{{ e($ticket->description) }}</p>
        <p>{{ e($ticket->type->name)}}</p>
    </section>
@endsection