@extends('layouts.app', ['activePage' => 'vendor-management', 'titlePage' => __('Menu Items Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form autocomplete="off" class="form-horizontal">
            @csrf

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Menu Item Details') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-6 text-left">
                    <a href="{{ route('menu-items.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                  </div>
                  <div class="col-md-6 text-right">
                    <a href="{{ url('menu-items/'.$menuItem->id.'/edit') }}" class="btn btn-sm btn-success">{{ __('Edit Menu Item') }}</a>
                  </div>
                </div>

                <div class="bmd-form-group text-center">
                  <h4>Menu Item Details</h4>
                </div>
                <hr/>
                <div class="row">
                  <div class="col-md-12">
                    <table class="table">
                      <thead>

                      </thead>
                      <tbody id="restaurants-table-body">
                      <tr><td>Name</td><td>{{$menuItem->item_name}}</td><tr><td>Description</td><td>{{$menuItem->item_description}}</td></tr>
                       <tr><td>Price</td> <td>{{$menuItem->item_price}}</td></tr><tr><td>Is Vegan</td><td>{{$menuItem->is_vegan}}</td></tr><tr><td>Is Halaal</td><td>{{$menuItem->is_halaal}}</td></tr><td>Image</td><td><img src="{{asset($menuItem->item_picture_url)}}"/></td></tr>
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

  @endpush
@endsection