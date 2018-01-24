<!DOCTYPE html>
<html>
<head>
   <title>SU Sports | ExpenditureDetails</title>
<?php $this->load->view('headerlinks/headerlinks.php'); ?> 
   <link href="<?php echo base_url(); ?>assets/general-css/smsgeneral.css" rel="stylesheet" type="text/css" />
</head>
<body class="hold-transition skin-blue sidebar-mini" style="background-color: #222d32;">
<div class="wrapper">
<?php $this->load->view('admin/adminnav'); ?><!--navigation -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row ">
            <div class="col-lg-12 ">
                <h4><b>Dashboard</b> <span class="fa fa-angle-double-right"></span> Expenditure Details</h4>
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
               <?php foreach($expenses as $exp){ ?>
                    <div class="col-md-12 text-left">
                        <div class="col-md-12">
                            <p style="color: " class="fa-2x"><strong>Category: </strong><?php echo $exp['expense_category'];?></p> 
                            <small><b><span class="fa fa-calendar text-primary fa-2x"></span></b> <span style="color: black;font-size: 17px;"> <strong> &nbsp;&nbsp;Expense Date:</strong> <?php echo date_format(date_create($exp['expense_date']),"D j<\s\up>S</\s\up> M, Y");?></span> </small>
                            <br><br>
                        </div>
                        <div class="col-md-12" style="text-align: left">
                            <blockquote >
                                 <p><span class="text-primary fa-1x">Kshs. </span> <?php echo number_format($exp['expense_cash'],2);?>  <span><cite title="<?php echo $exp['expense_cash'];?> Kshs."><small style="display: inline">Cash  </small></cite></span> </p>
                                 <p><span class="text-primary fa-1x">Kshs. </span> <?php echo number_format($exp['expense_lpo_amount'],2);;?>  <span><cite title="LPO: <?php echo $exp['expense_lpo_amount'];?>' Kshs."><small style="display: inline">LPO Amount (<span style="color: black;font-weight: bold">LPO No: <?php echo $exp['expense_lpo_no'];?></span>)  </small></cite></span> </p>
                                 <p><span class="text-primary fa-1x">Kshs. </span> <?php echo number_format($exp['expense_lunches'],2);?>  <span><cite title="<?php echo $exp['expense_lunches'];?> Kshs."><small style="display: inline">Lunches  </small></cite></span> </p>
                            </blockquote>
                            <hr>
                        </div>
                        <div class="col-md-12" style="text-align: left">
                            <blockquote >
                                 <p><span class="fa fa-comment-o text-warning "></span> <?php echo $exp['expense_comment'];?></p>
                            </blockquote>
                        </div>
                    </div>
                <?php }?>
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
