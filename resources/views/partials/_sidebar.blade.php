  <!-- Sidebar -->
  <ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #1d1d1d">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
          <div class="sidebar-brand-icon">
              <i class="fas fa-file-invoice"></i>
          </div>
          <div class="sidebar-brand-text mx-3">
              Jumopet

          </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item {{Request::path() == '/' ? 'active' : ''}}">
          <a class="nav-link" href="/">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Home</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
          Menu
      </div>
      <li class="nav-item {{Request::path() == 'transactions' ? 'active' : ''}}">
          <a class="nav-link" href="/transactions">
              <i class="fas fa-fw fa-chart-area"></i>
              <span>Transactions</span></a>
      </li>
      <li class="nav-item {{Request::path() == 'clients' ? 'active' : ''}}">
          <a class="nav-link" href="/clients">
              <i class="fas fa-fw fa-users"></i>
              <span>Clients</span></a>
      </li>
      @role('client')
      <li class="nav-item {{Request::path() == 'products' ? 'active' : ''}}">
          <a class="nav-link" href="/products">
              <i class="fas  fa-store"></i>
              <span>Products</span>
          </a>
      </li>
      @endrole
      @role('manager')
      <li class="nav-item {{Request::path() == 'stocks' ? 'active' : ''}}">
          <a class="nav-link" href="stocks">
              <i class="fas fa-fw fa-table"></i>
              <span>Stocks Inventory</span></a>
      </li>
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
              <i class="fas  fa-store"></i>
              <span>Products</span>
          </a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Products:</h6>
                  <a class="collapse-item" href="/products">All Products</a>
                  <a class="collapse-item" href="/categories">Product Categories</a>
                  <a class="collapse-item" href="/products/create">Add New Product</a>
              </div>
          </div>
      </li>
      @elserole('admin')
      <li class="nav-item {{Request::path() == 'stocks' ? 'active' : ''}}">
          <a class="nav-link" href="stocks">
              <i class="fas fa-fw fa-table"></i>
              <span>Stocks Inventory</span></a>
      </li>
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#productUtilities" aria-expanded="true" aria-controls="collapseUtilities">
              <i class="fas  fa-store"></i>
              <span>Products</span>
          </a>
          <div id="productUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Products:</h6>
                  <a class="collapse-item" href="/products">All Products</a>
                  <a class="collapse-item" href="/categories">Product Categories</a>
                  <a class="collapse-item" href="/products/create">Add New Product</a>
              </div>
          </div>
      </li>
      @endrole


      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Utilities Collapse Menu -->
      @role('admin')
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
              <i class="fas fa-fw fa-wrench"></i>
              <span>Settings</span>
          </a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Settings:</h6>
                  <a class="collapse-item" href="/settings">Settings</a>
                  <a class="collapse-item" href="/stores">Stores</a>
                  <a class="collapse-item" href="/register">Register New User</a>
              </div>
          </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      @endrole

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
  </ul>
  <!-- End of Sidebar -->