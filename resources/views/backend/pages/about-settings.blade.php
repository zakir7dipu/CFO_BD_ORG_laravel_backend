@extends("backend.layouts.master")

@section("page-css")
    <style>
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
        }
    </style>
@endsection

@section("content")
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label for="title">Title <sup><i class="fa fa-star-of-life text-danger"></i></sup></label>
                                            <input type="text" name="title" id="title" class="form-control" required value="{{ setting('pages.about.title') }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description1">Description (1) <sup><i class="fa fa-star-of-life text-danger"></i></sup></label>
                                            <textarea name="description_1" id="description1" required>{!! setting('pages.about.description_1') !!}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="description2">Description (2)</label>
                                            <textarea name="description_2" id="description2">{!! setting('pages.about.description_2') !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-primary w-50">Save</button>
                                        </div>
                                        <div class="form-group">
                                            <img src="{{ asset(setting('pages.about.thumbnail')) }}" alt="" class="img img-fluid img-thumbnail aboutPageViewThumbnail">
                                            <label for="thumbnail">Thumbnail</label>
                                            <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="videoLink">Video Link</label>
                                            <input type="text" name="video_link" id="videoLink" class="form-control" value="{{ setting('pages.about.video_link') }}">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("page-script")
    <script src="{{ asset('js/ckeditor.js') }}"></script>
    <script>
        (function ($){
            "use script";
            document.querySelector("#thumbnail").onchange = (ev) => {
                let input = ev.target;
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.aboutPageViewThumbnail').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }

            ClassicEditor
                .create( document.querySelector( '#description1' ), {
                    // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
                } )
                .then( editor => {
                    window.editor = editor;
                } )
                .catch( err => {
                    console.error( err.stack );
                } );

            ClassicEditor
                .create( document.querySelector( '#description2' ), {
                    // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
                } )
                .then( editor => {
                    window.editor = editor;
                } )
                .catch( err => {
                    console.error( err.stack );
                } );
        })(jQuery)
    </script>
@endsection
