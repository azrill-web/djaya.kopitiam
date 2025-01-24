<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
  <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="sidebarMenuLabel">Menu</h5>
      <a href="/dashboard/orders/"><i class="bi bi-x"></i></a>
    </div>
    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
    <ul class="nav flex-column">

        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/orders*') ? 'active' : '' }}" href="/dashboard/orders">
          <i class="bi bi-cart-plus"></i>
            Order Menu
          </a>
        </li>
    

        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/admin/orders*') ? 'active' : '' }}" href="/dashboard/admin/orders">
          <i class="bi bi-clipboard2-check"></i>
            Hasil pesanan
          </a>
        </li>


        <li class="nav-item">
          <form action="/logout" method="post" class="d-inline">
            @csrf
            <a href="#" class="nav-link" onclick="if(confirm('Apakah Anda Ingin Keluar Dari Halaman Ini?')) this.closest('form').submit(); return false;">
              <i class="bi bi-box-arrow-in-right"></i>
              Logout
            </a>
          </form>
        </li>
      </ul>


      @can('admin')
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Administrator</span>
        </h6>

        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/menus*') ? 'active' : '' }}" href="/dashboard/menus">
            <i class="bi bi-file-plus"></i>
              Tambah menu
            </a>
          </li>
        </ul>
      @endcan
    </div>
  </div>
</div>