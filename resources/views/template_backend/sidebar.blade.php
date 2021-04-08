<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Golfit</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Dashboard</li>

          <li class="active"><a class="nav-link" href="{{ route('home') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>

          <li class="menu-header">Starter</li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-shopping-bag"></i> <span>Product</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('product.index') }}">List Product</a></li>
              <li><a class="nav-link" href="{{ route('product.tampil_hapus') }}">List Trashed Product</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-clipboard"></i> <span>Kategori</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('category.index') }}">List Kategori</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-bookmark"></i> <span>Tags</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('tag.index') }}">List Tags</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user-friends"></i> <span>Users</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="{{ route('user.index') }}">List User</a></li>
            </ul>
          </li>

    </aside>
  </div>