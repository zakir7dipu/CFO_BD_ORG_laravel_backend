@extends("backend.layouts.master")

@section("page-css")

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
                        <form action="{{ route('settings.general') }}" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Site Name <sup><i class="fa fa-star-of-life text-danger"></i></sup></label>
                                    <input type="text" name="name" id="name" class="form-control" required value="{{ setting('settings.general_settings.app_name')?setting('settings.general_settings.app_name'):old('name') }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="logo">Site Logo <sup><i class="fa fa-star-of-life text-danger"></i></sup> <code>(Size should be 120px X 60px)</code></label>
                                        <input type="file" name="logo" id="logo" class="form-control" value="{{ old('logo') }}">
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end my-1">
                                        <img src="{{ setting('settings.general_settings.app_logo')?setting('settings.general_settings.app_logo'):'' }}" alt="" class="img img-thumbnail img-fluid logoImg">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="favicon">Site Favicon <sup><i class="fa fa-star-of-life text-danger"></i></sup><code>(Size should be 45px X 20px)</code></label>
                                        <input type="file" name="favicon" id="favicon" class="form-control" value="{{ old('favicon') }}">
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end my-1">
                                        <img src="{{ setting('settings.general_settings.app_favicon')?setting('settings.general_settings.app_favicon'):'' }}" alt="" class="img img-thumbnail img-fluid faviconImg">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="facebook">Facebook Link</label>
                                        <input type="text" name="facebook" id="facebook" class="form-control" required value="{{ setting('settings.general_settings.facebook')?setting('settings.general_settings.facebook'):old('facebook') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="linkedin">Linkedin Link</label>
                                        <input type="text" name="linkedin" id="linkedin" class="form-control" required value="{{ setting('settings.general_settings.linkedin')?setting('settings.general_settings.linkedin'):old('linkedin') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="phone">Phone <sup><i class="fa fa-star-of-life text-danger"></i></sup></label>
                                        <input type="text" name="phone" id="phone" class="form-control" required value="{{ setting('settings.general_settings.phone')?setting('settings.general_settings.phone'):old('phone') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">Email <sup><i class="fa fa-star-of-life text-danger"></i></sup></label>
                                        <input type="text" name="email" id="email" class="form-control" required value="{{ setting('settings.general_settings.email')?setting('settings.general_settings.email'):old('email') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address <sup><i class="fa fa-star-of-life text-danger"></i></sup></label>
                                    <input type="text" name="address" id="address" class="form-control" required value="{{ setting('settings.general_settings.address')?setting('settings.general_settings.address'):old('address') }}">
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-primary w-25">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("page-script")
    <script>
        (function ($){
            "use script";
            document.querySelector("#logo").onchange = (ev) => {
                let input = ev.target;
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.logoImg').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
            document.querySelector("#favicon").onchange = (ev) => {
                let input = ev.target;
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.faviconImg').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        })(jQuery)
    </script>
@endsection
