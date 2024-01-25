<!DOCTYPE html>
<html lang="en">

<head>
  <title>@lang('labels.company')  -  @lang('labels.services')</title>
  @include('includes.head')
</head>

<body>

  <?php $nav_services=1; ?>
  @include('includes.header')

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container" dir="@lang('labels.dir')">

        <div class="d-flex justify-content-between align-items-center">
          <h2>@lang('labels.services')</h2>
          <ol>
            <li><a href="/">@lang('labels.home')</a></li>
            <li>@lang('labels.services')</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="fade-up">
              <div class="icon"><i class="bi bi-briefcase"></i></div>
              <h4 class="title"><a href="#service3">@lang('labels.services3')</a></h4>
              <p class="description" dir="@lang('labels.dir')"><?= mb_substr(__('labels.services3_text'), 1,100).'...' ?></p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="bi bi-card-checklist"></i></div>
              <h4 class="title"><a href="#service2">@lang('labels.services2')</a></h4>
              <p class="description" dir="@lang('labels.dir')"><?= mb_substr(__('labels.services2_text'), 1,100).'...' ?></p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="bi bi-bar-chart"></i></div>
              <h4 class="title"><a href="#service1">@lang('labels.services1')</a></h4>
              <p class="description" dir="@lang('labels.dir')"><?= mb_substr(__('labels.services1_text'), 1,100).'...' ?></p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Services Section -->



    <!-- ======= Portfolio Section ======= -->
    <section id="service1" class="portfolio divider">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2><strong class="border-bottom">@lang('labels.services1')</strong></h2>
          <br>
          <p align="@lang('labels.align')" dir="@lang('labels.dir')">@lang('labels.services1_text')</p>
        </div>

      </div>
    </section><!-- End Portfolio Section -->



    <!-- ======= Portfolio Section ======= -->
    <section id="service2" class="portfolio divider">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2><strong class="border-bottom">@lang('labels.services2')</strong></h2>
          <br>
          <p align="@lang('labels.align')" dir="@lang('labels.dir')">@lang('labels.services2_text')</p>
        </div>

      </div>
    </section><!-- End Portfolio Section -->



    <!-- ======= Portfolio Section ======= -->
    <section id="service3" class="portfolio divider">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2><strong class="border-bottom">@lang('labels.services3')</strong></h2>
          <br>
          <p align="@lang('labels.align')" dir="@lang('labels.dir')">@lang('labels.services3_text')></p>
        </div>

      </div>
    </section><!-- End Portfolio Section -->




  </main><!-- End #main -->

   @include('includes.footer')
   @include('includes.script')


</body>

</html>