@extends('layouts.app')

@section('content')
    <section>
        <h2 class="ui center aligned icon header">
            <i class="circular users icon"></i>
            Informacion del usuario
        </h2>
        <div class="ui divider"></div>
        <div class="ui grid">
            <div class="four wide column">
                <div class="ui fluid card">
                    <div class="image">
                        <img id='img-user' src="{{ $user->photo }}" alt="{{ $user->name }}" style='width: 100%; height: 250px;'>
                    </div>
                    <div class="content">
                        <a>{{ $user->name }}</a>
                    </div>
                </div>
            </div>

            <div class="eight wide column">
                <div class="ui list">
                    <div class="item">
                        <i class="users icon"></i>
                        <div class="content">
                            Nombre: {{ $user->name}}
                        </div>
                    </div>
                    <div class="item">
                        <i class="marker icon"></i>
                        <div class="content">
                            Profesion: {{ $user->description}}
                        </div>
                    </div>
                    <div class="item">
                        <i class="mail icon"></i>
                        <div class="content">
                            Email: <a href="mailto:jack@semantic-ui.com">{{ $user->email }}</a>
                        </div>
                    </div>
                    <div class="item">
                        <i class="linkify icon"></i>
                        <div class="content">
                            Rol: {{ $user->role->name }}
                        </div>
                    </div>
                    @if ($user->role->id == 2 || $user->role->id == 1)
                        <div class="item">
                            <i class="linkify icon"></i>
                            <div class="content">
                                Reporto {{ count($user->tickets) }} problema(s)
                            </div>
                        </div>
                    @elseif ($user->role->id == 3)
                        <div class="item">
                            <i class="linkify icon"></i>
                            <div class="content">
                                Fue asignado a {{ count($user->getTickets()) }} problema(s)
                            </div>
                        </div>
                        <div class="item">
                            <i class="linkify icon"></i>
                            <div class="content">
                                Resolvio {{ count($user->getSuccessTickets()) }} problema(s)
                            </div>
                        </div>
                    @endif
                </div>
                <button class="ui primary basic button">
                    <a href="{{ url("users/{$user->id}/edit") }}">Editar</a>
                </button>
            </div>  
        </div>
    </section>
@endsection