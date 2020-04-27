@extends('layouts.app', ['activePage' => 'menu-management', 'titlePage' => __('Menu Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('menus.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Add Menu') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('menus.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
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
                  <h4>Menu Details</h4>
                </div>
                <hr/>
                <div class="row">
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('menu_name') ? ' has-danger' : '' }}">
                      <div class="input-group">
                        <div class="input-group-prepend">
                                      <span class="input-group-text">
                                          <i class="material-icons">business</i>
                                      </span>
                        </div>
                        <input type="text" name="menu_name" class="form-control"
                               placeholder="{{ __('Menu Title...') }}" value="{{ old('menu_name') }}" required>
                      </div>
                      @if ($errors->has('menu_name'))
                        <div id="menu_name-error" class="error text-danger pl-3" for="menu_name"
                             style="display: block;">
                          <strong>{{ $errors->first('menu_name') }}</strong>
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
                        <textarea name="description" placeholder="Menu Description" class="form-control" rows="3">{{old('description')}}</textarea>

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
                <div class="row">
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('restaurant_id') ? ' has-danger' : '' }} mt-3">
                      <div class="input-group">
                        <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="material-icons">business</i>
                                      </span>
                        </div>
                        <select class="form-control js-example-basic-single" id="restaurant_id" name="restaurant_id"
                                required>
                          <option value="99999">Select Restaurant</option>
                          @foreach($restaurants as $restaurant)
                            <option value="{{$restaurant->id}}">{{$restaurant->restaurant_name}}</option>
                          @endforeach
                        </select>
                      </div>
                      @if ($errors->has('restaurant_id'))
                        <div id="restaurant_id-error" class="error text-danger pl-3" for="restaurant_id"
                             style="display: block;">
                          <strong>{{ $errors->first('restaurant_id') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                </div>

              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-success">{{ __('Save Menu') }}</button>
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