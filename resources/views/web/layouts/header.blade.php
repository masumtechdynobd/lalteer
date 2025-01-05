<style>
    ul .li {
        text-decoration: none;
        color: black;
    }
</style>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <!-- Video Loader -->
        <video autoplay muted loop playsinline style="max-width: 80%; max-height: 80%;">
            <source src="/uploads/website-loading-video.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <!-- Spinner End -->

    <!-- Topbar Start -->
    <div class="bg-light">
        <div class="container-fluid topbar px-5 d-none d-lg-block">
            <div class="row gx-0 align-items-center">
                <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                    <div class="d-flex flex-wrap">
                        <a href="tel:+880 2 58610012-18" class="text-muted small me-4"><i
                                class="fas fa-phone-alt text-primary me-2"></i>{{ $setting->phone_one }}</a>
                        <a href="tel:+880 2 58610012-18" class="text-muted small me-4"><i
                                class="fas fa-phone-alt text-primary me-2"></i>{{ $setting->phone_two }}</a>
                    </div>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <div class="d-inline-flex align-items-center" style="height: 45px;">
                        <a href="#" class="me-3 text-dark text-decoration-none">
                            <small>CATALOGUE</small>
                        </a>
                        <div class="bg-white px-4 py-1 rounded d-flex justify-content-between align-items-center">
                            <span class="me-2">EN</span>
                            <div class="vr mx-2"></div>
                            <span class="text-danger">বাং</span>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="{{ url('/') }}" class="navbar-brand p-0">
                <!-- <h1 class="text-primary"><i class="fas fa-search-dollar me-3"></i>Stocker</h1> -->
                <img src="{{ asset('/uploads/setting/' . $setting->logo_path) }}" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto py-0">
                    <a href="{{ route('home') }}" class="nav-item nav-link active">HOME</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="dropdown">
                            <span class="dropdown-toggle">ABOUT US</span>
                        </a>
                        <div class="dropdown-menu m-0">
                            <a href="{{ route('aboutus') }}" class="dropdown-item">ABOUT US</a>
                            <a href="{{ route('aboutushistory') }}" class="dropdown-item">HISTORY</a>
                        </div>
                    </div>
                    @php
                        $categories = \App\Models\CropsCategory::get();

                    @endphp
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="dropdown">
                            <span class="dropdown-toggle">CROPS</span>
                        </a>
                        <div class="dropdown-menu m-0 dropdown-grid">
                            @foreach ($categories as $category)
                                <a href="{{ route('crops', $category->slug) }}"
                                    class="dropdown-item text-start">{{ $category->title }}</a>
                            @endforeach
                        </div>
                    </div>

                    <a href="{{ route('researchanddevelopment') }}" class="nav-item nav-link">R & D</a>
                    <a href="{{ route('farmers') }}" class="nav-item nav-link">FARMERS</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="dropdown">
                            <span class="dropdown-toggle">PROJECTS</span>
                        </a>
                        <div class="dropdown-menu m-0">
                            <a href="{{ route('projects') }}" class="dropdown-item">ALL</a>
                            <a href="{{ route('projects', ['status' => 'ongoing']) }}" class="dropdown-item">ON
                                GOING</a>
                            <a href="{{ route('projects', ['status' => 'completed']) }}"
                                class="dropdown-item">COMPLETE</a>
                        </div>

                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="dropdown">
                            <span class="dropdown-toggle">NEWSLETTER</span>
                        </a>
                        <div class="dropdown-menu m-0">
                            <a href="{{ route('newsletter', ['section' => 'photos']) }}"
                                class="dropdown-item">PHOTOS</a>
                            <a href="{{ route('newsletter', ['section' => 'videos']) }}"
                                class="dropdown-item">VIDEOS</a>
                            <a href="{{ route('newsletter', ['section' => 'news']) }}" class="dropdown-item">NEWS &
                                BLOGS</a>
                        </div>
                    </div>

                    <a href="{{ route('gallery') }}" class="nav-item nav-link">GALERY</a>
                    <a href="{{ route('contactus') }}" class="nav-item nav-link">CONTACT US</a>
                </div>
                <a href="#" class="btn buynow-btn rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">BUY NOW</a>
                <button type="button" class="btn btn-danger ms-2" data-bs-toggle="modal"
                    data-bs-target="#exampleModal"><i class="bi bi-list"></i></button>
            </div>
        </nav>



        <div class="modal fade h-100" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="text-center">
                            <img src="{{ asset('/web/img/lal teer logo.png') }}" alt="">
                            <h2 class="text-success mt-3">{{ $setting->tag_line ?? 'Write Your Tag Line Here' }}</h2>
                        </div>
                        <div style="margin-top: 50px;">
                            <div class="row">
                                <div class="col-md-3" style="border-right: 3px solid red;">
                                    <div>
                                        <h3 style="color: #4D4C4C;">Our Certification</h3>
                                        <div>
                                            @php
                                                $images = json_decode($setting->certification_multiple_images, true); // Decode the JSON string to an array
                                            @endphp
                                            @if (!empty($images) && is_array($images))
                                                @forelse ($images as $index=>$image)
                                                    <img src="{{ asset('/uploads/certifications/' . $image) }}"
                                                        alt="" class="img-fluid">
                                                @empty
                                                @endforelse
                                            @endif
                                        </div>
                                    </div>
                                    <div style="margin-top: 50px;">
                                        <h3 style="color: #4D4C4C;">Our Achievements</h3>
                                        <div class="mt-3 bg-light rounded-2 border-1 text-center p-2">
                                            <div class="row">
                                                @php
                                                    $images = json_decode($setting->achievement_multiple_images, true); // Decode the JSON string to an array
                                                @endphp

                                                @if (!empty($images) && is_array($images))
                                                    @forelse ($images as $index=>$image)
                                                        <div class="col-md-6">
                                                            <img src="{{ asset('/uploads/achievements/' . $image) }}"
                                                                alt="" class="img-fluid">
                                                        </div>
                                                    @empty
                                                    @endforelse
                                                @endif

                                            </div>



                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9 px-4">
                                    <div class="row">
                                        <div class="col-md-3 text-center">
                                            <a href="{{ route('home') }}" class="nav-item nav-link active">HOME</a>
                                            <div class="nav-item dropdown">
                                                <a href="#" class="nav-link" data-bs-toggle="dropdown">
                                                    <span class="dropdown-toggle">ABOUT US</span>
                                                </a>
                                                <div class="dropdown-menu m-0">
                                                    <a href="{{ route('aboutus') }}" class="dropdown-item">ABOUT
                                                        US</a>
                                                    <a href="{{ route('aboutushistory') }}"
                                                        class="dropdown-item">HISTORY</a>
                                                </div>
                                            </div>
                                            <div class="nav-item dropdown">
                                                <a href="#" class="nav-link dropdown-toggle"
                                                    id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    CROPS
                                                </a>
                                                <div class="dropdown-menu m-0 dropdown-grid" aria-labelledby="navbarDropdown">
                                                    @foreach ($categories as $category)
                                                        <a href="{{ route('crops', $category->slug) }}"
                                                            class="dropdown-item text-start">{{ $category->title }}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <div class="nav-item dropdown">
                                                <a href="#" class="nav-link" data-bs-toggle="dropdown">
                                                    <span class="dropdown-toggle">PROJECTS</span>
                                                </a>
                                                <div class="dropdown-menu m-0">
                                                    <a href="{{ route('projects') }}" class="dropdown-item">ALL</a>
                                                    <a href="{{ route('projects') }}" class="dropdown-item">ON
                                                        GOING</a>
                                                    <a href="{{ route('projects') }}"
                                                        class="dropdown-item">COMPLETE</a>
                                                </div>
                                            </div>
                                            <div class="nav-item dropdown">
                                                <a href="#" class="nav-link" data-bs-toggle="dropdown">
                                                    <span class="dropdown-toggle">NEWSLETTER</span>
                                                </a>
                                                <div class="dropdown-menu m-0">
                                                    <a href="{{ route('newsletter') }}"
                                                        class="dropdown-item">PHOTOS</a>
                                                    <a href="{{ route('newsletter') }}"
                                                        class="dropdown-item">VIDEOS</a>
                                                    <a href="{{ route('newsletter') }}" class="dropdown-item">NEWS &
                                                        BLOGS</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <ul style="list-style: none;">
                                                <li class="mb-3"><a href="{{ route('researchanddevelopment') }}">R
                                                        & D</a></li>
                                                <li class="mb-3"><a href="{{ route('farmers') }}">Farmers</a></li>
                                                <li class="mb-3"><a href="{{ route('gallery') }}">Gallery</a></li>
                                                <li class="mb-3"><a href="#">Career</a></li>
                                                <li class="mb-3"><a href="{{ route('contactus') }}">Contact Us</a>
                                                </li>
                                            </ul>

                                        </div>
                                        <div class="col-md-3 text-center">
                                            <a href=""
                                                class="btn buynow-btn rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">BUY
                                                NOW</a>
                                            <h5 class="my-3">FOLLOW US</h5>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <a class="btn btn-success btn-sm-square rounded-circle me-3"
                                                    href="{{ $social->facebook }}"><i
                                                        class="fab fa-facebook-f text-white"></i></a>
                                                <a class="btn btn-success btn-sm-square rounded-circle me-3"
                                                    href="{{ $social->twitter }}"><i
                                                        class="fab fa-twitter text-white"></i></a>
                                                <a class="btn btn-success btn-sm-square rounded-circle me-3"
                                                    href="{{ $social->instagram }}"><i
                                                        class="fab fa-instagram text-white"></i></a>
                                                <a class="btn btn-success btn-sm-square rounded-circle me-0"
                                                    href="{{ $social->linkedin }}"><i
                                                        class="fab fa-linkedin-in text-white"></i></a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
    <!-- Navbar & Hero End -->



    