
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
        
        <a href="{{action("UserController@get_Create")}}" class="btn btn-success waves-effect w-md waves-light m-b-5">Create new</a>
        <table class="table">
            <thead >
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>               
                <th>Role</th>
                <th>Status</th>
                <th>Create_at</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($user as $item ): ?> 
            <tr
                {{-- custom for new user --}}
                <?php if(session('id_submit')==$item->id) { echo 'class="alert alert-success"';} ?> >
                
                {{-- Insert data for table on view --}}
                <td><?=$item->id ?></td>
                <td><?=$item->name ?></td>
                <td><?=$item->email ?></td>           
                <td><?=$item->role ?></td>
                <td><?=$item->status ?></td>
                <td><?=$item->created_at ?></td>   
                <td>
                    {{-- Edit user --}}
                    <a href="/admin/user/edit/{{$item->id}}" class="btn btn-icon waves-effect waves-light btn-warning m-b-5 pull-left"><i class="fa fa-wrench"></i> </a>
                </td>
                <td>                   
                    {{-- Delete user --}}
                    <form method="GET" action="/admin/user/delete/{{$item->id}}" id="delete_confirm">
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
                {{$user->links()}} 
            </div>
            
        </div>
    </div>
    {{-- script confirm delete --}}
    {{-- <script type="text/javascript">
    function ConfirmDelete()
    {
        var x = confirm("Are you sure you want to delete?");
        if (x)
            return true;
        else
            return false;
    }

   </script> --}}
@endsection


