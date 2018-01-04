<div class="row">
    <div class="col-sm-12">
        <script>
            init.push(function () {
                $('#jq-datatables-example').dataTable();
                $('#jq-datatables-example_wrapper .table-caption').text('<?php echo $explode[1] ?> Information');
                $('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
            });
        </script>
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">View Account</span>
                <span class="panel-title">&nbsp;|&nbsp;</span>
                <span class="panel-title">View Account</span>
            </div>
            <div class="panel-body">
                <div class="table-primary">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>#</th>
                                <th>#</th>
                                <th>#</th>
                                <th>Rendering engine</th>
                                <th>Browser</th>
                                <th>Platform(s)</th>
                                <th>Engine version</th>
                                <th>CSS grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($index = 0; $index < 50; $index++) {
                                ?>
                                <tr class="odd gradeX">
                                    <td>#</td>
                                    <td>#</td>
                                      <td><a href="#"><i class="fa fa-times"></i></a></td>
                                    <td><a href="#"><i class="fa fa-edit"></i></a></td>
                                    <td>Trident <?php echo $index ?></td>
                                    <td>Internet Explorer 4.0</td>
                                    <td>Win 95+</td>
                                    <td class="center"> 4</td>
                                    <td class="center">X</td>
                                </tr>

                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>