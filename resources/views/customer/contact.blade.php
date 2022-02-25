@extends('layouts.main')
@section('title','Contacts')
@section('main')
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="contact__text">
                    <h3>Liên hệ với chúng tôi</h3>
                    <ul>
                        <li>Thời gian:</li>
                        <li>Thứ 2- Thứ 6: 5:00am to 9:00pm</li>
                        <li>Thứ 7 - Chủ nhật: 6:00am to 9:00pm</li>
                    </ul>
                    <img src="{{url('public/main')}}/img/cake-piece.png" alt="">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="contact__form">
                    <form>
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" placeholder="Họ và tên">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Địa chỉ Email">
                            </div>
                            <div class="col-lg-12">
                                <textarea placeholder="Lời nhắn"></textarea>
                                <button type="submit" class="site-btn">Gửi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection