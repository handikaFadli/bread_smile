<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Bread Smile</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('dist/images/logoh.png') }}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/plugins/animate.min.css" />
    <link rel="stylesheet" href="assets/css/main.css?v=5.6" />
</head>

<body>
    <!-- Quick view -->
    <header id="home" class="header-area header-style-1 header-style-5 header-height-2">
        <div class="header-middle header-middle-ptb-2 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="index.html"><img src="assets/imgs/theme/logo.png" alt="logo" /></a>
                    </div>
                    <div class="header-right">
                        <div class="search-style-1">
                            <form action="">
                                <input type="text" name="search" autocomplete="off" value="{{ request('search') }}" placeholder="Cari Roti..." />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="">
                    <div class="logo logo-width-2 d-block d-lg-none">
                        <a href="index.html"></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex justify-content-center">
                        <div class="main-categori-wrap d-none d-lg-block">
                        </div>
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-lg-block font-heading">
                            <nav>
                                <ul>
                                    <li>
                                        <a class="active" href="#home">Home</a>
                                    </li>
                                    <li>
                                        <a class="active" href="#produk">Produk</a>
                                    </li>
                                    <li>
                                        <a class="active" href="#lokasi">Lokasi</a>
                                    </li>
                                    <li>
                                        <a class="active" href="#about">About</a>
                                    </li>

                                    <li>
                                        <a href="/login">Login</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <div class="header-action-icon-2 d-block d-lg-none">
                        <div class="burger-icon burger-icon-white">
                            <span class="burger-icon-top"></span>
                            <span class="burger-icon-mid"></span>
                            <span class="burger-icon-bottom"></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="index.html"><img src="assets/imgs/theme/logo.png" alt="logo" /></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="#">
                        <input type="text" placeholder="Search for items…" />
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu font-heading">
                            <li class="menu-item-has-children">
                                <a href="#home">Home</a>
                                <ul class="dropdown">
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#produk">Produk</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#about">About</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="/login">Login</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
            </div>
        </div>
    </div>
    <!--End header-->
    <main class="main pages">
        <section class="hero-3 position-relative align-items shadow-md">
            <h2 class="mb-30 text-center text-white" id="text">SELAMAT DATANG</h2>
        </section>
        <!-- BEGIN: Users Layout -->
        <section id="produk" class="bg-grey-1 section-padding pt-100 pb-80 mb-80">
            <div class="container">
                <h1 class="mb-80 text-center">List Produk </h1>
                <div class="row product-grid">
                    @foreach ($produkJadi as $produk)
                    <!-- {{-- @if ($produk->harga_jual > 0 && $produk->modal > 0) --}} -->
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="javascript:;">
                                        <img class="default-img" src="{{ asset('images/'.$produk->foto) }}" alt="" />
                                    </a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <!-- {{-- <a href="shop-grid-right.html"></a> --}} -->
                                </div>
                                <h2>{{ $produk->nm_produk }}</h2>
                                <div>
                                    <span class="font-small text-muted">Stok: {{ $produk['stok']}}</span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- {{-- @endif --}} -->
                    @endforeach
                </div>
        </section>

        <div class="page-content pt-50">
            <div class="container">
                <div class="row">
                    <div class="col-xl-10 col-lg-12 m-auto">
                        <section id="lokasi" class="text-center mb-50">
                            <h2 class="title style-3 mb-40">Dimana Saja Cabang Kami? </h2>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 mb-24">
                                    <div class="featured-card">
                                        <h4>Surya Toserba</h4>
                                        <iframe scrolling="no" height="100%" width="100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.454613416763!2d108.56054321283447!3d-6.714243095145936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ee38b3a27354f%3A0x937dad68f87102c6!2sBread%20Smile%20Surya%20Toserba!5e0!3m2!1sen!2sid!4v1676017051351!5m2!1sen!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        <a href="Javascript:;">Silahkan Kunjungi!</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-24">
                                    <div class="featured-card">
                                        <h4>Csb Mall </h4>
                                        <iframe scrolling="no" height="100%" width="100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.4181838659347!2d108.5454938269531!3d-6.718716099999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f1dee5555555f%3A0x99edf0a988892f8f!2sHypermart%20-%20Cirebon%20Superblock%20Mall!5e0!3m2!1sen!2sid!4v1676017753455!5m2!1sen!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        <a href="Javascript:;">Silahkan Kunjungi!</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-24">
                                    <div class="featured-card">
                                        <h4>Asia Toserba </h4>
                                        <iframe scrolling="no" height="100%" width="100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.4520039677063!2d108.56064131283456!3d-6.714563595145702!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ee26460ef2ce9%3A0x1c6d620051b9c96!2sAsia%20Toserba!5e0!3m2!1sen!2sid!4v1676017870222!5m2!1sen!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        <a href="Javascript:;">Silahkan Kunjungi!</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-24">
                                    <div class="featured-card">
                                        <h4>Surya Kuningan Toserba </h4>
                                        <iframe scrolling="no" height="100%" width="100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2476595834264!2d108.47761281355561!3d-6.980076494957475!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f1597703aab3d%3A0x29444786b745b8f2!2sSurya%20Toserba%20Kuningan%20Siliwangi!5e0!3m2!1sen!2sid!4v1676194957956!5m2!1sen!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        <a href="Javascript:;">Silahkan Kunjungi!</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-24">
                                    <div class="featured-card">
                                        <h4>Yogya Toserba Pamanukan</h4>
                                        <iframe scrolling="no" height="100%" width="100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d299.05165532697396!2d107.82125858657811!3d-6.282303233529263!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e694523180f18b7%3A0xee766fe8464cea04!2sTOSERBA%20YOGYA!5e0!3m2!1sen!2sid!4v1676196059401!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        <a href="Javascript:;">Silahkan Kunjungi!</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-24">
                                    <div class="featured-card">
                                        <h4>Grage Mall </h4>
                                        <iframe scrolling="no" height="100%" width="100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.4520039677063!2d108.56064131283456!3d-6.714563595145702!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ee26460ef2ce9%3A0x1c6d620051b9c96!2sAsia%20Toserba!5e0!3m2!1sen!2sid!4v1676017870222!5m2!1sen!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        <a href="Javascript:;">Silahkan Kunjungi!</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-24 mx-auto">
                                    <div class="featured-card">
                                        <h4>Asia Plaza Tasikmalaya </h4>
                                        <iframe scrolling="no" height="100%" width="100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1867.5026975419107!2d108.21561524543134!3d-7.342612280458079!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f576c7c25dd8f%3A0x911e5e4095a1b4a2!2sAsia%20Plaza%20Shopping%20Centre!5e0!3m2!1sen!2sid!4v1676196636562!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        <a href="Javascript:;">Silahkan Kunjungi!</a>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section id="about" class="row align-items-center mb-50">
                            <div class="col-lg-6">
                                <img src="dist/images/breadsmile.jpg" alt="" class="border-radius-15 mb-md-3 mb-lg-0 mb-sm-4" />
                            </div>
                            <div class="col-lg-6">
                                <div class="pl-25">
                                    <h2 class="mb-30">Tentang Kami</h2>
                                    <p>Perusahaan ini di bangun pada tahun 2016 oleh Ny.inge.</p>
                                    <p>Bread Smile bergerak dalam pembuatan dan penjualan roti yang sudah tersebar di beberapa daerah di Kota Cirebon, Kabupaten Cirebon dan kawasan Jawa Barat lainnya.</p>
                                    <p>Bread Smile menyediakan berbagai macam Roti seperti Roti Tawar, Roti Panggang dan berbagai Snack yang dibuat dengan bahan-bahan berkualitas tinggi dan alami dalam pembuatannya.
                                    <P>Bread Smile memastikan bahwa setiap roti yang dijual adalah produk yang berkualitas tinggi dan layak untuk dinikmati.</p>
                                    <p class="mb-30">DATANGLAH DAN NIKMATI ROTI LEZAT KAMI!</p>
                                    <div class="carausel-3-columns-cover position-relative">
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="container pb-30 wow animate__animated animate__fadeInUp" data-wow-delay="0">
        <div class="row align-items-center">
            <div class="col-12 mb-30">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <p class="font-sm mb-0">&copy; {{ date('Y') }}, <strong class="text-brand">Bread Smile</strong><br />All rights reserved</p>
            </div>
            <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">
                <div class="hotline d-lg-inline-flex mr-30">
                    <img src="{{ asset('dist/images/location.png') }}" alt="map-pin" height="60" />
                    <p>Kunjungi Toko<span>Untuk Pemesanan</span></p>
                </div>
            </div>
        </div>
    </div>
    </footer>
    <!-- Vendor JS-->
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="assets/js/plugins/slick.js"></script>
    <script src="assets/js/plugins/waypoints.js"></script>
    <script src="assets/js/plugins/wow.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.js"></script>
    <script src="assets/js/plugins/magnific-popup.js"></script>
    <script src="assets/js/plugins/select2.min.js"></script>
    <script src="assets/js/plugins/counterup.js"></script>
    <script src="assets/js/plugins/jquery.countdown.min.js"></script>
    <script src="assets/js/plugins/images-loaded.js"></script>
    <script src="assets/js/plugins/scrollup.js"></script>
    <script src="assets/js/plugins/jquery.vticker-min.js"></script>
    <!-- Template  JS -->
    <script src="assets/js/main.js?v=5.6"></script>

</body>

</html>