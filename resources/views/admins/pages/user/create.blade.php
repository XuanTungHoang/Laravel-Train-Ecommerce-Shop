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
        {{-- <form action="{{action("UserController@post_Create")}}" method="POST" class="form-horizontal">
            <input name="_token" value="<?php echo csrf_token() ?>" type="hidden" />
            <div class="form-group row">
                <label class="col-2 col-form-label">User name</label>
                <div class="col-10">
                    <input type="text" name="name" value="{{old("name")}}" class="form-control" placeholder="user name...">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">Your email</label>
                <div class="col-10">
                    <input type="text" value="{{old("email")}}" name="email" class="form-control" placeholder="your email...">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">Password</label>
                <div class="col-10">
                    <input type="password"  name="password" class="form-control" placeholder="password...">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">Confirm password</label>
                <div class="col-10">
                    <input type="password" name="password_confirm" class="form-control" placeholder ="confirm password...">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">Roles</label>
                <div class="col-10">
                <select name="role" class="form-control">
                    <option  value="Admin">Admin</option>
                    <option  value="Editor">Editor</option>
                    <option selected value="Normal">Normal</option>
                </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-bordred waves-effect w-md waves-light m-b-5 pull-right">Create</button>
        </form> --}}
        {{ Form::model($user,array('action'=>array('UserController@post_Create',$user->id),'method'=>'POST')) }}
        {{Form::token()}}
        <div class="form-group row">
            {{  Form::label('name', 'User name: ',array('class' => 'col-2 col-form-label'))  }}
            <div class="col-10">
                {{  Form::text('name','', array('class' => 'form-control','placeholder'=>'User name ...'))  }} 
            </div>    
        </div>
        <div class="form-group row">
            {{  Form::label('email', 'Your mail: ',array('class' => 'col-2 col-form-label'))  }}
            <div class="col-10">
                {{  Form::email('email','', array('class' => 'form-control','placeholder'=>'Your mail ...'))  }} 
            </div>    
        </div>
        <div class="form-group row">
            {{  Form::label('password', 'Password: ',array('class' => 'col-2 col-form-label'))  }}
            <div class="col-10">
                {{  Form::password('password', array('class' => 'form-control','placeholder'=>'Your password ...'))  }} 
            </div>    
        </div>
        <div class="form-group row">
            {{  Form::label('password_connfirm', 'Confirm Password: ',array('class' => 'col-2 col-form-label'))  }}
            <div class="col-10">
                {{  Form::password('password_connfirm', array('class' => 'form-control','placeholder'=>'Confirm your password ...'))  }} 
            </div>    
        </div>
        <div class="form-group row">
            {{  Form::label('role', 'Choose Role: ',array('class' => 'col-2 col-form-label'))  }}
            <div class="col-10">
                {{  Form::select('role', array(
                    'Admin' => 'Admin',
                    'Editor'=>'Editor',
                    'Normal'=>'Normal',
                    ),'Normal',array('class'=>'form-control')
                    )  }} 
            </div>    
        </div>
        {{Form::submit('Click Me!')}}
        {{ Form::close() }}
    </div>
</div>
@endsection