<form action="{{route('admin.sections.sort.save')}}" method="post">
    @csrf
<div class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>@lang('layout.sort sections')</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">

            <div class='parent ex-3'>
                <div class='row'>

                    <div class="col-md-6">
                            <div id='section-0' class='dragula rm-spill'>

                                @if ($sections->count() > 0)

                                    @foreach($sections as $section)
                                        <div class="media d-block d-sm-flex text-sm-left text-center">
                                            <div class="media-body">
                                                <h5 class="">{{$section->name_ar}} - ({{$section->sub_categories_count}}) @lang('form.label.categories') </h5>
                                                <input type="hidden" name="sections[]" value="{{$section->id}}">
                                            </div>
                                        </div>
                                    @endforeach

                                @else

                                    <div class="alert alert-info p-3">@lang('form.label.not any section')</div>

                                @endif


                            </div>
                        </div>

                </div>
            </div>


        </div>
    </div>
</div>
    <button type="submit" class="btn btn-success d-block w-100"> @lang('form.label.save sort')</button>

</form>
