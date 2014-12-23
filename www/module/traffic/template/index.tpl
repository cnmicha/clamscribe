    <link href="include/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Protocol: all</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="table_traffic" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Time</th>
                            <th>Source IP</th>
                            <th>Source port</th>
                            <th>Dest. IP</th>
                            <th>Dest. port</th>
                            <th>Size</th>
                        </tr>
                        </thead>
                        <tbody>

                        {foreach from=$traffic_arr item=data}
                            <tr>
                                <td>{$data.request_timestamp}</td>
                                <td>{$data.source_ip}</td>
                                <td>{$data.source_port}</td>
                                <td>{$data.dest_ip}</td>
                                <td>{$data.dest_port}</td>
                                <td>X</td>
                            </tr>
                        {/foreach}

                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Time</th>
                            <th>Source IP</th>
                            <th>Source port</th>
                            <th>Dest. IP</th>
                            <th>Dest. port</th>
                            <th>Size</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- DATA TABLES SCRIPT -->
    <script src="include/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="include/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- page script -->
    <script type="text/javascript">
        $(function () {
            $('#table_traffic').dataTable({
                "bPaginate": true,
                "bLengthChange": false,
                "bFilter": false,
                "bSort": true,
                "bInfo": true,
                "bAutoWidth": false
            });
        });
    </script>
