
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
        
        <a href="{{action("CateChildController@get_Create")}}" class="btn btn-success waves-effect w-md waves-light m-b-5">Create new</a>
        <table class="table">
            <thead >
            <tr>
                <th>ID</th>
                <th>Name</th>                
                <th>Description</th>
                <th>Category parent</th>
                <th>Create_at</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($cate_child as $item ): ?> 
            <tr
                {{-- custom for new category --}}
                <?php if(session('id_submit')==$item->id) { echo 'class="alert alert-success"';} ?> >
                
                {{-- Insert data for table on view --}}
                <td><?=$item->id ?></td>
                <td><?=$item->name ?></td>               
                <td><?=$item->description ?></td>
                <td><?php foreach ($cate_parent as $jtem): ?>
                    <?php if($item->parent_id==$jtem->id){echo $jtem->name;} ?>
                <?php endforeach ; ?>
                </td>
                <td><?=$item->created_at ?></td>   
                <td>
                    {{-- Edit category --}}
                    <a href="/admin/catechild/edit/{{$item->id}}" class="btn btn-icon waves-effect waves-light btn-warning m-b-5 pull-left"><i class="fa fa-wrench"></i> </a>
                </td>
                <td>                   
                    {{-- Delete category --}}
                <form method="GET" action="/admin/catechild/delete/{{$item->id}}" id="delete_confirm">
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
                {{$cate_child->links()}} 
            </div>
            
        </div>
    </div>   
@endsection


