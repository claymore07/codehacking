@extends('layouts.admin')

@section('content')


    <h1>کاربران</h1>
    <table class="table table-striped table-hover " style="direction: rtl; text-align: right">
        <thead>
        <tr>
            <th class="th-right">Id</th>
            <th class="th-right">تصویر</th>
            <th class="th-right">متعلق به</th>
            <th class="th-right">ایجاد شده در</th>
            <th class="th-right">بروزرسانی شده در</th>
            <th class="th-right">ویرایش</th>
        </tr>
        </thead>
        <tbody>
        @if($photos)
            @foreach($photos as $photo)
                <tr>

                    <td>{{ $photo->id }}</td>
                    <td><img src="{{$photo->path}}" style="width: 50px; height: 50px;"></td>
                    <td><a href="{{route('users.edit', $photo->id)}}">
                                @if( $photo->photoable_type == 'App\User')
                                    {{ $photo->photoable['name'] }}
                                    @else
                                {{ $photo->photoable['title'] }}
                            @endif

                        </a>

                    </td>

                    <td>{{ $photo->created_at? $photo->created_at->diffForHumans():'تاریخ ایجاد ندارد' }}</td>
                    <td>{{ $photo->updated_at?$photo->updated_at->diffForHumans():'تاریخ بروزرسانی ندارد' }}</td>
                    <td>{!! Form::open(['method'=>'DELETE','action'=>['AdminPhotosController@destroy', $photo->id],'id' => 'form-delete-photos-' . $photo->id]) !!}
                        <a href="" class="data-delete" data-form="photos-{{ $photo->id }}">
                            <i class="glyphicon glyphicon-remove icon-spacer"></i></a>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@endsection
@section('footer')
    @if(Session::has('o_user_updated'))
        <script>
            alertify.success("{{session('o_user_updated')}}");
        </script>
        {{--<div class="alert alert-success">
            <p>{{session('o_post_updated')}}</p>

        </div>--}}
    @endif
    @if(Session::has('o_user_created'))
        <script>
            alertify.success("{{session('o_user_created')}}");
        </script>
        {{-- <div class="alert alert-success">
             <p>{{session('o_post_created')}}</p>

         </div>--}}
    @endif

    @if(Session::has('o_user_deleted'))
        <script>
            alertify.success("{{session('o_user_deleted')}}");
        </script>
        {{--<div class="alert alert-success">
            <p>{{session('o_post_deleted')}}</p>

        </div>--}}
    @endif
@endsection