@extends('web.layouts.master')
@section('content')
    <style>
        .wheel-slider {
            position: relative;
            width: 800px;
            /* Updated size */
            height: 800px;
            /* Updated size */
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
            width: 280px;
            /* Increased size */
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
            left: 10px;
        }

        .right {
            right: 10px;
        }
    </style>


    {{-- top image section --}}
    <div class="container-fluid bg-breadcrumb">
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
                    <h2 class="text-success mb-3 ms-5">COMPANY HISTORY</h2>
                    <h2 class="mb-4 custom-letter-spacing" style="font-weight: normal;">
                        {{ @$history->title }}
                    </h2>
                    <p class="mb-4">
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
    <div class="container-fluid" style="margin-top: 50px;">
        <div class="wheel-slider mx-auto">
            <div class="circle">
                <!-- Updated with 15 items -->
                <div class="item" style="--i: 0;">
                    <img src="{{ asset('/web/img/collaborative-works1.png') }}" alt="Mango Bar">
                </div>
                <div class="item" style="--i: 1;">
                    <img src="{{ asset('/web/img/collaborative-works1.png') }}" alt="Puffed Rice">
                </div>
                <div class="item" style="--i: 2;">
                    <img src="{{ asset('/web/img/collaborative-works1.png') }}" alt="Potato Sticks">
                </div>
                <div class="item" style="--i: 3;">
                    <img src="{{ asset('/web/img/collaborative-works1.png') }}" alt="Dal">
                </div>
                <div class="item" style="--i: 4;">
                    <img src="{{ asset('/web/img/collaborative-works1.png') }}" alt="Item 5">
                </div>
                <div class="item" style="--i: 5;">
                    <img src="{{ asset('/web/img/collaborative-works1.png') }}" alt="Item 6">
                </div>
                <div class="item" style="--i: 6;">
                    <img src="{{ asset('/web/img/collaborative-works1.png') }}" alt="Item 7">
                </div>
                <div class="item" style="--i: 7;">
                    <img src="{{ asset('/web/img/collaborative-works1.png') }}" alt="Item 8">
                </div>
                <div class="item" style="--i: 8;">
                    <img src="{{ asset('/web/img/collaborative-works1.png') }}" alt="Item 9">
                </div>
                <div class="item" style="--i: 9;">
                    <img src="{{ asset('/web/img/collaborative-works1.png') }}" alt="Item 10">
                </div>
                <div class="item" style="--i: 10;">
                    <img src="{{ asset('/web/img/collaborative-works1.png') }}" alt="Item 11">
                </div>
                <div class="item" style="--i: 11;">
                    <img src="{{ asset('/web/img/collaborative-works1.png') }}" alt="Item 12">
                </div>
                <div class="item" style="--i: 12;">
                    <img src="{{ asset('/web/img/collaborative-works1.png') }}" alt="Item 13">
                </div>
                <div class="item" style="--i: 13;">
                    <img src="{{ asset('/web/img/collaborative-works1.png') }}" alt="Item 14">
                </div>
                <div class="item" style="--i: 14;">
                    <img src="{{ asset('/web/img/collaborative-works1.png') }}" alt="Item 15">
                </div>
            </div>
            <div class="center-image">
                <img src="https://www.pranfoods.net/sites/default/files/pran_twister_chips_90pxx90px-65.png"
                    alt="Potato Chips">
            </div>
            <!-- Navigation Buttons -->
            <button class="nav-btn left" onclick="rotateWheel('left')">&#8592;</button>
            <button class="nav-btn right" onclick="rotateWheel('right')">&#8594;</button>
        </div>
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

        <div class="mt-3">
            <div id="pdfViewerContainer" class="text-center">
                <!-- Left navigation button -->
                <button id="prevPage" class="navigation-btn left-btn">❮</button>

                <!-- PDF canvas -->
                <canvas id="pdfCanvas"></canvas>

                <!-- Right navigation button -->
                <button id="nextPage" class="navigation-btn right-btn">❯</button>
            </div>

            <div class="footer-controls" class="text-center">
                <input type="file" id="fileInput" accept="application/pdf" style="display: none;">
                <span class="text-center">Page: <span id="currentPage">1</span> / <span id="totalPages">--</span></span>
            </div>


            <div id="pdfViewerContainer" class="text-center">
                <canvas id="pdfCanvas"></canvas>
            </div>
        </div>
    </div>
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
        }

        .left-btn {
            left: 20px;
        }

        .right-btn {
            right: 20px;
        }

        .navigation-btn:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

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
    </style>

    <script>
        let angle = 0; // Keeps track of the current rotation angle

        const rotateWheel = (direction) => {
            // Update the angle based on direction
            angle += direction === 'left' ? 30 : -30; // Rotate by 30 degrees in either direction

            // Apply the rotation to the circle (wheel) element
            const circle = document.querySelector('.circle');
            circle.style.transform = `rotate(${angle}deg)`;
        };

        // Add event listeners for left and right arrow keys
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') rotateWheel('right');
            if (e.key === 'ArrowRight') rotateWheel('left');
        });
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
@endsection
