@extends('layouts.app') 
@section('htmlheader_title') Configuracion
@endsection
 
@section('contentheader_title')
<i class="fas fa-cogs"></i> Actualizar información
@endsection
 
@section('template_linked_css')
<!-- Css Extras -->

@endsection

@section('content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-12 col-md">
            <div class="card card-info card-outline">

                <div class="card-body" style="display: block;">
                    <h3>Ajustes</h3>
                    <p>Actualizar los datos de su empresa</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md">
            <div class="card card-info">
                <div class="card-header">
                    <div class="float-left">
                        <i class='fas fa-camera'></i> Logo de la empresa
                    </div>
                </div>
                <!-- /.box-header -->
                <div id="avatar_container">
                    <div class="card-body">
                            <div class="dz-preview"></div>
                            {!! Form::open(array('route' => ['config.upload', $configs->find(6)->id], 'method' => 'POST', 'name' => 'avatarDropzone','id' => 'avatarDropzone', 'class' => 'form single-dropzone dropzone single', 'files' => true, 'enctype' => 'multipart/form-data')) !!}
                                <img id="user_selected_config" class="user-avatar" src="@if ($configs->find(6)->val != NULL) {{ $configs->find(6)->val }} @endif" alt="{{ $configs->find(6)->name }}">
                            {!! Form::close() !!} 
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-8 col-md">
            <div class="card card-info card-outline">
                <div class="card-body">
                <form class="needs-validation" method="POST" novalidate action="{{ route('config.update') }}">
                    @csrf
                        <h4>Datos Generales:</h4>
                        <div class="form-row">
                            <div class="col-md-5 mb-3">
                                <label for="validationCustom01">Nombre de la empresa</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Nombre de la empresa" required
                                name="{{ $configs->find(1)->short }}" value="{{ $configs->find(1)->val }}">
                                <div class="invalid-feedback">
                                    Agregar nombre de la empresa
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Telefono</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="# Tel." required
                                name="{{ $configs->find(2)->short }}" value="{{ $configs->find(2)->val }}">
                                <div class="invalid-feedback">
                                    Agregar # telefono
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom03">Nombre del impuesto</label>
                                <input type="text" class="form-control" id="validationCustom03" placeholder="IVA" required
                                name="{{ $configs->find(3)->short }}" value="{{ $configs->find(3)->val }}">
                                <div class="invalid-feedback">
                                    Nombre impuesto, ejem: IVA.
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom04">Valor impuesto</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend01">%</span>
                                    </div>
                                    <input type="text" class="form-control" id="validationCustom04" placeholder="16" aria-describedby="inputGroupPrepend01" required
                                    name="{{ $configs->find(4)->short }}" value="{{ $configs->find(4)->val }}">
                                    <div class="invalid-feedback">
                                        Valor de impuesto.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom05">Moneda</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend02">Simb.</span>
                                    </div>
                                    <input type="text" class="form-control" id="validationCustom05" placeholder="$" aria-describedby="inputGroupPrepend02" required
                                    name="{{ $configs->find(5)->short }}" value="{{ $configs->find(5)->val }}">
                                    <div class="invalid-feedback">
                                        Simbolo de la moneda.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button class="btn btn-primary" type="submit">Actualizar datos</button>
                    </form>

                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('footer_scripts')
<!-- Scripts Extras -->
    @include('scripts.image_config_dz')

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
            }, false);
        });
        }, false);
    })();

    </script>
@endsection