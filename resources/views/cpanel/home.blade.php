<!DOCTYPE html>
<html lang="en">
 
<head>
  <title>@lang('labels.company')  - @lang('labels.home')</title>
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
	    top: 0;
	    right: 0;
	    margin: 0;
	    padding: 0;
	    font-size: 20px;
	    cursor: pointer;
	    opacity: 0;
	    filter: alpha(opacity=0);
	}
	.fileUpload_img input:hover{
	  cursor: pointer;
	}
  </style> 
</head>
<body>
  <?php $nav_home=1 ?>
  @include('includes.cpanel_header') 
 
  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel"  data-bs-interval="50000" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <!-- Sliders -->
      <div class="carousel-inner" role="listbox">

<?php 

use App\Models\Sliders;	
 $sliders = Sliders::orderBy('id','asc')->get();
 $counter = 1;
 foreach ($sliders as $slider) {
 	if ($counter == 1) {
 		$active = 'active';
 	}else{
 		$active = '';
 	}
	$counter = 2;
?>
        <!-- Slide 1 -->
        <div class="carousel-item {{$active}} slider_file_{{$slider->id}}" style="background-image: url(assets/img/slide/{{$slider->photo}});">
          <div class="carousel-container" dir="@lang('labels.dir')">
            <div class="carousel-content animate__animated animate__fadeInUp">
            	<form id="slider_form_{{$slider->id}}">
            		@csrf
            		<input type="hidden" name="id" value="{{$slider->id}}">
	            	<div class="col-lg-12 row">
	            		<div class="col-lg-3">
	              			<select class="form-control" name="lang" id="{{$slider->id}}" onchange="get_lang_info(this.value,this.id)">
	              				<option value="dr" selected>زبان دری</option>
	              				<option value="ps">زبان پشتو</option>
	              				<option value="en">زبان انگلیسی</option>
	              			</select>
	            		</div>
	            		<div class="col-lg-6">
	              			<input type="text" name="dr_title_{{$slider->id}}" class="form-control slider_dr_title_{{$slider->id}}" placeholder="@lang('labels.slidertitle')" value="{{$slider->dr_title}}">

	              			<input type="text" name="ps_title_{{$slider->id}}" style="display: none;" class="form-control slider_ps_title_{{$slider->id}}" placeholder="عنوان سلایدر را به زبان پشتو بنوسید" value="{{$slider->ps_title}}">

	              			<input type="text" name="en_title_{{$slider->id}}" style="display: none;" class="form-control slider_en_title_{{$slider->id}}" dir="ltr" placeholder="write slider title" value="{{$slider->en_title}}">
	            		</div>
	            		  <div class="fileUpload_img col-lg-3">
      						    <span class="btn btn-success upload_btn"> 
      						       انتخاب عکس
      						    </span>
      						    <input type="file" class="upload file" id="slider_file_{{$slider->id}}" name="slider_photo_{{$slider->id}}" onchange="slider_images(this.id)">
      						  </div>
	            	</div>
	            	<br>
	              	<textarea class="form-control slider_dr_text_{{$slider->id}}" name="dr_text_{{$slider->id}}" rows="4" placeholder="@lang('labels.slidertext')">{{$slider->dr_text}}</textarea>

	              	<textarea style="display: none;" class="form-control slider_ps_text_{{$slider->id}}" name="ps_text_{{$slider->id}}" rows="4" placeholder="متن سلایدر را به زبان پشتو بنوسید">{{$slider->ps_text}}</textarea>

	              	<textarea dir="ltr" style="display: none;" class="form-control slider_en_text_{{$slider->id}}" name="en_text_{{$slider->id}}" rows="4" placeholder="write slider text">{{$slider->en_text}}</textarea>

	              <div class="text-center"><br>
	              	<div class="loading" style="background-color: black; width:150px;margin: 0 auto;margin-bottom: 10px;"> در حال اصلاح</div>
                    <div class="error-message" style="text-align: center !important; margin-bottom: 10px;">سلایدر اصلاح نشد!</div>
                    <div class="sent-message" style="text-align: center !important; margin-bottom: 10px;">سلایدر اصلاح شد!</div>
	              	<button type="submit" class="btn btn-success">ثبت تغییرات</button>
	              </div>
              </form>
            </div>
          </div>
        </div>
<?php } ?>
      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
    </div>
  </section><!-- End Hero -->

  <main id="main">

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

$note = " با نوشتن این علامت ها <br> متن شما در نمایش به سطر جدید میرود.";
?>
    <section class="features">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>@lang('labels.history')</h2>
        <form id="history_form">
           @csrf
           <input type="hidden" name="type" value="1">
          <div class="col-lg-12 row" dir="rtl">
	       	<div class="col-lg-3">
	       		<label style="float: right;">انتخاب زبان:</label>
	       		<select class="form-control" name="lang" onchange="get_history_lang_info(this.value)">
	       			<option value="dr" selected>زبان دری</option>
	       			<option value="ps">زبان پشتو</option>
	       			<option value="en">زبان انگلیسی</option>
	       		</select>

	       		<p align="right"><br><b>نوت:</b>{{$note}}</p>
	       	</div>
	       	<div class="col-lg-9">
	       		<textarea class="form-control history_dr_text" name="dr_text" rows="5" placeholder="تاریخچه را بنویسید...">{{$history_dr_text}}</textarea>
	            <textarea style="display: none;" class="form-control history_ps_text" name="ps_text" rows="5" placeholder="تاریخچه را به زبان پشتو بنویسید...">{{$history_ps_text}}</textarea>
	            <textarea dir="ltr" style="display: none;" class="form-control history_en_text" name="en_text" rows="5" placeholder="write history text">{{$history_en_text}}</textarea>
	       	</div>
	       </div>
          <div class="col-lg-12 row" >
          	  <div>
          	  	<br>
          	  	<div class="loading loader2" style="width:150px;margin: 0 auto;margin-bottom: 10px;"> در حال اصلاح</div>
                <div class="error-message error2" dir="rtl" style="text-align: center !important; margin-bottom: 10px;">تاریخچه اصلاح نشد!</div>
                <div class="sent-message success2" dir="rtl" style="text-align: center !important; margin-bottom: 10px;">تاریخچه اصلاح شد!</div>
          	  	<button type="submit" class="btn btn-success">ثبت تغییرات</button>
          	  </div>
          </div>
        </form>
        </div>
      </div>
    </section>
    <section class="section-bg" style="height:30px !important; padding: 0;margin: 0;"></section>

  
    <!-- ======= biography of the boss ======= -->
    <section id="about-us" class="about-us team">
      <div class="container" data-aos="fade-up">
<?php 
use App\Models\Biography;
 $boss = Biography::first();

?>
	   <form id="boss_form">
           @csrf
        <div class="row content" dir="@lang('labels.dir')">
          <div class="col-lg-4" data-aos="fade-right">
          	<br>
            <div class="fileUpload_img col-lg-12" style="margin-top: 10px;">
				<span class="btn btn-success upload_btn"> انتخاب عکس</span>
				<input type="file" class="upload file" name="boss_photo" id="boss_photo" onchange="set_boss_photo()">
			</div>
			<div class="col-lg-12">
		       	<label style="float: right;">نام رئیس:</label>
		       	<input type="text" name="name" value="{{$boss->name}}" class="form-control" placeholder="نام رئیس را بنویسید">
		    </div>
		    <br>
            <div class="member" data-aos="fade-up" style="margin-top:6px;">
              <div class="member-img">
                <img style="width: 100%;" src="assets/img/boss/{{$boss->photo}}" class="img-fluid boss_photo">
              </div>
              <div class="member-info">
                <h4>{{$boss->name}}</h4>
                <span>@lang('labels.position')</span>
              </div>
            </div>


          </div>
          <div class="col-lg-8 pt-4 pt-lg-0 section-title" data-aos="fade-left">
            <h3>@lang('labels.biography')</h3>
            <div class="col-lg-12 row" dir="rtl">
		       	<div class="col-lg-3">
		       		<label style="float: right;">انتخاب زبان:</label>
		       		<select class="form-control" name="lang" onchange="get_boss_lang_info(this.value)">
		       			<option value="dr" selected>زبان دری</option>
		       			<option value="ps">زبان پشتو</option>
		       			<option value="en">زبان انگلیسی</option>
		       		</select>
		       	</div>
		       	<div class="col-lg-9">
		       		<p align="right"><br><b>نوت:</b>{{$note}}</p><br>
		       	</div>
	        </div>
	        <div class="col-lg-12 row" dir="rtl">
		       		<textarea class="form-control boss_dr_text" name="dr_text" rows="20" placeholder="زندگی نامه رئیس  را بنویسید...">{{$boss->dr_text}}</textarea>
		            <textarea style="display: none;" class="form-control boss_ps_text" name="ps_text" rows="20" placeholder="زندگی نامه رئیس  را به زبان پشتو بنویسید...">{{$boss->ps_text}}</textarea>
		            <textarea dir="ltr" style="display: none;" class="form-control boss_en_text" name="en_text" rows="20" placeholder="write biography of the boss text">{{$boss->en_text}}</textarea>
		       	</div>
	        </div>


	        <div class="col-lg-12 text-center row">
          	  <div>
          	  	<div class="loading loader4" style="width:150px;margin: 0 auto;margin-bottom: 10px;"> در حال اصلاح</div>
                <div class="error-message error4" dir="rtl" style="text-align: center !important; margin-bottom: 10px;">تاریخچه اصلاح نشد!</div>
                <div class="sent-message success4" dir="rtl" style="text-align: center !important; margin-bottom: 10px;">تاریخچه اصلاح شد!</div>
          	  	<button type="submit" class="btn btn-success">ثبت تغییرات</button>
          	  </div>
          </div>
        </form>
          </div>
        </div>
      </div>
    </section>

    <section class="section-bg" style="height:30px !important; padding: 0;margin: 0;"></section>

    <section class="features">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>@lang('labels.activities_descriptions')</h2>
          <form id="activities_form">
           @csrf 
           <input type="hidden" name="type" value="3">
            <div class="col-lg-12 row" dir="rtl">
		       	<div class="col-lg-3">
		       		<label style="float: right;">انتخاب زبان:</label>
		       		<select class="form-control" name="lang" onchange="get_activities_lang_info(this.value)">
		       			<option value="dr" selected>زبان دری</option>
		       			<option value="ps">زبان پشتو</option>
		       			<option value="en">زبان انگلیسی</option>
		       		</select>
		       		<p align="right"><br><b>نوت:</b>{{$note}}</p>

		       	</div>
		       	<div class="col-lg-9">
		       		<textarea class="form-control activities_dr_text" name="dr_text" rows="5" placeholder="تاریخچه را بنویسید...">{{$activities_dr_text}}</textarea>
		            <textarea style="display: none;" class="form-control activities_ps_text" name="ps_text" rows="5" placeholder="تاریخچه را به زبان پشتو بنویسید...">{{$activities_dr_text}}</textarea>
		            <textarea dir="ltr" style="display: none;" class="form-control activities_en_text" name="en_text" rows="5" placeholder="write activities text">{{$activities_dr_text}}</textarea>
		       	</div>
	        </div>
          <div class="col-lg-12 row" >
          	  <div>
          	  	<br>
          	  	<div class="loading loader3" style="width:150px;margin: 0 auto;margin-bottom: 10px;"> در حال اصلاح</div>
                <div class="error-message error3" dir="rtl" style="text-align: center !important; margin-bottom: 10px;">تاریخچه اصلاح نشد!</div>
                <div class="sent-message success3" dir="rtl" style="text-align: center !important; margin-bottom: 10px;">تاریخچه اصلاح شد!</div>
          	  	<button type="submit" class="btn btn-success">ثبت تغییرات</button>
          	  </div>
          </div>
        </form>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

 @include('includes.footer')
 @include('includes.script')

</body>


<script type="text/javascript">

$(document).ready(function () {
	$("#slider_form_1").on('submit', function (e) {
	        e.preventDefault();
	        var flage = true;
	        if (flage) {
              $('.loading').show();
	           $.ajax({
	                url: "/update_sliders",
	                type: 'POST',
	                contentType: false,
	                cache: false,
	                processData: false,
	                data: new FormData(this),
	                success: function (data) {
	                  if (Number(data) == 1) {
	                      $('.sent-message').slideDown();
	                    }else{
	                      $('.error-message').slideDown();
	                    }
                    setTimeout(function () { $('.sent-message, .error-message').slideUp(); },5000);
                    $('.loading').hide();
	                },error: function (jqXHR, textStatus, errorThrown) {
	                    $('.error-message').slideDown().text(jqXHR.responseText);
                     	$('.loading').hide();
                    	setTimeout(function () { $('.sent-message, .error-message').slideUp(); },5000);
	                }
	            }); 
	        }
	});

	$("#slider_form_2").on('submit', function (e) {
	        e.preventDefault();
	        var flage = true;
	        if (flage) {
              $('.loading').show();
	           $.ajax({
	                url: "/update_sliders",
	                type: 'POST',
	                contentType: false,
	                cache: false,
	                processData: false,
	                data: new FormData(this),
	                success: function (data) {
	                  if (Number(data) == 1) {
	                      $('.sent-message').slideDown();
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

	$("#slider_form_3").on('submit', function (e) {
	        e.preventDefault();
	        var flage = true;
	        if (flage) {
              $('.loading').show();
	           $.ajax({
	                url: "/update_sliders",
	                type: 'POST',
	                contentType: false,
	                cache: false,
	                processData: false,
	                data: new FormData(this),
	                success: function (data) {
	                  if (Number(data) == 1) {
	                      $('.sent-message').slideDown();
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

	$("#slider_form_4").on('submit', function (e) {
	        e.preventDefault();
	        var flage = true;
	        if (flage) {
              $('.loading').show();
	           $.ajax({
	                url: "/update_sliders",
	                type: 'POST',
	                contentType: false,
	                cache: false,
	                processData: false,
	                data: new FormData(this),
	                success: function (data) {
	                  if (Number(data) == 1) {
	                      $('.sent-message').slideDown();
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

	$("#slider_form_5").on('submit', function (e) {
	        e.preventDefault();
	        var flage = true;
	        if (flage) {
              $('.loading').show();
	           $.ajax({
	                url: "/update_sliders",
	                type: 'POST',
	                contentType: false,
	                cache: false,
	                processData: false,
	                data: new FormData(this),
	                success: function (data) {
	                  if (Number(data) == 1) {
	                      $('.sent-message').slideDown();
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

	$("#slider_form_6").on('submit', function (e) {
	        e.preventDefault();
	        var flage = true;
	        if (flage) {
              $('.loading').show();
	           $.ajax({
	                url: "/update_sliders",
	                type: 'POST',
	                contentType: false,
	                cache: false,
	                processData: false,
	                data: new FormData(this),
	                success: function (data) {
	                  if (Number(data) == 1) {
	                      $('.sent-message').slideDown();
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

	$("#history_form").on('submit', function (e) {
	        e.preventDefault();
	        var flage = true;
	        if (flage) {
              $('.loader2').show();
	           $.ajax({
	                url: "/update_information",
	                type: 'POST',
	                contentType: false,
	                cache: false,
	                processData: false,
	                data: new FormData(this),
	                success: function (data) {
	                  if (Number(data) == 1) {
	                      $('.success2').slideDown();
	                    }else{
	                      $('.error2').slideDown();
	                    }
                    setTimeout(function () { $('.sent-message, .error-message').slideUp(); },5000);
                    $('.loader2').hide();
	                },error: function (jqXHR, textStatus, errorThrown) {
	                    $('.error2').slideDown().text(errorThrown);
                     	$('.loader2').hide();
                    	setTimeout(function () { $('.sent-message, .error-message').slideUp(); },5000);
	                }
	            }); 
	        }
	});

	$("#stracture_form").on('submit', function (e) {
	        e.preventDefault();
	        var flage = true;
	        if (flage) {
              $('.loader2').show();
	           $.ajax({
	                url: "/update_information",
	                type: 'POST',
	                contentType: false,
	                cache: false,
	                processData: false,
	                data: new FormData(this),
	                success: function (data) {
	                  if (Number(data) == 1) {
	                      $('.success3').slideDown();
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

	$("#activities_form").on('submit', function (e) {
	        e.preventDefault();
	        var flage = true;
	        if (flage) {
              $('.loader2').show();
	           $.ajax({
	                url: "/update_information",
	                type: 'POST',
	                contentType: false,
	                cache: false,
	                processData: false,
	                data: new FormData(this),
	                success: function (data) {
	                  if (Number(data) == 1) {
	                      $('.success3').slideDown();
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


	$("#boss_form").on('submit', function (e) {
	        e.preventDefault();
	        var flage = true;
	        if (flage) {
              $('.loader4').show();
	           $.ajax({
	                url: "/update_biography",
	                type: 'POST',
	                contentType: false,
	                cache: false,
	                processData: false,
	                data: new FormData(this),
	                success: function (data) {
	                  if (Number(data) == 1) {
	                      $('.success4').slideDown();
	                    }else{
	                      $('.error4').slideDown();
	                    }
                    setTimeout(function () { $('.sent-message, .error-message').slideUp(); },5000);
                    $('.loader4').hide();
	                },error: function (jqXHR, textStatus, errorThrown) {
	                    $('.error4').slideDown().text(errorThrown);
                     	$('.loader4').hide();
                    	setTimeout(function () { $('.sent-message, .error-message').slideUp(); },5000);
	                }
	            }); 
	        }
	});
});



	function get_history_lang_info(lang) {
		if (lang == 'dr') {
			$('.history_dr_text').show();
			$('.history_ps_text, .history_en_text').hide();
		}else if (lang == 'ps') {
			$('.history_ps_text').show();
			$('.history_dr_text, .history_en_text').hide();
		}else{
			$('.history_en_text').show();
			$('.history_ps_text, .history_dr_text').hide();
		}
	}

	function get_stracture_lang_info(lang) {
		if (lang == 'dr') {
			$('.stracture_dr_text').show();
			$('.stracture_ps_text, .stracture_en_text').hide();
		}else if (lang == 'ps') {
			$('.stracture_ps_text').show();
			$('.stracture_dr_text, .stracture_en_text').hide();
		}else{
			$('.stracture_en_text').show();
			$('.stracture_ps_text, .stracture_dr_text').hide();
		}
	}

	function get_boss_lang_info(lang) {
		if (lang == 'dr') {
			$('.boss_dr_text').show();
			$('.boss_ps_text, .boss_en_text').hide();
		}else if (lang == 'ps') {
			$('.boss_ps_text').show();
			$('.boss_dr_text, .boss_en_text').hide();
		}else{
			$('.boss_en_text').show();
			$('.boss_ps_text, .boss_dr_text').hide();
		}
	}

	function get_activities_lang_info(lang) {
		if (lang == 'dr') {
			$('.activities_dr_text').show();
			$('.activities_ps_text, .activities_en_text').hide();
		}else if (lang == 'ps') {
			$('.activities_ps_text').show();
			$('.activities_dr_text, .activities_en_text').hide();
		}else{
			$('.activities_en_text').show();
			$('.activities_ps_text, .activities_dr_text').hide();
		}
	}

	function get_lang_info(lang,id) {
		if (lang == 'dr') {
			$('.slider_dr_title_'+id+', .slider_dr_text_'+id).show();
			$('.slider_ps_title_'+id+', .slider_en_title_'+id).hide();
			$('.slider_ps_text_'+id+', .slider_en_text_'+id).hide();

		}else if (lang == 'ps') {
			$('.slider_ps_title_'+id+', .slider_ps_text_'+id).show();
			$('.slider_dr_title_'+id+', .slider_en_title_'+id).hide();
			$('.slider_dr_text_'+id+', .slider_en_text_'+id).hide();
		}else{
			$('.slider_en_title_'+id+', .slider_en_text_'+id).show();
			$('.slider_dr_title_'+id+', .slider_ps_title_'+id).hide();
			$('.slider_dr_text_'+id+', .slider_ps_text_'+id).hide();
		}
	}

function slider_images(id) {

  var file    = document.getElementById(id).files[0];
  var reader  = new FileReader();
 reader.addEventListener("load", function () {
     if(file.size < 2048576){
        $('.'+id).css('backgroundImage','url('+reader.result+')');
      }else{
        var totalSize =  ((file.size/1024)/1024).toString().slice(0,4)+' MB';
        alert(totalSize);
      }
  }, false);

  if (file) {
    reader.readAsDataURL(file);
  }
}

function set_boss_photo() {

  var file    = document.getElementById('boss_photo').files[0];
  var reader  = new FileReader();
 reader.addEventListener("load", function () {
     if(file.size < 2048576){
        $('.boss_photo').attr('src',reader.result);
      }else{
        var totalSize =  ((file.size/1024)/1024).toString().slice(0,4)+' MB';
        alert(totalSize);
      }
  }, false);

  if (file) {
    reader.readAsDataURL(file);
  }
}

</script>

</html>