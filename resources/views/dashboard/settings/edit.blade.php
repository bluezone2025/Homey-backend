@extends('dashboard.layouts.app')
@section('page_title')    تعديل الاعدادات  :

{{$setting->site_name_ar}}  -    {{$setting->site_name_en}}  @endsection

@section('content')
    <form class="card col-md-6 col-12" style="margin: auto" action="{{route('settings.update.setting' , 1)}}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="card-body">

            <div class="form-group">
                <label for="site_name_ar">

                    @lang('site.site_ar')

                </label>
                <input value="{{ $setting->site_name_ar}}"  type="text" name="site_name_ar"
                       class="form-control @error('site_name_ar') is-invalid @enderror" id="site_name_ar">
            </div>


            <div class="form-group">
                <label for="site_name_en">

                    @lang('site.site_en')

                </label>
                <input value="{{ $setting->site_name_en}}"  type="text" name="site_name_en"
                       class="form-control @error('site_name_en') is-invalid @enderror" id="site_name_en">
            </div>
            <div class="form-group">
                <label for="phone">

                    @lang('site.is_free_shop')


                </label>
                <input type="checkbox" {{$setting->is_free_shop==1?'checked':''}} name="is_free_shop"
                       class="@error('is_free_shop') is-invalid @enderror" id="is_free_shop">
            </div>
            <div class="form-group">
                <label for="logo">
                    @lang('site.logo')
                </label>
                <input value="{{ $setting->logo}}"  type="file" name="logo"
                       class="form-control @error('logo') is-invalid @enderror" id="logo">
            </div>

            <div class="form-group">
                <label for="footer_logo">
                    @lang('site.footer_logo')
                </label>
                <input value="{{ $setting->footer_logo}}"  type="file" name="footer_logo"
                       class="form-control @error('footer_logo') is-invalid @enderror" id="footer_logo">
            </div>
            <div class="form-group">
                <label for="ad_image">
                    @lang('site.ad_image')
                </label>
                <input value="{{ $setting->ad_image}}"  type="file" name="ad_image"
                       class="form-control @error('ad_image') is-invalid @enderror" id="ad_image">
            </div>

            <div class="form-group">
                <label for="site_des_ar">
                    @lang('site.page_details_ar')

                </label>
                <textarea  rows="5"  name="site_des_ar"
                          class="form-control @error('site_des_ar') is-invalid @enderror" id="site_des_ar">
                    {{ $setting->site_des_ar}}
                </textarea>
            </div>


            <div class="form-group">
                <label for="site_des_en">
                    @lang('site.page_details_en')

                </label>
                <textarea  rows="5"  name="site_des_en"
                           class="form-control @error('site_des_en') is-invalid @enderror" id="site_des_en">
                    {{ $setting->site_des_en}}
                </textarea>
            </div>



            <div class="form-group">
                <label for="phone">

                    @lang('site.phone')


                </label>
                <input value="{{ $setting->phone}}"  type="text" name="phone"
                       class="form-control @error('phone') is-invalid @enderror" id="phone">
            </div>
             <div class="form-group">
                <label for="international_shipping">

                    @lang('site.international_shipping')


                </label>
                <input value="{{ $setting->international_shipping}}"  type="text" name="international_shipping"
                       class="form-control @error('international_shipping') is-invalid @enderror" id="international_shipping">
            </div>
             <div class="form-group">
                <label for="international_shipping_2">

                    @lang('site.international_shipping_2')


                </label>
                <input value="{{ $setting->international_shipping_2}}"  type="text" name="international_shipping_2"
                       class="form-control @error('international_shipping_2') is-invalid @enderror" id="international_shipping_2">
            </div>

            <div class="form-group">
                <label for="whatsapp">

                    @lang('site.whatsapp')


                </label>
                <input value="{{ $setting->whatsapp}}"  type="text" name="whatsapp"
                       class="form-control @error('whatsapp') is-invalid @enderror" id="whatsapp">
            </div>


            <div class="form-group">
                <label for="gmail">
                    @lang('site.gmail')



                </label>
                <input value="{{ $setting->gmail}}"  type="text" name="email"
                       class="form-control @error('gmail') is-invalid @enderror" id="gmail">
            </div>

            <div class="form-group">
                <label for="ios_link">
                    @lang('site.ios')


                </label>
                <input value="{{ $setting->ios_link}}"  type="text" name="ios_link"
                       class="form-control @error('ios_link') is-invalid @enderror" id="ios_link">
            </div>

            <div class="form-group">
                <label for="ios_version">
                    @lang('site.ios_version')


                </label>
                <input value="{{ $setting->ios_version}}"  type="text" name="ios_version"
                       class="form-control @error('ios_version') is-invalid @enderror" id="ios_version">
            </div>


            <div class="form-group">
                <label for="android_link">
                    @lang('site.android')
                </label>
                <input value="{{ $setting->android_link}}"  type="text" name="android_link"
                       class="form-control @error('android_link') is-invalid @enderror" id="android_link">
            </div>

            <div class="form-group">
                <label for="android_version">
                    @lang('site.android_version')
                </label>
                <input value="{{ $setting->android_version}}"  type="text" name="android_version"
                       class="form-control @error('android_version') is-invalid @enderror" id="android_version">
            </div>

            <div class="form-group">
                <label for="facebook">
                    @lang('site.facebook')
                </label>
                <input value="{{ $setting->facebook}}"  type="text" name="facebook"
                       class="form-control @error('facebook') is-invalid @enderror" id="facebook">
            </div>


            <div class="form-group">
                <label for="youtube">
                    @lang('site.youtube')
                </label>
                <input value="{{ $setting->youtube}}"  type="text" name="youtube"
                       class="form-control @error('youtube') is-invalid @enderror" id="youtube">
            </div>


            <div class="form-group">
                <label for="google_plus">
                    @lang('site.gplus')
                </label>
                <input value="{{ $setting->google_plus}}"  type="text" name="google_plus"
                       class="form-control @error('google_plus') is-invalid @enderror" id="google_plus">
            </div>


            <div class="form-group">
                <label for="twitter">
                    @lang('site.twitter')
                </label>
                <input value="{{ $setting->twitter}}"  type="text" name="twitter"
                       class="form-control @error('twitter') is-invalid @enderror" id="twitter">
            </div>


            <div class="form-group">
                <label for="instagram">
                    @lang('site.instagrm')


                </label>
                <input value="{{ $setting->instagram}}"  type="text" name="instagram"
                       class="form-control @error('instagram') is-invalid @enderror" id="instagram">
            </div>



            <div class="form-group">
                <label for="telegram">
                    @lang('site.telegram')
                </label>
                <input value="{{ $setting->telegram}}"  type="text" name="telegram"
                       class="form-control @error('telegram') is-invalid @enderror" id="telegram">
            </div>


        </div>

            <button type="submit" class="btn btn-primary">
                @lang('site.save')

            </button>

    </form>
@endsection
