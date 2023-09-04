@extends('admin.index')
@section('css')
@endsection
@section('content')
    <style>
        .imageMain,
        .imageSlide,
        .imageItem,
        .imageItem0,
        .imageItem1,
        .imageItem2,
        .imageItem3,
        .imageItem4,
        .imageItem5,
        .imageItem6,
        .imageItem7 {
            visibility: hidden;
            position: absolute;
        }
    </style>
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
                    <form action="{{ route('product.addImagePost') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="row border">
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Ảnh chính hiển thị</label>
                                    <div id="image-form">
                                        <input type="file" name="imageMain" class="imageMain" accept="image/*">
                                        <div class="input-group my-3">
                                            <input type="text" class="form-control" disabled placeholder="Upload File"
                                                id="fileImageMain">
                                            <div class="input-group-append">
                                                <button type="button" class="browseImageMain btn btn-primary">Tải
                                                    lên</button>
                                            </div>
                                        </div>
                                    </div>
                                    @error('title')
                                        <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-9">
                                @if ($getAllByIDProductMain)
                                    <img src="{{\App\Helpers\ConstCommon::getLinkImageToStorage($getAllByIDProductMain->link_image) }}"
                                        id="previewImageMain" class="img-thumbnail">
                                @else
                                    <img src="https://placehold.it/80x80" id="previewImageSlide" class="img-thumbnail">
                                @endif
                            </div>
                        </div>
                        <div class="row border">
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Ảnh Slide</label>
                                    <div id="image-form">
                                        <input type="file" name="imageSlide" class="imageSlide" accept="image/*">
                                        <div class="input-group my-3">
                                            <input type="text" class="form-control" disabled placeholder="Upload File"
                                                id="fileImageSlide">
                                            <div class="input-group-append">
                                                <button type="button" class="browseImageSlide btn btn-primary">Tải
                                                    lên</button>
                                            </div>
                                        </div>
                                    </div>
                                    @error('title')
                                        <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-9">
                                @if ($getAllByIDProductMain)
                                    <img src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($getAllByIDProductMain->link_image) }}"
                                        id="previewImageMain" class="img-thumbnail">
                                @else
                                    <img src="https://placehold.it/80x80" id="previewImageSlide" class="img-thumbnail">
                                @endif
                            </div>
                        </div>
                        <div class="imageAllItem">
                            {{-- @dd($getAllByIDProductItem) --}}
                            @if ($getAllByIDProductItem)
                                @foreach ($getAllByIDProductItem as $key => $item)
                                    <div class="row ">
                                        <div class="col-sm-3">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Ảnh Thành Phần {{$key + 1}} </label>
                                                <div id="image-form">
                                                    <input type="file" name="imageItem0" class="imageItem0"
                                                        accept="image/*">
                                                    <div class="input-group my-3">
                                                        <input type="text" class="form-control" disabled
                                                            placeholder="Upload File" id="fileImageItem0">
                                                        <div class="input-group-append">
                                                            <button type="button"
                                                                class="browseImageItem0 btn btn-primary">Tải
                                                                lên</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                @error('title')
                                                    <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <img src="{{ \App\Helpers\ConstCommon::getLinkImageToStorage($item->link_image) }}" id="previewImageItem0"
                                                class="img-thumbnail">
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="row ">
                                    <div class="col-sm-3">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Ảnh Thành Phần 1</label>
                                            <div id="image-form">
                                                <input type="file" name="imageItem0" class="imageItem0" accept="image/*">
                                                <div class="input-group my-3">
                                                    <input type="text" class="form-control" disabled
                                                        placeholder="Upload File" id="fileImageItem0">
                                                    <div class="input-group-append">
                                                        <button type="button" class="browseImageItem0 btn btn-primary">Tải
                                                            lên</button>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('title')
                                                <div class="alert alert-danger">{{ $errors->first('title') }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <img src="https://placehold.it/80x80" id="previewImageItem0"
                                            class="img-thumbnail">
                                    </div>
                                </div>
                            @endif


                        </div>
                        <div class="row">
                            <div class="add_more_button btn btn-info"> Thêm ảnh thành phần</div>
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
    <script>
        $(".browseImageMain").on("click", function() {
            var file = $(this).parents().find(".imageMain");
            file.trigger("click");
            console.log(123);
        });
        $('input[name="imageMain"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $("#fileImageMain").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("previewImageMain").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });
    </script>
    <script>
        $(document).on("click", ".browseImageSlide", function() {
            var file = $(this).parents().find(".imageSlide");
            file.trigger("click");
        });
        $('input[name="imageSlide"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $("#fileImageSlide").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("previewImageSlide").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });
    </script>
    <script>
        $(document).on("click", ".browseImageItem0", function() {
            var file = $(this).parents().find(".imageItem0");
            file.trigger("click");
        });
        $('input[name="imageItem0"]').change(function(e) {
            var fileName = e.target.files[0].name;
            $("#fileImageItem0").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {
                // get loaded data and render thumbnail.
                document.getElementById("previewImageItem0").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });
    </script>
    <script>
        $(document).ready(function() {
            var max_fields_limit = 100; //set limit for maximum input fields

            var html = '';
            $('.add_more_button').click(function(e) {
                var index = $('.imageItemcount').length + 1; //initialize counter for text box
                var indexX = index + 1;
                e.preventDefault();
                html =
                    '<div class="row imageItemcount">' +
                    '<div class="col-sm-3">' +
                    '<div class="form-group">' +
                    '<label>Ảnh Thành Phần ' + indexX + '</label>' +
                    '<div id="image-form">' +
                    '<input type="file" name="imageItem' + index + '" class="imageItem' + index +
                    '" accept="image/*">' +
                    '<div class="input-group my-3">' +
                    '<input type="text" class="form-control" disabled placeholder="Upload File" id="fileImageItem' +
                    index + '">' +
                    '<div class="input-group-append">' +
                    '<button type="button" class="browseImageItem' + index +
                    ' btn btn-primary">Tải lên</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-sm-9">' +
                    '<img src="https://placehold.it/80x80" id="previewImageItem' + index +
                    '" class="img-thumbnail">' +
                    '</div>' +
                    '</div>';

                $('.imageAllItem').append(html);

                $(document).on("click", ".browseImageItem" + index, function() {
                    var file = $(this).parents().find(".imageItem" + index);
                    file.trigger("click");
                });
                $('input[name="imageItem' + index + '"]').change(function(e) {
                    var fileName = e.target.files[0].name;
                    $("#fileImageItem" + index).val(fileName);

                    var reader = new FileReader();
                    reader.onload = function(e) {
                        // get loaded data and render thumbnail.
                        document.getElementById("previewImageItem" + index).src = e.target
                            .result;
                    };
                    // read the image file as a data URL.
                    reader.readAsDataURL(this.files[0]);
                });
            });
        });
    </script>
@endsection
