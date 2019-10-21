@extends('layouts.app')

@section('content')
    <section>
        <h2 class="center aligned ui icon header">
            <i class="settings icon"></i>
            <div class="content">
                {{ $ticket->title}}
                <div class="sub header">{{ $ticket->description}}</div>
            </div>
        </h2>
        <div class="ui steps">
            @foreach ($statuses as $status)
                <div class="{{ $ticket->status->id >= $status->id ? "completed" : "active" }} step">
                    <i class="{{ $status->icon }} icon"></i>
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

        <h3 class="ui header">
            <i class="user icon"></i>
            <div class="content">
                {{ $ticket->technical ? "Tecnico asignado" : ($user->role->id == 2 ? "Tecnico" : "Asigne un tecnico")}}
                <div class="sub header">Administre los profesionales para este problema...</div>
            </div>
        </h3>
        <div class="ui divider"></div>
        @if ($user->role->id == 1 || $user->role->id == 3)
            <div class="ui cards">
                @foreach ($technicals as $technical)
                    <div class="card">
                        <div class="content">
                            <img class="right floated mini ui image" src="{{ $technical->photo }}" alt="{{ $technical->name }}">
                            <div class="header">
                                {{ $technical->name }}
                            </div>
                            <div class="meta">
                                {{ $technical->role->name }}
                            </div>
                            <div class="description">
                                {{ $technical->description }}
                            </div>
                        </div>
                        <div class="extra content">
                            <div class="ui two buttons">
                                @if ($ticket->isTechnical($user))
                                    <div class="ui basic green button" onclick="asingTechnical({{ $technical->id }}, 3)">Aceptar</div>
                                    <div class="ui basic red button" onclick="asingTechnical('', 1)">Declinar</div>
                                @elseif ($ticket->technical)
                                    <div class="ui basic negative button" onclick="asingTechnical('', 1)">Cambiar</div>
                                @else
                                    <div class="ui basic green button" onclick="asingTechnical({{ $technical->id }}, 2)">Asignar</div>    
                                @endif
                            </div>
                            
                        </div>
                    </div>    
                @endforeach
                <form action="{{ url("tickets/{$ticket->id}") }}" method="POST" style="display: none" id="form">
                    @method('patch')
                    {{ csrf_field() }}
                    <input type="text" name="ticket[technical_id]" id="ticket[technical_id]">
                    <input type="text" name="ticket[status_id]" id="ticket[status_id]">
                </form>
            </div>    
        @else
            @if ($ticket->technical)
                <div class="ui card centered">
                    <div class="image">
                        <img src="{{ $ticket->technical->photo }}" alt={{ $ticket->technical->name }}>
                    </div>
                    <div class="content">
                        <div class="header">{{ $ticket->technical->name }}</div>
                        <div class="meta">
                            <a>{{ $ticket->technical->role->name}}</a>
                        </div>
                        <div class="description">
                            {{ $ticket->technical->description}}
                        </div>
                    </div>
                    <div class="extra content">
                        <span>
                            <i class="user icon"></i>
                            Trabajo en {{ count($ticket->technical->getTickets()) }} problema(s)
                        </span>
                    </div>
                </div>
            @else
                <div class="ui info message">
                    <div class="header">
                        ¿Qué es esto?
                    </div>
                    <p>Es el profesional que te ayudara en la resolucion del problema.</p>
                    <div class="header">
                        ¿Por qué aún no hay uno?
                    </div>
                    <p>Lo mas probable es que todos esten ocupados en este momento, cuando acepten el problema, sera el primero el saberlo.</p>
                </div>
            @endif
        @endif

        <h3 class="ui header">
            <i class="image icon"></i>
            <div class="content">
                Imagenes
                <div class="sub header">Suba imagenes referenciales del problema que tiene...</div>
            </div>
        </h3>
        <div class="ui divider"></div>

        <div class="ui four cards" id="images">
            @foreach ($attachments as $key=>$attachment)
                <a class="{{ $colors[$key % 10] }} card">
                    <div class="image">
                        <img src="{{ $attachment->url }}" alt="{{ $attachment->name }}" style="height: 280px; width: 260px">
                    </div>
                </a>
            @endforeach
        </div>
        <div class="ui placeholder segment" style="opacity: 0.8; cursor: pointer" ondrop="uploadImage(event, {{ $ticket->id }}, {{ $user->id}})" ondragover="handleOver(event)" id="upload-image">
            <div class="ui icon header">
                <i class="pdf file outline icon"></i>
                Arrastre o haga click aqui para subir una imagen
            </div>
        </div>


        <div class="ui comments">
            <h3 class="ui header dividing">
                <i class="comment icon"></i>
                <div class="content">
                    Comentarios
                </div>
            </h3>
            @forelse ($comments as $comment)
                <div class="comment">
                    <a class="avatar">
                        <img src="{{ $comment->user->photo }}" alt="{{ $comment->user->name }}">
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
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <script>
        function asingTechnical(id, step) {
            var technical = document.getElementById('ticket[technical_id]')
            var status = document.getElementById('ticket[status_id]')
            status.value = step
            technical.value = id
            var form = document.getElementById("form")
            form.submit()
        }
        var colors = ['red', 'orange', 'yellow', 'olive', 'green', 'teal', 'blue', 'violet', 'purple', 'pink', 'brown', 'grey', 'black']
        var storageRef = firebase.storage().ref();
        function uploadImage(event, ticket_id, user_id){
            event.preventDefault()
            var metadata = {
              contentType: 'image/jpeg'
            };
            var files = event.dataTransfer.files
            var uploaders = []
            var names = []
            for (var i = 0; i < files.length; i++) {
                console.log(files[i].name)
                names[i] = files[i].name
                uploaders[i] = storageRef.child('tickets/' + ticket_id + '/' + files[i].name).put(files[i], metadata);
                
            }
            uploadRecursive(uploaders, uploaders.length, 0, names, ticket_id, user_id)
        }

        function uploadRecursive(uploaders, size, i, names, ticket_id, user_id){
            if (i >= size) {
                return
            }
            uploaders[i].on('state_changed', function(snapshot){
                }, function(error) {
                }, function() {
                    uploaders[i].snapshot.ref.getDownloadURL().then(function(downloadURL) {
                        $.ajax({
                            url: '/attachments',
                            type: 'POST',
                            data: {
                                attachment: {
                                    user_id: user_id, 
                                    ticket_id: ticket_id, 
                                    url: downloadURL,
                                    name: names[i]
                                },
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(){
                                uploadRecursive(uploaders, size, i + 1, names, ticket_id, user_id)
                                var color = colors[Math.floor(Math.random() * colors.length)];
                                $("#images").append(`<a class="${color} card"><div class="image"><img src="${downloadURL}" alt="${names[i]}" style="height: 280px; width: 260px"></div></a>`)
                            },
                            error: function(e){
                                console.error(e)
                            }
                        })
                    });
                }
            );
        }

        function handleOver(event) {
            console.log('estoy haciendo algo')
            $('#upload-image').css({
                'opacity': 1
            })
            event.preventDefault()
        }
        
    </script>
@endsection