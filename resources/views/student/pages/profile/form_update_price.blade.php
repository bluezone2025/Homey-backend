{{--
<hr class="my-4">
<form class="mt-5" action="{{route('student.profile.update-discount')}}" method="post">
    @csrf
    <h6 class="heading-small text-primary mb-4">@lang('form.label.update-discount')</h6>
    <div class="pl-lg-4">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group focused">
                    <label class="form-control-label text-black" for="percentage">@lang('form.label.discount value') %</label>
                    <input name="discount"
                           type="number" min="1"
                           value="{{ auth('student')->user()->discount }}"
                           max="100" id="discount" class="form-control form-control-alternative @error('discount') is-invalid @enderror" required>
                    @error('discount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            --}}
{{--
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label text-black" for="discount_date">@lang('form.label.discount date')</label>
                    <input name="discount_date"
                           value="{{ auth('student')->user()->discount_date }}"
                           type="date" id="discount_date" class="form-control form-control-alternative @error('discount_date') is-invalid @enderror" required>
                    @error('discount_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>--}}{{--

            <button type="submit" class="btn btn-primary btn-block ">@lang('form.label.update discount')</button>
            <a onclick="confirm('هل متأكد من مسح العرض من كافة المنتجات')" href="{{route('student.profile.remove-discount')}}" class="btn btn-danger btn-block ">@lang('form.label.remove discount')</a>
        </div>
    </div>
</form>


--}}
