@extends('admin.master')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.cart-items.index')}}">@lang('layout.cart-items')</a></li>
@endsection

@section('content')

    <form action="{{ route('admin.advertisements.update', $advertisement->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- This specifies the form is for update -->

        <div class="form-group mb-3">

            <label for="image">الصورة:</label>
            <input type="file" name="image" id="image" class="form-control" value="{{ old('image', $advertisement->image) }}">
            <label for="image" style="font-weight: bolder">رجاء رفع صورة بأرتفاع 63 بيكسل وعرض 450 بيكسل </label>

            <br>
            @if($advertisement->image)
                <img src="{{ asset( $advertisement->image) }}" alt="Advertisement Image" width="150">
            @endif
        </div>

        <div class="form-group mb-3">
            <label for="advertisement_type">نوع الشريحة الاعلانية:</label>
            <select name="advertisement_type" id="advertisement_type" class="form-control" onchange="handleAdvertisementTypeChange()">
                <option value="">اختر</option>
                <option value="category_id" {{ $advertisement->advertisement_type == 'category_id' ? 'selected' : '' }}>فئة</option>
                <option value="product_id" {{ $advertisement->advertisement_type == 'product_id' ? 'selected' : '' }}>منتج</option>
                <option value="student_id" {{ $advertisement->advertisement_type == 'student_id' ? 'selected' : '' }}>مشهور</option>
                <option value="brand_id" {{ $advertisement->advertisement_type == 'brand_id' ? 'selected' : '' }}>براند</option>
                <option value="out_source" {{ $advertisement->advertisement_type == 'out_source' ? 'selected' : '' }}>لينك خارجي</option>
            </select>
        </div>

        <div class="form-group mb-3" id="reference_id_container">
            <label for="reference_id">اختر:</label>
            <select name="reference_id" id="reference_id" class="form-control">
                <!-- Options will be dynamically populated here -->
            </select>
        </div>

        <div class="form-group mb-3" id="out_source_link_container" style="display:none;">
            <label for="out_source_link">اللينك الخارجي:</label>
            <input type="url" name="out_source_link" id="out_source_link" class="form-control" value="{{ old('out_source_link', $advertisement->out_source_link) }}">
        </div>

        <button type="submit" class="btn btn-primary">تحديث</button>
    </form>

@endsection

@section('js')

    <script>
        function handleAdvertisementTypeChange() {
            const advertisementType = document.getElementById('advertisement_type').value;
            const referenceIdContainer = document.getElementById('reference_id_container');
            const outSourceLinkContainer = document.getElementById('out_source_link_container');
            const referenceIdSelect = document.getElementById('reference_id');

            if (advertisementType === 'out_source') {
                referenceIdContainer.style.display = 'none';
                outSourceLinkContainer.style.display = 'block';
            } else {
                referenceIdContainer.style.display = 'block';
                outSourceLinkContainer.style.display = 'none';

                // Fetch data based on the selected advertisement type
                fetch(`/admin/api/get-references/${advertisementType}`)
                    .then(response => response.json())
            .then(data => {
                    // Clear the current options
                    referenceIdSelect.innerHTML = '';

                // Populate the select with the new options
                data.forEach(item => {
                    const option = document.createElement('option');
                option.value = item.id;
                option.textContent = item.id + ' ' + item.name_ar;
                if (item.id == {{ $advertisement->reference_id ?? 'null' }}) {
                    option.selected = true;
                }
                referenceIdSelect.appendChild(option);
            });
            })
            .catch(error => console.error('Error fetching data:', error));
            }
        }

        // Call the function on load in case the form is pre-filled
        window.onload = handleAdvertisementTypeChange;
    </script>

@endsection
