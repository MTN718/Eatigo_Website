<div class="box">
    <div class="box-header">
        <h3 class="box-title">Users</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>UserName</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Type</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($users as $user) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $user->name; ?></td>
                        <td><?php echo $user->email; ?></td>
                        <td>
                            <?php
                            if ($user->role == "0")
                                echo "Customer";
                            else if ($user->role == "1")
                                echo "Vendor";
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($user->type == "0")
                                echo "Email";
                            else if ($user->role == "1")
                                echo "Facebook";
                            ?>
                        </td>
                        <td>
                            <a href='index.php?c=main&m=deleteUser&id=<?php echo $user->no; ?>'>Delete</a>&nbsp;&nbsp;&nbsp;
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