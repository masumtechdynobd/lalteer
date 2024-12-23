<div class="header-carousel owl-carousel">
    @foreach ($sliders as $slider)
        <div class="header-carousel-item position-relative">

            <!-- Video Section -->
            {{-- {{ asset('uploads/slider/' . $slider->image_path) }} --}}
            <video data-src="{{ asset('uploads/slider/' . $slider->image_path) }}" autoplay muted loop
                class="w-100 h-100 position-absolute top-0 start-0" style="object-fit: cover;" data-lazy="true">
            </video>



            <!-- Overlay Content -->
            <div class="carousel-caption position-absolute top-50 translate-middle-y w-100">
                <div class="container">
                    <div class="row gy-0 gx-5 align-items-center">
                        <!-- Text Content -->
                        <div class="col-xl-7 animated fadeInLeft py-5">
                            <div class="text-sm-center text-md-start">
                                <h4 class="bg-success custom-bg-size py-2 text-white text-uppercase fw-bold mb-4">
                                    {{ $slider->title }}
                                </h4>
                                <h1 class="display-4 text-uppercase text-white mb-4">
                                    {{ strip_tags($slider->description) }}

                                </h1>
                                <p class="mb-5 fs-5">
                                    {!! strip_tags($slider->short_description) !!}
                                </p>
                            </div>
                        </div>

                        <!-- Optional Placeholder for Right Column -->
                        <div class="col-lg-0 col-xl-5"></div>
                    </div>
                </div>
            </div>

        </div>
    @endforeach
</div>
