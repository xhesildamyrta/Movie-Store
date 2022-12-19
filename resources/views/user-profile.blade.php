@extends('layouts.app')

@section('head_scripts')

@endsection
@section('content')
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Account settings
        </h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>
                            {{$error}}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session()->get('message'))
            <div class="alert alert-success" role="alert">
                <strong>Success: </strong>{{session()->get('message')}}
            </div>
        @endif
        <form action="{{ route('profile-update') }}" method="POST">
            @csrf
            <div class="card overflow-hidden">
                <div class="row no-gutters row-bordered row-border-light">
                    <div class="col-md-3 pt-0">
                        <div class="list-group list-group-flush account-settings-links">
                            <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list"
                               href="#account-change-password">Change password</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-my-booking">My Purchases</a>
                            <a href="{{ route('logout') }}" class="list-group-item list-group-item-action" data-toggle="list" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="account-general">
                                
                                <hr class="border-light m-0">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Name</label>
                                        <input type="text" class="form-control mb-1" name="name" value="{{ old('name', $user->name) }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">E-mail</label>
                                        <input type="text" class="form-control mb-1" name="email" value="{{ old('email', $user->email) }}">
                                    </div>
                                </div>
                            </div>

                            <!--change password-->
                            <div class="tab-pane fade" id="account-change-password">
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">New password</label>
                                        <input id="new-password" type="password" class="form-control @error('password') is-invalid @enderror" name="new_password" autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Confirm password</label>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                    </div>
                                </div>
                            </div>

                            <!--My bookings-->
                            <div class="tab-pane fade" id="account-my-booking">
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">Purchases</label>
                                        @foreach($purchases as $purchase)
                                            <div class="row wow fadeIn">
                                                <!--Grid column-->
                                                <div class="col-lg-5 col-xl-4 mb-4">
                                                    <!--Featured image-->
                                                    <div class="view overlay rounded z-depth-1-half">
                                                        <div class="view overlay">
                                                            <img src="{{ asset('img/'.$purchase->video->photoURL) }}" class="banner">

                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Grid column-->
                                                <!--Grid column-->
                                                <div class="col-lg-7 col-xl-7 ml-xl-4 mb-4">
                                                    <!--DETAILS BUTTON-->
                                                    <p class="grey-text">
                                                        <a href="#" target="_blank" class="btn btn-light"
                                                           data-toggle="modal" data-target="{{ '#modal'.$loop->iteration }}">Details
                                                            <i class="fas fa-info-circle ml-1"></i>
                                                        </a>
                                                    </p>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="{{ 'modal'.$loop->iteration }}" role="dialog">
                                                        <div
                                                            class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div>
                                                                    <button type="button" class="close mr-2"
                                                                            data-dismiss="modal">&times;
                                                                    </button>
                                                                    <h3 class="modal-title h3 ml-3 mt-5">{{ $purchase->video->title }}</h3>
                                                                    <hr>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h6>Details:</h6>
                                                                    <p> {{ $purchase->video->description }} </p>
                                                                    <ul>
                                                                        <li>Year : {{ $purchase->video->yearOfRelease }}</li>
                                                                        <li>Runtime : {{ $purchase->video->runtime }}</li>
                                                                        <li>Rating : {{ $purchase->video->rating }}</li>
                                                                    </ul>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger"
                                                                            data-dismiss="modal">Close
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--DETAILS BUTTON-->
                                                    <p><a href="{{ $purchase->video->trailerURL }}" target="_blank"
                                                          class="btn btn-primary btn-md">Trailer <i
                                                                class="fas fa-play ml-2"></i>
                                                        </a>
                                                    </p>
                                                    @if($purchase->expiration > 0)
                                                    <p><a href="{{ route('movie') }}" target="_blank"
                                                          class="btn btn-primary btn-md">Watch <i
                                                                class="fas fa-play ml-2"></i>
                                                        </a>
                                                    </p>
                                                    <p class="alert alert-info">Video expires in <strong>{{ $purchase->expiration }}</strong> days!</p>
                                                    @else
                                                        <p><a href="#" target="_blank"
                                                              class="btn btn-secondary btn-md disabled">Watch <i
                                                                    class="fas fa-play ml-2"></i>
                                                            </a>
                                                        </p>
                                                        <p class="alert alert-warning">Unfortunately, your rental has expired!</p>
                                                        @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-right mt-3">
                <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
                <button type="button" class="btn btn-default"><a href="{{ route('home-page') }}" style="text-decoration: none">Cancel</a></button>
            </div>
        </form>
    </div>

@endsection
@section('footer_scripts')
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

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
@endsection
