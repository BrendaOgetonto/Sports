<!DOCTYPE html>
<html>
<head>
   <title>SU Sports | Injury Details</title>
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
                <h4><b>Dashboard</b> <span class="fa fa-angle-double-right"></span> Injury Details</h4>
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
                <?php foreach($injury_record as $record){ ?>
                <div class="form-group col-md-12 col-lg-12">
                    <strong class="fa-2x"><?php echo $record['player_fname']. " ".$record['player_lname']; ?></strong>
                </div>
                <div class="form-group col-md-12 col-lg-12">
                    <label for="dateOfInjury" class="control-label">Date of Injury</label>
                    <?php echo ": ".date_format(date_create($record['injury_date']),"D j<\s\up>S</\s\up> M, Y"); ?>
                    <br>
                    <label for="dateSeen" class="control-label">Date Seen </label>
                   <?php echo ": ".date_format(date_create($record['date_seen']),"D j<\s\up>S</\s\up> M, Y"); ?>
                </div>
                <div class="form-group col-md-12 col-lg-12 ">
                    <label for="injuryDescription" class="control-label">Injury Description</label>
                    <br><?php echo $record['injury_description']; ?>
                </div>
                <!-- <div class="form-group col-md-12 col-lg-12">
                    <div class="modal-header"></div>
                </div> -->
                <div class="form-group col-md-12 col-lg-12 ">
                    <label for="diagnosis" class="control-label">Diagnosis</label>
                    <br><?php echo $record['diagnosis']; ?>
                </div>
                <!-- <div class="form-group col-md-12 col-lg-12">
                    <div class="modal-header"></div>
                </div> -->
                 <div class="form-group col-md-12 col-lg-12 ">
                    <label for="treatment" class="control-label">Treatment</label>
                    <br><?php echo $record['treatment'];?>
                </div>
               <!--  <div class="form-group col-md-12 col-lg-12">
                    <div class="modal-header"></div>
                </div> -->
                 <div class="form-group col-md-12 col-lg-12 ">
                    <label for="physioRemarks" class="control-label">Physio Remarks</label>
                    <br><?php echo $record['physio_remarks']; ?>
                </div>
                <!-- <div class="form-group col-md-12 col-lg-12">
                    <div class="modal-header"></div>
                </div> -->
                 <div class="form-group col-md-12 col-lg-12 ">
                    <label for="physioRemarks" class="control-label">S&C Coach Remarks</label>
                    <br><?php echo $record['coach_remarks'];} ?>
                </div>
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

})();
//to refresh the page
$( "#refresh").click( function(event)
    {
        window.setTimeout(function(){location.reload()},1)

    });
</script>
</body>
</html>
