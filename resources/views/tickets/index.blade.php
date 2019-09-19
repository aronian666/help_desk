@extends('layouts.app')

@section('content')
    <section class='container'>
        <h1>Tikecks de ayuda</h1>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#">Todos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Activos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Completados</a>
            </li>
        </ul>
        @forelse ($tickets as $ticket)
            <a href="{{ route('tickets.show', ['ticket' => $ticket])}}">
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-2">
                        <img src="" class="card-img" alt="">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">{{ e($ticket->title) }}</h5>
                                <p class="card-text">{{ e($ticket->description)}}</p>
                                <p class="card-text"><small class="text-muted">Ultima actualizacion {{ e($ticket->updated_at)}}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            
        @empty
            <p>No hay tickets</p>
        @endforelse
    </section>
@endsection
