    
    <div class="  col-md-5 d-md-block" style="margin: 20px auto !important">
            <div class="table_block table-responsive dir-rtl">
                <table class="table table-bordered" style="padding: 10px;">
                    <thead class="btn-dark" style="background-color: #212529;padding: 0 5px !important;color: #fff;border: 1px solid #000;">
                        <tr>
                            <th colspan="2" class="text-center" style=" background-color: #fff;padding: 5px;color: #212529;">@lang('site.order_new_mail')</th>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-center" style=" background-color: #212529;padding: 5px;color: #fff;">@lang('site.order_summary')</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <tr>
                            <th scope="row" class="btn-dark" style="background-color: #212529;padding: 0 5px !important;color: #fff;border: 1px solid #000;">@lang('site.invoice_id')</th>
                            <td style="text-align: center;border: 1px solid #000;padding: 2px;">{{ $invoice->invoice_id ?: $invoice->id }}</td>

                        </tr>
                        <tr>
                            <th scope="row" class="btn-dark" style="background-color: #212529;padding: 0 5px !important;color: #fff;border: 1px solid #000;">@lang('site.total_price')</th>
                            <td style="text-align: center;border: 1px solid #000;padding: 2px;">{{ $invoice->total_price }} @lang('site.kwd')</td>

                        </tr>
                        <th scope="row" class="btn-dark" style="background-color: #212529;padding: 0 5px !important;color: #fff;border: 1px solid #000;">@lang('site.email')</th>
                        <td style="text-align: center;border: 1px solid #000;padding: 2px;">{{ $invoice->email }}</td>

                        </tr>
                        <tr>
                            <th scope="row" class="btn-dark" style="background-color: #212529;padding: 0 5px !important;color: #fff;border: 1px solid #000;">@lang('site.phone')</th>
                            <td style="text-align: center;border: 1px solid #000;padding: 2px;">{{ $invoice->phone . ' ' }}</td>

                        </tr>
                        <tr>
                            <th scope="row" class="btn-dark" style="background-color: #212529;padding: 0 5px !important;color: #fff;border: 1px solid #000;">@lang('site.images_orders')</th>
                            <td style="text-align: center;border: 1px solid #000;padding: 2px;">
                                @foreach ($invoice->products as $product)
                                    <img src="{{ asset('storage/'.$product->img) }}"
                                        class="img-sm border" width="100">
                                @endforeach
                            </td>

                        </tr>

                        <tr>
                            <th scope="row" class="btn-dark" style="background-color: #212529;padding: 0 5px !important;color: #fff;border: 1px solid #000;">@lang('site.address1')</th>
                            <td style="text-align: center;border: 1px solid #000;padding: 2px;">{{ $invoice->address1 }}</td>

                        </tr>

                        <tr>
                            <th scope="row" class="btn-dark" style="background-color: #212529;padding: 0 5px !important;color: #fff;border: 1px solid #000;">@lang('site.name')</th>
                            <td style="text-align: center;border: 1px solid #000;padding: 2px;">{{ $invoice->name }}</td>

                        </tr>
                        <tr>
                            <th scope="row" class="btn-dark" style="background-color: #212529;padding: 0 5px !important;color: #fff;border: 1px solid #000;">@lang('site.total_quantity')</th>
                            <td style="text-align: center;border: 1px solid #000;padding: 2px;">{{ $invoice->order_items->sum('quantity') }}</td>

                        </tr>
                        <tr>
                            <th scope="row" class="btn-dark" style="background-color: #212529;padding: 0 5px !important;color: #fff;border: 1px solid #000;">@lang('site.order_status')</th>
                            <td style="text-align: center;border: 1px solid #000;padding: 2px;">{{ __("site.status_$invoice->status") }}</td>

                        </tr>

                        <tr>
                            <th scope="row" class="btn-dark" style="background-color: #212529;padding: 0 5px !important;color: #fff;border: 1px solid #000;">@lang('site.date_of_order')</th>
                            <td style="text-align: center;border: 1px solid #000;padding: 2px;">{{ $invoice->created_at }}</td>

                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
<span style="color:darkblue"> {{__('api.if you have any questions you can contact with us in our email')}}, (rayan@rayan-storee.com) </span>
<strong>
    {{__('api.thank you')}} .
</strong>
