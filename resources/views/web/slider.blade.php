<div class="container-fluid my-5 carousel-container">
    <div id="multiCardCarousel" class="carousel slide" data-bs-ride="carousel">
        <!-- Carousel Controls (Top Center) -->
        {{-- <div class="d-flex justify-content-center mb-3">
            <button class="carousel-control-prev position-relative top-0 translate-middle-y" type="button"
                data-bs-target="#multiCardCarousel" data-bs-slide="prev" style="z-index: 1;">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next position-relative top-0 translate-middle-y ms-3" type="button"
                data-bs-target="#multiCardCarousel" data-bs-slide="next" style="z-index: 1;">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div> --}}

        <!-- Carousel Content -->
        <div class="">
            <!-- First Row of Cards -->
            <div class="top-carousel-section px-4">
                <div class="row bg-white top-carousel-section-border">
                    @foreach ($testimonials as $index => $testimonial)
                        @if ($index == 0)
                            <div class="col-md-4 position-relative">
                                <a href="{{ route('filterfeatures', $testimonial->slug) }}">
                                    <div class="text-center">
                                        <img src="{{ asset('/uploads/testimonial/' . $testimonial->image_path) }}"
                                            class="card-img-top img-fluid w-25 h-25 mx-auto d-block mt-4"
                                            alt="Image 1">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $testimonial->title }}</h5>
                                            <p class="card-text">{{ strip_tags($testimonial->description) }}</p>
                                        </div>
                                    </div>
                                    <!-- Add a vertical line -->
                                    <div class="vertical-line"></div>
                                </a>
                            </div>
                        @endif
                        @if ($index == 1)
                            <div class="col-md-4 position-relative">
                                <a href="{{ route('filterfeatures', $testimonial->slug) }}">
                                    <div class="text-center">
                                        <img src="{{ asset('/uploads/testimonial/' . $testimonial->image_path) }}"
                                            class="card-img-top img-fluid w-25 h-25 mx-auto d-block  mt-4"
                                            alt="Image 2">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $testimonial->title }}</h5>
                                            <p class="card-text">{{ strip_tags($testimonial->description) }}</p>
                                        </div>
                                    </div>
                                </a>
                                <!-- Add a vertical line -->
                                <div class="vertical-line"></div>
                            </div>
                        @endif
                        @if ($index == 2)
                            <div class="col-md-4">
                                <a href="{{ route('filterfeatures', $testimonial->slug) }}">
                                    <div class="text-center">
                                        <img src="{{ asset('/uploads/testimonial/' . $testimonial->image_path) }}"
                                            class="card-img-top img-fluid w-25 h-25 mx-auto d-block mt-4"
                                            alt="Image 3">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $testimonial->title }}</h5>
                                            <p class="card-text">{{ strip_tags($testimonial->description) }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        @php
                            $index++;
                        @endphp
                    @endforeach
                </div>
            </div>




        </div>
    </div>
</div>
