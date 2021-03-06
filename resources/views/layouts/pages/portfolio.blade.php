@extends('layouts.master_home')

@section('home_content')


    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>Portfolio</h2>
            </div>

            <div class="row" data-aos="fade-up">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        @foreach ($categories as $category)
                            <li data-filter=".filter-{{ $category->name }}">{{ $category->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="row portfolio-container" data-aos="fade-up">

                {{-- <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <img src="{{ asset('frontend/assets/img/portfolio/portfolio-1.jpg') }}" class="img-fluid" alt="">
                    <div class="portfolio-info">
                        <h4>App 1</h4>
                        <p>App</p>
                        <a href="{{ asset('frontend/assets/img/portfolio/portfolio-1.jpg') }}"
                            data-gall="portfolioGallery" class="venobox preview-link" title="App 1"><i
                                class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                class="bx bx-link"></i></a>
                    </div>
                </div> --}}

                {{-- <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <img src="{{ asset('frontend/assets/img/portfolio/portfolio-2.jpg') }}" class="img-fluid" alt="">
                    <div class="portfolio-info">
                        <h4>Web 3</h4>
                        <p>Web</p>
                        <a href="{{ asset('frontend/assets/img/portfolio/portfolio-2.jpg') }}"
                            data-gall="portfolioGallery" class="venobox preview-link" title="Web 3"><i
                                class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                class="bx bx-link"></i></a>
                    </div>
                </div> --}}

                {{-- <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <img src="{{ asset('frontend/assets/img/portfolio/portfolio-3.jpg') }}" class="img-fluid" alt="">
                    <div class="portfolio-info">
                        <h4>App 2</h4>
                        <p>App</p>
                        <a href="{{ asset('frontend/assets/img/portfolio/portfolio-3.jpg') }}"
                            data-gall="portfolioGallery" class="venobox preview-link" title="App 2"><i
                                class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                class="bx bx-link"></i></a>
                    </div>
                </div> --}}

                {{-- <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                    <img src="{{ asset('frontend/assets/img/portfolio/portfolio-4.jpg') }}" class="img-fluid" alt="">
                    <div class="portfolio-info">
                        <h4>Card 2</h4>
                        <p>Card</p>
                        <a href="{{ asset('frontend/assets/img/portfolio/portfolio-4.jpg') }}"
                            data-gall="portfolioGallery" class="venobox preview-link" title="Card 2"><i
                                class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                class="bx bx-link"></i></a>
                    </div>
                </div> --}}

                {{-- <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <img src="{{ asset('frontend/assets/img/portfolio/portfolio-5.jpg') }}" class="img-fluid"
                        alt="">
                    <div class="portfolio-info">
                        <h4>Web 2</h4>
                        <p>Web</p>
                        <a href="{{ asset('frontend/assets/img/portfolio/portfolio-5.jpg') }}"
                            data-gall="portfolioGallery" class="venobox preview-link" title="Web 2"><i
                                class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                class="bx bx-link"></i></a>
                    </div>
                </div> --}}

                {{-- <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <img src="{{ asset('frontend/assets/img/portfolio/portfolio-6.jpg') }}" class="img-fluid"
                        alt="">
                    <div class="portfolio-info">
                        <h4>App 3</h4>
                        <p>App</p>
                        <a href="{{ asset('frontend/assets/img/portfolio/portfolio-6.jpg') }}"
                            data-gall="portfolioGallery" class="venobox preview-link" title="App 3"><i
                                class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                class="bx bx-link"></i></a>
                    </div>
                </div> --}}

                {{-- <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                    <img src="{{ asset('frontend/assets/img/portfolio/portfolio-7.jpg') }}" class="img-fluid"
                        alt="">
                    <div class="portfolio-info">
                        <h4>Card 1</h4>
                        <p>Card</p>
                        <a href="{{ asset('frontend/assets/img/portfolio/portfolio-7.jpg') }}"
                            data-gall="portfolioGallery" class="venobox preview-link" title="Card 1"><i
                                class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                class="bx bx-link"></i></a>
                    </div>
                </div> --}}

                {{-- <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                    <img src="{{ asset('frontend/assets/img/portfolio/portfolio-8.jpg') }}" class="img-fluid"
                        alt="">
                    <div class="portfolio-info">
                        <h4>Card 3</h4>
                        <p>Card</p>
                        <a href="{{ asset('frontend/assets/img/portfolio/portfolio-8.jpg') }}"
                            data-gall="portfolioGallery" class="venobox preview-link" title="Card 3"><i
                                class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                class="bx bx-link"></i></a>
                    </div>
                </div> --}}

                {{-- <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                    <img src="{{ asset('frontend/assets/img/portfolio/portfolio-9.jpg') }}" class="img-fluid"
                        alt="">
                    <div class="portfolio-info">
                        <h4>Web 3</h4>
                        <p>Web</p>
                        <a href="{{ asset('frontend/assets/img/portfolio/portfolio-9.jpg') }}"
                            data-gall="portfolioGallery" class="venobox preview-link" title="Web 3"><i
                                class="bx bx-plus"></i></a>
                        <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                class="bx bx-link"></i></a>
                    </div>
                </div> --}}

                @foreach ($allImages as $image)
                    <div class="col-lg-4 col-md-6 portfolio-item filter-{{ $image->cat_name }}">
                        <img src="{{ asset('storage/' . $image->image) }}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>{{ $image->title }}</h4>
                            <p>{{ $image->cat_name }}</p>
                            <a href="{{ asset('storage/' . $image->image) }}" data-gall="portfolioGallery"
                                class="venobox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
                            <a href="portfolio-details.html" class="details-link" title="More Details"><i
                                    class="bx bx-link"></i></a>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </section><!-- End Portfolio Section -->


@endsection
