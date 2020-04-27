
@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('System Users')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ __('All System Users') }}</h4>
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
                                <div class="col-6 text-left">
                                    <a id="go-back" href="#" class="btn btn-sm btn-primary">{{ __('Back') }}</a>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('user.create') }}" class="btn btn-sm btn-success"><i
                                                class="fa fa-plus-circle fa-fw"></i>{{ __('Add User') }}</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="table-responsive col-sm-12" >
                                    <table id="users-table" class="table table-striped" style="width:100%!important;">
                                        <thead class="text-primary">
                                        <th>
                                            {{ __('Name') }}
                                        </th>
                                        <th>
                                            {{ __('Surname') }}
                                        </th>
                                        <th>
                                            {{ __('Email') }}
                                        </th>
                                        <th>
                                            {{ __('Contact Number') }}
                                        </th>
                                        <th>
                                            {{ __('System Role') }}
                                        </th>
                                        <th>
                                            {{ __('Account Status') }}
                                        </th>
                                        <th>
                                            {{ __('Created At') }}
                                        </th>

                                        <th class="text-right">
                                            {{ __('Actions') }}
                                        </th>
                                        </thead>

                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        #users-table_filter{
            margin-left: 60%;
        }
    </style>
    @push('custom-scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
        <script>
            $(document).ready(function(){

                $('#users-table').DataTable({
                    processing: true,
                    serverSide: true,
                    paging: true,
                    responsive: true,
                    scrollX: 640,
                    ajax: '{{route('get-system-users')}}',
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'surname', name: 'surname'},
                        {data: 'email', name: 'email'},
                        {data: 'contact_number', name: 'contact_number'},
                        {data: 'role', name: 'role'},
                        {data: 'account_status', name: 'account_status'},
                        {data: 'created_at',name:'created_at'},
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
                    title: 'Are you sure want to delete this user!',
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