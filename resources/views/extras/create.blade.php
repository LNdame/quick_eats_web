@extends('layouts.app', ['activePage' => 'extras-management', 'titlePage' => __('Extras Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('extras.store') }}" enctype="multipart/form-data" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Add Menu Item Extra') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('extras.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
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
                  <h4>Category</h4>
                </div>
                <hr/>
                <div class="row">
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <div class="input-group">
                        <div class="input-group-prepend">
                                      <span class="input-group-text">
                                          <i class="material-icons">folder_special</i>
                                      </span>
                        </div>
                        <input id="name" type="text" name="name" class="form-control"
                               placeholder="{{ __('Item Name...') }}" value="{{ old('name') }}" required>
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
                        <div class="bmd-form-group{{ $errors->has('price') ? ' has-danger' : '' }} mt-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="material-icons">attach_money</i>
                                      </span>
                                </div>
                                <input type="number" step="0.01" name="price" class="form-control"
                                       placeholder="{{ __('Item Price...') }}" value="{{ old('price') }}" required>
                            </div>
                            @if ($errors->has('price'))
                                <div id="price-error" class="error text-danger pl-3" for="price"
                                     style="display: block;">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

              </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="bmd-form-group{{ $errors->has('description') ? ' has-danger' : '' }}"
                        >
                            <div class="input-group">
                                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">assignment</i>
                  </span>
                                </div>
                                <textarea name="description" placeholder="Item Description" class="form-control" rows="2">{{old('description')}}</textarea>

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
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-success">{{ __('Save Item') }}</button>
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