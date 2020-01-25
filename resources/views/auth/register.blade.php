@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'register', 'title' => __('Patient Registration')])

@section('content')
    <div class="container" style="height: auto;">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-10 col-sm-12 ml-auto mr-auto">
                <form class="form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="card card-login card-hidden mb-3">
                        <div class="card-header card-header-primary text-center" style="background:#fff;">
                            <a href="login">
                            <img src="{{asset('images/logo.png')}}" width="10%"/>
                            <h4 class="card-title" style="color: black;font-weight: bolder;"><strong>{{ __('Registration') }}</strong></h4></a>
                        </div>
                        <div class="card-body ">
                                <div class="bmd-form-group text-center">
                                    <h4>Profile Information</h4>
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
                                                       placeholder="{{ __('Name...') }}" value="{{ old('name') }}"
                                                       required>
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
                                                       placeholder="{{ __('Surname...') }}" value="{{ old('surname') }}"
                                                       required>
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
                                                       placeholder="{{ __('Email...') }}" value="{{ old('email') }}"
                                                       required>
                                            </div>
                                            @if ($errors->has('email'))
                                                <div id="email-error" class="error text-danger pl-3" for="email"
                                                     style="display: block;">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="margin-top:1em;">
                                        <div class="bmd-form-group{{ $errors->has('gender') ? ' has-danger' : '' }}">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="material-icons">streetview</i>
                                      </span>
                                                </div>
                                                <select class="form-control js-example-basic-single" id="gender"
                                                        name="gender"
                                                        required>
                                                    <option value="99999">Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                            @if ($errors->has('gender'))
                                                <div id="gender-error" class="error text-danger pl-3" for="gender"
                                                     style="display: block;">
                                                    <strong>{{ $errors->first('gender') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 1em;">
                                    <div class="col-md-6">
                                        <div class="bmd-form-group{{ $errors->has('contact_number') ? ' has-danger' : '' }}">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                      <i class="material-icons">contact_phone</i>
                                                  </span>
                                                </div>
                                                <input type="tel" name="contact_number" class="form-control"
                                                       placeholder="{{ __('Contact Number...') }}"
                                                       value="{{ old('contact_number') }}" required>
                                            </div>
                                            @if ($errors->has('contact_number'))
                                                <div id="contact_number-error" class="error text-danger pl-3"
                                                     for="contact_number"
                                                     style="display: block;">
                                                    <strong>{{ $errors->first('contact_number') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="bmd-form-group{{ $errors->has('role') ? ' has-danger' : '' }} mt-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                      <span class="input-group-text">
                                                    <i class="material-icons">face</i>
                                                  </span>
                                                </div>
                                                <select class="form-control js-example-basic-single" id="role"
                                                        name="role"
                                                        required>
                                                    <option>Register As</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{$role->id}}">{{$role->display_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if ($errors->has('role'))
                                                <div id="gender-error" class="error text-danger pl-3" for="role"
                                                     style="display: block;">
                                                    <strong>{{ $errors->first('role') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            <div class="row" style="margin-top: 1em;">
                                <div class="col-md-6">
                                    <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                          <span class="input-group-text">
                                            <i class="material-icons">lock_outline</i>
                                          </span>
                                            </div>
                                            <input type="password" name="password" id="password" class="form-control"
                                                   placeholder="{{ __('Password...') }}" required>
                                        </div>
                                        @if ($errors->has('password'))
                                            <div id="password-error" class="error text-danger pl-3" for="password"
                                                 style="display: block;">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="bmd-form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }} mt-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                  </span>
                                            </div>
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                   class="form-control" placeholder="{{ __('Confirm Password...') }}" required>
                                        </div>
                                        @if ($errors->has('password_confirmation'))
                                            <div id="password_confirmation-error" class="error text-danger pl-3"
                                                 for="password_confirmation" style="display: block;">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                                        <div class="form-check mr-auto ml-3 mt-3">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" id="policy"
                                                       name="policy" {{ old('policy', 1) ? 'checked' : '' }} >
                                                <span class="form-check-sign">
                                          <span class="check"></span>
                                        </span>
                                                {{ __('I agree with the ') }} <a style="color: #F7931E;" href="#">{{ __('Privacy Policy') }}</a>
                                            </label>
                                        </div>



                        </div>
                        <div class="card-footer justify-content-center">

                            <button type="submit" class="btn btn-primary btn-lg"
                                    style="margin-left:2em;">{{ __('Create account') }} <i
                                        class="material-icons">save</i></button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.css"
          integrity="sha256-AghQEDQh6JXTN1iI/BatwbIHpJRKQcg2lay7DE5U/RQ=" crossorigin="anonymous"/>
    @push('custom-scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
                integrity="sha256-bqVeqGdJ7h/lYPq6xrPv/YGzMEb6dNxlfiTUHSgRCp8=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function () {
                $('select').select2();
            });
        </script>
    @endpush
@endsection
