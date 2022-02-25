@extends('layouts.admin')
@section('title','Thêm mới sản phẩm')
@section('main')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <!-- Basic Form Inputs card start -->
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-shopping-cart"></i> SẢN PHẨM</h4>
                    <span>@yield('title')</span>
                </div>
                <div class="card-block">
                    <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="col-form-label font-weight-bold">ẢNH MÔ TẢ</label>
                                    <label class="col-form-label font-weight-bold float-right"><i class="fa fa-redo" style="cursor: pointer;"></i></label>
                                    <input  type="file" class="form-control" id="upload_images" name="images[]" multiple="multiple" hidden>
                                    <input type="button" class="form-control" value="CHỌN ẢNH MÔ TẢ" id="select_images">
                                    <div id="image_description"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label font-weight-bold">DANH MỤC</label>
                                            <select class="form-control" name="category_id" id='category_id'>
                                                <option value=''>CHỌN DANH MỤC</option>
                                                @foreach($categories as $category)
                                                <option value="{{$category->id}}">--{{$category->name}}--</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-form-label font-weight-bold">TRẠNG THÁI</label>
                                            <select class="form-control" name="status">
                                                <option value="">CHỌN TRẠNG THÁI SẢN PHẨM</option>
                                                <option value="1">HIỂN THỊ</option>
                                                <option value="0">ẨN</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label font-weight-bold">MÔ TẢ SẢN PHẨM</label>
                                    <textarea id="summernote" rows="5" cols="5" class="form-control" name="description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-form-label font-weight-bold">TÊN SẢN PHẨM</label>
                                    <input autocomplete="off" type="text" class="form-control" name="name" placeholder="NHẬP TÊN SẢN PHẨM">
                                </div>
                                <div class="form-group product_image">
                                    <label class="col-form-label font-weight-bold">ẢNH SẢN PHẨM</label>
                                    <input type="file" class="form-control" name="image" id="image" hidden>
                                    <input type="button" value="CHỌN ẢNH SẢN PHẨM" class="form-control" id="select_image">
                                    <img src="" id="show_image" width="100%" class="mt-2">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label font-weight-bold">GIÁ SẢN PHẨM</label>
                                    <input autocomplete="off" type="text" class="form-control" name="price" placeholder="NHẬP GIÁ SẢN PHẨM">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label font-weight-bold">GIÁ KHUYẾN MÃI</label>
                                    <input autocomplete="off" type="text" class="form-control" name="sale_price" placeholder="NHẬP GIÁ KHUYẾN MÃI">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-danger btn-add-product w-100 btn-sm"><i class="fas fa-save"></i> Save</button>
                                    <a href="{{route('product.index')}}" class="btn btn-secondary btn-sm w-100 mt-2"><i class="fa fa-window-close"></i> Cancel</a>
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
@section('js')
<script>
    $('#image').change(function(){
        var file = $(this)[0].files[0];
        var type = file.type;
        var validType = ['image/jpg','image/jpeg','image/png'];
        if($.inArray(type,validType) < 0 ){
            var p = "<p class='help-block text-danger mt-2 err_avt'>Ảnh sản phẩm không đúng định dạng (JPG,PNG)</p>";
            $('.product_image').append(p);
        }else{
            $('.err_avt').hide();
            var reader = new FileReader();
            reader.onload = function(){
                $('#show_image').attr('src',reader.result);
            }
            reader.readAsDataURL(file);
        }
    });

    $('#select_images').click(function(){
        $('#upload_images').click();
    });

    $("#select_image").click(function(){
        $('#image').click();
    })

    $('#upload_images').change(function() {
        $("#image_description").empty();
        $("#upload_images").empty();
        var file = $(this)[0].files;
        var html = $('div#image_description')[0];
        for(i=0; i<file.length; i++){
            var reader = new FileReader();
            reader.onload = function(e){
                var img = $($.parseHTML('<img>')).attr({
                    src : e.target.result,
                    width: "20%",
                    style : "padding:5px 5px 5px 0"
                });
                img.appendTo(html);
            }
            reader.readAsDataURL(file[i]);
        }
    });

    $(document).on('click','.btn-add-product',function(e){
        e.preventDefault();
        var data = new FormData($(this).closest('form')[0]);
        var href = $(this).closest('form').attr('action');
        $.ajax({
            url : href,
            type : 'POST',
            data : data,
            contentType : false,
            processData : false,
            success : function(res){
                if(res.status==false){
                    Swal.fire({
                        icon : res.icon,
                        html : res.message                    
                    });
                }else{
                    window.location.href = res.url
                }
            }
        });
    });

    $("#summernote").summernote({
        height : 130
    });

    $(".fa-redo").click(function(){
        $("#image_description").empty();
        $("#upload_images").empty();
    });
</script>
@endsection