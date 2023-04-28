<h1 style="font-family: Arial, sans-serif; color: #0099ff; font-size: 28px; font-weight: bold; text-align: center;">Đơn hàng mới</h1>
<h2 style="font-family: Arial, sans-serif; color: #333; font-size: 20px; font-weight: bold;">Thông tin khách hàng</h2>
<p style="font-family: Arial, sans-serif; color: #333; font-size: 16px;">Tên khách hàng: <strong>{{ $query['cus_name']}}</strong></p>
<p style="font-family: Arial, sans-serif; color: #333; font-size: 16px;">Số điện thoại: <strong>{{ $query['cus_phone']}}</strong></p>
<p style="font-family: Arial, sans-serif; color: #333; font-size: 16px;">Địa chỉ Email: <strong>{{ $query['cus_email']}}</strong></p>
<p style="font-family: Arial, sans-serif; color: #333; font-size: 16px;">Địa chỉ nhận hàng: <strong>{{ $query['cus_address']}}</strong></p>
<p style="font-family: Arial, sans-serif; color: #333; font-size: 16px;">Ghi chú: <strong>{{ $query['note']}}</strong></p>
<h2 style="font-family: Arial, sans-serif; color: #333; font-size: 20px; font-weight: bold;">Thông tin đơn hàng</h2>
<table style="border-collapse: collapse; border: 1px solid #ccc; background-color: #f9f9f9; width: 100%; font-family: Arial, sans-serif; color: #333; font-size: 16px;">
    <tr>
        <td colspan="6" style="border: 1px solid #ccc; padding: 10px;">Mã đơn hàng của bạn là: <strong style="color: #0099ff;">#{{$query->code_bill}}</strong></td>
    </tr>
    <tr style="font-weight: 500; text-align:center; font-weight: bold;">
        <td width="350" style="border: 1px solid black ;">
            Tên sản phẩm
        </td>
        <td width="100" style="border: 1px solid black ;">
            Phân loại
        </td>
        <td width="80" style="border: 1px solid black ;">
            Số lượng
        </td>
        <td width="100" style="border: 1px solid black ;">
            Giá (vnđ)
        </td>
        <td width="80" style="border: 1px solid black ;">
            Giảm giá (%)
        </td>
        <td width="100" style="border: 1px solid black ;">
            Thành tiền
        </td>
    </tr>
    @foreach ($cart as $item)
    @php
        $discountPrice = $item['price'] - $item['price'] * $item['discount'] / 100;
    @endphp
        <tr style="border: 1px solid black;text-align: center;">
            <td style="border: 1px solid black; font-weight: bold;">
                {{languageName($item['name'])}}
            </td>
            <td style="border: 1px solid black;">
                {{$item['type']}}
            </td>
            <td style="border: 1px solid black;">
                {{$item['quantity']}}
            </td>
            <td style="border: 1px solid black;text-align: right;">
                {{number_format($item['price'], 0, ',', '.')}}
            </td>
            <td style="border: 1px solid black;">
                {{$item['discount']}}
            </td>
            <td style="border: 1px solid black;text-align: right;">
                {{number_format($discountPrice, 0, ',', '.')}}
            </td>
        </tr>
    @endforeach
    <tr style="border: 1px solid black;text-align: center;font-weight: bold;">
        <td colspan="5" style="border: 1px solid black">Tổng thanh toán</td>
        <td style="border: 1px solid black;text-align: right;">{{number_format($query['total_money'], 0, ',', '.')}}</td>
    </tr>
</table>