<nav class="navbar navbar-expand-lg navbar-light bg-white shadow rounded mb-3 mb-lg-4">
  <div class="container-fluid m-1">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
      <a class="nav-item nav-link px-0 me-xl-4" href="">
        <i class="bx bx-menu-alt-left bx-sm"></i>
      </a>
    </div>
    <a class="navbar-brand" href="{{ url('/') }}">SITANI</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        @if (auth()->check() && auth()->user()->isAdmin())
        @else
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a>
        </li>
        @if(auth()->check())
        <li class="nav-item {{ request()->is('produk/produk*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('produk/produk') }}">Produk</a>
        </li>
        <li class="nav-item {{ request()->is('berita') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('berita') }}">Berita</a>
        </li>
        @if (auth()->user()->isPetani())
        <li class="nav-item">
          <a class="nav-link">|</a>
        </li>
        <li class="nav-item {{ request()->is('transaksi') ? 'active' : '' }}">
          <a class="nav-link" href="{{ url('transaksi') }}">Transaksi</a>
        </li>
        @endif
        @endif
        @endif
      </ul>
      @if (auth()->check())
      <div class="btn-group">
        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown"
          aria-expanded="false">
          {{ auth()->user()->nama }}
        </button>
        <ul class="dropdown-menu dropdown-menu-start dropdown-menu-lg-end">
          <li>
            <a class="dropdown-item" href="{{ url('profile') }}">
              <i class="bx bx-user me-2"></i>
              <span class="align-middle">Profile Saya</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li>
            <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#modalLogout">
              <i class="bx bx-power-off me-2"></i>
              <span class="align-middle">Log Out</span>
            </a>
          </li>
        </ul>
      </div>
      @else
      <a href="{{ route('login') }}" class="btn btn-outline-primary me-1">Masuk</a>
      <a href="{{ route('register') }}" class="btn btn-outline-secondary">Registrasi</a>
      @endif
    </div>
  </div>
</nav>