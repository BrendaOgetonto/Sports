  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b class="fa fa-expand" data-toggle="push-menu"></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><small><b> SP <i class="fa fa-soccer-ball-o fa-spin" style="color: #000080;"></i> RTS</b></span></small>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <style>#sidebar-toggle:hover{background-color: #222d32;}</style>
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" id="sidebar-toggle">
        <span class="sr-only">Toggle navigation</span><span style="text-transform:uppercase;font-weight: bolder;color: #FFFFFF;"><?php echo $this->session->userdata('coachSportName');?></span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img  src="<?php echo base_url();?>assets/img/person.png" width="30" height="30"  class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('coachName');?></span>
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
          <img  src="<?php echo base_url();?>assets/img/person.png"  class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('coachName');?></p>
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
        <li><a href="<?php echo base_url();?>coach/dashboard""><i class="fa fa-dashboard text-aqua"></i> <span>Dashboard</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Players</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
                <a href="<?php echo base_url();?>coach/players"><span style="color: #1ABC9C;"><i class="fa fa-caret-right fa-fw"></i>&nbsp; Players</span></a>
            </li>
            <li>
                <a href="<?php echo base_url();?>coach/playerpassports"><span style="color: #1ABC9C;"><i class="fa fa-caret-right fa-fw"></i>&nbsp; Passports</span></a>
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
          <ul class="treeview-menu">
            <li>
                 <a  href="<?php echo base_url(); ?>coach/trainingdays"><span style="color: #1ABC9C;"><i class="fa fa-caret-right fa-fw" aria-hidden="true" ></i> Training Days</span></a>   
            </li>
            <li>
                <a href="<?php echo base_url('coach/trainingattendance');?>"><span style="color: #1ABC9C;"><i class="fa fa-caret-right fa-fw" ></i> Attendance</span></a>
            </li>
          </ul>
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
                <a href="<?php echo base_url('coach/injuries');?>"><span style="color: #1ABC9C;"><i class="fa fa-caret-right fa-fw " aria-hidden="true" ></i> Injury Records</span></a>
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
            <?php $teams=$this->session->userdata('perSportTeams');

            if($teams=="")
              {?> <!-- check if a team exists for the sport-->
            <li>
              <a href="#"><span style="color: #1ABC9C;"><i class="fa fa-caret-right fa-fw " aria-hidden="true" ></i>No Team</span></a>
            </li>

             <?php }else{foreach($teams as $team){ ?>
            <li>
                <a href="<?php echo base_url('coach/expenses_');echo strtolower($team['team_category']);?>"><span style="color: #1ABC9C;"><i class="fa fa-caret-right fa-fw " aria-hidden="true" ></i><?php echo $team['team_name'];?></span></a>
            </li>
            <?php }} ?>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-puzzle-piece"></i> <span>Matches</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php $teams=$this->session->userdata('perSportTeams');
            
            if($teams=="")
              {?> <!-- check if a team exists for the sport-->
                <a href="#" ><i class="fa fa-caret-right" style="color: #1ABC9C;"></i><span style="color: #1ABC9C;">No Teams</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a> 

            <?php }else{foreach($teams as $team){ ?>
              <li class="treeview">
                <a href="#" ><i class="fa fa-caret-right" style="color: #1ABC9C;"></i><span style="color: #1ABC9C;"><?php echo $team['team_name'];?></span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="<?php echo base_url();echo 'coach/'.strtolower($team['team_category']);;echo 'tournaments';?>"><i class="fa fa-caret-right"></i> Tournaments</a></li>
                </ul>
              </li>
            <?php } }?>
          </ul>
        </li>
        <!-- Uploads -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-upload"></i> <span>Coach Uploads</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
                <a href="<?php echo base_url('coach/sportspecificrpts');?>"><span style="color: #1ABC9C;"><i class="fa fa-caret-right fa-fw " aria-hidden="true" ></i> Specific</span></a>
            </li>
            <li>
                <a href="<?php echo base_url('coach/sportsgeneralrpts');?>"><span style="color: #1ABC9C;"><i class="fa fa-caret-right fa-fw " aria-hidden="true" ></i> General</span></a>
            </li>
          </ul>
        </li>
        <li class="header" style="color: #909497;" > DoS | Sports Department</li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>