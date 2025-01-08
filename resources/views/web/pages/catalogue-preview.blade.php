@extends('web.layouts.master')
@section('content')
    <style>
        #magazine {
            width: 100%;
            max-width: 1152px;
            height: 800px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        #magazine div {
            width: 33%;
            /* Default 3-column layout */
        }

        #magazine img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 5px;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            #magazine {
                display: none;
            }
        }


        #carouselExample {
            position: relative;
            /* Required for absolute positioning of controls */
        }

        .carousel-control-prev,
        .carousel-control-next {
            position: absolute;
            top: 50%;
            /* Vertically center */
            transform: translateY(-50%);
            /* Correct the exact middle position */
            background-color: rgba(0, 0, 0, 0.5);
            /* Optional: make the buttons semi-transparent */
            border: none;
            padding: 10px;
            z-index: 5;
            /* Ensure buttons are on top */
        }

        /* Left button positioning */
        .carousel-control-prev {
            left: -5px;
            /* Adjust this for desired distance from the left */
        }

        /* Right button positioning */
        .carousel-control-next {
            right: -5px;
            /* Adjust this for desired distance from the right */
        }

        .caresouel-img-class {
            width: 25%;
        }

        /* Ensure the buttons look good on mobile too */
        @media (max-width: 768px) {

            .carousel-control-next {
                padding: 2px;
                align-items: center;
                justify-content: center;
                right: -340px;
                top: 30px;
            }

            .carousel-control-prev {
                padding: 2px;
                align-items: center;
                justify-content: center;
                left: 310px;
                top: 30px;
            }

            .caresouel-img-class {
                width: 100%;
            }
        }

        @media (max-width: 500px) {

            .carousel-control-next {
                padding: 2px;
                align-items: center;
                justify-content: center;
                right: -200px;
                top: 30px;
            }

            .carousel-control-prev {
                padding: 2px;
                align-items: center;
                justify-content: center;
                left: 185px;
                top: 30px;
            }

            .caresouel-img-class {
                width: 100%;
            }
        }

        @media (max-width: 375px) {

            .carousel-control-next {
                padding: 2px;
                align-items: center;
                justify-content: center;
                right: -135px;
                top: 30px;
            }

            .carousel-control-prev {
                padding: 2px;
                align-items: center;
                justify-content: center;
                left: 125px;
                top: 30px;
            }

            .caresouel-img-class {
                width: 100%;
            }
        }


        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            font-size: 14px;
            width: 10px;
            height: 22px !important;
        }
    </style>


    <div class="container-fluid" id="catalogue-section">
        <div class="text-center crops-margin mb-3 wow fadeInUp" style="margin-top: 110px;">
            <div class="d-flex justify-content-center align-items-center custom-gap-newsletter">
                <div>
                    <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                </div>
                <div>
                    <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                </div>
            </div>
            <h3 class="text-success fw-bold pb-2">OUR CATALOGUE</h3>
        </div>

        {{-- <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
          <div id="pdfViewerContainer" class="text-center">
              <!-- Left navigation button -->
              <button id="prevPage" class="navigation-btn left-btn">❮</button>

              <!-- PDF canvas -->
              <canvas id="pdfCanvas"></canvas>

              <!-- Right navigation button -->
              <button id="nextPage" class="navigation-btn right-btn">❯</button>
          </div>
      </div>
      <div class="col-md-3"></div>
  </div>

  <div class="footer-controls" class="text-center">
      <input type="file" id="fileInput" accept="application/pdf" style="display: none;">
      <span class="text-center">Page: <span id="currentPage">1</span> / <span id="totalPages">--</span></span>
  </div> --}}
        {{-- 

  <div id="pdfViewerContainer" class="text-center">
      <canvas id="pdfCanvas"></canvas>
  </div> --}}


        <div id="magazine">
            @foreach ($catalogues as $catalogue)
                <div>
                    <img src="{{ asset($catalogue->photos_path) }}" alt="Catalogue Image">
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            <!-- Left control button -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleSmall" data-bs-slide="prev"
                onclick="turn_now('previous')">

                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <!-- Right control button -->
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleSmall" data-bs-slide="next"
                onclick="turn_now('next')">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        {{-- <div id="carouselExample" class="carousel slide">
      <div class="carousel-inner d-flex justify-content-center">
          @foreach ($catalogues as $index => $catalogue)
              <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                  <img src="{{ asset($catalogue->photos_path) }}" class="d-block img-fluid" alt="Catalogue Image">
              </div>
          @endforeach
      </div>
      <div class="d-flex justify-content-center" style="margin-top: 35px;">
          <!-- Left control button -->
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
          </button>

          <!-- Right control button -->
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
          </button>
      </div>
  </div> --}}




    </div>







    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script src="pdf-viewer.js"></script>

    <script>
        // Load the PDF.js library
        const pdfjsLib = window['pdfjs-dist/build/pdf'];

        // Configure PDF.js worker
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js';

        // Select HTML elements
        const pdfCanvas = document.getElementById('pdfCanvas');
        const ctx = pdfCanvas.getContext('2d');
        const prevPageBtn = document.getElementById('prevPage');
        const nextPageBtn = document.getElementById('nextPage');
        const currentPageSpan = document.getElementById('currentPage');
        const totalPagesSpan = document.getElementById('totalPages');
        const fileInput = document.getElementById('fileInput');

        let pdfDoc = null;
        let currentPage = 1;
        let totalPages = 0;
        let pdfScale = 1.5; // Scale factor

        // Render the PDF page
        function renderPage(pageNumber) {
            pdfDoc.getPage(pageNumber).then((page) => {
                const viewport = page.getViewport({
                    scale: pdfScale
                });
                pdfCanvas.width = viewport.width;
                pdfCanvas.height = viewport.height;

                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport,
                };
                page.render(renderContext).promise.then(() => {
                    currentPageSpan.textContent = pageNumber;
                });
            });
        }

        // Load a new PDF file
        function loadPDF(url) {
            pdfjsLib.getDocument(url).promise.then((doc) => {
                pdfDoc = doc;
                totalPages = doc.numPages;
                totalPagesSpan.textContent = totalPages;
                renderPage(currentPage);
            });
        }

        // Handle Previous Page button click
        prevPageBtn.addEventListener('click', () => {
            if (currentPage <= 1) return;
            currentPage--;
            renderPage(currentPage);
        });

        // Handle Next Page button click
        nextPageBtn.addEventListener('click', () => {
            if (currentPage >= totalPages) return;
            currentPage++;
            renderPage(currentPage);
        });

        // Handle file upload
        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file && file.type === 'application/pdf') {
                const fileReader = new FileReader();
                fileReader.onload = (e) => {
                    const arrayBuffer = e.target.result;
                    pdfjsLib.getDocument({
                        data: arrayBuffer
                    }).promise.then((doc) => {
                        pdfDoc = doc;
                        currentPage = 1;
                        totalPages = doc.numPages;
                        totalPagesSpan.textContent = totalPages;
                        renderPage(currentPage);
                    });
                };
                fileReader.readAsArrayBuffer(file);
            }
        });

        // Load a default PDF
        loadPDF('{{ asset('/uploads/setting/' . $setting->pdf_path) }}');
    </script>


    <script type="text/javascript"></script>
@endsection
