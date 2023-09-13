@extends('user.layout.index')
<style>
    /* .main {
        background-color: rgb(255, 235, 226);
    } */
</style>
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Về chúng tôi</p>
        </div>
    </div>

    <div class="main">
        <div class="container py-md-5 py-lg-4 py-1">
            <div class="row px-md-5 px-lg-3 px-1 align-items-center">
                
                <div class="col-lg-6 col-md-12 col-12 p-4">
                    <h5>Về chúng tôi</h5>
                    <p>Công ty cổ phần công nghệ điện tử LUCKBOX chuyên kinh doanh trong lĩnh vực thương mại điện tử với đội ngũ hùng hậu và dây chuyền chuyên nghiệp hứa hẹn sẽ mang lại một làn sóng mới tại thị trường Việt Nam. <br><br>

                         Ra đời với sứ mệnh mang lại sự mới mẻ cho thị trường hàng hóa điện máy bằng cách kết hợp mô hình đầu tư và giải trí. <br><br>
                        
                         Mô hình Được phát triển khá thành công tại một số quốc gia khu vực Đông Nam Á như Singapore, Thái Lan…<br>
                         
                         Nhân dịp công ty ra mắt tại thị trường Việt nam. Để quảng bá hình ảnh của công ty và tri ân đến với khách hàng. Chúng tôi triển khai chương trình sự kiện Hộp quà may mắn với nhiều sản phẩm chính hãng có giá trị cao đến với khách hàng.<br><br>
                         Hãy tham gia trải nghiệm các tính năng mới mẻ chỉ có tại <a href="{{ route('home') }}" target="_blank" rel="noopener noreferrer">luckboxvn.com</a> để mang lại lợi nhuận cao nhất.<br><br>

                         Ngoài ra, chung tay chia sẽ giới thiệu bạn bè cùng tham gia bạn sẽ nhận ngay hoa hồng hấp dẫn trên mỗi giao dịch.<br>
                         Chúng tôi cam kết: Sự hài lòng của khách hàng là niềm động lực để chúng tôi ra mắt những sản phẩm ưu đãi hấp dẫn lớn hơn trong tương lai.
                    </p>
               </div>
               <div class="col-lg-6 d-lg-block d-none">
                    <img src="{{ asset('/dist/img/gift.png') }}" width="100%">
                </div>
            </div>
        </div>
    </div>
    <div class="container py-2">
        <div class="row py-md-4 py-3">
            <div class="col-md-7 col-12">
                <h4>Công ty cổ phần công nghệ điện tử LUCKBOX</h4>
                <p></p>
            </div>
            <div class="col-md-5 col-12">
                <h4>Liên hệ với chúng tôi</h4>
                <p class="mb-0">Địa chỉ: Tòa nhà Daeha Business Center, 360 Kim Mã, Ba Đình, Hà Nội</p>
                <p class="mb-0">Hotline: 1900159639</p>
                <p class="mb-0">Email: cskh@luckboxvn.com</p>
            </div>
        </div>
        <div id="map-container-google-1" class="z-depth-1-half map-container" style="height: 500px">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14896.1826523386!2d105.79414938554888!3d21.03085883320108!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abbe77f205fd%3A0xe946970a03f39286!2sDAEHA%20BUSINESS%20CENTER!5e0!3m2!1svi!2sus!4v1692212241514!5m2!1svi!2sus"
                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

    </div>
@endsection
@section('scripts')
@endsection
