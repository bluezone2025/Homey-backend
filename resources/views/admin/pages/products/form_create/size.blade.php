<div class=" p-3  col-12  widget widget-size mb-5 @error('size') border border-danger @enderror">

    <label for="size" class="d-block">@lang('layout.sizes') @lang('form.label.optional')</label>


{{--    ///////////////////////// start clone /////////////////////////////--}}
    <div class="cover-size clone d-none bg-light pt-3 pb-3 mb-4 row size-0">
        <input type="hidden" name="size[0][id]" value="6">
        <div class="col-md-5">
            {{-- SELECT OPTION --}}

            <select data-show="id" class="form-control w-sm-100 w-75 d-inline-block size_id" name="size[0][option][0][id]">
                @foreach ($sizes as $size )
                <option value="{{$size->id}}">{{$size->name_ar}}</option>
                @endforeach
            </select>
            {{-- SELECT OPTION --}}
        </div>
       {{-- <div class="col-md-5">
            <input maxlength="50" required name="size[0][value_ar]" type="text" class="value_ar form-control" placeholder="القيمة باللغة العربية" value="">
        </div>--}}
        <div class="col-md-5">
            <input maxlength="50" type="number" required name="size[0][option][0][quantity]" class="name_en form-control"  placeholder="@lang('form.label.quantity')"  value="">
        </div>
       {{-- <div class="col-md-5">
            <input maxlength="50" required name="size[0][value_en]" type="text" class="value_en form-control" placeholder="القيمة باللغة الانجليزية" value="">
        </div>--}}
        <div class="col-md-2">
            <img class="cursor-pointer remove-size" width="50"  height="50" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxjaXJjbGUgc3R5bGU9ImZpbGw6I0UyMUIxQjsiIGN4PSIyNTYiIGN5PSIyNTYiIHI9IjI1NiIvPg0KPHBhdGggc3R5bGU9ImZpbGw6I0M0MDYwNjsiIGQ9Ik01MTAuMjgsMjg1LjMwNEwzNjcuOTEyLDE0Mi45MzZMMTUwLjI0OCwzNjguNjA4bDE0MC45MjgsMTQwLjkyOA0KCUM0MDYuMzUyLDQ5My42OTYsNDk3LjA1Niw0MDEuMjg4LDUxMC4yOCwyODUuMzA0eiIvPg0KPGc+DQoJPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0zNTQuMzc2LDM3MS41MzZjLTUuMTIsMC0xMC4yMzItMS45NTItMTQuMTQ0LTUuODU2TDE0Ni40MDgsMTcxLjg0OA0KCQljLTcuODE2LTcuODE2LTcuODE2LTIwLjQ3MiwwLTI4LjI4czIwLjQ3Mi03LjgxNiwyOC4yOCwwTDM2OC41MiwzMzcuNGM3LjgxNiw3LjgxNiw3LjgxNiwyMC40NzIsMCwyOC4yOA0KCQlDMzY0LjYwOCwzNjkuNTg0LDM1OS40OTYsMzcxLjUzNiwzNTQuMzc2LDM3MS41MzZ6Ii8+DQoJPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0xNjAuNTQ0LDM3MS41MzZjLTUuMTIsMC0xMC4yMzItMS45NTItMTQuMTQ0LTUuODU2Yy03LjgxNi03LjgxNi03LjgxNi0yMC40NzIsMC0yOC4yOA0KCQlsMTkzLjgzMi0xOTMuODMyYzcuODE2LTcuODE2LDIwLjQ3Mi03LjgxNiwyOC4yOCwwczcuODE2LDIwLjQ3MiwwLDI4LjI4TDE3NC42ODgsMzY1LjY4DQoJCUMxNzAuNzg0LDM2OS41ODQsMTY1LjY2NCwzNzEuNTM2LDE2MC41NDQsMzcxLjUzNnoiLz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K" />
        </div>
    </div>
{{--    ///////////////////////// end clone /////////////////////////////--}}


    {{-- @if(is_array(old('size')))

        @foreach(old('size') as $sizeLoop)
            <input type="hidden" name="size[{{$loop->index}}][id]" value="7">
            <input type="hidden" name="size[{{$loop->index}}][option][0][id]">
            <div class="cover-size bg-light pt-3 pb-3 mb-4 row">
                <div class="col-md-5">
                    <select data-show="id" class="form-control w-sm-100 w-75 d-inline-block size_id" name="size[{{$loop->index}}][option][0][id]">
                        <option value="2">1سبل</option>
                        <option value="1">2سبل</option>
                        <option value="6">3سبل</option>
                        <option value="5">4سبل</option>
                        <option value="4">5سبل</option>
                    </select>
                    <input maxlength="50" required name="size[{{$loop->index}}][name_ar]" type="text" class="name_ar form-control @error("size.$loop->index.name_ar") is-invalid @enderror" value="{{array_key_exists('name_ar' , $sizeLoop)?$sizeLoop['name_ar'] :''}}" placeholder=" @lang('form.label.name ar')">
                    @error("size.$loop->index.name_ar")<span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>


                <div class="col-md-5">
                    <input maxlength="50" required name="size[{{$loop->index}}][name_en]" type="text" class="name_en form-control @error("size.$loop->index.name_en") is-invalid @enderror" value="{{array_key_exists('name_en' , $sizeLoop)?$sizeLoop['name_en'] :''}}" placeholder=" @lang('form.label.name en')">
                    @error("size.$loop->index.name_en")<span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>



                <div class="col-md-2">
                    <img class="cursor-pointer remove-size" width="50"  height="50" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxjaXJjbGUgc3R5bGU9ImZpbGw6I0UyMUIxQjsiIGN4PSIyNTYiIGN5PSIyNTYiIHI9IjI1NiIvPg0KPHBhdGggc3R5bGU9ImZpbGw6I0M0MDYwNjsiIGQ9Ik01MTAuMjgsMjg1LjMwNEwzNjcuOTEyLDE0Mi45MzZMMTUwLjI0OCwzNjguNjA4bDE0MC45MjgsMTQwLjkyOA0KCUM0MDYuMzUyLDQ5My42OTYsNDk3LjA1Niw0MDEuMjg4LDUxMC4yOCwyODUuMzA0eiIvPg0KPGc+DQoJPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0zNTQuMzc2LDM3MS41MzZjLTUuMTIsMC0xMC4yMzItMS45NTItMTQuMTQ0LTUuODU2TDE0Ni40MDgsMTcxLjg0OA0KCQljLTcuODE2LTcuODE2LTcuODE2LTIwLjQ3MiwwLTI4LjI4czIwLjQ3Mi03LjgxNiwyOC4yOCwwTDM2OC41MiwzMzcuNGM3LjgxNiw3LjgxNiw3LjgxNiwyMC40NzIsMCwyOC4yOA0KCQlDMzY0LjYwOCwzNjkuNTg0LDM1OS40OTYsMzcxLjUzNiwzNTQuMzc2LDM3MS41MzZ6Ii8+DQoJPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0xNjAuNTQ0LDM3MS41MzZjLTUuMTIsMC0xMC4yMzItMS45NTItMTQuMTQ0LTUuODU2Yy03LjgxNi03LjgxNi03LjgxNi0yMC40NzIsMC0yOC4yOA0KCQlsMTkzLjgzMi0xOTMuODMyYzcuODE2LTcuODE2LDIwLjQ3Mi03LjgxNiwyOC4yOCwwczcuODE2LDIwLjQ3MiwwLDI4LjI4TDE3NC42ODgsMzY1LjY4DQoJCUMxNzAuNzg0LDM2OS41ODQsMTY1LjY2NCwzNzEuNTM2LDE2MC41NDQsMzcxLjUzNnoiLz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K" />
                </div>
            </div>
        @endforeach
    @endif --}}

    <a href="" class="btn btn-primary" id="create_size"> @lang('layout.add size')</a>
</div>
