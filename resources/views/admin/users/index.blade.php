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
    <h1>کاربران</h1>
      <table class="table table-striped table-hover " style="direction: rtl; text-align: right">
          <thead>
            <tr>
                <th class="th-right">Id</th>
                <th class="th-right">تصویر</th>
                <th class="th-right">نام</th>
                <th class="th-right">رایان نامه</th>
                <th class="th-right">نقش</th>
                <th class="th-right">وضعیت</th>
                <th class="th-right">ایجاد شده در</th>
                <th class="th-right">بروزرسانی شده در</th>
                <th class="th-right">ویرایش</th>
            </tr>
          </thead>
          <tbody>
          @if($users)
               @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><img src="{{$user->photo ? $user->photo->path: ''}}" style="width: 50px; height: 50px;"></td>
                        <td><a href="{{route('users.edit', $user->id)}}">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>
                            {{$user->is_active == 1 ? 'فعال': 'غیرفعال'}}
                       {{--     @if($user->is_active == 1)
                                فعال
                            @else
                            غیر فعال
                            @endif--}}
                        </td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                        <td>{{ $user->updated_at->diffForHumans() }}</td>
                        <td><a href="{{route('users.destroy', $user->id)}}"><i class="fa fa-times alert-danger"></i> </a></td>
                    </tr>
                @endforeach
          @endif
          </tbody>
        </table>
@endsection