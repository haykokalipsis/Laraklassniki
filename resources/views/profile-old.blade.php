@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-md-4">
                <div class="text-center card-box">
                    <div class="member-card">
                        <div class="thumb-xl member-thumb m-b-10 center-block">
                            <img src="{{ $user->lastImage ? asset('img/users/' . $user->avatar->thumbnail_path ) : asset('img/defaults/avatars/male.png') }}" class="img-circle img-thumbnail" id="avatar" alt="profile-image">
                        </div>

                        <div class="">
                            <h4 class="m-b-5">{{ $user->name }}</h4>
                            <p class="text-muted">{{ $user->email }}</p>
                        </div>

                        <!-- Friend request component -->
                        @if(auth()->id() !== $user->id)
                            <friend-component
                                    profile_user_id="{{ $user->id }}">

                            </friend-component>
                        @endif
                    <!-- Friend request component END-->

                        {{--                        <button type="button" class="btn btn-success btn-sm w-sm waves-effect m-t-10 waves-light">Follow</button>--}}
                        <button type="button" class="btn btn-danger btn-sm w-sm waves-effect m-t-10 waves-light">Message</button>

                        <div class="text-left m-t-40">
                            <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">Johnathan Deo</span></p>
                            <p class="text-muted font-13"><strong>Mobile :</strong><span class="m-l-15">(123) 123 1234</span></p>
                            <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">johndoe@bootdey.com</span></p>
                            <p class="text-muted font-13"><strong>Location :</strong> <span class="m-l-15">USA</span></p>
                        </div>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->

            <div class="col-md-8 col-lg-9">
                <div class="">
                    <div class="">
                        <ul class="nav nav-tabs">
                            <li class="">
                                <a href="#home" data-toggle="tab" aria-expanded="false">
                                    <span class="visible-xs"><i class="fa fa-user"></i></span>
                                    <span class="hidden-xs">ABOUT ME</span>
                                </a>
                            </li>

                            <li class="active">
                                <a href="#profile" data-toggle="tab" aria-expanded="true">
                                    <span class="visible-xs"><i class="fa fa-photo"></i></span>
                                    <span class="hidden-xs">GALLERY</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#settings" data-toggle="tab" aria-expanded="false">
                                    <span class="visible-xs"><i class="fa fa-cog"></i></span>
                                    <span class="hidden-xs">SETTINGS</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="home">
                                <p class="m-b-5">Hi I'm Johnathn Deo,has been the industry's standard dummy text ever
                                    since the 1500s, when an unknown printer took a galley of type.
                                    Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.
                                    In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                                    Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras
                                    dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend
                                    tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend
                                    ac, enim.</p>

                                <div class="m-t-30">
                                    <h4>Experience</h4>

                                    <div class=" p-t-10">
                                        <h5 class="text-primary m-b-5">Lead designer / Developer</h5>
                                        <p class="">websitename.com</p>
                                        <p><b>2010-2015</b></p>

                                        <p class="text-muted font-13 m-b-0">Lorem Ipsum is simply dummy text
                                            of the printing and typesetting industry. Lorem Ipsum has
                                            been the industry's standard dummy text ever since the
                                            1500s, when an unknown printer took a galley of type and
                                            scrambled it to make a type specimen book.
                                        </p>
                                    </div>

                                    <hr>

                                    <div class="">
                                        <h5 class="text-primary m-b-5">Senior Graphic Designer</h5>
                                        <p class="">coderthemes.com</p>
                                        <p><b>2007-2009</b></p>

                                        <p class="text-muted font-13">Lorem Ipsum is simply dummy text
                                            of the printing and typesetting industry. Lorem Ipsum has
                                            been the industry's standard dummy text ever since the
                                            1500s, when an unknown printer took a galley of type and
                                            scrambled it to make a type specimen book.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="profile">

                                <form id="imagesForm">

                                    <div class="form-group">
{{--                                        <label for="chooseImages">Select new images</label>--}}
                                        <label for="chooseImages" class="btn btn-primary" aria-hidden="true">Select new images</label>
                                        <input hidden type="file" name="images" id="chooseImages" class="form-control-file" multiple>
                                    </div>

{{--                                    <label for="upload">--}}
{{--                                        <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>--}}
{{--                                        <input type="file" id="upload" style="display:none">--}}
{{--                                    </label>--}}

                                    <div class="card">
                                        <div class="card-body" id="imgs">
{{--                                            <img src="https://via.placeholder.com/300x300/" alt="" width="80" height="80">--}}
{{--                                            <img src="https://via.placeholder.com/300x300/" alt="" width="80" height="80">--}}
{{--                                            <img src="https://via.placeholder.com/300x300/" alt="" width="80" height="80">--}}
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <input type="submit" class="btn btn-primary waves-effect waves-light w-md" value="Upload">
                                    </div>
                                </form>

                                <div class="row gallery">

                                    @foreach($images as $image)
                                        <div class="col-lg-3 col-md-4 col-6 image-popup">
                                            <a href="#" class="d-block mb-4 h-100">
                                                <img class="img-fluid thumb-img" src="{{ asset('img/users/' . $image->thumbnail_path) }}" data-original_path="{{ asset('img/users/' . $image->original_path)  }}" data-id="{{ $image->id }}" alt="">
                                            </a>
                                        </div>
                                    @endforeach

                                    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                    <img src="" id="imagepreview" style="width: 100%;" >
                                                </div>

                                                <div class="modal-footer">
                                                    <button id="set-main" type="button" class="btn btn-primary">Set Main</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="settings">
                                @include('components.flash-messages')

                                <form role="form" method="post" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="FullName">Full Name</label>
                                        <input type="text" value="{{ $user->name }}" name="name" id="FullName" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input type="text" value="{{ $user->location}}" name="location" id="location" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="Email">Email</label>
                                        <input type="email" value="{{ $user->email }}" name="email" id="Email" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="AboutMe">About Me</label>
                                        <textarea style="height: 125px" id="AboutMe" name="about" class="form-control">{{ $user->about }}</textarea>
                                    </div>

                                    <button class="btn btn-primary waves-effect waves-light w-md" type="submit">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
@endsection

@push('scripts')
    <script>

        $(document).ready(function () {
            window.images = [];

            function handleFileSelect(e) {
                let files = e.target.files,
                    filesLength = files.length;

                // Loop through the FileList and render image files as thumbnails.
                for (let i = 0; i < filesLength; i++) {
                    let f = files[i];

                    // Only process image files.
                    if (!f.type.match('image.*')) {
                        continue;
                    }

                    images.push(f);

                    let fileReader = new FileReader();

                    // Closure to capture the file information.
                    fileReader.onload = (function (theFile) {

                        return function (e) {

                            // Render thumbnail.
                            $(`<span class='pip'>
		                                <img class='thumbnail' width="100" height="100"  src='${e.target.result}' title='${theFile.name}'/>
		                                <br/>
		                                <span class='remove'>Remove image</span>
		                            </span>`)
                                .appendTo("#imgs");

                        }

                    })(f);

                    // Read in the image file as a data URL.
                    fileReader.readAsDataURL(f);
                }

                console.log(images);
            }

            // Dont know how to do this with jquery, bubbling should be false
            document.getElementById('chooseImages').addEventListener('change', handleFileSelect, false);

            $(document).on('click', '.remove', function () {
                let imgname = $(this).closest(".pip").children('.thumbnail').attr('title');

                for (var j = 0; j < images.length; j++)
                    if (images[j].name == imgname)
                        images.splice(j, 1);

                $(this).closest(".pip").remove();
                console.log(images);
            });


            $('#imagesForm').on('submit', function (event) {

                event.preventDefault();
                var formData = new FormData(this);

                for (var i = 0; i < images.length; i++)
                    formData.append('images[]', images[i]);

                console.log(images);

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: '{{ route("images.upload") }}',
                    method: 'post',
                    data: formData,
                    success: function (data) {
                        alert(data);
                        location.reload();
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });


            });

            $(function() {
                $('.image-popup').on('click', function(e) {
                    e.preventDefault();
                    $('#imagepreview')
                        .attr('src', $(this).find('img').data('original_path'))
                        .data('id', $(this).find('img').data('id'));

                    $('#imagemodal').modal('show');
                });


                $('#set-main').click(function (e) {
                    e.preventDefault();
                    let imageId = $('#imagepreview').data('id');
                    let button = $(this);
                    button.attr('disabled', true);

                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type: 'POST',
                        url: "{{ route('images.set-main') }}",
                        data: {id: imageId},
                        dataType: 'JSON',
                        success: function (data) {
                            alert(data);
                        },
                        error: function (xhr, str) {
                            alert('Возникла ошибка: ' + xhr.responseCode);
                        },
                        complete: function (data) {
                            button.attr('disabled', false);
                            console.log(data);
                            $('#avatar').attr('src', `/img/users/${data.responseJSON}`);
                            $('#imagemodal').modal('hide');
                        }
                    });
                })
            });

        });

    </script>
@endpush



@push('styles')
    <style>
        body{
            margin-top:20px;
            background:#f5f5f5;
        }
        /* ===========
           Profile
         =============*/
        .card-box {
            padding: 20px;
            box-shadow: 0 2px 15px 0 rgba(0, 0, 0, 0.06), 0 2px 0 0 rgba(0, 0, 0, 0.02);
            -webkit-border-radius: 5px;
            border-radius: 5px;
            -moz-border-radius: 5px;
            background-clip: padding-box;
            margin-bottom: 20px;
            background-color: #ffffff;
        }
        .header-title {
            text-transform: uppercase;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.04em;
            line-height: 16px;
            margin-bottom: 8px;
        }
        .social-links li a {
            -webkit-border-radius: 50%;
            background: #EFF0F4;
            border-radius: 50%;
            color: #7A7676;
            display: inline-block;
            height: 30px;
            line-height: 30px;
            text-align: center;
            width: 30px;
        }

        /* ===========
           Gallery
         =============*/
        .portfolioFilter a {
            -moz-box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.1);
            -moz-transition: all 0.3s ease-out;
            -ms-transition: all 0.3s ease-out;
            -o-transition: all 0.3s ease-out;
            -webkit-box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.1);
            -webkit-transition: all 0.3s ease-out;
            box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.1);
            color: #333333;
            padding: 5px 10px;
            display: inline-block;
            transition: all 0.3s ease-out;
        }
        .portfolioFilter a:hover {
            background-color: #228bdf;
            color: #ffffff;
        }
        .portfolioFilter a.current {
            background-color: #228bdf;
            color: #ffffff;
        }
        .thumb {
            background-color: #ffffff;
            border-radius: 3px;
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            padding-bottom: 10px;
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 10px;
            width: 100%;
        }
        .thumb-img {
            border-radius: 2px;
            overflow: hidden;
            width: 100%;
        }
        .gal-detail h4 {
            margin: 16px auto 10px auto;
            width: 80%;
            white-space: nowrap;
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .gal-detail .ga-border {
            height: 3px;
            width: 40px;
            background-color: #228bdf;
            margin: 10px auto;
        }




        .tabs-vertical-env .tab-content {
            background: #ffffff;
            display: table-cell;
            margin-bottom: 30px;
            padding: 30px;
            vertical-align: top;
        }
        .tabs-vertical-env .nav.tabs-vertical {
            display: table-cell;
            min-width: 120px;
            vertical-align: top;
            width: 150px;
        }
        .tabs-vertical-env .nav.tabs-vertical li.active > a {
            background-color: #ffffff;
            border: 0;
        }
        .tabs-vertical-env .nav.tabs-vertical li > a {
            color: #333333;
            text-align: center;
            font-family: 'Roboto', sans-serif;
            font-weight: 500;
            white-space: nowrap;
        }
        .nav.nav-tabs > li.active > a {
            background-color: #ffffff;
            border: 0;
        }
        .nav.nav-tabs > li > a {
            background-color: transparent;
            border-radius: 0;
            border: none;
            color: #333333 !important;
            cursor: pointer;
            line-height: 50px;
            font-weight: 500;
            padding-left: 20px;
            padding-right: 20px;
            font-family: 'Roboto', sans-serif;
        }
        .nav.nav-tabs > li > a:hover {
            color: #228bdf !important;
        }
        .nav.tabs-vertical > li > a {
            background-color: transparent;
            border-radius: 0;
            border: none;
            color: #333333 !important;
            cursor: pointer;
            line-height: 50px;
            padding-left: 20px;
            padding-right: 20px;
        }
        .nav.tabs-vertical > li > a:hover {
            color: #228bdf !important;
        }
        .tab-content {
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
            color: #777777;
        }
        .nav.nav-tabs > li:last-of-type a {
            margin-right: 0px;
        }
        .nav.nav-tabs {
            border-bottom: 0;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
        }
        .navtab-custom li {
            margin-bottom: -2px;
        }
        .navtab-custom li a {
            border-top: 2px solid transparent !important;
        }
        .navtab-custom li.active a {
            border-top: 2px solid #228bdf !important;
        }
        .nav-tab-left.navtab-custom li a {
            border: none !important;
            border-left: 2px solid transparent !important;
        }
        .nav-tab-left.navtab-custom li.active a {
            border-left: 2px solid #228bdf !important;
        }
        .nav-tab-right.navtab-custom li a {
            border: none !important;
            border-right: 2px solid transparent !important;
        }
        .nav-tab-right.navtab-custom li.active a {
            border-right: 2px solid #228bdf !important;
        }
        .nav-tabs.nav-justified > .active > a,
        .nav-tabs.nav-justified > .active > a:hover,
        .nav-tabs.nav-justified > .active > a:focus,
        .tabs-vertical-env .nav.tabs-vertical li.active > a {
            border: none;
        }
        .nav-tabs > li.active > a,
        .nav-tabs > li.active > a:focus,
        .nav-tabs > li.active > a:hover,
        .tabs-vertical > li.active > a,
        .tabs-vertical > li.active > a:focus,
        .tabs-vertical > li.active > a:hover {
            color: #228bdf !important;
        }

        .nav.nav-tabs + .tab-content {
            background: #ffffff;
            margin-bottom: 20px;
            padding: 20px;
        }
        .progress.progress-sm .progress-bar {
            font-size: 8px;
            line-height: 5px;
        }

        /*----------------------------------------*/


        input[type="file"] {
            display: block;
        }

        .thumbnail {
            max-height: 75px;
            border: 2px solid;
            padding: 1px;
            cursor: pointer;
        }

        .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
        }

        .remove {
            display: block;
            background: #444;
            border: 1px solid black;
            color: white;
            text-align: center;
            cursor: pointer;
        }

        .remove:hover {
            background: white;
            color: black;
        }

    </style>
@endpush
