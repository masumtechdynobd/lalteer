  <!-- chairman message -->
  <div class="chairman-msg-color">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-4 wow fadeInLeft">
                  <div class=" d-flex justify-content-center align-items-center position-relative">
                      <!-- Line Image -->
                      <div class="chairman-line-design position-absolute">
                          <img src="{{ asset('/web/img/Line 52.png') }}" alt="Line" class="img-fluid">
                      </div>

                      <!-- Main Image -->
                      <div class="chairman-img-margin">
                          <img src="{{ asset('/uploads/chairman_message/' . $chairman_message->image_path) }}"
                              alt="Chairman" class="img-fluid">
                      </div>
                  </div>

              </div>
              <div class="col-md-8">
                  <div class="chairman-title-margin-top wow fadeInUp">
                      <div class="d-flex chairman-custom-gap">
                          <div>
                              <img src="/web/img/loader 2.png" alt="" class="img-fluid">
                          </div>
                          <div>
                              <img src="/web/img/loader 2.png" alt="" class="img-fluid">
                          </div>
                      </div>
                      <h2 class="text-success ms-5">OUR CHAIRMAN MESSAGE</h2>
                      <h2 class="ms-5">Explore This Projects</h2>
                  </div>
                  <div class="wow fadeInRight">
                      <div class="mt-4">
                          <h3>{{ $chairman_message->title }}</h3>
                          <h4 class="text-danger">{{ $chairman_message->designation }}</h4>
                      </div>
                      <div class="mt-3" id="description">
                          <span class="short-description">
                              {{ \Illuminate\Support\Str::words(strip_tags($chairman_message->description), 60) }}
                          </span>
                          <span class="full-description" style="display: none;">
                              {{ strip_tags($chairman_message->description) }}
                          </span>
                      </div>
                      <div class="mb-4 mt-2">
                          <a href="javascript:void(0);" id="read-more-btn"
                              class="btn buynow-btn rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">READ MORE</a>
                      </div>
                  </div>

                  <script>
                      document.getElementById('read-more-btn').addEventListener('click', function() {
                          var shortDescription = document.querySelector('.short-description');
                          var fullDescription = document.querySelector('.full-description');

                          if (shortDescription.style.display === 'none') {
                              // Show short description and hide full description
                              shortDescription.style.display = 'inline';
                              fullDescription.style.display = 'none';
                              this.textContent = 'READ MORE';
                          } else {
                              // Show full description and hide short description
                              shortDescription.style.display = 'none';
                              fullDescription.style.display = 'inline'; // or 'block' if you prefer
                              this.textContent = 'READ LESS';
                          }
                      });
                  </script>


              </div>
          </div>
      </div>
  </div>
