@extends('layouts.app')

@section('content')
    <section class='container'>
        <h1>Crear un nuevo Ticket para el problema</h1>
        <form method="POST" action="{{ url('tickets')}}" style="background: #fff;">
            {{ csrf_field() }}
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="title">Titulo del problema</label>
                    <input name='ticket[title]' type="text" class="form-control" id="title" placeholder="No funciona el...">
                </div>
            </div>
            <div class="form-group">
                <label for="description">Descripcion del problema</label>
                <textarea name="ticket[description]" id="description" rows="5" placeholder="Ayer tube un problema con..." class='form-control'></textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="product">Aparato</label>
                    <select name="ticket[product_id]" class="form-control" id='product'>
                        @foreach ($products as $product)
                            <option value="{{$product->id}}">{{ $product->name }}</option>   
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="type">Tipo de aparato</label>
                    <select name="ticket[type_id]" class="form-control" id="type">
                        @foreach ($types as $type)
                            <option value="{{$type->id}}">{{ $type->name }}</option>   
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="priority">Prioridad</label>
                    <select name="ticket[priority_id]" class="form-control" id="type">
                        @foreach ($priorities as $priority)
                            <option value="{{$priority->id}}">{{ $priority->name }}</option>   
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
    </section>
    
@endsection