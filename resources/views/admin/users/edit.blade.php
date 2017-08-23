@extends('layouts.admin')


@section('content')

    <h1>ویرایش کاربر</h1>
    <div class="col-sm-3 col-sm-push-9">

        <img src="{{$user->photo->path}}" alt="{{$user->name}}"  class="img-responsive img-circle">
    </div>
    <div class="col-sm-9 col-sm-pull-3">
        @include('includes.includes')

        {!! Form::model($user, ['action'=>['AdminUsersController@update', $user->id],'method'=>'PUT', 'files'=>true]) !!}

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
            {!! Form::submit('ویرایش کاربر ', ['class'=>'btn btn-primary']) !!}
            {!! Form::reset('پاک کردن', ['class'=>'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection