@extends('layouts.app') 
@section('htmlheader_title') Reportes
@endsection
 
@section('contentheader_title')
<i class="fas fa-cogs"></i> Actualizar información
@endsection
 
@section('template_linked_css')
<!-- Css Extras -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
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
                <div class="card-body">
                    <div class="dz-preview"></div>
                    {!! Form::open(array('route' => ['producto.upload', $products->id], 'method' => 'POST', 'name' => 'avatarDropzone','id' => 'avatarDropzone', 'class' => 'form single-dropzone dropzone single', 'files' => true, 'enctype' => 'multipart/form-data')) !!}
                        <img id="user_selected_product" class="user-avatar" src="@if ($products->image != NULL) {{ $products->image }} @endif" alt="{{ $products->name }}">
                    {!! Form::close() !!}
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-8 col-md">
            <div class="card card-info card-outline">
                <div class="card-body">
                    <form class="needs-validation" novalidate>
                        <h4>Datos Generales:</h4>
                        <div class="form-row">
                            <div class="col-md-5 mb-3">
                                <label for="validationCustom01">Nombre de la empresa</label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Nombre de la empresa" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Telefono</label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="# Tel." required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom03">Nombre del impuesto</label>
                                <input type="text" class="form-control" id="validationCustom03" placeholder="IVA" required>
                                <div class="invalid-feedback">
                                    Please provide a valid city.
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom04">Valor impuesto</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">%</span>
                                    </div>
                                    <input type="text" class="form-control" id="validationCustom04" placeholder="16" aria-describedby="inputGroupPrepend" required>
                                    <div class="invalid-feedback">
                                        Please choose a username.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustomUsername">Moneda</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend">Simb.</span>
                                    </div>
                                    <input type="text" class="form-control" id="validationCustomUsername" placeholder="$" aria-describedby="inputGroupPrepend"
                                        required>
                                    <div class="invalid-feedback">
                                        Please choose a username.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h4>Datos para ticket:</h4>
                        <div class="form-row">
                            <div class="col-md-5 mb-3">
                                <label for="validationCustom05">Titulo en el Ticket</label>
                                <input type="text" class="form-control" id="validationCustom05" placeholder="Titulo en el Ticket " required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom06">Texto arriba</label>
                                <input type="text" class="form-control" id="validationCustom06" placeholder="Titulo en el Ticket " required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom07">Texto abajo</label>
                                <textarea class="form-control" id="validationCustom07" rows="3" placeholder="Titulo en el Ticket " required></textarea>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
    $('#validationCustom06').summernote({
        tabsize: 4,
        height: 200
    });
    $('#validationCustom07').summernote({
        tabsize: 4,
        height: 200
    });
    </script>
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