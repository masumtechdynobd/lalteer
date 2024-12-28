 <div class="container-fluid ">
     <div class="text-center crops-margin mb-3">
         <div class="d-flex justify-content-center align-items-center custom-gap">
             <div>
                 <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
             </div>
             <div>
                 <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
             </div>
         </div>
         <h3 class="text-success fw-bold">OUR CROPS</h3>
         <h2>Explore This Projects</h2>
     </div>

     <div>
         <img src="img/service-2-shape-2 1.png" alt="" class="img-fluid img-right-small">
     </div>


     <div class="slick-wrapper">
         <div id="slick1">

             @foreach ($services as $index => $service)
                 @php
                     $cateory_slug = getCategorySlug($service->category_id);
                 @endphp
                 <div class="slide-item">
                     <a href="{{ route('crops', $cateory_slug) }}">
                         <div class="card crops-card-bg border-0 position-relative card-hover">
                             <img src="{{ asset('/uploads/service/' . $service->image_path) }}" class="card-img-top p-2"
                                 alt="...">
                             <div class="card-body">
                                 <h5 class="card-title text-center text-danger">{{ $service->title }}</h5>
                                 <p class="card-text mb-4">
                                     {{ \Illuminate\Support\Str::words(strip_tags($service->short_desc), 8) }}</p>

                             </div>
                         </div>
                     </a>
                 </div>
             @endforeach
         </div>

     </div>

     <div class="see-all-btn">
         <a href="" class="btn buynow-btn rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">SEE ALL</a>
     </div>

 </div>
 <!-- background png image -->
 <div class="">
     <div>
         <img src="{{ asset('/web/img/service-2-shape-1 1.png') }}" alt="" class="img-fluid bg-png-img-sm">
     </div>
     <div class="bg-png-img">
         <img src="{{ asset('/web/img/service-2-shape-3 1.png') }}" alt="" class="img-fluid img-full-img w-100">
     </div>
 </div>



