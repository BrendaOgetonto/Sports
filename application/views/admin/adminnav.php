  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b class="fa fa-expand" data-toggle="push-menu"></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><small>SU<b> SP <i class="fa fa-soccer-ball-o fa-spin" style="color: #000080;"></i> RTS</b></span></small>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <style>#sidebar-toggle:hover{background-color: #222d32;}</style>
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" id="sidebar-toggle">
        <span class="sr-only">Toggle navigation</span><span style="font-weight: bolder;color: #FFFFFF;">DOS</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Michael Owiti
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Rugby team ...</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>assets/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Irene 
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>I am held up today...</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
         
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url();?>assets/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('adminName');?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('adminName');?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="<?php echo base_url();?>dos/dashboard""><i class="fa fa-dashboard text-aqua"></i> <span>Dashboard</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            
            <li>
                <a href="<?php echo base_url();?>dos/coaches"><i class="fa fa-caret-right fa-fw"></i>&nbsp; Coaches</a>
            </li>
            <li>
                <a href="<?php echo base_url();?>dos/captains"><i class="fa fa-caret-right fa-fw"></i>&nbsp; Captains</a>
            </li>
            <li>
                <a href="<?php echo base_url();?>dos/physiotherapists"><i class="fa fa-caret-right fa-fw"></i>&nbsp; Physiotherapist</a>
            </li>
          </ul>
        </li>
         <li class="treeview">
          <a href="#">
            <i class="fa fa-bars"></i> <span>Training</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <!-- <ul class="treeview-menu">
            <li>
                 <a  href="<?php echo base_url(); ?>mc/trds"><i class="fa fa-caret-right fa-fw" aria-hidden="true" ></i> Training Days</a>   
            </li>
            <li>
                <a href="<?php echo base_url('mc/trat');?>"><i class="fa fa-caret-right fa-fw" ></i> Training Attendance</a>
            </li>
          </ul> -->
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-medkit"></i> <span>Injuries</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
                <a href="<?php echo base_url('dos/allinjuries');?>"><i class="fa fa-caret-right fa-fw " aria-hidden="true" ></i> Injury Records</a>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-money"></i> <span>Expenditure</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
                <a href="<?php  echo base_url('dos/allexpenditures');?>"><i class="fa fa-caret-right fa-fw " aria-hidden="true" ></i> Expenditure <span style="color: #1ABC9C;">(All Teams)</span></a>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-puzzle-piece"></i> <span>Matches</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        <li class="header" style="color: #909497;" > DoS | Sports Department</li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>