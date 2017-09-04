@extends('layouts.admin')




@section('content')
    <h1>پاسخ ها</h1>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th class="text-right">ID</th>
            <th class="text-right">نویسنده</th>
            <th class="text-right">عنوان پست</th>
            <th class="text-right">نظر</th>
            <th class="text-right">پاسخ ارسال شده</th>
            <th class="text-right">وضعیت</th>
            <th class="text-right">ایجاد شده در</th>
            <th class="text-right">ابزار ویرایش</th>
        </tr>
        </thead>
        @if(count($replies)>0)
            <tbody>
            @foreach($replies as $reply)
                <tr>
                    <td>{{$reply->id}}</td>
                    <td>{{$reply->user->name}}</td>
                    <td><a href="{{route('home.post', $reply->post->id)}}">{{$reply->post->title}}</a></td>

                    <td><a href="{{route('comments.edit', $reply->comment->id)}}">{{str_limit($reply->comment->body, 50, $end =' ...')}}</a></td>
                    <td><a href="{{route('replies.edit', $reply->id)}}">{{str_limit($reply->body, 50, $end =' ...')}}</a></td>
                    <td>
                        @if($reply->is_active == 1)
                            {!! Form::open(['method'=>'PUT', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}
                            {!! Form::hidden('is_active', 0) !!}
                            {!! Form::token() !!}
                            {!! Form::submit('عدم نمایش',['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @else
                            {!! Form::open(['method'=>'PUT', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}
                            {!! Form::hidden('is_active', 1) !!}
                            {!! Form::token() !!}
                            {!! Form::submit('نمایش نظر',['class'=>'btn btn-success']) !!}
                            {!! Form::close() !!}
                        @endif
                    </td>
                    <td>{{$reply->created_at->diffForHumans()}}</td>

                    <td>
                        {!! Form::open(['method'=>'DELETE','action'=>['CommentRepliesController@destroy', $reply->id],'id' => 'form-delete-replies-' . $reply->id, 'style'=>'float:right']) !!}
                        <a href="" class="data-delete" data-form="replies-{{ $reply->id }}">
                            <i class="glyphicon glyphicon-remove icon-spacer" style="color: #a94442;"></i></a>
                        {!! Form::close() !!}
                        <a href="{{route('replies.edit', $reply->id)}}" style="margin: 10px">
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
    @if(Session::has('o_reply_approval'))
        <script>
            alertify.success("{{session('o_reply_approval')}}");
        </script>
    @endif


    @if(Session::has('o_reply_deleted'))
        <script>
            alertify.success("{{session('o_reply_deleted')}}");
        </script>

    @endif
@endsection