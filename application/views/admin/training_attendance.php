<!DOCTYPE html>
<html>
<head>
   <title>SU Sports | Training Attendance</title>
<?php $this->load->view('headerlinks/headerlinks.php'); ?> 
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
                <h4><b>Dashboard</b> <span class="fa fa-angle-double-right"></span> Training Attendance</h4>
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
                <div class="col-md-12 col-lg-12">
                    <span data-placement="top" data-toggle="tooltip" title="Refresh">
                        <button class="btn btn-s btn-default" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh
                        </button>
                    </span>
                </div>
                
                <div class="col-md-12 col-lg-12" style="margin-top: 10px;">
                    <div class="messagebox alert alert-success" style="display: none;" id="success">
                        <button type="button" class="close" data-dismiss="alert">*</button>
                        <div class="cs-text">
                            <i class="fa fa-check"></i>
                            <strong><span>Attendance Recorded</span></strong>
                        </div> 
                    </div>
                    <div class="messagebox alert alert-info" style="display: none;" id="isEmpty">
                        <button type="button" class="close" data-dismiss="alert">*</button>
                        <div class="cs-text">
                            <i class="fa fa-info-circle"></i>
                            <strong><span>No attendance selected</span></strong>
                        </div> 
                    </div>
                     <div class="messagebox alert alert-info" style="display: none;width: fixed" id="exists">
                        <button type="button" class="close" data-dismiss="alert">*</button>
                        <div class="cs-text">
                            <i class="fa fa-info-circle"></i>
                            <strong><span>Attendance for today exists</span></strong>
                        </div> 
                    </div>
                </div>
                <table  class="table table-striped table-bordered table-hover display responsive" cellspacing="0" width="100%" id="attlist"  >
                    <thead>
                        <tr>
                            <th class="text-left">Full Name</th>
                            <th class="text-center" id="pid">Player PID</th>
                            <th class="text-center">Present</th>
                            <th class="text-center">Absent</th>
                            <th class="text-center">Apology</th>
                            <th class="text-center">Physio</th>
                         </tr>
                    </thead>
                    <tbody >
                       <?php foreach($players as $player){ 
                           ?>
                        <tr>
                            <td class="text-left"><?php  echo $player['player_fname']. " ".$player['player_lname'];?></td>
                            <td class="text-left"><?php  echo $player['player_auto_id']; ?></td>

                            <td class="text-center"><span class="text-success">PRESENT <input  type="radio" name=<?php echo '"player_'. $player['player_auto_id'].'"';  ?> value="PRESENT" ></span> &nbsp;&nbsp;</td>

                            <td class="text-center"><span class="text-danger">ABSENT <input type="radio" name=<?php echo '"player_'. $player['player_auto_id'].'"';  ?> value="ABSENT"></span>&nbsp;&nbsp;</td>

                            <td class="text-center"><span class="text-info">APOLOGY <input type="radio" name=<?php echo '"player_'. $player['player_auto_id'].'"';  ?> value="APOLOGY"></span> &nbsp;&nbsp;</td>

                            <td class="text-center"><span class="text-primary">PHYSIO <input type="radio" name=<?php echo '"player_'. $player['player_auto_id'].'"';  ?> value="PHYSIO"></span>  </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- /.table-responsive -->

                <!-- submit button -->
                <button id="submit" class="btn btn-primary" style="margin-top: 10px" >Submit</button>
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

$(document).ready(function () {
    $("#attlist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh
    //define datatable
     var table=$('#attlist').dataTable({paging:false,responsive:true,
         "aoColumnDefs": [{ "aTargets": [2,3,4,5], "orderable": false},{ "aTargets":1,responsivePriority:1}]

            });
     $( "#submit").on('click', function()
        {
            var selected = [];
            $('#attlist input:radio:checked').each(function() {
               var $item = $(this);
                selected.push({
                    // id: $item.attr("id"),
                   playerPID: $('td:nth-child(2)', $(this).parents('tr')).text(),
                     status: $item.val()
                });
            });
            // alert(JSON.stringify(selected));
               $.ajax(//ajax script to post the data without page refresh
                {
                    type:"post",
                    url: "<?php echo base_url();?>mc/newTraining",
                    dataType: "json",//note the contentType defintion
                    data: {selected:selected},
                    
                    success:function(data)
                    {
                        console.log(data);
                        if(data.successful) {
                              $("#success ").fadeTo(2000, 500).fadeOut("slow");;
                            }else if(data.null){
                                $("#isEmpty").fadeTo(2000, 500).fadeOut("slow");
                            }else if(data.exists){ 
                                $("#exists ").fadeTo(2000, 500).fadeOut("slow");
                            }
                    }
                });
             
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
