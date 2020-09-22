@extends('admins/layouts/master')
@section("content")
<div class="row " >
    <div class="col-8  mt-auto">
        @if (isset($errors) && count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- <form action="/admin/category/edit/{{$cate->id}}" method="POST" class="form-horizontal">
            <input name="_token" value="<?php echo csrf_token() ?>" type="hidden" />
            <div class="form-group row">
                <label class="col-2 col-form-label">Category name</label>
                <div class="col-10">
                <input type="text" name="name" value="{{$cate->name}}" class="form-control" placeholder="category name...">
                </div>
            </div>                        
            <button type="submit" class="btn btn-success btn-bordred waves-effect w-md waves-light m-b-5 pull-right">Update</button>
        </form> --}}
        {{ Form::model($cate,array('route'=> array('cate.post_Update',$cate->id),'method'=>'POST')) }}
            {{Form::token()}}
            <div class="form-group row">
                {{  Form::label('name', 'Category name: ',array('class' => 'col-2 col-form-label'))  }}
                <div class="col-10">
                    {{  Form::text('name',$cate->name, array('class' => 'form-control','placeholder'=>'Category name ...'))  }} 
                </div>    
            </div>
        {{Form::submit('Click Me!')}}
        {{ Form::close() }}
    </div>
</div>
@endsection