@extends('layouts.admin')
@section('title','Edit Customer')
@section('main')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- Basic Form Inputs card start -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fas fa-address-card"></i> Customer Manager</h3>
                    <span>@yield('title')</span>
                </div>
                <div class="card-block">
                    <form action="{{route('customer.update',$customer->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Customer's Name" value="{{$customer->name}}">
                                    @error('name')
                                        <small class="help-block text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Email</label>
                                    <input type="text" name="email" class="form-control" placeholder="Enter Customer's Email" value="{{$customer->email}}">
                                    @error('email')
                                        <small class="help-block text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="Enter Customer's Address" value="{{$customer->address}}">
                                </div>
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Avatar</label>
                                    <input type="file" name="image" class="form-control" placeholder="Enter Customer's Avatar">
                                    @error('image')
                                        <small class="help-block text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <img src="{{url('public/upload')}}/{{$customer->avatar}}" width="200">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Phone</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter Customer's Phone" value="{{$customer->phone}}">
                                </div>
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter Customer's Password" value="{{$customer->password}}">
                                    @error('password')
                                        <small class="help-block text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Gender</label>
                                    <div class="form-group">
                                        <select class="form-control" name="gender">
                                            <option>--Select Gender--</option>
                                            <option value="0" {{$customer->gender==0?'selected':''}}>__Famale__</option>
                                            <option value="1" {{$customer->gender==1?'selected':''}}>__Male__</option>
                                            <option value="2" {{$customer->gender==2?'selected':''}}>__Other__</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-sm btn-success mt-4"><i class='fas fa-check-circle'></i>Save</button>
                                    <a href="{{route('customer.index')}}" class="btn btn-sm btn-info mt-4"><i class="fa fa-window-close"></i>Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Basic Form Inputs card end -->
        </div>
    </div>
</div>

@stop()