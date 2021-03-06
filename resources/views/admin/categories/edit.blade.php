@extends('layouts.admin')




@section('content')
    {{session('test')}}
    <h1>ویرایش دسته</h1>
    @include('includes.includes')
    {!! Form::model($category,['action'=>['AdminCategoriesController@update', $category->id],'method'=>'PATCH']) !!}


    <div class="form-group">
        {!! Form::label('name','نام دسته') !!}
        {!! Form::text('name', null,[ 'class'=>'form-control']) !!}
    </div>
    <div class="form-group text-center">
        {!! Form::submit('ویرایش دسته', ['class'=>'btn btn-primary']) !!}
        {!! Form::reset('شروع مجدد', ['class'=>'btn btn-warning']) !!}
    </div>
    {!! Form::token() !!}
    {!! Form::close() !!}
@endsection