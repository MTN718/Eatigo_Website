<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->        

        <ul class="sidebar-menu">
            <?php
            if ($pageName == "Dashboard")
                echo "<li class='active'>";
            else
                echo "<li>";
            ?>            
            <a href="<?php echo base_url() . ADMIN_PAGE_DASHBOARD; ?>">
                <i class="fa fa-home"></i> <span>Dashboard</span>            
            </a>
            <?php
            if ($pageName == "Users")
                echo "<li class='active'>";
            else
                echo "<li>";
            ?>            
            <a href="<?php echo base_url() . ADMIN_PAGE_USERS; ?>">
                <i class="fa fa-users"></i> <span>User Management</span>            
            </a>
            </li>             
            <?php
            if ($pageName == "Restaurants")
                echo "<li class='active'>";
            else
                echo "<li>";
            ?>            
            <a href="<?php echo base_url() . ADMIN_PAGE_RESTAURANTS; ?>">
                <i class="fa fa-spoon"></i> <span>Restaurant Management</span>            
            </a>
            </li>             
            <li class='active treeview'>
                <a href="#">
                    <i class="fa fa-database"></i> <span>Base Data Management</span> <i class="fa fa-angle-right pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php
                    if ($pageName == "Countrys")
                        echo "<li class='active'>";
                    else
                        echo "<li>";
                    ?>
                    <a href="<?php echo base_url() . ADMIN_PAGE_COUNTRYS; ?>">
                        <i class="fa fa-circle-o"></i> Country Data
                    </a>
                </li>
                <?php
                    if ($pageName == "Categorys")
                        echo "<li class='active'>";
                    else
                        echo "<li>";
                    ?>
                    <a href="<?php echo base_url() . ADMIN_PAGE_CATEGORYS; ?>">
                        <i class="fa fa-circle-o"></i> Category Data
                    </a>
                </li>                
                <?php
                if ($pageName == "Facilitys")
                    echo "<li class='active'>";
                else
                    echo "<li>";
                ?>
                <a href="<?php echo base_url() . ADMIN_PAGE_FACILITYS; ?>">
                    <i class="fa fa-circle-o"></i> Service Data
                </a>
                </li>
                <?php
                if ($pageName == "Languages")
                    echo "<li class='active'>";
                else
                    echo "<li>";
                ?>
                <a href="<?php echo base_url() . ADMIN_PAGE_LANGUAGES; ?>">
                    <i class="fa fa-circle-o"></i> Spoken Language Data
                </a>
                </li>
                <?php
                if ($pageName == "Atmospheres")
                    echo "<li class='active'>";
                else
                    echo "<li>";
                ?>
                <a href="<?php echo base_url() . ADMIN_PAGE_ATMOSPHERES; ?>">
                    <i class="fa fa-circle-o"></i> Atmosphere Data
                </a>
                </li>
            </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>