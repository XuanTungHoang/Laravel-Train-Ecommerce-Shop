
@extends('admins/layouts/master')

@section('content')
    <div class="row">
        <div class="col-12">
            {{-- notification --}}
            @if (session('notification'))
                 <div class="alert alert-success">
                    {{session('notification')}}
                </div>
            @endif
        </div>
        
    
        <table class="table">
            <thead >
            <tr>
                <th>Product ID</th>
                <th>Product name</th>
                <th>Size S</th>               
                <th>Size M</th>               
                <th>Size L</th>               
                <th>Size XS</th>               
              
            </tr>
            </thead>

            <tbody>
           
            <tr>
                {{-- Insert data for table on view --}}
                <td><?=$pro->id ?></td>
                <td><?=$pro->name ?></td>
                <td><?php if(!empty($size[0])){ echo $size[0]->size_S ;} ?></td>
                <td><?php if(!empty($size[0])){ echo $size[0]->size_M ;} ?></td>
                <td><?php if(!empty($size[0])){ echo $size[0]->size_L ;} ?></td>
                <td><?php if(!empty($size[0])){ echo $size[0]->size_XS ;} ?></td>
                
                
            </tr>      
            </tbody>
        </table>

        <div class="col-lg-6">
            <div class="card-box">
                <h1 class="m-t-0 header-title">Save quantity for size</h1>
                @if (isset($errors) && count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        {!! Form::open(['url' => 'admin/product/post_detail',  'method' => 'post']) !!}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <table class="table-bordered" style="height:200px">

            <tr>
                <td>Size S:</td>
                <td>    <input type="number" name="size_S" class="form-control"
                  value="<?php if(!empty($size[0])){ echo $size[0]->size_S ;}else {echo 0;} ?>" >
                   <input type="hidden" name="pro_id" class="form-control"
                   value="{{$pro->id}}"></td>
            </tr>

            <tr>
                <td>Size M:</td>
                <td>    <input type="number" name="size_M" class="form-control"
                  value="<?php if(!empty($size[0])){ echo $size[0]->size_M ;}else {echo 0;} ?>" >
                </td>
            </tr>
            
            <tr>
                <td>Size L:</td>
                <td>    <input type="number" name="size_L" class="form-control"
                  value="<?php if(!empty($size[0])){ echo $size[0]->size_L ;} else {echo 0;}?>" >
                </td>
            </tr>
           
            <tr>
                <td>Size XS:</td>
                <td>    <input type="number" name="size_XS" class="form-control"
                  value="<?php if(!empty($size[0])){ echo $size[0]->size_XS ;} else {echo 0;} ?>" >
                </td>
            </tr>
             <tr>
                 <td colspan="2">
            <input type="submit" value="SAVE" class="btn btn-success pull-right">
                 </td>
             </tr>

            {!! Form::close() !!}
        </table>
            </div>

        </div>

    </div>  
@endsection


