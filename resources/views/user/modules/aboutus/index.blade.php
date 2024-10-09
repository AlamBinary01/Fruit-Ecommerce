@extends('user.layout.main-layout')

@section('content')
  <!-- Modal Search Start -->
  <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <div class="input-group w-75 mx-auto d-flex">
                    <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Search End -->

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">About Us</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        {{-- <li class="breadcrumb-item"><a href="#">Pages</a></li> --}}
        <li class="breadcrumb-item active text-white">About Us</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- About Us Start -->
<div class="container-fluid about py-5">
    <div class="container py-5">
        <div class="p-5 bg-light rounded">
            <div class="row g-4">
                <div class="col-12">
                    <div class="text-center mx-auto" style="max-width: 700px;">
                        <h1 class="text-primary">Who We Are</h1>
                        <p class="mb-4">We are a dedicated team committed to providing the best products and services to our customers. Our mission is to deliver high-quality goods while ensuring customer satisfaction.</p>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="h-100 rounded">
                        <img class="rounded w-100" 
                        style="height: 400px;" src="{{asset('front/img/baner-1.png')}}" alt="Our Office">
                    </div>
                </div>

                <div class="col-lg-7">
                    <h2 class="mb-4">Our Mission</h2>
                    <p>We strive to provide the highest quality products and services, ensuring that our customers receive nothing but the best. Our goal is to continuously innovate and improve to meet and exceed our clients' expectations.</p>

                    <h2 class="mb-4">Our Vision</h2>
                    <p>Our vision is to become the leading provider in our industry, known for our commitment to excellence and our passion for creating lasting relationships with our customers. We aim to make a positive impact on the world through our work.</p>
                </div>
                <div class="col-lg-5">
                    <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-users fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Our Team</h4>
                            <p class="mb-2">We are a diverse and experienced team with a shared commitment to excellence. Our passion drives us to deliver top-notch products and services to our customers.</p>
                        </div>
                    </div>
                    <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-history fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Our History</h4>
                            <p class="mb-2">Founded in [Year], we have grown into a reputable company, known for our commitment to quality and customer service. Our journey has been marked by innovation and progress.</p>
                        </div>
                    </div>
                    <div class="d-flex p-4 rounded bg-white">
                        <i class="fas fa-handshake fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Our Values</h4>
                            <p class="mb-2">Integrity, innovation, and customer-centricity are at the core of everything we do. We believe in building long-lasting relationships with our customers based on trust and respect.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About Us End -->

@endsection
