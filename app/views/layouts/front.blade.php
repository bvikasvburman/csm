<!doctype html>
<html lang="en">
<head>
	@include('includes.front.meta_css')
	@include('includes.front.constants_js')
</head>
<body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                
                <?php echo Config::get('params.site_name');?>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        @if(Auth::check())
                        @include('includes.front.user_sett')
                        @endif
                        
                    </ul>
                </div>
                <div class="lang-flags navbar-right">
                    <a href="#" data-id="en" class="lang-flag">
                        <img src="{{ViewsHelper::img('icons/flags-16/en.png')}}"> {{trans('common.english')}}
                    </a>
                    <a href="#" data-id="fr" class="lang-flag">
                        <img src="{{ViewsHelper::img('icons/flags-16/fr.png')}}"> {{trans('common.french')}}
                    </a>
                        
                    
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                @if(Auth::check())
                @include('includes.front.left_bar')
                @endif
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        {{trans('common.dashboard')}}
                        <small>{{trans('common.control_panel')}}</small>
                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <div class="cust_alert text-muted" id="cust_alert">
        </div>

        <script type="text/javascript" src="{{ ViewsHelper::js('jquery-1.11.1.min') }}"></script>
        <script type="text/javascript" src="{{ ViewsHelper::js('bootstrap.min') }}"></script>
        <script type="text/javascript" src="{{ ViewsHelper::js('bootbox.min') }}"></script>
        <script type="text/javascript" src="{{ ViewsHelper::js('plugins/iCheck/icheck.min') }}"></script>
<?php
if(isset($this->req_js) && $this->req_js)
{
?>
        <script type="text/javascript" src="{{ ViewsHelper::js('jquery-ui-1.10.3.min') }}"></script>
<?php
}
?>
@if(isset($view_data['js_array']))
    @foreach ($view_data['js_array'] as $js_array)
        <script type="text/javascript" src="{{ ViewsHelper::js($js_array) }}"></script>
    @endforeach
@endif
<!--
<script type="text/javascript" src="{{ ViewsHelper::js('custom/autosaver') }}"></script>
-->
<script type="text/javascript" src="{{ ViewsHelper::js('custom/app') }}"></script>

</body>
</html>