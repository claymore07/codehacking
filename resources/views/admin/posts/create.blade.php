@extends('layouts.admin')



@section('content')
    <h1>انتشار مطلب جدید</h1>
    @include('includes.includes')

    {!! Form::open(['action'=>'AdminPostsController@store', 'method'=>'POST', 'files'=>true]) !!}

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
        {!! Form::submit('ایجاد مطلب جدید', ['class'=>'btn btn-primary']) !!}
        {!! Form::reset('شروع مجدد', ['class'=>'btn btn-warning']) !!}
    </div>
@endsection