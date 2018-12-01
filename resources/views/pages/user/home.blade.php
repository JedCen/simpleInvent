@extends('layouts.app')

@section('htmlheader_title')
    {{ Auth::user()->name }}'s' Homepage
@endsection

@section('template_fastload_css')
@endsection

@section('contentheader_title')
<i class="fas fa-tachometer-alt"></i> Panel de control
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10 offset-lg-1">

                

            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
@endsection
