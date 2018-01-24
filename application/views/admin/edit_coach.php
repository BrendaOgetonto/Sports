<!DOCTYPE html>
<html>
<head>
   <title>SU Sports | Coaches</title>
<?php $this->load->view('headerlinks/headerlinks.php'); ?> 
   <link href="<?php echo base_url(); ?>assets/general-css/general.css" rel="stylesheet" type="text/css" />

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
                <h4><b>Dashboard</b> <span class="fa fa-angle-double-right"></span> Coach Edit</h4>
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
                <br>
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

                <!-- coach-profile-update-modal -->
                <div class="modal-body">
                    <div class="stepwizard">
                        <div class="stepwizard-row setup-panel">
                            <div class="stepwizard-step">
                                <a href="#step-1" type="button" class="btn btn-primary btn-circle"><span style="color: #00FF00;">1</span></a>
                                <p class="active-purple-bold p">Personal Details</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled"><span style="color: #00FF00;">2</span></a>
                                <p class="inactive-purple-bold p">Other Details</p>
                            </div>
                        </div>
                    </div>
                    
                    <?php foreach($coach_profile as $profile){ ?>
                    <form role="form" method="post" action="<?php echo base_url(); ?>dos/updatecoach" id="coach_update" >
                        <div class="row setup-content" id="step-1">
                            <div class="col-sm-12">
                                <div class="col-md-12">
                                    <!-- <h3> Step 1</h3> -->
                                  <div class="form-group col-md-6 col-lg-6">
                                    <label for="staffID" class="control-label">Staff ID*</label>
                                    <input type="text" name="staffID" placeholder="Staff ID" class=" form-control" id="staffID"  required="required" value=<?php echo '"'.$profile['coach_staff_id'].'"';  ?> readonly="true">  
                                  </div>
                                  <div class="form-group col-md-6 col-lg-6 ">
                                    <label for="firstName" class="control-label">First Name*</label>
                                    <input type="text" name="firstName" placeholder="" class="form-control" id="firstName" required="required" maxlength="15" value=<?php echo '"'.$profile['coach_fname'].'"';  ?>>
                                  </div>
                                  <div class="form-group col-md-6 col-lg-6" >
                                      <label for="lastName" class="control-label">Last Name*</label>
                                      <input type="text" name="lastName" placeholder="" class="form-control" id="lastName" required="required" maxlength="15" value=<?php echo '"'.$profile['coach_lname'].'"';  ?>>
                                  </div>
                                  <div class="form-group col-md-6 col-lg-6">
                                      <label for="otherNames" class="control-label">Other Names</label>
                                      <input type="text" name="otherNames" placeholder="" class="form-control" id="otherNames" maxlength="20" value=<?php echo '"'.$profile['coach_other_names'].'"';  ?>>
                                  </div>
                                  <div class="form-group col-md-6 col-lg-6">
                                      <label for="userName" class="control-label">Username*</label>
                                      <input type="text" name="userName" placeholder="smokoro" class=" form-control" id="userName" required="required" maxlength="15" minlength="4" value=<?php echo '"'.$profile['coach_username'].'"';  ?>>
                                  </div>
                                  <div class="form-group col-md-6 col-lg-6">
                                      <label for="nationalID" class="control-label">National ID No.*</label>
                                      <input type="number" name="nationalID" placeholder="" class=" form-control" id="nationalID" required="required" min="0" max="999999999999" value=<?php echo '"'.$profile['coach_nid'].'"'; ?> >
                                  </div>
                                  <div class="form-group col-md-6 col-lg-6">
                                      <label for="phoneNumber" class="control-label"> Current Phone No.*</label>
                                      <input type="text" name="phoneNumber" placeholder="" class=" form-control" id="phoneNumber" required="required" data-mask="0799999999" value=<?php echo '"'.$profile['coach_phone'].'"'; ?>>
                                  </div>

                                  <div class="form-group col-md-6 col-lg-6">
                                      <label for="emailAddress" class="control-label"> Current Email Address*</label>
                                      <input type="email" name="emailAddress" placeholder="Current Email Address" class=" form-control" id="emailAddress" required="required" maxlength="50" value=<?php echo '"'.$profile['coach_email'].'"'; ?>>
                                  </div>
                                  <div class="form-group col-md-12 col-lg-12">
                                    <input class="btn btn-primary nextBtn pull-right" type="button" value="Next">
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="row setup-content" id="step-2">
                            <div class="col-s-12">
                                <div class="col-md-12">
                                    <div class="form-group col-md-6 col-lg-6">
                                      <label for="prevStatus" class="control-label" >Have you ever been a team Coach?<span class="star">*</span></label><br>

                                      <?php $coaching_status= $profile['prev_coaching_state'];  if ($coaching_status==1){?>
                                      <?php  echo '<label class="radio-inline ">
                                          <input type="radio" name="prevStatus" id="prevStatus" value="1" autocomplete="off" required="required" checked="true">Yes
                                      </label>

                                       <label class="radio-inline ">
                                          <input type="radio" name="prevStatus" id="prevStatus" value="0" autocomplete="off" required="required">No
                                      </label>';}else if ($coaching_status==0){echo '
                                      <label class="radio-inline ">
                                          <input type="radio" name="prevStatus" id="prevStatus" value="1" autocomplete="off" required="required">Yes
                                      </label>
                                      <label class="radio-inline ">
                                          <input type="radio" name="prevStatus" id="prevStatus" value="0" autocomplete="off" required="required" checked="true">No
                                      </label>';}?>
                                  </div>
                                  <div class="form-group col-md-6 col-lg-6" >
                                      <label for="previousTeam" class="control-label">Previous Team</label>
                                      <input type="text" name="previousTeam" placeholder="ABC FC" class=" form-control" id="previousTeam" maxlength="50" value=<?php echo '"'.$profile['prev_team'].'"'; ?>>
                                  </div>

                                  <div class="form-group col-md-6 col-lg-6">
                                      <label for="teamCoaching" class="control-label">Team to Coach*</label>
                                      <select type="text" name="teamCoaching" placeholder="Name of Team to Join" class=" form-control" id="teamCoaching" required="required">
                                        <option value=<?php echo '"'.$profile['team_id'].'"'; ?>><?php echo $profile['team_category']; ?></option>
                                        <?php  foreach($teams as $team){ 
                                              ?>
                                          <option value=<?php  echo '"'.$team['team_id'].'"';?>><?php  echo $team['team_category'];}?></option>
                                      </select>
                                  </div>

                                  <div class="form-group col-md-6 col-lg-6">
                                      <label for="highestAchievement" class="control-label">Highest Sports Achievement*</label>
                                      <input type="text" name="highestAchievement" placeholder="Voted Coach of the Year 2016" class=" form-control" id="highestAchievement" required="required" maxlength="70" value=<?php echo '"'.$profile['coach_h_achievement'].'"'; ?>>
                                  </div>
                                  <div class="form-group col-md-6 col-lg-6">
                                      <label for="currentResidence" class="control-label"> Current Residence*</label>
                                      <input type="text" name="currentResidence" placeholder=" Madaraka Estate, Tulia Court, HSE 1137" class=" form-control" id="currentResidence" required="required" maxlength="50" minlength="10" value=<?php echo '"'.$profile['coach_h_achievement'].'"'; ?>>
                                  </div>
                                  <div class="form-group col-md-6 col-lg-6">
                                    <?php $user_agreement= $profile['user_agreement'];
                                    if($user_agreement==1)
                                        {?>
                                        <label for="User agreement" class="control-label">User Agreement</label><br>
                                        <?php echo '<input type="checkbox" name="agreement" id="agreement" value="1" required="required" autocomplete="off" style="display: inline;" checked="true"><label for="agreement" class="control-label" style="font-weight: normal">&nbsp;I agree with the Strathmore Coaches code of conduct<span class="star">*</span></label>'; }else { echo '<input type="checkbox" name="agreement" id="agreement" value="1" required="required" autocomplete="off" style="display: inline;"><label for="agreement" class="control-label" style="font-weight: normal">&nbsp;I agree with the Strathmore Coaches code of conduct<span class="star">*</span></label>';} 
                                        }?>
                                    <br><br>
                                </div>
                                  <div class="form-group col-md-12 col-lg-12">
                                    <input class="btn btn-warning  pull-right" type="submit" value="Update">
                                    <input class="btn btn-primary prevBtn  pull-left" type="button" value="Back">
                                  </div>
                                </div>
                            </div>
                        </div>
                    </form>
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

})();</script>
<script>
$(document).ready(function () {
    //datatable initialization
     $('#plslist').dataTable({responsive:true,"iDisplayLength": 5,"lengthMenu": [[5, 25, 50, 100, 200, -1], [5, 25, 50, 100, 200, "All"]],
         "aoColumnDefs": [{"aTargets": [3], "orderable": false}]
      });
    var  submitBtn = $('input[type="submit"]');
     var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allPrevBtn = $('.prevBtn'),
            paragraph=$('div.setup-panel div p'),
            allNextBtn = $('.nextBtn');
    allWells.hide();
    allPrevBtn.hide();
    navListItems.click(function (e) {
        e.preventDefault(e);
        var $target = $($(this).attr('href')),
                $item = $(this);
        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            $item.parent().prev().children("p").addClass('inactive-purple-bold');
            $item.parent().children("p").removeClass('inactive-purple-bold').addClass('active-purple-bold');
            $item.parent().next().children("p").removeClass('active-purple-bold').addClass('inactive-purple-bold');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });
    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            nextP = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("p"),
            curInputs = curStep.find("input,select"),
            isValid = true;
            allPrevBtn.show();

        $(".form-group").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }
        if (isValid){
            nextStepWizard.removeAttr('disabled').trigger('click');
             nextP.removeClass('inactive-purple-bold').addClass('active-purple-bold');
        }
       
    });
  allPrevBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
        curStepBtn = curStep.attr("id"),
        prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");
        prevParagraph = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("p");
        curParagraph = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().children("p");
        prevParagraph.removeClass('inactive-purple-bold').addClass('active-purple-bold');
        curParagraph.removeClass('active-purple-bold').addClass('inactive-purple-bold');
        prevStepWizard.removeAttr('disabled').trigger('click');

    });
    $('div.setup-panel div a.btn-primary').trigger('click');
});
//to refresh the page
$( "#refresh").click( function(event)
    {
        window.setTimeout(function(){location.reload()},1)

    });
</script>
</body>
</html>
