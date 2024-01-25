<!DOCTYPE html>
<html lang="en">

<head>
  <title>@lang('labels.company')  -  @lang('labels.news')</title>
  @include('includes.head')
</head>
<body>
  <?php $nav_news=1; ?>
  @include('includes.header')

  <main id="main">

     <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container" dir="@lang('labels.dir')">
        <div class="d-flex justify-content-between align-items-center">
          <h2>@lang('labels.news')</h2>
          <!-- <h5 style="color: #fff;">@lang('labels.slogen')</h5> -->
          <ol>
            <li><a href="/">@lang('labels.home')</a></li>
            <li>@lang('labels.news')</li>
          </ol>
        </div>
      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up" dir="@lang('labels.dir')">

        <div class="row">

          <div class="col-lg-8 entries">
            <div class="col-lg-12 text-center">
                <img class="loader" width="100" src="/assets/img/loader.gif">
            </div>
            <div class="news_articles">
              
            </div>

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
                <!-- <div class="post-item clearfix">
                  <img src="assets/img/news/blog-recent-1.jpg" alt="">
                  <h4><a href="/news_details/">Nihil blanditiis at in nihil autem</a></h4>
                  <time>Jan 1, 2020</time>
                </div> -->
              </div><!-- End sidebar recent posts-->
            </div><!-- End sidebar -->
          </div><!-- End blog sidebar -->
        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->

 @include('includes.footer')
 @include('includes.script')
</body>


<script type="text/javascript">
  $(document).ready(function () {
    load_news(0,10);
  });
 
  function load_news(min,max) {
    $('.loader').show();
    $('.news_articles, .recent-news').html('');
    $.ajax({
        url: "/get_latest_news", 
        type: 'POST',
        data:{min:min,max:max},
          'headers': {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (data) {
          data = JSON.parse(data);
          console.log(data);

          for (var i = 0; i < data.length; i++) {
            if (i < 5) {
              $('.news_articles').append("<article class='entry'><div class='entry-img'>"+
                  "<img src='/assets/img/news/"+data[i].photo+"' alt='' class='img-fluid'></div>"+
                  "<h2 class='entry-title'><a href='/news_details/"+data[i].id+"'>"+data[i].title+"</a></h2>"+
                "<div class='entry-meta'>"+
                  "<ul>"+
                    "<li class='d-flex align-items-center'> <i class='bi bi-person'></i> &nbsp; <a href='/news_details/"+data[i].id+"'>"+data[i].last_person_commented+"</a></li>"+
                    "<li class='d-flex align-items-center'>&nbsp;&nbsp;&nbsp;<i class='bi bi-clock'></i> &nbsp; <a href='/news_details/"+data[i].id+"'><time>"+data[i].news_date+"</time></a></li>"+
                    "<li class='d-flex align-items-center'><i class='bi bi-chat-dots'></i> &nbsp; <a href='/news_details/"+data[i].id+"'>"+data[i].comments_amount+" @lang('labels.comments')</a></li>"+
                  "</ul>"+
                "</div>"+
                "<div class='entry-content'>"+
                  "<p>"+data[i].text+"</p>"+
                  "<div class='read-more'>"+
                    "<a href='/news_details/"+data[i].id+"'>@lang('labels.read_more')</a>"+
                  "</div>"+
                "</div>"+
              "</article>");
          }

            if (i >= 5) {
              $('.recent-news').append("<div class='post-item clearfix'>"+
                  "<img src='/assets/img/news/"+data[i].photo+"' alt=''>"+
                  "<h4><a href='/news_details/"+data[i].id+"'>"+data[i].title+"</a></h4>"+
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