        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom:0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right" >
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                     <?php echo $this->session->userdata('adminName');//session to show who is logged in?>
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <!-- <li><a href="<?php //echo base_url('Home/viewuserprofile?userid='); echo $this->session->userdata('adminID'); ?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li> -->
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url('LoginCtrl/logoutadmin'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <!--manage users-->
                        <li>
                            <a href="#"><i class="fa fa-bars fa-fw"></i> Manage Injuries<span class="fa arrow"></span></a>
                             <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url('MC/injury_record');?>"><i class="fa fa-caret-right fa-fw" aria-hidden="true" ></i> Injury Record</a>
                                </li>
                            </ul>
                            <!--second-level-->
                        </li>
                        <!--manage users-->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
