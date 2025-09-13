<div id="fuSingleFile" class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow @error('img') border border-danger @enderror">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4 class="req">@lang('form.label.min img product') <span class="size-img"> (250 * 210) </span></h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <div class="custom-file-container" data-upload-id="myFirstImage">
                <label>@lang('form.label.delete images selected')<a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                <label class="custom-file-container__custom-file" >
                    <input name="img" type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" required>
                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                </label>
                <div class="custom-file-container__image-preview"></div>
            </div>
            <div class="form-group d-none">
                <label for="alt">@lang('form.label.Alt Text seo')</label>
                <input name="alt" type="text" class="form-control @error('alt') is-invalid @enderror" id="alt" placeholder="الاسم المعبر عن الصورة في حالة تركة فارغا سوف يتم تعين اسم المنتج  كا قيمة مدخلة لهاذا الحقل" value="{{old('alt')}}">
                @error('alt')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </div>
        </div>
    </div>
    @error('img')<span class="invalid-feedback font-weight-bold mt-2 d-block" role="alert"><strong>{{$message}}</strong></span>@enderror
</div>




<div id="fuSingleFile" class="col-lg-12 layout-spacing">

    <div class="statbox widget box box-shadow @error('images') border border-danger @enderror">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4 class="req">@lang('form.label.gallery img product') <span class="size-img"> (250 * 150) </span></h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <div class="custom-file-container" data-upload-id="gallery">
                <label>@lang('form.label.delete images selected')<a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                <label class="custom-file-container__custom-file" >
                    <input name="images[]" type="file" multiple class="custom-file-container__custom-file__custom-file-input" accept="image/*">
                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                </label>
                <div class="custom-file-container__image-preview"></div>
            </div>
        </div>
    </div>
    @error('images')<span class="invalid-feedback font-weight-bold mt-2 d-block" role="alert"><strong>{{$message}}</strong></span>@enderror
</div>
