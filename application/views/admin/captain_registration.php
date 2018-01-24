<!DOCTYPE html>
<html>
<head>
   <title>SU Sports | Captains</title>
<?php $this->load->view('headerlinks/headerlinks.php'); ?> 
<link href="<?php echo base_url(); ?>assets/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
 <style>
    @media (max-width:767px){.select2 {width: 100% !important;}}
    @media (min-width:768px){.select2 {width: 100% !important;}}
</style>
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
                <h4 class="pull-left"><b>Dashboard</b> <span class="fa fa-angle-double-right"></span> Captains</h4>
                <div class="pull-right">
                    <span data-placement="top" data-toggle="tooltip" title="Refresh">
                        <button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
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
            <div class="box-body"  >
                <div class="box box-solid collapsed-box" style="background:lightgrey">
                    <div class="box-header">
                        <h3 class="box-title" style="color: #21618C;" >New Captain</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            <!-- <button class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i></button> -->
                        </div>
                    </div>
                    <div style="display: none;background-color: #FFFFFF;color: #000000;border-bottom: 2px solid;border-color: #979A9A;" class="box-body">
                        <form role="form" method="post" action="<?php echo base_url(); ?>dos/newcaptain">
                          <div class="row setup-content" >
                              <div class="col-xs-12">
                                  <div class="col-md-12">
                                     <div class="form-group col-md-12 col-lg-12">
                                        <label for="playerId" class="control-label green">Player</label>
                                        <select type="text" name="playerId" placeholder="" class="form-control" id="playerId" required="required"></select>
                                      </div>
                                      <div class="form-group col-md-12 col-lg-12">
                                            <label for="teamID" class="control-label">Team*</label>
                                            <select type="text" name="teamID" placeholder="Name of Team to Join" class=" form-control" id="teamID" required="required">
                                                <option value="">--Select Name of Team--</option>
                                              <?php  foreach($teams as $team){ 
                                                    ?>
                                                <option value=<?php  echo '"'.$team['team_id'].'"';?>><?php  echo $team['team_category'];}?></option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12 col-lg-12">
                                            <label for="dateAppointed" class="control-label">Start Date*</label>
                                            <div class="input-group date">
                                                <input type="text" name="dateAppointed" placeholder="2017-11-20" class=" form-control" id="dateAppointed" required="required" data-mask="9999-99-99" /> <span class="input-group-addon btn">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="prevStatus" class="control-label" >Have you ever been a team Captain?<span class="star">*</span></label><br>
                                            <label class="radio-inline ">
                                                <input type="radio" name="prevStatus" id="prevStatus" value="1" required="required" autocomplete="off">Yes
                                            </label>
                                            <label class="radio-inline ">
                                                <input type="radio" name="prevStatus" id="prevStatus" value="0" required="required" autocomplete="off">No
                                            </label>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6">
                                                <input type="checkbox" name="agreement" id="agreement" value="1" required="required" autocomplete="off">
                                            <label for="prevStatus" class="control-label" style="font-weight: normal">I agree with the Strathmore games rules<span class="star">*</span></label>
                                        </div>
                                        <div class="form-group col-md-12 col-lg-12">
                                            <input type="submit" class="btn btn-primary" value="Submit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
              
                <?php $msg = $this->session->flashdata('msg');
                $successful= $msg['success']; $failed=  $msg['error']; if ($successful=="" && $failed!=""){ echo '
                <div class="messagebox alert alert-danger" style="display: block">
                        <button type="button" class="close" data-dismiss="alert">*</button>
                        <div class="cs-text">
                            <i class="fa fa-close"></i>
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
               <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%" id="captainslist"  >
                    <thead>
                        <tr>    
                            <th class="text-left">Full Name</th>
                            <th class="text-left">Team</th>
                            <th class="text-left">Date Appointed</th>
                            <th class="text-center"></th>
                         </tr>
                    </thead>
                    <tbody >
                      <?php  foreach($captains as $captain){ 
                           ?>
                        <tr>
                            <td class="text-left"><?php  echo $captain['player_fname']. " ".$captain['player_lname']; ?></td>
                            <td class="text-left"><?php  echo $captain['team_category']; ?></td>
                            <td class="text-left"><?php echo date_format(date_create($captain['date_appointed']),"j<\s\up>S</\s\up> M, Y");  ?></td>
                            <td class="text-center">
                                <form style="display:inline;" name=<?php echo '"formMore_'. $captain['player_auto_id'].'"';  ?> method="post" action="<?php echo base_url('dos/captainprofile');?>">
                                    <div class="form-group col-md-12 col-lg-12" style="display:none">
                                        <label for="playerId" class="control-label">Player ID*</label>
                                        <input required="required" class="form-control" name="playerId" id="playerId" placeholder="" value="<?php echo $captain['player_auto_id']; ?>">
                                    </div>
                                    <button class="btn btn-default btn-xs" data-title="View More" id=<?php echo '"more_'. $captain['player_auto_id'].'"';  ?> name=<?php echo '"more_'. $captain['player_auto_id'].'"';  ?>  type="submit" style="background-color: #ECF0F1;color: #000000;"> <span class="fa fa-eye"></span> View </button>
                                </form>
                                <form style="display:inline;" name=<?php echo '"formEdit_'. $captain['player_auto_id'].'"';  ?> method="post" action="<?php echo base_url('dos/editcaptain');?>">
                                    <div class="form-group col-md-12 col-lg-12" style="display:none">
                                        <label for="playerId" class="control-label">Player ID*</label>
                                        <input required="required" class="form-control" name="playerId" id="playerId" placeholder="" value="<?php echo $captain['player_auto_id']; ?>">
                                    </div>
                                    <button class="btn btn-default btn-xs" data-title="Edit Player" id=<?php echo '"edit_'. $captain['player_auto_id'].'"';  ?> name=<?php echo '"edit_'. $captain['player_auto_id'].'"';  ?>  type="submit" style="background-color: #7B7D7D;color: #FFFFFF;"><span class="fa fa-edit"></span> Edit </button>
                                </form> 
                               <!--  <button class="btn btn-warning btn-xs" data-title="Disable" data-toggle="modal" data-target="#disable" id=<?php echo '"disable_'. $captain['player_auto_id'].'"';  ?> name=<?php echo '"disable_'. $captain['player_auto_id'].'"';  ?>>Disable</button>

                                <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" id=<?php echo '"del_'. $captain['player_auto_id'].'"';  ?> name=<?php echo '"del_'. $captain['player_auto_id'].'"';  ?>>Delete</button> -->

                            </td>
                        </tr><?php } ?>
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
<script src="<?php echo base_url();?>assets/select2/js/select2.min.js"></script>
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

})();$(document).ready(function () {
   $('#captainslist').dataTable({responsive:true,"iDisplayLength": 7,"lengthMenu": [[7, 25, 50, 100, 200, -1], [7, 25, 50, 100, 200, "All"]],
         "aoColumnDefs": [{"aTargets": [3], "orderable": false}],'aaSorting':[]
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

// $("#teamID").change(function(){
//     var teamId = $(this).val();
//     $('#playerId').select2('data', {id: null, text: null});
//     $("#playerinfo").show(); 
//     if(teamId !="")
//     {
//         $.ajax({type: 'POST',
//                  url: "<?php echo base_url('dos/seteam'); ?>",
//                 dataType:'json',
//                  data: {teamId: teamId},
//                  success: function(data){console.log(data)}});
//     }else{$("#playerinfo").hide();}  

// });
//autocomplete for  to visit
      $('#playerId').select2({
        placeholder: '--- Select Player ---',
        ajax: {
          url: "<?php echo base_url('coach/getplayer'); ?>",
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results: data
            };
            // console.log(data);
          },
          cache: true
        }
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
