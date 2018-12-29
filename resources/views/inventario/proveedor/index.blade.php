@extends('layouts.app')

@section('htmlheader_title')
    Proveedores
@endsection

@section('contentheader_title')
    <i class="fa fa-list"></i> Listas de proveedores
@endsection
@section('breadcrumbs')
    {{ Breadcrumbs::render('proveedor') }}
@endsection

@section('template_linked_css')
  <!-- Css Extras -->
@endsection

@section('content')
    <div class="container-fluid spark-screen">
       <newuser></newuser>
    </div>
@endsection

@section('footer_scripts')
<!-- Scripts Extras -->
@endsection
