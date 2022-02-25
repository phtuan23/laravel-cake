<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
            box-sizing: border-box;
        }

        #pdf {
            width: 650px;
            overflow: hidden;
            clear: both;
            border: 1px solid rgb(221, 216, 216);
            padding: 10px;
            box-shadow: 5px 5px #d3cece;
            margin: 0 auto;
            margin-top: 40px
        }

        #title {
            padding: 0 20px
        }

        #title .column {
            float: left;
            width: 50%;
        }

        #title .column h2 {
            font-size: 40px;
            padding: 5px 0
        }

        /* Clear floats after the columns */
        #title:after {
            content: "";
            display: table;
            clear: both;
        }

        #title .info-order {
            width: 51%;
            float: right;
            padding: 10px 0
        }

        #info {
            clear: both;
            overflow: hidden;
            margin-top: 10px;
            margin-bottom: 30px;
            padding: 0 20px;
            line-height: 5px
        }

        #info .column {
            float: left;
            width: 50%;
        }

        #info .customer {
            text-align: right;
        }

        #info .shop h5 {
            font-weight: bold;
            font-size: 14px;
            color: rgb(110, 99, 99);
        }

        #info .customer h5 {
            font-weight: bold;
            font-size: 14px;
            color: rgb(110, 99, 99);
        }

        #order-detail .text-order {
            text-align: center;
            font-weight: bold;

        }

        #order-detail .table-order {
            width: 80%;
            margin: 0 auto;
        }

        #order-detail tr {
            text-align: center;
        }

        #order-detail tr.tr-first th {
            padding: 12px 5px;
            border-top: 1px solid rgb(110, 99, 99);
            border-bottom: 1px solid rgb(110, 99, 99);
        }

        #order-detail tr td {
            padding: 10px 0;
        }

        #order-detail tr td {
            border-bottom: 1px dashed gray;
            color: rgb(110, 99, 99);
        }

        #order-detail tr.item:last-child td {
            border-bottom: 1px solid gray;
        }

        #order-detail {
            overflow: hidden;
            clear: both;
            position: relative;
        }

        #order-detail .total-price {
            border: 1px solid yellow;
        }

        #order-detail .thank {
            text-align: center;
        }
    </style>
</head>

<body>
    <div id="pdf">
        <div id="title">
            <div class="column">
                <img src="public/main/img/logo.png" alt="" style="padding:20px 20px">
            </div>
            <div class="column">
                <div class="info-order">
                    <h5>Mã đơn hàng : {{$order->id}}</h5>
                    <h5>Ngày đặt hàng : {{$order->created_at->format('d-m-Y')}}</h5>
                </div>
            </div>
        </div>
        <div id="info">
            <div class="column">
                <div class="shop">
                    <h5>tuantuan230298@gmail.com</h5>
                    <h5>238 Hoang Quoc Viet</h5>
                    <h5>0989.89.89.89</h5>
                </div>
            </div>
            <div class="column">
                <div class="customer">
                    <h5>{{$order->name}}</h5>
                    <h5>{{$order->phone}}</h5>
                    <h5>{{$order->email}}</h5>
                    <h5>{{$order->address}}</h5>
                </div>
            </div>
        </div>
        <div id="order-detail">
            <p class="text-order">--Chi tiết đơn hàng--</p>
            <table class="table-order">
                <thead>
                    <tr class="tr-first">
                        <th width="40px">#</th>
                        <th width="150px">Sản phẩm</th>
                        <th width="80px">Số lượng</th>
                        <th width="100px">Giá</th>
                        <th>Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;$total=0?>
                    @foreach($order->order_detail as $item)
                    <tr class="item">
                        <td style="text-align:center">{{$i++}}</td>
                        <td style="text-align:center">{{$item->products->name}}</td>
                        <td style="text-align:center">{{$item->quantity}}</td>
                        <td style="text-align:center">{{number_format($item->price)}} đ</td>
                        <td style="text-align:center">{{number_format($item->price*$item->quantity)}} đ</td>
                    </tr>
                    <?php $total+=$item->price*$item->quantity?>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="padding:8px 0;line-height:30px;text-align:center">Tổng thanh toán <br>
                            {{number_format($total)}} vnđ
                        </th>
                    </tr>
                </tfoot>
            </table>
            <div class="thank">
                <h5>--Cảm ơn đã sử dụng dịch vụ của chúng tôi--</h5>
            </div>
        </div>
    </div>
</body>

</html>