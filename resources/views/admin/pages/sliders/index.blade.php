@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('layout.sliders')</span></li>
@endsection

@section('content')

    <div class="d-flex justify-content-between mb-3" style="margin: 10px">
        {{--<form action="{{ route('admin.sliders.index') }}" method="GET" class="form-inline">
            <input type="text" name="search" class="form-control mr-sm-2" placeholder="@lang('form.label.search')" value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary">@lang('form.label.search')</button>
        </form>--}}

        @can('role', 'slider.create')
            <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">
                @lang('layout.add slider')
            </a>
        @endcan
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-active table-striped">
            <thead>
            <tr>
                <th>@lang('form.label.id')</th>
                <th>@lang('form.label.img')</th>
                <th>@lang('form.label.link')</th>
                <th>@lang('form.label.link src')</th>
                <th>@lang('form.label.operation')</th>
            </tr>
            </thead>
            <tbody>
            @php $i = 0; @endphp
            @forelse($sliders as $slider)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>
                        <img src="{{ asset('assets/images/sliders/'.$slider->img) }}" alt="Slider Image" style="max-width: 100px; max-height: 60px;">
                    </td>
                    <td>
                        @if($slider->slider_for == 'out_link')
                            <a href="{{ $slider->slider_reference }}" target="_blank">{{ $slider->slider_reference }}</a>
                        @else
                            @php
                                $link = '';
                                $text = '';
                                switch($slider->slider_for) {
                                    case 'product_id':

                                        $text = $slider->product->name_ar ?? 'Product #'.$slider->reference_id;
                                        break;
                                    case 'brand_id':
                                        $text = $slider->brand->name_ar ?? 'Brand #'.$slider->reference_id;
                                        break;
                                    case 'category_id':
                                        $text = $slider->category->name_ar ?? 'Category #'.$slider->reference_id;
                                        break;

                                }
                            @endphp
                            <a href="#">{{ $text }}</a>
                        @endif
                    </td>
                    <td>
                        @if($slider->slider_for == 'out_link' && $slider->slider_reference)
                            @lang('form.label.out_app')
                        @else
                            @lang('form.label.in_app')
                        @endif
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            @can('role', 'slider.update')
                                <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan

                            @can('role', 'slider.destroy')
                                <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('@lang('layout.confirm_delete')')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">@lang('layout.no_records_found')</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $sliders->links() }}
    </div>

@endsection