<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">

            <li class="menu">
                <a href="#dashboard" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-dashboard">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                        <span>@lang('layout.dashboard')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="dashboard" data-parent="#accordionExample">
                    <li id="li-dashboard">
                        <a href="{{route('admin.home')}}">@lang('layout.show')</a>
                    </li>
                </ul>
            </li>


            <li class="menu">
                <a href="#wallets" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-wallets">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                        <span>@lang('layout.wallets')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="wallets" data-parent="#accordionExample">
                    <li id="li-wallet">
                        <a href="{{route('admin.wallets.index')}}">@lang('layout.show')</a>
                    </li>
                </ul>
            </li>

            <li class="menu">
                <a href="#student_discounts" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-student_discounts">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                        <span>@lang('layout.discounts')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="student_discounts" data-parent="#accordionExample">
                    <li id="li-wallet">
                        <a href="{{route('admin.discounts.create')}}">@lang('layout.show')</a>
                    </li>
                </ul>
            </li>

            <li class="menu">
                <a href="#cartItems" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-cartItems">
                    <div class="">
                        <i class="fa fa-cart-plus"></i>
                        <span>@lang('layout.cartItems')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="cartItems" data-parent="#accordionExample">
                    <li id="li-cartItem">
                        <a href="{{route('admin.cart-items.index')}}">@lang('layout.show')</a>
                    </li>
                </ul>
            </li>

            {{--/////////// order///////////--}}
            <li class="menu">
                <a href="#orders" id="a-orders"  data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-orders">
                    <div class="">
                      <i class="fa-solid fa-list-check"></i>
                        <span>@lang('layout.orders')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="orders" data-parent="#accordionExample">
                    <li id="li-orders">
                        <a href="{{route('admin.orders.index')}}">@lang('layout.show online orders')</a>
                    </li>

                    <li id="li-cach-orders">
                        <a href="{{route('admin.index_cach.index')}}">@lang('layout.show orders')</a>
                    </li>
                    <li id="li-inpaid">
                        <a href="{{route('admin.index_inpaid.index')}}">@lang('layout.pending')</a>
                    </li>

                    <li id="li-not-complete">
                        <a href="{{route('admin.not-complete.index')}}">@lang('layout.not complete')</a>
                    </li>

                    <li id="li-refused/all">
                        <a href="{{route('admin.orders.refused')}}">@lang('layout.orders_reject')</a>
                    </li>
                </ul>
            </li>


            <li class="menu">
                <a href="#box_orders" id="a-box_orders"  data-toggle="collapse"
                   data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-orders">
                    <div class="">
                        <i class="fa-solid fa-list-check"></i>
                        <span>@lang('layout.box_orders')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="box_orders" data-parent="#accordionExample">
                    <li id="li-orders">
                        <a href="{{route('admin.box_orders.index')}}">@lang('layout.show online orders')</a>
                    </li>
                    <li id="li-inpaid">
                        <a href="{{route('admin.index2_inpaid.index')}}">@lang('layout.pending')</a>
                    </li>
                </ul>
            </li>

            {{--/////////// المنتجات ///////////--}}
            <li class="menu">
                <a href="#products" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-products">
                    <div class="">
                        <i class="fa fa-product-hunt" aria-hidden="true"></i>

                        <span>@lang('layout.products')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="products" data-parent="#accordionExample">
                    <li id="li-products">
                        <a href="{{route('admin.products.index')}}">@lang('layout.show products')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.products.create')}}">@lang('layout.add product')</a>
                    </li>
                    <li id="li-trash">
                        <a href="{{route('admin.products.trash')}}">@lang('layout.trash')</a>
                    </li>
                </ul>
            </li>


            {{--/////////// section///////////--}}
            <li class="menu">
                <a href="#sections" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-sections">
                    <div class="">
                      <i class="fa-solid fa-list"></i>
                      <span>@lang('layout.sections')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="sections" data-parent="#accordionExample">
                    <li id="li-sections">
                        <a href="{{route('admin.sections.index')}}">@lang('layout.show sections')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.sections.create')}}">@lang('layout.add section')</a>
                    </li>
                    <li id="li-trash">
                        <a href="{{route('admin.sections.trash')}}">@lang('layout.trash')</a>
                    </li>
                    <li id="li-sort">
                        <a href="{{route('admin.sections.sort.show')}}">@lang('layout.sort sections')</a>
                    </li>
                </ul>
            </li>

            {{--/////////// categories ///////////--}}
            <li class="menu">
                <a href="#categories" data-toggle="collapse" data-active="false" aria-expanded="false"
                   class="dropdown-toggle" id="toggle-categories">
                    <div class="">
                        <i class="fa-solid fa-list"></i>
                        <span>@lang('layout.categories')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="categories" data-parent="#accordionExample">
                    <li id="li-categories">
                        <a href="{{route('admin.categories.index')}}">@lang('layout.show categories')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.categories.create')}}">@lang('layout.add category')</a>
                    </li>
                    <li id="li-trash">
                        <a href="{{route('admin.categories.trash')}}">@lang('layout.trash')</a>
                    </li>
                    <li id="li-sort">
                        <a href="{{route('admin.categories.sort.show')}}">@lang('layout.sort categories')</a>
                    </li>
                </ul>
            </li>

            <li class="menu">
                <a href="#boxcategories" data-toggle="collapse"
                   data-active="false" aria-expanded="false" class="dropdown-toggle"
                   id="toggle-boxcategories">
                    <div class="">
                        <i class="fa-solid fa-list"></i>
                        <span>@lang('layout.box categories')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                             height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="boxcategories"
                    data-parent="#accordionExample">
                    <li id="li-boxcategories">
                        <a href="{{route('admin.box-categories.index')}}">@lang('layout.show box categories')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.box-categories.create')}}">@lang('layout.add box category')</a>
                    </li>
                    <li id="li-trash">
                        <a href="{{route('admin.box-categories.trash')}}">@lang('layout.trash')</a>
                    </li>
                </ul>
            </li>

            <li class="menu">
                <a href="#boxes" data-toggle="collapse" data-active="false"
                   aria-expanded="false" class="dropdown-toggle" id="toggle-boxes">
                    <div class="">
                        <i class="fa fa-product-hunt" aria-hidden="true"></i>
                        <span>@lang('layout.boxes')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="boxes"
                    data-parent="#accordionExample">
                    <li id="li-products">
                        <a href="{{route('admin.boxes.index')}}">@lang('layout.show boxes')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.boxes.create')}}">@lang('layout.add box')</a>
                    </li>
                    <li id="li-trash">
                        <a href="{{route('admin.boxes.trash')}}">@lang('layout.trash')</a>
                    </li>
                </ul>
            </li>


            {{--/////////// attributes ///////////--}}
            <li class="menu">
                <a href="#attributes" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-attributes">
                    <div class="">
                      <i class="fa fa-book" aria-hidden="true"></i>

                        <span>@lang('layout.attributes')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="attributes" data-parent="#accordionExample">
                    <li id="li-attributes">
                        <a href="{{route('admin.attributes.index')}}">@lang('layout.show attributes')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.attributes.create')}}">@lang('layout.add attribute')</a>
                    </li>
                    <li id="li-trash">
                        <a href="{{route('admin.attributes.trash')}}">@lang('layout.trash')</a>
                    </li>
                </ul>
            </li>
            {{--/////////// colors ///////////--}}{{--
            <li class="menu">
                <a href="#colors" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-attributes">
                    <div class="">
                      <i class="fa fa-paint-brush" aria-hidden="true"></i>

                        <span>@lang('layout.colors')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="colors" data-parent="#accordionExample">
                    <li id="li-colors">
                        <a href="{{route('admin.colors.index')}}">@lang('layout.show colors')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.colors.create')}}">@lang('layout.add colors')</a>
                    </li>
                    <li id="li-trash">
                        <a href="{{route('admin.colors.trash')}}">@lang('layout.trash')</a>
                    </li>
                </ul>
            </li>

            --}}{{--/////////// sizes ///////////--}}{{--
            <li class="menu">
                <a href="#sizes" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-attributes">
                    <div class="">
                      <i class="fa fa-paint-brush" aria-hidden="true"></i>

                        <span>@lang('layout.sizes')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="sizes" data-parent="#accordionExample">
                    <li id="li-sizes">
                        <a href="{{route('admin.sizes.index')}}">@lang('layout.show sizes')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.sizes.create')}}">@lang('layout.add sizes')</a>
                    </li>
                    <li id="li-trash">
                        <a href="{{route('admin.sizes.trash')}}">@lang('layout.trash')</a>
                    </li>
                </ul>
            </li>

--}}

            {{--/////////// options ///////////--}}
            <li class="menu">
                <a href="#options" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-options">
                    <div class="">
                      <i class="fa fa-spinner" aria-hidden="true"></i>

                      <span>@lang('layout.options')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="options" data-parent="#accordionExample">
                    <li id="li-options">
                        <a href="{{route('admin.options.index')}}">@lang('layout.show options')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.options.create')}}">@lang('layout.add option')</a>
                    </li>
                    <li id="li-trash">
                        <a href="{{route('admin.options.trash')}}">@lang('layout.trash')</a>
                    </li>
                </ul>
            </li>



            {{--/////////// التقيمات ///////////--}}
            <li class="menu">
                <a href="#ratings" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-ratings">
                    <div class="">
                      <i class="fa fa-star" aria-hidden="true"></i>

                      <span>@lang('layout.ratings')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="ratings" data-parent="#accordionExample">
                    <li id="li-ratings">
                        <a href="{{route('admin.rating.show' , 'active')}}">@lang('layout.ratings active')</a>
                    </li>
                    <li id="li-trash">
                        <a href="{{route('admin.rating.show' , 'pending')}}">@lang('layout.ratings pending')</a>
                    </li>
                </ul>
            </li>


            {{--/////////// المستخدمين ///////////--}}
            <li class="menu">
                <a href="#users" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-users">
                    <div class="">
                      <i class="fa fa-users" aria-hidden="true"></i>

                        <span>@lang('layout.users')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="users" data-parent="#accordionExample">
                    <li id="li-users">
                        <a href="{{route('admin.users.index')}}">@lang('layout.show users')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.users.create')}}">@lang('layout.add user')</a>
                    </li>
                    <li id="li-trash">
                        <a href="{{route('admin.users.trash')}}">@lang('layout.trash')</a>
                    </li>
                </ul>
            </li>

            {{--/////////// الطلاب ///////////--}}
            <li class="menu">
                <a href="#student" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-student">
                    <div class="">
                      <i class="fa fa-ravelry" aria-hidden="true"></i>

                        <span>@lang('layout.students')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="student" data-parent="#accordionExample">
                    <li id="li-student">
                        <a href="{{route('admin.student.index')}}">@lang('layout.show students')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.student.create')}}">@lang('layout.add student')</a>
                    </li>
                    <li id="li-pending">
                        <a href="{{route('admin.student.pending')}}">@lang('layout.pending')</a>
                    </li>
                    <li id="li-trash">
                        <a href="{{route('admin.student.trash')}}">@lang('layout.trash')</a>
                    </li>
                </ul>
            </li>


            {{--/////////// المسئولين ///////////--}}
            <li class="menu">
                <a href="#admins" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-admins">
                    <div class="">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <span>@lang('layout.admins')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="admins" data-parent="#accordionExample">
                    <li id="li-admins">
                        <a href="{{route('admin.admins.index')}}">@lang('layout.show admins')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.admins.create')}}">@lang('layout.add admin')</a>
                    </li>
                    <li id="li-trash">
                        <a href="{{route('admin.admins.trash')}}">@lang('layout.trash')</a>
                    </li>
                </ul>
            </li>

            {{--/////////// الدول ///////////--}}
            <li class="menu">
                <a href="#countries" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-countries">
                    <div class="">
                      <i class="fa fa-globe" aria-hidden="true"></i>

                        <span>@lang('layout.countries')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="countries" data-parent="#accordionExample">
                    <li id="li-countries">
                        <a href="{{route('admin.countries.index')}}">@lang('layout.show countries')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.countries.create')}}">@lang('layout.add country')</a>
                    </li>
                    <li id="li-trash">
                        <a href="{{route('admin.countries.trash')}}">@lang('layout.trash')</a>
                    </li>
                </ul>
            </li>

            {{--/////////// المدن ///////////--}}

            <li class="menu">
                <a href="#areas" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-areas">
                    <div class="">
                      <i class="fa fa-globe" aria-hidden="true"></i>

                        <span>@lang('layout.areas')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="areas" data-parent="#accordionExample">
                    <li id="li-areas">
                        <a href="{{route('admin.areas.index')}}">@lang('layout.show areas')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.areas.create')}}">@lang('layout.add area')</a>
                    </li>
                    <li id="li-trash">
                        <a href="{{route('admin.areas.trash')}}">@lang('layout.trash')</a>
                    </li>
                </ul>
            </li>
            {{--/////////// العملات ///////////--}}

            <li class="menu">
                <a href="#currencies" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-currencies">
                    <div class="">
                      <i class="fa fa-money" aria-hidden="true"></i>

                        <span>@lang('layout.currencies')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="currencies" data-parent="#accordionExample">
                    <li id="li-currencies">
                        <a href="{{route('admin.currencies.index')}}">@lang('layout.show currencies')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.currencies.create')}}">@lang('layout.add currencies')</a>
                    </li>

                </ul>
            </li>
            {{--/////////// الصلاحيات ///////////--}}
            <li class="menu">
                <a href="#roles" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-roles">
                    <div class="">
                        <i class="fa-solid fa-sliders"></i>
                        <span>@lang('layout.roles')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="roles" data-parent="#accordionExample">
                    <li id="li-roles">
                        <a href="{{route('admin.roles.index')}}">@lang('layout.show roles')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.roles.create')}}">@lang('layout.add role')</a>
                    </li>
                    <li id="li-trash">
                        <a href="{{route('admin.roles.trash')}}">@lang('layout.trash')</a>
                    </li>
                </ul>
            </li>


            {{--/////////// قسائم الشراء ///////////--}}
            <li class="menu">
                <a href="#coupons" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-coupons">
                    <div class="">
                      <i class="fa fa-plus-circle" aria-hidden="true"></i>

                        <span>@lang('layout.coupons')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="coupons" data-parent="#accordionExample">
                    <li id="li-coupons">
                        <a href="{{route('admin.coupons.index')}}">@lang('layout.show coupons')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.coupons.create')}}">@lang('layout.add coupon')</a>
                    </li>
                </ul>
            </li>


            <li class="menu">
                <a href="#contact" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-contact">
                    <div class="">
                      <i class="fa fa-envelope-o" aria-hidden="true"></i>

                        <span>@lang('layout.messages')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="contact" data-parent="#accordionExample">
                    <li id="li-contact">
                        <a href="{{route('admin.contact.index')}}">@lang('layout.show messages')</a>
                    </li>

                    <li id="li-contact2">
                        <a href="{{route('admin.contact.product')}}">@lang('layout.show messages products')</a>
                    </li>
                </ul>
            </li>

            {{--/////////// شرائح العرض ///////////--}}

            <li class="menu">
                <a href="#sliders" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-sliders">
                    <div class="">
                      <i class="fa fa-file-image-o" aria-hidden="true"></i>

                        <span>@lang('layout.sliders')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="sliders" data-parent="#accordionExample">
                    <li id="li-sliders">
                        <a href="{{route('admin.sliders.index')}}">@lang('layout.show sliders')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.sliders.create')}}">@lang('layout.add slider')</a>
                    </li>
                </ul>
            </li>


            <li class="menu">
                <a href="#advertisements" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-advertisements">
                    <div class="">
                        <i class="fa fa-file-image-o" aria-hidden="true"></i>

                        <span>@lang('layout.advertisements')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="advertisements" data-parent="#accordionExample">
                    <li id="li-advertisements">
                        <a href="{{route('admin.advertisements.index')}}">@lang('layout.show advertisements')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.advertisements.create')}}">@lang('layout.add advertisements')</a>
                    </li>
                </ul>
            </li>


            {{--/////////// الاعلانات ///////////--}}

            <li class="menu">
                <a href="#ads" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-ads">
                    <div class="">
                        <i class="fa-solid fa-sliders"></i>
                      <span>@lang('layout.ads')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="ads" data-parent="#accordionExample">
                    <li id="li-ads">
                        <a href="{{route('admin.ads.index')}}">@lang('layout.show ads')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.ads.create')}}">@lang('layout.add ad')</a>
                    </li>
                </ul>
            </li>


            {{--/////////// الايقونات ///////////--}}

            <li class="menu">
                <a href="#icons" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-icons">
                    <div class="">
                      <i class="fa fa-eercast" aria-hidden="true"></i>

                      <span>@lang('layout.icons')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="icons" data-parent="#accordionExample">
                    <li id="li-icons">
                        <a href="{{route('admin.icons.index')}}">@lang('layout.show icons')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.icons.create')}}">@lang('layout.add icon')</a>
                    </li>
                </ul>
            </li>

            {{-- page about --}}
            <li class="menu">
                <a href="#about" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-about">
                    <div class="">
                      <i class="fa fa-cogs" aria-hidden="true"></i>

                        <span>@lang('layout.page about')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="about" data-parent="#accordionExample">
                    <li id="li-about">
                        <a href="{{route('admin.about.index')}}">@lang('layout.Content Paragraphs')</a>
                    </li>
                    {{-- <li id="li-create">
                        <a href="{{route('admin.about.create')}}">@lang('layout.create Paragraph')</a>
                    </li>
                    <li id="li-sort">
                        <a href="{{route('admin.about.sort.show')}}">@lang('layout.sort')</a>
                    </li> --}}
                </ul>
            </li>
            {{--/////////// notification ///////////--}}
            <li class="menu">
                <a href="#notification" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-notification">
                    <div class="">
                        <i class="fa-solid fa-list"></i>
                        <span>@lang('layout.notification')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="notification" data-parent="#accordionExample">
                    <li id="li-notification">
                        <a href="{{route('admin.notification.index')}}">@lang('layout.show notification')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.notification.create')}}">@lang('layout.add notification')</a>
                    </li>

                </ul>
            </li>
            {{-- page TermsAndConditions --}}
            <li class="menu">
                <a href="#TermsAndConditions" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-TermsAndConditions">
                    <div class="">
                      <i class="fa fa-cogs" aria-hidden="true"></i>

                        <span>@lang('layout.page TermsAndConditions')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="TermsAndConditions" data-parent="#accordionExample">
                    <li id="li-TermsAndConditions">
                        <a href="{{route('admin.TermsAndConditions.index')}}">@lang('layout.Content Paragraphs')</a>
                    </li>
                    {{-- <li id="li-create">
                        <a href="{{route('admin.TermsAndConditions.create')}}">@lang('layout.create Paragraph')</a>
                    </li>
                    <li id="li-sort">
                        <a href="{{route('admin.TermsAndConditions.sort.show')}}">@lang('layout.sort')</a>
                    </li> --}}
                </ul>
            </li>

            <li class="menu">
                <a href="#privacyPolicy" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-privacyPolicy">
                    <div class="">
                      <i class="fa fa-cogs" aria-hidden="true"></i>

                        <span>@lang('layout.page privacyPolicy')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="privacyPolicy" data-parent="#accordionExample">
                    <li id="li-privacyPolicy">
                        <a href="{{route('admin.privacyPolicy.index')}}">@lang('layout.Content Paragraphs')</a>
                    </li>
                    {{-- <li id="li-create">
                        <a href="{{route('admin.privacyPolicy.create')}}">@lang('layout.create Paragraph')</a>
                    </li>
                    <li id="li-sort">
                        <a href="{{route('admin.privacyPolicy.sort.show')}}">@lang('layout.sort')</a>
                    </li> --}}
                </ul>
            </li>
{{--
            <li class="menu">
                <a href="#question" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-question">
                    <div class="">
                      <i class="fa fa-question-circle" aria-hidden="true"></i>

                      <span>@lang('layout.page question')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="question" data-parent="#accordionExample">
                    <li id="li-question">
                        <a href="{{route('admin.question.index')}}">@lang('layout.Content Paragraphs')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.question.create')}}">@lang('layout.create Paragraph')</a>
                    </li>
                    <li id="li-sort">
                        <a href="{{route('admin.question.sort.show')}}">@lang('layout.sort')</a>
                    </li>
                </ul>
            </li> --}}
{{--
            <li class="menu">
                <a href="#howToUse" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-howToUse">
                    <div class="">
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                        <span>@lang('layout.page howToUse')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="howToUse" data-parent="#accordionExample">
                    <li id="li-howToUse">
                        <a href="{{route('admin.howToUse.index')}}">@lang('layout.Content Paragraphs')</a>
                    </li>
                    <li id="li-create">
                        <a href="{{route('admin.howToUse.create')}}">@lang('layout.create Paragraph')</a>
                    </li>
                    <li id="li-sort">
                        <a href="{{route('admin.howToUse.sort.show')}}">@lang('layout.sort')</a>
                    </li>
                </ul>
            </li> --}}
            <li class="menu">
                <a href="#settings" data-toggle="collapse" data-active="false" aria-expanded="false" class="dropdown-toggle" id="toggle-settings">
                    <div class="">
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                        <span>@lang('layout.settings')</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="settings" data-parent="#accordionExample">
                    <li id="li-settings">
                        <a href="{{route('admin.settings.index')}}">@lang('layout.settings-all')</a>
                    </li>

                    <li id="li-settings">
                        <a href="{{route('admin.contact-us.settings')}}">@lang('layout.contact-settings')</a>
                    </li>
                </ul>
            </li>





        </ul>

    </nav>

</div>
