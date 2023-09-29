<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thông báo đổi mật khẩu</title>
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
                    <h4 style="color: #333333; text-align: center">LuckBoxVN</h2>
                    <h3 style="color: #333333; text-align: center">Thông báo:{{$type}} </h4>
                    <p style="color: #333333;">Xin chào:   <b>{{$email}}</b> ,</p>
                    <p style="color: #333333;">Chúng tôi xin thông báo rằng yêu cầu {{$type}} của bạn đã {{$status}}.</p>
                    <br>
                    <p style="color: #333333;">Vui lòng nhấn liên kết bên dưới phần thông tin để chuyển đến trang đổi mật khẩu.</p>
                    <p style="color: #333333;">Thông tin:</p>
                    <ul style="color: #333333;">
                        <li>Thời gian thực hiện: <b>{{date('H:i:s Y-m-d')}}</b></li>
                        <li>Liên kết đổi mật khẩu: <b><a href="{{$link}}"> Đổi mật khẩu tại đây </a></b></li>
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
