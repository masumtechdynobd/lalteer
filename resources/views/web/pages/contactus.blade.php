@extends('web.layouts.master')
@section('content')
    {{-- top image section --}}
    <div class="container-fluid bg-breadcrumb-newsletter">
        <div class="container text-center py-5" style="max-width: 900px">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                Contact Us Page
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Contact Us</a></li>
            </ol>
        </div>
    </div>

    {{-- address, phone, email --}}
    <div class="container-fluid" style="margin-top: 100px">
        <div class="row">
            <div class="col-md-4">
                <div class="text-center">
                    <img src="{{ asset('/web/img/contact-us3.png') }}" alt="">
                    <p class="mt-3">{{ $setting->contact_address }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <img src="{{ asset('/web/img/contact-us2.png') }}" alt="">
                    <p class="mt-3">{{ $setting->phone_one }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <img src="{{ asset('/web/img/contact-us1.png') }}" alt="">
                    <p class="mt-3">{{ $setting->email_one }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- get in touch --}}
    <div class="container-fluid" style="margin-top: 35px;">
        <div class="row">
            <div class="col-md-4">
                <h1 style="color: #4D4C4C; font-weight: bold; font-size: 100px;">Get in Touch With us</h1>
                <p>Have a question or inquiry about our programs, how to get involved, or anything else? We're just an email
                    away.</p>
                <div class="d-flex">
                    <a class="btn btn-success btn-sm-square rounded-circle me-3" href="{{ $social->facebook }}"><i
                            class="fab fa-facebook-f text-white"></i></a>
                    <a class="btn btn-success btn-sm-square rounded-circle me-3" href="{{ $social->twitter }}"><i
                            class="fab fa-twitter text-white"></i></a>
                    <a class="btn btn-success btn-sm-square rounded-circle me-3" href="{{ $social->instagram }}"><i
                            class="fab fa-instagram text-white"></i></a>
                    <a class="btn btn-success btn-sm-square rounded-circle me-0" href="{{ $social->linkedin }}"><i
                            class="fab fa-linkedin-in text-white"></i></a>
                </div>
            </div>
            <div class="col-md-8">
                <form action="{{ route('contactusstore') }}" method="POST" class="p-4 rounded">
                    @csrf
                    <div class="row g-3">
                        <!-- Name Field -->
                        <div class="col-md-6">
                            <input type="text" class="form-control bg-light border-0 py-4 rounded-2" name="name"
                                placeholder="Your Name" required>
                        </div>
                        <!-- Email Field -->
                        <div class="col-md-6">
                            <input type="email" class="form-control bg-light border-0 py-4 rounded-2" name="email"
                                placeholder="E-mail Address" required>
                        </div>
                    </div>
                    <div class="row g-3 mt-3">
                        <!-- Phone Number Field -->
                        <div class="col-md-6">
                            <input type="text" class="form-control bg-light border-0 py-4 rounded-2" name="phone"
                                placeholder="Phone Number" required>
                        </div>
                        <!-- Subject Dropdown -->
                        <div class="col-md-6">
                            <select class="form-select bg-light border-0 py-4 rounded-2" name="subject" required>
                                <option value="" disabled selected>Select Subject</option>
                                <!-- Loop through subjects -->
                                @foreach ($rows as $row)
                                    <option value="{{ $row->id }}">{{ $row->subject_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row g-3 mt-3">
                        <!-- Message Field -->
                        <div class="col-md-12">
                            <textarea class="form-control bg-light border-0 py-4 rounded-2" rows="5" name="message"
                                placeholder="Write your message" required></textarea>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="row mt-4">
                        <div class="col">
                            <button type="submit"
                                class="btn buynow-btn rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">SEND US A
                                MESSAGE</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- contact to employee --}}
    <div class="container-fluid">
        <div class="text-center crops-margin mb-3 wow fadeInUp">
            <div class="d-flex justify-content-center align-items-center custom-gap-contact-us">
                <div>
                    <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                </div>
                <div>
                    <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                </div>
            </div>
            <h3 class="text-success fw-bold">CONTACT TO EMPLOYEE</h3>
            <p>Contact details of our employees [department wise] are given below. You may contact them to learn or ask more
                about any of your queries!!</p>
        </div>
    </div>

    <div class="container-fluid" style="margin-top: 60px;">

        <div class="page">

            <!-- tabs -->
            <div class="pcss3t pcss3t-effect-scale pcss3t-theme-1">
                <!-- Default "All" option -->
                <input type="radio" name="pcss3t" id="tab0" class="tab-content-all" checked>
                <label for="tab0">ALL</label>

                <!-- Generate radio buttons dynamically -->
                @foreach ($designations as $index => $designation)
                    <input type="radio" name="pcss3t" id="tab{{ $index + 1 }}"
                        class="tab-content-{{ $index + 1 }}">
                    <label for="tab{{ $index + 1 }}">{{ strtoupper($designation->title) }}</label>
                @endforeach

                <ul>
                    <!-- All Members Tab -->
                    <li class="tab-content tab-content-all typography">
                        <div class="total-boarddirectory-content">
                            <div class="px-4 combined-row-boardofdirectory">
                                <div class="row g-1 mt-4 justify-content-center">
                                    @foreach ($members as $member)
                                        <div class="col-md-3 col-lg-3 col-xl-3" data-wow-delay="0.2s">
                                            <div class="text-center position-relative px-2">
                                                <div
                                                    class="board-dicrescotry-sm-text-yo rounded-3 position-relative mx-auto">
                                                    <div
                                                        class="aboutus-image-container position-absolute top-0 start-50 translate-middle">
                                                        <img src="{{ asset($member->image_path) }}"
                                                            class="img-fluid rounded-circle border-white"
                                                            alt="{{ $member->title }}"
                                                            style="width: 323px; height: auto; border: 5px solid white; object-fit: cover;" />
                                                    </div>
                                                    <div
                                                        class="text-content d-flex flex-column justify-content-center align-items-center h-100 py-4">
                                                        <h6 class="text-white">{{ $member->title }}</h6>
                                                        <h5 class="mb-0 text-white">{{ $member->designation_id  }}</h5>
                                                        <p class="mb-0 text-white">{{ $member->description }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Dynamic Tabs for Each Designation -->
                    @foreach ($designations as $index => $designation)
                        <li class="tab-content tab-content-{{ $index + 1 }} typography">
                            <div class="total-boarddirectory-content">
                                <div class="px-4 combined-row-boardofdirectory">
                                    <div class="row g-1 mt-4 justify-content-center">
                                        @foreach ($members->where('designation_id', $designation->id) as $member)
                                            <div class="col-md-3 col-lg-3 col-xl-3" data-wow-delay="0.2s">
                                                <div class="text-center position-relative px-2">
                                                    <div
                                                        class="board-dicrescotry-sm-text-yo rounded-3 position-relative mx-auto">
                                                        <div
                                                            class="aboutus-image-container position-absolute top-0 start-50 translate-middle">
                                                            <img src="{{ asset('/uploads/member/' . $member->image_path) }}"
                                                                class="img-fluid rounded-circle border-white"
                                                                alt="{{ $member->title }}"
                                                                style="width: 323px; height: auto; border: 5px solid white; object-fit: cover;" />
                                                        </div>
                                                        <div
                                                            class="text-content-yo d-flex flex-column justify-content-center align-items-center h-100 py-4">
                                                            <h6 class="text-white">{{ $member->title }}</h6>
                                                            <h5 class="mb-0 text-white">{{ $member->designation->title ?? 'N/A' }}</h5>
                                                            <p class="mb-0 text-white px-4" style="color: white !important;">{{ \Illuminate\Support\Str::words(strip_tags($member->description), 20) }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>


            <!--/ tabs -->
        </div>
    </div>

    {{-- map --}}
    <div class="container-fluid" style="margin-top: 70px;">
        @foreach ($contactmaps as $contactmap)
            <img src="{{ asset($contactmap->photos_path) }}" alt="" style="width: 100%; height: 554px;">
        @endforeach
    </div>

    <!-- jQuery script to handle the content toggling -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initially, show photos and hide others
            $("#showPhotos").click(function() {
                $('#photos').collapse('show');
                $('#videos').collapse('hide');
                $('#news').collapse('hide');
            });

            $("#showVideos").click(function() {
                $('#videos').collapse('show');
                $('#photos').collapse('hide');
                $('#news').collapse('hide');
            });

            $("#showNews").click(function() {
                $('#news').collapse('show');
                $('#photos').collapse('hide');
                $('#videos').collapse('hide');
            });
        });


        function filterMembers(designationId) {
            const url = designationId ? `/contact-us?designation_id=${designationId}` : '/contact-us';
            window.location.href = url; // Redirect with query parameter
        }
    </script>
@endsection
