@extends('layouts.app', ['activePage' => 'menu-items-management', 'titlePage' => __('Menu Items Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Current Menu Items') }}</h4>
              </div>
              <div class="card-body">
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
                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{ route('menu-items.create') }}" class="btn btn-sm btn-success">{{ __('Add Menu Item') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table style="width:100%;" id="menu-items-table" class="table">
                    <thead class=" text-primary">
                    <th>
                      {{ __('Item Name') }}
                    </th>
                    <th>
                      {{ __('Description') }}
                    </th>
                    <th>
                      {{ __('Price') }}
                    </th>
                    {{--<th>--}}
                      {{--{{ __('Notes') }}--}}
                    {{--</th>--}}
                    <th>
                      {{ __('Is Vegan') }}
                    </th>
                    <th>
                      {{ __('Is Halaal') }}
                    </th>
                    <th>
                      {{ __('Picture Url') }}
                    </th>
                    <th>
                      {{ __('Updated At') }}
                    </th>

                    <th class="text-right">
                      {{ __('Actions') }}
                    </th>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  @push('custom-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <script>
      $(document).ready(function(){
        $('#menu-items-table').DataTable({
          processing: true,
          serverSide: true,
          paging: true,
          responsive: true,
          scrollX: 640,
          ajax: '{{route('get-menu-items')}}',
          columns: [
            {data: 'item_name', name: 'item_name'},
            {data: 'item_description', name: 'item_description'},
            {data: 'item_price', name: 'item_price'},
            // {data: 'notes', name: 'notes'},
            {data: 'vegan', name: 'vegan'},
            {data: 'halaal', name: 'halaal'},
            {data: 'item_picture_url', name: 'item_picture_url'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
          ]
        });
        $('#go-back').on('click',function () {
          history.back();
        });
        $(".alert").first().hide().fadeIn(200).delay(4000).fadeOut(2000, function () { $(this).remove(); });
      });

      function confirm_delete(obj) {
        Swal.fire({
          title: 'Are you sure want to delete this Menu Item!',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: 'green',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete!'
        }).then((result) => {
          if (result.value) {
            let url = obj.id.split('#')[0];
            $.get(url, function (data, status) {
              let message = data.message;
              var table1 = $('#'+obj.id.split('#')[1]).DataTable();
              if (status == 'success') {
                Swal.fire(
                        'Deleted!',
                        message,
                        'success'
                );
                table1.draw();
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