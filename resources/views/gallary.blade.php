<!DOCTYPE html>
<html lang="en">
<head>
    <title>@lang('labels.company') - @lang('labels.gallary')</title>
    @include('includes.head')
    <style>
        .portfolio-img {
            width: 100%;
            height: 400px;
            /* Adjust the height as needed */
            object-fit: fill;
        }
        /* Add any additional styling for the portfolio item container if needed */
        .portfolio-item-inner {
            overflow: hidden;
            /* Ensure images don't overflow the container */
            border: 1px solid #ddd;
            /* Add a border for visual separation */
            border-radius: 8px;
            /* Add rounded corners for a cleaner look */
        }
    </style>

</head>

<body>
    <?php $nav_gallary = 1; ?>
    @include('includes.header')

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container" dir="@lang('labels.dir')">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>@lang('labels.gallary')</h2>
                    <!-- <h5 style="color: #fff;">@lang('labels.slogen')</h5> -->
                    <ol>
                        <li><a href="/">@lang('labels.home')</a></li>
                        <li>@lang('labels.gallary')</li>
                    </ol>
                </div>
            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container">

                <div class="row" data-aos="fade-up">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters" dir="@lang('labels.dir')">
                            <li data-filter="*" class="filter-active">@lang('labels.all')</li>
                            <li data-filter=".filter-party_activities">@lang('labels.services1')</li>
                            <li data-filter=".filter-pharmacies">@lang('labels.services2')</li>
                            <li data-filter=".filter-production_processes">@lang('labels.services3')</li>
                        </ul>
                    </div>
                </div>

                <div class="row portfolio-container" data-aos="fade-up">
                    <?php 

use App\Models\Gallery;
  $gallarys = Gallery::orderBy('id','desc')->get();
  foreach ($gallarys as $gallary) {  
    if ($gallary->type == 1) {
       $type = 'filter-party_activities';
    }else if ($gallary->type == 2) { 
       $type = 'filter-pharmacies';
    }else if ($gallary->type == 3) {
       $type = 'filter-production_processes';
    }else{
       $type = 'filter-spices_produced';
    }
?>
                    <div class="col-lg-4 col-md-6 portfolio-item {{ $type }}">
                        <div class="portfolio-item-inner">
                            <img src="{{ asset($gallary->photo) }}" class="img-fluid portfolio-img" alt="">
                            <div class="portfolio-info text-center">
                                <a href="{{ asset($gallary->photo) }}" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox preview-link">
                                    <i class="bi bi-arrows-fullscreen"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section><!-- End Portfolio Section -->
    </main><!-- End #main -->
    @include('includes.footer')
    @include('includes.script')
</body>
</html>
