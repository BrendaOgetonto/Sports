<!DOCTYPE html>
<html>
<head>
   <title>SU Sports | Captain Profile</title>
<?php $this->load->view('headerlinks/headerlinks.php'); ?> 
</head>
<body class="hold-transition skin-blue sidebar-mini" style="background-color: #222d32;">
<div class="wrapper">
<?php $this->load->view('admin/adminnav'); ?><!--navigation -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row" style="margin-bottom: -15px;">
            <div class="col-lg-12 ">
                <h4><b>Dashboard</b> <span class="fa fa-angle-double-right"></span> Captain Profile</h4>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box" >
            <div class="box-body"  >
             <?php foreach($captains as $captain){ ?>
                    <div class="col-md-3" style="text-align: center;margin-right: auto">
                        <div class="col-md-12" style="display: inline-block;text-align: center">
                            <img src="<?php echo base_url(); ?>assets/img/person.png"
                        alt="" class="img-rounded img-responsive" />
                            <br>
                        </div>
                    </div>
                    <div class="col-md-9 text-center">
                            <div class="col-md-12">
                                    <p style="color: #000000;" class="fa-2x"><?php echo $captain['player_fname']." ".$captain['player_lname']. " ".$captain['player_other_names'];?></p> 
                                    <small><cite title="<?php echo $captain['player_fname'];?>'s residence"><i class="fa fa-map-marker"> </i> <?php echo $captain['player_residence'];?>  </cite></small>
                                <hr>
                            </div>
                            <div class="col-md-6" style="text-align: left">
                                <blockquote >
                                     <p><i class="fa fa-phone text-primary fa-1x"></i> <?php echo $captain['player_phone'];?>  <span><cite title="<?php echo $captain['player_fname'];?>'s phone number"><small style="display: inline">Cell Phone  </small></cite></span> </p>
                                     <p><i class="fa fa-id-card-o text-info fa-1x"></i> <?php echo $captain['player_nid'];?>  <span><cite title="ID Type"><small style="display: inline"><?php echo $captain['id_type'];?>  </small></cite></span> </p>
                                     <p><i class="fa fa-id-card-o text-warning fa-1x"></i> <?php echo $captain['stud_id'];?>  <span><cite title="Strathmore ID"><small style="display: inline">Strathmore ID </small></cite></span> </p>
                                     <p><i class="fa fa-user-circle text-primary fa-1x"></i> <?php echo date_format(date_create($captain['player_dob']),"j<\s\up>S</\s\up> M, Y");?>  <span><cite title="when <?php echo $captain['player_fname'];?> was born"><small style="display: inline">D.O.B </small></cite></span> </p>
                                </blockquote>
                                <hr>
                            </div>
                            <div class="col-md-6" style="text-align: left">
                                <blockquote >
                                     <p><i class="fa fa-level-up text-primary fa-1x"></i> <?php echo $captain['player_height'];?>  <span><cite title="<?php echo $captain['player_fname'];?>'s height"><small style="display: inline">Height(cm)  </small></cite></span> </p>
                                     
                                     <p><i class="fa fa-balance-scale text-warning fa-1x"></i> <?php echo $captain['player_weight'];?>  <span><cite title="<?php echo $captain['player_fname'];?>'s weight"><small style="display: inline">Weight(kg) </small></cite></span> </p>
                                     
                                     <p><i class="fa fa-certificate text-danger fa-1x"></i> <?php echo $captain['stud_course_id'];?>  <span><cite title="course <?php echo $captain['player_fname'];?> takes/took"><small style="display: inline">Course </small></cite></span> </p>
                                     <?php $state= $captain['agreement']; if($state==1){ echo '
                                     <p><i class="fa fa-check-circle-o text-primary fa-1x"></i> Yes <span><cite title="Agreement to terms"><small style="display: inline"> Agreed to terms</small></cite></span> </p>';}else{echo '
                                     <p><i class="fa fa-exclamation-circle text-danger fa-1x"></i>Yes  <span><cite title="course';  echo $captain['player_fname']; echo 'takes/took"><small style="display: inline"> </small></cite></span> </p>';}?>
                                </blockquote>
                            <hr>
                            </div>
                    </div>
                    <div class="col-md-12 text-center">
                    <hr>
                          <blockquote >
                            <div class="col-md-12" style="text-align: left">
                             <p><i class="fa fa-info-circle  text-info fa-1x"></i> <?php echo $captain['player_fname']. " ".$captain['player_lname'] ;?> has been the captain of <?php echo $captain['team_category']." ";?> since <?php echo date_format(date_create($captain['date_appointed']),"j<\s\up>S</\s\up> M, Y");?>. <?php $endDate=$captain['end_of_tenure'];if($endDate==""){echo "<b style='color:darkgreen'> <i class='fa fa-check-circle-o'></i> Tenure Ongoing</b>";}else{ echo date_format(date_create($captain['end_of_tenure']),"j<\s\up>S</\s\up> M, Y");}?><span></p>
                            </div>
                        </blockquote>
                    </div>
                <?php }?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view('footer');?>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php $this->load->view('scriptlinks/scriptlinks.php'); ?>
<script>
    // Limit scope pollution from any deprecated API
(function() {

    var matched, browser;

// Use of jQuery.browser is frowned upon.
// More details: http://api.jquery.com/jQuery.browser
// jQuery.uaMatch maintained for back-compat
    jQuery.uaMatch = function( ua ) {
        ua = ua.toLowerCase();

        var match = /(chrome)[ \/]([\w.]+)/.exec( ua ) ||
            /(webkit)[ \/]([\w.]+)/.exec( ua ) ||
            /(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
            /(msie) ([\w.]+)/.exec( ua ) ||
            ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
            [];

        return {
            browser: match[ 1 ] || "",
            version: match[ 2 ] || "0"
        };
    };

    matched = jQuery.uaMatch( navigator.userAgent );
    browser = {};

    if ( matched.browser ) {
        browser[ matched.browser ] = true;
        browser.version = matched.version;
    }

// Chrome is Webkit, but Webkit is also Safari.
    if ( browser.chrome ) {
        browser.webkit = true;
    } else if ( browser.webkit ) {
        browser.safari = true;
    }

    jQuery.browser = browser;

    jQuery.sub = function() {
        function jQuerySub( selector, context ) {
            return new jQuerySub.fn.init( selector, context );
        }
        jQuery.extend( true, jQuerySub, this );
        jQuerySub.superclass = this;
        jQuerySub.fn = jQuerySub.prototype = this();
        jQuerySub.fn.constructor = jQuerySub;
        jQuerySub.sub = this.sub;
        jQuerySub.fn.init = function init( selector, context ) {
            if ( context && context instanceof jQuery && !(context instanceof jQuerySub) ) {
                context = jQuerySub( context );
            }

            return jQuery.fn.init.call( this, selector, context, rootjQuerySub );
        };
        jQuerySub.fn.init.prototype = jQuerySub.fn;
        var rootjQuerySub = jQuerySub(document);
        return jQuerySub;
    };

})();</script>

</body>
</html>
