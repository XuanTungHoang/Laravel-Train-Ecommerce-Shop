
@extends('admins/layouts/master')
@section("content")
<div class="row " >
    <div class="col-8  mt-auto">
        @if (isset($errors) && count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- <form action="{{action("CateChildController@post_Create")}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
            <input name="_token" value="<?php echo csrf_token() ?>" type="hidden" />
            <div class="form-group row">
                <label class="col-2 col-form-label">Categoty name</label>
                <div class="col-10">
                    <input type="text" name="name" value="{{old("name")}}" class="form-control" placeholder="category name...">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">Description</label>
                <div class="col-10">
                <textarea name="des"  id="" cols="81" rows="6">{{old("des")}}</textarea>
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-2 col-form-label">Category parent</label>
                <div class="col-10">
                <select name="parent_id" class="form-control">
                <?php foreach ($cate_parent as $item) : ?>
                    <option  value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
                <?php endforeach; ?>
                </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-bordred waves-effect w-md waves-light m-b-5 pull-right">Create</button>
        </form> --}}


        {{ Form::model($cate_child,array('action'=>array('CateChildController@post_Create',$cate_child->id),'method'=>'POST')) }}
        {{Form::token()}}
        <div class="form-group row">
            {{  Form::label('name', 'Categoty name: ',array('class' => 'col-2 col-form-label'))  }}
            <div class="col-10">
                {{  Form::text('name',null, array('class' => 'form-control','placeholder'=>'Category name ...'))  }} 
            </div>    
        </div>
        <div class="form-group row">
            {{  Form::label('des', 'Description: ',array('class' => 'col-2 col-form-label'))  }}
            <div class="col-10">
                {{  Form::textarea('des',null, array('class' => 'form-control','row'=>'4','cols'=>'10'))  }} 
            </div>    
        </div>
        
        <div class="form-group row">
            {{  Form::label('parent_id', 'Category: ',array('class' => 'col-2 col-form-label'))  }}
            <div class="col-10">
                {{  Form::select('parent_id', $cate_parent,null,array('class'=>'form-control'))  }} 
            </div>    
        </div>
        {{Form::submit('Click Me!')}}
        {{ Form::close() }}
    </div>
</div>
@endsection