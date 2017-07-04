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
            
            <?php
            if ($pageName == "Discounts")
                echo "<li class='active'>";
            else
                echo "<li>";
            ?>            
            <a href="<?php echo base_url() . ADMIN_PAGE_DISCOUNTS; ?>">
                <i class="fa fa-area-chart"></i> <span>Discount Management</span>            
            </a>
            </li> 
            
            <?php
            if ($pageName == "Transactions")
                echo "<li class='active'>";
            else
                echo "<li>";
            ?>            
            <a href="<?php echo base_url() . ADMIN_PAGE_TRANSACTION; ?>">
                <i class="fa fa-credit-card"></i> <span>Transaction Management</span>            
            </a>
            </li>
            
            <?php
            if ($pageName == "Requests")
                echo "<li class='active'>";
            else
                echo "<li>";
            ?>            
            <a href="<?php echo base_url() . ADMIN_PAGE_REPORT; ?>">
                <i class="fa fa-inbox"></i> <span>Request Inbox</span>            
            </a>
            
            <?php
            if ($pageName == "Contactus")
                echo "<li class='active'>";
            else
                echo "<li>";
            ?>            
            <a href="<?php echo base_url() . ADMIN_PAGE_CONTACTUS; ?>">
                <i class="fa fa-phone-square"></i> <span>Contact Us</span>            
            </a>
            </li>
            <?php
            if ($pageName == "Terms")
                echo "<li class='active'>";
            else
                echo "<li>";
            ?>            
            <a href="<?php echo base_url() . ADMIN_PAGE_TERMS; ?>">
                <i class="fa fa-book"></i> <span>Terms and Condition</span>            
            </a>
            </li>
            
            <?php
            if ($pageName == "Faq")
                echo "<li class='active'>";
            else
                echo "<li>";
            ?>            
            <a href="<?php echo base_url() . ADMIN_PAGE_FAQ; ?>">
                <i class="fa fa-question-circle"></i> <span>Faq</span>            
            </a>
            </li>
            <li class='active treeview'>
                <a href="#">
                    <i class="fa fa-database"></i> <span>Base Data Management</span> <i class="fa fa-angle-right pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <!--                    <?php
                    if ($pageName == "Countrys")
                        echo "<li class='active'>";
                    else
                        echo "<li>";
                    ?>
                                        <a href="<?php echo base_url() . ADMIN_PAGE_COUNTRYS; ?>">
                                            <i class="fa fa-circle-o"></i> Country Data
                                        </a>
                                    </li>-->
                
                <?php
                if ($pageName == "Cities")
                    echo "<li class='active'>";
                else
                    echo "<li>";
                ?>
                <a href="<?php echo base_url() . ADMIN_PAGE_CITIES; ?>">
                    <i class="fa fa-circle-o"></i> City Data
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
                    if ($pageName == "Subcategorys")
                        echo "<li class='active'>";
                    else
                        echo "<li>";
                    ?>
                    <a href="<?php echo base_url() . ADMIN_PAGE_SUBCATEGORY; ?>">
                        <i class="fa fa-circle-o"></i> Sub Category Data
                    </a>
                </li>         
                <?php
                    if ($pageName == "Memberships")
                        echo "<li class='active'>";
                    else
                        echo "<li>";
                    ?>
                    <a href="<?php echo base_url() . ADMIN_PAGE_MEMBERSHIPS; ?>">
                        <i class="fa fa-circle-o"></i> Membership Plans
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
                <?php
                if ($pageName == "Currencys")
                    echo "<li class='active'>";
                else
                    echo "<li>";
                ?>
                <a href="<?php echo base_url() . ADMIN_PAGE_CURRENCYS; ?>">
                    <i class="fa fa-circle-o"></i> Currency Data
                </a>
                </li>
            </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>