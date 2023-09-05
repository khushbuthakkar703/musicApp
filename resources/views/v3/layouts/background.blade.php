<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
            crossorigin="anonymous"
    />
    <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/icon?family=Material+Icons"
    />
    <link rel="stylesheet" href="/css/style.css"/>
    <title>DJ Register (dev)</title>
</head>

<body class="text-white">
<div class="container-fluid">
    <div class="d-flex justify-content-between text-center">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <a>
                <img
                        src="https://spinstatz.eu/wp-content/uploads/2020/11/spinstatz-logo-ms.png"
                        width="70%"
                />
            </a>
        </div>
        <div class="col-md-4 login-div">
            <img src="/img/shape.jpg" width="90%"/>
            <h4 class="login-div-text font-weight-bold">
                You already have an<br/>spinstatz account?
            </h4>
            <a href="/" class="login-div-btn"
            >LOG IN</a
            >
        </div>
    </div>
    <div class="row">
        <div
                class="d-flex justify-content-center flex-column text-center w-100 px-5"
        >
            <h1 class="font-weight-bold">Registration for DJs</h1>
            <h5 class="px-5 font-weight-light">
                Create an account to gain access. Please move Spinstatz emails to
                your PRIMARY INBOX to ensure that you receive future emails form us.
            </h5>
        </div>
    </div>
    <div class="row w-100 d-flex justify-content-center">
        <span class="line"></span>
    </div>
    <div class="row mt-5 pb-5">
        @if ($errors->any())
        <div class="alert alert-danger col-md-8 offset-md-2">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="col-md-8 offset-md-2">
            <form class="dj-form" method="POST" action="{{route('dj.signup')}}">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" id="first_name" name="fname" placeholder="First Name" value="{{old('fname')}}" />
                    </div>
                    <div class="col-md-6">
                        <select type="text" id="country" class="countryOption" placeholder="Country">
                            <option selected disabled>Select Country</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" id="first_name" placeholder="Last Name"  name="lname" value="{{old('lname')}}"/>
                    </div>
                    <div class="col-md-6">
                        <select type="text" class="stateOption" id="first_name" placeholder="State" >
                            <option selected disabled>State</option>
                        </select>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" id="first_name" placeholder="DJ Name" name="dj_name" value="{{old('dj_name')}}"/>
                    </div>
                    <div class="col-md-6">
                        <select type="text" id="first_name" class="cityOption" placeholder="City" name="city" >
                            <option selected disabled>City</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" placeholder="Email"  name="email" value="{{old('email')}}"/>
                    </div>
                    <div class="col-md-6">
                        <input type="text" placeholder="Address"  name="address" value="{{old('address')}}"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="password" placeholder="Password" name="password"  />
                    </div>
                    <div class="col-md-6">
                        <input type="text" placeholder="Zipcode"  name="zipcode" value="{{old('email')}}"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <select
                                type="text"
                                id="genre_select"
                                name="musictype[]"
                                multiple
                        >
                            <option disabled>Genre</option>
                            @foreach($musicTypes as $musicType)
                            <option>{{$musicType->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select type="text" name="dj_type" >
                            <option selected disabled>Select DJ Type</option>
                            <option value="club">Club</option>
                            <option value="online">Online</option>
                            <option value="mobile">Mobile</option>
                        </select>

                        <input type="text" id="first_name" placeholder="Phone Number"  name="phoneno" value="{{old('phoneno')}}"/>
                        <div class="d-flex align-items-center">
                            <input type="checkbox" class="col-md-1"/>
                            <label
                                    class="form-check-label"
                                    for="flexCheckDefault"
                                    class="col-md-11"
                            >
                                I accept the terms of use and the privacy statement *
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <input type="submit" class="sign-up-btn" value="Sign Up"/>
                    </div>
                </div>
            </form>
<!--            <button-->
<!--                    type="button"-->
<!--                    class="sign-up-btn"-->
<!--                    data-toggle="modal"-->
<!--                    data-target="#exampleModal"-->
<!--            >-->
<!--                Launch demo modal-->
<!--            </button>-->
        </div>
    </div>
    <div class="row footer d-flex justify-content-between px-4">
        <div class="footer-left">
            <p class="m-0">&#169; 2021 - Spinstatz</p>
        </div>
        <div class="footer-right d-flex align-items-center">
            <ul class="footer-nav">
                <li class>FAQ</li>
                <li>Imprint</li>
                <li>Privacy</li>
                <li>Terms of Use</li>
            </ul>
            <div class="px-3">
                <i class="material-icons">facebook</i>
            </div>
        </div>
    </div>
</div>

<script
        src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"
></script>
<script
        src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"
></script>
<script
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"
></script>
<script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"
></script>
<script>
    $(document).ready(function(){
        $.get( "/countries", function( data ) {
            $.each(data,function(index,stateObject){
                appende = '<option  value="'+stateObject.id+'">'+stateObject.name + '</option>';
                $('.countryOption').append(appende);
            });

            country = $( ".countryOption" ).val();
            loadState(country)
        });

        $('.countryOption').change(function(element){
            $('.stateOption').html('<option selected disabled>State</option>');
            $('.cityOption').html('<option selected disabled>City</option>');
            loadState(this.value)
        })

        $('.stateOption').change(function(element){
            $('.cityOption').html('<option selected disabled>City</option>');
            loadCity(this.value)
        })

    });

    function loadState(country){
        $.get( "/country/states/"+country, function( data ) {
            $.each(data,function(index,stateObject){
                $('.stateOption').append('<option  value="'+stateObject.id+'">'+ stateObject.name + '</option>');
            });

            state = $( ".stateOption" ).val();
            loadCity(state)
        })
    }


    function loadCity(state){
        $.get( "/state/cities/"+state, function( data ) {
            $.each(data,function(index,stateObject){
                $('.cityOption').append('<option  value="'+stateObject.id+'">'+stateObject.name + '</option>');
            });
        });
    }
</script>
</body>
</html>

<div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content pp-modal p-3">
            <div class="d-flex justify-content-center align-items-center">
                <div>
                    <img
                            src="https://spinstatz.eu/wp-content/uploads/2020/11/favicon.png"
                            width="50px"
                            height="50px"
                    />
                </div>
                <h3 class="m-0 pl-3">Privacy Preference</h3>
            </div>
            <h5 class="text-left mt-4">
                We use cookies on our website. Some of them are essential, while others
                help us to improve this website and your experience.
            </h5>
            <div class="d-flex justify-content-between my-2">
                <div class="col-md-4 form-check d-flex align-items-center">
                    <input
                            class="form-check-input"
                            type="checkbox"
                            value=""
                            id="defaultCheck1"
                    />
                    <label class="form-check-label ml-4 pt-1" for="defaultCheck1">
                        Essential
                    </label>
                </div>
                <div class="col-md-4 form-check d-flex align-items-center">
                    <input
                            class="form-check-input"
                            type="checkbox"
                            value=""
                            id="defaultCheck1"
                    />
                    <label class="form-check-label ml-4 pt-1" for="defaultCheck1">
                        Statistics
                    </label>
                </div>
                <div class="col-md-4 form-check d-flex align-items-center">
                    <input
                            class="form-check-input"
                            type="checkbox"
                            value=""
                            id="defaultCheck1"
                    />
                    <label class="form-check-label ml-4 pt-1" for="defaultCheck1">
                        External Media
                    </label>
                </div>
            </div>
            <button class="btn btn-success btn-lg mt-3">Accept all</button>
            <button class="btn btn-light btn-lg mt-3">Save</button>
            <a class="m-0 mt-3 text-success">Individual Privacy Preferences</a>
            <div class="small-txt">
                <a class="text-secondary">Cookie Details</a>
                <a class="text-secondary">Privacy Policy</a>
                <a class="text-secondary border-0">Imprint</a>
            </div>
        </div>
    </div>
</div>
