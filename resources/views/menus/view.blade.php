@extends('layouts.app', ['activePage' => 'vendor-management', 'titlePage' => __('Menu Items Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Menu Details') }}</h4>
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
                               placeholder="{{ __('Menu Title...') }}" value="{{ $menu->menu_name }}" required>
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
                      <i class="material-icons">assessment</i>
                  </span>
                        </div>
                        <textarea name="description" class="form-control" rows="3">{{$menu->description}}</textarea>

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
                          @foreach($restaurants as $restaurant)
                            <option value="{{$restaurant->id}}" {{$restaurant->id==$menu->restaurant_id?'selected':''}}>{{$restaurant->restaurant_name}}</option>
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
                <hr style="margin-top: 3em;"/>
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="text-center">Current Menu Items</h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <table class="table">
                      <thead>
                      <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Is Vegan</th>
                        <th>Is Halaal</th>
                      </tr>
                      </thead>
                      <tbody id="restaurants-table-body">
                      @if(empty($menu->menu_items))
                        <tr></td> <td colspan="5">No Menu Items Yet</td>  </tr>
                      @else
                        @foreach($menu->menu_items as $menu)
                          <tr><td>{{$menu->item_name}}</td><td>{{$menu->item_description}}</td><td>{{$menu->item_price}}</td><td>{{$menu->is_vegan}}</td><td>{{$menu->is_halaal}}</td></tr>
                        @endforeach
                      @endif
                      </tbody>
                    </table>
                  </div>
                </div>
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
        $(".alert").first().hide().fadeIn(200).delay(4000).fadeOut(2000, function () { $(this).remove(); });
      });

    </script>
  @endpush
@endsection