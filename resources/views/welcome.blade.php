@extends('layouts.app')

@section('content')
    @if(session()->has('success_message'))
        <div class="alert alert-success">
            {{ session()->get('success_message') }}
        </div>
    @endif

    @if(count($errors) > 0)
        <div class="alert alert-danger justify-content-center" style="width:300px;margin:auto;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br>
    @endif
    <form action="{{ route('search') }}" method="GET">
        <div class="row justify-content-center">
            <div class="input-group col-12 col-md-10 col-lg-8">
                <input class="form-control" type="text" name="query" id="query" value="{{ request()->input('query') }}" placeholder="Search">
                <div class="input-group-append">
                    <div class="input-group-text"><i class="fa fa-search"></i></div>
                </div>
            </div>
        </div>
    </form>
    <!--Main layout-->
    <main class="mt-5">
        <div class="container">

            <!--Section: Jumbotron-->
            <section class="card blue-gradient wow fadeIn">

                <!-- Content -->
                <div class="card-body text-white text-center py-1 px-1 my-1" id="slider">
                    <div>
                        <img src="{{ asset('img/a_nightmare_on_elm_street_banner.jpg') }}" class="banner">
                    </div>
                    <div>
                        <img src="{{ asset('img/avengers_banner.jpg') }}" class="banner">
                    </div>
                    <div>
                        <img src="{{ asset('img/black_panther_banner.jpg') }}" class="banner">
                    </div>
                    <div>
                        <img src="{{ asset('img/star_wars_th_force_awakens_banner.jpg') }}" class="banner">
                    </div>
                </div>
                    <!-- Content -->
            </section>
            <!--Section: Jumbotron-->

            <!--Section: Cards-->
            <section class="pt-5">

                <!-- Heading & Description -->
                <div class="wow fadeIn">
                    <!--Section heading-->
                    <h2 class="h1 text-center mb-5">What is Video Rental?</h2>
                    <!--Section description-->
                    <p class="text-center">Renting, also known as hiring or letting, is an agreement where a payment is made
                        for the temporary use of a good, service or property owned by another.
                        and apps. </p>
                    <p class="text-center mb-5 pb-5"> A video rental shop/store is a physical business that rents home
                        videos such as movies and prerecorded TV shows.</p>
                </div>
                <!-- Heading & Description -->

                @foreach($products as $product)
                    <!--Grid row-->
                    <div class="row wow fadeIn">

                        <div class="col-lg-5 col-xl-4 mb-4">
                            <!--Featured image-->
                            <div class="view overlay rounded z-depth-1">
                                <img src="{{ asset('img/'.$product->photoURL) }}" class="banner"
                                     alt="">
                                <a href="#" target="_blank">
                                    <div class="mask rgba-white-slight"></div>
                                </a>
                            </div>
                        </div>
                        <!--Grid column-->
                        <!--Grid column-->
                        <div class="col-lg-7 col-xl-7 ml-xl-4 mb-4">
                            <h3 class="mb-3 font-weight-bold dark-grey-text">
                                <strong>{{ $product->title }}</strong>
                            </h3>
                            <!--DETAILS BUTTON-->
                            <p class="grey-text">
                                <a href="#" target="_blank" class="btn btn-light" data-toggle="modal" data-target="{{ '#modal'.$loop->iteration }}">Details
                                    <i class="fas fa-info-circle ml-1"></i>
                                </a>
                            </p>
                            <!-- Modal -->
                            <div class="modal fade" id="{{ 'modal'.$loop->iteration }}" role="dialog">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div>
                                            <button type="button" class="close mr-2" data-dismiss="modal">&times;</button>
                                            <h3 class="modal-title h3 ml-3 mt-5">{{ $product->title }}</h3>
                                            <hr>
                                        </div>
                                        <div class="modal-body">
                                            <h6>Details:</h6>
                                            <p>{{ $product->description }} </p>
                                            <ul>
                                                <li><strong>Year Of Release: </strong>{{ $product->yearOfRelease }}</li>
                                                <li><strong>Runtime: </strong>{{ $product->runtime }}</li>
                                                <li><strong>Rating: </strong>{{ $product->rating }}</li>
                                                <li><strong>Rental Price: </strong>{{ $product->rentalPrice }} $</li>
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" data-target="{{ '#modalTrailer'.$loop->iteration }}"
                               class="btn btn-primary btn-md" data-toggle="modal">Trailer
                                <i class="fas fa-play ml-2"></i>
                            </a>
                            <!--Trailer Modal HTML -->
                            <div id="{{ 'modalTrailer'.$loop->iteration }}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ $product->title }}</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body-video">
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <iframe id="trailer" class="embed-responsive-item" width="900 px" height="500 px" src="{{ $product->trailerURL }}" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="close btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Trailer Modal HTML-->
                            <form action="{{ route('shopping-cart-store') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="name" value="{{ $product->title }}">
                                <input type="hidden" name="price" value="{{ $product->rentalPrice }}"><br>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-shopping-cart mr-1"></i> Add to Cart
                                </button>
                            </form>
                        </div>
                        <!--Grid column-->

                    </div>
                    <!--Grid row-->
                    @endforeach

                <hr class="mb-5">
            </section>
            <!--Section: Cards-->

        </div>
    </main>
    <!--Main layout-->

    <!--Footer-->
    <footer class="page-footer text-center font-small darken-2 mt-4 wow fadeIn">
        <hr class="my-4">
    </footer>

    <!-- use for modal  -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

    <script>jQuery(document).ready(function($) {
            $(function(){
                //Snag the URL of the iframe so we can use it later
                var url = $('.modal-body-video iframe').attr('src');

                $('.close').click(function() {
                    $('.modal-body-video').hide();
                    $('.modal-body-video iframe').attr('src', '');
                });

                $('.close').click(function() {
                    $('.modal-body-video').show();
                    $('.modal-body-video iframe').attr('src', url);
                });
            });
        });
    </script>

    <!-- JQuery -->
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-3.3.2.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#slider').slick({
                autoplay: true,
                autoplaySpeed: 1500,
                dots: false,
                arrows: false,
            });
        });
    </script>


@endsection
