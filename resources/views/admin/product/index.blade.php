@extends('layouts.admin')
@section('title','Quản lý sản phẩm')
@section('main')

<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body p-0">
        <div class="page-wrapper">
            <!-- Page-body start -->
            <div class="page-body">
                <!-- Basic table card start -->
                <div class="card">
                    <h4 class="p-3"><i class="fas fa-shopping-cart"></i> @yield('title')</h4>
                    <div class="card-header">
                        <form class="form-inline" id="form-search">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm...">
                            </div>
                            <button class="btn btn-info btn-sm ml-1"><i class="fa fa-search"></i></button>
                            <a href="{{route('product.create')}}" class="btn btn-success btn-sm ml-2"> Thêm mới</a>
                        </form>
                        <div class="card-header-right">
                            <form action="">
                                <div class="form-group">
                                    <select class="form-control" name="sort">
                                        <option value="">Sắp xếp</option>
                                        <option value="desc">Giá từ cao đến thấp</option>
                                        <option value="asc">Giá từ thấp đến cao</option>
                                        <option value="sale">Các sản phẩm đang giảm giá</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-block table-border-style" id="main-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th width="60" class="font-weight-bold">#</th>
                                        <th class="font-weight-bold">TÊN SP</th>
                                        <th class="font-weight-bold">ẢNH</th>
                                        <th class="font-weight-bold">GIÁ</th>
                                        <th class="font-weight-bold">GIÁ KM</th>
                                        <th class="font-weight-bold">TRẠNG THÁI</th>
                                        <th class="font-weight-bold">DANH MỤC</th>
                                        <th class="font-weight-bold"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr class="text-center">
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>
                                            <img src="{{url('public/upload')}}/{{$product->image}}" width="60">
                                        </td>
                                        <td>{{number_format($product->price)}}</td>
                                        <td>{{$product->sale_price > 0 ? number_format($product->sale_price) : 'NULL'}}</td>
                                        <td>
                                            @if($product->status==1)
                                            <span class="badge badge-success">Public</span>
                                            @else
                                            <span class="badge badge-danger">Private</span>
                                            @endif
                                        </td>
                                        <td>{{$product->category->name}}</td>
                                        <td class="text-right">
                                            <a href="{{route('product.edit',$product->id)}}" class="btn btn-sm btn-success" style="border-radius:50%"><i class="fas fa-edit ml-1"></i></a>
                                            <a href="{{route('product.destroy',$product->id)}}" class="btn btn-sm btn-danger btn-delete" style="border-radius:50%"> <i class="fas fa-trash ml-1"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix">
                            {{$products->appends(request()->all())->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        // phân trang
        $(document).on('click','.pagination a', function(e){
            e.preventDefault();
            var href = $(this).attr('href');
            $.ajax({
                url  : href,
                type : 'GET',
                success: function(res){
                    $("#main-content").load(href + " #main-content>*");
                    $("html, body").animate({scrollTop: 200}, 800);
                }
            });
        });

        // tìm kiếm
        $(document).on('submit','#form-search',function(e){
            e.preventDefault();
            var search = $("input[name='search']").val();
            $.ajax({
                url : location.href + "?search=" + search,
                type : 'GET',
                success : function(res){
                    $("#main-content").load(location.href + "?search=" + search + " #main-content>*");
                    $("html, body").animate({scrollTop: 200}, 800);
                }
            });
        });

        // chuyển vào thùng rác
        $(document).on('click','.btn-delete',function(e){
            e.preventDefault();
            var href = $(this).attr('href');
            Swal.fire({
                title: 'Bạn có chắc muốn xóa?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'rgb(221, 51, 51)',
                cancelButtonColor: 'gray',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url : href,
                        method : "DELETE",
                        data : {
                            _token : '{{csrf_token()}}',
                        },
                        success: function(res){
                            $("#main-content").load(location.href + " #main-content>*");
                            Swal.fire({
                                icon : 'success',
                                html : 'Đã chuyển vào thùng rác'
                            });
                        }
                    });
                }
            });
        });

        $(document).on('change','select[name="sort"]',function(e){
            var sort = $(this).val();
            var url = location.href + '?sort=' + sort;
            $.ajax({
                url: url,
                type: 'GET',
                success : function(res){
                    $("#main-content").load(url + " #main-content>*");
                }
            })
        });
    });
</script>
@endsection