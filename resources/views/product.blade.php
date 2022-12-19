@extends('layouts.app')
@section('content')
    <!--Main layout-->
    <main>
        <div class="container">
            <!--Section: Cards-->
            <section class="ml-5">
                <!-- Heading & Description -->
                <div class="wow fadeIn mt-5 mb-5 h1">
                    <!--Section heading-->
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="#" class="link-dark text-reset">{{ $video[0]->title }}</a></li>
                    </ul>
                </div>
                <!-- Heading & Description -->
                <!--Grid row-->
                <div class="row wow fadeIn">
                    <div class="row wow fadeIn">
                        <!--Grid column-->
                        <div class="col-lg-5 col-xl-4 mb-4">
                            <!--Featured image-->
                            <div class="view overlay rounded z-depth-1-half">
                                <div class="view overlay">
                                    <img src="{{ asset('img/'.$video[0]->photoURL) }}" class="img-fluid">

                                </div>
                            </div>
                        </div>
                        <!--Grid column-->
                        <!--Grid column-->
                        <div class="col-lg-7 col-xl-7 ml-xl-4 mb-4">
                            <h2>Description</h2><br>
                            <p>{{ $video[0]->description }}</p>
                            <ul>
                                <li>Categories:
                                    @foreach($categories as $category)
                                        @if($loop->last)
                                            {{ $category->category->name }}
                                        @else
                                            {{ $category->category->name }},
                                        @endif
                                    @endforeach
                                </li>
                                <li>Year : {{ $video[0]->yearOfRelease }}</li>
                                <li>Runtime : {{ $video[0]->runtime }}</li>
                                <li>Rating : {{ $video[0]->rating }}</li>
                                <li>Rental Price : {{ $video[0]->rentalPrice }} $</li>
                            </ul>
                            <a href="#" data-target="#modalTrailer1"
                               class="btn btn-primary btn-md" data-toggle="modal">Trailer
                                <i class="fas fa-play ml-2"></i>
                            </a>
                            <!--Trailer Modal HTML -->
                            <div id="modalTrailer1" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ $video[0]->title }}</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body-video">
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <iframe class="embed-responsive-item" width="900 px" height="500 px" src="{{ $video[0]->trailerURL }}" allowfullscreen></iframe>
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
                                <input type="hidden" name="id" value="{{ $video[0]->id }}">
                                <input type="hidden" name="name" value="{{ $video[0]->title }}">
                                <input type="hidden" name="price" value="{{ $video[0]->rentalPrice }}">
                                <br><button type="submit" class="btn btn-primary"><i class="fas fa-shopping-cart mr-1"></i> Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                    <!--Grid column-->
                </div>
                <!--Grid row-->
            </section>
        </div>
    </main>
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
@endsection
