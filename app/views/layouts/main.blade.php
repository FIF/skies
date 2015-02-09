<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>SEO Sheet Processor</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('css/main.css') }}

    <!--external css-->
    <!-- {{ HTML::style('css/bootstrap.css') }} -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    {{ HTML::style('font-awesome/css/font-awesome.css') }}

    <!-- blueimp Gallery styles -->
    <link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">

    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="css/jquery.fileupload.css">
    <link rel="stylesheet" href="css/jquery.fileupload-ui.css">

    <!-- {{ HTML::style('js/bootstrap-datepicker/css/datepicker.css') }} -->
    <!-- {{ HTML::style('assets/js/bootstrap-daterangepicker/daterangepicker.css') }} -->
        
    <!-- Custom styles for this template -->
    {{ HTML::style('css/style.css') }}
    {{ HTML::style('css/style-responsive.css') }}
	  {{ HTML::style('src/css/boxy.css'); }}

    <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
    <link rel="stylesheet" href="css/jquery.fileupload.css">
    <link rel="stylesheet" href="css/jquery.fileupload-ui.css">

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
    @yield('header')

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js') }}
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="{{ URL::to('/') }}" class="logo">{{ HTML::image('img/logo.png') }}</a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
               
                <!--  notification end -->
            </div>
          
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
               
              	  <h5 class="centered">SEO Sheet Processor</h5>
              	  	
                  <li class="">
                      <a href="{{ URL::to('/') }}">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                  <li class="">
                      <a href="{{ URL::to('files') }}">
                          <i class="fa fa-folder"></i>
                          <span>Your Files </span>
                      </a>
                  </li>
                  

              </ul>
              <div id="footer">© SEO Sheet Processor v.0.2</div>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
      	<section id="wrapper">
      		@yield('content')
		</section>
      </section>
      <!--main content end-->
      
      <!--footer start
      <footer class="site-footer">
          <div class="text-center">
              2015 - Innov8te pte ltd
              <a href="form_component.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer-->
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    {{ HTML::script('js/jquery-1.11.1.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/jquery.dcjqaccordion.2.7.js') }}
    {{ HTML::script('js/jquery.scrollTo.min.js') }}
    {{ HTML::script('js/jquery.nicescroll.js') }}


    <!--common script for all pages-->
    {{ HTML::script('js/common-scripts.js') }}

    <!--script for this page-->
    {{ HTML::script('js/jquery-ui-1.9.2.custom.min.js') }}

	<!--custom switch-->
	{{ HTML::script('js/bootstrap-switch.js') }}
	
	<!--custom tagsinput-->
	{{ HTML::script('js/jquery.tagsinput.js') }}
	
	<!--custom checkbox & radio-->
	
	<!-- {{ HTML::script('js/bootstrap-datepicker/js/bootstrap-datepicker.js') }} -->
	<!-- {{ HTML::script('js/bootstrap-daterangepicker/date.js') }} -->
	<!-- {{ HTML::script('js/bootstrap-daterangepicker/daterangepicker.js') }} -->
	
	{{ HTML::script('js/bootstrap-inputmask/bootstrap-inputmask.min.js') }}
	
	
	{{ HTML::script('js/form-component.js') }}   
    
  {{ HTML::script("src/js/jquery.boxy.js") }}
  <script src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
    @yield('script')
    

  </body>
</html>
