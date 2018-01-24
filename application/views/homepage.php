
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/su_icon" type="image/x-icon" />
        <title>SUSMS</title>

        <!-- bootstrap -->
        <link href="<?php echo base_url();?>assets/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
        
         <!-- DataTables CSS -->
        <link href="<?php echo base_url();?>assets/datatables/css/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="<?php echo base_url();?>assets/datatables/css/dataTables.responsive.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- Custom CSS -->
        <link href="<?php echo base_url();?>assets/sb-admin-2/css/sb_admin_2.css" rel="stylesheet">

        <link href="<?php echo base_url();?>assets/general-css/login.css" rel="stylesheet">

        <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    </head>

    <body id="body" style="border:1px solid">

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href=""><img width="254px;" src="<?php echo base_url(); ?>assets/img/su_logo.png"/></a>
                </div>
                <!-- /.navbar-header -->
                <!-- /.navbar-top-links -->
            </nav>
            <div id="page-wrapper">
                <div class="container">
                    <div class="omb_login" >

                        <h3 class="omb_authTitle" style="color: darkblue;font-weight: bolder;margin-top: 5%">
                        Welcome to Strathmore Sports Management System</h3>

                        <div class="row omb_row-sm-offset-3">
                            <div class="col-xs-12 col-sm-6">
                            <?php $msg = $this->session->flashdata('msg');
                                $failed=  $msg['error']; if ($failed!=""){ echo '
                                <div class="messagebox alert alert-danger" style="display: block">
                                        <button type="button" class="close" data-dismiss="alert">*</button>
                                        <div class="cs-text text-left">
                                            <i class="fa fa-exclamation-triangle fa-2x pull-left"></i>
                                            <strong><span style="font-size:14px">';echo $msg['error']; echo '</span></strong>
                                        </div> 
                                </div>';}?>    
                                <form class="omb_loginForm" accept-charset="UTF-8" role="form" autocomplete="off" method="POST" action="<?php echo base_url(); ?>lg/login">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" name="username" placeholder="Username">
                                    </div>
                                    <span class="help-block"></span>
                                                        
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input  type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                    <br>
                                    <!-- <span class="help-block">Password error</span> -->

                                    <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
                                </form>
                            </div>
                        </div>        
                    </div>
                </div>

            </div><!--page-wrapper-->
               <div class="footer-bottom" id="footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 widget " style="background: darkred;height: auto;padding-top: "><span class="pull-left"> © 2017 Phenom Research Lab | <span style="color:orange">Project 2017/003</span>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
              
        
     <?php $this->load->view('scriptlinks/scriptlinks.php'); ?>

    </body>

</html>
