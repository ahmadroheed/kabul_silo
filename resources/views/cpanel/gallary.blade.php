<!DOCTYPE html>
<html lang="en">

<head>
  <title>@lang('labels.company')  -  @lang('labels.gallary')</title>
  @include('includes.head')
<style type="text/css">
  .fileUpload_img {
      position: relative;
      overflow: hidden;
      top: 0px;
      text-align: center;
  }
  .fileUpload_img input.upload {
      position: absolute;
      top: 9;
      right:-40px;
      margin: 0;
      padding: 0;
      font-size: 20px;
      opacity: 0;
      filter: alpha(opacity=0);
  }
  .fileUpload_img input:hover{
    cursor: pointer;
  }
    .bi-x-circle{
      font-size:25px;
      color: red;
      position: absolute;
      margin: 10px;
      cursor: pointer;
    }
</style>
</head>
<body>
  <?php $nav_gallary=1 ?>
  @include('includes.cpanel_header')

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container" dir="@lang('labels.dir')">
        <div class="d-flex justify-content-between align-items-center">
          <h2>@lang('labels.gallary')</h2>
          <ol>
            <li><a href="/update">@lang('labels.home')</a></li>
            <li>@lang('labels.gallary')</li>
          </ol>
        </div>
      </div>
    </section><!-- End Breadcrumbs -->

    <div class="col-lg-12 row">
              <div>
                <br>
                <div class="loading loader2" style="width:200px;position: fixed;top: 200px;left: 100px;z-index: 9999999;"> در حال حذف کردن</div>
                <div class="error-message error2" dir="rtl" style="text-align: center !important;position: fixed;top: 200px;left: 100px;z-index: 9999999;">تصویر حذف نشد!</div>
                <div class="sent-message success2" dir="rtl" style="text-align: center !important;position: fixed;top: 200px;left: 100px;z-index: 9999999;">تصویر حذف شد!</div>
              </div>
            </div>

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container" dir="rtl">

          <form id="photo_form">
           @csrf
          <div class="col-lg-12 row">
             <div class="col-lg-3"></div>
             <div class="col-lg-3">
              <label>نوعیت تصویر</label>
              <select class="form-control" name="type" required>
                <option value="1">@lang('labels.services1')</option>
                <option value="2">@lang('labels.services2')</option>
                <option value="3">@lang('labels.services3')</option>
              </select>
            </div>

            <div class="fileUpload_img col-lg-2">
              <br>
               <span class="btn btn-primary upload_btn"> 
                  انتخاب تصویر
               </span>
               <input type="file" class="upload file" name="photo" required>
            </div>
          </div>
          <div class="col-lg-12 row text-center">
              <div>
                  <br>
                  <div class="loading loader1" style="width:150px;margin: 0 auto;margin-bottom: 10px;"> در حال ثبت</div>
                  <div class="error-message error1" dir="rtl" style="text-align: center !important; margin-bottom: 10px;">تصویر ثبت نشد!</div>
                  <div class="sent-message success1" dir="rtl" style="text-align: center !important; margin-bottom: 10px;">تصویر ثبت شد!</div>
                  <button type="submit" class="btn btn-success">ثبت تصویر</button>
              </div>
          </div>
          </form>
        
        <div class="col-lg-12 row"><br></div>

        <div class="row" data-aos="fade-up">
          <hr>
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

use App\Models\Gallary;
  $gallarys = Gallary::orderBy('id','desc')->get();
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
          <div class="col-lg-4 col-md-6 portfolio-item {{$type}} photo_{{$gallary->id}}">
            <i class="bi bi-x-circle" id="{{$gallary->id}}" onclick="delete_galary_photo(this.id)"></i>
            <img src="/assets/img/gallary/{{$gallary->photo}}" class="img-fluid" alt="">
            <div class="portfolio-info text-center">
              <a href="/assets/img/gallary/{{$gallary->photo}}" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link">
                <i class="bi bi-arrows-fullscreen"></i>
              </a>
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

<script type="text/javascript">
  $(document).ready(function () {
   $("#photo_form").on('submit', function (e) {
          e.preventDefault();
          var flage = true;
          if (flage) {

              $('.loader1').show();
             $.ajax({
                  url: "/save_photo_gallary",
                  type: 'POST',
                  contentType: false,
                  cache: false,
                  processData: false,
                  data: new FormData(this),
                  success: function (data) {
                    if (Number(data) == 1) {
                        $('.success1').slideDown();
                    }else if (Number(data) == 2) {
                        $('.error1').slideDown().text('تصویر را انتخاب نکردید!');
                    }else{
                        $('.error1').slideDown().text('تصویر ثبت نشد!');
                    }
                    setTimeout(function () { $('.sent-message, .error-message').slideUp(); },5000);
                    $('.loader1').hide();
                  },error: function (jqXHR, textStatus, errorThrown) {
                      $('.error1').slideDown().text(errorThrown);
                      $('.loader1').hide();
                      setTimeout(function () { $('.sent-message, .error-message').slideUp(); },5000);
                  }
              }); 
          }
    });
});


  function delete_galary_photo(id) {
    if (confirm('آیا مطمین هستید که تصویر حذف شود؟')) {
      $('.loader2').show();
      $.ajax({
          url: "/delete_galary_photo", 
          type: 'POST',
          data:{id:id},
            'headers': {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          success: function (data) {
            if (Number(data) == 1) {
                $('.success2').slideDown(); 
                $('.photo_'+id).remove();
            }else{
                $('.error2').slideDown();
            }
            setTimeout(function () { $('.sent-message, .error-message').slideUp(); },5000);
            $('.loader2').hide();
          }
      }); 
    }
  }

</script>

</html>