<div class="col-lg-12 col-12 layout-spacing  {{ old('is_clothes') ? '' : 'd-none'}}" id="size1">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>@lang('form.label.color optional')</h4>
                </div>
            </div>
        </div>
        <ul class="align-content-right m-auto" style="list-style-type: none" id="size_ul">
            @php($oldSizes = old('size') ? old('size') : [])

            @foreach ($sizes as $size)
                <li style="margin: 5px 5px 15px 5px">

                    <div class="form-group">

                        <div class="col-md-12 ">
                            <div class="form-check d-flex justify-content-center">

                                <label class="form-check-label" for="name_ar" style="font-weight: bold">
                                    {!! $size['name_' . app()->getlocale()] !!}
                                </label>
                                <input class="form-check-input" type="checkbox" value="{{ $size->id }}"
                                    {{ in_array($size->id, $oldSizes) ? 'checked' : '' }} style="margin-left: 75px"
                                    name="size[]">
                            </div>
                        </div>
                    </div>


                    <div class="d-flex justify-content-center" style="flex-wrap: wrap;margin: 5px">
                     @php($oldColors = old($size->id.'-color') ? old($size->id.'-color') : [])
                        {{-- @dd($oldColors) --}}
                        @foreach ($colors as $color)
                          @php($oldQut = old($size->id.'-'.$color->id.'-quantity') ? old($size->id.'-'.$color->id.'-quantity') : [])
                            {{-- @dd($oldQut) --}}

                                <div class="form-check" style="margin: 10px">
                                    <input class="form-check-input" type="checkbox" name="{{ $size->id }}-color[]"
                                        id="color{{ $color->id }}" value="{{ $color->id }}"
                                        {{ in_array($color->id, $oldColors) ? 'checked' : '' }}
                                        onclick="validate(this)">
                                    <label class="form-check-label" for="color">{!! $color['name_' . app()->getlocale()] !!}
                                    </label>

                                    <input type="number"
                                        style="border: 1px solid rgba(0,0,0,0.1) ; border-radius: 10px;padding: 5px;width: 70px"
                                        placeholder="الكميه" name="{{ $size->id }}-{{ $color->id }}-quantity"
                                        value="{{$oldQut?:''}}">

                                </div>

                        @endforeach

                    </div>

                </li>
            @endforeach

        </ul>
    </div>
</div>
