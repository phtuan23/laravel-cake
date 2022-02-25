<h1>Xin chào {{$order->name}}</h1>
<h3>Cảm ơn đã sử dụng dịch vụ của chúng tôi.</h3>
<h5>Mã đơn hàng : {{$order->id}}</h5>
<h5>Chi tiết đơn hàng : </h5>

<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 50%;'>
    <tr style='text-align:center;'>
        <th style='border: 1px solid #ddd;padding: 8px;text-align: center;background-color: #f08632;color: white;'>Sản phẩm</th>
        <th style='border: 1px solid #ddd;padding: 8px;text-align: center;background-color: #f08632;color: white;'>Giá</th>
        <th style='border: 1px solid #ddd;padding: 8px;text-align: center;background-color: #f08632;color: white;'>Số lượng</th>
        <th style='border: 1px solid #ddd;padding: 8px;text-align: center;background-color: #f08632;color: white;'>Tổng tiền</th>
    </tr>
    @foreach($cart->carts as $item)
        <tr style='text-align:center;'>
            <td style='border: 1px solid #ddd;padding: 8px;'>{{$item['name']}}</td>
            <td style='border: 1px solid #ddd;padding: 8px;'>{{number_format($item['price'])}}</td>
            <td style='border: 1px solid #ddd;padding: 8px;'>{{$item['quantity']}}</td>
            <td style='border: 1px solid #ddd;padding: 8px;'>{{number_format($item['price']*$item['quantity'])}} đ</td>
        </tr>
    @endforeach
    <tr>
        <th><h3 style="color:#f08632;">Tổng : {{number_format($cart->total_price)}} vnđ</h3></th>
    </tr>
</table>