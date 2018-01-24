<!DOCTYPE html>
<html>
<head>
   <title>SU Sports | Player Yellow Fever Card</title>
<?php $this->load->view('headerlinks/headerlinks.php'); ?> 
</head>
<body class="hold-transition skin-blue sidebar-mini" style="background-color: #222d32;">
<div class="wrapper">
<?php $coachnav= $this->session->userdata('coachnav'); $this->load->view($coachnav); ?><!--navigation -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row" style="margin-bottom: -15px;">
            <div class="col-lg-12 ">
                <h4><b>Dashboard</b> <span class="fa fa-angle-double-right"></span> Player Passport Yellow Fever Card</h4>
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
             <?php foreach($card_details as $yfc){ 
                $photo=$yfc['card_photo']; if($photo==""){$yfc="default_yfc.jpg";}else{$yfc=$yfc['card_photo'];}?>
                     <a href="<?php echo base_url();?>coach/download_playeryfc/<?php echo $pspt;?>">
                      <div class="col-md-6" style="text-align: center;margin-right: auto">
                        <div class="col-md-12" style="display: inline-block;text-align: center">
                            <img src="<?php echo base_url();echo 'uploads/YFCard/'.$pspt?>" alt="Player Passpot Image" class="img-rounded img-responsive" />
                            <b><p style="color: #566573;text-transform: uppercase;margin-top: 10px;"><?php echo $yfc['player_fname']." ".$yfc['player_lname'];?> Yellow Fever Card</p></b>
                        </div>
                    </div></a>
                    <div class="col-md-6 text-center">
                            <!-- <div class="col-md-12">
                                    <p style="color: #000000;" class="fa-2x"><?php echo $pst['player_fname']." ".$pst['player_lname']. " ".$pst['player_other_names'];?></p> 
                                    <small><cite title="<?php echo $pst['player_fname'];?>'s residence"><i class="fa fa-map-marker"> </i> <?php echo $pst['player_residence'];?>  </cite></small>
                                <hr>
                            </div> -->
                            <div class="col-md-12" style="text-align: left">
                                <blockquote >
                                     <p><i class="fa fa-calendar text-default fa-1x"></i> <?php echo date_format(date_create($yfc['issue_date']),"j<\s\up>S</\s\up> M, Y");?>  <span><cite title="Date Issued"><small style="display: inline"> Date Issued </small></cite></span> </p>

                                     <p><i class="fa fa-calendar-times-o text-danger fa-1x"></i> <?php echo date_format(date_create($yfc['expiry_date']),"j<\s\up>S</\s\up> M, Y");?>  <span><cite title="Expiry Date"><small style="display: inline"> Expiry Date </small></cite></span> </p>

                                </blockquote>
                                <!-- <hr> -->
                            </div>
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
