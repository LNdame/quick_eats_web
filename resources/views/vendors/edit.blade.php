@extends('layouts.app', ['activePage' => 'vendor-management', 'titlePage' => __('Vendors Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ url('vendors/'.$vendorCur->id) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Edit Vendor') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-6 text-left">
                    <a href="{{ route('vendors.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                  </div>
                  <div class="col-md-6 text-right">
                    <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#restaurants-modal">{{ __('Add Restaurant') }}</a>
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
                               placeholder="{{ __('Vendor Trading Name...') }}" value="{{ $vendorCur->trading_name }}" required>
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
                               placeholder="{{ __('Contact Person Name...') }}" value="{{ $vendorCur->contact_person_name }}" required>
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
                               placeholder="{{ __('Contact Person Surname...') }}" value="{{ $vendorCur->contact_person_surname}}" required>
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
                               placeholder="{{ __('Email...') }}" value="{{ $vendorCur->email}}" required>
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
                                placeholder="{{ __('Contact Number...') }}" value="{{ $vendorCur->contact_number }}">
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
                          <option value="99999">Select Category</option>
                          @foreach($categories as $category)
                            <option value="{{$category->id}}" {{$vendorCur->category_id==$category->id?'selected':''}}>{{$category->category_name}}</option>
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
                <div class="row"  style="margin-top: 2em;">
                  <button type="submit" style="margin-left: 45%; margin-top: 2em;" class="btn btn-success ">{{ __('Update Vendor') }}</button>
                </div>
                <hr/>
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="text-center">Vendor Current Restaurants</h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <table class="table">
                      <thead>
                      <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Business hours</th>
                        <th>Contact Number</th>
                        <th class="text-right">Actions</th>
                      </tr>
                      </thead>
                      <tbody id="restaurants-table-body">
                      @if(empty($vendorCur->restaurants))
                       <tr></td> <td colspan="5">No Restaurants Yet</td>  </tr>
                        @else
                        @foreach($vendorCur->restaurants as $restaurant)
                          <tr><td>{{$restaurant->restaurant_name}}</td><td>{{$restaurant->description}}</td><td>{{$restaurant->business_hours}}</td><td>{{$restaurant->contact_number}}</td><td class="td-actions text-right">
                              <button id="{{$restaurant->id}}" type="button" rel="tooltip" title="Delete Restaurant" onclick="confirm_delete(this)" class="btn btn-danger">
                                <i class="material-icons">close</i>
                              </button>
                            </td></tr>
                      @endforeach
                      @endif
                      </tbody>
                    </table>
                  </div>
                  </div>
                </div>
              </div>
            <input hidden id="vendor-id" name="vendor_id">
          </form>
        </div>
      </div>

    </div>
  </div>
  <div class="modal" tabindex="-1" role="dialog" id="restaurants-modal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Restaurant Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <form method="post" id="restaurants-form" autocomplete="off" class="form-horizontal">
                @csrf
                @method('post')
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
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('trading_name') ? ' has-danger' : '' }} mt-3">
                      <div class="input-group">
                        <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="material-icons">business</i>
                                      </span>
                        </div>
                        <select class="form-control" id="trading_name" name="vendor_id"
                                required>
                          <option value="99999">Select Vendor</option>
                          @foreach($vendors as $vendor)
                            @if($vendorCur->id==$vendor->id)
                            <option value="{{$vendor->id}}" selected>{{$vendor->trading_name}}</option>
                            @endif
                          @endforeach
                        </select>
                      </div>
                      @if ($errors->has('trading_name'))
                        <div id="trading_name-error" class="error text-danger pl-3" for="trading_name"
                             style="display: block;">
                          <strong>{{ $errors->first('trading_name') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row"  style="margin-top: 2em;">
                  <button type="submit" style="margin-left: 45%; margin-top: 2em;" class="btn btn-success ">{{ __('Save Restaurant') }}</button>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  @push('custom-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
      var vendor={!! $vendorCur !!}
      $(document).ready(function () {
        $('.js-example-basic-single').select2();
        $(".alert").first().hide().fadeIn(200).delay(4000).fadeOut(2000, function () { $(this).remove(); });
        $('#restaurants-form').on('submit',function(e){
          e.preventDefault();
          let formData = new FormData();
          formData.append('form-data', $('#restaurants-form').serialize());
          console.log('FormData', formData);
          let url = '/save-vendor-restaurant';
          $.ajax({
            url: url,
            processData: false,
            contentType: false,
            data: formData,
            type: 'post',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')},
            success: function (response, a, b) {
              console.log("success", response);
              let restaurants = response.restaurants;
              $.notify(response.message, "success");

              $('#restaurants-table-body').empty();
              for(var i=0;i<restaurants.length;i++){
                let restaurant = restaurants[i];
                $('#restaurants-table-body').append('<tr><td>'+restaurant.restaurant_name+'</td><td>'+restaurant.description+'</td><td>'+restaurant.business_hours+'</td><td>'+restaurant.contact_number+'</td><td class="td-actions text-right">\n' +
                        '                              <button id="{{$restaurant->id}}" type="button" title="Delete Restaurant" onclick="confirm_delete(this)" class="btn btn-danger">\n' +
                        '                                <i class="material-icons">close</i>\n' +
                        '                              </button>\n' +
                        '                            </td></tr>');
              }
              $( '#restaurants-form' ).each(function(){
                this.reset();
                $('#vendor-id').val(vendor.id);
              });
            },
            error: function (response) {
              console.log("error", response);
              let message = response.responseText;
              $.notify('An error occurred ' + message);
            }
          });
        });
      });
      function confirm_delete(obj) {
        Swal.fire({
          title: 'Are you sure want to delete this Restaurant!',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: 'green',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete!'
        }).then((result) => {
          if (result.value) {
            let url = '/admin-remove-vendor-restaurant/'+obj.id;
            $.get(url, function (data, status) {
              let message = data.message;
              if (status == 'success') {
                Swal.fire(
                        'Deleted!',
                        message,
                        'success'
                );
                let restaurants = data.restaurants;
                $('#restaurants-table-body').empty();
                for(var i=0;i<restaurants.length;i++){
                  let restaurant = restaurants[i];
                  $('#restaurants-table-body').append('<tr><td>'+restaurant.restaurant_name+'</td><td>'+restaurant.description+'</td><td>'+restaurant.business_hours+'</td><td>'+restaurant.contact_number+'</td><td class="td-actions text-right">\n' +
                          '                              <button id="{{$restaurant->id}}" type="button" title="Delete Restaurant" onclick="confirm_delete(this)" class="btn btn-danger">\n' +
                          '                                <i class="material-icons">close</i>\n' +
                          '                              </button>\n' +
                          '                            </td></tr>');
                }
                $( '#restaurants-form' ).each(function(){
                  this.reset();
                  $('#vendor-id').val(vendor.id);
                });

              } else {
                Swal.fire(
                        'Failed!',
                        'An error occured',
                        'error'
                );
              }
            });

          }
        });
      }
    </script>
  @endpush
@endsection