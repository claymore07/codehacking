@extends('layouts.blog-post')


@section('content')

    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        نوشته شده توسط: <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> نوشته شده در: {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive center-block" src="{{$post->photos()->first()->path}}" alt="{{$post->title}}"
         style="width: 50%; height: 50%;">

    <hr>

    <!-- Post Content -->
    <p class="lead text-justify">
        {{$post->body}}
    </p>
    <hr>

    @if(Session::has('comment_result'))
        <div class="well  alert-success">
            <h4>
                {{session('comment_result')}}
            </h4>
        </div>
    @endif
    <!-- Blog Comments -->

    <!-- Comments Form -->
    @if(Auth::user())
        <div class="well">

            {!! Form::open(['action'=>'PostsCommentsController@store','method'=>'POST']) !!}
            {!! Form::hidden('post_id', $post->id) !!}

            <div class="form-group">
                {!! Form::label('body','نظر شما:') !!}
                {!! Form::textarea('body',null,['class'=>'form-control', 'rows'=>2]) !!}
            </div>
            <div class="form-group">
                {!! Form::token() !!}
                {!! Form::submit('ثبت نظر',['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>

        </div>
    @else
        <div class="well  alert-info">
            <h4>برای ثبت نظر وارد سایت شوید.</h4>
        </div>
    @endif

    <hr>

    <!-- Posted Comments -->
    @if(count($comments)>0)
        <!-- Comment -->
        @foreach($comments as $comment)
            <div class="media" style="direction: rtl">
                <a class="pull-right" href="#">
                    <img class="media-object" src="{{$comment->user->gravatar}}"
                         alt="{{$comment->user->name}}" style="height: 64px; width: 64px">
                </a>
                <div class="media-body">
                    <h4 class="media-heading text-right">نوشته شده توسط: {{$comment->user->name}}

                    </h4>
                    <small>{{$comment->created_at->diffForHumans()}}</small>
                    <p class="text-justify">
                        {{$comment->body}}
                    </p>
                    <!-- Nested Comment -->
                    <div class="media">

                        @if(count($comment->replies()->whereIsActive(1)->get()))
                            @foreach($comment->replies()->whereIsActive(1)->get() as $reply)
                                <a class="pull-right" href="#">
                                    <img class="media-object" src="{{$reply->user->photos()->first()->path}}" \
                                         alt="{{$reply->user->name}}" style="height: 64px; width: 64px">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading text-right">نوشته شده توسط: {{$reply->user->name}}

                                    </h4>
                                    <small>{{$reply->created_at->diffForHumans()}}</small>
                                    <p class="text-justify">
                                        {{$reply->body}}
                                    </p>
                                </div>
                            @endforeach
                        @endif
                        <div class="comment-reply-container">
                            <button class="toggle-reply btn btn-primary pull-left">ارسال پاسخ</button>
                            <div class="clearfix"></div>
                            <div class="comment-reply" style="margin-top: 20px">
                                @if(Auth::user())
                                    {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}
                                    {!! Form::hidden('comment_id',$comment->id) !!}
                                    {!! Form::hidden('post_id', $post->id) !!}
                                    <div class="form-group">
                                        {!! Form::textarea('body', null,['class'=>'form-control','rows'=>2, 'placeholder'=>'ارسال پاسخ به نظر...']) !!}
                                    </div>
                                    <div class="from-group">
                                        {!! Form::submit('ارسال پاسخ', ['class'=>'btn btn-primary']) !!}
                                    </div>
                                    {!! Form::token() !!}
                                    {!! Form::close() !!}
                                @else
                                    <div class=" text-info">
                                        <h5>برای ارسال پاسخ وارد سایت شوید.</h5>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- End Nested Comment -->
                </div>
            </div>
        @endforeach
    @else
        <div class="media">
            <h5>تا کنونی نظری ثبت نشده است!</h5>
        </div>
    @endif

@endsection

@section('categories')
    <?php
    $categories->forget(0);

    ?>
    <div class="col-lg-6 col-lg-push-6" style="direction: rtl">
        <ul class="list-unstyled">
            @foreach($categories as $category)


                <li><a href="#">{{$category->name}}</a>
                </li>

            @endforeach
        </ul>
    </div>
@endsection

@section('footer')sadas
    @if(Session::has('reply_result'))
        <script>
            alertify.success("{{session('reply_result')}}");
        </script>

    @endif
<script>
    $(".toggle-reply").click(function () {
        console.log('fuck')
        $(this).next().next().slideToggle("slow");

    });
</script>
@endsection