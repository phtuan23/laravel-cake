@extends('layouts.main')
@section('title','Shop')
@section('main')
<style>
    :root {
        --input-padding-x: 1.5rem;
        --input-padding-y: .75rem;
    }

    .card-signin {
        border: 0;
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .card-signin .card-title {
        margin-bottom: 2rem;
        font-weight: 300;
        font-size: 1.5rem;
    }


    .card-signin .card-body {
        padding: 2rem;
    }

    .form-signin {
        width: 100%;
    }

    .form-signin .btn {
        font-size: 80%;
        border-radius: 5rem;
        letter-spacing: .1rem;
        font-weight: bold;
        padding: 1rem;
        transition: all 0.2s;
    }

    .form-label-group {
        position: relative;
        margin-bottom: 1rem;
    }

    .form-label-group input {
        height: auto;
        border-radius: 2rem;
    }

    .form-label-group>input,
    .form-label-group>label {
        padding: var(--input-padding-y) var(--input-padding-x);
    }

    .form-label-group>label {
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        width: 100%;
        margin-bottom: 0;
        /* Override default `<label>` margin */
        line-height: 1.5;
        color: #495057;
        border: 1px solid transparent;
        border-radius: .25rem;
        transition: all .1s ease-in-out;
    }

    .form-label-group input::-webkit-input-placeholder {
        color: transparent;
    }

    .form-label-group input:-ms-input-placeholder {
        color: transparent;
    }

    .form-label-group input::-ms-input-placeholder {
        color: transparent;
    }

    .form-label-group input::-moz-placeholder {
        color: transparent;
    }

    .form-label-group input::placeholder {
        color: transparent;
    }

    .form-label-group input:not(:placeholder-shown) {
        padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
        padding-bottom: calc(var(--input-padding-y) / 3);
    }

    .form-label-group input:not(:placeholder-shown)~label {
        padding-top: calc(var(--input-padding-y) / 3);
        padding-bottom: calc(var(--input-padding-y) / 3);
        font-size: 12px;
        color: #777;
    }

    .btn-google {
        color: white;
        background-color: #ea4335;
    }

    .btn-facebook {
        color: white;
        background-color: #3b5998;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6 m-auto">
            <div class="card card-signin flex-row my-5">
                <div class="card-img-left d-none d-md-flex">
                    <!-- Background image for card set in CSS! -->
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center font-weight-bold">????ng k??</h5>
                    @if(Session::has('error'))
                    <div class="alert alert-success" role="alert">
                        <strong>{{Session::get('error')}}</strong>
                    </div>
                    @endif
                    <form class="form-signin" method="post">
                        @csrf
                        <div class="form-label-group">
                            <input type="text" id="inputUserame" name="name" class="form-control" placeholder="T??n kh??ch h??ng">
                            <label for="inputUserame">T??n kh??ch h??ng</label>
                            @error('email')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-label-group">
                            <input type="text" id="inputEmail" name="email" class="form-control" placeholder="?????a ch??? email">
                            <label for="inputEmail">?????a ch??? email</label>
                            @error('email')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-label-group">
                            <input type="password" id="password" name="password" class="form-control" placeholder="M???t kh???u">
                            <label for="password">M???t kh???u</label>
                            @error('email')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-label-group">
                            <input type="password" id="password1" name="password1" class="form-control" placeholder="X??c nh???n m???t kh???u">
                            <label for="password1">X??c nh???n m???t kh???u</label>
                            @error('email')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-label-group">
                            <input type="text" id="address" name="address" class="form-control" placeholder="?????a ch???">
                            <label for="address">?????a ch???</label>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="S??? ??i???n tho???i">
                                    <label for="phone">S??? ??i???n tho???i</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label-group">
                                    <select class="form-control" name="gender">
                                        <option>Gi???i t??nh</option>
                                        <option value="0">N???</option>
                                        <option value="1">Nam</option>
                                        <option value="2">Kh??c</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-lg btn-info btn-block text-uppercase">????ng k??</button>
                        <a class="d-block text-center mt-2 small" href="{{route('cus.login')}}">????ng nh???p</a>
                        <hr class="my-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection