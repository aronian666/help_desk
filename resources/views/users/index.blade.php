@extends('layouts.app')

@section('content')
    <section>
        <h2 class="ui center aligned icon header">
            <i class='circular users icon'></i> 
            Users
        </h2>
        <div class='ui link cards'>
            @foreach ($users as $user)
                <div class='card'>
                    <div class="image">
                        <img style='width: 100%; height: 300px;' src="{{ $user->photo }}" alt="{{ $user->name }}">
                    </div>
                    <div class="content">
                        <div class="header"><a href="{{ url("users/{$user->id}/edit") }}">{{ $user->name }}</a></div>
                        <div class="meta">
                            <a href="{{ url("users/{$user->id}/edit") }}">{{ $user->role->name }}</a>
                        </div>
                        <div class="description">
                            {{ $user->description }}
                        </div>
                    </div>
                </div>    
            @endforeach
        </div>
        
    </section>
@endsection
