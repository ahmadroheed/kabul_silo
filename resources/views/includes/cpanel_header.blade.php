  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:info@kabulsilo.gov.af">info@kabulsilo.gov.af</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>020 250 2966</span></i>
      </div>
      <div class="social-links d-none d-md-flex align-items-center">
        <a href="https://www.facebook.com/Kabul-Silo-803888746291158/" target="_blank" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="https://www.facebook.com/Kabul-Silo-803888746291158/" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="https://www.facebook.com/Kabul-Silo-803888746291158/" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex justify-content-between">

      <div class="logo">
        <!-- <h1 class="text-light"><a href="index.html">Flattern</a></h1> -->
        <!-- Uncomment below if you prefer to use an image logo -->
         <a href="/"><img src="/assets/img/logo.png" alt="" class="img-fluid"></a>
      </div>

      <nav id="navbar" class="navbar" dir="@lang('labels.dir')">
        <ul>
          <li><a href="/update_home" class="{{ (isset($nav_home) && $nav_home==1) ? 'active':'' }}">@lang('labels.home')</a></li>
          <li><a href="/update_gallary" class="{{ (isset($nav_gallary) && $nav_gallary==1) ? 'active':'' }}">@lang('labels.gallary')</a></li>
          <li><a href="/update_news" class="{{ (isset($nav_news) && $nav_news==1) ? 'active':'' }}">@lang('labels.news')</a></li>
          <li><a href="/update_contact" class="{{ (isset($nav_contact) && $nav_contact==1) ? 'active':'' }}">@lang('labels.contact')</a></li>

           <li><a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                   خروج از سیستم
                   </a>

             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                 @csrf
             </form>
          </li>
          
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  
