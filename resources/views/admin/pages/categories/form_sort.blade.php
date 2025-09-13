<form action="{{route('admin.categories.sort.save')}}" method="post">
    @csrf
<div class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>@lang('form.label.sort category')</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">

            <div class='parent ex-3'>
                <div class='row'>

                    @foreach($sections as $section)
                        <div class="col-md-6">
                        <h2>@lang('form.label.categories sections') : {{$section["name_$lang"]}}</h2>
                            <div id='section-{{$loop->index}}' class='dragula rm-spill'>

                                @if ($section->subCategories->count() > 0)

                                    @foreach($section->subCategories as $category)
                                        <div class="media d-block d-sm-flex text-sm-left text-center">
                                            <div class="media-body">
                                                <h5 class="">{{$category->name_ar}} - ({{$category->products_count}}) @lang('form.label.product') </h5>
                                                <input type="hidden" name="sections[{{$section->id}}][]" value="{{$category->id}}">
                                            </div>
                                        </div>
                                    @endforeach

                                @else

                                    <div class="alert alert-info p-3">@lang('form.label.not any category in this sections')</div>

                                @endif


                            </div>
                        </div>
                    @endforeach

                </div>
            </div>


        </div>
    </div>
</div>
    <button type="submit" class="btn btn-success d-block w-100">@lang('form.label.save sort')</button>

</form>
