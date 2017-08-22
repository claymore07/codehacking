@extends('layouts.admin')


@section('content')

    <h1>ایجاد کاربر جدید</h1>
    @include('includes.includes')

    {!! Form::open(['action'=>'AdminUsersController@store','method'=>'POST', 'files'=>true]) !!}

    <div class="form-group">
        {!! Form::label('name', 'نام') !!}
        {!! Form::text('name', null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email', 'ایمیل') !!}
        {!! Form::email('email', null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('password', 'کلمه عبور') !!}
        {!! Form::password('password',['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('role_id', 'نقش') !!}
        {!! Form::select('role_id', []+ $roles,
            null, ['placeholder' => 'نقش مورد نظر را انتخاب کنید...', 'class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('file', 'ایمیل') !!}
        {!! Form::file('file', ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('is_active', 'ایمیل') !!}<br>
        <span> فعال</span>{!! Form::radio('is_active', '1', false, ['class'=>'form-control'])  !!}<br/>
        <span> غیر فعال</span>{!! Form::radio('is_active', '0', true, ['class'=>'form-control'])  !!}
    </div>
    <div class="form-group">
        {!! Form::token() !!}
        {!! Form::submit('ایجاد کاربر جدید', ['class'=>'btn btn-primary']) !!}
        {!! Form::reset('پاک کردن', ['class'=>'btn btn-danger']) !!}
    </div>
    {!! Form::close() !!}

@endsection