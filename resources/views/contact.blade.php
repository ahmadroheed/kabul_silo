<!DOCTYPE html>
<html lang="en">

<head>
  <title>@lang('labels.company')  -  @lang('labels.contact')</title>
  @include('includes.head')

</head>

<body>
  <?php $nav_contact=1; ?>
  @include('includes.header')



  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container" dir="@lang('labels.dir')">
        <div class="d-flex justify-content-between align-items-center">
          <h2>@lang('labels.contact')</h2>
          <ol>
            <li><a href="/">@lang('labels.home')</a></li>
            <li>@lang('labels.contact')</li>
          </ol>
        </div>
      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Contact Section ======= -->
    <div class="map-section">
      <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13148.729460857721!2d69.1047576069832!3d34.52360737877733!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38d16f3809975c17%3A0xb8300e2b83b8234e!2sKabul%20Grain%20Silo!5e0!3m2!1sen!2s!4v1659011241172!5m2!1sen!2s" frameborder="0" allowfullscreen></iframe>
    </div>

    <section id="contact" class="contact">
      <div class="container">

        <div class="row justify-content-center" data-aos="fade-up">

          <div class="col-lg-10">

            <div class="info-wrap" dir="@lang('labels.dir')">
              <div class="row">
                <div class="col-lg-4 info">
                  <i class="bi bi-geo-alt @lang('labels.left_hide')" style="float: right;margin-left: 20px;margin-bottom: 20px;"></i>
                  <i class="bi bi-geo-alt @lang('labels.right_hide')"></i>
                  <h4>@lang('labels.location'):</h4>
                  <p>@lang('labels.address')</p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="bi bi-envelope @lang('labels.left_hide')" style="float: right;margin-left: 20px;margin-bottom: 20px;"></i>
                  <i class="bi bi-envelope @lang('labels.right_hide')"></i>
                  <h4>@lang('labels.email'):</h4>
                  <p>info@kabulsilo.gov.af</p>
                </div>

                <div class="col-lg-4 info mt-4 mt-lg-0">
                  <i class="bi bi-phone @lang('labels.left_hide')" style="float: right;margin-left: 20px;margin-bottom: 20px;"></i>
                  <i class="bi bi-phone @lang('labels.right_hide')"></i>
                  <h4>@lang('labels.phone'):</h4>
                  <p>0202502966</p>
                </div>
              </div>
            </div>

          </div>

        </div>

        <div class="row mt-5 justify-content-center" data-aos="fade-up">
          <div class="col-lg-10" dir="@lang('labels.dir')">
            <form action="/save_contact" method="post" role="form" class="php-email-form">
              @csrf
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="@lang('labels.name')" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="contact" id="email" placeholder="@lang('labels.email_or_phone')" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" id="contact_form_message" name="msg" rows="5" placeholder="@lang('labels.msg')" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading"> @lang('labels.loading')</div>
                  <div class="error-message" style="text-align: center !important;">@lang('labels.msg_not_sended')</div>
                  <div class="sent-message" style="text-align: center !important;">@lang('labels.msg_sended')</div>
              </div>
              <div class="text-center"><button type="submit">@lang('labels.send_msg')</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  @include('includes.footer')
  @include('includes.script')

</body>

</html>