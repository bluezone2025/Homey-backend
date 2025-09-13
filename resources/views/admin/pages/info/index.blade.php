@extends('admin.master')
@section('content')

    <div class="layout-px-spacing">

        <div class="faq">

            <div class="faq-layouting layout-spacing">

                <div class="fq-tab-section layout-top-spacing">
                    <div class="row">
                        <div class="col-md-12">


                            <div class="row">

                                <div class="col-lg-12">

                                    <div class="accordion" id="simple_faq">

                                        @if ($info->count())
                                            @foreach($info as $data)

                                                <div class="card">
                                                    <div class="card-header" id="fqheadingNumber{{$loop->index}}">
                                                        @can('role' , 'info.update')
                                                        <a href="{{route("admin.$infoType.edit" , $data->id)}}" class="btn btn-outline-primary">تعديل</a>
                                                        @endcan

                                                        @can('role' , 'info.update')
                                                        <a href="{{route("admin.$infoType.destroy" , $data->id)}}" class="btn btn-outline-danger btn-delete">حذف</a>
                                                        @endcan
                                                        <div class="mb-0 mt-2" data-toggle="collapse" role="navigation" data-target="#fqcollapseNumber{{$loop->index}}" aria-expanded="false" aria-controls="fqcollapseNumber{{$loop->index}}">
                                                            <span class="faq-q-title">{{$data->name}}</span>
                                                            <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                                        </div>
                                                    </div>
                                                    <div id="fqcollapseNumber{{$loop->index}}" class="collapse show" aria-labelledby="fqheadingNumber{{$loop->index}}" data-parent="#simple_faq">
                                                        <div class="card-body">
                                                            <p>{!!$data->description_ar!!}</p>
                                                            <hr>
                                                            <p>{!!$data->description_en!!}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach

                                        @else
                                            <h3>@lang('form.label.not any info')</h3>
                                        @endif
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>
        $('.btn-delete').on('click'  , function (e){

            e.preventDefault();

            $(this).parents('.card').hide(500)

            $.ajax({
                method:'delete',
                url:$(this).attr('href')
            })
        });

    </script>
@endsection
