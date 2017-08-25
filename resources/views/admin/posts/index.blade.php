@extends('layouts.admin')



@section('content')
    @if(Session::has('o_user_created'))
        <div class="alert alert-success">
            <p>{{session('o_user_created')}}</p>

        </div>
    @endif
    @if(Session::has('o_user_updated'))
        <div class="alert alert-success">
            <p>{{session('o_user_updated')}}</p>

        </div>
    @endif
    @if(Session::has('o_user_delete'))
        <div class="alert alert-success">
            <p>{{session('o_user_delete')}}</p>

        </div>
    @endif
    <h1>مطالب</h1>
    <table class="table table-striped table-hover" style="direction: rtl; text-align: right">
        <thead>
        <tr>
            <th class="text-right">شماره</th>
            <th class="text-right">تصویر</th>
            <th class="text-right">عنوان</th>
            <th class="text-right">خلاصه</th>
            <th class="text-right">نویسنده</th>
            <th class="text-right">دسته بندی</th>
            <th class="text-right">ایجاد شد ه در</th>
            <th class="text-right">بروزرسانی شد ه در</th>
            <th class="text-right">ابزار ویرایش</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td><img src="{{$post->photos()->first() ? $post->photos()->first()->path : ''}}" alt="{{$post->title}}" style="height: 50px; width: 50px"></td>
                <td><a href="{{route('posts.edit', $post->id)}}">{{$post->title}}</a></td>
                <td>{{str_limit($post->body, 50, $end =' ...')}}</td>
                <td>{{$post->user->name}}</td>
                <td>{{$post->category->name}}</td>
                <td>{{$post->created_at->diffForHumans()}}</td>
                <td>{{$post->updated_at->diffForHumans()}}</td>
                <td></td>
            </tr>
        @endforeach
        </tbody>
    </table>



@endsection