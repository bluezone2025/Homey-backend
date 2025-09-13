
<div class="col-lg-12 col-12 layout-spacing {{$product->is_clothes==0?'d-none':''}}" id="size1">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>@lang('form.label.color optional')</h4>
                </div>
            </div>
        </div>
<ul class="align-content-right" style="list-style-type: none;margin:auto" >
    @foreach ($sizes as $size)
        <li style="margin-bottom: 15px">

            <div class="form-group ">

                <div class="col-md-12 hhh">
                    <div class="form-check d-flex justify-content-center">

                        <label class="form-check-label" for="name" style="font-weight: bold;">
                            {{ $size->name_ar }}
                        </label>
                        <input class="form-check-input" type="checkbox" value="{{ $size->id }}"
                            style="margin-left: 45px" name="size[]"
                            @foreach ($size_products as $size_product) @if ($size_product == $size->id)  {{ 'checked' }} @endif @endforeach>
                    </div>
                </div>
            </div>


            <div class="d-flex justify-content-center" style="flex-wrap: wrap;margin: 5px">
                @foreach ($colors as $color)
                    @if ($color->id == 1)
                        <div class="form-check li_without" style="margin: 5px">
                            <input class="form-check-input" type="checkbox" name="{{ $size->id }}-color[]"
                                id="color{{ $color->id }}" onclick="validate(this)" value="{{ $color->id }}"
                                @for ($i = 0; $i < count($color_products_array); $i++) @for ($j = 0; $j < count($color_products_array[$i]); $j++)
                        {{-- {{dd($color_product->size_id)}} --}}
                        @if ($color_products_array[$i][$j]->size_id == $size->id && $color_products_array[$i][$j]->color_id == $color->id)  {{ 'checked' }} @endif @endfor
                                @endfor

                            >
                            <label class="form-check-label" for="color{{ $color->id }}">{{ $color->name_ar }}
                            </label>


                            <input type="number"
                                style="border: 1px solid grey ; border-radius: 10px;padding: 5px;width: 70px"
                                placeholder="الكميه" name="{{ $size->id }}-{{ $color->id }}-quantity"
                                <?php for($i =0;$i<count($color_products_array );$i++){
                for($j=0;$j<count($color_products_array[$i]);$j++){
                    if (($color_products_array[$i][$j]->size_id == $size->id ) && ($color_products_array[$i][$j]->color_id == $color->id)){
                    ?> value="{{ trim($color_products_array[$i][$j]->quantity) }}"
                                <?php     }}}
                ?>>
                        </div>
                    @else
                        <div class="form-check" style="margin: 5px">
                            <input class="form-check-input" type="checkbox" name="{{ $size->id }}-color[]"
                                id="color{{ $color->id }}" value="{{ $color->id }}" onclick="validate(this)"
                                @for ($i = 0; $i < count($color_products_array); $i++) @for ($j = 0; $j < count($color_products_array[$i]); $j++)
            {{-- {{dd($color_product->size_id)}} --}}
            @if ($color_products_array[$i][$j]->size_id == $size->id && $color_products_array[$i][$j]->color_id == $color->id)  {{ 'checked' }} @endif @endfor
                                @endfor

                            >
                            <label class="form-check-label" for="color{{ $color->id }}">{{ $color->name_ar }}
                            </label>


                            <input type="number"
                                style="border: 1px solid grey ; border-radius: 10px;padding: 5px;width: 70px"
                                placeholder="الكميه" name="{{ $size->id }}-{{ $color->id }}-quantity"
                                <?php for($i =0;$i<count($color_products_array );$i++){
                for($j=0;$j<count($color_products_array[$i]);$j++){
                    if (($color_products_array[$i][$j]->size_id == $size->id ) && ($color_products_array[$i][$j]->color_id == $color->id)){
                    ?> value="{{ trim($color_products_array[$i][$j]->quantity) }}"
                                <?php     }}}
                ?>>
                        </div>
                    @endif
                @endforeach

            </div>

        </li>
    @endforeach

</ul>
    </div>
    </div>
