@extends('layouts.app', ['activePage' => 'menu-item-categories-management', 'titlePage' => __('Menu Item Category Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ url('category-item-update/'.$menuItemCategory->id) }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Update Menu Item Category') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                    <a href="{{ route('menu-items-category.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
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
                          <div class="bmd-form-group{{ $errors->has('item_name') ? ' has-danger' : '' }}">
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text">
                                          <i class="material-icons">folder_special</i>
                                      </span>
                                  </div>
                                  <input id="item_category_name" type="text" name="item_category_name" class="form-control"
                                         placeholder="{{ __('Category Name...') }}" value="{{$menuItemCategory->item_category_name}}" required>
                              </div>
                              @if ($errors->has('item_name'))
                                  <div id="item_category_name-error" class="error text-danger pl-3" for="item_category_name"
                                       style="display: block;">
                                      <strong>{{ $errors->first('item_category_name') }}</strong>
                                  </div>
                              @endif
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="bmd-form-group{{ $errors->has('item_category_description') ? ' has-danger' : '' }}"
                          >
                              <div class="input-group">
                                  <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">assignment</i>
                  </span>
                                  </div>
                                  <textarea name="item_category_description" placeholder="Menu Item Description" class="form-control" rows="2">{{$menuItemCategory->item_category_description}}</textarea>

                              </div>
                              @if ($errors->has('item_category_description'))
                                  <div id="item_category_description-error" class="error text-danger pl-3" for="item_category_description"
                                       style="display: block;">
                                      <strong>{{ $errors->first('item_category_description') }}</strong>
                                  </div>
                              @endif
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12 col-md-6">
                          <label>Update Category Image</label>
                          <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                              <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                              <div>
                                                <span class="btn btn-raised btn-round btn-default btn-file">
                                                    {{--<span class="fileinput-new">Select image</span>--}}
                                                    {{--<span class="fileinput-exists">Change</span>--}}
                                                    <input type="file" name="content_file" />
                                                </span>
                                  {{--<a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>--}}
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <label>Current Category Image</label>
                          <img src="{{"//dev.quickeats.co.za/".$menuItemCategory->item_category_picture_url}}" height="120" width="120"/>
                      </div>
                  </div>
              </div>
                <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-success">{{ __('Update Category') }}</button>
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