@extends('layouts.app', ['activePage' => 'restaurant-management', 'titlePage' => __('Restaurants Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ url('vendor-save-restaurant') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Add Restaurant') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('restaurants.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
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
                  <h4>Restaurant Details</h4>
                </div>
                <hr/>
                <div class="row">
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('restaurant_name') ? ' has-danger' : '' }}">
                      <div class="input-group">
                        <div class="input-group-prepend">
                                      <span class="input-group-text">
                                          <i class="material-icons">business</i>
                                      </span>
                        </div>
                        <input type="text" name="restaurant_name" class="form-control"
                               placeholder="{{ __('Restaurant Name...') }}" value="{{ old('restaurant_name') }}" required>
                      </div>
                      @if ($errors->has('restaurant_name'))
                        <div id="restaurant_name-error" class="error text-danger pl-3" for="restaurant_name"
                             style="display: block;">
                          <strong>{{ $errors->first('restaurant_name') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('description') ? ' has-danger' : '' }}"
                    >
                      <div class="input-group">
                        <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">assignment_ind</i>
                  </span>
                        </div>
                        <input type="text" name="description" class="form-control"
                               placeholder="{{ __('Description...') }}" value="{{ old('description') }}" required>
                      </div>
                      @if ($errors->has('description'))
                        <div id="description-error" class="error text-danger pl-3" for="description"
                             style="display: block;">
                          <strong>{{ $errors->first('description') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row" style="margin-top: 1em;">
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('address') ? ' has-danger' : '' }}"
                    >
                      <div class="input-group">
                        <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">streetview</i>
                  </span>
                        </div>
                        <textarea placeholder="Enter Address" name="address" rows="2" class="form-control">{{old('address')}}</textarea>
                      </div>
                      @if ($errors->has('address'))
                        <div id="address-error" class="error text-danger pl-3" for="address"
                             style="display: block;">
                          <strong>{{ $errors->first('address') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('business_hours') ? ' has-danger' : '' }}">
                      <div class="input-group">
                        <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                    <i class="material-icons">alarm</i>
                                                  </span>
                        </div>
                        <input type="text" name="business_hours" class="form-control"
                               placeholder="{{ __('Business Hours...') }}" value="{{ old('business_hours') }}" required>
                      </div>
                      @if ($errors->has('business_hours'))
                        <div id="business_hours-error" class="error text-danger pl-3" for="business_hours"
                             style="display: block;">
                          <strong>{{ $errors->first('business_hours') }}</strong>
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
                    <i class="material-icons">local_phone</i>
                  </span>
                       </div>
                       <input  type="tel" name="contact_number" class="form-control"
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
                 <input name="vendor_id" value="{{$vendor_id}}" hidden>
               </div>

              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-success">{{ __('Save Restaurant') }}</button>
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