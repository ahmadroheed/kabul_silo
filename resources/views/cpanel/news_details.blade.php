<!DOCTYPE html>
<html lang="en">
<?php 
use App\Models\News;

$news = News::where('id',decrypt($id))->first();
  if (App::isLocale('en')) {
     $title = $news->en_title;
     $text = $news->en_text;

    $news_date = date_format(date_create($news->gregorian_date),'M d, Y');
  }else if (App::isLocale('dr')) {
     $title = $news->dr_title;
     $text = $news->dr_text;

      $day = substr($news->persian_date,8,2);
      $month = toMonth(substr($news->persian_date,5,2));
      $year = substr($news->persian_date,0,4);
      $news_date = $day.' '.$month.', '.$year;
  }else{
     $title = $news->ps_title;
     $text = $news->ps_text;

    $day = substr($news->persian_date,8,2);
    $month = toMonth(substr($news->persian_date,5,2));
    $year = substr($news->persian_date,0,4);
    $news_date = $day.' '.$month.', '.$year;
  }
?>
<head>
  <title>@lang('labels.company')  -  @lang('labels.news_details')</title>
  @include('includes.head')
    <style type="text/css">
      #whatsapp_btn{
        margin-top: -7px;
        line-height:0;
        font-weight: 600;
        height:29px;
        background-color: #1bbd36 !important;
        border-color: #1bbd36 !important;
      }

      #whatsapp_btn a{
        font-size:13px;
        color: #fff;
      }
    </style>
</head>
<body>
  <?= $nav_news=1 ?>
  @include('includes.cpanel_header')

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container" dir="@lang('labels.dir')">
        <div class="d-flex justify-content-between align-items-center">
          <h2>@lang('labels.news_details')</h2>
          <ol>
            <li><a href="/">@lang('labels.home')</a></li>
            <li><a href="/news">@lang('labels.news')</a></li>
            <li>@lang('labels.news_details')</li>
          </ol>
        </div>
      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up" dir="@lang('labels.dir')">
<?php 
use App\Models\Comments;
function toMonth($value){
        switch ($value) {
            case 1:
                $month = 'حمل';
                break;
            case 2:
                $month = 'ثور';
                break;
            case 3:
                $month = 'جوزا';
                break;
            case 4:
                $month = 'سرطان';
                break;
            case 5:
                $month = 'اسد';
                break;
            case 6:
                $month = 'سنبله';
                break;
            case 7:
                $month = 'میزان';
                break;
            case 8:
                $month = 'عقرب';
                break;
            case 9:
                $month = 'قوس';
                break;
            case 10:
                $month = 'جدی';
                break;
            case 11:
                $month = 'دلو';
                break;
            case 12:
                $month = 'حوت';
                break;     
        }
        return $month;
}

 function localize_diff($diff)
 {
        if (App::isLocale('en')) { // en
            return $diff;
        }else{ // dr

            $num = (int) filter_var($diff, FILTER_SANITIZE_NUMBER_INT);
            if (strpos($diff, 'second') !== false) {
                $diff = "ثانیه";
            }else if (strpos($diff, 'minets') !== false) {
                $diff = "دقیقه";
            }else if (strpos($diff, 'huers') !== false) {
                $diff = "ساعت";
            }else if (strpos($diff, 'days') !== false) {
                $diff = "روز";
            }else if (strpos($diff, 'week') !== false) {
                $diff = "هفته";
            }else if (strpos($diff, 'month') !== false) {
                $diff = "ماه";
            }else if (strpos($diff, 'year') !== false) {
                $diff = "سال";
            }

            return $num.$diff.' قبل';
        }
 }
?>
        <div class="row">

          <div class="col-lg-8 entries">

            <article class="entry entry-single">

              <div class="entry-img">
                <img src="/assets/img/news/{{$news->photo}}" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a>{{$title}}</a>
              </h2>

              <div class="entry-meta"> 
                <ul>
                    <li class='d-flex align-items-center'> <i class='bi bi-person'></i> &nbsp; <a>{{$news->last_person_commented}}</a></li>
                    <li class='d-flex align-items-center'>&nbsp;&nbsp;&nbsp;<i class='bi bi-clock'></i> &nbsp; <a><time>{{$news_date}}</time></a></li>
                    <li class='d-flex align-items-center'><i class='bi bi-chat-dots'></i> &nbsp; <a>{{$news->comments_amount}} @lang('labels.comments')</a></li>
                  </ul>
              </div>

              <div class="entry-content">
                <p>{{$text}}</p>
              </div>

            </article><!-- End blog entry -->

            <div class="blog-comments">

              <h4 class="comments-count">{{$news->comments_amount}} @lang('labels.comments')</h4>
<?php 
  $info = Comments::where('news_id', decrypt($id))->orderBy('created_at','asc')->get();
  foreach ($info as $info) {
?>
              <div class="comment">
                <div class="d-flex">
                  <div>
                    <h5><a>{{$info->name}}</a></h5>
                    <time dir="ltr">{{ $info->created_at->format('d  M, Y') }} | {{ $info->created_at->diffForHumans() }}</time>
                    <p>
                     {{ $info->comment }}
                    </p>
                  </div>
                </div>
              </div><!-- End comment #1 -->
<?php } ?>

            </div><!-- End blog comments -->

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
              <div class="sidebar-item recent-posts">
<?php 

$info = News::where('id', '!=' ,decrypt($id))->orderBy('id','desc')->limit(5)->get();
foreach ($info as $news) {
  if (App::isLocale('en')) {
     $title = $news->en_title;

    $news_date = date_format(date_create($news->gregorian_date),'M d, Y');
  }else if (App::isLocale('dr')) {
     $title = $news->dr_title;
      $day = substr($news->persian_date,8,2);
      $month = toMonth(substr($news->persian_date,5,2));
      $year = substr($news->persian_date,0,4);
      $news_date = $day.' '.$month.', '.$year;
  }else{
     $title = $news->ps_title;
    $day = substr($news->persian_date,8,2);
    $month = toMonth(substr($news->persian_date,5,2));
    $year = substr($news->persian_date,0,4);
    $news_date = $day.' '.$month.', '.$year;
  }

?>
                <div class="post-item clearfix">
                  <img src="/assets/img/news/{{$news->photo}}" alt="">
                  <h4><a href="/news_details/{{encrypt($news->id)}}">{{$title}}</a></h4>
                  <time>{{$news_date}}</time>
                </div>
<?php } ?>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Blog Single Section -->

  </main><!-- End #main -->

 @include('includes.footer')
 @include('includes.script')
</body>
  
  <script type="text/javascript">
  $(document).ready(function () {
      
    var char = new RegExp("-|,|_|/|=");
      var char2 = new RegExp("@|#|;|'");
        var number = /\d/;

    $("#comment_form").on('submit', function (e) {
          e.preventDefault();
          var flage = true;

          var flage = true;

        var name = $('.name').val();
        if (name.toString().trim() == '' || char.test(name) || char2.test(name) || number.test(name)) {
              flage = false;
              $('.name').css('borderColor','red');
          }else{
              $('.name').css('borderColor','#eee');
          }

      var email = $('.contact').val();
          var mailFormat = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})|([0-9]{10})+$/;
          if (!mailFormat.test(email)) {
              flage = false;
              $('.contact').css('borderColor','red');
          }else{
              $('.contact').css('borderColor','#eee');
          }

          var text = $('.msg').val();
        if (text.toString().trim() == '' || char.test(text) || char2.test(text)) {
              flage = false;
              $('.msg').css('borderColor','red');
          }else{
              $('.msg').css('borderColor','#eee');
          }

          if (flage) {
              $('.loading').show();
             $.ajax({
                  url: "/save_comments",
                  type: 'POST',
                  contentType: false,
                  cache: false,
                  processData: false,
                  data: new FormData(this),
                  success: function (data) {
                    if (Number(data) == 1) {
                      $('.sent-message').slideDown();
                      $("#comment_form")[0].reset();
                    }else{
                      $('.error-message').slideDown();
                    }
                    setTimeout(function () { $('.sent-message, .error-message').slideUp(); },5000);
                    $('.loading').hide();
                  },error: function (jqXHR, textStatus, errorThrown) {
                      $('.error-message').slideDown().text(errorThrown);
                    $('.loading').hide();
                    setTimeout(function () { $('.sent-message, .error-message').slideUp(); },5000);
                  }
              }); 
          }
      });
  });



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
                    "<h4><a href='/news_details/"+data[i].id+"'>"+data[i].title+"</a></h4>"+
                    "<time>"+data[i].news_date+"</time></div>");
            }
          }
          $('.search_loader').hide();
        },error: function (jqXHR, textStatus, errorThrown) {
          search_news();
        }
    }); 
  }


</script>


</html>