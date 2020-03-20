@extends('layouts.app', ['activePage' => 'patient-management', 'titlePage' => __('Vendors Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('vendors.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Add Vendor') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('vendors.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                  </div>
                </div>
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="bmd-form-group text-center">
                  <h4>Vendor Details</h4>
                </div>
                <hr/>
                <div class="row">
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('trading_name') ? ' has-danger' : '' }}">
                      <div class="input-group">
                        <div class="input-group-prepend">
                                      <span class="input-group-text">
                                          <i class="material-icons">business</i>
                                      </span>
                        </div>
                        <input type="text" name="trading_name" class="form-control"
                               placeholder="{{ __('Vendor Trading Name...') }}" value="{{ old('trading_name') }}" required>
                      </div>
                      @if ($errors->has('trading_name'))
                        <div id="trading_name-error" class="error text-danger pl-3" for="trading_name"
                             style="display: block;">
                          <strong>{{ $errors->first('trading_name') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('contact_person_name') ? ' has-danger' : '' }}"
                    >
                      <div class="input-group">
                        <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">assignment_ind</i>
                  </span>
                        </div>
                        <input type="text" name="contact_person_name" class="form-control"
                               placeholder="{{ __('Contact Person Name...') }}" value="{{ old('contact_person_name') }}" required>
                      </div>
                      @if ($errors->has('contact_person_name'))
                        <div id="contact_person_name-error" class="error text-danger pl-3" for="contact_person_name"
                             style="display: block;">
                          <strong>{{ $errors->first('contact_person_name') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row" style="margin-top: 1em;">
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('contact_person_surname') ? ' has-danger' : '' }}"
                    >
                      <div class="input-group">
                        <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">assignment_ind</i>
                  </span>
                        </div>
                        <input type="text" name="contact_person_surname" class="form-control"
                               placeholder="{{ __('Contact Person Surname...') }}" value="{{ old('contact_person_surname') }}" required>
                      </div>
                      @if ($errors->has('contact_person_surname'))
                        <div id="contact_person_surname-error" class="error text-danger pl-3" for="contact_person_surname"
                             style="display: block;">
                          <strong>{{ $errors->first('contact_person_surname') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <div class="input-group">
                        <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                    <i class="material-icons">email</i>
                                                  </span>
                        </div>
                        <input type="email" name="email" class="form-control"
                               placeholder="{{ __('Email...') }}" value="{{ old('email') }}" required>
                      </div>
                      @if ($errors->has('email'))
                        <div id="email-error" class="error text-danger pl-3" for="email"
                             style="display: block;">
                          <strong>{{ $errors->first('email') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                </div>
               <div class="row">
                 <div class="col-md-6">
                   <div id="contact_number" class="bmd-form-group{{ $errors->has('contact_number') ? ' has-danger' : '' }} mt-3">
                     <div class="input-group">
                       <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">insert_invitation</i>
                  </span>
                       </div>
                       <input  type="text" name="contact_number" class="form-control"
                               placeholder="{{ __('Contact Number...') }}" value="{{ old('contact_number') }}">
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
                   <div class="bmd-form-group{{ $errors->has('category_id') ? ' has-danger' : '' }} mt-3">
                     <div class="input-group">
                       <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="material-icons">streetview</i>
                                      </span>
                       </div>
                       <select class="form-control js-example-basic-single" id="category_id" name="category_id"
                               required>
                         <option value="99999">Category</option>
                          @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                       </select>
                     </div>
                     @if ($errors->has('category_id'))
                       <div id="gender-error" class="error text-danger pl-3" for="category_id"
                            style="display: block;">
                         <strong>{{ $errors->first('category_id') }}</strong>
                       </div>
                     @endif
                   </div>
                 </div>
               </div>

              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Save Vendor') }}</button>
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

    });
  </script>
  @endpush
@endsection