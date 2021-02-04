<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>COVID-19 Track System</title>

        <!---------STYLES-------->
            @include('partials.styles') 
        <!-----END OF STYLES----->
        
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!------------- Navbar ---------------->
                @include('partials.navbar')
            <!------------------------------------->
      
            <!--------------Sidebar---------------->
                @include('partials.sidebar')
            <!------------------------------------->
            <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                        <div class="content-header">
                            <div class="container-fluid">
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <h1 class="m-0">
                                            {{$page = ''}}
                                            @if (Request::is('patients*'))
                                                {{$page = 'Patients'}}
                                            @elseif (Request::is('payments*'))
                                                {{$page = 'Payments'}}
                                            @elseif (Request::is('officers*'))
                                                {{$page = 'Health Officers'}}
                                            @elseif (Request::is('hospitals*'))
                                                {{$page = 'Hospitals'}}
                                            @elseif (Request::is('admin*'))
                                                {{$page = 'Admininstration'}}
                                            @elseif (Request::is('districts*'))
                                                {{$page = 'Districts'}}
                                            @endif
                                        </h1>
                                    </div><!-- /.col -->
                                    <div class="col-sm-6">
                                        <ol class="breadcrumb float-sm-right">
                                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                                            <li class="breadcrumb-item active">{{$page}}</li>
                                        </ol>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.container-fluid -->
                        </div>
                    <!-- /.content-header -->
                    <section class="content">
                        <div class="container-fluid">
                            @yield('content')
                        </div>
                    </section>
                </div>

            <!----------------scripts--------------->
                @include('
                partials.scripts')
            <!-------------------------------------->

        </div>
    </body>
</html>
