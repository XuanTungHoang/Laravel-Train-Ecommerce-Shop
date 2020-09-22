
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
        
    <a href="{{action("ProductController@get_Create")}}" class="btn btn-success waves-effect w-md waves-light m-b-5">Create new</a>
        <table class="table">
            <thead >
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>               
                <th>Price</th>
                <th>Gender</th>
                <th>Image</th>
                <th>Category</th>
                <th>Status</th>
                <th>Detail</th>
                <th>Alt Images</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($pro as $item ): ?> 
            <tr
                {{-- custom for after a action with product --}}
                <?php if(session('id_submit')==$item->id) { echo 'class="alert alert-success"';} ?> >
                
                {{-- Insert data for table on view --}}
                <td><?=$item->id ?></td>
                <td><?=$item->name ?></td>
                <td><?=$item->description ?></td>           
                <td><?=$item->price ?></td>
                <td><?=$item->gender ?></td>
                <td>
                    <a target="_blank" href="/upload/ul_Admin/<?php echo $item->image ?>"><img src="/upload/ul_Admin/<?php echo $item->image ?>" height="100px" width="100px" alt=""></a>
                </td>
                <td><?=$item->category?></td>
                <td><?=$item->status ?></td>
                <td><a href="/admin/product/detail/{{$item->id}}"
                    class="btn btn-icon waves-effect waves-light btn-success m-b-5" style="border-radius:20px;">
                    <i class="fa fa-edit"></i></a></td>
                <td>
                    {{-- <?php
                    $Aimgs = DB::table('alt_images')->where('proId', $product->id)
                    ->get();
                     ?>
                    <p> {{count($Aimgs)}} images found</p> --}}
                    <a href="/admin/product/add_images/{{$item->id}}"
                     class="btn btn-info" style="border-radius:20px;">
                     <i class="fa fa-plus"></i> Add</a></td>
                {{-- <td><?=$item->created_at ?></td>    --}}
                <td>
                    {{-- Edit product --}}
                <a href="/admin/product/edit/{{$item->id}}" class="btn btn-icon waves-effect waves-light btn-warning m-b-5 pull-left"><i class="fa fa-wrench"></i> </a>
                </td>
                <td>                   
                    {{-- Delete product --}}
                <form method="GET" action="/admin/product/delete/{{$item->id}}" id="delete_confirm">
                        {{ csrf_field() }}                                          
                            <button type="submit" onclick="if (!confirm('Are you sure?')) { return false }"  class="btn btn-icon waves-effect waves-light btn-danger m-b-5 pull-left" value=""><i class="fa fa-remove"></i></button>                     
                    </form>
                </td>
            </tr>      
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pagination">
            <div class="">
                {{$pro->links()}} 
            </div>
            
        </div>
    </div>  
@endsection


