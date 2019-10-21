@extends('layouts.app')

@section('content')
    <section class='container'>
        <h2 class="ui center aligned icon header">
            <i class="circular tty icon"></i>
            Reportar nuevo problema
        </h2>
        <form method="POST" action="{{ url('tickets')}}" style="background: #fff;">
            {{ csrf_field() }}
            <h3 class="ui header">
                    <i class="user icon"></i>
                    <div class="content">
                        Describa el problema que tuvo
                    </div>
                </h3>
            <div class="ui divider"></div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="title">Titulo del problema</label>
                    <input name='ticket[title]' type="text" class="form-control" id="title" placeholder="No funciona el..." required>
                </div>
            </div>
            <div class="form-group">
                <label for="description">Descripcion del problema</label>
                <textarea name="ticket[description]" id="description" rows="5" placeholder="Ayer tube un problema con..." class='form-control' required></textarea>
            </div>
            <h3 class="ui header">
                <i class="image icon"></i>
                <div class="content">
                    Imagenes
                    <div class="sub header">Suba imagenes referenciales del problema que tiene...</div>
                </div>
            </h3>
            <div class="ui divider"></div>
    
            <div class="ui four cards" id="images">
            </div>
            <div class="ui placeholder segment" style="cursor: pointer" id="upload-image">
                <div class="ui icon header">
                    <i class="pdf file outline icon"></i>
                    Arrastre o haga click aqui para subir una imagen
                </div>
                <label for="attachment">
                    <a class="ui primary button">Agregar nueva imagen</a>
                    <input onchange="uploadImage(event, {{ $user->id }})" multiple type="file" id='attachment' name='attachment' style="display: none">
                </label>
                <div style="display: none" id="attachments">
                </div>
            </div>
            <h3 class="ui header">
                    <i class="user icon"></i>
                    <div class="content">
                        Agrege mas detalles
                    </div>
                </h3>
            <div class="ui divider"></div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="product">Aparato</label>
                    <select name="ticket[product_id]" class="form-control" id='product' required>
                        <option value="">Seleccione una opcion...</option>
                        @foreach ($products as $product)
                            <option value="{{$product->id}}">{{ $product->name }}</option>   
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="type">Tipo de aparato</label>
                    <select name="ticket[type_id]" class="form-control" id="ticket[type]" required>
                        <option value="">Seleccione una opcion...</option>
                        @foreach ($types as $type)
                            <option value="{{$type->id}}">{{ $type->name }}</option>   
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="priority">Prioridad</label>
                    <select name="ticket[priority_id]" class="form-control" id="type" required>
                        <option value="">Seleccione una opcion...</option>
                        @foreach ($priorities as $priority)
                            <option value="{{$priority->id}}">{{ $priority->name }}</option>   
                        @endforeach
                    </select>
                </div>
            </div>
            
            <button class="ui green basic button" type='submit'>Reportar problema</button>
        </form>
    </section>
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <script>
        var colors = ['red', 'orange', 'yellow', 'olive', 'green', 'teal', 'blue', 'violet', 'purple', 'pink', 'brown', 'grey', 'black']
        var storageRef = firebase.storage().ref();
        var images = 0
        function uploadImage(event, user_id){
            event.preventDefault()
            var date = new Date()
            var mark = date.getTime()
            var metadata = {
              contentType: 'image/jpeg'
            };
            var files = document.getElementById('attachment').files
            var uploaders = []
            var names = []
            for (var i = 0; i < files.length; i++) {
                console.log(files[i].name)
                names[i] = files[i].name
                uploaders[i] = storageRef.child('attachments/'+ user_id + "/" + mark + files[i].name).put(files[i], metadata);
                
            }
            uploadRecursive(uploaders, uploaders.length, 0, names, user_id, images)
        }

        function uploadRecursive(uploaders, size, i, names, user_id, images){
            if (i >= size) {
                return
            }
            uploaders[i].on('state_changed', function(snapshot){
                }, function(error) {
                }, function() {
                    uploaders[i].snapshot.ref.getDownloadURL().then(function(downloadURL) {
                        uploadRecursive(uploaders, size, i + 1, names, user_id, images + 1)
                        var color = colors[Math.floor(Math.random() * colors.length)];
                        $("#images").append(`<a class="${color} card"><div class="image"><img src="${downloadURL}" alt="${names[i]}" style="height: 280px; width: 260px"></div></a>`)
                        $('#attachments').append(`<input type="text" name='ticket[attachments][${images}][url]' value="${downloadURL}"><input type="text" name='ticket[attachments][${images}][name]' value="${names[i]}">`)
                    });
                }
            );
        }
    </script>
@endsection