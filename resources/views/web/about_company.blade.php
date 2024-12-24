<div class="container-fluid mb-5">
    <div class="row">
        <div class="col-md-6 position-relative wow fadeInLeft">
            <img src="{{ asset('/uploads/about/' . $about->image_path) }}" class="img-fluid h-100" alt="">
            <img src="{{ asset('/uploads/about/' . $about->image_path2) }}"
                class="img-fluid position-absolute top-0 end-0 mt-4" alt="">
        </div>


        <div class="col-md-6 ps-md-5 wow fadeInRight">
            <div class="about-text-section">
                <div class="d-flex about-sm-img-custom-gap">
                    <div>
                        <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                    </div>
                    <div>
                        <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
                <h2 class="text-success ms-5 mb-4">ABOUT OUR COMPANY</h2>
                <h4 class="mb-4 custom-letter-spacing">
                    {{ $about->title }}
                </h4>
                <div class="mb-4" style="text-align: justify;">
                    {!! \Illuminate\Support\Str::words(strip_tags($about->description, '<b>'), 50) !!}
                </div>

            </div>


            <div class="about-sm-youtube-section pd-2">
                <div class="row d-flex flex-row justify-content-between align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex flex-column">
                            @php
                                $features = explode(';', $about->features_new);
                            @endphp
                            @forelse ($features as  $feature)
                                <span><i class="bi bi-arrow-up-right me-2"></i>{{ strip_tags($feature) }}</span>
                            @empty
                            @endforelse

                        </div>

                        <div class="mt-4">
                            <a href="{{ route('aboutus') }}"
                                class="btn buynow-btn rounded-pill py-2 my-3 my-lg-0 flex-shrink-0">About
                                More</a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <iframe style="width: 306px; height: 199px;"
                            src="https://www.youtube.com/embed/{{ $about->video_id }}" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>

                </div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-8">
            <div class="about-result-sm-section-margin-top">
                <div class="bg-white about-result-sm-section rounded-2 px-5 py-2">
                    <div class="row">
                        @forelse ($infos as $info)
                            <div style="padding-top: 15px; padding-bottom: 15px;" class="col-md-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{ asset('/uploads/info/' . $info->image_path) }}" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        @php
                                            // Strip tags and remove non-numeric characters like '+'
                                            $description = preg_replace('/\D/', '', strip_tags($info->description));
                                        @endphp
                                        <h4 class="counter" data-target="{{ $description }}">0</h4>
                                        <span>{{ $info->title }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No information available</p>
                        @endforelse


                    </div>


                </div>
            </div>
        </div>

    </div>

</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const counters = document.querySelectorAll(".counter");
        const duration = 1000; 

        counters.forEach(counter => {
            const targetNumber = parseInt(counter.getAttribute("data-target"), 10);

           
            if (isNaN(targetNumber) || targetNumber <= 0) {
                counter.textContent = 0; 
                return;
            }

            const incrementTime = Math.max(duration / targetNumber,
                10); 
            let currentValue = 0;

            const updateCounter = () => {
                currentValue += Math.ceil(targetNumber / (duration /
                    incrementTime)); 
                if (currentValue >= targetNumber) {
                    currentValue = targetNumber; 
                    counter.textContent = `${currentValue}+`; 
                } else {
                    counter.textContent = `${currentValue}+`;
                    setTimeout(updateCounter, incrementTime); 
                }
            };

            updateCounter(); 
        });
    });
</script>
