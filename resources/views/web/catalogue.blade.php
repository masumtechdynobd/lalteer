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
        height: 400px;
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





    #magazine {
        width: 1152px;
        height: 752px;
        background-size: cover;
        background-position: center;
    }

    #magazine .turn-page {
        background-color: #ccc;
        background-size: 100% 100%;
    }
</style>


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
        <h3 class="text-success fw-bold pb-2">OUR CATALOGUE</h3>
    </div>

    <div class="row">
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
    </div>
    {{-- 

    <div id="pdfViewerContainer" class="text-center">
        <canvas id="pdfCanvas"></canvas>
    </div> --}}
</div>


{{-- <div class="container-fluid">
    <div id="magazine">
        <div style="background-image:url({{ asset('/web/img/01.jpg') }});"></div>
        <div style="background-image:url({{ asset('/web/img/02.jpg') }});"></div>
        <div style="background-image:url({{ asset('/web/img/03.jpg') }});"></div>
        <div style="background-image:url({{ asset('/web/img/04.jpg') }});"></div>
        <div style="background-image:url({{ asset('/web/img/05.jpg') }});"></div>
        <div style="background-image:url({{ asset('/web/img/06.jpg') }});"></div>
    </div>
</div> --}}




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


<script type="text/javascript">
    $(window).ready(function() {
        $('#magazine').turn({
            display: 'double',
            acceleration: true,
            gradients: !$.isTouch,
            elevation: 50,
            when: {
                turned: function(e, page) {
                    console.log('Current view: ', $(this).turn('view'));
                }
            }
        });
    });


    $(window).bind('keydown', function(e) {

        if (e.keyCode == 37)
            $('#magazine').turn('previous');
        else if (e.keyCode == 39)
            $('#magazine').turn('next');

    });
</script>
