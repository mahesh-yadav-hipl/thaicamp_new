 <aside class="left-side sidebar-offcanvas">
            <!-- sidebar: style can be found in sidebar-->
            <section class="sidebar">
                <div id="menu" role="navigation">
                <ul class="navigation">
                    <?php if($_SESSION['login_type'] === "employee"){?>
                        <!-- <li class="menu-dropdown">
                            <a href="#">
                                <i class="text-warning menu-icon fa fa-th fa-store-alt"></i>
                                <span class="mm-text">Store</span>
                                <span class="fa fa-angle-down pull-right"></span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="product_view.php">
                                        <i class="text-warning menu-icon fa fa-codepen"></i>
                                        <span class="mm-text ">Products</span>
                                    </a>
                                </li>
                            </ul>
                        </li> -->
                        <li>
                            <a href="user-profile.php">
                                <i class="text-default   menu-icon fa fa-user"></i>
                                <span class="mm-text">Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="leave_employee.php">
                                <i class="text-primary menu-icon fa fa-fw fa-dashboard"></i>
                                <span class="mm-text ">Leaves</span>
                                <span class="arrow"></span>
                            </a>
                        </li>
                        <li>
                            <a href="private-training.php">
                                <i class="text-success menu-icon fa fa-fw fa-info-circle"></i>
                                <span class="mm-text">Private Training</span>
                            </a>
                        </li>                        
                        <li>
                        <a href="salary_sheet.php?employee_id=<?= $_SESSION['login_id'] ;?>">
                            <i class="text-warning  menu-icon fa fa-building"></i>
                            <span class="mm-text">Salary Statement</span>
                        </a>                         
                    </li>

                     <?php  }else if ($_SESSION['login_type'] === 'subscriber'){?>
                            <li>
                                <a href="user-profile.php">
                                    <i class="text-default  menu-icon fa fa-user"></i>
                                    <span class="mm-text">Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="product_view.php">
                                    <i class="text-warning menu-icon fa fa-th fa-store-alt"></i>
                                    <span class="mm-text">Store</span>
                                </a>
                            </li>
                            <!-- <li class="menu-dropdown">
                                <a href="#">
                                    <i class="text-warning menu-icon fa fa-th fa-store-alt"></i>
                                    <span class="mm-text">Store</span>
                                    <span class="fa fa-angle-down pull-right"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="product_view.php">
                                            <i class="text-warning menu-icon fa fa-codepen"></i>
                                            <span class="mm-text ">Products</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="sell_product.php">
                                            <i class="text-warning menu-icon fa fa-shopping-cart"></i>
                                            <span class="mm-text ">Buy Order List</span>
                                        </a>
                                    </li>
                                </ul>
                            </li> -->
                            <li>
                                <a href="private-training.php">
                                    <i class="text-success menu-icon fa fa-fw fa-info-circle"></i>
                                    <span class="mm-text">Private Training</span>
                                </a>
                            </li>
                            <li>
                                <a href="buy_new_package.php?id=<?= $_SESSION['login_id'] ;?>">
                                    <i class="text-primary menu-icon fa fa-fw fa-money"></i>
                                    <span class="mm-text">Packages</span>
                                </a>
                            </li>
                            
                    <?php }else{ ?>                 
                        
                        <?php if($_SESSION['login_type'] === "admin" && $_SESSION['login_id'] == '1') { ?>
                        <li>
                            <a href="menu_list.php">
                                <i class="text-info menu-icon fa fa-bars"></i>
                                <span class="mm-text ">Contain icons</span>
                                <span class="arrow"></span>
                            </a>
                        </li>
                        <?php } ?>
                        <li>
                            <a href="dashboard.php">
                                <i class="text-primary menu-icon fa fa-fw fa-dashboard"></i>
                                <span class="mm-text ">Dashboard</span>
                                <span class="arrow"></span>
                            </a>
                        </li>
                         <li>
                            <a href="subscription.php">
                                <i class="text-primary menu-icon fa fa-fw fa fa-sign-in"></i>
                                <span class="mm-text ">Enterance</span>
                                <span class="arrow"></span>
                            </a>
                        </li>
                        <!--<li>-->
                        <!--    <a href="packages.php">-->
                        <!--        <i class="text-primary menu-icon fa fa-th fa-info-circle"></i>-->
                        <!--        <span class="mm-text">Packages</span>-->
                        <!--    </a>-->
                        <!--</li>-->
                      
               
                        <!--<li class="menu-dropdown">-->
                        <!--    <a href="events_list.php">-->
                        <!--        <i class="text-danger menu-icon fa fa-fw fa-calendar"></i>-->
                        <!--        <span class="mm-text">Activities</span>-->
                        <!--    </a>-->
                       <!--     <ul class="sub-menu">
                                <li>
                                    <a href="events_list.html">
                                        <i class="text-primary menu-icon fa fa-fw fa-list"></i> Events List
                                    </a>
                                </li>
                                <li>
                                    <a href="event_item.html">
                                        <i class="text-info menu-icon fa fa-fw fa-fast-forward"></i> Event Item
                                    </a>
                                </li>
                            </ul>-->
                        <!--</li>-->
                        
                        <?php if($_SESSION['login_type'] === "admin" && $_SESSION['login_id'] == '1') { ?>
                        <li class="menu-dropdown">
                            <a href="#">
                                <i class="text-warning menu-icon fa fa-th fa-info-circle"></i>
                                <span class="mm-text">Master</span>
                                <span class="fa fa-angle-down pull-right"></span>
                            </a>
                            <ul class="sub-menu">
                                
                                 <li>
                                    <a href="payment_methods.php">
                                        <i class="text-primary menu-icon fa fa-fw fa-credit-card"></i> Payment Methods
                                    </a>
                         
                                </li>
                        
                                <li>
                                    <a href="discount_code.php">
                                        <i class="text-success menu-icon fa fa-fw fa fa-tag"></i> Discount Code
                                    </a>
                            
                                </li>
                                
                                 <li>
                                    <a href="admin.php">
                                        <i class="text-default fa fa-fw fa-user-plus"></i> Admin
                                    </a>
                                </li>
                                
                                 <li>
                                    <a href="subadmin.php">
                                        <i class="text-warning fa fa-fw fa-user-plus"></i> Sub-Admin
                                    </a>
                                </li>
                               
                                 <!-- <li>
                                    <a href="services.php">
                                        <i class="text-info fa fa-fw fa-star"></i> Services
                                    </a>
                                </li> -->
                                  <li>
                                    <a href="class.php">
                                        <i class="text-success fa fa-fw fa-list"></i> Classes
                                    </a>
                                </li>
                                  <li>
                                    <a href="waiting_list.php">
                                        <i class="text-success fa fa-fw fa-list"></i> Waiting List
                                    </a>
                                </li>
                                <li>
                                    <a href="package.php">
                                        <i class="text-success fa fa-fw fa-file-text-o"></i> Packages
                                    </a>
                                </li>
                                
                                 <li>
                            <a href="email.php">
                                <i class="text-warning menu-icon fa fa-fw fa-envelope"></i> Email
                            </a>
                         
                        </li>
                        

                     
                          <li>
                            <a href="expenses.php">
                                <i class="text-warning menu-icon fa fa-fw fa-money"></i> Expenses
                            </a>
                         
                        </li>

 
 <li class="menu-dropdown">
                            <a href="#">
  
                                <i class="text-primary menu-icon fa fa-fw fa-line-chart"></i>
                                <span class="mm-text">report</span>
                                <span class="fa fa-angle-down pull-right"></span>
                            </a>
       <ul class="sub-menu">
    <li>
                            <a href="reports.php">
                                <i class="text-default menu-icon fa fa-fw fa-file"></i> Reports
                            </a>
                         
                        </li>
                         <li>
                            <a href="report_for_finished_subscription.php">
                                <i class="text-warning menu-icon fa fa-fw fa-bar-chart"></i> Report For Finished Subscriptions
                            </a>
                         
                        </li>
                          <li>
                             <a href="report_for_subscription_finish_in_7_days.php">
                                <i class="text-primary menu-icon fa fa-fw fa-line-chart"></i> Report For Finished Subscriptions In 7 Days
                            </a>
                         
                        </li>
                        
                         <li>
                            <a href="report_no_entry.php">
                                <i class="text-default menu-icon fa fa-fw fa-file"></i> Report For No Entry Record More Than 7 Days
                            </a>
                         
                        </li>
                        
                         <li>
                            <a href="cash_flow.php">
                                <i class="text-success menu-icon fa fa-fw fa-pie-chart"></i> Cash Flow
                            </a>
                         
                        </li>
                        <li>
                            <a href="store-reports.php">
                                <i class="text-success menu-icon fa fa-fw fa-pie-chart"></i>Monthly Store Report
                            </a>
                        </li>
                        <li>
                            <a href="transaction-subscriber-reports.php">
                                <i class="text-success menu-icon fa fa-fw fa-pie-chart"></i>Daily Transaction Subscriber Report
                            </a>
                        </li>
                        <li>
                            <a href="sales-subscription-reports.php">
                                <i class="text-success menu-icon fa fa-fw fa-pie-chart"></i>Sales and Subscription Daily Report
                            </a>
                        </li>
                        <li>
                            <a href="cash_flow_of_day.php">
                                <i class="text-success menu-icon fa fa-fw fa-pie-chart"></i> Cash Flow of Day
                            </a>
                            </li>


      </ul>
                        </li>
                         


                              
                               
                            </ul>
                        </li>
                         
                        <?php } ?>

                        
                       
                         
                        <?php if($_SESSION['login_type'] === "admin") { ?>

                            <li class="menu-dropdown">
                                <a href="#">
                                    <i class="text-warning menu-icon fa fa-th fa-store-alt"></i>
                                    <span class="mm-text">Store</span>
                                    <span class="fa fa-angle-down pull-right"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="category.php">
                                            <i class="text-primary menu-icon fa fa-list-alt"></i>
                                            <span class="mm-text ">Categories</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="product_view.php">
                                            <i class="text-warning menu-icon fa fa-codepen"></i>
                                            <span class="mm-text ">Products</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="sell_product.php">
                                            <i class="text-warning menu-icon fa fa-shopping-cart"></i>
                                            <span class="mm-text ">Order List</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="product.php">
                                            <i class="text-warning menu-icon fa fa-shopping-cart"></i>
                                            <span class="mm-text ">Product Stock</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            
                            <!-- <li class="menu-dropdown">
                                <a href="knet_payment.php">
                                    <i class="text-default menu-icon fa fa-fw fa-money"></i>
                                    <span class="mm-text">Knet Payment</span>
                                </a>                         
                            </li> -->
                            <li class="menu-dropdown">
                                <a href="users.php">
                                    <i class="text-default menu-icon fa fa-fw fa-users"></i>
                                    <span class="mm-text">Subscribers</span>
                                </a>                         
                            </li>
                            <!-- <li>
                                <a href="category.php">
                                    <i class="text-primary menu-icon fa fa-list-alt"></i>
                                    <span class="mm-text ">Categories</span>
                                </a>
                            </li>
                            <li>
                                <a href="product.php">
                                    <i class="text-warning menu-icon fa fa-codepen"></i>
                                    <span class="mm-text ">Products</span>
                                </a>
                            </li> -->

                            <li class="menu-dropdown">
                                <a href="#">
                                    <i class="text-primary menu-icon fa fa-users"></i>
                                    <span class="mm-text">Employees</span>
                                    <span class="fa fa-angle-down pull-right"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="employee.php">
                                            <i class="text-warning menu-icon fa fa-users"></i>
                                            <span class="mm-text ">Employees List</span>
                                        </a>
                                    </li>
                                    <li class="menu-dropdown">
                                        <a href="leave_admin.php">
                                            <i class="text-warning  menu-icon fa fa-building"></i>
                                            <span class="mm-text">Leaves</span>
                                        </a>                         
                                    </li>
                                    <li class="menu-dropdown">
                                        <a href="private-training.php">
                                            <i class="text-warning  menu-icon fa fa-fw fa-info-circle"></i>
                                            <span class="mm-text">Private Training</span>
                                        </a>                         
                                    </li>
                                    <!-- <li class="menu-dropdown">
                                        <a href="salary_list.php">
                                            <i class="text-warning menu-icon fa fa-money"></i>
                                            <span class="mm-text">Salary List</span>
                                        </a>                         
                                    </li> -->
                                    <li class="menu-dropdown">
                                        <a href="#">
                                            <i class="text-primary menu-icon fa fa-users"></i>
                                            <span class="mm-text">Salary</span>
                                            <span class="fa fa-angle-down pull-right"></span>
                                        </a>
                                        <ul class="sub-menu">
                                            <li>
                                                <a href="salary_list.php">
                                                    <i class="text-info menu-icon fa fa-users"></i>
                                                    <span class="mm-text ">Salary List</span>
                                                </a>
                                            </li>
                                            <li class="menu-dropdown">
                                                <a href="salary_sheet.php">
                                                    <i class="text-warning  menu-icon fa fa-building"></i>
                                                    <span class="mm-text">Salary Statement</span>
                                                </a>                         
                                            </li>
                                            <!-- <li class="menu-dropdown">
                                                <a href="salary_statement.php">
                                                    <i class="text-warning  menu-icon fa fa-fw fa-info-circle"></i>
                                                    <span class="mm-text">Salary Statement</span>
                                                </a>                         
                                            </li> -->
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!-- <li>
                                <a href="private-training.php">
                                    <i class="text-success menu-icon fa fa-fw fa-info-circle"></i>
                                    <span class="mm-text">Private Training</span>
                                </a>
                            </li> -->

                            <li>
                                <a href="profile.php">
                                    <i class="text-success menu-icon fa fa-fw fa-info-circle"></i>
                                    <span class="mm-text">Profile</span>
                                </a>
                            </li>
                        <?php } ?>
                        <!--<li>
                            <a href="admin_coupon.html">
                                <i class="text-primary  menu-icon fa fa-scissors"></i>
                                <span class="mm-text">Coupons</span>
                            </a>
                        </li>-->
                   <!--     <li class="menu-dropdown">
                            <a href="#">
                                <i class="text-success menu-icon fa fa-fw fa-picture-o"></i>
                                <span class="mm-text">Gallery</span>
                                <span class="fa fa-angle-down pull-right"></span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="add_gallery.html">
                                        <i class="text-primary fa fa-fw fa-cloud-upload"></i> Add Gallery
                                    </a>
                                </li>
                                <li>
                                    <a href="gallery.html">
                                        <i class="text-success fa fa-fw fa-file-image-o"></i> Gallery
                                    </a>
                                </li>
                            </ul>
                        </li>-->
                        <!--<li>-->
                        <!--    <a href="schedule.php">-->
                        <!--        <i class="text-info menu-icon fa fa-fw fa-clock-o"></i>-->
                        <!--        <span class="mm-text "> Schedule</span>-->
                        <!--    </a>-->
                        <!--</li>-->

                         <?php } ?>
                        <li>
                            <a href="logout.php">
                                <i class="text-info menu-icon fa fa-fw fa fa-sign-out"></i>
                                <span class="mm-text ">Logout</span>
                            </a>
                        </li>
                       
                      
                   
                    </ul>

         
                    <!-- / .navigation -->
                </div>
                <!-- menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
        <style>
            ol.breadcrumb {
            display: none;
            }
/*            .panel-primary > .panel-heading {
    margin-bottom:25px;
    float: left;
    width: 100%;
}
.panel-title {
    
    float: left;
    width: 80%;
}
.panel-heading span {
    margin-top: 10px;
}
.panel-body {
    padding: 15px;
    float: left;
    width: 100%;
}
.panel {
    margin-top: 16px;
    border-color: #f6f6f6;
    float: left;
    width: 100%;
}*/
section.content-header {
    background-color: #fff;
    padding: 10px;
    float: left;
    width: 100%;
}
.col-lg-12 {
    width: 100%;
    padding-left: 0px;
    padding-right: 0px;
}
.riot a {
    color: #fff;
    padding-top: 10px;
    float: left;
    font-size: 20px;
    padding-right: 12px;
}
body > .header .logo {
    display: block;
    float: left;
    height: 50px;
    line-height: 40px;
    padding: 0;
    text-align: left;
    width: 25%;
    /* margin-bottom: 20px; */
}
.left-side {
    top: 72px;
}
.bg-primary {
    float: left;
    background-color: #33a4d8;
    width: 100%;
}
.box {
    width: 456px;
}
.panel.panel-primary .pull-right {
    display: none;
}
.se-pre-con {
    display: none !important;
}
body > .header .navbar .sidebar-toggle {
    
    margin-left: -64px;
}
</style>