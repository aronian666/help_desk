@extends('layouts.app')

@section('content')
    <section class='container'>
        <h2 class="center aligned ui icon header">
            <i class="settings icon"></i>
            <div class="content">
                {{ $ticket->title}}
                <div class="sub header">{{ $ticket->description}}</div>
            </div>
        </h2>
        <div class="ui ordered steps">
            @foreach ($statuses as $status)
                <div class="{{ $ticket->status->id >= $status->id ? "completed" : "active" }} step">
                    <div class="content">
                        <div class="title">{{ $status->name }}</div>
                        <div class="description">{{ $status->description }}</div>
                    </div>
                </div>    
            @endforeach
        </div>
        <div class="ui list">
            <div class="item">
                <i class="users icon"></i>
                <div class="content">
                    Reportado por: <a href="#">{{ $ticket->user->name }}</a>
                </div>
            </div>
            <div class="item">
                <i class="calendar times icon"></i>
                <div class="content">
                    Creado: {{ $ticket->user->created_at }}
                </div>
            </div>
            <div class="item">
                <i class="mail icon"></i>
                <div class="content">
                    Email: <a href="mailto:{{ $ticket->user->email }}">{{ $ticket->user->email }}</a>
                </div>
            </div>

            <div class="item">
                <i class="microchip icon"></i>
                <div class="content">
                    Tipo: {{ $ticket->type->name }}
                </div>
            </div>

            <div class="item">
                <i class="keyboard icon"></i>
                <div class="content">
                    Equipo: {{ $ticket->product->name }}
                </div>
            </div>  

            <div class="item">
                <i class="calendar alternate icon"></i>
                <div class="content">
                    Prioridad: {{ $ticket->priority->name }}
                </div>
            </div>  

        </div>

        <div class="ui comments">
            <h3 class="ui dividing header">Comentarios</h3>
            @forelse ($comments as $comment)
                <div class="comment">
                    <a class="avatar">
                        <img src="/images/avatar/small/matt.jpg">
                    </a>
                    <div class="content">
                    <a class="author">{{ $comment->user->name }}</a>
                    <div class="metadata">
                        <span class="date">{{ $comment->created_at}}</span>
                    </div>
                    <div class="text">
                        {{ $comment->body }}
                    </div>
                    <div class="actions">
                        <a class="reply">Reply</a>
                    </div>
                    </div>
                </div>    
            @empty
                <p> No hay commentarios aun</p>
            @endforelse
            <form method="POST" action="{{ url('comments') }}" class="ui reply form" >
                {{ csrf_field()}}
                <div class="field">
                <textarea name="comment[body]"></textarea>
                </div>
                <input name="comment[user_id]" type="text" style="display: none" value="{{ auth()->user()->id }}">
                <input name="comment[ticket_id]" type="text" style="display: none" value="{{ $ticket->id }}">
                <button type="submit" class="ui primary button">
                    Añadir comentario
                </button>
            </form>
        </div>
    </section>
@endsection