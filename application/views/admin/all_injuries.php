<!DOCTYPE html>
<html>
<head>
   <title>SU Sports | Injury Records</title>
<?php $this->load->view('headerlinks/headerlinks.php'); ?> 
   <link href="<?php echo base_url(); ?>assets/general-css/general.css" rel="stylesheet" type="text/css" />
</head>
<body class="hold-transition skin-blue sidebar-mini" style="background-color: #222d32;">
<div class="wrapper">
<?php  $this->load->view('admin/adminnav'); ?><!--navigation -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row " style="margin-bottom: -15px;">
            <div class="col-lg-12 " >
                <h4 class="pull-left"><b>Dashboard</b> <span class="fa fa-angle-double-right"></span> Injury Records</h4>
                <div class="pull-right">
                    <span data-placement="top" data-toggle="tooltip" title="Refresh">
                        <button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh
                        </button>
                    </span>                </div> 
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
                 <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%" id="injurylist"  >
                    <thead>
                        <tr>        
                            <th class="text-center">Injury Date</th>
                            <th class="text-center">Full Name</th>
                            <th class="text-center">Team</th>
                            <th class="text-center">Diagnosis</th>
                            <th class="text-center">Treatment</th>
                            <th class="text-center"></th>
                         </tr>
                    </thead>
                    <tbody >
                    <?php foreach($injuries as $record)
                        { ?>
                        <tr>
                             <td class="text-left"><?php echo date_format(date_create($record['injury_date']),"D j<\s\up>S</\s\up> M, Y");?></td>
                             <td class="text-left"><?php  echo $record['player_fname']. " ".$record['player_lname']; ?></td>
                            <td class="text-left"><?php echo $record['team_category'];?></td>
                            <td class="text-left"><?php echo $record['diagnosis'];?></td>
                            <td class="text-left"><?php echo $record['treatment'];?></td>
                            <td class="text-center">
                            <?php  echo '<form style="display:inline;" name='; echo '"formMore_'. $record['injury_auto_id'].'"';  echo 'method="post" action="'; echo base_url('coach/cmai');echo '">
                                <div class="form-group col-md-12 col-lg-12" style="display:none">
                                    <label for="recordId" class="control-label">Record ID*</label>
                                    <input required="required" class="form-control" name="recordId" id="recordId" placeholder="101" value="'; echo $record['injury_auto_id'];echo '">
                                </div>
                                <button class="btn btn-default btn-xs" data-title="More Details" id='; echo '"more_'. $record['injury_auto_id'].'"';  echo ' name='; echo '"more_'. $record['injury_auto_id'].'"'; echo 'type="submit" style="background-color:#374850;color:#FFFFFF;"><span class ="fa fa-eye"></span> More Details</button>
                                </form> ';?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- /.table-responsive -->
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
<script>
$(document).ready(function () {
    //datatable initialization
     $('#injurylist').dataTable({responsive:true,"iDisplayLength": 7,"lengthMenu": [[7, 25, 50, 100, 200, -1], [7, 25, 50, 100, 200, "All"]],
          columnDefs: [ 
        { orderable: false, targets: [4] },{targets: [2,3],render: function ( data, type, row ) {
            return type === 'display' && data.length > 25 ? data.substr( 0,25 ) +'<small>...</small>' : data;} }]
            , "aaSorting": []
   });  
  });
//to refresh the page
$( "#refresh").click( function(event)
    {
        window.setTimeout(function(){location.reload()},1)

    });
</script>
</body>
</html>
