<!DOCTYPE html>
<html lang="en">

<head>
  <title>@lang('labels.company')  -  @lang('labels.documents')</title>
  @include('includes.head')

  <style type="text/css">
    .btn-buy{
      border:none;
    }
    .icon-help{
      margin-top: -10px;
    }
  </style>
</head>
<body>
  <?php $nav_documents = 1; ?>
  @include('includes.header')

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container" dir="@lang('labels.dir')">
        <div class="d-flex justify-content-between align-items-center">
          <h2>@lang('labels.documents')</h2>
          <ol>
            <li><a href="/">@lang('labels.home')</a></li>
            <li>@lang('labels.documents')</li>
          </ol>
        </div>
      </div>
    </section><!-- End Breadcrumbs -->


    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up" dir="@lang('labels.dir')">

        <div class="section-title">
          <h2>@lang('labels.documents')</h2>
        </div>

        <div class="faq-list">
          <ul>

             <li data-aos="fade-up">
              <i class="bi bi-file-pdf icon-help"></i> 
              <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">
                @lang('labels.doc1') 
                <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                <embed src="/assets/documents/governmental companies law.pdf" type="application/pdf" width="100%" height="500px"  />
              </div>
            </li>

            <li data-aos="fade-up">
              <i class="bi bi-file-pdf icon-help"></i> 
              <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">

                @lang('labels.doc2') 
                <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i>

              </a>
              <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                <embed src="/assets/documents/Kabul Silo Presentation.pdf" type="application/pdf" width="100%" height="500px"  />
              </div>
            </li>

          </ul>
        </div>

      </div>
    </section><!-- End Frequently Asked Questions Section -->

  </main><!-- End #main -->

 @include('includes.footer')
 @include('includes.script')
</body>

<script type="text/javascript">

   function downloadDocument(doc_no){
      var form = document.createElement('form');
      form.method = 'post';
      form.action = "/download_document";
      var document_input = document.createElement('input');
      document_input.name = 'document';
      document_input.type = 'hidden';
      document_input.value = doc_no;
      form.appendChild(document_input);
                      
      var csrf = document.createElement('input');
      csrf.name = '_token';
      csrf.type = 'hidden';
      csrf.value = "{{csrf_token()}}";
      form.appendChild(csrf);
      $('body').append(form);
      form.submit();
  }

</script>


</html>