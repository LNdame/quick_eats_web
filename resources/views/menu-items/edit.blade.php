@extends('layouts.app', ['activePage' => 'menu-management', 'titlePage' => __('Menu Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ url('menu-items-update/'.$menuItem->id) }}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Update Menu Item') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                    <a href="{{ route('menu-items.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
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
                    <div class="bmd-form-group{{ $errors->has('item_name') ? ' has-danger' : '' }}">
                      <div class="input-group">
                        <div class="input-group-prepend">
                                      <span class="input-group-text">
                                          <i class="material-icons">folder_special</i>
                                      </span>
                        </div>
                        <input type="text" name="item_name" class="form-control"
                               placeholder="{{ __('Item Name...') }}" value="{{ $menuItem->item_name }}" required>
                      </div>
                      @if ($errors->has('item_name'))
                        <div id="item_name-error" class="error text-danger pl-3" for="item_name"
                             style="display: block;">
                          <strong>{{ $errors->first('item_name') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('item_description') ? ' has-danger' : '' }}"
                    >
                      <div class="input-group">
                        <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">assignment</i>
                  </span>
                        </div>
                        <textarea name="item_description" placeholder="Item Description" class="form-control" rows="2">{{$menuItem->item_description}}</textarea>

                      </div>
                      @if ($errors->has('item_description'))
                        <div id="item_description-error" class="error text-danger pl-3" for="item_description"
                             style="display: block;">
                          <strong>{{ $errors->first('item_description') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('item_price') ? ' has-danger' : '' }} mt-3">
                      <div class="input-group">
                        <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="material-icons">attach_money</i>
                                      </span>
                        </div>
                        <input type="number" step="0.01" name="item_price" class="form-control"
                               placeholder="{{ __('Item Price...') }}" value="{{ $menuItem->item_price }}" required>
                      </div>
                      @if ($errors->has('item_price'))
                        <div id="item_price-error" class="error text-danger pl-3" for="item_price"
                             style="display: block;">
                          <strong>{{ $errors->first('item_price') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('notes') ? ' has-danger' : '' }}"
                    >
                      <div class="input-group">
                        <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="material-icons">assignment</i>
                  </span>
                        </div>
                        <textarea id="notes" name="notes" placeholder="Item Notes" class="form-control" rows="2">{{$menuItem->notes}}</textarea>

                      </div>
                      @if ($errors->has('notes'))
                        <div id="notes-error" class="error text-danger pl-3" for="notes"
                             style="display: block;">
                          <strong>{{ $errors->first('notes') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row" style="margin-top: 2em;">
                  <div class="col-md-6">
                    <label style="margin-left: 2em;">Is Vegan</label><br/>
                    <div style="margin-left: 2em;" class="form-check form-check-radio form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="is_vegan" {{$menuItem->is_vegan==1?'checked':''}} id="inlineRadio1" value="0"> No
                        <span class="circle">
        <span class="check"></span>
    </span>
                      </label>
                    </div>
                    <div class="form-check form-check-radio form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" {{$menuItem->is_vegan==1?'checked':''}} name="is_vegan" id="inlineRadio2" value="1"> Yes
                        <span class="circle">
        <span class="check"></span>
    </span>
                      </label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label style="margin-left: 2em;">Is Halaal</label><br/>
                    <div style="margin-left: 2em;" class="form-check form-check-radio form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" {{$menuItem->is_halaal==0?'checked':''}} name="is_halaal" id="inlineRadio11" value="0"> No
                        <span class="circle">
        <span class="check"></span>
    </span>
                      </label>
                    </div>
                    <div class="form-check form-check-radio form-check-inline">
                      <label class="form-check-label">
                        <input class="form-check-input" {{$menuItem->is_halaal==1?'checked':''}} type="radio" name="is_halaal" id="inlineRadio12" value="1"> Yes
                        <span class="circle">
        <span class="check"></span>
    </span>
                      </label>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="bmd-form-group{{ $errors->has('menu_id') ? ' has-danger' : '' }} mt-3">
                      <div class="input-group">
                        <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="material-icons">format_align_left</i>
                                      </span>
                        </div>
                        <select class="form-control js-example-basic-single" id="menu_id" name="menu_id"
                                required>
                          <option value="99999">Select Menu</option>
                          @foreach($menus as $menu)

                            <option value="{{$menu->id}}" {{$menuItem->menu_id==$menu->id?'selected':''}}>{{$menu->menu_name}}</option>
                          @endforeach
                        </select>
                      </div>
                      @if ($errors->has('menu_id'))
                        <div id="menu_id-error" class="error text-danger pl-3" for="menu_id"
                             style="display: block;">
                          <strong>{{ $errors->first('menu_id') }}</strong>
                        </div>
                      @endif
                    </div>
                  </div>
                    <div class="col-md-6">
                        <div class="bmd-form-group{{ $errors->has('category_id') ? ' has-danger' : '' }} mt-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="material-icons">format_align_left</i>
                                      </span>
                                </div>
                                <select class="form-control js-example-basic-single" id="category_id" name="category_id"
                                        required>
                                    <option value="99999">Select Category</option>
                                    @foreach($categories as $category)

                                        <option value="{{$category->id}}" {{$menuItem->category_id==$category->id?'selected':''}}>{{$category->item_category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('category_id'))
                                <div id="menu_id-error" class="error text-danger pl-3" for="category_id"
                                     style="display: block;">
                                    <strong>{{ $errors->first('category_id') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                  <div class="row">
                    <div class="col-sm-12 col-md-6" style="margin-top:2em;">
                        <label>Upload Menu Item Image</label>
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
                          <label style="margin-top:2em;">Current Picture</label><br/>
                          <img src="{{"//dev.quickeats.co.za/".$menuItem->item_picture_url}}" height="120" width="120" style="margin-top:1em;"/>
                      </div>
                </div>

              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-success">{{ __('Update Menu Item') }}</button>
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