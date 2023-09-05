@extends('layouts.campaignapp')
@section('content')
<title>SpinStatz | Edit</title>
<style type="text/css">
  .right_table_card{
      color: white !important;
    background-color: black !important;
}
.update_btn{

  background-color:#84ffff;
  border-color:#84ffff;
  color: #000;
}

</style>
<main id="pad" class=" mdl-layout__content mdl-color--grey-800 mt-n4 user_campaign_content">
  <!-- <div class="container-fluid container"> -->
  <div class="container">
    <form method="POST" action="/campaign/edit/profile" enctype="multipart/form-data" id="form">
      {{ csrf_field() }}
      <br><br>
      <div class="card-deck mt-4 col-12 advance_filter">
        <div class="card">
          <div class="card-body m-3 sm-mb-20">
            <header class="widget-header">CONTACT INFORMATION</header>
            <div class="widget-body">
              <label for="campaignname">Campaign Name *</label>
              <input name="campaignname" id="campaignname" class="form-control inputBox" placeholder="Campaign Name"
                     value="{{$campaign->campaign_name}}" data-validetta="required,text">
              @if ($errors->has('campaignname'))
              <span class="help-block has-error">
                    <strong>{{ $errors->first('campaignname') }}</strong>
                </span>
              @endif
              <label for="fname">First Name *</label>
              <input name="fname" id="fname" class="form-control" value="{{$campaign->first_name}}"
                     placeholder="First Name" data-validetta="required,text">
              @if ($errors->has('fname'))
              <span class="help-block has-error">
                    <strong>{{ $errors->first('fname') }}</strong>
                </span>
              @endif
              <label for="lname">Last Name*</label>
              <input name="lname" id="lname" class="form-control" value="{{$campaign->last_name}}"
                     placeholder="Last Name" data-validetta="required,text">
              @if ($errors->has('lname'))
              <span class="help-block">
                    <strong>{{ $errors->first('lname') }}</strong>
                </span>
              @endif


              <label for="username">Company Name *</label>
              <input type="text" name="company_name" id="company_name" class="form-control"
                     value="{{$campaignaudio->company_name}}" placeholder="Company Name" data-validetta="required,text">

              <label for="username">Country</label>
              <br>

              <select id="btnGroupVerticalDrop1 " type="button"
                      class="btn btn-default dropdown-toggle countryOption form-control"
                      data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false" data-validetta="required"
                      @if(isset($country->id)) val="{{$country->id}}" @endif>

              </select>
              <br>
              <label for="username">State *</label>
              <br>
              <select id="btnGroupVerticalDrop1 "
                      type="button" class="btn btn-default dropdown-toggle stateOption form-control"
                      data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false" id="stateOption" data-validetta="required"
                      @if(isset($state->id)) val="{{$state->id}}" @endif>
              </select>

              <br>
              <label for="username">City</label>
              <br>
              <select id="btnGroupVerticalDrop1 "
                      type="button"
                      class="btn btn-default dropdown-toggle cityOption form-control"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                      name="city" id="cityOption" data-validetta="required" val="{{$campaign->city}}">
              </select>

              @if ($errors->has('city'))
              <span class="help-block">
                <strong>{{ $errors->first('city') }}</strong>
            </span>
              @endif
              <br>
              <label for="username">Street Address *</label>
              <br>
              <input type="text" name="street" id="address" class="form-control" value="{{$campaign->street}}"
                     placeholder="Street" data-validetta="required,text">
              @if ($errors->has('street'))
              <span class="help-block">
                    <strong>{{ $errors->first('street') }}</strong>
                </span>
              @endif
              <label for="username">Zipcode *</label>
              <input type="text" class="form-control" id="zipcode" value="{{$campaign->zipcode}}" placeholder="Zip Code"
                     name="zipcode" data-validetta="required">
              @if ($errors->has('zipcode'))
              <span class="help-block">
                    <strong>{{ $errors->first('zipcode') }}</strong>
                </span>
              @endif
              <br>
              <label for="phone">Phone Number*</label>
              <br>
              <input type="text" name="phone" id="phone" class="form-control" value="{{$campaign->phone}}"
                     placeholder="Phone Number" data-validetta="required">
              @if ($errors->has('phone'))
              <span class="help-block " style="color:#d67979">
                    <strong>Phone number must be numeric</strong>
                </span>
              @endif
              <br>
              <input type="submit" class="next-btn btn btn-lg btn-primary update_btn" value="Update">

            </div>
          </div>
        </div>

        <div class="col-md-6 col-xs-12">
          <div class="widget widget-default right_table_card">
            <header class="widget-header">AUDIO DETAILS</header>
            <div class="widget-body">
              <label for="phone">Song Title</label>
              <input type="text" class="form-control" name="song_title" value="{{$campaignaudio->song_title}}"
                     placeholder="Song Title Name">
              @if ($errors->has('song_title'))
              <span class="text-danger">
                            <strong>{{ $errors->first('song_title') }}</strong>
                        </span>
              @endif

              <label for="phone">Artist Website</label>
              <input type="text" class="form-control" name="artist_website" value="{{$campaignaudio->artist_website}}"
                     placeholder="Enter the artist website">
              @if ($errors->has('artist_website'))
              <span class="text-danger">
                            <strong>{{ $errors->first('artist_website') }}</strong>
                        </span>
              @endif

              <label for="release_date">Release Date</label>
              <input type="date" class="form-control" value="{{$campaignaudio->release_date}}" name="release_date">

              @if ($errors->has('release_date'))
              <span class="text-danger">
                            <strong>{{ $errors->first('release_date') }}</strong>
                        </span>
              @endif
              <label for="phone">ISRC code</label>
              <input type="text" class="form-control" name="isrc" value="{{$campaignaudio->isrc}}" minlength="12"
                     placeholder="Enter ISRC Code">

              @if ($errors->has('isrc'))
              <span class="text-danger">
            <strong>ISRC field is minimum 12 characters of the 12 characters the last 7 characters must be numbers</strong>
        </span>
              @endif
              <label for="phone">Upc Code</label>
              <input type="text" class="form-control" name="upc" value="{{$campaignaudio->upc}}"
                     placeholder="Enter UPC Code">

              @if ($errors->has('upc'))
              <span class="text-danger">
                            <strong>{{ $errors->first('upc') }}</strong>
                        </span>
              @endif
              <label for="phone">Artist Name</label>
              <input type="text" class="form-control" name="artist_name" value="{{$campaignaudio->artist_name}}"
                     placeholder="Enter the Artist's name">

              @if ($errors->has('artist_name'))
              <span class="text-danger">
                            <strong>{{ $errors->first('artist_name') }}</strong>
                        </span>
              @endif

              <div class="form-group">
                <label for="genre" class="col-md-12">Select the genre</label>
                @php
                $gen = json_decode($campaignaudio->genre)
                @endphp

                @for($i=0; $i < count($musictypes); $i++)
                <div class="col-md-6">
                  <input type="checkbox" name="musictype[]" id="terms_and_conditions" data-icheck
                         value="{{$musictypes[$i]->id}}" @if( in_array($musictypes[$i]->id, $gen)) checked @endif>
                  <label for="" class="icheck-label">{{$musictypes[$i]->name}}</label>
                </div>

                @endfor
              </div>


              @if ($errors->has('genre'))
              <span class="text-danger">
                            <strong>{{ $errors->first('genre') }}</strong>
                        </span>
              @endif

              <div class="col-md-12 mt-sm-4">
              <input type="submit" class="next-btn btn btn-lg btn-primary update_btn" value="Update">
             </div>
            </div>

          </div>

        </div>
      </div>

      <div class="card-deck mt-4 col-12">
        <div class="card">
          <div class="card-body m-3 sm-mb-20">
            <div class="widget-header">
              <header class="widget-header">GENERAL INFORMATION</header>
            </div>
            <div class="widget-body">
              <label class="mdc-text-field mdc-text-field--outlined mdc-text-field--textarea mdc-text-field--no-label">
              <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__trailing"></span>
              </span>
                <span class="mdc-text-field__resizer">
    <textarea class="mdc-text-field__input" style="-webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
color:black;
    width: 100%;" rows="8" cols="40" aria-label="Bio" name="bio">
      {{$campaign->bio}}
    </textarea>
  </span>
              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="card-deck mt-4 col-12">
        <div class="card text-center">
          <input type="submit" class="next-btn mx-auto  btn btn-lg btn-primary w-50 update_btn" value="Update">
        </div>
      </div>
    </form>

  </div>
  <script src="/js/locationchooser.js"></script>
  <script>
      window.fbAsyncInit = function () {
          FB.init({
              appId: '1476167555843900',
              autoLogAppEvents: true,
              xfbml: true,
              version: 'v2.12'
          });
      };
      (function (d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) {
              return;
          }
          js = d.createElement(s);
          js.id = id;
          js.src = "https://connect.facebook.net/en_US/sdk.js";
          fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
  </script>
  <script src="{{asset('/js/validetta.js')}}"></script>
  <script>
      $('#form').validetta({
          validators: {
              regExp: {
                  password: {
                      pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/,
                      errorMessage: 'Password must include uppercase, lowercase and number'
                  }
              }
          }
      });

      $('#email').change(function () {
          //var email = $('#email').val();
          //checkEmail(email);
      });

      function checkEmail(email) {
          $.get('/checkemail/' + email, function (data) {
              console.log(data)
              if (data > 0) {
                  $('#email').after('<span class="validetta-bubble validetta-bubble--right" style="top: 257px; left: 553px;">This email is already taken.<br></span>');
              }
          });
      }
  </script>
  <div class="fb-customerchat" page_id="582913385432510">
</main>
@endsection

<style>
    .media-widget {
        display: none;
    }

</style>
