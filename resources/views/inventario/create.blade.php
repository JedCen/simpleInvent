@extends('layouts.app')
@section('htmlheader_title') Venta
@endsection

@section('contentheader_title') Nueva venta
@endsection


@section('template_linked_css')
<!-- Css Extras -->
@endsection

@section('content') @php $levelAmount = 'level'; if (Auth::User()->level() >= 2) { $levelAmount = 'levels';
}
@endphp


<div class="card panel-info">
    <div class="card-header">
        <div class="float-left">
            <i class="fab fa-buysellads"></i> Nueva Venta
        </div>
    </div>
    <div class="card-body">
        <venta-up></venta-up>
    </div>
</div>
@endsection

@section('footer_scripts')
<!-- Scripts Extras -->
@endsection
