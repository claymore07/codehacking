@extends('layouts.admin')




@section('content')
    <h1>ایجاد دسته جدید</h1>
    @include('includes.includes')
    {!! Form::open(['action'=>'AdminCategoriesController@store','method'=>'POST']) !!}


    <div class="form-group">
        {!! Form::label('name','نام دسته') !!}
        {!! Form::text('name', null,[ 'class'=>'form-control']) !!}
    </div>
    <div class="form-group text-center">
        {!! Form::submit('ایجاد دسته جدید', ['class'=>'btn btn-primary']) !!}
        {!! Form::reset('شروع مجدد', ['class'=>'btn btn-warning']) !!}
    </div>
    {!! Form::token() !!}
    {!! Form::close() !!}
@endsection