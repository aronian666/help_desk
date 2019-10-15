@extends('layouts.app')

@section('content')
    <section class='container'>
        <div class="ui top attached tabular menu">
            <a href="#" class="active item">
                Todos
            </a>
            <a href="#" class="item">
                Activos
            </a>
            <a href="#" class="item">
                Completados
            </a>
            <div class="right menu">
                <div class="item">
                    <a class="ui button green" href="{{route('tickets.create')}}">Crear nuevo ticket</a>
                </div>
            </div>
        </div>
        <div class="ui items">
            @forelse ($tickets as $ticket)
                <div class="item">
                    <div class="image">
                        <img src="https://images.vexels.com/media/users/3/153290/isolated/lists/de05a2ea2ab342b4f6df780059ac003f-processor-colored-stroke-icon.png">
                    </div>
                    <div class="content">
                        <a class="header" href="{{ route('tickets.show', ['ticket' => $ticket])}}">{{ e($ticket->title) }}</a>
                        <div class="meta">
                            <span>{{ e($ticket->description)}}</span>
                        </div>
                        <div class="description">
                            <p></p>
                        </div>
                        <div class="extra">
                            Ultima modificacion {{ e($ticket->updated_at) }}
                        </div>
                    </div>
                </div>
            @empty
                <p>No hay tickets</p>
            @endforelse
        </div>
    </section>
@endsection
