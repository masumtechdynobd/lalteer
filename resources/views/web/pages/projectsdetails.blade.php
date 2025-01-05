@extends('web.layouts.master')
@section('content')
    {{-- top image section --}}
    <div class="container-fluid"
        style="background: url('{{ asset('uploads/section/' . $section->image_path) }}'); position: relative; overflow: hidden; width: auto; height: 637px; background-position: center center; background-repeat: no-repeat; background-size: cover; padding: 140px 0 60px 0; transition: 0.5s;">
        <div class="container text-center py-5" style="max-width: 900px">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                Project Details
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Projects</a></li>
            </ol>
        </div>
        <div class="bredcrumb-bottom-img-div">
            <img class="bredcrumb-bottom-img" src="{{ asset('/web/img/Group 49.png') }}" alt=""
                style="width: 100%;">
        </div>
    </div>


    {{-- GEODATA BASED INFORMATION SERVICES FOR SMALLHOLDER FARMERS IN BANGLADESH (GEOBIS) --}}
    <div class="container-fluid" style="margin-top: 70px">
        <div class="row">
            <div class="col-md-6">
                <div class="rd-details-research-fourimg">
                    <div class="row d-flex flex-column">
                        @php
                            $images = json_decode($project->multiple_images, true); // Decode the JSON string to an array
                        @endphp
                        @if (!empty($images) && is_array($images))
                            @forelse ($images as $index=>$image)
                                @if ($index == 0 || $index == 1)
                                    <div class="col-md-6 d-flex flex-row">
                                        @if ($index == 0)
                                            <img src="{{ asset('/uploads/project/' . $image) }}" alt=""
                                                class="img-fluid rd-details-research-img1"
                                                style="width: 294px; height: 357px">
                                        @elseif ($index == 1)
                                            <img src="{{ asset('/uploads/project/' . $image) }}" alt=""
                                                class="img-fluid rd-details-research-img2"
                                                style="width: 361px; height: 241px">
                                        @endif
                                    </div>
                                @endif
                                @if ($index == 2 || $index == 3)
                                    <div class="col-md-6 d-flex flex-row">
                                        @if ($index == 2)
                                            <img src="{{ asset('/uploads/project/' . $image) }}" alt=""
                                                class="img-fluid rd-details-research-img3"
                                                style="width: 297px; height: 215px">
                                        @elseif ($index == 3)
                                            <img src="{{ asset('/uploads/project/' . $image) }}" alt=""
                                                class="img-fluid rd-details-research-img4"
                                                style="width: 438px; height: 292px">
                                        @endif
                                    </div>
                                @endif
                            @empty
                            @endforelse
                        @endif
                    </div>
                </div>
                <div class="rd-details-research-bg">
                    <img src="{{ asset('/web/img/Ellipse 4.png') }}" alt="" class="img-fluid"
                        style="width: 500px; height: 465px;">
                </div>
            </div>
            <div class="col-md-6 rd-details-research-textcontent">
                <div class="">
                    <div class="d-flex flex-column">
                        <div>
                            <h2 class="mb-3" style="color: #4D4C4C">{{ $project->title }}</h2>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column" style="color: black">
                    {!! $project->description !!}

                    <span></span>
                </div>
            </div>
        </div>
    </div>

    {{-- Project Aims --}}
    <div class="container-fluid" style="margin-top: 100px">
        <div class="row px-4 align-items-stretch equal-height">
            <!-- First Column -->
            <div class="col-md-6 about-org-content d-flex">
                <div class="wow fadeInLeft">
                    <div style="border-left: 3px solid green;">
                        <h2 class="text-success ms-2">Project Aims</h2>
                    </div>
                    <div class="pb-2">{{ $project->description2 }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('uploads/project/' . $project->image_path) }}" alt="" class="img-fluid"
                            style="width: 100%; height: auto;">
                    </div>
                    <div class="col-md-6">
                        @php
                            $objectives = explode(',', $project->objectives);
                        @endphp
                        <span>Objective</span>
                        <ul class="mt-2">
                            @forelse ($objectives as $objective)
                                <li>{{ $objective }}</li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Second Column -->
            @if ($project->projects_aim_photo)
                <div class="col-md-6 wow fadeInRight d-flex justify-content-center align-items-center">
                    <div class="">
                        <img src="{{ asset('uploads/project/' . $project->projects_aim_photo) }}" alt=""
                            class="img-fluid" style="width: 802px; height: 635px; border-radius: 30px;" />
                    </div>
                    <div class="project-aims-text">
                        <div class="py-3 px-4 rounded-1 mx-auto text-center project-aims-text-title"
                            style="background-color: #206A22; margin-bottom: 180px;">
                            <h3 class="text-white">{{ $project->projects_aim_title }}</h3>
                        </div>
                        <div class="row" style="margin-top: 30px">
                            <!-- Left Column -->
                            <div class="col-md-4 col-12 mb-4">
                                <div class="project-aims-call">
                                    <!-- Image -->
                                    <img src="{{ asset('/web/img/project-aims2.png') }}" alt="..."
                                        class="img-fluid project-aims-call-img">
                                    <!-- Text Content -->
                                    <div class="project-aims-call-text">
                                        <span>CALL NOW</span>
                                        <span>Get THIS FREE FOR</span>
                                        <span>Contact Now</span>
                                        <span>{{ $setting->phone_one }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Right Column -->
                            <div class="col-md-8 col-12"></div>
                        </div>
                    </div>

                </div>
            @endif
        </div>

    </div>

    <!-- Partnerships -->
    <div class="container-fluid p-4" style="border: 2px solid red; border-radius: 10px; margin-top: 60px;">
        <div>
            <div style="border-left: 3px solid green;">
                <h3 class="text-success ms-2">Partnerships</h3>
            </div>
            <div>
                {!! $project->partnership !!}
            </div>
        </div>

        <div style="margin-top: 50px;">
            <div style="border-left: 3px solid green;">
                <h3 class="text-success ms-2">Key Information Delivery</h3>
            </div>
            <div>
                {!! $project->key_info !!}
            </div>
        </div>

        <div style="margin-top: 50px;">
            <div style="border-left: 3px solid green;">
                <h3 class="text-success ms-2">Key Highlights of Activities</h3>
            </div>
            <div>
                {!! $project->key_highlight !!}
            </div>
        </div>

        <div style="margin-top: 50px;">
            <div style="border-left: 3px solid green;">
                <h3 class="text-success ms-2">Key Achievements</h3>
            </div>
            <div>
                {!! $project->key_achievement !!}
            </div>
        </div>
    </div>
@endsection
