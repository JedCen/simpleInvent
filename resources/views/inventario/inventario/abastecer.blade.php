@extends('layouts.app')

@section('htmlheader_title')
    Abastecer
@endsection

@section('contentheader_title')
    <i class="fa fa-history"></i> Abastecer
@endsection

@section('content')

<div class="card panel-primary @role('admin', true) panel-info  @endrole">
    <div class="card-header">
        Bienvenido {{ Auth::user()->name }}
        <div class="float-right">
            @role('admin', true)
                <span class="label label-info">
                Admin Access
                </span>
            @else
                <span class="label label-warning">
                User Access
                </span>
            @endrole
        </div>
    </div>
    <div class="card-body">
        <stockup></stockup>
    </div>
</div>

@endsection
