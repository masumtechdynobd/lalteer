@extends('web.layouts.master')
@section('content')
    <style>
        .custom-gap-career {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: -30px;
        }

        .custom-gap-career>div {
            margin-right: 310px;
        }

        .custom-gap-career>div:last-child {
            margin-right: 0;
        }
    </style>

    {{-- top image section --}}
    <div class="container-fluid"
        style="background: url('{{ asset('uploads/section/' . $section->image_path) }}'); position: relative; overflow: hidden; width: auto; height: 596px; background-position: center center; background-repeat: no-repeat; background-size: cover; padding: 140px 0 60px 0; transition: 0.5s;">
        <div class="container text-center py-5" style="max-width: 900px">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                Career
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active text-primary">Career</li>
            </ol>
        </div>
        <div class="bredcrumb-bottom-img-div">
            <img class="bredcrumb-bottom-img" src="{{ asset('/web/img/bredcrumb-footer-new.png') }}" alt=""
                style="width: 100%;">
        </div>
    </div>

    <div class="conatainer-fluid">
        <div class="text-center crops-margin mb-3 wow fadeInUp">
            <div class="d-flex justify-content-center align-items-center custom-gap-career">
                <div>
                    <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                </div>
                <div>
                    <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                </div>
            </div>
            <h3 class="text-success fw-bold pb-2">WORKING AT LAL TEER</h3>
        </div>

        <div>
            <h2 class="text-center py-3" style="color: #4D4C4C">Continuing the Heritage of Being Pioneers in Industries
                and Leaders in Development</h2>
            <p style="color: #4D4C4C">Through Research, Integrity and The Talents Aim To Become The Best and Most Trusted
                Provider Of Seeds and Services In Order To Mitigate The Deficit Of Rice & Vegetable Pre-Requisites, and
                Economic & Technological Constraints in Bangladesh. To Be The Most Preferred Seed Brand in Bangladesh.
                Proactive Adoption Of Biotechnology Applications To Strengthen Our Core Competence. As a company, we believe
                in continuous improvement. We are constantly innovating and developing new products, which means that our
                employees can stay ahead of the curve in their respective fields. It also means that our employees have the
                opportunity to make a real impact on the company.
            </p>
        </div>

        <div class="container" style="margin-bottom: 40px;">
            <h2 class="text-center mb-3 mt-4" style="color: #4D4C4C">OUR CORE VALUE</h2>
            <div class="row">
                <div class="col-md-4 d-flex flex-column justify-content-center">
                    <div class="text-center">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h5 class="text-center" style="color: #4D4C4C">Employee friendliness</h5>
                    <p class="text-center" style="color: #4D4C4C">Provide Seed and The Latest Technology To Add Value To The
                        Business Of Farming
                        Backed By Integrity
                        and Over The Years Experience.</p>
                </div>
                <div class="col-md-4 d-flex flex-column justify-content-center" style="border-left: 1px solid black;">
                    <div class="text-center">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h5 class="text-center" style="color: #4D4C4C">Employee friendliness</h5>
                    <p class="text-center" style="color: #4D4C4C">Provide Seed and The Latest Technology To Add Value To The
                        Business Of Farming
                        Backed By Integrity
                        and Over The Years Experience.</p>
                </div>
                <div class="col-md-4 d-flex flex-column justify-content-center" style="border-left: 1px solid black;">
                    <div class="text-center">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h5 class="text-center" style="color: #4D4C4C">Employee friendliness</h5>
                    <p class="text-center" style="color: #4D4C4C">Provide Seed and The Latest Technology To Add Value To The
                        Business Of Farming
                        Backed By Integrity
                        and Over The Years Experience.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
