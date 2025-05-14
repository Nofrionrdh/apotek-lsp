<div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="top-bar row gx-0 align-items-center d-none d-lg-flex">
        <div class="col-lg-6 px-5 text-start">
            <small><i class="fa fa-map-marker-alt me-2"></i>123 Street, New York, USA</small>
            <small class="ms-4"><i class="fa fa-envelope me-2"></i>medicare@gmail.com</small>
        </div>
        <div class="col-lg-6 px-5 text-end">
            <small>Follow us:</small>
            <a class="text-body ms-3" href=""><i class="fab fa-facebook-f"></i></a>
            <a class="text-body ms-3" href=""><i class="fab fa-twitter"></i></a>
            <a class="text-body ms-3" href=""><i class="fab fa-linkedin-in"></i></a>
            <a class="text-body ms-3" href=""><i class="fab fa-instagram"></i></a>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="index.html" class="navbar-brand ms-4 ms-lg-0">
            <h1 class="fw-bold text-info m-0">Medi<span class="text-info">care</span></h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.html" class="nav-item nav-link active">Home</a>
                <a href="/about" class="nav-item nav-link">About Us</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Products
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('product.index') }}" class="dropdown-item">
                                <i class="fa fa-capsules me-2"></i> All Products
                            </a>
                        </li>
                        @if(session('pelanggan'))
                        <li>
                            <a href="{{ route('checkout.index') }}" class="dropdown-item">
                                <i class="fa fa-clipboard-check me-2"></i> Products Checkout
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
                <a href="/contact" class="nav-item nav-link">Contact Us</a>
            </div>
            <div class="d-none d-lg-flex ms-2">
                <a class="nav-icon position-relative rounded-circle ms-3 d-flex align-items-center justify-content-center"
                    href="{{ route('cart.index') }}" data-bs-toggle="tooltip" title="Cart">
                    <i class="fa fa-shopping-bag"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        0
                        <span class="visually-hidden">items in cart</span>
                    </span>
                </a>
                <div class="nav-icon position-relative rounded-circle ms-3 d-flex align-items-center justify-content-center dropdown"
                    style="cursor:pointer;" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ session('pelanggan') && session('pelanggan')->foto ? Storage::url(session('pelanggan')->foto) : asset('fe/img/default-profile.jpg') }}" 
                            alt="Profile" class="profile-img">
                </div>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile" aria-labelledby="profileDropdown">
                    @if(session('pelanggan'))
                        <li class="profile-header text-center">
                            <img src="{{ session('pelanggan')->foto ? Storage::url(session('pelanggan')->foto) : asset('fe/img/default-profile.jpg') }}" 
                                    alt="Profile" class="profile-img mb-2">
                            <div class="profile-name">{{ session('pelanggan')->nama_pelanggan }}</div>
                            <div class="profile-email">{{ session('pelanggan')->email }}</div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('profile.index')}}"><i class="fa fa-user me-2"></i>Profile</a></li>
                        <li>
                            <form action="{{ route('pelanggan.logout') }}" method="POST" class="m-0">
                                @csrf
                                <button class="dropdown-item" type="submit"><i class="fa fa-sign-out-alt me-2"></i>Logout</button>
                            </form>
                        </li>
                    @else
                        <li><a class="dropdown-item" href="{{ route('pelanggan.register') }}"><i class="fa fa-user-plus me-2"></i>Buat Akun</a></li>
                        <li><a class="dropdown-item" href="{{ route('pelanggan.login') }}"><i class="fa fa-sign-in-alt me-2"></i>Login</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>