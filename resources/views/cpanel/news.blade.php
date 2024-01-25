<!DOCTYPE html>
<html lang="en">

<head>
  <title>@lang('labels.company')  -  @lang('labels.news')</title>
  @include('includes.head')
  <link rel="stylesheet" type="text/css" href="/assets/datepicker/css/persianDatepicker-default.css">

<style type="text/css">
  .fileUpload_img {
      position: relative;
      overflow: hidden;
      top: 0px;
      text-align: center;
  }
  .fileUpload_img input.upload {
      position: absolute;
      top: 0;
      right:-20px;
      margin: 0;
      padding: 0;
      font-size: 20px;
      opacity: 0;
      filter: alpha(opacity=0);
  }
  .fileUpload_img input:hover{
    cursor: pointer;
  }

  .read-more{
    display: inline-block;
  }

</style>

</head>
<body>
  <?php $nav_news=1 ?>
  @include('includes.cpanel_header')

  <main id="main">

     <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container" dir="@lang('labels.dir')">
        <div class="d-flex justify-content-between align-items-center">
          <h2>@lang('labels.news')</h2>
          <ol>
            <li><a href="/">@lang('labels.home')</a></li>
            <li>@lang('labels.news')</li>
          </ol>
        </div>
      </div>
    </section><!-- End Breadcrumbs -->
      <div class="col-lg-12 row">
        <div>
           <br>
           <div class="loading loader2" style="width:200px;position: fixed;top: 200px;left: 100px;"> در حال حذف کردن</div>
           <div class="error-message error2" dir="rtl" style="text-align: center !important;position: fixed;top: 200px;left: 100px;">خبر حذف نشد!</div>
           <div class="sent-message success2" dir="rtl" style="text-align: center !important;position: fixed;top: 200px;left: 100px;">خبر حذف شد!</div>
        </div>
      </div>
    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up" dir="@lang('labels.dir')">

        <div class="row">

          <div class="col-lg-8 entries">
            <div class="col-lg-12 text-center">
                <img class="loader" width="100" src="/assets/img/loader.gif">
            </div>

            <div class="news_articles">
                
                  <div class="col-lg-12 row text-center add_new_news_btn" style="margin-bottom: 10px;">
                      <div>
                         <button type="button" class="btn btn-success" onclick="add_new_news()">نشر اخبار جدید</button>
                      </div>
                  </div>

                <article class='entry add_new_news_div' style="display: none;">
                      <div class='entry-img text-center'>
                        <img src='' class='img-fluid selected_news_photo'>
                      </div>
                      <h4 align="center" style="font-weight: bold;">نشر خبر</h4>

                      <form id="news_form">
                       @csrf
                      <div class="col-lg-12 row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-3">
                          <select class="form-control" onchange="get_lang_info(this.value)">
                            <option value="dr" selected>زبان دری</option>
                            <option value="ps">زبان پشتو</option>
                            <option value="en">زبان انگلیسی</option>
                          </select>
                        </div>
                        <div class="col-lg-5">
                          <input type="text" readonly required class="form-control news_date text-center" placeholder="YYYY-MM-DD">
                            <input type="hidden" name="persianDate" class="persianDate">
                            <input type="hidden" name="gregorianDate" class="gregorianDate">
                        </div>
                        
                        <div class="fileUpload_img col-lg-3">
                          <span class="btn btn-success upload_btn"> 
                             انتخاب تصویر
                          </span>
                          <input type="file" class="upload file" name="news_photo" id="news_photo" onchange="set_news_photo(this.id)">
                        </div>

                      </div>

                      <h2 class='entry-title'>
                        <div class="dr_news">
                          <label>عنوان اخبار:</label>
                          <input type="text" required name="dr_title" class="form-control" placeholder="عنوان خبر را بنویسید">
                        </div>
                        <div class="ps_news" style="display: none;">
                          <label>خبر سرلیک:</label>
                          <input type="text" name="ps_title" class="form-control" placeholder="د خبر سرلیک ولیکی">
                        </div>
                        <div class="en_news" style="display: none;">
                          <label style="float: left;direction: ltr;">News Title:</label>
                          <input type="text" dir="ltr" name="en_title" class="form-control" placeholder="write news title">
                        </div>
                      </h2>

                      <div class='entry-content'>
                        <div class="dr_news">
                            <label>محتویات  اخبار:</label>
                            <textarea class="form-control" required rows="8" name="dr_text" placeholder="محتویات اخبار را بنویسید"></textarea>
                        </div>
                        <div class="ps_news" style="display: none;">
                            <label>د خبرونه محتویات:</label>
                            <textarea class="form-control" rows="8" name="ps_text" placeholder="د خبرونه محتویات ولیکی"></textarea>
                        </div>
                        <div class="en_news" style="display: none;">
                            <label style="float: left;direction: ltr;">News Detail:</label>
                            <textarea dir="ltr" class="form-control" rows="8" name="en_text" placeholder="write news details"></textarea>
                        </div>
                      </div>
                       <div class="col-lg-12 row text-center">
                            <div>
                                <br>
                                <div class="loading loader1" style="width:200px;margin: 0 auto;margin-bottom: 10px;"> در حال نشر شدن</div>
                                <div class="error-message error1" dir="rtl" style="text-align: center !important; margin-bottom: 10px;">خبر نشر نشد!</div>
                                <div class="sent-message success1" dir="rtl" style="text-align: center !important; margin-bottom: 10px;">خبر موفقانه نشر شد!</div>
                                <button type="submit" class="btn btn-success">نشر خبر</button>
                                <button type="button" class="btn btn-primary" onclick="add_new_news()">لغو نشر</button>
                            </div>
                        </div>
                        </form>
                </article>

                <article class='entry update_news_div' style="display: none;">
                      <div class='entry-img text-center'>
                        <img src='' class='img-fluid selected_update_news_photo'>
                      </div>
                      <h4 align="center" style="font-weight: bold;">اصلاح خبر</h4>
                      <form id="update_news_form">
                       @csrf
                       <input type="hidden" name="news_id" class="news_id">
                      <div class="col-lg-12 row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-3">
                          <select class="form-control" onchange="get_update_lang_info(this.value)">
                            <option value="dr" selected>زبان دری</option>
                            <option value="ps">زبان پشتو</option>
                            <option value="en">زبان انگلیسی</option>
                          </select>
                        </div>
                        <div class="col-lg-5">
                          <input type="text" readonly required class="form-control update_news_date text-center" placeholder="YYYY-MM-DD">
                            <input type="hidden" name="persianDate" class="persianDate">
                            <input type="hidden" name="gregorianDate" class="gregorianDate">
                        </div>
                        
                        <div class="fileUpload_img col-lg-3">
                          <span class="btn btn-success upload_btn"> 
                             انتخاب تصویر
                          </span>
                          <input type="file" class="upload file" name="update_news_photo" id="update_news_photo" onchange="set_update_news_photo(this.id)">
                        </div>

                      </div>

                      <h2 class='entry-title'>
                        <div class="dr_update_news">
                          <label>عنوان اخبار:</label>
                          <input type="text" required name="dr_title" class="form-control" placeholder="عنوان خبر را بنویسید">
                        </div>
                        <div class="ps_update_news" style="display: none;">
                          <label>خبر سرلیک:</label>
                          <input type="text" name="ps_title" class="form-control" placeholder="د خبر سرلیک ولیکی">
                        </div>
                        <div class="en_update_news" style="display: none;">
                          <label style="float: left;direction: ltr;">News Title:</label>
                          <input type="text" dir="ltr" name="en_title" class="form-control" placeholder="write news title">
                        </div>
                      </h2>

                      <div class='entry-content'>
                        <div class="dr_update_news">
                            <label>محتویات  اخبار:</label>
                            <textarea class="form-control" required rows="8" name="dr_text" placeholder="محتویات اخبار را بنویسید"></textarea>
                        </div>
                        <div class="ps_update_news" style="display: none;">
                            <label>د خبرونه محتویات:</label>
                            <textarea class="form-control" rows="8" name="ps_text" placeholder="د خبرونه محتویات ولیکی"></textarea>
                        </div>
                        <div class="en_update_news" style="display: none;">
                            <label style="float: left;direction: ltr;">News Detail:</label>
                            <textarea dir="ltr" class="form-control" rows="8" name="en_text" placeholder="write news details"></textarea>
                        </div>
                      </div>
                       <div class="col-lg-12 row text-center">
                            <div>
                                <br>
                                <div class="loading loader3" style="width:200px;margin: 0 auto;margin-bottom: 10px;"> در حال اصلاح شدن</div>
                                <div class="error-message error3" dir="rtl" style="text-align: center !important; margin-bottom: 10px;">خبر اصلاح نشد!</div>
                                <div class="sent-message success3" dir="rtl" style="text-align: center !important; margin-bottom: 10px;">خبر موفقانه اصلاح شد!</div>
                                <button type="submit" class="btn btn-success">اصلاح  خبر</button>
                                <button type="button" class="btn btn-primary" onclick="cancel_update_new_news()">لغو اصلاح</button>
                            </div>
                        </div>
                        </form>
                </article>
            </div>


            <div class="news_articles news_list"></div>
<?php 
 use App\Models\News;
 $count = News::count();
?>
            <div class="blog-pagination">
              <ul class="justify-content-center">
<?php 
$counter = 1;
  for ($i=1; $i <= $count ; $i++) { 
    if ($counter == 1) {
      $active = 'active';
    }else{
      $active = '';
    }
  if ($i % 5 == 0) {
?>
                <li class="pagination <?= $active ?>" id='{{$counter}}' onclick='get_latest_news(this.id);'><a href="#">{{$counter}}</a></li>
<?php $counter++; }}
  if ($count % 5 != 0) {
?>
                <li class="pagination" id='{{$counter}}' onclick='get_latest_news(this.id);'><a href="#">{{$counter}}</a></li>
<?php } ?>
              </ul>
            </div>

          </div><!-- End blog entries list -->

          <div class="col-lg-4">
            <div class="sidebar">

              <h3 class="sidebar-title">@lang('labels.search')</h3>
              <div class="sidebar-item search-form" dir="ltr">
                <form action="">
                  <input type="text" style="font-size: 13px;" dir="@lang('labels.dir')" placeholder="@lang('labels.search')" id="search_input">
                  <button type="button" onclick="search_news()"><i class="bi bi-search"></i></button>
                </form>
              </div><!-- End sidebar search formn-->

              <h3 class="sidebar-title search_title" style="display: none;">@lang('labels.search_result')</h3>
                <div class="col-lg-12 text-center">
                    <img class="search_loader" style="display: none;" width="30" src="/assets/img/loader.gif">
                </div>
              <div class="sidebar-item recent-posts search_result" style="display: none;">
              </div>

              <h3 class="sidebar-title">@lang('labels.recent_news')</h3>
              <div class="sidebar-item recent-posts recent-news">
              </div><!-- End sidebar recent posts-->
            </div><!-- End sidebar -->
          </div><!-- End blog sidebar -->
        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->

 @include('includes.footer')
 @include('includes.script')
<script type="text/javascript" src='/assets/datepicker/js/persianDatepicker.min.js'></script>
</body>


<script type="text/javascript">
  $(document).ready(function () {
    load_news(0,10);

    $("#news_form").on('submit', function (e) {
          e.preventDefault();
          var flage = true;
          if (flage) {

              $('.loader1').show();
             $.ajax({
                  url: "/add_news",
                  type: 'POST',
                  contentType: false,
                  cache: false,
                  processData: false,
                  data: new FormData(this),
                  success: function (data) {
                    if (Number(data) == 1) {
                        $('.success1').slideDown();
                        setTimeout(function () {
                          add_new_news();
                          load_news(0,10);
                        },1000);
                    }else{
                        $('.error1').slideDown();
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

    $("#update_news_form").on('submit', function (e) {
          e.preventDefault();
          var flage = true;
          if (flage) {

              $('.loader3').show();
             $.ajax({
                  url: "/update_news",
                  type: 'POST',
                  contentType: false,
                  cache: false,
                  processData: false,
                  data: new FormData(this),
                  success: function (data) {
                    if (Number(data) == 1) {
                        $('.success3').slideDown();
                        setTimeout(function () {
                          cancel_update_new_news();
                          load_news(0,10);
                        },1000);
                    }else{
                        $('.error3').slideDown();
                    }
                    setTimeout(function () { $('.sent-message, .error-message').slideUp(); },5000);
                    $('.loader3').hide();
                  },error: function (jqXHR, textStatus, errorThrown) {
                      $('.error3').slideDown().text(errorThrown);
                      $('.loader3').hide();
                      setTimeout(function () { $('.sent-message, .error-message').slideUp(); },5000);
                  }
              }); 
          }
    });
  });
 
  function load_news(min,max) {
    $('.loader').show();
    $('.news_list, .recent-news').html('');
    $.ajax({
        url: "/get_latest_news_for_update", 
        type: 'POST',
        data:{min:min,max:max},
          'headers': {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (data) {
          data = JSON.parse(data);
          // console.log(data);

          for (var i = 0; i < data.length; i++) {
            if (i < 5) {
              $('.news_list').append("<article class='entry news_div_"+i+"'><div class='entry-img'>"+
                  "<img src='/assets/img/news/"+data[i].photo+"' alt='' class='img-fluid'></div>"+
                  "<h2 class='entry-title'><a href='/view_news_detials/"+data[i].id+"'>"+data[i].title+"</a></h2>"+
                "<div class='entry-meta'>"+
                  "<ul>"+
                    "<li class='d-flex align-items-center'> <i class='bi bi-person'></i> &nbsp; <a href='/view_news_detials/"+data[i].id+"'>"+data[i].last_person_commented+"</a></li>"+
                    "<li class='d-flex align-items-center'>&nbsp;&nbsp;&nbsp;<i class='bi bi-clock'></i> &nbsp; <a href='/view_news_detials/"+data[i].id+"'><time>"+data[i].news_date+"</time></a></li>"+
                    "<li class='d-flex align-items-center'><i class='bi bi-chat-dots'></i> &nbsp; <a href='/view_news_detials/"+data[i].id+"'>"+data[i].comments_amount+" @lang('labels.comments')</a></li>"+
                  "</ul>"+
                "</div>"+
                "<div class='entry-content'>"+
                  "<p>"+data[i].text+"</p>"+
                  "<div class='read-more row col-lg-4 text-center'>"+
                    "<div>"+
                      "<a href='/view_news_detials/"+data[i].id+"'>@lang('labels.read_more')</a>"+
                    "</div>"+
                  "</div>"+

                  "<div class='read-more row col-lg-4 text-center'>"+
                    "<div>"+
                      "<button type='button' class='btn btn-primary' id='"+data[i].id+":"+data[i].photo+":"+data[i].p_date+":"+data[i].g_date+":"+data[i].dr_title+":"+data[i].ps_title+":"+data[i].en_title+":"+data[i].dr_text+":"+data[i].ps_text+":"+data[i].en_text+"' onclick='update_news(this.id)'><i class='bi bi-pencil-square'></i> اصلاح خبر</button>"+
                    "</div>"+
                  "</div>"+

                  "<div class='read-more row col-lg-4 text-center'>"+
                    "<div>"+
                      "<button type='button' class='btn btn-danger' id='"+data[i].id+"' onclick='delete_news(this.id,"+i+")'><i class='bi bi-trash'></i> حذف خبر</button>"+
                    "</div>"+
                  "</div>"+
                
                "</div>"+
              "</article>");
          }

            if (i >= 5) {
              $('.recent-news').append("<div class='post-item clearfix'>"+
                  "<img src='/assets/img/news/"+data[i].photo+"' alt=''>"+
                  "<h4><a href='/view_news_detials/"+data[i].id+"'>"+data[i].title+"</a></h4>"+
                  "<time>"+data[i].news_date+"</time></div>"); 
            }
          }
          $('.loader').hide();
        },error: function (jqXHR, textStatus, errorThrown) {
          // load_news(min,max);
        }
    }); 
  }

  function get_latest_news(id) {
    var number = Number(id);
    $('.pagination').removeClass('active');
    $('#'+id).addClass('active');
    if (number == 1) {
      load_news(0,10);
    }else if (number == 2) {
      load_news(5,10);
    }else if (number == 3) {
      load_news(10,15);
    }else if (number == 4) {
      load_news(15,20);
    }else if (number == 5) {
      load_news(20,25);
    }
  }

  function search_news() {
    var value = $('#search_input').val();
    $('.search_loader,.search_title, .search_result').show();
    $('.search_result').html('');
    $.ajax({
        url: "/search_news", 
        type: 'POST',
        data:{value:value},
          'headers': {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (data) {
          data = JSON.parse(data);
          if (data.length == 0) {
            $('.search_result').append("<div class='post-item clearfix text-center' style='color:red;'>@lang('labels.empty')<h4></h4></div>");
          }else{
            for (var i = 0; i < data.length; i++) {
                $('.search_result').append("<div class='post-item clearfix'>"+
                    "<img src='/assets/img/news/"+data[i].photo+"' alt=''>"+
                    "<h4><a href='/view_news_detials/"+data[i].id+"'>"+data[i].title+"</a></h4>"+
                    "<time>"+data[i].news_date+"</time></div>");
            }
          }
          $('.search_loader').hide();
        },error: function (jqXHR, textStatus, errorThrown) {
          search_news();
        }
    }); 
  }

  function get_lang_info(lang) {
    if (lang == 'dr') {
      $('.dr_news').show();
      $('.ps_news, .en_news').hide();
    }else if (lang == 'ps') {
      $('.ps_news').show();
      $('.dr_news, .en_news').hide();
    }else{
      $('.en_news').show();
      $('.ps_news, .dr_news').hide();
    }
  }

  function get_update_lang_info(lang) {
    if (lang == 'dr') {
      $('.dr_update_news').show();
      $('.ps_update_news, .en_update_news').hide();
    }else if (lang == 'ps') {
      $('.ps_update_news').show();
      $('.dr_update_news, .en_update_news').hide();
    }else{
      $('.en_update_news').show();
      $('.ps_update_news, .dr_update_news').hide();
    }
  }

  function set_news_photo() {

    var file    = document.getElementById('news_photo').files[0];
    var reader  = new FileReader();
    reader.addEventListener("load", function () {
       if(file.size < 2048576){
          $('.selected_news_photo').attr('src',reader.result);
        }else{
          var totalSize =  ((file.size/1024)/1024).toString().slice(0,4)+' MB';
          alert(totalSize);
        }
    }, false);
    if (file) {
      reader.readAsDataURL(file);
    }
  } 

  function set_update_news_photo() {

    var file    = document.getElementById('update_news_photo').files[0];
    var reader  = new FileReader();
    reader.addEventListener("load", function () {
       if(file.size < 2048576){
          $('.selected_update_news_photo').attr('src',reader.result);
        }else{
          var totalSize =  ((file.size/1024)/1024).toString().slice(0,4)+' MB';
          alert(totalSize);
        }
    }, false);
    if (file) {
      reader.readAsDataURL(file);
    }
  } 

  function add_new_news() {
    $('.add_new_news_btn').slideToggle();
    $('.add_new_news_div').slideToggle();
  }

  function delete_news(id,counter) {

    if (confirm('آیا مطمین هستید که خبر حذف شود؟')) {
        $('.loader2').show();
        $.ajax({
            url: "/delete_delete_news", 
            type: 'POST',
            data:{id:id},
              'headers': {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
              if (Number(data) == 1) {
                  $('.success2').slideDown(); 
                  $('.news_div_'+counter).remove();
              }else{
                  $('.error2').slideDown();
              }
              setTimeout(function () { $('.sent-message, .error-message').slideUp(); },5000);
              $('.loader2').hide();
            }
        }); 
      }
  }

  function update_news(data) {
    var part = data.split(':');
    var id = part[0];
    var photo = part[1];
    var p_date = part[2];
    var g_date = part[3];
    var dr_title = part[4];
    var ps_title = part[5];
    var en_title = part[6];
    var dr_text = part[7];
    var ps_text = part[8];
    var en_text = part[9];

    $('.news_id').val(id);
    $('.selected_update_news_photo').attr('src','assets/img/news/'+photo);

    $('.update_news_date').val(p_date+' / '+g_date);
    $('.persianDate').val(p_date);
    $('.gregorianDate').val(g_date);

    $('.dr_update_news input').val(dr_title);
    $('.ps_update_news input').val(ps_title);
    $('.en_update_news input').val(en_title);

    $('.dr_update_news textarea').val(dr_text);
    $('.ps_update_news textarea').val(ps_text);
    $('.en_update_news textarea').val(en_text);


    $('.add_new_news_btn').slideToggle();
    $('.update_news_div').slideDown();
    setTimeout(function () {
      $("html, body").animate({ scrollTop: '10px' }, 100);
    },500);
  }

  function cancel_update_new_news() {
    $('.update_news_div').slideUp();
    $('.add_new_news_btn').slideToggle();
  }

  $('.news_date').persianDatepicker({
      formatDate: "YYYY-0M-0D",
      selectedBefore: !0, 
        isRTL:!0,
         calendarPosition: {
            x: 6,
            y: 0,
        },
        onSelect: function () {
            var gregorianDate = $(".news_date").attr("data-gdate");
            var persianDate = $('.news_date').val();
            $('.news_date').val(persianDate+' / '+gregorianDate);

            $('.gregorianDate').val(gregorianDate);
            $('.persianDate').val(persianDate);
        }
  });

  $('.update_news_date').persianDatepicker({
      formatDate: "YYYY-0M-0D",
      selectedBefore: !0, 
        isRTL:!0,
         calendarPosition: {
            x: 6,
            y: 0,
        },onSelect: function () {
            var gregorianDate = $(".update_news_date").attr("data-gdate");
            var persianDate = $('.update_news_date').val();
            $('.update_news_date').val(persianDate+' / '+gregorianDate);

            $('.gregorianDate').val(gregorianDate);
            $('.persianDate').val(persianDate);
        }
  });

</script>

</html>