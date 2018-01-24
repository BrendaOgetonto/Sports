<!DOCTYPE html>
<html>
<head>
   <title>SU Sports | Scorpions Leagues</title>
<?php $this->load->view('headerlinks/headerlinks.php'); ?> 
</head>
<body class="hold-transition skin-blue sidebar-mini" style="background-color: #222d32;">
<div class="wrapper">
<?php $coachnav= $this->session->userdata('coachnav'); $this->load->view($coachnav); ?><!--navigation -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->
     <section class="content-header">
        <div class="row " style="margin-bottom: -15px;">
            <div class="col-lg-12 " >
                <h4 class="pull-left"><b>Dashboard</b> <span class="fa fa-angle-double-right"></span> Scorpions Leagues</h4>
                <div class="pull-right">
                     <span data-placement="top" data-toggle="tooltip" title="Add League">
                        <button class="btn btn-primary btn-xs" data-title="Add League" data-toggle="modal" data-target="#league-modal" ><span class="fa fa-plus-circle"></span>&nbsp;League</button>
                    </span>
                    <span data-placement="top" data-toggle="tooltip" title="Refresh">
                        <button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh
                        </button>
                    </span>
                    <span data-placement="top" data-toggle="tooltip" title="Print All">
                        <a class="btn btn-xs" data-title="Print All" type="button" href="<?php echo base_url('');?>"><span class="fa fa-print"></span>&nbsp;Print All</a>
                    </span>
                </div> 
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
                <?php $msg = $this->session->flashdata('msg');
                $successful= $msg['success']; $failed=  $msg['error']; if ($successful=="" && $failed!=""){ echo '
                <div class="messagebox alert alert-danger" style="display: block">
                        <button type="button" class="close" data-dismiss="alert">*</button>
                        <div class="cs-text">
                            <i class="fa fa-exclamation-circle"></i>
                            <strong><span>';echo $msg['error']; echo '</span></strong>
                        </div> 
                </div>';}else if($successful=="" && $failed==""){echo '<div></div>';} else if ($successful!="" && $failed==""){ echo '
                <div class="messagebox alert alert-success" style="display: block">
                        <button type="button" class="close" data-dismiss="alert">*</button>
                        <div class="cs-text">
                            <i class="fa fa-check"></i>
                            <strong><span>';echo $msg['success'];echo '</span></strong>
                        </div> 
                </div>';}?>
                 <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%" id="Leagueslist"  >
                    <thead>
                        <tr>
                           <th class="text-left">League Dates</th>
                            <th class="text-left">League Title</th>
                            <th class="text-center"></th>
                         </tr>
                    </thead>
                   <tbody >
                       <?php foreach($hmatches as $hms){ 
                           ?>
                        <tr>
                            <td class="text-left"><?php  echo date_format(date_create($hms['game_start_date']),"j<\s\up>S</\s\up> M, Y")." - ".date_format(date_create($hms['game_end_date']),"j<\s\up>S</\s\up> M, Y"); ?></td>
                            <td class="text-left"><?php  echo $hms['game_title']; ?></td>
                            <td class="text-center">
                                <!-- <form style="display:inline;" name=<?php echo '"formEdit_'. $hms['hkm_auto_id'].'"';  ?> method="post" action="<?php echo base_url('coach/hkedit');?>">
                                    <div class="form-group col-md-12 col-lg-12" style="display:none">
                                        <label for="hmsId" class="control-label">hms ID*</label>
                                        <input required="required" class="form-control" name="hmsId" id="hmsId" placeholder="101" value="<?php echo $hms['hkm_auto_id']; ?>">
                                    </div>
                                    <button class="btn btn-default btn-xs" data-title="Edit Match" id=<?php echo '"edit_'. $hms['hkm_auto_id'].'"';  ?> name=<?php echo '"edit_'. $hms['hkm_auto_id'].'"';  ?>  type="submit" style="background-color: #ECF0F1;color: #000000;"> <span class="fa fa-edit"></span> Edit Match </button>
                                </form> -->
                               <!--  <form style="display:inline;" name=<?php echo '"formMore_'. $hms['hkm_auto_id'].'"';  ?> method="post" action="<?php echo base_url('coach/hockeymatchdetails');?>">
                                    <div class="form-group col-md-12 col-lg-12" style="display:none">
                                        <label for="hmsId" class="control-label">hms ID*</label>
                                        <input required="required" class="form-control" name="hmsId" id="hmsId" placeholder="101" value="<?php echo $hms['hkm_auto_id']; ?>">
                                    </div>
                                    <button class="btn btn-default btn-xs" data-title="View More" id=<?php echo '"more_'. $hms['hkm_auto_id'].'"';  ?> name=<?php echo '"more_'. $hms['hkm_auto_id'].'"';  ?>  type="submit" style="background-color: #7B7D7D;color: #FFFFFF;"> <span class="fa fa-eye"></span> View More </button>
                                </form> -->

                                <form style="display:inline;" name=<?php echo '"formMatch_'. $hms['game_auto_id'].'"';  ?> method="post" action="<?php echo base_url('coach/scorpleaguematches');?>">
                                    <div class="form-group col-md-12 col-lg-12" style="display:none">
                                        <label for="gameId" class="control-label">League ID*</label>
                                        <input required="required" class="form-control" name="gameId" id="gameId" value="<?php echo $hms['game_auto_id']; ?>">
                                    </div>
                                    <div class="form-group col-md-12 col-lg-12" style="display:none">
                                        <label for="leagueTitle" class="control-label">League Title*</label>
                                        <input required="required" class="form-control" name="leagueTitle" id="leagueTitle" value="<?php echo $hms['game_title']; ?>">
                                    </div>
                                    <button class="btn btn-default btn-xs" data-title="Add Match" id=<?php echo '"newleague_'. $hms['game_auto_id'].'"';  ?> name=<?php echo '"newleague_'. $hms['game_auto_id'].'"';  ?>  type="submit" style="background-color: #4D5656;color: #FFFFFF;"> <span class="fa fa-bars"></span> Matches </button>
                                </form>
<!-- 
                                <form style="display:inline;" name=<?php echo '"formScore_'. $hms['hkm_auto_id'].'"';  ?> method="post" action="<?php echo base_url('coach/leaguesheet');?>">
                                    <div class="form-group col-md-12 col-lg-12" style="display:none">
                                        <label for="hmsId" class="control-label">Hms ID*</label>
                                        <input required="required" class="form-control" name="hmsId" id="hmsId" placeholder="101" value="<?php echo $hms['hkm_auto_id']; ?>">
                                    </div>
                                    <button class="btn btn-default btn-xs" data-title="Add Score" id=<?php echo '"newsc_'. $hms['hkm_auto_id'].'"';  ?> name=<?php echo '"newsc_'. $hms['hkm_auto_id'].'"';  ?>  type="submit" style="background-color: #4D5656;color: #FFFFFF;"> <span class="fa fa-plus-circle"></span> New Score </button>
                                </form>
 -->
                               <button class="btn btn-default btn-xs" data-title="Add Game Summary" id=<?php echo '"summary_'. $hms['game_auto_id'].'"';  ?> name=<?php echo '"summary_'. $hms['game_auto_id'].'"';  ?>  type="submit" style="background-color: #374850;color: #FFFFFF;" value=<?php echo '"'. $hms['game_auto_id'].'"';?> onclick="leaguesummary(this);"> <span class="fa fa-plus-circle"></span> Summary </button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- /.table-responsive -->
                <!-- matches-modal -->
                <div id="league-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-full">
                        <div class="modal-content">
                            <div class="modal-header" style="border-bottom: none!important;margin-bottom: -20px">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="full-width-modalLabel" ><strong style="color: darkred">New League</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form role="form" method="post" action="<?php echo base_url(); ?>coach/newhockeymatch">
                                    <div class="row setup-content" >
                                        <div class="col-xs-12">
                                            <div class="col-md-12" >
                                                <div class="form-group col-md-6 col-lg-6">
                                                    <label for="matchTitle" class="control-label">League Title*</label>
                                                    <input type="text" name="matchTitle" placeholder="KUSA Open" class="form-control" id="matchTitle" required="required" maxlength="80">
                                                </div>
                                                <div class="form-group col-md-6 col-lg-6 " readonly="true">
                                                    <label for="startDate" class="control-label">Start Date*</label>
                                                    <div class='input-group date'>
                                                        <input type='text' class="form-control" data-mask="9999-99-99" name="startDate" placeholder="2017-11-20" id="startDate" />
                                                        <span class="input-group-addon">
                                                           <span class="fa fa-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 col-lg-6 " >
                                                    <label for="endDate" class="control-label">End Date*</label>
                                                    <div class='input-group date' id='endDate'>
                                                        <input type='text' class="form-control" data-mask="9999-99-99" name="endDate" placeholder="2017-11-20" />
                                                        <span class="input-group-addon">
                                                           <span class="fa fa-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                 <div class="form-group col-md-6 col-lg-6"> 
                                                    <label for="category" class="control-label">Category*</label>
                                                    <input type="text" name="category" placeholder="" class=" form-control" id="category" required="required" maxlength="30" value="1" readonly="true">
                                                </div>
                                                <div class="form-group col-md-12 col-lg-12">
                                                    <br>
                                                    <input type="submit" class="btn btn-primary" value="Submit">
                                                    <input type="reset" class="btn btn-default" value="Reset">
                                                    <input type="button" class="btn btn-danger pull-right" data-dismiss="modal" value="Close">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
       <!--  leaguesummary -->
        <div id="leaguesummary" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-full">
                <div class="modal-content">
                    <div class="modal-header" style="border-bottom: none!important;margin-bottom: -20px">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="full-width-modalLabel" ><strong style="color: darkred">League Summary</strong></h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" id="opponents" method="post" action="#">
                            <div class="row setup-content" >
                                <div class="col-xs-12">
                                    <div class="col-md-12" >
                                         <div class="form-group col-md-6 col-lg-6 " hidden="true">
                                            <label for="matchId" class="control-label">Match Id*</label>
                                            <input type="text" name="matchId" class="form-control" id="matchId" required="required" >
                                        </div>
                                        <div class="form-group col-md-12 col-lg-12">
                                            <label for="LeagueSummary" class="control-label"> Summary*</label>
                                            <textarea type="text" name="LeagueSummary" placeholder="" class=" form-control" id="LeagueSummary" required="required" maxlength="500" style="min-height: 150px;"></textarea>
                                        </div>
                                       
                                        <div class="form-group col-md-12 col-lg-12">
                                            <input type="submit" class="btn btn-primary" value="Submit">
                                            <input type="reset" class="btn btn-default" value="Reset">
                                            <input type="button" class="btn btn-danger pull-right" data-dismiss="modal" value="Close">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- /.leaguesummary -->
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
     $('#Leagueslist').dataTable({responsive:true,"iDisplayLength": 7,"lengthMenu": [[7, 25, 50, 100, 200, -1], [7, 25, 50, 100, 200, "All"]],columnDefs: [{ orderable: false, targets: [2] },{targets: [1],render: function ( data, type, row ) {return type === 'display' && data.length > 15 ? data.substr( 0,15 ) +'<small>...</small>' : data;} }], "aaSorting": []
   });  
    var  submitBtn = $('input[type="submit"]');
        // allWells.show();
    submitBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            curInputs = curStep.find("input,select"),
            isValid = true;
        $(".form-group").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }
        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });
});
function leaguesummary(obj)
{
    var matchid=obj.value;
    // alert(matchid);
    $('#leaguesummary').modal('show');
};
 $(function () 
    {
        $('#startDate').datepicker({
        format: "yyyy-mm-dd",
        todayHighlight: true,
        autoclose: true,
        calendarWeeks: false
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
