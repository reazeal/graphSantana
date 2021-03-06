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
                $('#menuGraphicKendaraan').removeClass('').addClass('active');


            });

        </script>

        <!-- Main content -->
        <section class="content">
            

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Table Data</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <table id="table"
                                   data-toolbar="#toolbar"
                                   data-search="true"
                                   data-show-refresh="true"
                                   data-show-toggle="true"
                                   data-show-columns="true"
                                   data-show-export="true"
                                   data-detail-formatter="detailFormatter"
                                   data-detail-view="true"
                                   data-pagination="true"
                                   data-id-field="id"
                                   data-page-list="[10, 25, 50, 100, ALL]"
                                   data-show-footer="false"
                                   data-side-pagination="server"
                                   data-row-style="rowStyle"
                                   data-url="<?php echo site_url('admin/graph2/get_data_all');?>"
                            >
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>




        </section>
        <!-- /.content -->
    </div>

    <script>

        var $table = $('#table'),
            $remove = $('#remove'),
            selections = [];
            $alert = $('.alert').hide();

        function initTable() {
            $table.bootstrapTable({
                height: 527,
                columns: [

                    [	{
                        field: 'state',
                        checkbox: true,
                        align: 'center'
                    },
                        {
                            field: 'name',
                            title: 'Nama Browser',
                            sortable: true,
                            footerFormatter: totalNameFormatter,
                            align: 'left'
                        },
                        {
                            field: 'versi',
                            title: 'Versi Browser',
                            sortable: true,
                            footerFormatter: totalNameFormatter,
                            align: 'left'
                        },{
                            field: 'prosen',
                            title: 'Prosentase',
                            sortable: true,
                            footerFormatter: totalNameFormatter,
                            align: 'right'
                        }
                        ,
                        {
                            field: 'aksi',
                            title: 'Aksi',
                            align: 'center',
                            events: operateEvents,
                            formatter: operateFormatter
                        }
                    ]
                ]
            });
            // sometimes footer render error.
            setTimeout(function () {
                $table.bootstrapTable('resetView');
            }, 200);
            $table.on('check.bs.table uncheck.bs.table ' +
                'check-all.bs.table uncheck-all.bs.table', function () {
                $remove.prop('disabled', !$table.bootstrapTable('getSelections').length);

                // save your data, here just save the current page
                selections = getIdSelections();
                // push or splice the selections if you want to save all data selections
            });

            $table.on('all.bs.table', function (e, name, args) {
                //console.log(name, args);
            });
            $remove.click(function () {
                var $modal = $('#WindowTambahDosen').modal({show: false});
                if (confirm('Anda yakin untuk menghapus data ini ?')) {
                    var ids = getIdSelections();

                    $.ajax({
                        type      : 'POST',
                        url       : '<?php echo site_url('admin/dosen/delete/');?>/',
                        data      :  { datanya : JSON.stringify(ids) },
                        dataType  : 'json',
                        success   : function(data) {
                            if (!data.success) { //If fails
                                $modal.modal('hide');
                                MsgBox.show('Hapus tidak berhasil');
                            }
                            else {
                                $modal.modal('hide');
                                $table.bootstrapTable('refresh');
                                $("form").trigger("reset");
                                MsgBox.show('Hapus berhasil!');
                            }
                        }
                    });

                }

                $remove.prop('disabled', true);
            });
            $(window).resize(function () {
                $table.bootstrapTable('resetView', {
                    height: getHeight()
                });
            });
        }

        function getIdSelections() {
            return $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id
            });
        }

        function responseHandler(res) {
            $.each(res.rows, function (i, row) {
                row.state = $.inArray(row.id, selections) !== -1;
            });
            return res;
        }

        function showModal(title, row) {
            row = row || {
                    name: '',
                    stargazers_count: 0,
                    forks_count: 0,
                    description: ''
                }; // default row value

            $modal.data('ID_DOSEN', row.ID_DOSEN);
            $modal.find('.modal-title').text(title);
            for (var name in row) {
                $modal.find('input[name="' + name + '"], textarea[name="' + name + '"], select[name="' + name + '"]').val(row[name]);
            }
            $modal.modal('show');
        }



        function showAlert(title, type) {
            $alert.attr('class', 'alert alert-' + type || 'success')
                .html('<i class="glyphicon glyphicon-check"></i> ' + title).show();
            setTimeout(function () {
                $alert.hide();
            }, 3000);
        }

        function detailFormatter(index, row) {
            var html = [];
            html.push(
                '<div class="panel panel-primary">',
                '<div class="panel-heading">Detail : </div>',
                '<ul class="chat">');
            $.each(row, function (key, value) {
                html.push('<li class="chat-body clearfix"><p><b>' + key + ':</b> ' + value + '</p></li>');
            });
            html.push(
                '</ul>',
                '<div class="panel-footer"></div>',
                '</div>',
                '</div>');

            return html.join('');
        }

        function operateFormatter(value, row, index) {
            return [
                 '<a class="edit" href="<?=site_url('admin/graphKendaraan/detail')?>/'+row.id+ '" title="Edit Data">',
				'<i class="glyphicon glyphicon-edit "></i>',
				'</a>  ',
                '</a>  ',
                '<a class="remove" href="javascript:void(0)" title="Hapus">',
                '<i class="glyphicon glyphicon-remove"></i>',
                '</a>'
            ].join('');
        }

        window.operateEvents = {
            'click .edit': function (e, value, row, index) {
                // alert('You click like action, row: ' + JSON.stringify(row));
                var $modal = $('#WindowTambahDosen').modal({show: false});
                showModal($(this).attr('title'), row);
            },
            'click .remove': function (e, value, row, index) {
                var $modal = $('#WindowTambahDosen').modal({show: false});
                //showModal($(this).attr('title'), row);
                if (confirm('Anda yakin untuk menghapus data ini ?')) {
                    $.ajax({
                        url: '<?php echo site_url('admin/dosen/delete_id/');?>/',
                        data :  { datanya : row.id },
                        type: 'POST',
                        success: function () {
                            $table.bootstrapTable('refresh');
                            MsgBox.show('Hapus Berhasil!');
                        },
                        error: function () {
                            MsgBox.show('Hapus tidak berhasil!');
                        }
                    })
                }
            }
        };

        function totalTextFormatter(data) {
            return 'Total';
        }

        function totalNameFormatter(data) {
            return data.length;
        }

        function totalPriceFormatter(data) {
            var total = 0;
            $.each(data, function (i, row) {
                total += +(row.price.substring(1));
            });
            return '$' + total;
        }

        function getHeight() {
            return $(window).height() - $('h1').outerHeight(true);
        }

        function checkHELLO(field, rules, i, options){
            if (field.val() != "HELLO") {
                // this allows to use i18 for the error msgs
                return options.allrules.vallayanan_idate2fields.alertText;
            }
        }



        function getScript(url, callback) {
            var head = document.getElementsByTagName('head')[0];
            var script = document.createElement('script');
            script.src = url;

            var done = false;
            // Attach handlers for all browsers
            script.onload = script.onreadystatechange = function() {
                if (!done && (!this.readyState ||
                    this.readyState == 'loaded' || this.readyState == 'complete')) {
                    done = true;
                    if (callback)
                        callback();

                    // Handle memory leak in IE
                    script.onload = script.onreadystatechange = null;
                }
            };

            head.appendChild(script);

            // We handle everything using the script element injection
            return undefined;
        }



        $(document).ready(function() {

            $('.modal').on('hidden.bs.modal', function(){
                $modal.data('id', '');
                $modal.find('.modal-title').text('Tambah Data');
                $(this).removeData('bs.modal');
            });

            var scripts = [
                    location.search.substring(1) || '<?php echo site_url('assets/plugins/bootstrap-table/src/bootstrap-table.js');?>',
                    '<?php echo site_url('assets/plugins/bootstrap-table/src/extensions/export/bootstrap-table-export.js');?>',
                    '<?php echo site_url('assets/plugins/bootstrap-table/tableExport.js');?>',
                    '<?php echo site_url('assets/plugins/bootstrap-table/src/extensions/editable/bootstrap-table-editable.js');?>',
                    '<?php echo site_url('assets/plugins/bootstrap-table/bootstrap-editable.js');?>'
                ],

                eachSeries = function (arr, iterator, callback) {
                    callback = callback || function () {};
                    if (!arr.length) {
                        return callback();
                    }
                    var completed = 0;
                    var iterate = function () {
                        iterator(arr[completed], function (err) {
                            if (err) {
                                callback(err);
                                callback = function () {};
                            }
                            else {
                                completed += 1;
                                if (completed >= arr.length) {
                                    callback(null);
                                }
                                else {
                                    iterate();
                                }
                            }
                        });
                    };
                    iterate();
                };

            eachSeries(scripts, getScript, initTable);
            formInit();
        });

        function rowStyle(row, index) {
            var classes = [ 'success'];

            if (index % 2 === 0) {
                return {
                    classes: classes[0]
                };
            }
            return {};
        }

        $('#MHS_TGL').datepicker({
            dateFormat: 'yy-mm-dd',
            minDate: '+5d',
            changeMonth: true,
            changeYear: true
        });


    </script>
