@extends('layouts.app')
@section('head_scripts')
    <style>
        mark{
            background: rgba(255, 255, 0, 0.5);
            color: black;
        }
    </style>
@endsection
@section('content')
    <!--Main layout-->
    <main>
        <div class="container">
            <!--Section: Cards-->
            <section class="ml-5">
                <!-- Heading & Description -->
                <div class="wow fadeIn">
                    <!--Section heading-->
                    <h1 class="h1 text-left mb-5" id="{{ $query }}">All Search Results</h1>
                    <div class="text-left alert alert-secondary">{{ $products->total() . ' result(s) found:' }}</div>
                </div>
                <!-- Heading & Description -->
                @foreach($products as $product)

                    @if( $loop->first or $loop->iteration  <= 6 )
                        <div class="row mt-3 wow fadeIn">
                            <!--Grid column-->
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
                                <h3 class="mb-3 font-weight-bold dark-grey-text target">
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
                                                <h3 class="modal-title h3 ml-3 mt-5 target">{{ $product->title }}</h3>
                                                <hr>
                                            </div>
                                            <div class="modal-body">
                                                <h6>Details:</h6>
                                                <p class="target">{{ $product->description }} </p>
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
                                                    <iframe class="embed-responsive-item" width="900 px" height="500 px" src="{{ $product->trailerURL }}" allowfullscreen></iframe>
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
                        <hr class="mb-5">
                @endif
            @endforeach

            <!--Pagination-->
                <nav class="d-flex justify-content-center wow fadeIn mt-5">
                    <div class="d-flex justify-content-center">

                        {{ $products->appends(request()->input())->links() }}

                    </div>
                </nav>
                <!--Pagination-->
            </section>
            <!--Section: Cards-->
        </div>
    </main>
    <!--Main layout-->
@endsection
@section('footer_scripts')
    <!-- JQuery -->
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.min.js"></script>
    <script>
        query = $('h1:first').attr('id');
        console.log(query);
        $(".target").mark(query);

    </script>
@endsection
