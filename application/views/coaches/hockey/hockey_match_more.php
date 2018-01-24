<!DOCTYPE html>
<html>
<head>
   <title>SU Sports | Tournament Details</title>
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
                <h4><b>Dashboard</b> <span class="fa fa-angle-double-right"></span> Tournament Details</h4>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box" >
            <div class="box-body">
                <?php foreach($hmatches as $record){ ?>
                <div class="form-group col-md-12 col-lg-12">
                    <span class="fa-2x"><?php echo $record['hkt_title']; ?></span>
                </div>
                <div class="col-md-12" style="text-align: left">
                    <p><i class="fa fa-calendar text-primary fa-1x"></i>&nbsp;&nbsp;  <?php echo date_format(date_create($record['hkt_start_date']),"D j<\s\up>S</\s\up> M, Y")." - ". date_format(date_create($record['hkt_end_date']),"D j<\s\up>S</\s\up> M, Y"); ?>  <span><cite title="<?php echo $record['hkt_end_date'];?>"><small >Match Dates  </small></cite></span> </p>
                </div>
                <div class="col-md-4" style="text-align: left">
                    <p><i class="fa fa-home text-primary fa-1x"></i> <b>Tournament Venue:</b> <?php echo $record['hkt_venue'];?> </p>
                </div>
                <div class="col-md-4" style="text-align: left">
                    <p><i class="fa fa-venus-mars  text-success fa-1x"></i><b> Tournament Category:</b> <?php echo $record['hkt_category'];?> </p>
                </div>
                <div class="col-md-4" style="text-align: left">
                    <p><i class="fa fa-shield text-danger fa-1x"></i><b> Opponents:</b> <?php echo $record['hkt_opponents'];?></p>
                </div>
                <div class="col-md-12" style="text-align: left">
                    <p><b>Preliminaries</b><br> <cite><?php echo $record['hkt_preliminary_scores'];?></cite></p>
                </div>
                <div class="col-md-12" style="text-align: left">
                    <p><b>Quarters</b><br> <cite><?php echo $record['hkt_quarters'];?></cite> </p>
                </div>
                <div class="col-md-12" style="text-align: left">
                    <p><b>Semis</b> <br> <cite><?php echo $record['hkt_semis'];?></cite></p>
                </div>
                <div class="col-md-12" style="text-align: left">
                    <p><b>Finals</b><br><cite><?php echo $record['hkt_finals'];?></cite></p>
                </div>
                <div class="form-group col-md-12 col-lg-12 ">
                    <label for="scorers" class="control-label">Scorers</label>
                    <br><?php echo $record['hkt_scorers']; ?>
                </div>
                
                <div class="form-group col-md-12 col-lg-12 ">
                    <label for="refComments" class="control-label">Comments on Refereeing</label>
                    <br><?php echo $record['hkt_ref_comments']; ?>
                </div>
                <div class="form-group col-md-12 col-lg-12 " style="line-height: 150%;text-align: justify;
    text-justify: inter-word;font-family:Calibri (Body)">
                    <label for="summary" class="control-label">Tournament Summary</label>
                    <br><?php echo $record['hkt_summary']; }?>
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
</script>
</body>
</html>
