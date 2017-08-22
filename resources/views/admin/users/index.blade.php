@extends('layouts.admin')

@section('content')
{{ \Carbon\Carbon::setLocale('fa') }}

    <h1>Users</h1>
      <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Id</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
                <th>status</th>
              <th>Created</th>
              <th>Updated</th>
            </tr>
          </thead>
          <tbody>
          @if($users)
               @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
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
                    </tr>
                @endforeach
          @endif
          </tbody>
        </table>
@endsection