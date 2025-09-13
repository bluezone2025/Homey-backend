@can('role' , 'order.search')
    <form class="search-form" action="{{route('admin.search')}}" method="get">
       @csrf
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i data-feather="search"></i>
                </div>
            </div>
            <input  name="value" type="text" class="form-control" id="navbarForm" placeholder="قم بالبحث هنا" value="{{isset($valueSearch) ? $valueSearch : ''}}">
        </div>
    </form>
@endcan
