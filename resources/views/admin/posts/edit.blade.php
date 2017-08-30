@extends('layouts.admin')



@section('content')
    <h1>ویرایش مطلب</h1>
    <div class="col-sm-3 col-sm-push-9">

        <img src="{{$post->photos()->first()->path}}" alt="{{$post->title}}" class="img-responsive img-circle">
    </div>
    <div class="col-sm-9 col-sm-pull-3">
        @include('includes.includes')

        {!! Form::model($post,['action'=>['AdminPostsController@update', $post->id], 'method'=>'PUT', 'files'=>true]) !!}

        <div class="form-group">
            {!! Form::label('title', 'عنوان') !!}
            {!! Form::text('title', null, [ 'class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('body', 'متن') !!}
            {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>4]) !!}
        </div>
        <div class="form-group" style="direction: ltr">
            {!! Form::label('file', 'تصویر مطلب') !!}
            {!! Form::file('file', ['class'=>'form-control filestyle', 'data-buttonText'=>'انتخاب تصویر','data-buttonBefore'=>'true', 'data-buttonName'=>'btn-primary']) !!}
        </div>
        <div class="form-group">
            {{$post->category->id}}
            {!! Form::label('category_id', 'گروه مربوط به مطلب') !!}
            {!! Form::select('category_id', []+$categories, null, ['placeholder' => 'گروه مورد نظر را انتخاب کنید...','class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('is_active', 'وضعیت نمایش') !!}
            <br>
            <span>نمایش</span>{!! Form::radio('is_active', 1, false,['class'=>'form-control']) !!}
            <span>عدم نمایش</span>{!! Form::radio('is_active', 0 , true, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group text-center">
            {!! Form::token() !!}
            {!! Form::submit('ایجاد مطلب جدید', ['class'=>'btn btn-primary  pull-right']) !!}
            {!! Form::reset('شروع مجدد', ['class'=>'btn btn-warning  pull-right', 'style'=>'margin:0 20px']) !!}
        </div>
        {!! Form::close() !!}
        {!! Form::open(['method'=>'DELETE','action'=>['AdminPostsController@destroy', $post->id],'class'=>' pull-right']) !!}


        <div class="form-group">
            {!! Form::token() !!}
            {!! Form::submit('حذف پست', ['class'=>'btn btn-danger']) !!}
        </div>
        {!! Form::close() !!}
        </div>
    </div>
@endsection