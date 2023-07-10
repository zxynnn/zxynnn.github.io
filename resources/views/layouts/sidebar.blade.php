<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    &nbsp;
    <div class="sidebar-brand">
      <a href="{{ route('home') }}"> <img src=" {{asset ('assets/img/logo.png')}}" class="mr-2" style="width: 90%" alt="logo" /></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('home') }}"> <img src=" {{asset ('assets/img/bm.png')}}" class="mr-2" style="width: 30%" alt="logo" /></a>
    </div>
    &nbsp;
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="{{ (Request::url() === url('/')
            || Request::url() === url('/admin')) ? 'active' : '' }}">
        <a href="{{ route('home') }}" class="nav-link"><i class="ion-android-home"></i> <span>Dashboard</span></a>
      </li>

      @if (Auth::user()->roles == 'admin')

      <li class="menu-header">Menu Utama</li>
      <li class="{{ (Request::url() === route('product.index')
            || Request::url() === route('product-category.index')) ? 'dropdown active' : 'dropdown' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
          <i class="ion-cube"></i> <span>Produk</span>
        </a>
        <ul class="dropdown-menu">

          <li class="{{ (Request::url() === route('product.index')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('product.index') }}">
              <i class="ion-android-list"></i> <span>Data Produk</span></a>
          </li>

          <li class="{{ (Request::url() === route('product-category.index')) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('product-category.index') }}">
              <i class="ion-pricetags"></i> <span>Kategori Produk</span>
            </a>
          </li>

        </ul>

      <li class="{{ (Request::url() === route('customer.index')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('customer.index') }}"><i class="ion-person-stalker"></i> <span>Pelanggan</span></a>
      </li>

      <li class="{{ (Request::url() === route('coupon.index')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('coupon.index') }}"><i class="ion-cash"></i> <span>Diskon</span></a>
      </li>

      </li>
      </li>

      @endif
      <!-- request transaction index untuk menampilkan halaman transaksi saat kita klik menu transaksi -->
      <li class="menu-header">Menu Transaksi</li>
      <li class="{{ (Request::is('transaction/index') || Request::is('transaction/report') || Request::is('transaction/create/*')) ? 'dropdown active' : 'dropdown' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
          <i class="ion-ios-cart"></i> <span>Transaksi</span>
        </a>
        <ul class="dropdown-menu">
          <!-- route transaction create yang ada dibawah ini untuk menghubungkan buat transaksi ke halaman edit transaksi -->
          <li class="{{ Request::is('transaction/create/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('transaction.create', AppHelper::transaction_code()) }}">
              <i class="ion-bag"></i> <span>Buat Transaksi</span></a>
          </li>

          <li class="{{ Request::url() === route('transaction.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('transaction.index') }}">
              <i class="ion-ios-list"></i> <span>Data Transaksi</span></a>
          </li>
          <!-- route transaction report pada code dibawah ini untuk menampilkan hasil laporan transaksi -->
          <li class="{{ Request::url() === route('transaction.report') ? 'active' : '' }}">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#transactionModal">
              <i class="ion-clipboard"></i> <span>Laporan Transaksi</span></a>
          </li>

        </ul>
      </li>
      <!-- route laba index untuk menampilkan halaman laba -->
      </li>
      <li class="{{ (Request::url() === route('laba.index')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('laba.index') }}"><i class="ion-ios-list"></i> <span>Akumuliasi Laba</span></a>
      </li>

      @if (Auth::user()->roles == 'admin')

      <li class="menu-header">Manajemen Toko</li>
      <!-- code untuk menampilkan atau memangil halaman pada users -->
      <li class="{{ (Request::url() === route('user.index')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('user.index') }}"><i class="ion-android-person"></i> <span>Users</span></a>
      </li>
      <!-- code untuk menampilkan company profil, menggunakan req url dan route companyprofil.index -->
      <li class="{{ (Request::url() === route('companyProfile.index')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('companyProfile.index') }}"><i class="ion-android-settings"></i> <span>Pengaturan Toko</span></a>
      </li>
      @endif


    </ul>
  </aside>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="transactionModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="{{ route('transaction.report') }}" method="post">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Laporan Transaksi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- code setelah kita klik laporan transaksi -->
        <div class="modal-body">
          <div class="form-group">
            <label>Rentang Waktu</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-calendar"></i>
                </div>
              </div>
              <input type="text" class="form-control daterange-cus" name="date">
            </div>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Proses</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>