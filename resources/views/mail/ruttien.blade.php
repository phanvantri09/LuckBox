<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thông báo Rút Tiền thành công</title>
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
                    <h2 style="color: #333333;">Thông báo Rút Tiền thành công</h2>  
                    <p style="color: #333333;">Xin chào:   <b>{{$infoUser->name}}</b> ,</p>
                    <p style="color: #333333;">Chúng tôi xin thông báo rằng yêu cầu Rút Tiền của bạn đã được xử lý thành công.</p>
                    <p style="color: #333333;">Thông tin chi tiết Rút Tiền:</p>
                    <ul style="color: #333333;">
                        <li>Số tiền: <b>{{number_format($trans->total).'đ'}}</b></li>
                        <li>Tài khoản nhận: <b>{{$trans->card_number}}</b></li>
                        <li>Ngày thực hiện: <b>{{$trans->created_at}}</b></li>
                    </ul>
                    <p style="color: #333333;">Vui lòng liên hệ với chúng tôi nếu bạn có bất kỳ câu hỏi hoặc yêu cầu hỗ trợ.</p>
                    <p style="color: #333333;">Trân trọng,</p>
                    <p style="color: #333333;">Đội ngũ hỗ trợ</p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>