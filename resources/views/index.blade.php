<!DOCTYPE html>
<html lang="en">
   <head>
      <title>@lang('labels.company')  -  @lang('labels.home')</title>
      @include('includes.head')
   </head>
   <body>
      <?php $nav_home=1; ?>
      @include('includes.header')
      <!-- ======= Hero Section ======= -->
      <section id="hero">
         <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner" role="listbox">
               <?php
                  use App\Models\Slider;
                   $sliders = Slider::orderBy('id','asc')->get();
                   $counter = 1;
                   foreach ($sliders as $slider) {
                    if ($counter == 1) {
                      $active = 'active';
                      $dispay = '';
                    }else{
                      $dispay = "display: none;";
                      $active = '';
                    }
                    $counter = 2;
                    if (Session::get('locale') == 'dr' && $slider->language == 'dari') {
                      $slider_title = $slider->title;
                      $slider_text = $slider->text;
                    }else if (Session::get('locale') == 'ps' && $slider->language == 'pashto') {
                      $slider_title = $slider->title;
                      $slider_text = $slider->text;
                    }else{
                      $slider_title = $slider->title;
                      $slider_text = $slider->text;
                    }
                    if ($slider_title != '' && $slider_text != '') {
                       $slider_text_display = '';
                    }else{
                       $slider_text_display = "display: none;";
                    }
                  ?>
               <!-- Slide 1 -->
               <div class="carousel-item {{$active}}" style="background-image: url('{{ asset('uploads/' . $slider->photo) }}')">
                  <div style="{{$slider_text_display}}" class="carousel-container" dir="{{ __('labels.dir') }}">
                     <div class="carousel-content animate__animated animate__fadeInUp">
                        <h2>{{$slider_title}}</h2>
                        <p>{{$slider_text}}</p>
                        <div class="text-center" style="{{$dispay}}"><a href="#main" class="btn-get-started"><i style="font-size:25px;" class="bi bi-chevron-down"></i></a></div>
                     </div>
                  </div>
               </div>
               <?php } ?>
            </div>
            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bx bx-left-arrow" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bx bx-right-arrow" aria-hidden="true"></span>
            </a>
            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
         </div>
      </section>
      <!-- End Hero -->
      <main id="main">
         <!-- ======= Cta Section ======= -->
         <section id="cta" class="cta">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12 text-center text-lg-left">
                     <h3><span>@lang('labels.company')</span></h3>
                     <!-- <p></p> -->
                  </div>
               </div>
            </div>
         </section>
         <!-- End Cta Section -->
         <!-- ======= Services Section ======= -->
         <section id="services" class="services">
            <div class="container">
               <div class="section-title" data-aos="fade-up">
                  <h2><strong class="border-bottom">@lang('labels.services')</strong></h2>
               </div>
               <div class="row">
                  <div class="col-lg-4 col-md-6">
                     <div class="icon-box" data-aos="fade-up">
                        <div class="icon"><i class="bi bi-briefcase"></i></div>
                        <h4 class="title"><a href="/services#service3">@lang('labels.services3')</a></h4>
                        <p class="description" dir="@lang('labels.dir')"><?= mb_substr(__('labels.services3_text'), 1,100).'...' ?></p>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                     <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                        <div class="icon"><i class="bi bi-card-checklist"></i></div>
                        <h4 class="title"><a href="/services#service2">@lang('labels.services2')</a></h4>
                        <p class="description" dir="@lang('labels.dir')"><?= mb_substr(__('labels.services2_text'), 1,100).'...' ?></p>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                     <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon"><i class="bi bi-bar-chart"></i></div>
                        <h4 class="title"><a href="/services#service1">@lang('labels.services1')</a></h4>
                        <p class="description" dir="@lang('labels.dir')"><?= mb_substr(__('labels.services1_text'), 1,100).'...' ?></p>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- End Services Section -->
         <?php 
            use App\Models\Informations;
            $informations = Informations::get();
            foreach ($informations as $info) {
               if ($info->type == 1) {
                  $history_dr_text = $info->dr_text;
                  $history_ps_text = $info->ps_text;
                  $history_en_text = $info->en_text;
               }else if ($info->type == 2) {
                  $stracture_dr_text = $info->dr_text;
                  $stracture_ps_text = $info->ps_text;
                  $stracture_en_text = $info->en_text;
               }else if ($info->type == 3) {
                  $activities_dr_text = $info->dr_text;
                  $activities_ps_text = $info->ps_text;
                  $activities_en_text = $info->en_text;
               }
            }
            if (Session::get('locale') == 'dr') {
               $history_text = $info->dr_text;
               $stracture_text = $info->dr_text;
               $activities_text = $info->dr_text;
             }else if (Session::get('locale') == 'ps') {
               $history_text =$info->ps_text;
               $stracture_text = $info->ps_text;
               $activities_text = $info->ps_text;
             }else if (Session::get('locale') == 'en'){
               $history_text = $info->en_text;
               $stracture_text = $info->en_text;
               $activities_text = $info->en_text;
             }
            ?>
         <!-- ======= Portfolio Section ======= -->
         <section id="portfolio" class="portfolio divider">
            <div class="container">
               <div class="section-title" data-aos="fade-up">
                  <h2><strong class="border-bottom">@lang('labels.history')</strong></h2>
                  <br>
                  <p align="@lang('labels.align')" dir="@lang('labels.dir')"><?= $history_text ?></p>
               </div>
            </div>
         </section>
         <!-- End Portfolio Section -->
         <!-- ======= biography of the boss ======= -->
         <section id="about-us" class="about-us team divider">
            <div class="container" data-aos="fade-up">
               <?php 
                  use App\Models\Biography;
                   $boss = Biography::first();
                   if (Session::get('locale') == 'dr') {
                      $boss_text = $boss->dr_text;
                    }else if (Session::get('locale') == 'ps') {
                      $boss_text = $boss->ps_text;
                    }else if (Session::get('locale') == 'en'){
                      $boss_text = $boss->en_text;
                    }
                  ?>
               <div class="row content" dir="@lang('labels.dir')">
                  <div class="col-lg-4" data-aos="fade-right">
                     <div class="member" data-aos="fade-up">
                        <div class="member-img">
                           <img style="width: 100%;" src="assets/img/boss/{{$boss->photo}}" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                           <h4>{{$boss->name}}</h4>
                           <span>@lang('labels.position')</span>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-8 pt-4 pt-lg-0 section-title" data-aos="fade-left">
                     <h2><strong class="border-bottom">@lang('labels.biography')</strong></h2>
                     <br>
                     <p align="@lang('labels.align')" dir="@lang('labels.dir')"><?= $boss_text ?></p>
                  </div>
               </div>
            </div>
         </section>
         <!-- ======= Portfolio Section ======= -->
         <section id="portfolio" class="portfolio divider">
            <div class="container">
               <div class="section-title" data-aos="fade-up">
                  <h2><strong class="border-bottom">@lang('labels.activities_descriptions')</strong></h2>
                  <br>
                  <p align="@lang('labels.align')" dir="@lang('labels.dir')"><?= $activities_text ?></p>
               </div>
            </div>
         </section>
         <!-- End Portfolio Section -->
      </main>
      <!-- End #main -->
      @include('includes.footer')
      @include('includes.script')
   </body>
</html>