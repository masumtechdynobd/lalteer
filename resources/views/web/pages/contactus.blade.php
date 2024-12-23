@extends('web.layouts.master')
@section('content')
    {{-- top image section --}}
    <div class="container-fluid bg-breadcrumb-newsletter">
        <div class="container text-center py-5" style="max-width: 900px">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                Contact Us Page
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Contact Us</a></li>
            </ol>
        </div>
    </div>

    {{-- address, phone, email --}}
    <div class="container-fluid" style="margin-top: 100px">
        <div class="row">
            <div class="col-md-4">
                <div class="text-center">
                    <img src="{{ asset('/web/img/contact-us3.png') }}" alt="">
                    <p class="mt-3">{{ $setting->contact_address }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <img src="{{ asset('/web/img/contact-us2.png') }}" alt="">
                    <p class="mt-3">{{ $setting->phone_one }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <img src="{{ asset('/web/img/contact-us1.png') }}" alt="">
                    <p class="mt-3">{{ $setting->email_one }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- get in touch --}}
    <div class="container-fluid" style="margin-top: 35px;">
        <div class="row">
            <div class="col-md-4">
                <h1 style="color: #4D4C4C; font-weight: bold; font-size: 100px;">Get in Touch With us</h1>
                <p>Have a question or inquiry about our programs, how to get involved, or anything else? We're just an email
                    away.</p>
                <div class="d-flex">
                    <a class="btn btn-success btn-sm-square rounded-circle me-3" href="{{ $social->facebook }}"><i
                            class="fab fa-facebook-f text-white"></i></a>
                    <a class="btn btn-success btn-sm-square rounded-circle me-3" href="{{ $social->twitter }}"><i
                            class="fab fa-twitter text-white"></i></a>
                    <a class="btn btn-success btn-sm-square rounded-circle me-3" href="{{ $social->instagram }}"><i
                            class="fab fa-instagram text-white"></i></a>
                    <a class="btn btn-success btn-sm-square rounded-circle me-0" href="{{ $social->linkedin }}"><i
                            class="fab fa-linkedin-in text-white"></i></a>
                </div>
            </div>
            <div class="col-md-8">
                <form action="{{ route('contactusstore') }}" method="POST" class="p-4 rounded">
                    @csrf
                    <div class="row g-3">
                        <!-- Name Field -->
                        <div class="col-md-6">
                            <input type="text" class="form-control bg-light border-0 py-4 rounded-2" name="name" placeholder="Your Name" required>
                        </div>
                        <!-- Email Field -->
                        <div class="col-md-6">
                            <input type="email" class="form-control bg-light border-0 py-4 rounded-2" name="email" placeholder="E-mail Address" required>
                        </div>
                    </div>
                    <div class="row g-3 mt-3">
                        <!-- Phone Number Field -->
                        <div class="col-md-6">
                            <input type="text" class="form-control bg-light border-0 py-4 rounded-2" name="phone" placeholder="Phone Number" required>
                        </div>
                        <!-- Subject Dropdown -->
                        <div class="col-md-6">
                            <select class="form-select bg-light border-0 py-4 rounded-2" name="subject" required>
                                <option value="" disabled selected>Select Subject</option>
                                <!-- Loop through subjects -->
                                @foreach ($rows as $row)
                                    <option value="{{ $row->id }}">{{ $row->subject_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row g-3 mt-3">
                        <!-- Message Field -->
                        <div class="col-md-12">
                            <textarea class="form-control bg-light border-0 py-4 rounded-2" rows="5" name="message" placeholder="Write your message" required></textarea>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="row mt-4">
                        <div class="col">
                            <button type="submit" class="btn buynow-btn rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">SEND US A MESSAGE</button>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>

    {{-- contact to employee --}}
    <div class="container-fluid">
        <div class="text-center crops-margin mb-3 wow fadeInUp">
            <div class="d-flex justify-content-center align-items-center custom-gap-contact-us">
                <div>
                    <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                </div>
                <div>
                    <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                </div>
            </div>
            <h3 class="text-success fw-bold">CONTACT TO EMPLOYEE</h3>
            <p>Contact details of our employees [department wise] are given below. You may contact them to learn or ask more
                about any of your queries!!</p>
        </div>
    </div>

    <div class="container-fluid" style="margin-top: 60px;">

        <div class="page">

            <!-- tabs -->
            <div class="pcss3t pcss3t-effect-scale pcss3t-theme-1">
                <input type="radio" name="pcss3t" checked id="tab1"class="tab-content-first">
                <label for="tab1">ALL</label>

                <input type="radio" name="pcss3t" id="tab2" class="tab-content-2">
                <label for="tab2">HEADS OFFICE</label>

                <input type="radio" name="pcss3t" id="tab3" class="tab-content-3">
                <label for="tab3">SALES</label>

                <input type="radio" name="pcss3t" id="tab5" class="tab-content-4">
                <label for="tab5"> International business</label>

                <input type="radio" name="pcss3t" id="tab6" class="tab-content-last">
                <label for="tab6">FinFinance & Account</label>

                <ul>
                    <li class="tab-content tab-content-first typography">
                        <div class="total-boarddirectory-content">
                            <div class="px-4 combined-row-boardofdirectory">
                                <div class="row g-4 mt-4">
                                    <div class="col-md-3 col-lg-3 col-xl-3" data-wow-delay="0.2s">
                                        <div class="text-center position-relative px-2">
                                            <div class="board-dicrescotry-sm-text rounded-3 position-relative mx-auto">
                                                <!-- Image positioned at the top -->
                                                <div
                                                    class="aboutus-image-container position-absolute top-0 start-50 translate-middle">
                                                    <img src="{{ asset('/web/img/contact-us-people1.png') }}"
                                                        class="img-fluid rounded-circle border-white" alt=""
                                                        style="width: 323px; height: auto; border: 5px solid white; object-fit: cover;" />
                                                </div>

                                                <!-- Text content centered at the bottom -->
                                                <div
                                                    class="text-content d-flex flex-column justify-content-center align-items-center h-100 py-4">
                                                    <p class="mb-0 text-white">
                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-lg-3 col-xl-3" data-wow-delay="0.2s">
                                        <div class="text-center position-relative px-2">
                                            <div class="board-dicrescotry-sm-text rounded-3 position-relative mx-auto">
                                                <!-- Image positioned at the top -->
                                                <div
                                                    class="aboutus-image-container position-absolute top-0 start-50 translate-middle">
                                                    <img src="{{ asset('/web/img/contact-us-people1.png') }}"
                                                        class="img-fluid rounded-circle border-white" alt=""
                                                        style="width: 323px; height: auto; border: 5px solid white; object-fit: cover;" />
                                                </div>

                                                <!-- Text content centered at the bottom -->
                                                <div
                                                    class="text-content d-flex flex-column justify-content-center align-items-center h-100 py-4">
                                                    <p class="mb-0 text-white">
                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-lg-3 col-xl-3" data-wow-delay="0.2s">
                                        <div class="text-center position-relative px-2">
                                            <div class="board-dicrescotry-sm-text rounded-3 position-relative mx-auto">
                                                <!-- Image positioned at the top -->
                                                <div
                                                    class="aboutus-image-container position-absolute top-0 start-50 translate-middle">
                                                    <img src="{{ asset('/web/img/contact-us-people1.png') }}"
                                                        class="img-fluid rounded-circle border-white" alt=""
                                                        style="width: 323px; height: auto; border: 5px solid white; object-fit: cover;" />
                                                </div>

                                                <!-- Text content centered at the bottom -->
                                                <div
                                                    class="text-content d-flex flex-column justify-content-center align-items-center h-100 py-4">
                                                    <p class="mb-0 text-white">
                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-lg-3 col-xl-3" data-wow-delay="0.2s">
                                        <div class="text-center position-relative px-2">
                                            <div class="board-dicrescotry-sm-text rounded-3 position-relative mx-auto">
                                                <!-- Image positioned at the top -->
                                                <div
                                                    class="aboutus-image-container position-absolute top-0 start-50 translate-middle">
                                                    <img src="{{ asset('/web/img/contact-us-people1.png') }}"
                                                        class="img-fluid rounded-circle border-white" alt=""
                                                        style="width: 323px; height: auto; border: 5px solid white; object-fit: cover;" />
                                                </div>

                                                <!-- Text content centered at the bottom -->
                                                <div
                                                    class="text-content d-flex flex-column justify-content-center align-items-center h-100 py-4">
                                                    <p class="mb-0 text-white">
                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                    </li>

                    <li class="tab-content tab-content-2 typography">
                        <h1>Leonardo da Vinci</h1>
                        <p>Italian Renaissance polymath: painter, sculptor, architect, musician, mathematician,
                            engineer, inventor, anatomist, geologist, cartographer, botanist, and writer. His genius,
                            perhaps more than that of any other figure, epitomized the Renaissance humanist ideal.
                            Leonardo has often been described as the archetype of the Renaissance Man, a man of
                            "unquenchable curiosity" and "feverishly inventive imagination". He is widely considered to
                            be one of the greatest painters of all time and perhaps the most diversely talented person
                            ever to have lived. According to art historian Helen Gardner, the scope and depth of his
                            interests were without precedent and "his mind and personality seem to us superhuman, the
                            man himself mysterious and remote". Marco Rosci states that while there is much speculation
                            about Leonardo, his vision of the world is essentially logical rather than mysterious, and
                            that the empirical methods he employed were unusual for his time.</p>
                        <p class="text-right"><em>Find out more about Leonardo da Vinci from <a
                                    href="http://en.wikipedia.org/wiki/Leonardo_da_Vinci"
                                    target="_blank">Wikipedia</a>.</em></p>
                    </li>

                    <li class="tab-content tab-content-3 typography">
                        <h1>Albert Einstein</h1>
                        <p>German-born theoretical physicist who developed the general theory of relativity, one of the
                            two pillars of modern physics (alongside quantum mechanics). While best known for his
                            mass–energy equivalence formula E = mc2 (which has been dubbed "the world's most famous
                            equation"), he received the 1921 Nobel Prize in Physics "for his services to theoretical
                            physics, and especially for his discovery of the law of the photoelectric effect". The
                            latter was pivotal in establishing quantum theory.</p>
                        <p>Near the beginning of his career, Einstein thought that Newtonian mechanics was no longer
                            enough to reconcile the laws of classical mechanics with the laws of the electromagnetic
                            field. This led to the development of his special theory of relativity. He realized,
                            however, that the principle of relativity could also be extended to gravitational fields,
                            and with his subsequent theory of gravitation in 1916, he published a paper on the general
                            theory of relativity.</p>
                        <p class="text-right"><em>Find out more about Albert Einstein from <a
                                    href="http://en.wikipedia.org/wiki/Albert_Einstein"
                                    target="_blank">Wikipedia</a>.</em></p>
                    </li>

                    <li class="tab-content tab-content-4 typography">
                        <div class="typography">
                            <h1>Isaac Newton</h1>
                            <p>English physicist and mathematician who is widely regarded as one of the most influential
                                scientists of all time and as a key figure in the scientific revolution. His book
                                Philosophiæ Naturalis Principia Mathematica ("Mathematical Principles of Natural
                                Philosophy"), first published in 1687, laid the foundations for most of classical
                                mechanics. Newton also made seminal contributions to optics and shares credit with
                                Gottfried Leibniz for the invention of the infinitesimal calculus.</p>
                            <p>Newton's Principia formulated the laws of motion and universal gravitation that dominated
                                scientists' view of the physical universe for the next three centuries. It also
                                demonstrated that the motion of objects on the Earth and that of celestial bodies could
                                be described by the same principles. By deriving Kepler's laws of planetary motion from
                                his mathematical description of gravity, Newton removed the last doubts about the
                                validity of the heliocentric model of the cosmos.</p>
                            <p class="text-right"><em>Find out more about Isaac Newton from <a
                                        href="http://en.wikipedia.org/wiki/Isaac_Newton"
                                        target="_blank">Wikipedia</a>.</em></p>
                        </div>
                    </li>

                    <li class="tab-content tab-content-last typography">
                        <div class="typography">
                            <h1>Isaac Newton</h1>
                            <p>English physicist and mathematician who is widely regarded as one of the most influential
                                scientists of all time and as a key figure in the scientific revolution. His book
                                Philosophiæ Naturalis Principia Mathematica ("Mathematical Principles of Natural
                                Philosophy"), first published in 1687, laid the foundations for most of classical
                                mechanics. Newton also made seminal contributions to optics and shares credit with
                                Gottfried Leibniz for the invention of the infinitesimal calculus.</p>
                            <p>Newton's Principia formulated the laws of motion and universal gravitation that dominated
                                scientists' view of the physical universe for the next three centuries. It also
                                demonstrated that the motion of objects on the Earth and that of celestial bodies could
                                be described by the same principles. By deriving Kepler's laws of planetary motion from
                                his mathematical description of gravity, Newton removed the last doubts about the
                                validity of the heliocentric model of the cosmos.</p>
                            <p class="text-right"><em>Find out more about Isaac Newton from <a
                                        href="http://en.wikipedia.org/wiki/Isaac_Newton"
                                        target="_blank">Wikipedia</a>.</em></p>
                        </div>
                    </li>
                </ul>
            </div>
            <!--/ tabs -->
        </div>
    </div>

    {{-- map --}}
    <div class="container-fluid" style="margin-top: 70px;">
        <img src="{{ asset('/web/img/contact-us-map.png') }}" alt="" style="width: 100%;">
    </div>

    <!-- jQuery script to handle the content toggling -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initially, show photos and hide others
            $("#showPhotos").click(function() {
                $('#photos').collapse('show');
                $('#videos').collapse('hide');
                $('#news').collapse('hide');
            });

            $("#showVideos").click(function() {
                $('#videos').collapse('show');
                $('#photos').collapse('hide');
                $('#news').collapse('hide');
            });

            $("#showNews").click(function() {
                $('#news').collapse('show');
                $('#photos').collapse('hide');
                $('#videos').collapse('hide');
            });
        });
    </script>
@endsection
