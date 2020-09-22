
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
        {{-- <form action="/admin/catechild/edit/{{$cate_child->id}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
            <input name="_token" value="<?php echo csrf_token() ?>" type="hidden" />
            <div class="form-group row">
                <label class="col-2 col-form-label">Category name</label>
                <div class="col-10">
                    <input type="text" name="name" value="{{$cate_child->name}}" class="form-control" placeholder="category name...">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">Description</label>
                <div class="col-10">
                <textarea name="des"  id="" cols="81" rows="6">{{$cate_child->description}}</textarea>
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-2 col-form-label">Category</label>
                <div class="col-10">
                <select name="parent_id" class="form-control">
                <?php foreach ($cate_parent as $item) : ?>
                    <option <?php if($item->id==$cate_child->parent_id){echo 'selected';} ?>  value="<?php echo $item->id ?>"><?php echo $item->name ?></option>
                <?php endforeach; ?>
                </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-bordred waves-effect w-md waves-light m-b-5 pull-right">Update</button>
        </form> --}}


        {{ Form::model($cate_child,array('route'=> array('catechild.post_Update',$cate_child->id),'method'=>'POST')) }}
            {{Form::token()}}
            <div class="form-group row">
                {{  Form::label('name', 'User name: ',array('class' => 'col-2 col-form-label'))  }}
                <div class="col-10">
                    {{  Form::text('name',$cate_child->name, array('class' => 'form-control','placeholder'=>'User name ...'))  }} 
                </div>    
            </div>
            <div class="form-group row">
                {{  Form::label('des', 'Description: ',array('class' => 'col-2 col-form-label'))  }}
                <div class="col-10">
                    {{  Form::textarea('des',$cate_child->description, array('class' => 'form-control','row'=>'4','cols'=>'10'))  }} 
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