<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thông báo Nạp Tiền thành công</title>
    <style>
        @media only screen and (max-width: 600px) {
            /* Điều chỉnh định dạng cho kích thước màn hình nhỏ hơn hoặc bằng 600px */
            table {
                width: 100% !important;
            }
        }
    </style>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0;">
    <div style="background-color: #f2f2f2; padding: 20px;">
        <table style="background-color: #ffffff; border-collapse: collapse; margin: auto; max-width: 600px; width: 100%;">
            <tr>
                <td style="padding: 20px;">
                    <h2 style="color: #333333;">Thông báo: {{$type}}</h2>
                    <p style="color: #333333;">Xin chào:   <b>{{$email}}</b> ,</p>
                    <p style="color: #333333;">Chúng tôi xin thông báo rằng yêu cầu {{$type}} của bạn đã {{$status}}.</p>
                    <p style="color: #333333;">Thông tin chi tiết {{$type}}:</p>
                    <ul style="color: #333333;">
                        <li>Số tiền: <b>{{number_format($balance).'VNĐ'}}</b></li>
                        {{-- <li>Tài khoản nhận: <b>{{$trans->card_number}}</b></li> --}}
                        <li>Thời gian thực hiện: <b>{{date('H:i:s Y-m-d')}}</b></li>
                        <li>Kiểm tra: <b><a href="{{$link}}"> Tại đây </a></b></li>
                    </ul>
                    <p style="color: #333333;">Vui lòng <a href="{{ route('home') }}">Liên Hệ</a> với chúng tôi nếu bạn có bất kỳ câu hỏi hoặc yêu cầu hỗ trợ.</p>
                    <p style="color: #333333;">Trân trọng,</p>
                    <p style="color: #333333;">Hotline: 1900159639 - 0795 710 839</p>
                    <p style="color: #333333;">Email: cskh@luckboxvn.com</p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
