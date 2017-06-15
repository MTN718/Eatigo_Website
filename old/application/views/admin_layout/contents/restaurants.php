<div class="box">
    <div class="box-header">
        <h3 class="box-title">Restaurants</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Address</th>                   
                    <th>Opening</th>                    
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($restaurants as $restaurant) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $restaurant->name; ?></td>
                        <td><?php echo $restaurant->address; ?></td>
                        <td><?php echo $restaurant->start_time."~".$restaurant->end_time; ?></td>                        
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