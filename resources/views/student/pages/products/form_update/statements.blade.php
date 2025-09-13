<div class=" p-3  col-12  widget widget-statement mb-5 @error('statements') border border-danger @enderror">

    <label for="statements" class="d-block">@lang('form.label.product features') @lang('form.label.optional')</label>


{{--    ///////////////////////// start clone /////////////////////////////--}}
    <div class="cover-statements clone d-none bg-light pt-3 pb-3 mb-4 row">
        <div class="col-md-5">
            <input maxlength="50" required name="statements[0][name_ar]" type="text" class="name_ar form-control" placeholder="@lang('form.label.name ar')" value="">
        </div>

        <div class="col-md-5">
            <input maxlength="50" required name="statements[0][name_en]" type="text" class="name_en form-control" placeholder="@lang('form.label.name en')" value="">
        </div>

        <div class="col-md-2">
            <img class="cursor-pointer remove-statement" width="50"  height="50" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxjaXJjbGUgc3R5bGU9ImZpbGw6I0UyMUIxQjsiIGN4PSIyNTYiIGN5PSIyNTYiIHI9IjI1NiIvPg0KPHBhdGggc3R5bGU9ImZpbGw6I0M0MDYwNjsiIGQ9Ik01MTAuMjgsMjg1LjMwNEwzNjcuOTEyLDE0Mi45MzZMMTUwLjI0OCwzNjguNjA4bDE0MC45MjgsMTQwLjkyOA0KCUM0MDYuMzUyLDQ5My42OTYsNDk3LjA1Niw0MDEuMjg4LDUxMC4yOCwyODUuMzA0eiIvPg0KPGc+DQoJPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0zNTQuMzc2LDM3MS41MzZjLTUuMTIsMC0xMC4yMzItMS45NTItMTQuMTQ0LTUuODU2TDE0Ni40MDgsMTcxLjg0OA0KCQljLTcuODE2LTcuODE2LTcuODE2LTIwLjQ3MiwwLTI4LjI4czIwLjQ3Mi03LjgxNiwyOC4yOCwwTDM2OC41MiwzMzcuNGM3LjgxNiw3LjgxNiw3LjgxNiwyMC40NzIsMCwyOC4yOA0KCQlDMzY0LjYwOCwzNjkuNTg0LDM1OS40OTYsMzcxLjUzNiwzNTQuMzc2LDM3MS41MzZ6Ii8+DQoJPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0xNjAuNTQ0LDM3MS41MzZjLTUuMTIsMC0xMC4yMzItMS45NTItMTQuMTQ0LTUuODU2Yy03LjgxNi03LjgxNi03LjgxNi0yMC40NzIsMC0yOC4yOA0KCQlsMTkzLjgzMi0xOTMuODMyYzcuODE2LTcuODE2LDIwLjQ3Mi03LjgxNiwyOC4yOCwwczcuODE2LDIwLjQ3MiwwLDI4LjI4TDE3NC42ODgsMzY1LjY4DQoJCUMxNzAuNzg0LDM2OS41ODQsMTY1LjY2NCwzNzEuNTM2LDE2MC41NDQsMzcxLjUzNnoiLz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K" />
        </div>
    </div>
{{--    ///////////////////////// end clone /////////////////////////////--}}


    @php($statements = old('statements') ?: $product->statements->all())

    @if(is_array($statements))

        @foreach($statements as $statementLoop)
            <div class="cover-statements bg-light pt-3 pb-3 mb-4 row">
                <div class="col-md-5">
                    <input maxlength="50" required name="statements[{{$loop->index}}][name_ar]" type="text" class="name_ar form-control @error("statements.$loop->index.name_ar") is-invalid @enderror" value="{{$statementLoop['name_ar']}}" placeholder="@lang('form.label.name ar')">
                    @error("statements.$loop->index.name_ar")<span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>

              

                <div class="col-md-5">
                    <input maxlength="50" required name="statements[{{$loop->index}}][name_en]" type="text" class="name_en form-control @error("statements.$loop->index.name_en") is-invalid @enderror" value="{{$statementLoop['name_en'] }}" placeholder="@lang('form.label.name en')">
                    @error("statements.$loop->index.name_en")<span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>@enderror
                </div>



                <div class="col-md-2">
                    <img class="cursor-pointer remove-statement" width="50"  height="50" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDE5LjAuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPg0KPHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgdmlld0JveD0iMCAwIDUxMiA1MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMiA1MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxjaXJjbGUgc3R5bGU9ImZpbGw6I0UyMUIxQjsiIGN4PSIyNTYiIGN5PSIyNTYiIHI9IjI1NiIvPg0KPHBhdGggc3R5bGU9ImZpbGw6I0M0MDYwNjsiIGQ9Ik01MTAuMjgsMjg1LjMwNEwzNjcuOTEyLDE0Mi45MzZMMTUwLjI0OCwzNjguNjA4bDE0MC45MjgsMTQwLjkyOA0KCUM0MDYuMzUyLDQ5My42OTYsNDk3LjA1Niw0MDEuMjg4LDUxMC4yOCwyODUuMzA0eiIvPg0KPGc+DQoJPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0zNTQuMzc2LDM3MS41MzZjLTUuMTIsMC0xMC4yMzItMS45NTItMTQuMTQ0LTUuODU2TDE0Ni40MDgsMTcxLjg0OA0KCQljLTcuODE2LTcuODE2LTcuODE2LTIwLjQ3MiwwLTI4LjI4czIwLjQ3Mi03LjgxNiwyOC4yOCwwTDM2OC41MiwzMzcuNGM3LjgxNiw3LjgxNiw3LjgxNiwyMC40NzIsMCwyOC4yOA0KCQlDMzY0LjYwOCwzNjkuNTg0LDM1OS40OTYsMzcxLjUzNiwzNTQuMzc2LDM3MS41MzZ6Ii8+DQoJPHBhdGggc3R5bGU9ImZpbGw6I0ZGRkZGRjsiIGQ9Ik0xNjAuNTQ0LDM3MS41MzZjLTUuMTIsMC0xMC4yMzItMS45NTItMTQuMTQ0LTUuODU2Yy03LjgxNi03LjgxNi03LjgxNi0yMC40NzIsMC0yOC4yOA0KCQlsMTkzLjgzMi0xOTMuODMyYzcuODE2LTcuODE2LDIwLjQ3Mi03LjgxNiwyOC4yOCwwczcuODE2LDIwLjQ3MiwwLDI4LjI4TDE3NC42ODgsMzY1LjY4DQoJCUMxNzAuNzg0LDM2OS41ODQsMTY1LjY2NCwzNzEuNTM2LDE2MC41NDQsMzcxLjUzNnoiLz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjxnPg0KPC9nPg0KPGc+DQo8L2c+DQo8Zz4NCjwvZz4NCjwvc3ZnPg0K" />
                </div>
            </div>
        @endforeach
    @endif

    <a href="" class="btn btn-primary" id="create_statement">@lang('form.label.add feature')</a>
</div>
