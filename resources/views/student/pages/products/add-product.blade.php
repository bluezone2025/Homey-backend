@extends('student.master')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single,
        .select2-container .select2-selection--multiple {
            height: 40px;
            padding: -0.75rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered,
        .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            line-height: 1.5;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(2.25rem + 2px);
            top: 50%;
            transform: translateY(-50%);
        }

        .select2-container .select2-dropdown {
            max-height: 200px !important;
            overflow-y: auto !important;
        }
    </style>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.My Profile')</span></li>
@endsection

@section('content')

    <div class="col-12 mt-5">

    @include('student.includes.alert_success')

    @include('student.includes.alert_errors')

        <div class="card  shadow bg-info">
            <div class="card-header  text-black border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0 text-white">@lang('form.label.add product')</h3>
                    </div>
                </div>
            </div>
            <div class="card-body bg-light">
                <form class="mt-5" action="{{route('student.store-product')}}" method="post">
                    @csrf
                    <h6 class="heading-small text-primary mb-4">@lang('form.label.add-product')</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group focused">
                                    <label class="form-control-label text-black" for="selected_prodyucts">@lang('form.label.selected products')</label>
                                    <select multiple name="product_ids[]" class="form-control form-control-alternative select2" >
                                        @foreach($products as $product)
                                            <?php
                                            if ($product->brand()->count() > 0){
                                                $string = $product->brand()->first()->name;
                                            }else{
                                                $string = "الرئيسية" ;
                                            }
                                            ?>
                                            <option value="{{ $product->id }}">{{ $product->name . '  ' . $string }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_ids[]')
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block ">@lang('form.label.add-product')</button>
                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div>


@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                allowClear: true
            });
        });
    </script>
@endsection