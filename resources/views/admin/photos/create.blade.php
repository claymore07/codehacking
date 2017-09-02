@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.css">
@endsection


@section('content')
    <h1>بارگذاری تصاویر جدید</h1>
    @include('includes.includes')
    {!! Form::open(['action'=>'AdminPhotosController@store','method'=>'POST', 'files'=>true, 'class'=>'dropzone']) !!}




    {!! Form::token() !!}
    {!! Form::close() !!}
@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.js"></script>
@endsection