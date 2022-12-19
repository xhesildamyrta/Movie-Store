@extends('layouts.app')
@section('content')
    <div class="col-sm-12 col-md-10 col-md-offset-1">
        @if(session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Product</th>
                <th class="text-center">Price</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach(Cart::content() as $item)
{{--                @dd($item->model)--}}
                @php
                    //$video_id = (int) $item->id;
                    $categories = \App\Models\VideoCategories::with('category')->where('video_id', $item->model->id)->get();
                @endphp
                <tr>
                    <td class="col-sm-8 col-md-6">
                        <div class="media">
                            <a class="thumbnail pull-left" href="#"> <img class="media-object"
                                                                          src="{{ asset('img/' . $item->model->photoURL) }}"
                                                                          style="width: 200px; height: 300px;"> </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="#">{{ $item->model->title }}</a></h4>
                                <h5 class="media-heading"> Categories:
                                    @foreach($categories as $category)
                                        <a href="{{ route('category', [$category->category->name]) }}">{{ $category->category->name }}<br></a>
                                    @endforeach
                                </h5>
                                <span>Duration: </span><span class="text-warning"><strong>{{ $item->model->runtime }}</strong></span><br><br>
                                <a href="#" data-target="{{ '#modalTrailer'.$loop->iteration }}"
                                   class="btn btn-primary btn-md" data-toggle="modal">Trailer
                                    <i class="fas fa-play ml-2"></i>
                                </a>
                                <!--Trailer Modal HTML -->
                                <div id="{{ 'modalTrailer'.$loop->iteration }}" class="modal fade">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ $item->model->title }}</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body-video">
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <iframe class="embed-responsive-item" width="900 px" height="500 px" src="{{ $item->model->trailerURL }}" allowfullscreen></iframe>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="close btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Trailer Modal HTML-->
                            </div>
                        </div>
                    </td>

                    <td class="col-sm-1 col-md-1 text-center"><strong>{{ '$' . $item->model->rentalPrice }}</strong></td>
                    <td class="col-sm-1 col-md-1">
                        <form action="{{ route('shopping-cart-destroy', $item->rowId) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-outline-danger">
                                <span class="fa fa-remove"></span> Remove
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <!--Total Price-->
            <tr>
                <td></td>
                <td><h4>Total (Tax included): </h4></td>
                <td class="text-right"><h3><strong>{{ Cart::total() }}</strong></h3></td>
            </tr>
            <!--Buton section-->
            <tr>
                <td><a href="{{ route('all-products') }}">
                        <button type="button" class="btn btn-success">
                            <i class="fa fa-arrow-left"></i> Continue Shopping
                        </button>
                    </a>
                </td>
                <td></td>
                <td>
                    @auth
                    <a href="{{ route('checkout') }}">
                        <button type="button" class="btn btn-success">
                            <span>Checkout <i class="fa fa-arrow-right"></i></span>
                        </button>
                    </a>
                    @else
                        <a href="{{ route('login') }}">
                            <button type="button" class="btn btn-success">
                                <span>Checkout <i class="fa fa-arrow-right"></i></span>
                            </button>
                        </a>
                    @endauth
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('footer_scripts')
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
