@extends("backend.layouts.master")

@section("page-css")
    <style>
        .cursor-pointer {
            cursor: pointer;
        }
        .cursor-zoom-in {
            cursor: zoom-in;
        }
        .sectionContainer {
            box-sizing: border-box;
            box-shadow: 2px 5px 3px rgba(0,0,0,.3);
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
                <div class="card sectionContainer col-12 p-0">
                    <div class="card-header bg-primary d-flex justify-content-between">
                        <span class="card-title">Sliders</span>
                        <i class="fa fa-arrow-down cursor-pointer extractBtn"></i>
                    </div>
                    <div class="card-body d-none">
                        <div class="row">
                            <div class="col-md-2 border-end">
                                <button class="btn btn-primary addSliderBtn" data-action="{{ route('settings.home-slider') }}"><i class="fa fa-plus"></i>Add New Slider</button>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    @foreach($sliders as $slider)
                                        <div class="col-md-4 p-1">
                                            <img class="img img-fluid img-thumbnail w-100 slider cursor-zoom-in" src="{{ $slider->img }}" alt="" data-action="{{ route('settings.home-slider-show',$slider->id) }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card sectionContainer col-12 p-0">
                    <div class="card-header bg-primary d-flex justify-content-between">
                        <span class="card-title">About Us</span>
                        <i class="fa fa-arrow-down cursor-pointer extractBtn"></i>
                    </div>
                    <div class="card-body d-none">
                        <form action="{{ route('settings.home-about') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 border-end">
                                    <div class="form-group">
                                        <img class="img img-thumbnail img-fluid" src="{{ asset(setting('pages.home.about.image')) }}" alt="" id="aboutImageView">
                                    </div>
                                    <div class="form-group">
                                        <label for="aboutImage">About Image <code>Size Should be 464px X 464px</code></label>
                                        <input class="form-control" type="file" name="about_img" id="aboutImage">
                                    </div>

                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="aboutSectionTitle">Title</label>
                                        <input type="text" name="title" id="aboutSectionTitle" required class="form-control" value="{{ setting('pages.home.about.title') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="aboutSectionDescription">Who you are?</label>
                                        <textarea type="text" name="description" id="aboutSectionDescription" required class="form-control">{!! setting('pages.home.about.description') !!}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card sectionContainer col-12 p-0">
                    <div class="card-header bg-primary d-flex justify-content-between">
                        <span class="card-title">Goal</span>
                        <i class="fa fa-arrow-down cursor-pointer extractBtn"></i>
                    </div>
                    <div class="card-body d-none">
                        <form action="{{ route('settings.home-goal') }}" method="post" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="aboutSectionTitle">Title</label>
                                        <input type="text" name="title" id="aboutSectionTitle" required class="form-control" value="{{ setting('pages.home.goal.title') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="goalSectionDescription">Your goal, mission & vision. </label>
                                        <textarea type="text" name="description" id="goalSectionDescription" required>{!! setting('pages.home.goal.description') !!}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 border-end">
                                    <div class="form-group">
                                        <img class="img img-thumbnail img-fluid" src="{{ asset(setting('pages.home.goal.image')) }}" alt="" id="goalImageView">
                                    </div>
                                    <div class="form-group">
                                        <label for="goalImage">Goal Image <code>Size Should be 464px X 464px</code></label>
                                        <input class="form-control" type="file" name="goal_img" id="goalImage">
                                    </div>

                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card sectionContainer col-12 p-0">
                    <div class="card-header bg-primary d-flex justify-content-between">
                        <span class="card-title">Events</span>
                        <i class="fa fa-arrow-down cursor-pointer extractBtn"></i>
                    </div>
                    <div class="card-body d-none">
                        <div class="row">
                            <div class="col-md-2 border-end">
                                <button class="btn btn-primary addEventBtn" data-action="{{ route('settings.home-event') }}"><i class="fa fa-plus"></i>Add New Event</button>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    @foreach($events as $event)
                                        <div class="col-md-4 p-1">
                                            <img class="img img-fluid img-thumbnail w-100 event cursor-zoom-in" src="{{ $event->img }}" alt="" data-action="{{ route('settings.home-event-show',$event->id) }}">
                                            <h6 class="text-center mt-1">{{ substr($event->title, 0, 40) }}</h6>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="popUpModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

            </div>
        </div>
    </div>
@endsection

@section("page-script")
    <script src="{{ asset('js/ckeditor.js') }}"></script>
    <script>
        (function ($){
            "use script";
            let extractBtns = document.querySelectorAll(".extractBtn");
            let addSliderBtn = document.querySelector(".addSliderBtn");
            let editSliderBtns = document.querySelectorAll(".slider.cursor-zoom-in");
            let addEventBtn = document.querySelector(".addEventBtn");
            let editEventBtns = document.querySelectorAll(".event.cursor-zoom-in");

            // slider
            addSliderBtn.addEventListener('click', ()=>{
                let url = addSliderBtn.getAttribute("data-action")
                $.ajax({
                    type: 'get',
                    url: url,
                    success:data=>{
                        $('#popUpModal .modal-content').empty().append(data);
                        $('#popUpModal').modal("show");
                        onInputImageShow();
                    }
                })
            })
            editSliderBtns.forEach(button => {
                button.addEventListener('click', ()=>{
                    let url = button.getAttribute("data-action")
                    $.ajax({
                        type: 'get',
                        url: url,
                        success:data=>{
                            $('#popUpModal .modal-content').empty().append(data);
                            $('#popUpModal').modal("show");
                            onInputImageShow();
                        }
                    })
                })
            })
            const onInputImageShow = () => {
                document.querySelector("#sliderImage").onchange = (ev) => {
                    let input = ev.target;
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#sliderImageView').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            // about
            document.querySelector("#aboutImage").onchange = (ev) => {
                let input = ev.target;
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#aboutImageView').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }

            // goal
            document.querySelector("#goalImage").onchange = (ev) => {
                let input = ev.target;
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#goalImageView').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
            ClassicEditor
                .create( document.querySelector( '#goalSectionDescription' ), {
                    // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
                } )
                .then( editor => {
                    window.editor = editor;
                } )
                .catch( err => {
                    console.error( err.stack );
                } );

            // event
            addEventBtn.addEventListener('click', ()=>{
                let url = addEventBtn.getAttribute("data-action")
                $.ajax({
                    type: 'get',
                    url: url,
                    success:data=>{
                        $('#popUpModal .modal-content').empty().append(data);
                        $('#popUpModal').modal("show");
                        onInputEventImageShow();
                    }
                })
            })
            editEventBtns.forEach(button => {
                button.addEventListener('click', ()=>{
                    let url = button.getAttribute("data-action")
                    $.ajax({
                        type: 'get',
                        url: url,
                        success:data=>{
                            $('#popUpModal .modal-content').empty().append(data);
                            $('#popUpModal').modal("show");
                            onInputEventImageShow();
                        }
                    })
                })
            })
            const onInputEventImageShow = () => {
                document.querySelector("#eventImage").onchange = (ev) => {
                    let input = ev.target;
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#eventImageView').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
                ClassicEditor
                    .create( document.querySelector( '#eventDescription' ), {
                        // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
                    } )
                    .then( editor => {
                        window.editor = editor;
                    } )
                    .catch( err => {
                        console.error( err.stack );
                    } );
            }

            extractBtns.forEach(button => {
                button.addEventListener("click",(e)=>{
                    let expandAbleSection = e.target.closest('.card').querySelector(".card-body");
                    if(expandAbleSection.classList.contains("d-none")){
                        expandAbleSection.classList.remove("d-none")
                        e.target.classList.remove('fa-arrow-down')
                        e.target.classList.add('fa-arrow-up')
                    } else {
                        expandAbleSection.classList.add("d-none")
                        e.target.classList.add('fa-arrow-down')
                        e.target.classList.remove('fa-arrow-up')
                    }
                })
            })
        })(jQuery)
    </script>
@endsection
