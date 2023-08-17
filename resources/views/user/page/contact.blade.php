@extends('user.layout.index')
<style>
    .main {
        background-color: rgb(255, 235, 226);
    }
</style>
@section('css')
@endsection
@section('content')
    <div class="bg-white text-orange title-page">
        <div class="container">
            <p>LuckyBox | Liên hệ</p>
        </div>
    </div>

    <div class="main">
        <div class="container py-md-5 py-lg-4 py-1">
            <div class="row px-md-5 px-lg-3 px-1 align-items-center">
                <div class="col-lg-6 d-lg-block d-none">
                    <img src="{{ asset('/dist/img/gift.png') }}" width="100%">
                </div>
                <form action="" method="post" class="col-lg-6 col-md-12 col-12 p-4">
                    <h5>Bạn cần hỗ trợ?</h5>
                    <p>Rất hân hạnh được hỗ trợ bạn, hãy để lại thông tin cho chúng tôi nhé. Yêu cầu của bạn sẽ được xử lý
                        và phản hồi trong thời gian sớm nhất</p>
                    <div class="row">
                        <div class="form-group col-md-6 col-12">
                            <label for="formGroupExampleInput">Họ tên*</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Tên đầy đủ">
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label for="exampleInputEmail1">Email*</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="Địa chỉ Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Example textarea</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Đừng ngại khi nói về thắc mắc của bạn!"
                            rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn bg-success text-white">Gửi câu hỏi</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container py-2">
        <div class="row py-md-4 py-3">
            <div class="col-md-7 col-12">
                <h4>Công ty cổ phần công nghệ điện tử LUCKBOX</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem minus enim nostrum voluptas voluptate
                    magni impedit sunt. Iure quasi voluptas deleniti culpa! Aliquam vero nostrum, soluta recusandae tenetur
                    placeat molestias.</p>
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
