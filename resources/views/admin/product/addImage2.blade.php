@extends('admin.index')
@section('css')
    <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.min.css">
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">
                        {{-- @isset($title)
                            {{ $title }}
                        @else
                            Chưa có tiêu đề cho trang này
                        @endisset --}}
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('product.addImagePost', ['id'=>$id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Ảnh chính hiển thị</label>
                                    <div class="custom-file">
                                        <input onchange="readURL(this)" name="imageMain" type="file" accept="image/*" class="custom-file-input" id="inputFileImageMain">
                                        <label class="custom-file-label" for="inputFileImageMain">Chọn ảnh</label>
                                    </div>
                                    @error('imageMain')
                                    <div class="alert alert-danger">{{ $errors->first('imageMain') }}</div>
                                    @enderror
                                </div>
                                @if($getAllByIDProductMain)
                                    <div class="d-flex flex-row mt-4">
                                        <img id="img-preview" style="width: 200px;height: 200px; object-fit: cover;" class="rounded" src="{{\App\Helpers\ConstCommon::getLinkImageToStorage( $getAllByIDProductMain['link_image'] ?? null)}}">
                                    </div>
                                @else
                                    <div class="d-flex flex-row mt-4">
                                        <img id="img-preview" style="width: 200px;height: 200px; object-fit: cover;" class="rounded" src="https://ami-sni.com/wp-content/themes/consultix/images/no-image-found-360x250.png">
                                    </div>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Ảnh slide</label>
                                    <div class="custom-file">
                                        <input onchange="readURL2(this)" name="imageSlide" accept="image/*" type="file" class="custom-file-input" id="inputFileImageSlide">
                                        <label class="custom-file-label" for="inputFileImageSlide">Chọn ảnh</label>
                                    </div>
                                    @error('imageSlide')
                                    <div class="alert alert-danger">{{ $errors->first('imageSlide') }}</div>
                                    @enderror
                                </div>
                                @if($getAllByIDProductSlide)
                                    <div class="d-flex flex-row mt-4">
                                        <img id="img-preview2" style="width: 200px;height: 200px; object-fit: cover;" class="rounded" src="{{\App\Helpers\ConstCommon::getLinkImageToStorage( $getAllByIDProductSlide['link_image'] ?? null)}}">
                                    </div>
                                @else
                                    <div class="d-flex flex-row mt-4">
                                        <img id="img-preview2" style="width: 200px;height: 200px; object-fit: cover;" class="rounded" src="https://ami-sni.com/wp-content/themes/consultix/images/no-image-found-360x250.png">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Ảnh thành phần</label>
                                    <div class="custom-file">
                                        <input onchange="readURL3(this)" multiple="" name="imageItem[]" type="file" class="custom-file-input" id="inputFileImageItem" accept="image/*">
                                        <label class="custom-file-label" for="inputFileImageItem">Chọn ảnh</label>
                                    </div>
                                    @error('imageItem')
                                    <div class="alert alert-danger">{{ $errors->first('imageItem') }}</div>
                                    @enderror
                                    <div id="image-preview-container" class="d-flex flex-row mb-3 mt-3">
                                    </div>
                                    <div class="d-flex flex-row mb-3 mt-3">
                                        @if(count($getAllByIDProductItem))
                                            @foreach ($getAllByIDProductItem as $key => $item)
                                                <div class="d-flex flex-column justify-content-center text-center">
                                                    <img style="width: 200px;height: 200px; object-fit: cover; margin-bottom: 5px;" class="rounded mr-3" src="{{\App\Helpers\ConstCommon::getLinkImageToStorage( $item->link_image ?? null)}}">
                                                    <a class="text-danger" href="{{ route('product.deleteImage', ['id' => $item->id]) }}">
                                                        <i class="fas fa-trash-alt">&nbsp; Xóa ảnh</i>   
                                                    </a>
                                                </div>                                         
                                                @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Lưu lại</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="../../plugins/summernote/summernote-bs4.min.js"></script>
    <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
        $(function () {
            // Summernote
            $('#summernoteDescription').summernote()
        })

        let noimage =
            "https://ami-sni.com/wp-content/themes/consultix/images/no-image-found-360x250.png";

        function readURL(input) {
            console.log(input.files);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#img-preview").attr("src", e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                $("#img-preview").attr("src", noimage);
            }
        }

        function readURL2(input) {
            console.log(input.files);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#img-preview2").attr("src", e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                $("#img-preview2").attr("src", noimage);
            }
        }

        function readURL3(input) {
            $("#image-preview-container").empty();

            if (input.files && input.files.length > 0) {
                for (let i = 0; i < input.files.length; i++) {
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        let imgPreview = $('<img style="width: 200px;height: 200px; object-fit: cover;" class="rounded mr-3"  />');
                        imgPreview.attr("src", e.target.result);
                        $("#image-preview-container").append(imgPreview);
                    };

                    reader.readAsDataURL(input.files[i]);
                }
            } else {
                let imgPreview = $('<img style="width: 200px;height: 200px; object-fit: cover;" class="rounded mr-3"  />');
                imgPreview.attr("src", noimage);
                $("#image-preview-container").append(imgPreview);
            }
        }
    </script>
@endsection
