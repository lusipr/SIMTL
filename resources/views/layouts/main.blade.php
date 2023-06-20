<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="../favicon.png">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SIM-TL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/icon/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/metisMenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slicknav.min.css') }}">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css"
        media="all" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
    <!-- others css -->
    <link rel="stylesheet" href="{{ asset('assets/css/typography.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/default-css.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <!-- modernizr css -->
    <script src="{{ asset('assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <a href="{{ url('/') }}"><img src="{{ asset('logoinka.png') }}" alt="logo"
                        width="500%"></a>
            </div>
            <div class="user-panel mt-3 pb-0 mb-3 d-flex" style="padding-left: 32px; padding-right: 32px;">
                <div class="image">
                    <img src="https://www.businessnetworks.com/sites/default/files/default_images/default-avatar.png"
                        style="width: 3rem; height: 3rem; border-radius: 50%;" class="img-circle elevation-2"
                        alt="User Image">
                </div>
                <div class="info pl-3">
                    <div style="color: #8d97ad !important;">Hi, <a href="{{ url('/') }}"
                            style="color: #8d97ad !important;">{{ auth()->user()->name }}</a></div>
                    <span class="badge badge-success">
                        {{ auth()->user()->role }}
                    </span>
                </div>
            </div>
            <div class="main-menu pt-0">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li>
                                <a href="{{ url('/') }}"><i class="ti-dashboard"></i><span>Dashboard</span></a>
                            </li>
                            @if (auth()->user()->role == 'Admin1')
                                {{-- <li>
                                <a href="#" aria-expanded="true"><i class="ti-layout"></i><span>Input Data</span></a>
                                <ul class="collapse">
                                    <li><a href="{{ url('/input-ncr') }}">NCR</a></li>
                                    <li><a href="{{ url('/input-ofi') }}">OFI</a></li>
                                    <li><a href="{{ url('/input-tl') }}">Tindak Lanjut</a></li>
                                </ul>
                            </li> --}}
                                <li>
                                    <a href="#" aria-expanded="true"><i class="ti-layout"></i><span>Master
                                            Data</span></a>
                                    <ul class="collapse">
                                        {{-- <li><a href="{{ url('/data-nc') }}">Data NC</a></li> --}}
                                        <li><a href="{{ url('/data-ncr') }}">Data NCR</a></li>
                                        <li><a href="{{ url('/data-ofi') }}">Data OFI</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ url('/monitoring-tl') }}"><i class="ti-write"></i><span>Monitoring
                                            Tindak Lanjut</span></a>
                                </li>
                                <hr
                                    style="display: block; height: 1px; border: 0; border-top: 1px solid #343e50; margin: 1em 0; margin-left: 32px; margin-right: 32px;">
                                <li>
                                    <a href="{{ url('/data-tema') }}"><i class="ti-user"></i><span>Tema
                                            Audit</span></a>
                                </li>
                                <li>
                                    <a href="{{ url('/data-departemen') }}"><i
                                            class="ti-user"></i><span>Departemen</span></a>
                                </li>
                                <li>
                                    <a href="{{ url('/data-user') }}"><i class="ti-user"></i><span>Pengguna</span></a>
                                </li>
                                <hr
                                    style="display: block; height: 1px; border: 0; border-top: 1px solid #343e50; margin: 1em 0; margin-left: 32px; margin-right: 32px;">
                            @elseif (auth()->user()->role == 'Admin2')
                                <li>
                                    <a href="#" aria-expanded="true"><i class="ti-layout"></i><span>Master
                                            Data</span></a>
                                    <ul class="collapse">
                                        {{-- <li><a href="{{ url('/data-nc') }}">Data NC</a></li> --}}
                                        <li><a href="{{ url('/data-ncr') }}">Data NCR</a></li>
                                        <li><a href="{{ url('/data-ofi') }}">Data OFI</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ url('/monitoring-tl') }}"><i class="ti-write"></i><span>Monitoring
                                            Tindak Lanjut</span></a>
                                </li>
                                <hr
                                    style="display: block; height: 1px; border: 0; border-top: 1px solid #343e50; margin: 1em 0; margin-left: 32px; margin-right: 32px;">
                            @elseif (auth()->user()->role == 'Auditor')
                                <li>
                                    <a href="#" aria-expanded="true"><i class="ti-layout"></i><span>Master
                                            Data</span></a>
                                    <ul class="collapse">
                                        {{-- <li><a href="{{ url('/data-nc') }}">Data NC</a></li> --}}
                                        <li><a href="{{ url('/data-ncr') }}">Data NCR</a></li>
                                        <li><a href="{{ url('/data-ofi') }}">Data OFI</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ url('/monitoring-tl') }}"><i class="ti-write"></i><span>Monitoring
                                            Tindak
                                            Lanjut</span></a>
                                </li>
                            @elseif (auth()->user()->role == 'Auditee')
                                <li>
                                    <a href="#" aria-expanded="true"><i class="ti-layout"></i><span>Master
                                            Data</span></a>
                                    <ul class="collapse">
                                        {{-- <li><a href="{{ url('/data-nc') }}">Data NC</a></li> --}}
                                        <li><a href="{{ url('/data-ncr') }}">Data NCR</a></li>
                                        <li><a href="{{ url('/data-ofi') }}">Data OFI</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ url('/monitoring-tl') }}"><i class="ti-write"></i><span>Monitoring
                                            Tindak
                                            Lanjut</span></a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ url('logout') }}"><i class="ti-power-off"></i><span>Logout</span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center" style="margin-top: 5px; margin-bottom: 5px;">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left mt-0">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="search-box pull-left">
                            <form action="#">
                                <h5>Sistem Informasi Monitoring Tindak Lanjut</h5>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- page title area start -->
            <div class="page-title-area mt-4" style="background: transparent;">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><span>Dashboard</span></li>
                            </ul>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-sm-6 clearfix" width="220px" padding:0px;>
                        <ul class="notification-area pull-right">
                            <li>
                                <h5>
                                    <div class="date">
                                        <script type='text/javascript'>
                                            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
                                                'November', 'Desember'
                                            ];
                                            var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                            var date = new Date();
                                            var day = date.getDate();
                                            var month = date.getMonth();
                                            var thisDay = date.getDay(),
                                                thisDay = myDays[thisDay];
                                            var yy = date.getYear();
                                            var year = (yy < 1000) ? yy + 1900 : yy;
                                            document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                                        </script></b>
                                    </div>
                                </h5>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            @yield('content')

        </div>

        <footer>
            <div class="footer-area">
                <p>Copyright &copy; 2022 <strong>PT. INKA (Persero)</strong></p>
            </div>
        </footer>
    </div>

    <script src="{{ asset('assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slicknav.min.js') }}"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <!-- start chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
        zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="{{ asset('assets/js/line-chart.js') }}"></script>
    <!-- all pie chart -->
    <script src="{{ asset('assets/js/pie-chart.js') }}"></script>
    <script src="{{ asset('assets/js/bar-chart.js') }}"></script>
    <script>
        @if (Route::currentRouteName() != 'data-departemen-add' &&
                Route::currentRouteName() != 'data-departemen-edit' &&
                Route::currentRouteName() != 'data-user-add' &&
                Route::currentRouteName() != 'data-user-edit' &&
                Route::currentRouteName() != 'data-tema-add' &&
                Route::currentRouteName() != 'data-tema-edit')
            $(document).ready(function() {
                $('input').on('keydown', function(event) {
                    if (this.selectionStart == 0 && event.keyCode >= 65 && event.keyCode <= 90 && !(event
                            .shiftKey) && !(event.ctrlKey) && !(event.metaKey) && !(event.altKey)) {
                        var $t = $(this);
                        event.preventDefault();
                        var char = String.fromCharCode(event.keyCode);
                        $t.val(char + $t.val().slice(this.selectionEnd));
                        this.setSelectionRange(1, 1);
                    }
                });
            });
        @endif

        if ($('#dataTable3').length) {
            @if (Route::currentRouteName() == 'data-nc' ||
                    Route::currentRouteName() == 'data-ncr' ||
                    Route::currentRouteName() == 'data-ofi')
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        var min = new Date($('#minDateFilter').val());
                        var max = new Date($('#maxDateFilter').val());
                        var date = new Date(data[6]);

                        if (
                            ($('#minDateFilter').val() == '' && $('#maxDateFilter').val() == '') ||
                            ($('#minDateFilter').val() == '' && date <= max) ||
                            (min <= date && $('#maxDateFilter').val() == '') ||
                            (min <= date && date <= max)
                        ) {
                            return true;
                        }
                        return false;
                    }
                );
            @endif

            $(document).ready(function() {
                var dataTable3 = $('#dataTable3').DataTable({
                    // dom: 'Bfrtip',
                    responsive: true
                    // buttons: [
                    //   'print'
                    // ]
                });

                @if (Route::currentRouteName() == 'data-nc' ||
                        Route::currentRouteName() == 'data-ncr' ||
                        Route::currentRouteName() == 'data-ofi')
                    $('#minDateFilter, #maxDateFilter').on('change', function() {
                        dataTable3.draw();
                    });
                @endif
            });
        }
    </script>
    <!-- others plugins -->
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js?v=0.001') }}"></script>

</body>

</html>
