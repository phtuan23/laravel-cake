@extends('layouts.admin')
@section('title','Trash')
@section('main')
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body p-0">
        <div class="page-wrapper">
            <!-- Page-body start -->
            <div class="page-body">
                <!-- Basic table card start -->
                <div class="card">
                    <h2 class="p-2"><i class="fas fa-trash"></i> @yield('title')</h2>
                    <div class="card-header">
                        <form class="form-inline">
                            <div class="form-group mr-1">
                                <input type="text" name="search_string" class="form-control" placeholder="Search...">
                            </div>
                            <button class="btn btn-info btn-sm"><i class="fa fa-search"></i></button>
                            <a href="{{route('category.create')}}" class="btn btn-success btn-sm ml-2"><i class="fa fa-plus"></i> ADD</a>
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
                                        <th width="60" class="font-weight-bold">ID</th>
                                        <th class="font-weight-bold">NAME</th>
                                        <th class="font-weight-bold" width="150">TOTAL PRODUCT</th>
                                        <th class="font-weight-bold">STATUS</th>
                                        <th class="font-weight-bold"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($trashs as $trash)
                                    <tr class="text-center">
                                        <td>{{$trash->id}}</td>
                                        <td>{{$trash->name}}</td>
                                        <td>{{$trash->products()->count()}}</td>
                                        <td>
                                            @if($trash->status==1)
                                            <span class="badge badge-success">Public</span>
                                            @else
                                            <span class="badge badge-danger">Private</span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <a href="{{route('category.restore',$trash->id)}}" class="btn btn-sm btn-success" onclick="return confirm('Are you sure you want to restore?')"><i class="ti-share-alt"></i></a>
                                            <a href="{{route('category.remove',$trash->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete?')"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix">
                            {{$trashs->appends(request()->all())->links()}}
                        </div>
                        <form action="" id="form-delete" method="POST">
                            @csrf @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $('.btndelete').click(function(event) {
        event.preventDefault();
        var href = $(this).attr('href');
        $('#form-delete').attr('action',href);
        if(confirm('Are you sure you want to delete this?')==true){
            $('#form-delete').submit();
        }
    });
</script>
@endsection