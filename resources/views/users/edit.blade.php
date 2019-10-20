@extends('layouts.app')
@section('content')
    <section class="container">
        <h2 class="ui center aligned icon header">
            <i class="circular users icon"></i>
            Editar la informacion del usuario
        </h2>
        <div class="ui divider"></div>
        <div class="ui grid">
            <div class="four wide column">
                <div class="ui fluid card">
                    <div class="image">
                        <img id='img-user' src="{{ $user->photo }}" alt="{{ $user->name }}" style='width: 100%; height: 300px;'>
                        <div class="disappear">
                            <label for="raton">
                                <i class="edit icon big"></i>
                                <input style='display: none' id='raton' type="file" name="user[photo]" data-id="{{ $user->id }}">
                            </label>
                        </div>
                    </div>
                    <div class="content">
                        <a>{{ $user->name }}</a>
                    </div>
                </div>
            </div>
            <div class="eight wide column">
                <form id='form' method="POST" action="{{ url("users/{$user->id}") }}" class="ui form">
                    @method('patch')
                    {{ csrf_field() }}
                    <h4 class='ui dividing header'>Informacion del usuario</h4>
                    <div class='field'>
                        <label for="">Name</label>
                        <input type="text" name='user[name]' placeholder="Jose Arturo" value="{{ $user->name }}">
                    </div>
                    <div class="field">
                        <label for="">Rol</label>
                        <select class="ui fluid search dropdown" name="user[role_id]" id="" required>
                            <option value="">Seleccione una opcion</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{$user->role->id == $role->id ? "selected" : ""}}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class='field'>
                        <label for="">Descripcion de mi trabajo</label>
                        <textarea name="user[description]" rows="2">{{ $user->description}}</textarea>
                    </div>
                    <input style="display: none" type="text" name="user[photo]" id="user[photo]" value="{{ $user->photo }}">    
                    <button class="ui button" type="submit">Actualizar</button>
                </form>
            </div>  
        </div>
    </section>
    <script>
        var photo = document.getElementById('raton')
        var storageRef = firebase.storage().ref();
        photo.addEventListener('change', function(){
            console.log(this.dataset.id)
            var file = photo.files[0]
            var metadata = {
              contentType: 'image/jpeg'
            };
            // Upload file and metadata to the object 'images/mountains.jpg'
            var uploadTask = storageRef.child('users/' + this.dataset.id).put(file, metadata);
            uploadTask.on('state_changed', function(snapshot){
                }, function(error) {
                    console.log('ocurrio un error')
                }, function() {
                    uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
                        var userPhoto = document.getElementById("user[photo]")
                        userPhoto.value = downloadURL
                        document.getElementById('form').submit()
                    });
                }
            );
        })
    </script>
@endsection
