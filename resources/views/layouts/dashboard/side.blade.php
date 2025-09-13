  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" style="background: #000">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
 <!-- Sidebar user panel 
 <div class="user-panel">
  <div class="text-center ">
    <img style="height:80px;width150px" src="{{ asset('front/img/logo.png') }}" class="img-circle" alt="User Image">
  </div>
 
</div>
<!-- search form -->


      <!--
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span>
        </div>
      </form>
       -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">

          <!-- Optionally, you can add icons to the links -->
          <li  class="moha" ><a style="" href="{{route("dashboard.index")}}"><i class="fa fa-home"></i> <span> الرئيسية</span></a></li>

          <li  class="moha" ><a style="" href="{{route("users.index")}}"><i class="fa fa-users"> </i><span>@lang('المشرفين') </span></a></li>
          <li  class="moha" ><a style="" href="{{route("roles.index")}}"><i class="fa fa-list"></i> <span>@lang('رتب المشرفين') </span></a></li>
          <li  class="moha" ><a style="" href="{{route("profile.index")}}"><i class="fa fa-user"></i> <span>@lang('site.profile') </span></a></li>

          <li  class="moha" ><a style="" href="{{route("categories.index")}}"><i class="fa fa-list"></i> <span>الاقسام </span></a></li>

          <li  class="moha" ><a style="" href="{{route("subCategories.index")}}"><i class="fa fa-list"></i> <span> الاقسام الفرعية </span></a></li>

          <li  class="moha" ><a style="" href="{{route("subSubCategories.index")}}"><i class="fa fa-list"></i> <span> التصنيفات </span></a></li>    
                <li  class="moha" ><a style="" href="{{route("sliders.index")}}"><i class="fa fa-list"></i> <span> السليدر </span></a></li>
                <li  class="moha" ><a style="" href="{{route("brands.index")}}"><i class="fa fa-list"></i> <span> الماركات </span></a></li>
		  
		    <li  class="moha" ><a style="" href="{{route("slashes.index")}}"><i class="fa fa-list"></i> <span> اعلانات التخطي </span></a></li>



        

        




          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>
      </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
