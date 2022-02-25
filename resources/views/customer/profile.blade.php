@extends('layouts.main')
@section('title',$customer->name)
@section('main')
<br>
<br>
<div class="container">
    <div class="row my-2">
        <div class="col-lg-8 order-lg-2" id="main-profile">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Thông tin</a>
                </li>
                <!-- <li class="nav-item">
                    <a href="" data-target="#messages" data-toggle="tab" class="nav-link">Contact info</a>
                </li> -->
                <li class="nav-item">
                    <a href="" data-target="#infomation" data-toggle="tab" class="nav-link">Cập nhật thông tin</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#history" data-toggle="tab" class="nav-link" >Lịch sử mua hàng</a>
                </li>
            </ul>
            <div class="tab-content py-4">
                <div class="tab-pane active" id="profile">
                    <h5 class="mb-3">{{$customer->name}}</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Thông tin</h5>
                            <br>
                            <p>
                                Email : {{$customer->email}}
                            </p>
                            <p>
                                Số điện thoại : {{$customer->phone}}
                            </p>
                            <p>
                                Địa chỉ : {{$customer->address}}
                            </p>
                            @if($customer->gender==0)
                            <p>
                                Giới tính : Nữ
                            </p>
                            @endif
                            @if($customer->gender==1)
                            <p>
                            Giới tính : Nam
                            </p>
                            @endif
                            @if($customer->gender==2)
                            <p>
                            Giới tính : Khác
                            </p>
                            @endif
                        </div>
                    </div>
                    <br>
                    <a href="{{route('cus.form-password')}}"><i class="fa fa-edit"></i> Đổi mật khẩu</a>
                    <br>
                    <a href=""><i class="fa fa-list"></i> Sản phẩm yêu thích</a>
                    <br>
                    <a href="{{route('cus.logout')}}"><i class="fa fa-sign-out"></i> Đăng xuất</a>
                    <!--/row-->
                </div>
                <div class="tab-pane" id="infomation">
                    <form role="form" action="{{route('cus.update',$customer->id)}}" method="post">
                        @csrf @method('put')
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Họ tên</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="name" value="{{$customer->name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Địa chỉ email</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="email" value="{{$customer->email}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Số điẹn thoại</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="phone" value="{{$customer->phone}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Địa chỉ</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="text" name="address" value="{{$customer->address}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Giới tính</label>
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <select class="form-control" name="gender">
                                        <option value="0" {{$customer->gender==0?'selected':''}}>Nữ</option>
                                        <option value="1" {{$customer->gender==1?'selected':''}}>Nam</option>
                                        <option value="2" {{$customer->gender==2?'selected':''}}>Khác</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                <button class="btn btn-success btn-update">Lưu</button>
                                <input type="reset" class="btn btn-secondary" value="Cancel">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="history">
                    <table class="table text-center table-bordered">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th width="200px">Ngày đặt hàng</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($history as $item)
                            <tr class="text-center">
                                <td class="font-weight-bold">{{$item->id}}</td>
                                <td>{{$item->created_at->format('d-m-Y')}}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm btn-warning text-light" data-toggle="modal" data-target="#detail-{{$item->id}}">
                                      Chi tiết
                                    </button>
                                    <a href="{{route('pdf',$item->id)}}" target="_blank" class="btn btn-danger btn-sm">Xem PDF</a>
                                    
                                    <!-- Modal -->
                                    <div class="modal fade" id="detail-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Đơn hàng #{{$item->id}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p class="font-weight-bold text-left">Khách hàng</p>
                                                            <p class="font-weight-bold text-left">Email</p>
                                                            <p class="font-weight-bold text-left">Số điện thoại</p>
                                                            <p class="font-weight-bold text-left">Địa chỉ</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p  class="text-left">{{$item->customer->name}}</p>
                                                            <p  class="text-left">{{$item->customer->email}}</p>
                                                            <p  class="text-left">{{$item->customer->phone}}</p>
                                                            <p  class="text-left">{{$item->customer->address}}</p>
                                                        </div>
                                                    </div>
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>Sản phẩm</th>
                                                            <th>Số lượng</th>
                                                            <th>Giá</th>
                                                            <th>Tổng</th>
                                                        </tr>
                                                        @foreach ($item->order_detail as $od)
                                                        <tr>
                                                            <td>
                                                                <img src="{{url('public/upload')}}/{{$od->products->image}}" width="60px">
                                                            </td>
                                                            <td>
                                                                {{$od->quantity}}
                                                            </td>
                                                            <td>
                                                                {{number_format($od->price)}} 
                                                            </td>
                                                            <td>
                                                                {{number_format($od->quantity*$od->price)}} 
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div id="paginate">
                        {{$history->links()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 order-lg-1 text-center upload-avatar">
            <form action="{{route('cus.upload',$customer->id)}}" id="upload-image-form" method="post" enctype="multipart/form-data">
            @csrf @method('put')
                <img src="{{url('public/upload')}}/{{$customer->avatar}}" class="mx-auto img-fluid img-circle d-block" alt="avatar" width="100%" id="avatar" style="cursor: pointer">
                <label class="custom-file">
                <input type="file" id="file_avatar" name="image" class="custom-file-input" hidden>
                </label>
            </form>
        </div>
    </div>
</div>
<br>
<br>

@endsection

@section('js')
<script>
    $('#avatar').click(function(){
        $('#file_avatar').click();
    });

    // upload avatar
    $('#file_avatar').change(function(){
        var file = $(this)[0].files[0];
        var reader = new FileReader();
        reader.onload = function(){
            var result = reader.result;
            $('#avatar').attr('src',result);
        }
        reader.readAsDataURL(file);

        var data = new FormData($(this).closest('form')[0]);
        var url = $(this).closest('form').attr('action');
        $.ajax({
            url : url,
            type : 'POST',
            data : data,
            processData: false,
            contentType: false,
            success : function(res){
                if(res.status==false){
                    Swal.fire({
                        icon : res.icon,
                        html : res.message
                    });
                    $(".upload-avatar").load(location.href + " .upload-avatar>*");
                }else{
                    Swal.fire({
                        icon : 'success',
                        html : 'Update Avatar Successfully'
                    });
                }
            }
        })
    });


    // update info
    $(document).on('click','.btn-update',function(e){
        e.preventDefault();
        var data = $(this).closest('form').serialize();
        var url = $(this).closest('form').attr('action');
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            success: function(res){
                if(res.status==false){
                    Swal.fire({
                        icon : res.icon,
                        html : res.message
                    });
                }
                $("#main-profile").load(location.href + " #main-profile>*");
                Swal.fire({
                    icon : 'success',
                    html : 'Update Profile Success'
                });
            }
        })
    });
</script>
@endsection