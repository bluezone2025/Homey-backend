@extends('student.master')


@section('breadcrumb')

@endsection

@section('content')


    <div class="widget-content">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th><div class="th-content">id</div></th>
                    <th><div class="th-content">@lang('form.label.name ar')</div></th>
                    <th><div class="th-content">@lang('form.label.name en')</div></th>
                    <th><div class="th-content">@lang('form.label.shipping time')</div></th>
                    <th><div class="th-content">@lang('form.label.shipping price')</div></th>
                    <th><div class="th-content">@lang('form.label.created_at')</div></th>
                    <th><div class="th-content">@lang('form.label.action')</div></th>
                </tr>
                </thead>
                <tbody>
                @foreach($cities_student as $city)

                    <tr>
                        <td><div class="td-content">{{$city->id}}</div></td>
                        <td><div class="td-content">{{$city->area->name_ar}}</div></td>
                        <td><div class="td-content">{{$city->area->name_en}}</div></td>
                        <td><div class="td-content">{{$city->shipping_time}}</div></td>
                        <td><div class="td-content">{{$city->shipping_price}}</div></td>
                        <td><div class="td-content">{{$city->created_at}}</div></td>
                        <td>
                            <a href="{{route('student.areas.edit',$city->area->id)}}"
                                class="btn btn-outline-success dataEdit">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-edit-2">
                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                </svg><i class="fas fa-edit fa-1x">

                                </i>
                            </a>
                        </td>

                    </tr>

                @endforeach

                @foreach($areas_no_edit as $city)

                    <tr>
                        <td><div class="td-content">{{$city->id}}</div></td>
                        <td><div class="td-content">{{$city->name_ar}}</div></td>
                        <td><div class="td-content">{{$city->name_en}}</div></td>
                        <td><div class="td-content">{{$city->shipping_time}}</div></td>
                        <td><div class="td-content">{{$city->shipping_price}}</div></td>
                        <td><div class="td-content">{{$city->created_at}}</div></td>
                        <td>
                            <a href="{{route('student.areas.edit',$city->id)}}"
                               class="btn btn-outline-success dataEdit">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-edit-2">
                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                </svg><i class="fas fa-edit fa-1x">

                                </i>
                            </a>
                        </td>

                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>



@endsection


@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

