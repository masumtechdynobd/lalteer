@extends('web.layouts.master')
@section('content')
    <style>
        #pdfViewerContainer {
            width: 100%;
            height: auto;
            background-color: #E6F6EE;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding-top: 50px;
        }

        #pdfCanvas {
            display: block;
            max-width: 80%;
            max-height: 90%;
            margin: auto;
        }

        /* Wheel slider container */
        .wheel-slider {
            position: relative;
            height: 791px;
        }

        /* Circular item container */
        .circle {
            position: relative;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            transform: rotate(-30deg);
        }

        .circle .item {
            position: absolute;
            width: 50px;
            /* Size of each circular item */
            height: 50px;
            border-radius: 50%;
            text-align: center;
            line-height: 120px;
            font-size: 14px;
            font-weight: bold;
            color: black;
            transform: rotate(calc(var(--i) * 30deg)) translate(200px);
            /* Adjust translate for proper spacing */
            transform-origin: center center;
        }

        /* Central image styling */
        .center-image {
            position: absolute;
            width: 200px;
            /* Larger center image */
            height: 200px;
            border-radius: 50%;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .center-image img {
            width: 100%;
            height: auto;
            border-radius: 50%;
        }

        /* Navigation buttons */
        .navigation-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            z-index: 1000;
            border-radius: 50%;
        }

        .left-btn {
            left: -60px;
            /* Adjust button position for better layout */
        }

        .right-btn {
            right: -60px;
        }

        .navigation-btn:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Footer controls */
        .footer-controls {
            text-align: center;
            padding: 10px;
            background: #333;
            color: #fff;
        }

        .upload-btn {
            padding: 8px 16px;
            background-color: #28a745;
            color: white;
            margin: 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        .upload-btn:hover {
            background-color: #218838;
        }




        .circle {
            position: absolute;
            width: 100%;
            height: 100%;
            border: 1 qpx solid red;
            /* Outer wheel border */
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: transform 0.5s ease;
            /* Smooth transition for rotation */
        }

        .item {
            position: absolute;
            transform-origin: center;
            transform: rotate(calc(360deg / 15 * var(--i))) translate(230px)
                /* Items moved to the corners */
                rotate(calc(-360deg / 15 * var(--i)));
        }

        .item img {
            width: 450px;
            height: 280px;
            /* Increased size */
            object-fit: contain;
            padding: 10px;
        }

        .center-image {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 150px;
            height: 150px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .center-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* Button styles */
        .nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.8);
            border: none;
            font-size: 30px;
            padding: 10px;
            cursor: pointer;
            z-index: 10;
        }

        .left {
            left: 50px;
        }

        .right {
            right: 50px;
        }



        #carouselExampleM {
            display: none;
            /* Hidden by default */
        }

        @media (max-width: 767.98px) {

            /* Bootstrap's mobile breakpoint */
            #carouselExampleM {
                display: block;
                /* Show only on small devices */
            }

            #whell-slider {
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
            left: 390px;
            top: 30px;
            /* Adjust this for desired distance from the left */
        }

        /* Right button positioning */
        .carousel-control-next {
            right: -420px;
            top: 30px;
            /* Adjust this for desired distance from the right */
        }

        @media (max-width: 1400px) {

            .carousel-control-prev {
                left: 270px;
            }

            /* Right button positioning */
            .carousel-control-next {
                right: -290px;
            }
        }

        @media (max-width: 991px) {

            .carousel-control-prev {
                left: 175px;
            }

            /* Right button positioning */
            .carousel-control-next {
                right: -185px;
            }
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
        }

        .btn-check:focus+.btn,
        .btn:focus {
            outline: 0;
            box-shadow: 0 0 0 .25rem #F3F7FF;
        }


        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            font-size: 14px;
            width: 10px;
            height: 22px !important;
        }
    </style>


    {{-- top image section --}}
    <div class="container-fluid"
        style="background: url('{{ asset('uploads/section/' . $section->image_path) }}'); position: relative; overflow: hidden; width: auto; height: 637px; background-position: center center; background-repeat: no-repeat; background-size: cover; padding: 140px 0 60px 0; transition: 0.5s;">
        <div class="container text-center py-5" style="max-width: 900px">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                About Us
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">About</a></li>
                <li class="breadcrumb-item active text-primary">History</li>
            </ol>
        </div>
        <div class="bredcrumb-bottom-img-div">
            <img class="bredcrumb-bottom-img" src="{{ asset('/web/img/bredcrumb-footer-new.png') }}" alt=""
                style="width: 100%;">
        </div>
    </div>

    {{-- company history --}}
    <div class="container-fluid organization-top-margin">
        <div class="row px-4">

            <div class="col-md-6 about-org-content wow fadeInLeft">
                <div>
                    <div class="d-flex about-history-custom-gap">
                        <div>
                            <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                        </div>
                        <div>
                            <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                        </div>
                    </div>
                    <h2 class="text-success mb-3 ms-5 about-org-content-h2">COMPANY HISTORY</h2>
                    <h2 class="mb-4 custom-letter-spacing about-org-content-h2" style="font-weight: normal;">
                        {{ @$history->title }}
                    </h2>
                    <p class="mb-4" style="text-align: justify !important;">
                        {{ strip_tags(@$history->description) }}
                    </p>
                </div>
            </div>

            <div class="col-md-6 wow fadeInRight d-flex justify-content-center align-items-center">
                <img src="{{ asset('/uploads/history/' . @$history->image_path) }}" alt="" class="img-fluid"
                    style="width: 733px; height: 464px" />
            </div>
        </div>
    </div>

    {{-- collaborative works --}}
    <div id="whell-slider" class="container-fluid" style="margin-top: 200px; margin-bottom: 200px;">
        <div class="wheel-slider mx-auto">
            <div class="circle" style="transform: rotate(-30deg);">
                @php
                    $base = 30;
                @endphp
                @foreach ($data['rows'] as $index => $slider)
                    <div class="item p-4" style="--i: {{ $index }};">
                        <!-- Image with data attributes for modal -->
                        <a href="#" data-bs-toggle="modal" data-bs-target="#myModal" data-base="{{ $base }}"
                            onclick="updatedata('{{ $slider->id }}','{{ $slider->photos_path }}','{{ $slider->title }}','{{ $slider->description }}')"
                            class="btn btn-sm " style="transform :rotate({{ $base }}deg)"><img
                                src="{{ asset($slider->photos_path) }}" alt="{{ $slider->title }}" class="" /></a>
                    </div>
                    @php $base = $base-30; @endphp
                @endforeach
            </div>
            <div class="center-image">
                @foreach ($data['centers'] as $center)
                    <img src="{{ asset($center->photos_path) }}" alt="{{ $center->name }}">
                @endforeach
            </div>

            <!-- Navigation Buttons -->
            <button class="nav-btn left" onclick="rotateWheel('left')">&#8592;</button>
            <button class="nav-btn right" onclick="rotateWheel('right')">&#8594;</button>
        </div>
    </div>

    <script>
        function updatedata(id, photos_path, title, description) {
            // Set the modal content dynamically
            $('#myModal img').attr('src', '{{ asset('') }}' + photos_path); // Set the image source
            $('#myModal h1').text(title); // Set the title
            $('#myModal p').html(description); // Set the description
        }
    </script>

    <!-- sample modal content -->
    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <img src="" alt="" class="img-fluid" /> <!-- Image will be set dynamically -->
                    </div>
                    <h1 class="text-center"></h1> <!-- Title will be set dynamically -->
                    <p class="text-center"></p> <!-- Description will be set dynamically -->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <div id="carouselExampleM" class="carousel slide">
        <div class="carousel-inner">
            @foreach ($data['rows'] as $index => $slider)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset($slider->photos_path) }}" class="img-fluid d-block" alt="{{ $slider->title }}">
                    </div>
                </div>
            @endforeach
        </div>
        <button class="nav-btn left" type="button" data-bs-target="#carouselExampleM" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="nav-btn right" type="button" data-bs-target="#carouselExampleM" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    {{-- Ours Sister concern --}}
    <div class="container-fluid" style="margin-top: 50px">
        <div class="text-center">
            <div class="d-flex about-history-sister-custom-gap justify-content-center">
                <div>
                    <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                </div>
                <div>
                    <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                </div>
            </div>
            <h2 class="text-success">OUR SISTER CONCERN</h2>
            <h2 class="px-4" style="letter-spacing: 2px; font-weight: normal;">Lal Teer Seed Limited got Standard
                Chartered Bank Agro
                Award 2015 for its Research and Development (R&D) wing engaged </h2>
        </div>

        <div class="container-fluid" style="margin-top: 35px !important;">
            <div class="row">
                <!-- Carousel for larger screens -->
                <div class="col-md-6">
                    <div id="carouselExampleLarge" class="carousel slide">
                        <div class="carousel-inner">
                            @foreach ($data['aboutcatalogues'] as $index => $aboutcatalogue)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ asset($aboutcatalogue->photos_path) }}" class="d-block w-100"
                                        alt="Catalogue Image">
                                </div>
                            @endforeach
                        </div>
                        <!-- Left control button -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleLarge"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <!-- Right control button -->
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleLarge"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <!-- Carousel for smaller screens -->
                <div class="col-md-6">
                    <div id="carouselExampleSmall" class="carousel slide">
                        <div class="carousel-inner">
                            @foreach ($data['aboutcataloguetwos'] as $index => $aboutcataloguetwo)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ asset($aboutcataloguetwo->photos_path) }}" class="d-block w-100"
                                        alt="Catalogue Image">
                                </div>
                            @endforeach
                        </div>
                        <!-- Left control button -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleSmall"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <!-- Right control button -->
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleSmall"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>


    {{-- <script>
        $(document).ready(function() {
            $('.slider-image').on('click', function() {
                var sliderId = $(this).data('id');
                $.ajax({
                    url: '/slider-details/' + sliderId,
                    method: 'GET',
                    success: function(response) {
                        if (response.photos_path && response.title && response.description) {
                            $('#modalImage').attr('src', response.photos_path);
                            $('#modalTitle').text(response.title);
                            $('#modalDescription').text(response.description);
                            $('#exampleModal2').modal('show');
                        } else {
                            alert('Incomplete data received.');
                        }
                    },
                    error: function() {
                        alert('Failed to fetch slider details. Please try again.');
                    }
                });
            });
        });
    </script> --}}




    <script>
        let angle = 0; // Keeps track of the current rotation angle
        let click = 0;


        function rotateWheel(direction) {
            console.log(direction);
            // Update the angle based on direction
            angle += direction === 'left' ? 30 : -30; // Rotate by 30 degrees in either direction
            // Apply the rotation to the circle (wheel) element
            const circle = document.querySelector('.circle');
            circle.style.transform = `rotate(${angle}deg)`;

            const items = document.querySelectorAll('.circle .item');
            if (click > 0) {
                items.forEach((item, index) => {
                    const anchor = item.querySelector('a');
                    console.log(anchor);
                    if (anchor) {
                        const baseRotation = parseInt(anchor.getAttribute('data-base'), 10) ||
                            0; // Get data-base value
                        let rotationAngle = baseRotation;

                        if (direction == "right") {
                            console.log(baseRotation);
                            rotationAngle = baseRotation + 30;
                            anchor.setAttribute('data-base', baseRotation + 30);
                        } else {
                            rotationAngle = baseRotation - 30;
                            anchor.setAttribute('data-base', baseRotation - 30);
                        }
                        anchor.style.transform = `rotate(${rotationAngle}deg)`; // Apply rotation
                    }
                });
            }
            click = click + 1;

        };
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script src="pdf-viewer.js"></script>

    <script>
        // Load the PDF.js library
        const pdfjsLib = window['pdfjs-dist/build/pdf'];

        // Configure PDF.js worker
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js';

        // Select HTML elements
        const pdfCanvas = document.getElementById('pdfCanvas');
        // const ctx = pdfCanvas.getContext('2d');
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

        if (prevPageBtn) {
            // Handle Previous Page button click
            prevPageBtn.addEventListener('click', () => {
                if (currentPage <= 1) return;
                currentPage--;
                renderPage(currentPage);
            });
        }

        if (nextPageBtn) {
            // Handle Next Page button click
            nextPageBtn.addEventListener('click', () => {
                if (currentPage >= totalPages) return;
                currentPage++;
                renderPage(currentPage);
            });
        }

        // Handle file upload\
        if (fileInput) {
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
        }

        // Load a default PDF



        loadPDF('{{ asset('/uploads/setting/' . $setting->pdf_path) }}');
        rotateWheel('right');





        // function rotateWheel(direction) {
        //     const circle = document.querySelector('.circle');
        //     const rotation = parseInt(getComputedStyle(circle).getPropertyValue('--rotation')) || 0;
        //     circle.style.setProperty('--rotation', rotation + (direction === 'left' ? -30 : 30));
        // }
    </script>
@endsection
