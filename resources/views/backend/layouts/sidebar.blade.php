<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin')}}">
      <div>
        {{-- <i class="fas fa-laugh-wink"></i> --}}
        <img src="{{ asset('backend/img/logo2-small.png') }}" alt="">
      </div>
      <div class="sidebar-brand-text mx-3">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->is('admin')) ? 'active' : '' }}">
      <a class="nav-link" href="{{route('admin')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Banner
    </div>

    <li class="nav-item {{ (request()->is('admin/banner*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('banner.index') }}">
            <i class="fas fa-image"></i>
            <span>Banners</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            Shop
        </div>

    <!-- Categories -->
    <li class="nav-item {{ (request()->is('admin/category*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('category.index') }}">
            <i class="fas fa-sitemap"></i>
            <span>Category</span>
        </a>
    </li>

    <!-- Products -->
    <li class="nav-item {{ (request()->is('admin/product*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('product.index') }}">
            <i class="fas fa-cubes"></i>
            <span>Products</span>
        </a>
    </li>
    
    <!--- Purchases -->
    <li class="nav-item {{ (request()->is('admin/purchase*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('purchase.index') }}">
            <i class="fas fa-shopping-bag"></i>
            <span>Purchases</span>
        </a>
    </li>

    <!--Orders -->
    <li class="nav-item {{ (request()->is('admin/sale*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('sale.index') }}">
            <i class="fas fa-clipboard-list"></i>
            <span>Sales</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Others
    </div>

     <!-- Levels -->
    <li class="nav-item {{ (request()->is('admin/level*')) ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#levelCollapse" aria-expanded="true" aria-controls="levelCollapse">
          <i class="fas fa-bars"></i>
          <span>Levels</span>
        </a>
        <div id="levelCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Level Options:</h6>
            <a class="collapse-item" href="{{ route('level.index') }}">Levels</a>
            <a class="collapse-item" href="{{ route('price.index') }}">Price Level</a>
          </div>
        </div>
    </li>

    <!-- Regions -->
    <li class="nav-item {{ (request()->is('admin/region*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('region.index') }}">
            <i class="fas fa-layer-group"></i>
            <span>Regions</span>
        </a>
    </li>

    <!-- Suppliers -->
    <li class="nav-item {{ (request()->is('admin/supplier*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('supplier.index') }}">
            <i class="fas fa-users"></i>
            <span>Suppliers</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
     <!-- Heading -->
    <div class="sidebar-heading">
        General Settings
    </div>

     <!-- Users -->
     <li class="nav-item {{ (request()->is('admin/users*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-users"></i>
            <span>Users</span></a>
    </li>
    
     <!-- General settings -->
     <li class="nav-item {{ (request()->is('admin/setting*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('settings') }}">
            <i class="fas fa-cog"></i>
            <span>Settings</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>