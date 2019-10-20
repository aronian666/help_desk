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
            @if ($user->createTicket())
                <div class="right menu">
                    <div class="item">
                        <a class="ui button green" href="{{route('tickets.create')}}">Crear nuevo ticket</a>
                    </div>
                </div>    
            @endif
        </div>
        <table class="ui celled structured table">
            <thead>
                <tr>
                    <th rowspan="2">Ticket</th>
                    <th rowspan="2">Descripcion</th>
                    <th rowspan="2">Reportado por</th>
                    <th colspan="4">Estados</th>
                </tr>
                <tr>
                    @foreach ($statuses as $status)
                        <th>{{ $status->name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                    <tr>
                        <td><a class="header" href="{{ route('tickets.show', ['ticket' => $ticket])}}">{{ e($ticket->title) }}</a></td>
                        <td>{{ e($ticket->shortDescription())}}</td>
                        <td class="right aligned">{{ $ticket->user->name}}</td>
                        @foreach ($statuses as $status)
                            <td class="center aligned">
                                @if ($ticket->status->id >= $status->id)
                                    <i class="large green checkmark icon"></i>        
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
