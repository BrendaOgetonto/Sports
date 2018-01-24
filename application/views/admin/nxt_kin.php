<!DOCTYPE html>
<html>
<head>
   <title>SU Sports | Next of Kin</title>
<?php $this->load->view('headerlinks/headerlinks.php'); ?> 
   <link href="<?php echo base_url(); ?>assets/general-css/smsgeneral.css" rel="stylesheet" type="text/css" />

</head>
<body class="hold-transition skin-blue sidebar-mini" style="background-color: #222d32;">
<div class="wrapper">
<?php $coachnav= $this->session->userdata('coachnav'); $this->load->view($coachnav); ?><!--navigation -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row ">
            <div class="col-lg-12 ">
                <h4><b>Dashboard</b> <span class="fa fa-angle-double-right"></span> Next of Kin</h4>
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
               <?php foreach($nxtkin as $nxt){ ?>
                    <div class="col-md-9 text-left">
                        <div class="col-md-12">
                            <p class="fa-2x"><?php echo $nxt['kin_fname']." ".$nxt['kin_lname']. " ".$nxt['kin_other_names'];?></p> 
                            <small><cite title="Player"><b><i class="fa fa-user-o text-primary fa-2x"></i></b> Player: <?php echo $nxt['player_fname']." ".$nxt['player_lname']. " ".$nxt['player_other_names'];?>  </cite></small>
                            <br><br>
                        </div>
                        <div class="col-md-12" style="text-align: left">
                            <blockquote >
                                 <p><i class="fa fa-phone text-primary fa-1x"></i> <?php echo $nxt['kin_phone'];?>  <span><cite title="<?php echo $nxt['kin_fname'];?>'s phone number"><small style="display: inline">Cell Phone  </small></cite></span> </p>
                                 <p><i class="fa fa-phone text-warning fa-1x"></i> <?php echo $nxt['kin_alt_phone'];?>  <span><cite title="<?php echo $nxt['kin_fname'];?>'s alternative phone number"><small style="display: inline">Alternate Cell Phone  </small></cite></span> </p>

                                 <p><i class="fa fa-id-card-o text-info fa-1x"></i> <?php echo $nxt['kin_nid'];?>  <span><cite title="ID Type"><small style="display: inline"><?php echo $nxt['id_type'];?>  </small></cite></span> </p>
                                 
                            </blockquote>
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
