@extends('layouts.admin')
@section('title','Thêm mới danh mục')
@section('main')
<div class="col-md-12 m-auto">
    
    <div class="card mt-5">
        <div class="card-header">
            <h5>@yield('title')</h5>
            <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
        </div>
        <div class="card-block">
            <form action="{{route('category.store')}}" class="form-material" method="POST">
                @csrf
                <div class="form-group form-default form-static-label">
                    <input type="text" name="name" class="form-control" placeholder="nhập tên danh mục" autocomplete="off">
                    <span class="form-bar"></span>
                    <label class="float-label">TÊN DANH MỤC</label>
                </div>
                <div class="form-group form-default form-static-label">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" value="1" checked>
                            HIỂN THỊ
                        </label>
                    </div>
                </div>
                <div class="form-group form-default form-static-label">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" value="0">
                            ẨN
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-success btn-submit"><i class="fas fa-check-circle"></i> LƯU</button>
                <a href="{{route('category.index')}}"type="submit" class="btn btn-sm btn-info"><i class="fa fa-window-close"></i> QUAY LẠI</a>
            </form>
        </div>
    </div>
</div>
@stop()

@section('js')
    <script>
        $(document).ready(function() {
            $(".btn-submit").click(function(e){
                e.preventDefault();
                var data = $(this).closest('form').serialize();
                var url = $(this).closest('form').attr('action');
                $.ajax({
                    url : url,
                    type : 'POST',
                    data : data,
                    success : function(res){
                        if(res.status==false){
                            Swal.fire({
                                icon : res.icon,
                                html : res.message
                            });
                        }else{
                            location.href = "{{route('category.index')}}"
                        }
                    }
                })
            });
        });
    </script>
@endsection