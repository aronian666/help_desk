@extends('layouts.app')

@section('content')
    <section class='container'>
        <h2 class="center aligned ui icon header">
            <i class="settings icon"></i>
            <div class="content">
                Lista de Tickets
                <div class="sub header">Lista de todos los tickets reportados</div>
            </div>
        </h2>
        <div class="ui top attached tabular menu">
            <a class="active item options" data-status="1">
                Todos
            </a>
            <a class="item options" data-status="2">
                Asignados 
            </a>
            <a class="item options" data-status="3">
                En progreso
            </a>
            <a class="item options" data-status="6">
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
                    <tr data-status={{ $ticket->status->id }} class="ticket">
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
    <script>
        var tickets = document.getElementsByClassName('ticket')
        var options = document.getElementsByClassName('options')
        for (var i = 0; i < options.length; i++) {
            options[i].addEventListener('click', function() {
                var status = this.dataset.status
                for (var i = 0; i < tickets.length; i++) {
                    if (parseInt(tickets[i].dataset.status) >= status) {
                        tickets[i].style.display = ''
                    }
                    else {
                        tickets[i].style.display = 'none'
                    }
                }
                for(var a = 0; a < options.length; a++) {   
                    if (status == options[a].dataset.status){
                        options[a].classList.add('active')
                    }
                    else {
                        options[a].classList.remove('active')
                    }
                }
                
            })
        }
        function filterTickets(event, status){
            console.log(status)
            return
            
        }
    </script>
@endsection
