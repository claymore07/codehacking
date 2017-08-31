@extends('layouts.admin')



@section('content')
    <h1>دسته های مطالب</h1>
    <table class="table table-striped table-hover" style="direction: rtl; text-align: right">
        <thead>
        <tr>
            <th class="text-right">شماره</th>

            <th class="text-right">عنوان دسته</th>

            <th class="text-right">ایجاد شد ه در</th>
            <th class="text-right">بروزرسانی شد ه در</th>
            <th class="text-right">ابزار ویرایش</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td><a href="{{route('categories.edit', $category->id)}}">{{$category->name}}</a></td>


                <td>{{$category->created_at->diffForHumans()}}</td>
                <td>{{$category->updated_at->diffForHumans()}}</td>
                <td>
                    {!! Form::open(['method'=>'DELETE','action'=>['AdminCategoriesController@destroy', $category->id],'id' => 'form-delete-categories-' . $category->id]) !!}
                    <a href="" class="data-delete" data-form="categories-{{ $category->id }}">
                        <i class="glyphicon glyphicon-remove icon-spacer"></i></a>
                    {!! Form::close() !!}

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
@section('footer')
    @if(Session::has('o_category_updated'))
        <script>
            alertify.success("{{session('o_category_updated')}}");
        </script>
        {{--<div class="alert alert-success">
            <p>{{session('o_post_updated')}}</p>

        </div>--}}
    @endif
    @if(Session::has('o_category_created'))
        <script>
            alertify.success("{{session('o_category_created')}}");
        </script>
        {{-- <div class="alert alert-success">
             <p>{{session('o_post_created')}}</p>

         </div>--}}
    @endif

    @if(Session::has('o_category_deleted'))
        <script>
            alertify.success("{{session('o_category_deleted')}}");
        </script>
        {{--<div class="alert alert-success">
            <p>{{session('o_post_deleted')}}</p>

        </div>--}}
    @endif
@endsection