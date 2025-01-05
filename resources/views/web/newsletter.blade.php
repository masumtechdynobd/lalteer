<div class="container-fluid">
    <div class="text-center crops-margin mb-3 wow fadeInUp">
        <div class="d-flex justify-content-center align-items-center custom-gap-newsletter">
            <div>
                <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
            </div>
            <div>
                <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
            </div>
        </div>
        @php
            $section_data = \App\Models\Section::where('slug', 'subscribe')->first();
        @endphp
        <h3 class="text-success fw-bold">{{ $section_data->title }}</h3>
        <h2>{!! $section_data->description !!} </h2>
    </div>

    <div class="mt-4">

        <div class="row row-cols-1 row-cols-md-4 g-4 wow fadeInUp">
            @foreach ($articles as $blog)
                <!-- Card 1 -->
                <div class="col">
                    <div class="card position-relative">
                        <!-- Card Image -->
                        <img src="{{ asset('/uploads/article/' . $blog->image_path) }}" class="img-fluid"
                            alt="...">

                        <!-- Hidden Content (will show on hover) -->
                        <div class="px-3">
                            <div
                                class="news-hover-content position-absolute  d-flex flex-column justify-content-center align-items-center text-white">
                                <p class="news-hover-date-bg px-3">
                                    {{ \Carbon\Carbon::parse($blog->date)->format('d') }} <br>
                                    {{ \Carbon\Carbon::parse($blog->date)->format('M') }}</p>
                                <p class="text-center"><i class="bi bi-camera me-2"></i>News</p>
                                <h6 class="text-center text-white">{{ $blog->title }}
                                </h6>
                                <p class="text-center">
                                    {{ implode(' ', array_slice(explode(' ', strip_tags($blog->description)), 0, 10)) }}{{ strlen($blog->description) > 10 ? '...' : '' }}
                                </p>

                                <div class="py-3">
                                    <a href="{{ route('newsletterdetails', $blog->id) }}"
                                        class="newsletter-bg-success-hover"><i
                                            class="bi bi-arrow-right me-2 text-white p-2 rounded-pill"
                                            style="background-color: #28a745;"></i>Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
