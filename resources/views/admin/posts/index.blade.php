@extends('layouts.admin')



@section('content')

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
            <th class="text-right">وضعیت نمایش</th>
            <th class="text-right">نظرات</th>
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
                @if($post->is_active == 0)
                    <td class="alert-danger">عدم نمایش</td>
                @else
                    <td class="alert-success">نمایش</td>
                @endif
                <td><a href="{{route('comments.show', $post->id)}}">نظرات</a></td>
                <td>{{$post->created_at->diffForHumans()}}</td>
                <td>{{$post->updated_at->diffForHumans()}}</td>
                <td>
                    {!! Form::open(['method'=>'DELETE','action'=>['AdminPostsController@destroy', $post->id],'id' => 'form-delete-posts-' . $post->id, 'style'=>'float:right']) !!}
                    <a href="" class="data-delete" data-form="posts-{{ $post->id }}" style="color: #a94442;">
                        <i class="glyphicon glyphicon-remove icon-spacer"></i></a>
                    {!! Form::close() !!}
                    <a href="{{route('home.post', $post->id)}}" style="margin-right: 10px"><i class="glyphicon glyphicon-modal-window"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

<div class="row" style="direction: ltr">
    <div class="col-sm-6 center-block">
        {{$posts->links('vendor.pagination.custom')}}
    </div>
</div>

@endsection
@section('footer')
    @if(Session::has('o_post_updated'))
        <script>
            alertify.success("{{session('o_post_updated')}}");
        </script>
        {{--<div class="alert alert-success">
            <p>{{session('o_post_updated')}}</p>

        </div>--}}
    @endif
    @if(Session::has('o_post_created'))
        <script>
            alertify.success("{{session('o_post_created')}}");
        </script>
       {{-- <div class="alert alert-success">
            <p>{{session('o_post_created')}}</p>

        </div>--}}
    @endif

    @if(Session::has('o_post_deleted'))
        <script>
            alertify.success("{{session('o_post_deleted')}}");
        </script>
        {{--<div class="alert alert-success">
            <p>{{session('o_post_deleted')}}</p>

        </div>--}}
    @endif
@endsection