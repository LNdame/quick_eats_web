@extends('layouts.app', ['activePage' => 'patient-management', 'titlePage' => __('Patients Management')])
<?php
?>
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ url('practice-patients-update/'.$patient->id) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Edit Patient') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                    <a href="{{ route('patients.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                  </div>
                </div>
                <div class="bmd-form-group text-center">
                  <h4>Personal Details</h4>
                </div>
                <hr/>
                <div class="row">
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <div class="input-group">
                        <div class="input-group-prepend">
                                      <span class="input-group-text">
                                          <i class="material-icons">face</i>
                                      </span>
                        </div>
                        <input type="text" name="name" class="form-control"
                               placeholder="{{ __('Name...') }}" value="{{ $patient->name }}" required>
                      </div>
                      @if ($errors->has('name'))
                        <div id="name-error" class="error text-danger pl-3" for="name"
                             style="display: block;">
                          <strong>{{ $errors->first('name') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('surname') ? ' has-danger' : '' }}"
                    >
                      <div class="input-group">
                        <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">assignment_ind</i>
                  </span>
                        </div>
                        <input type="text" name="surname" class="form-control"
                               placeholder="{{ __('Surname...') }}" value="{{ $patient->surname }}" required>
                      </div>
                      @if ($errors->has('surname'))
                        <div id="surname-error" class="error text-danger pl-3" for="surname"
                             style="display: block;">
                          <strong>{{ $errors->first('surname') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row" style="margin-top: 1em;">
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <div class="input-group">
                        <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                    <i class="material-icons">email</i>
                                                  </span>
                        </div>
                        <input type="email" name="email" class="form-control"
                               placeholder="{{ __('Email...') }}" value="{{ $patient->email }}" required>
                      </div>
                      @if ($errors->has('email'))
                        <div id="email-error" class="error text-danger pl-3" for="email"
                             style="display: block;">
                          <strong>{{ $errors->first('email') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('id_number') ? ' has-danger' : '' }}"
                    >
                      <div class="input-group">
                        <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                      <i class="material-icons">assignment</i>
                                                  </span>
                        </div>
                        <input type="text" name="id_number" class="form-control"
                               placeholder="{{ __('Id Number...') }}" value="{{ $patient->id_number }}"
                               required>
                      </div>
                      @if ($errors->has('id_number'))
                        <div id="id_number-error" class="error text-danger pl-3" for="id_number"
                             style="display: block;">
                          <strong>{{ $errors->first('id_number') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row" style="margin-top: 1em;">
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('gender') ? ' has-danger' : '' }} mt-3">
                      <div class="input-group">
                        <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="material-icons">streetview</i>
                                      </span>
                        </div>
                        <select class="form-control js-example-basic-single" id="gender" name="gender"
                                required>
                          <option value="99999">Select Gender</option>
                          <option value="Male" {{$patient->gender=="Male"?'selected':''}}>Male</option>
                          <option value="Female" {{$patient->gender=="Female"?'selected':''}}>Female</option>
                        </select>
                      </div>
                      @if ($errors->has('gender'))
                        <div id="gender-error" class="error text-danger pl-3" for="gender"
                             style="display: block;">
                          <strong>{{ $errors->first('gender') }}</strong>
                        </div>
                      @endif
                    </div>
                    <input name="role" hidden value="patient">
                  </div>
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('race') ? ' has-danger' : '' }} mt-3">
                      <div class="input-group">
                        <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="material-icons">accessibility</i>
                                      </span>
                        </div>
                        <select class="form-control js-example-basic-single" id="race" name="race" required>
                          <option value="Asian" {{$patient->race=="Asian"?'selected':''}}>Asian</option>
                          <option value="Black" {{$patient->race=="Black"?'selected':''}}>Black</option>
                          <option value="Colored" {{$patient->race=="Colored"?'selected':''}}>Colored</option>
                          <option value="Indian" {{$patient->race=="Indian"?'selected':''}}>Indian</option>
                          <option value="White" {{$patient->race=="White"?'selected':''}}>White</option>
                        </select>
                      </div>
                      @if ($errors->has('race'))
                        <div id="race-error" class="error text-danger pl-3" for="race"
                             style="display: block;">
                          <strong>{{ $errors->first('race') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row" style="margin-top: 1em;">
                  <div class="col-md-6">
                    <div id="contact_number" class="bmd-form-group{{ $errors->has('contact_number') ? ' has-danger' : '' }} mt-3">
                      <div class="input-group">
                        <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">insert_invitation</i>
                  </span>
                        </div>
                        <input  type="text" name="contact_number" class="form-control"
                                placeholder="{{ __('Contact Number...') }}" value="{{ $patient->contact_number }}">
                      </div>
                      @if ($errors->has('contact_number'))
                        <div id="contact_number-error" class="error text-danger pl-3" for="contact_number"
                             style="display: block;">
                          <strong>{{ $errors->first('contact_number') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('gender') ? ' has-danger' : '' }} mt-3">
                      <div class="input-group">
                        <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="material-icons">home</i>
                                      </span>
                        </div>
                        <input id="pac-input" name="address" type="text" class="form-control"
                               placeholder="Physical address" value="{{$patient->address}}" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row" style="margin-top: 1em;">
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('medical_aid_name') ? ' has-danger' : '' }} mt-3">
                      <div class="input-group">
                        <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">local_hospital</i>
                  </span>
                        </div>
                        <select class="form-control js-example-basic-single" id="medical_aid_name" name="medical_aid_name"
                        >
                          <option value="99999">Select Medical Aid</option>
                          <option value="99991">No Medical Aid</option>
                          @foreach($medicalAids as $medical_aid)
                            <option {{in_array($medical_aid->id,$medical_aids)?'selected':''}} value="{{$medical_aid->id}}">{{$medical_aid->medical_aid_name}}</option>
                          @endforeach
                        </select>
                      </div>
                      @if ($errors->has('medical_aid_name'))
                        <div id="medical_aid_name-error" class="error text-danger pl-3" for="medical_aid_name"
                             style="display: block;">
                          <strong>{{ $errors->first('medical_aid_name') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div id="medical_aid_number" class="bmd-form-group{{ $errors->has('medical_aid_number') ? ' has-danger' : '' }} mt-3">
                      <div class="input-group">
                        <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">insert_invitation</i>
                  </span>
                        </div>
                        <input  type="text" name="medical_aid_number" class="form-control"
                                placeholder="{{ __('Medical Aid Number...') }}" value="{{$patient->medical_aid_number}}">
                      </div>
                      @if ($errors->has('medical_aid_number'))
                        <div id="medical_aid_number-error" class="error text-danger pl-3" for="medical_aid_number"
                             style="display: block;">
                          <strong>{{ $errors->first('medical_aid_number') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Update Patient') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @push('custom-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
      $(document).ready(function () {
        $('.js-example-basic-single').select2();
        var latitude = 0;
        var longitude = 0;

        if (navigator.geolocation) {
          console.log("getting current location")
          navigator.geolocation.getCurrentPosition(initMap);
        } else {
          $.notify('Geolocation is not supported by this browser', {
            type: "danger",
            align: "center",
            verticalAlign: "middle",
            animation: true,
            animationType: "drop"
          });
        }


        function initMap(position) {
          latitude = position.coords.latitude;
          longitude = position.coords.longitude;
          var input = document.getElementById('pac-input');
          var autocomplete = new google.maps.places.Autocomplete(input);
          autocomplete.setFields(
                  ['address_components', 'geometry', 'icon', 'name']);
        }
      });
    </script>
  @endpush
@endsection