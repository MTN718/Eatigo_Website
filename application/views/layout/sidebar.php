<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->        

        <ul class="sidebar-menu">        
            <?php
            if ($pageName == "USERMANAGE")
                echo "<li class='active'>";
            else
                echo "<li>";
            ?>            
            <a href="index.php?c=main&m=users">
                <i class="fa fa-table"></i> <span>User Management</span>            
            </a>
            </li>
            <?php
            if ($pageName == "WELCOMEMANAGE")
                echo "<li class='active'>";
            else
                echo "<li>";
            ?>            
            <a href="index.php?c=main&m=welcomes">
                <i class="fa fa-table"></i> <span>Welcome Screen Management</span>            
            </a>
            </li>
            <?php
            if ($pageName == "CATEGORYMANAGE")
                echo "<li class='active'>";
            else
                echo "<li>";
            ?>            
            <a href="index.php?c=main&m=categorys">
                <i class="fa fa-table"></i> <span>Category Management</span>            
            </a>
            </li>
            <?php
            if ($pageName == "PROJECTMANAGE")
                echo "<li class='active'>";
            else
                echo "<li>";
            ?>            
            <a href="index.php?c=main&m=channels">
                <i class="fa fa-table"></i> <span>Project Management</span>            
            </a>
            </li>            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>