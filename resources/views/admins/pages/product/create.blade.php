
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
        {{-- <form action="{{action("ProductController@post_Create")}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
            <input name="_token" value="<?php echo csrf_token() ?>" type="hidden" />
            <div class="form-group row">
                <label class="col-2 col-form-label">Product name</label>
                <div class="col-10">
                    <input type="text" name="name" value="{{old("name")}}" class="form-control" placeholder="product name...">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">Description</label>
                <div class="col-10">
                <textarea name="des"  id="" cols="81" rows="6">{{old("des")}}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">Price</label>
                <div class="col-10">
                    <input type="number" value="{{old("price")}}"  name="price" class="form-control" placeholder="price...">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">Image</label>
                <div class="col-10">
                <input type="file" name="image" value="<?php if(!empty($old_file)){echo $old_file;} ?>" class="form-control" >
                </div>
            </div>
            <div class="form-group row">
                <label for="cate_id" class="col-2 col-form-label">Category</label>
                <div class="col-10">
                <select multiple="multiple" name="cate_id[]" id="cate_id" class="form-control" >
                <?php foreach ($cate_child as $item) : ?>
                    <option  value="{{$item->id}}"><?php echo $item->name ?></option>
                <?php endforeach; ?>
                </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-bordred waves-effect w-md waves-light m-b-5 pull-right">Create</button>
        </form> --}}

        {{ Form::model($pro,array('action'=>array('ProductController@post_Create',$pro->id),'method'=>'POST','files'=>true)) }}
        {{Form::token()}}
        <div class="form-group row">
            {{  Form::label('name', 'Product name: ',array('class' => 'col-2 col-form-label'))  }}
            <div class="col-10">
                {{  Form::text('name',null, array('class' => 'form-control','placeholder'=>'Product name ...'))  }} 
            </div>    
        </div>
        <div class="form-group row">
            {{  Form::label('des', 'Description: ',array('class' => 'col-2 col-form-label'))  }}
            <div class="col-10">
                {{  Form::textarea('des',null, array('class' => 'form-control','row'=>'4','cols'=>'10'))  }} 
            </div>    
        </div>

        <div class="form-group row">
            {{  Form::label('price', 'Price: ',array('class' => 'col-2 col-form-label'))  }}
            <div class="col-10">
                {{  Form::number('price',null, array('class' => 'form-control'))  }} 
            </div>    
        </div>
        <div class="form-group row">
            {{  Form::label('gender', 'Gender: ',array('class' => 'col-2 col-form-label'))  }}
            <div class="col-10">
                {{  Form::select('gender', array('Nam' => 'Nam', 'Nữ' => 'Nữ','Nam-Nữ'=>'Nam-Nữ'),null,array('class'=>'form-control'))  }} 
            </div>    
        </div>

        <div class="form-group row">
            {{  Form::label('image', 'Image: ',array('class' => 'col-2 col-form-label','accept' => 'image/*'))  }}
            <div class="col-10">
                {{  Form::file('image', array('class' => 'form-control'))  }} 
            </div>    
        </div>
        
        <div class="form-group row">
            {{  Form::label('cate_id[]', 'Category: ',array('class' => 'col-2 col-form-label'))  }}
            <div class="col-10">
                {{  Form::select('cate_id[]', $cate_child,null,array('class'=>'form-control','multiple'=>'multiple'))  }} 
            </div>    
        </div>
        {{Form::submit('Click Me!')}}
        {{ Form::close() }}
    </div>
</div>
@endsection