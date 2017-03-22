    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                HighCharts
                <small>Preview sample</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">HighCharts</a></li>
                <li class="active">HighCharts</li>
            </ol>
        </section>


        <script>
            $(function () {
                $('#menuGraphicKecepatan').removeClass('').addClass('active');

                var options = {
                    chart: {
                        type: 'column',
                        renderTo: 'barwithdrilldown'
                    },
                    title: {
                        text: 'Browser market shares. January, 2015 to May, 2015'
                    },
                    subtitle: {
                        text: 'Click the columns to view versions. Source: <a href="http://netmarketshare.com">netmarketshare.com</a>.'
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: 'Total percent market share'
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.1f} m'
                            }
                        }
                    },

                    tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f} m </b> of total<br/>'
                    },
                    series: [{
                        name: 'Jarak',
                        colorByPoint: true,
                        data: <?php echo json_encode($getdataKecepatan,JSON_PRETTY_PRINT); ?>
                    }],
					drilldown: {
                     	series: <?php echo json_encode($getdataKecepatanx,JSON_PRETTY_PRINT); ?>
                     }
                };
                var barChart = new Highcharts.Chart(options);
            });

        </script>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <!-- /.col (LEFT) -->


                <div class="col-md-12">
                    <!-- AREA CHART -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Data Kecepatan</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart" id="barwithdrilldown" style="height:250px">
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>


            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>

    <script>

    </script>
