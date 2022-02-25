@extends('layouts.admin')
@section('title','Thêm mới')
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
                    <form action="{{route('customer.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter Customer's Name" value="{{old('name')}}">
                                    @error('name')
                                        <p class="help-block text-danger mt-2">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Email</label>
                                    <input type="text" name="email" class="form-control" placeholder="Enter Customer's Email" value="{{old('email')}}">
                                    @error('email')
                                        <p class="help-block text-danger mt-2">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="Enter Customer's Address" value="{{old('address')}}">
                                </div>
                                <div class="form-group" id="avatar-group">
                                    <label for="" class="font-weight-bold">Avatar</label>
                                    <input type="file" name="image" class="form-control" placeholder="Enter Customer's Avatar">
                                    @error('image')
                                        <p class="help-block text-danger mt-2">{{$message}}</p>
                                    @enderror
                                    <div id="image_avatar"></div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Phone</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter Customer's Phone" value="{{old('phone')}}">
                                </div>
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter Customer's Password" value="{{old('password')}}">
                                    @error('password')
                                        <p class="help-block text-danger mt-2">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="font-weight-bold">Gender</label>
                                    <div class="form-group">
                                        <select class="form-control" name="gender">
                                            <option>--Select Gender--</option>
                                            <option value="0" {{old('gender')=="0" ? 'selected' : ''}}>__Famale__</option>
                                            <option value="1" {{old('gender')=="1" ? 'selected' : ''}}>__Male__</option>
                                            <option value="2" {{old('gender')=="2" ? 'selected' : ''}}>__Other__</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-sm btn-success mt-4"><i class='fas fa-check-circle'></i>Save</button>
                                    <button class="btn btn-sm btn-info mt-4"><i class="fa fa-window-close"></i>Cancel</button>
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
<script type="text/javascript" src="{{url('public/admin')}}/assets/js/jquery/jquery.min.js"></script>
<script>
    $('input[name="image"]').change(function() {
        var file = $(this).get(0).files[0];
        var type = file.type;
        var validType = ['image/jpg','image/jpeg','image/png'];
        var html = $('div#image_avatar')[0];
        if($.inArray(type,validType) < 0 ){
            var p = "<p class='help-block text-danger mt-2 err_avt'>Avatar must be photo type (JPG,PNG)</p>";
            $('#avatar-group').append(p);
            $('input[name="image"]').css('border-color','red');
            $('#avatar').hide();
        }
        if($.inArray(type,validType) > 0){
            $('.err_avt').hide();
            $('input[name="image"]').css('border-color','#cccccc');
            var reader = new FileReader();
            reader.onload = function(e){
                $($.parseHTML('<img>')).attr({
                    src : e.target.result,
                    width: "200px",
                    style : "padding:5px 5px 5px 0"
                }).appendTo(html);
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@error('name')
<script>
    $('input[name="name"]').css('border-color','red');
</script>
@enderror
@error('email')
<script>
    $('input[name="email"]').css('border-color','red');
</script>
@enderror
@error('password')
<script>
    $('input[name="password"]').css('border-color','red');
</script>
@enderror
@error('image')
<script>
    $('input[name="image"]').css('border-color','red');
</script>
@enderror
@stop()