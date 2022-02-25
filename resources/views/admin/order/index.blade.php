@extends('layouts.admin')
@section('title','Đơn đặt hàng')
@section('main')

<div class="pcoded-inner-content">
    <div class="main-body p-0">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="card" >
                    <h3 class="p-3"><i class="fa fa-list"></i> @yield('title')</h3>
                    <div class="card-header">
                        <form class="form-inline float-right">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm...">
                            </div>
                            <button class="btn btn-info btn-sm ml-1 mr-2 btn-search"><i class="fa fa-search"></i></button>
                        </form>
                        <div id="order-status">
                            @if(request()->from and request()->to)
                            <a href="{{route('order.index')}}" class="btn btn-primary btn-sm btn-status">Tất cả</a>
                            <a href="{{route('order.index')}}?status=1&from={{request()->from}}&to={{request()->to}}" class="btn btn-success btn-sm btn-status">Đã đặt</a>
                            <a href="{{route('order.index')}}?status=0&from={{request()->from}}&to={{request()->to}}" class="btn btn-danger btn-sm btn-status">Đã huỷ</a>
                            <a href="{{route('order.index')}}?status=2&from={{request()->from}}&to={{request()->to}}" class="btn btn-secondary btn-sm btn-status">Đã thanh toán</a>
                            @else
                            <a href="{{route('order.index')}}" class="btn btn-primary btn-sm btn-status">Tất cả</a>
                            <a href="{{route('order.index')}}?status=1" class="btn btn-success btn-sm btn-status">Đã đặt</a>
                            <a href="{{route('order.index')}}?status=0" class="btn btn-danger btn-sm btn-status">Đã huỷ</a>
                            <a href="{{route('order.index')}}?status=2" class="btn btn-secondary btn-sm btn-status">Đã thanh toán</a>
                            @endif
                        </div>
                        <form class="form-inline mt-4" id="form-date">
                            <div class="form-group">
                                <input type="date" name="from" class="form-control">
                            </div>
                            <div class="form-group ml-2">
                                <input type="date" name="to" class="form-control">
                            </div>
                            <button class="btn btn-info btn-sm ml-1 mr-2 btn-search-date"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="card-block table-border-style" >
                        <div class="row">
                            <div class="col-md-12" id="main-content">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="60" class="font-weight-bold">ID</th>
                                                <th class="font-weight-bold">Khách hàng</th>
                                                <th class="font-weight-bold">Email</th>
                                                <th class="font-weight-bold">Số điện thoại</th>
                                                <th class="font-weight-bold">Trạng thái</th>
                                                <th class="font-weight-bold">Ngày tạo</th>
                                                <th class="font-weight-bold"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders as $order)
                                            <tr class="text-center">
                                                <td>{{$order->id}}</td>
                                                <td>{{$order->customer->name}}</td>
                                                <td>{{$order->customer->email}}</td>
                                                <td>{{$order->customer->phone}}</td>
                                                <td>
                                                    @if($order->status==0)
                                                    <span class="badge badge-danger">Huỷ</span>
                                                    @elseif($order->status==1)
                                                    <span class="badge badge-success">Đã đặt hàng</span>
                                                    @elseif($order->status==2)
                                                    <span class="badge badge-secondary">Đã thanh toán</span>
                                                    @endif
                                                </td>
                                                <td>{{$order->created_at->format('d-m-Y')}}</td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modelId-{{$order->id}}">
                                                    Xem chi tiết
                                                    </button>
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modelId-{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Chi tiết đơn hàng</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h6 class="text-left">Khách hàng : {{$order->customer->name}}</h6>
                                                                    <h6 class="text-left">Số ĐT : {{$order->customer->phone}}</h6>
                                                                    <h6 class="text-left">Ngày đặt : {{date($order->created_at)}}</h6>
                                                                    <form action="{{route('order.status',$order->id)}}" class="form-inline">
                                                                        <h6 class="text-left">Status : 
                                                                            @if($order->status==0)
                                                                            <span class="badge badge-danger">Huỷ</span>
                                                                            @elseif($order->status==1)
                                                                            <span class="badge badge-success">Đã đặt hàng</span>
                                                                            @elseif($order->status==2)
                                                                            <span class="badge badge-info">Đã thanh toán</span>
                                                                            @endif
                                                                        </h6>
                                                                        <div class="form-group">
                                                                            <div class="form-group">
                                                                                <select class="form-control" name="status" style="height:30px">
                                                                                    <option value="0" {{$order->status==0?'selected':''}}>Huỷ</option>
                                                                                    <option value="1" {{$order->status==1?'selected':''}}>Đã đặt hàng</option>
                                                                                    <option value="2" {{$order->status==2?'selected':''}}>Đã thanh toán</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <button class="btn btn-sm ml-1 btn-success btn-update-status" style="padding:1px;">Lưu</button>
                                                                    </form>
                                                                    <table class="table">
                                                                        <tr>
                                                                            <th>Sản phẩm</th>
                                                                            <th>Số lượng</th>
                                                                            <th>Giá</th>
                                                                            <th>Tổng</th>
                                                                        </tr>
                                                                        @foreach ($order->order_detail as $od)
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
                                </div>
                                <div class="clearfix mt-2">
                                    {{$orders->appends(request()->all())->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{url('public/admin')}}/assets/js/jquery/jquery.min.js "></script>
<script>
    // search by date
    $(document).on('click','.btn-search-date',function(e){
        e.preventDefault();
        var data = $(this).closest('form').serialize();
        $.ajax({
            url : window.location.href,
            type : 'GET',
            data : data,
            success : function(res){
                $("#main-content").load(location.href + "?" + data + " #main-content>*");
                $("#order-status").load(location.href + "?" + data + " #order-status>*");
            }
        });
    });

    // paginate
    $(document).on('click','.pagination a',function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        $.ajax({
            url : href,
            type : 'GET',
            success : function(res){
                $("#main-content").load(href + " #main-content>*");
            }
        });
    });

    // update statús
    $(document).on('click','.btn-update-status',function(e){
        e.preventDefault();
        var data = $(this).closest('form').serialize();
        var url = $(this).closest('form').attr('action');
        $.ajax({
            url : url + "?" + data,
            type : 'GET',
            success : function(res){
                $("#main-content").load(location.href + " #main-content>*");
            }
        });
    });

    // filter by status
    $(document).on("click",'.btn-status',function(e){
        e.preventDefault();
        var href = $(this).attr("href");
        $.ajax({
            url : href,
            type : 'GET',
            success : function(res){
                $("#main-content").load(href + " #main-content>*");
            }
        });
    });

    $(document).on('click',".btn-search",function(e){
        e.preventDefault();
        var data = $(this).closest("form").serialize();
        $.ajax({
            url : location.href + "?" + data,
            type : "GET",
            success : function(res){
                $("#main-content").load(location.href + "?" + data + " #main-content>*");
            }
        });
    });
</script>
@endsection
