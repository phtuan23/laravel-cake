@extends('layouts.admin')
@section('title','Khách hàng')
@section('main')

<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body p-0">
        <div class="page-wrapper">
            <!-- Page-body start -->
            <div class="page-body">
                <!-- Basic table card start -->
                <div class="card">
                    <h2 class="p-3"><i class="fas fa-users"></i> @yield('title')</h2>
                    <div class="card-header">
                        <form class="form-inline">
                            <div class="form-group">
                                <input type="text" name="search_string" class="form-control" placeholder="Tìm kiếm...">
                            </div>
                            <button class="btn btn-info btn-sm ml-1"><i class="fa fa-search"></i></button>
                        </form>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="fa fa fa-wrench open-card-option"></i></li>
                                <li><i class="fa fa-window-maximize full-card"></i></li>
                                <li><i class="fa fa-minus minimize-card"></i></li>
                                <li><i class="fa fa-refresh reload-card"></i></li>
                                <li><i class="fa fa-trash close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th width="60" class="font-weight-bold">#</th>
                                        <th class="font-weight-bold">Tên</th>
                                        <th class="font-weight-bold">Email</th>
                                        <th class="font-weight-bold">Số điện thoại</th>
                                        <th class="font-weight-bold">Giới tính</th>
                                        <th class="font-weight-bold">Địa chỉ</th>
                                        <th class="font-weight-bold"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customers as $cus)
                                    <tr class="text-center">
                                        <td>{{$cus->id}}</td>
                                        <td>{{$cus->name}}</td>
                                        <td>{{$cus->email}}</td>
                                        <td>{{$cus->phone}}</td>
                                        <td>
                                            @if($cus->gender==1)
                                            <span class="badge badge-secondary"><i class="fas fa-mars"></i> Male</span>
                                            @else
                                            <span class="badge badge-secondary"><i class="fas fa-venus"></i> Famale</span>
                                            @endif
                                        </td>
                                        <td>{{$cus->address}}</td>
                                        <td class="text-right">
                                            <a href="{{route('customer.edit',$cus->id)}}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                            <a href="{{route('customer.destroy',$cus->id)}}" class="btn btn-sm btn-danger btn-delete"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix">
                            {{$customers->appends(request()->all())->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form id="form-delete" method="POST">
    @csrf @method('DELETE')
</form>
@endsection

@section('js')
<script>
    $('.btn-delete').click(function(event) {
        event.preventDefault();
        var href = $(this).attr('href');
        $('#form-delete').attr('action', href);
        if (confirm('Are you sure you want to delete this?')) {
            $('#form-delete').submit();
        }
    });
</script>
@endsection