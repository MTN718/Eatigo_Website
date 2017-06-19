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
                    <th>Category</th>
                    <th>Address</th>                   
                    <th>Opening</th>                    
                    <th>Promote</th>                    
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
                        <td><?php echo $restaurant->cname; ?></td>
                        <td><?php echo $restaurant->address; ?></td>
                        <td><?php echo $restaurant->start_time."~".$restaurant->end_time; ?></td>                        
                        <td>
                            <?php 
                                if ($restaurant->feature == 0)
                                    echo "None";
                                else echo "Featured";
                            ?>
                        </td>                        
                        <td>
                            <?php
                                if ($restaurant->feature == 0)
                                {
                                    echo "<a href='".base_url().ADMIN_ACTION_RESTAURANT_FEATURE."/".$restaurant->no."'>Set Feature</a>&nbsp;&nbsp;&nbsp;";
                                }
                                else
                                {
                                    echo "<a href='".base_url().ADMIN_ACTION_RESTAURANT_FEATURE."/".$restaurant->no."'>Set Non-Feature</a>&nbsp;&nbsp;&nbsp;";
                                }                                
                            ?>
                            <a href='<?php echo base_url().ADMIN_ACTION_RESTAURANT_DELETE."/".$restaurant->no;?>'>Delete</a>&nbsp;&nbsp;&nbsp;
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