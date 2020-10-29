@extends('layouts.app', ['activePage' => 'extras-management', 'titlePage' => __('Extras Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{url('extra-items-store')}}" class="form-horizontal">
                        <div class="card ">
                            @csrf
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ __('Add Extra items to menu item '.$menuItem->name) }}</h4>
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
                                    <h4>Select Extras to add or remove</h4>
                                </div>
                                <hr/>

                                <div class="row" style="margin-top:1em;">
                                    @foreach($extras as $extra)
                                    <div class="col-md-2">
                                       <div class="form-check">
                                            <label class="form-check-label">
                                                <input id="{{'chec-'.$extra->id}}" name="extras" class="form-check-input" type="checkbox" value="{{$extra->id}}">
                                                {{$extra->name}}
                                                <span class="form-check-sign">
                                                  <span class="check"></span>
                                              </span>
                                            </label>
                                        </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="card-footer">
                                <div class="row" >
                                <button id="save-extras" style="margin-left: 400px" type ="submit" class="btn btn-success">{{ __('Save Extras') }}</button>
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
                // $('#save-extras').on('click',function(){
                //     let temp = [];
                //     $( "input:checked" ).each(function (idx,obj) {
                //         temp.push(obj.value);
                //     });
                //   let data = {extras:temp};
                //     $.post('/extra-items-store', data)
                //         .done(function(response){
                //             console.log('response',response);
                //         }).fail(function(err){
                //
                //     });
                // });
            });
        </script>
    @endpush
@endsection