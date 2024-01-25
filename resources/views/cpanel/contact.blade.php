<!DOCTYPE html>
<html lang="en">

<head>
  <title>@lang('labels.company')  -  @lang('labels.services')</title>
  @include('includes.head')
</head>
<body>
  <?php $nav_contact=1 ?>
  @include('includes.cpanel_header')

  <main id="main">

    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container" dir="@lang('labels.dir')">
        <div class="d-flex justify-content-between align-items-center">
          <h2>@lang('labels.contact')</h2>
          <ol>
            <li><a href="/update">@lang('labels.home')</a></li>
            <li>@lang('labels.contact')</li>
          </ol>
        </div>
      </div>
    </section><!-- End Breadcrumbs -->
    <section class="section-bg" style="height:30px !important; padding: 0;margin: 0;"></section>

    <section class="features">
      <div class="container" data-aos="fade-up" dir="rtl">

        <div class="section-title">
          <h2>پیام های بازدیدکننده گاه</h2>
          <div class="col-lg-12 table-responsive">
              <table class="table table-bordered table-striped table-hover" dir="@lang('labels.dir')">
                <thead>
                  <tr>
                    <th width="50">@lang('labels.counter')</th>
                    <th>@lang('labels.name')</th>
                    <th width="150">@lang('labels.email_or_phone')</th>
                    <th>@lang('labels.msg')</th>
                    <th width="110">مدت</th>
                    <th width="110">تاریخ</th>
                  </tr>
                </thead>
                <tbody>
<?php 
  use App\Models\Messages;
  $info = Messages::orderBy('created_at','desc')->get();
  $counter = 1;
  foreach ($info as $info) {
?>
				 <tr>
                    <td>{{$counter}}</td>
                    <td>{{$info->name}}</td>
                    <td>{{$info->contact}}</td>
                    <td>{{$info->msg}}</td>
                    <td dir="ltr">{{$info->created_at->diffForHumans()}}</td>
                    <td dir="ltr">{{ $info->created_at->format('Y-m-d') }}</td>
                  </tr>

<?php $counter++; } ?>
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </section>
    <section class="section-bg" style="height:30px !important; padding: 0;margin: 0;"></section>



  </main><!-- End #main -->

 @include('includes.footer')
 @include('includes.script')
</body>

</html>