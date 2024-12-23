@extends('web.layouts.master')
@section('content')
    {{-- top image section --}}
    <div class="container-fluid bg-breadcrumb-rd">
        <div class="container text-center py-5" style="max-width: 900px">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                {{ @$category->title }}
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

            </ol>
        </div>
    </div>

    <div class="container-fluid" style="margin-top: 80px">
        <div class="row g-2">
            @forelse ($crops as $crop)
                <div class="col-md-3">
                    <a href="{{ route('cropsdetailspage', $crop->slug) }}">
                        <div class="card crops-card-bg border-0 position-relative card-hover">
                            <img src="{{ asset('/uploads/service/' . $crop->image_path) }}" class="card-img-top p-2"
                                alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center text-danger">{{ $crop->title }}</h5>
                                <p class="card-text mb-4">{{ strip_tags($crop->short_desc) }}</p>
                            </div>
                            <!-- Circle positioned at the bottom and centered -->
                            <div
                                class="circle-bg position-absolute bottom-0 start-50 translate-middle-x d-flex justify-content-center align-items-center">
                                <i class="bi bi-arrow-up-left"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
            @endforelse
        </div>

    </div>


    {{-- Varieties Of pumpkins seed --}}
    <div class="container-fluid">
        <div class="text-center wow fadeInUp" style="margin-top: 60px">
            <div class="d-flex varities-pumpkins-custom-gap justify-content-center">
                <div>
                    <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                </div>
                <div>
                    <img src="{{ asset('/web/img/loader 2.png') }}" alt="" class="img-fluid">
                </div>
            </div>
            <h2 class="text-success" style="margin-bottom: 30px">VARIETIES OF
                {{ strtoupper(getCategoryName($crop->category_id)) }}
                SEED</h2>
        </div>

        <div class="row row-cols-1 row-cols-md-2 g-4">
            @if (count($varieties) > 0)
                @forelse ($varieties as $varity)
                    <div class="col wow fadeInLeft">
                        <div class="card p-3">
                            <div class="row g-0">
                                <div class="col-md-6 bg-light pumpkins-sm-row-content text-center">
                                    <img src="{{ asset('/uploads/varieties/' . $varity->image) }}"
                                        class="img-fluid rounded-start" alt="..." style="width: 400px; height: 305px">
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $varity->title }}</h5>
                                        <span style="color: #333">{{ getCropName($varity->crop_id) }}</span>
                                        <p class="card-text">Breeder: {{ $varity->breeder_name }}</p>

                                        <table class="pumpkins-table">
                                            <tr>
                                                <td>Color :</td>
                                                <td>{{ $varity->color }}</td>
                                            </tr>
                                            <tr>
                                                <td>Weight (kg) :</td>
                                                <td>{{ $varity->weight }}</td>
                                            </tr>
                                            <tr>
                                                <td>Rate/Dec. (g) : </td>
                                                <td>{{ $varity->rate }}</td>
                                            </tr>
                                            <tr>
                                                <td>Sowing time : </td>
                                                <td>{{ $varity->showing_time }}</td>
                                            </tr>
                                            <tr>
                                                <td>Yield/Acre (MT) :</td>
                                                <td>{{ $varity->yield }}</td>
                                            </tr>
                                            <tr>
                                                <td>Maturity (Days) :</td>
                                                <td> {{ $varity->maturity }}</td>
                                            </tr>
                                        </table>
                                        <hr>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            @endif

        </div>
    </div>
@endsection
