@extends('admin.master')

@section('breadcrumb')
        <li class="breadcrumb-item active" aria-current="page"><span> {{ __('site.notifications')  }}</span></li>
 
@endsection

@section('content')


    <div class="d-flex justify-content-between mb-3" style="margin: 10px">
        <a href="{{ route('admin.notification.create') }}" class="btn btn-primary">@lang('form.label.add new')</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-active table-striped">
            <thead>
            <tr>
                <th>@lang('form.label.id')</th>
                <th>@lang('form.label.image')</th>
                <th>@lang('form.label.title_ar')</th>
                <th>@lang('form.label.title_en')</th>
                <th>@lang('form.label.details_ar')</th>
                <th>@lang('form.label.details_en')</th>
            </tr>
            </thead>
            <tbody>
            @forelse($uniqueNotifications as $key => $notification)
                <?php $data = json_decode($notification->data,true); ?>
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>

                        @if($data['image'] != null)
                            <img src="{{$data['image']}}" width="150px" style="width: 150px">
                        @else
                            @lang('form.label.no_image')
                        @endif
                       </td>
                    <td>{{ $data['title_ar']?? '-' }}</td>
                    <td>{{ $data['title_en'] ?? '-' }}</td>
                    <td>{{ $data['details_ar'] ?? '-' }}</td>
                    <td>{{ $data['details_en'] ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">@lang('layout.no_records_found')</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>


    {{--@include('admin.includes.modalBtnAction')

    {!! myDataTable_button([
        __('site.createnotification') => route('admin.notification.create'),
      ]) !!}



    {!! myDataTable_table([
        "id"           => 'id',
        "title"        => __('site.title'),
        "created_at"   =>__('site.created_at'),
    ]) !!}
    --}}

@endsection

@section('css')
    <link rel="stylesheet" href="{{asset("assets/myDataTable/data.css")}}">
@endsection

@section('js')
    <script src="{{asset("assets/myDataTable/data.js")}}"></script>
    <script>



        myDataTableColumns({
            name   :  ['id', 'title', 'created_at'],
            class  : {'updated_at': 'notEdit' , 'created_at': 'notEdit', 'image':'notEdit', 'title':'notEdit'},

            btn    :  {

                'delete'       : '{{route('admin.notification.destroy' , '')}}'+'/{id}',
                'print'        : '#',

            }
        })
    </script>
@endsection
