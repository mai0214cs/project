<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('header')</title>
        <link href="/src/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="/src/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
        <link href="/src/dist/css/sb-admin-2.css" rel="stylesheet">
        <link href="/src/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <script src="/src/bower_components/jquery/dist/jquery.min.js"></script>
        <link href="/src/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
        <script src="/src/fancybox/jquery.fancybox.js" type="text/javascript"></script>
        <script src="/src/fancybox/jquery.mousewheel-3.0.6.pack.js" type="text/javascript"></script>
        <script src="/src/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="/src/ckfinder/ckfinder.js" type="text/javascript"></script>
        <script src="/src/admin.js"></script>
    </head>
    <body>
        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">{{trans('admin.pageadmin')}}</a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> {{trans('admin.UserProfile')}}</a></li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> {{trans('admin.UserSettings')}}</a></li>
                            <li class="divider"></li>
                            <li><a href="#"><i class="fa fa-sign-out fa-fw"></i> {{trans('admin.Logout')}}</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                                <!-- /input-group -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-dashboard fa-fw"></i> {{trans('admin.Dashboard')}}<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="">{{trans('admin.PageAdmin')}}</a></li>
                                    <li><a href="/">{{trans('admin.PageView')}}</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> {{trans('admin.Product')}}<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="{{route('admin.product.list.index')}}">{{trans('admin.ProductList')}}</a></li>
                                    <li><a href="{{route('admin.product.category.index')}}">{{trans('admin.ProductCategory')}}</a></li>
                                    <li><a href="{{route('admin.product.attribute.index')}}">{{trans('admin.ProductAttribute')}}</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> {{trans('admin.Order')}}<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="{{route('admin.order.list.index')}}">{{trans('admin.OrderCustomer')}}</a></li>
                                    <li><a href="{{route('admin.order.category.index')}}">{{trans('admin.OrderInvoice')}}</a></li>
                                    <li><a href="{{route('admin.order.attribute.index')}}">{{trans('admin.OrderOrder')}}</a></li>
                                    <li><a href="{{route('admin.order.list.index')}}">{{trans('admin.OrderPayment')}}</a></li>
                                    <li><a href="{{route('admin.order.category.index')}}">{{trans('admin.OrderShipment')}}</a></li>
                                    <li><a href="{{route('admin.order.attribute.index')}}">{{trans('admin.OrderPromotion')}}</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> {{trans('admin.News')}}<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li><a href="{{route('admin.news.list.index')}}">{{trans('admin.NewsList')}}</a></li>
                                    <li><a href="{{route('admin.news.category.index')}}">{{trans('admin.NewsCategory')}}</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    @if(Session::has('infomation'))
                    <div class="row">
                        <div class="alert alert-{{Session::get('status')}}">{{Session::get('infomation')}}</div>
                    </div>    
                    @endif

                    <div class="row">
                        @yield('content')
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="/src/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="/src/bower_components/metisMenu/dist/metisMenu.min.js"></script>
        <script src="/src/dist/js/sb-admin-2.js"></script>
        @yield('footer')
    </body>
</html>
