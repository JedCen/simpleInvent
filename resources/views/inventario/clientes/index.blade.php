@extends('layouts.app')

@section('htmlheader_title')
    Clientes
@endsection

@section('contentheader_title')
    <i class='fa fa-user'></i> Lista de clientes
@endsection
@section('breadcrumbs')
    {{ Breadcrumbs::render('cliente') }}
@endsection

@section('template_linked_css')
  <!-- Css Extras -->
@endsection

@section('content')
    <newcliente></newcliente>
@endsection

@section('footer_scripts')
<!-- Scripts Extras -->
@endsection
