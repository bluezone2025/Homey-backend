 @foreach($students as $student)
        <div class="col-md-3 col-6">
            <div class="brand position-relative"
                onclick="window.location.href='{{  route('brand', $student->id)  }}'"
            >
                <img src="{{ asset('assets/images/student/' . $student->img) }}" class="brand-img img-fluid" alt="">
                <a href="{{ route('brand', $student->id) }}" class="brand-desc btn btn-black">
                    {{ $student->name }}
                </a>
            </div>
        </div>
@endforeach