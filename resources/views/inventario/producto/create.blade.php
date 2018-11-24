@extends('layouts.app')
@section('htmlheader_title') Producto
@endsection

@section('contentheader_title') Nuevo producto
@endsection

@section('template_linked_css')
<!-- Css Extras -->
@endsection

@section('content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-6 offset-md-3">

            <div class="card panel-info">
                <div class="card-header">
                    <div class="float-left">
                            <h4><i class='fab fa-product-hunt'></i> Nuevo producto</h4>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-adn" href="{{ route('producto.index') }}">Cancelar</a>
                </div>
                </div>
                <div class="card-body">
                    @if (session('info'))
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="alert alert-success">
                                    {{ session('info') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif 
                        {!! Form::open(['route' => 'producto.store', 'files' => true, 'enctype' => 'multipart/form-data', 'id'=>'uploadForm']) !!}
                            
                            @include('inventario.producto.partials.form') 
                            <div class="form-group">
                                {{ Form::label('q', 'Cantidad actual de producto') }} {{ Form::number('q', null, ['class' => 'form-control col-md-6', 'id' => 'q',
                                'placeholder' => 'Cantidad actual de producto']) }}
                                <small class="form-text text-danger"> {{ $errors->first('q') }}</small>
                            </div>
                            <div class="form-group">
                                {{ Form::submit('Agregar Producto', ['class' => 'btn btn-sm btn-primary']) }}
                            </div>
                        {!! Form::close() !!}
                </div>
                <!-- /.box-body -->
            </div>

        </div>
    </div>
</div>
@endsection

@section('footer_scripts')
<!-- Scripts Extras -->
    <script>
    function readURL(input) {

    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
    }

    $("#image").change(function() {
    readURL(this);
    });
    </script>

@endsection
