@extends('layouts.app')

@section('htmlheader_title')
    about
@endsection

@section('contentheader_title')
    Editar Producto
@endsection

@section('breadcrumbs_info')
  
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
                                <h4><i class='fa fa-edit'></i> Editar producto</h4>
                        </div>
                        <div class="float-right">
                                <a class="btn btn-adn" href="{{ URL::previous() }}">Cancelar</a>
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
                        @if(count($errors))
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8 ">
                                        <div class="alert alert-warning">
                                            <p>Corrige los siguientes errores:</p>
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div id="avatar_container">
                            <div class="card-body">
                                <div class="dz-preview"></div>
                                {!! Form::open(array('route' => ['producto.upload', $products->id], 'method' => 'POST', 'name' => 'avatarDropzone','id' => 'avatarDropzone', 'class' => 'form single-dropzone dropzone single', 'files' => true, 'enctype' => 'multipart/form-data')) !!}
                                    <img id="user_selected_product" class="user-avatar" src="@if ($products->image != NULL) {{ $products->image }} @endif" alt="{{ $products->name }}">
                                {!! Form::close() !!} 
                            </div>
                        </div>
                                {!! Form::model($products, ['route' => ['producto.update', $products->id], 'method' => 'PUT', 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}
                                    @include('inventario.producto.partials.form')
                                    <div class="form-group">
                                        {{ Form::submit('Actualizar producto', ['class' => 'btn btn-sm btn-primary']) }}
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
@include('scripts.image_product_dz')
@endsection
