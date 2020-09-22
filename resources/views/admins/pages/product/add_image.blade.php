@extends('admins/layouts/master')

@section('content')


  
                <div class="row">
                    <div class="col-lg-6">

                        <div class="card-box">
                           
                            <h1 class="m-t-0 header-title">ALt images</h1>
                <?php $altImages = DB::table('product_images')->where('pro_id', $pro->id)->get();?>
@if(count($altImages)!=0)
                <table class="table table-striped">
                  <tr>
                    <td>Index</td>
                    <td>Product id</td>
                    <td>alt image</td>
                    <td>Delete</td>
                    
                  </tr>
                  @foreach($altImages as $img)
                  <tr>
                    <td>{{$img->id}}</td>
                    <td>{{$img->pro_id}}</td>
                    <td>
                      <a target="_blank" href="/upload/ul_Admin/<?php echo $img->alt_image ?>"><img src="/upload/ul_Admin/<?php echo $img->alt_image ?>" height="80px" width="80px" alt=""></a>
                    </td>
                    <td>                   
                      {{-- Delete image --}}
                      <form method="GET" action="/admin/product/delete_image/{{$img->id}}" id="delete_confirm">
                          {{ csrf_field() }}                                          
                              <button type="submit" onclick="if (!confirm('Are you sure?')) { return false }"  class="btn btn-icon waves-effect waves-light btn-danger m-b-5 pull-left" value=""><i class="fa fa-remove"></i></button>                     
                      </form>
                  </td>
                    
                  </tr>
                  @endforeach

                </table>
                @else
                <p class="alert alert-danger">This product have not any alt images</p>
                @endif
                        </div>

                    </div>

                

                    <div class="col-lg-6">
                        <div class="card-box">
                            <h1 class="m-t-0 header-title">Add Alt Images</h1>
                            @if (isset($errors) && count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    {!! Form::open(['url' => 'admin/product/post_images',  'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <table class="table-bordered" style="height:200px">

                        <tr>
                            <td> Product Name:</td>
                            <td>    <input type="text" name="pro_name" class="form-control"
                              value="{{$pro->name}}" disabled>
                               <input type="hidden" name="pro_id" class="form-control"
                               value="{{$pro->id}}"></td>
                        </tr>

                        <tr>
                            <td> Upload Image:</td>
                            <td>    <input type="file" name="image" class="form-control"
                              value="{{$pro->name}}"></td>

                            </tr>

                         <tr>
                             <td colspan="2">
                        <input type="submit" value="ADD" class="btn btn-success pull-right">
                             </td>
                         </tr>

                        {!! Form::close() !!}
                    </table>
                        </div>

                    </div>

                </div>
                <!-- end row -->
@endsection