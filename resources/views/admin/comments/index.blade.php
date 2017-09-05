@extends('layouts.admin')




@section('content')
    <h1>نظرات</h1>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th class="text-right">ID</th>
            <th class="text-right">نویسنده</th>
            <th class="text-right">عنوان پست</th>
            <th class="text-right">نظر</th>
            <th class="text-right">مشاهده پاسخ ها</th>
            <th class="text-right">وضعیت</th>
            <th class="text-right">ایجاد شده در</th>
            <th class="text-right">ابزار ویرایش</th>
        </tr>
        </thead>
        @if(count($comments)>0)
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->user->name}}</td>
                    <td><a href="{{route('home.post', $comment->post->slug)}}">{{$comment->post->title}}</a></td>

                    <td><a href="{{route('comments.edit', $comment->id)}}">{{str_limit($comment->body, 50, $end =' ...')}}</a></td>
                    <td><a href="{{route('replies.show', $comment->id)}}">پاسخ ها</a></td>
                    <td>
                    @if($comment->is_active == 1)
                        {!! Form::open(['method'=>'PUT', 'action'=>['PostsCommentsController@update', $comment->id]]) !!}
                        {!! Form::hidden('is_active', 0) !!}
                        {!! Form::token() !!}
                        {!! Form::submit('عدم نمایش',['class'=>'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @else
                            {!! Form::open(['method'=>'PUT', 'action'=>['PostsCommentsController@update', $comment->id]]) !!}
                            {!! Form::hidden('is_active', 1) !!}
                            {!! Form::token() !!}
                            {!! Form::submit('نمایش نظر',['class'=>'btn btn-success']) !!}
                            {!! Form::close() !!}
                    @endif
                    </td>
                    <td>{{$comment->created_at->diffForHumans()}}</td>

                    <td>
                        {!! Form::open(['method'=>'DELETE','action'=>['PostsCommentsController@destroy', $comment->id],'id' => 'form-delete-comments-' . $comment->id, 'style'=>'float:right']) !!}
                        <a href="" class="data-delete" data-form="comments-{{ $comment->id }}">
                            <i class="glyphicon glyphicon-remove icon-spacer" style="color: #a94442;"></i></a>
                        {!! Form::close() !!}
                        <a href="{{route('comments.edit', $comment->id)}}" style="margin: 10px">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </a>

                    </td>
                </tr>
            @endforeach
            </tbody>
            @else
            <tr>
                <td colspan="7">
                    <h3 class="text-center">نظری ثبت نشده است!</h3>
                </td>
            </tr>
        @endif
    </table>



@endsection
@section('footer')
    @if(Session::has('o_comment_approval'))
        <script>
            alertify.success("{{session('o_comment_approval')}}");
        </script>
    @endif


    @if(Session::has('o_comment_deleted'))
        <script>
            alertify.success("{{session('o_comment_deleted')}}");
        </script>

    @endif
@endsection