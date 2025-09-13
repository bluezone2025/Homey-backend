<form method="post" action="{{route('admin.notification.store')}}" id="form_add_option" enctype="multipart/form-data">
    @csrf
    <div class="form-row mb-4">

        <div class="form-group col-md-6">
            <label for="title_ar">{{__('site.title_ar')}}</label>
            <input name="title_ar" type="text" maxlength="50" class="form-control @error('title_ar') is-invalid @enderror" id="title_ar" placeholder=" {{__('site.title_ar')}}" value="{{old('title_ar')}}" required>
            @error('title_ar')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-md-6">
            <label for="title_en">{{__('site.title_en')}}</label>
            <input name="title_en" type="text" maxlength="50" class="form-control @error('title_en') is-invalid @enderror" id="title_en" placeholder=" {{__('site.title_en')}}" value="{{old('title_en')}}" required>
            @error('title_en')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
        <div class="form-group col-md-6"> 
             <div class="form-group col-12  @error('note_ar') border border-danger @enderror">
                <label for="note_ar" class="req">@lang('site.note_ar')</label>
                <div class="widget cover-note_ar">
                    <textarea id="note_ar" name="note_ar"  style="width: 100%;height: 250px;">{{old('note_ar')}}</textarea>
                </div>
                @error('note_ar')<span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </div>
        </div>
        <div class="form-group col-md-6"> 
             <div class="form-group col-12  @error('note_en') border border-danger @enderror">
                <label for="note_en" class="req">@lang('site.note_en')</label>
                <div class="widget cover-note_en">
                    <textarea id="note_en" name="note_en"  style="width: 100%;height: 250px;">{{old('note_en')}}</textarea>
                </div>
                @error('note_en')<span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </div>
        </div>

        <div class="form-group col-md-6">
            <div class="form-group col-12  @error('notify_url') border border-danger @enderror">
                <label for="notify_url" class="req">@lang('site.notify_url')</label>
                <div class="widget cover-note_en">
                    <input id="notify_url" name="notify_url" type="text"
                           placeholder="https://facebook.com"
                           class="form-control @error('title_en') is-invalid @enderror"  value="{{old('notify_url')}}" />
                </div>
                @error('notify_url')<span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>@enderror
            </div>
        </div>

        <div class="form-group col-md-6">
           <div class="custom-file-container" data-upload-id="myFirstImage">
                <label>@lang('form.label.delete images selected')<a href="javascript:void(0)" class="custom-file-container__image-clear" title_ar="Clear Image">x</a></label>
                <label class="custom-file-container__custom-file" >
                    <input name="img" type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" >
                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                </label>
                <div class="custom-file-container__image-preview"></div>
            </div>
            @error('img')<span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>@enderror
        </div>
      
        
    </div>

    <button type="submit" class="btn btn-primary mt-3">{{__('site.createnotifications')}}</button>
</form>
