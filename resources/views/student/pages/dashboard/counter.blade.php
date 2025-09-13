<div class="m-5">
    <div class="row">

        <div class="four col-md-4">
            <a>
                <div class="counter-box colored "> <i class="fa-solid fa-list-check"></i> <span class="counter">{{$orders_count}}</span>
                    <p>@lang('form.label.count orders')</p>
                </div>
            </a>
        </div>


        {{-- <div class="four col-md-3">
            <a>
                <div class="counter-box colored "> <i class="fa fa-thumbs-o-up"></i> <span class="counter">{{$student->limit_products}}</span>
                    <p>@lang('form.label.products available')</p>
                </div>
            </a>
        </div> --}}
        <div class="four col-md-4">
            <a>
                <div class="counter-box colored "> <i class="fa-solid fa-list-check"></i> <span class="counter">{{$orders_count_today}}</span>
                    <p>@lang('form.label.count orders today')</p>
                </div>
            </a>
        </div>

        <div class="four col-md-4">
            <a>
                <div class="counter-box colored "> <i class="fa-solid fa-list-check"></i> <span class="counter">{{$orders_total_today}}</span>
                    <p>@lang('form.label.total orders today')</p>
                </div>
            </a>
        </div>

        <br>

        <div class="four col-md-4" style="margin-top: 10px">
            <a>
                <div class="counter-box colored "> <i class="fa fa-thumbs-o-up"></i> <span class="counter">{{$orders_total_in_month}}</span>
                    <p>@lang('form.label.month orders total')</p>
                </div>
            </a>
        </div>

        <div class="four col-md-4" style="margin-top: 10px">
            <a>
                <div class="counter-box colored "> <i class="fa fa-thumbs-o-up"></i> <span class="counter">{{$orders_count_in_month}}</span>
                    <p>@lang('form.label.month orders count')</p>
                </div>
            </a>
        </div>

        <div class="four col-md-4" style="margin-top: 10px">
            <a>
                <div class="counter-box colored "> <i class="fa fa-thumbs-o-up"></i> <span class="counter">{{$added_products_count}}</span>
                    <p>@lang('form.label.products now')</p>
                </div>
            </a>
        </div>

        <div class="four col-md-4" style="margin-top: 10px">
            <a>
                <div class="counter-box colored "> <i class="fa fa-thumbs-o-up"></i> <span class="counter">{{$student_percentage}}</span>
                    <p>@lang('form.label.student percentage')</p>
                </div>
            </a>
        </div>

        <div class="four col-md-4" style="margin-top: 10px">
            <a>
                <div class="counter-box colored "> <i class="fa fa-thumbs-o-up"></i> <span class="counter">{{$student_total_percentage}}</span>
                    <p>@lang('form.label.student_total_percentage')</p>
                </div>
            </a>
        </div>



        <div class="four col-md-4">
            <a href="#">
                <div class="counter-box colored "> <i class="fa fa-product-hunt" aria-hidden="true"></i> <span class="counter">{{ \App\Models\ProductOrderDelete::distinct('product_id')->where('student_id',auth('student')->id())->count() }}</span>
                    <p>@lang('form.label.count deleted products')</p>
                </div>
            </a>
        </div>

        <div class="four col-md-4">
            <a href="#">
                <div class="counter-box colored "> <i class="fa fa-product-hunt" aria-hidden="true"></i> <span class="counter">{{ \App\Models\ProductOrderDelete::where('student_id',auth('student')->id())->sum('end_price') }}</span>
                    <p>@lang('form.label.total deleted products')</p>
                </div>
            </a>
        </div>



        @if($orders_count_by_month !== null)
        <div class="four col-md-4" style="margin-top: 10px">
            <a>
                <div class="counter-box colored "> <i class="fa fa-thumbs-o-up"></i> <span class="counter">{{$orders_count_by_month}}</span>
                    <p>@lang('form.label.student_total_for_month')</p>
                </div>
            </a>
        </div>
        @endif

    </div>

    <form action="">
        <div class="row flex justify-content-center" style="margin: 20px 0px">
            <div class="col-4">

                <label for="selected_month">{{__('form.label.select_month')}}</label>
                <select class="form-control" data-live-search="true" name="selected_month">
                    <?php
                    $months = [
                        '01' => 'January',
                        '02' => 'February',
                        '03' => 'March',
                        '04' => 'April',
                        '05' => 'May',
                        '06' => 'June',
                        '07' => 'July',
                        '08' => 'August',
                        '09' => 'September',
                        '10' => 'October',
                        '11' => 'November',
                        '12' => 'December'
                    ];

                    foreach ($months as $key => $month) {
                        $selected = ($_GET['selected_month'] ?? '') === $key ? 'selected' : ''; // Check if the option should be selected
                        printf('<option value="%s" %s>%s</option>', $key, $selected, $month);
                    }
                    ?>
                </select>




            </div>
            <div class="col-4">
                <label for="selected_year">{{ __('form.label.select_year') }}</label>
                <select class="form-control" name="selected_year">
                    <?php
                    $currentYear = date("Y");
                    for ($year = 2000; $year <= 2030; $year++) {
                        $selected = ($_GET['selected_year'] ?? $currentYear) == $year ? 'selected' : '';
                        printf('<option value="%s" %s>%s</option>', $year, $selected, $year);
                    }
                    ?>
                </select>

            </div>
            <div class="col-4">
                <button style="margin: 30px 0px" type="submit" class="btn btn-success form-control"> ارسال</button>
            </div>

        </div>
    </form>
</div>
