@extends('dashboard.layouts.app')
@section('page_title') Orders / View @endsection

@section('style')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> --}}
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" defer></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


    <script>
        error = false

        function validate() {
            if (document.userForm.name.value != '' && document.userForm.email.value != '' && document.userForm.password
                .value != '')
                document.userForm.btnsave.disabled = false
            else
                document.userForm.btnsave.disabled = true
        }
    </script>

    <style>
        .dynamic-color {
            color: red;
        }
    </style>
@endsection
@section('content')

    <div class="container">

        <div class="row">

            <button onclick="window.print();return false;" class="btn btn-primary "> @lang('site.print_page')            </button>
            @if ($order->status == 0)

                <a class="text text-primary" style="margin:5px;float: right;font-weight: bolder">

                    @lang('site.not_paid')

                </a>

            @elseif($order->status == 1)

                <a class="btn btn-success" style="margin:5px;float: right;font-weight: bolder"
                    href="{{ route('orders.received', $order->id) }}" id="edit-user">

                    تم الدفع

                </a>

            @elseif($order->status == 2)
                <a class="text text-success" style="margin:5px;float: right;font-weight: bolder">
                    @lang('site.received')

                </a>

            @endif

        </div>

        <br />
        <div class="row m-auto">
            {{-- <div class="col-lg-12 margin-tb" style="text-align: center"> --}}

            <div class="col-4">
                <h6 style="font-weight: bold">
                    @lang('site.delivered_by')

                </h6>

                <p class="text text-primary">
                    {{ __('site.'.$order->delivered_by.'_delivered') }}
                </p>
            </div>
            @if($order->delivered_by == "address")
                <div class="col-4">
                    <h6 style="font-weight: bold">
                        @lang('site.username')

                    </h6>

                    <p class="text text-primary">
                        {{ $order->name }}
                    </p>
                </div>

                <div class="col-4">
                    <h6 style="font-weight: bold">
                        @lang('site.email')

                    </h6>

                    <p class="text text-primary">
                        {{ $order->email }}
                    </p>
                </div>

                <div class="col-4">
                    <h6 style="font-weight: bold">
                        @lang('site.phone')

                    </h6>

                    <p class="text text-primary">
                        {{ $order->phone }}
                    </p>
                </div>



                <div class="col-4">
                    <h6 style="font-weight: bold">
                        @lang('site.country')

                    </h6>

                    <p class="text text-primary">
                        {{ $order->country->name_en }} - {{ $order->country->name_ar }}
                    </p>
                </div>

                <div class="col-4">
                    <h6 style="font-weight: bold">
                        @lang('site.city')
                    </h6>

                    <p class="text text-primary">
                        {{ $order->city->name_en }} - {{ $order->city->name_ar }}
                    </p>
                </div>

                <div class="col-4">
                    <h6 style="font-weight: bold">
                        @lang('site.user_type')
                    </h6>

                    <p class="text text-primary">
                        {{ $order->user_id == 0 ? 'Visitor' : 'Existed User' }}
                    </p>
                </div>



                {{-- <div class="col-12"> --}}
                {{-- <h6 style="font-weight: bold"> --}}
                {{-- @lang('site.address2') --}}

                {{-- </h6> --}}

                {{-- <p class="text text-primary"> --}}
                {{-- {{$order->address2}} --}}
                {{-- </p> --}}
                {{-- </div> --}}




                <div class="col-4">
                    <h6 style="font-weight: bold">
                        Total Price
                    </h6>

                    <p class="text text-primary">
                        {{ $order->total_price }}
                    </p>
                </div>

                <div class="col-4">
                    <h6 style="font-weight: bold">
                        @lang('site.ttl_qut')

                    </h6>

                    <p class="text text-primary">
                        {{ $order->total_quantity }}
                    </p>
                </div>
                <div class="col-4">
                    <h6 style="font-weight: bold">
                        @lang('site.date_of_order')

                    </h6>

                    <p class="text text-primary">
                        {{ $order->created_at }}
                    </p>
                </div>
                <div class="col-12">
                    <h6 style="font-weight: bold">


                        @lang('site.address1')
                    </h6>

                    <p class="text text-primary">


                        @if($order->address1 != null)

                            {{ $order->address1 }}
                        @else
                            {{__('site.region') }} : {{ $order->region}} --
                            {{__('site.the_plot') }} : {{ $order->the_plot}} --
                            {{ __('site.the_street') }} : {{ $order->the_street}} --
                            {{ __('site.the_avenue') }} : {{$order->the_avenue}} --
                            {{ __('site.building_number') }} : {{ $order->building_number}} --
                            @if( $order->floor != null)
                                {{ __('site.floor') }} : {{$order->floor}} --
                            @endif
                            @if( $order->apartment_number != null)

                                {{__('site.apartment_number') }} : {{ $order->apartment_number}} --
                            @endif


                            @if( $order->data_url != null)
                                {{__('site.data_url') }} : {{ $order->data_url}}
                            @endif
                        @endif

                    </p>
                </div>

                <div class="col-12">
                    <h6 style="font-weight: bold">
                        @lang('site.note'):

                    </h6>

                    <p class="text text-primary">
                        {{$order->note}}
                    </p>
                </div>


                <hr>
            @else

                <div class="col-4">
                    <h6 style="font-weight: bold">
                        @lang('site.username')

                    </h6>

                    <p class="text text-primary">
                        {{ $order->name }}
                    </p>
                </div>



                <div class="col-4">
                    <h6 style="font-weight: bold">
                        @lang('site.phone')

                    </h6>

                    <p class="text text-primary">
                        {{ $order->phone }}
                    </p>
                </div>

                <div class="col-4">
                    <h6 style="font-weight: bold">
                        @lang('site.owner_phone')

                    </h6>

                    <p class="text text-primary">
                        {{ $order->owner_phone }}
                    </p>
                </div>

                <div class="col-4">
                    <h6 style="font-weight: bold">
                        @lang('site.country')

                    </h6>

                    <p class="text text-primary">
                        {{( $order->country)?$order->country->{'name_'.app()->getLocale()}:'-' }}
                </div>

                <div class="col-4">
                    <h6 style="font-weight: bold">
                        @lang('site.city')
                    </h6>

                    <p class="text text-primary">
                        {{( $order->city)?$order->city->{'name_'.app()->getLocale()}:'-' }}
                    </p>
                </div>

                <div class="col-4">
                    <h6 style="font-weight: bold">
                        @lang('site.user_type')
                    </h6>

                    <p class="text text-primary">
                        {{ $order->user_id == 0 ? 'Visitor' : 'Existed User' }}
                    </p>
                </div>



                {{-- <div class="col-12"> --}}
                {{-- <h6 style="font-weight: bold"> --}}
                {{-- @lang('site.address2') --}}

                {{-- </h6> --}}

                {{-- <p class="text text-primary"> --}}
                {{-- {{$order->address2}} --}}
                {{-- </p> --}}
                {{-- </div> --}}




                <div class="col-4">
                    <h6 style="font-weight: bold">
                        Total Price
                    </h6>

                    <p class="text text-primary">
                        {{ $order->total_price }}
                    </p>
                </div>

                <div class="col-4">
                    <h6 style="font-weight: bold">
                        @lang('site.ttl_qut')

                    </h6>

                    <p class="text text-primary">
                        {{ $order->total_quantity }}
                    </p>
                </div>
                <div class="col-4">
                    <h6 style="font-weight: bold">
                        @lang('site.date_of_order')

                    </h6>

                    <p class="text text-primary">
                        {{ $order->created_at }}
                    </p>
                </div>
                <div class="col-12">
                    <h6 style="font-weight: bold">


                        @lang('site.address1')
                    </h6>

                    <p class="text text-primary">


                        @if($order->address1 != null)

                            {{ $order->address1 }}
                        @else
                            {{__('site.region') }} : {{ $order->region}} --
                            {{__('site.the_plot') }} : {{ $order->the_plot}} --
                            {{ __('site.the_street') }} : {{ $order->the_street}} --
                            {{ __('site.the_avenue') }} : {{$order->the_avenue}} --
                            {{ __('site.building_number') }} : {{ $order->building_number}} --
                            @if( $order->floor != null)
                                {{ __('site.floor') }} : {{$order->floor}} --
                            @endif
                            @if( $order->apartment_number != null)

                                {{__('site.apartment_number') }} : {{ $order->apartment_number}} --
                            @endif


                            @if( $order->data_url != null)
                                {{__('site.data_url') }} : {{ $order->data_url}}
                            @endif
                        @endif

                    </p>
                </div>
                @if($order->delivery_time_id ==NULL)
                    <div class="col-12">
                        <h6 style="font-weight: bold">
                            @lang('site.delivery_time'):

                        </h6>

                        <p class="text text-primary">
                            لا يوجد ميعاد توصيل
                        </p>
                    </div>
                @else
                    <div class="col-12">
                        <h6 style="font-weight: bold">
                            @lang('site.delivery_time'):

                        </h6>

                        <p class="text text-primary">
                            <span>@lang('site.from'): </span>
                            <span class="text-danger mx-3"> {{($order->DeliveryTime)?$order->DeliveryTime->begin_time:'' .' '}}</span>

                            <span>@lang('site.to'): </span>
                            <span class="text-danger mx-3"> {{($order->DeliveryTime)?$order->DeliveryTime->end_time:'' .' '}}</span>
                        </p>
                    </div>
                @endif

                 <div class="col-12 mb-4">
                    <h6 style="font-weight: bold">
                        @lang('site.brands'):
                    </h6>

                    @foreach ($brands as $brand)
                        <span class="text text-primary ">
                            {{$brand}}
                        </span>
                        @if(!$loop->last)
                        <span class="text primary-color mx-2" style="font-size: 20px">
                           //
                        </span>
                        @endif
                    @endforeach
                </div>


                <div class="col-12">
                    <h6 style="font-weight: bold">
                        @lang('site.note'):

                    </h6>

                    <p class="text text-primary">
                        {{$order->note}}
                    </p>
                </div>


                <hr>

            @endif

        </div>
    </div>
    <div class="card-header pb-0">
        <h6>
            Order Items
        </h6>
    </div>
    <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
            <table class="table align-items-center justify-content-center mb-0 data-table  text-secondary text-xs ">
                <thead>
                    <tr id="no">
                        <th width="5%">No</th>
                        <th width="5%">Id</th>
                        <th width="10%">@lang('site.product_name')</th>
                        <th width="10%">@lang('site.cat_name')</th>
                        <th width="10%">@lang('site.height')</th>
                        <th width="10%">@lang('site.size')</th>
                        <th width="10%">@lang('site.quantity')</th>
                        <th width="10%">@lang('site.booking_date')</th>
                        <th width="10%">@lang('site.brand')</th>
                        <th width="10%">@lang('site.item_price')</th>
                        <th width="40%">@lang('site.img')</th>
                        {{-- <th width="20%">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    </div>


@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('order.items.view', $order->id) }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'product',
                        name: 'product'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'height',
                        name: 'height'
                    },
                    {
                        data: 'size',
                        name: 'size'
                    },

                    {
                        data: 'quantity',
                        name: 'quantity'
                    },

                    {
                        data: 'booking_date',
                        name: 'booking_date'
                    },
                    {
                        data: 'brand',
                        name: 'brand'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        render: function(data, type, full, meta) {
                            return "<img src=\"" + data +
                                "\"   border=\"0\"  class=\"img-rounded\" align=\"center\"  height=\"50\"/>";
                        }
                    }, // {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            /* When click New customer button */
            // $('#new-user').click(function () {
            //     $('#btn-save').val("create-user");
            //     $('#user').trigger("reset");
            //     $('#userCrudModal').html("Add New User");
            //     $('#crud-modal').modal('show');
            // });

            /* Edit customer */
            //         $('body').on('click', '#edit-user', function () {
            //             var user_id = $(this).data('id');
            //             $.get('users/'+user_id+'/edit', function (data) {
            //                 $('#userCrudModal').html("Edit User");
            //                 $('#btn-update').val("Update");
            //                 $('#btn-save').prop('disabled',false);
            //                 $('#crud-modal').modal('show');
            //                 $('#user_id').val(data.id);
            //                 $('#name').val(data.name);
            //                 $('#email').val(data.email);
            //
            //             })
            //         });
            //         /* Show customer */
            //         $('body').on('click', '#show-user', function () {
            //             var user_id = $(this).data('id');
            //             $.get('users/'+user_id, function (data) {
            //
            //                 $('#sname').html(data.name);
            //                 $('#semail').html(data.email);
            //
            //             })
            //             $('#userCrudModal-show').html("User Details");
            //             $('#crud-modal-show').modal('show');
            //         });
            //
            //         /* Delete customer */
            //         $('body').on('click', '#delete-user', function () {
            //             var user_id = $(this).data("id");
            //             var token = $("meta[name='csrf-token']").attr("content");
            //             confirm("Are You sure want to delete !");
            //
            //             $.ajax({
            //                 type: "DELETE",
            //                 url: "http://localhost/laravelpro/public/users/"+user_id,
            //                 data: {
            //                     "id": user_id,
            //                     "_token": token,
            //                 },
            //                 success: function (data) {
            //
            // //$('#msg').html('Customer entry deleted successfully');
            // //$("#customer_id_" + user_id).remove();
            //                     table.ajax.reload();
            //                 },
            //                 error: function (data) {
            //                     console.log('Error:', data);
            //                 }
            //             });
            //         });

        });
    </script>
    <script>
        // Select all rows in the table
        // Function to apply color to the 8th column in each row
        function applyColorToEighthColumn() {
            document.querySelectorAll('tr').forEach(function(tr) {
                // Skip rows with the id "no"
                if (!tr.id) {
                    // Select the 8th column in each row (index 7)
                    const td = tr.children[7];
                    if (td) {
                        // Add the class to apply the color
                        td.classList.add('dynamic-color');
                    }
                }
            });
        }

        // Simulate an AJAX call and call the function after AJAX completes
        document.addEventListener('DOMContentLoaded', function() {
            // Simulating an AJAX call with setTimeout
            setTimeout(function() {
                // Assume AJAX content has been loaded here
                applyColorToEighthColumn();
            }, 1000); // Adjust the timeout as needed for your actual AJAX call
        });

    </script>

@endsection
