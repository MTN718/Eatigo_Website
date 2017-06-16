<div class="box">
    <div class="box-header">
        <h3 class="box-title">Request</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Date</th>                                       
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($reports as $request) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $request->user; ?></td>
                        <td><?php echo $request->title; ?></td>
                        <td><?php echo $request->content; ?></td>
                        <td><?php echo $request->createtime; ?></td>                                                                        
                        <td>
                            <a href='<?php echo base_url() . ADMIN_ACTION_REPORT_DELETE . "/" . $request->no; ?>'>Delete</a>&nbsp;&nbsp;&nbsp;
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>            
        </table>
    </div>
    <!-- /.box-body -->
</div>