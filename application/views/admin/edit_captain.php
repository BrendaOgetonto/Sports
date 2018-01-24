<!DOCTYPE html>
<html>
<head>
   <title>SU Sports | Captain Edit</title>
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
                <h4 class="pull-left"><b>Dashboard</b> <span class="fa fa-angle-double-right"></span> Captain Edit</h4>
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
                            <i class="fa fa-check-circle-o"></i>
                            <strong><span>';echo $msg['success'];echo '</span></strong>
                        </div> 
                </div>';}?>
                <form role="form" method="post" action="<?php echo base_url(); ?>dos/updatecaptain">
                  <div class="row setup-content" >
                      <div class="col-xs-12">
                            <div class="col-md-12">
                            <?php foreach($captain_profile as $profile){ ?>
                                <div class="form-group col-md-12 col-lg-12">
                                    <label for="teamID" class="control-label">Team*</label>
                                    <select type="text" name="teamID" placeholder="Name of Team to Join" class=" form-control" id="teamID" required="required">
                                        <option value=<?php  echo '"'.$profile['team_id'].'"';?>><?php  echo $profile['team_category'];?></option>
                                      <?php  foreach($teams as $team){ 
                                            ?>
                                        <option value=<?php  echo '"'.$team['team_id'].'"';?>><?php  echo $team['team_category'];}?></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12 col-lg-12">
                                <label for="playerId" class="control-label green">Player</label>
                                <select type="text" name="playerId" placeholder="" class="form-control" id="playerId" readonly="true">
                                        <option value=<?php  echo '"'.$profile['player_auto_id'].'"';?>><?php  echo $profile['player_fname']." ".$profile['player_lname'];?>
                                </select>
                                </div>
                                <div class="form-group col-md-12 col-lg-12">
                                  <label for="dateAppointed" class="control-label">Date Appointed*</label>
                                  <div class="input-group date">
                                      <input type="text" name="dateAppointed" placeholder="1994-11-20" class=" form-control" id="dateAppointed" required="required" value=<?php  echo '"'.$profile['date_appointed'].'"';?> data-mask="9999-99-99" /> <span class="input-group-addon btn">
                                          <span class="fa fa-calendar"></span>
                                      </span>
                                  </div>
                                </div>
                                <div class="form-group col-md-6 col-lg-6">
                                      <label for="prevStatus" class="control-label" >Have you ever been a team Captain?<span class="star">*</span></label><br>

                                      <?php $captain_status= $profile['capt_before'];  if ($captain_status==1){?>
                                      <?php  echo '<label class="radio-inline ">
                                          <input type="radio" name="prevStatus" id="prevStatus" value="1" autocomplete="off" required="required" checked="true">Yes
                                      </label>

                                       <label class="radio-inline ">
                                          <input type="radio" name="prevStatus" id="prevStatus" value="0" autocomplete="off" required="required">No
                                      </label>';}else if ($captain_status==0){echo '
                                      <label class="radio-inline ">
                                          <input type="radio" name="prevStatus" id="prevStatus" value="1" autocomplete="off" required="required">Yes
                                      </label>
                                      <label class="radio-inline ">
                                          <input type="radio" name="prevStatus" id="prevStatus" value="0" autocomplete="off" required="required" checked="true">No
                                      </label>';}?>
                                  </div>

                                  <div class="form-group col-md-6 col-lg-6">
                                    <?php $user_agreement= $profile['user_agreement'];
                                    if($user_agreement==1)
                                        {?>
                                        <label for="User agreement" class="control-label">User Agreement</label><br>
                                        <?php echo '<input type="checkbox" name="agreement" id="agreement" value="1" required="required" autocomplete="off" style="display: inline;" checked="true"><label for="agreement" class="control-label" style="font-weight: normal">&nbsp;I agree with the Strathmore games rules<span class="star">*</span></label>'; }else { echo '<input type="checkbox" name="agreement" id="agreement" value="1" required="required" autocomplete="off" style="display: inline;"><label for="agreement" class="control-label" style="font-weight: normal">&nbsp;I agree with the Strathmore games rules<span class="star">*</span></label>'; 
                                        }?>
                                </div>
                                <div class="form-group col-md-12 col-lg-12">
                                  <br>
                                  <input type="submit" class="btn btn-warning" value="Update">
                                </div>
                            <?php }?>
                            </div>
                        </div>
                    </div>
                </form>
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
//to refresh the page
});
</script>
</body>
</html>
