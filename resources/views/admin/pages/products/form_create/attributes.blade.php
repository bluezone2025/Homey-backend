<div class=" p-3  col-12  widget widget-attributes mb-5 @error('attributes') border border-danger @enderror">

    <div class="card mb-3">
        <div class="card-header">Choose Attributes</div>
        <div class="card-body d-flex flex-wrap">
            @foreach($attributes as $attribute)
                <div class="form-check mr-3 mb-2">
                    <input type="checkbox" class="form-check-input attribute-checkbox"
                           data-attribute-id="{{ $attribute->id }}"
                           data-attribute-name="{{ $attribute->name_ar }}"
                           data-attribute-is-free="{{ $attribute->is_free }}"
                           id="attr_{{ $attribute->id }}">
                    <label class="form-check-label" for="attr_{{ $attribute->id }}">
                        {{ $attribute->name_ar }} ({{ $attribute->is_free ? 'مجاني' : 'مدفوع' }})
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <div id="options-container" class="card mb-3 d-none">
        <div class="card-header">Select Options for Each Attribute</div>
        <div class="card-body" id="attribute-options-wrapper">
            <!-- Options per attribute will be loaded here dynamically -->
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">Generate Variants</div>
        <div class="card-body">
            <button type="button" class="btn btn-primary mb-2" onclick="generateVariants()">Generate Combinations</button>
            <div id="variant-container"></div>
        </div>
    </div>

</div>