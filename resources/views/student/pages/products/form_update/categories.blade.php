<div class="form-group col-12  @error('categories') border border-danger @enderror">
    <label for="section_id">@lang('form.label.select_section and categories from products')</label>
    <div class="widget cover-categories">
        <input type="text" id="searchCategories" placeholder="search" class="form-control mb-2">

        @php($oldCats = old('categories' , $product->categories->map->id->all()))

        @foreach($sections as $section)
            <label for="section_id" class="d-block text-black">{{$section["name_$lang"]}}</label>
            <div class="widget mt-3 mb-3">
                @if ($section->subCategories->count() > 0)

                    @foreach($section->subCategories as $category)
                        <div class="custom-control custom-checkbox">
                            <input name="categories[]"  value="{{$category->id}}" type="checkbox" class="custom-control-input cat-checkbox" id="check-{{$category->id}}" {{ in_array($category->id , $oldCats) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="check-{{$category->id}}">{{$category["name_$lang"]}}</label>
                        </div>
                    @endforeach

                @else

                    <span class="label text-info pt-3 pm-3">@lang('form.label.not any category in this sections')</span>

                @endif

            </div>
        @endforeach
    </div>
    @error('categories')<span class="invalid-feedback font-weight-bold  mt-2 d-block" style="font-size: 18px" role="alert"><strong>{{$message}}</strong></span>@enderror
</div>
