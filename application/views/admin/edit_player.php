<!DOCTYPE html>
<html>
<head>
   <title>SU Sports | Players</title>
<?php $this->load->view('headerlinks/headerlinks.php'); ?> 
   <link href="<?php echo base_url(); ?>assets/general-css/general.css" rel="stylesheet" type="text/css" />

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
                <h4><b>Dashboard</b> <span class="fa fa-angle-double-right"></span> Update player</h4>
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
                <div class="modal-body">
                    <div class="stepwizard">
                        <div class="stepwizard-row setup-panel">
                            <div class="stepwizard-step">
                                <a href="#step-1" type="button" class="btn btn-primary btn-circle"><span style="color: #00FF00;">1</span></a>
                                <p class="active-purple-bold p">Personal Details</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled"><span style="color: #00FF00;">2</span></a>
                                <p class="inactive-purple-bold p">Next of Kin</p>
                            </div>
                            <div class="stepwizard-step">
                                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled"><span style="color: #00FF00;">3</span></a>
                                <p class="inactive-purple-bold p">Other Details</p>
                            </div>
                        </div>
                    </div>
                      <?php foreach($player_profile as $profile){?>
                    <form role="form" method="post" action="<?php echo base_url(); ?>mc/upp" id="player_registration" >
                        <div class="row setup-content" id="step-1">
                            <div class="col-sm-12">
                                <div class="col-md-12">
                                    <!-- <h3> Step 1</h3> -->
                                    <div class="form-group col-md-6 col-lg-6 " hidden="true">
                                        <label for="playerAutoId" class="control-label">Player Auto ID*</label>
                                        <input type="text" name="playerAutoId" placeholder="Player Auto ID" class="form-control" id="playerAutoId" required="required"  value=<?php echo '"'.$profile['player_auto_id'].'"';?> >
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6 ">
                                        <label for="firstName" class="control-label">First Name*</label>
                                        <input type="text" name="firstName" placeholder="First Name" class="form-control" id="firstName" required="required"  value=<?php echo '"'.$profile['player_fname'].'"';?> maxlength="15">
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6" >
                                        <label for="lastName" class="control-label">Last Name*</label>
                                        <input type="text" name="lastName" placeholder="Last Name" class="form-control" id="lastName" required="required" value=<?php echo '"'.$profile['player_lname'].'"';?> maxlength="15">
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="otherNames" class="control-label">Other Names</label>
                                        <input type="text" name="otherNames" placeholder="Other Names" class="form-control" id="otherNames" value=<?php echo '"'.$profile['player_other_names'].'"';?> maxlength="15">
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="studentID" class="control-label">Student ID</label>
                                        <input type="text" name="studentID" placeholder="Student ID" class=" form-control" id="studentID" value=<?php echo '"'.$profile['stud_id'].'"';?> data-mask="999999">
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="dateOfBirth" class="control-label">D.O.B*</label>
                                         <div class="input-group date">
                                            <input type="text" name="dateOfBirth" placeholder="1994-11-20" class=" form-control" id="dateOfBirth" required="required" value=<?php echo '"'.$profile['player_dob'].'"';?> data-mask="9999-99-99"/><span class="input-group-addon btn">
                                                <span class="fa fa-calendar"></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="idNo" class="control-label">ID/Passport/Birth Cert No*</label>
                                        <input type="text" name="idNo" placeholder="National ID / Passport / Birth Cert No" class=" form-control" id="idNo" required="required" value=<?php echo '"'.$profile['player_nid'].'"';?> maxlength="12" minlength="4">
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="idType" class="control-label">Type of ID Used</label>
                                        <select type="text" name="idType" placeholder="ID Type" class=" form-control" id="idType" required="required">
                                        <
                                            <option value=<?php echo '"'.$profile['id_type'].'"';   ?>><?php echo $profile['id_type'];   ?></option>
                                            <option value="National ID">National ID</option>
                                            <option value="Passport">Passport</option>
                                            <option value="Birth Certificate">Birth Certificate</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="phoneNumber" class="control-label"> Current Phone No.*</label>
                                        <input type="text" name="phoneNumber" placeholder="Current Phone Number" class=" form-control" id="phoneNumber" required="required" value=<?php echo '"'.$profile['player_phone'].'"';?> data-mask="9999999999">
                                    </div>

                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="emailAddress" class="control-label"> Current Email Address*</label>
                                        <input type="text" name="emailAddress" placeholder="Current Email Address" class=" form-control" id="emailAddress" required="required" value=<?php echo '"'.$profile['player_email'].'"'; ?> maxlength="50">
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="currentResidence" class="control-label"> Current Residence*</label>
                                        <input type="text" name="currentResidence" placeholder="Tulia Court, Madaraka Estate(HSE1137)" class=" form-control" id="currentResidence" required="required" value=<?php echo '"'.$profile['player_residence'].'"';?> maxlength="100">
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
                                    <div class="form-group col-md-6 col-lg-6" >
                                        <label for="kinFirstName" class="control-label">First Name*</label>
                                        <input type="text" name="kinFirstName" placeholder="First Name" class=" form-control" id="kinFirstName" required="required" value=<?php echo '"'.$profile['kin_fname'].'"';?> maxlength="30">
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6" >
                                        <label for="kinLastName" class="control-label">Last Name*</label>
                                        <input type="text" name="kinLastName" placeholder="Last Name" class=" form-control" id="kinLastName" required="required" value=<?php echo '"'.$profile['kin_lname'].'"'; ?> maxlength="30">
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="kinOtherNames" class="control-label">Other Names</label>
                                        <input type="text" name="kinOtherNames" placeholder="Other Names" class="form-control" id="kinOtherNames" value=<?php echo '"'.$profile['kin_other_names'].'"';?> maxlength="30">
                                    </div>
                                   
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="kinNationalID" class="control-label">National ID No.*</label>
                                        <input type="text" name="kinNationalID"  placeholder="National ID No." class=" form-control" id="kinNationalID" required="required" value=<?php echo '"'.$profile['kin_nid'].'"';?> maxlength="12" minlength="4">
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="kinPhoneNumber" class="control-label"> Current Phone No.*</label>
                                        <input type="text" name="kinPhoneNumber" placeholder="Current Phone Number" class=" form-control" id="kinPhoneNumber" required="required" value=<?php echo '"'.$profile['kin_phone'].'"';?> data-mask="9999999999">
                                    </div>
                                   
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="kinAltPhoneNumber" class="control-label"> Alternative Phone No.</label>
                                        <input type="text" name="kinAltPhoneNumber" placeholder="Current Phone Number" class=" form-control" id="kinAltPhoneNumber" value=<?php echo '"'.$profile['kin_alt_phone'].'"'; ?>>
                                    </div>

                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="kinEmailAddress" class="control-label">Current Email Address</label>
                                        <input type="text" name="kinEmailAddress"  placeholder="Email Address" class=" form-control" id="kinEmailAddress" value=<?php echo '"'.$profile['kin_email'].'"';   ?>>
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="kinCurrentResidence" class="control-label">Current Residence*</label>
                                        <input type="text" name="kinCurrentResidence"  placeholder="Current Residence" class=" form-control" id="kinCurrentResidence" required="required" value=<?php echo '"'.$profile['kin_residence'].'"';   ?>>
                                    </div>
                                    <div class="form-group col-md-12 col-lg-12">
                                      <input class="btn btn-primary nextBtn  pull-right" type="button" value="Next">
                                      <input class="btn btn-primary prevBtn  pull-left" type="button" value="Back">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row setup-content" id="step-3">
                            <div class="col-s-12">
                                <div class="form-group col-md-6 col-lg-6">
                                    <label for="currentHeight" class="control-label">Current Height (cm)*</label>
                                    <input type="text" name="currentHeight" placeholder="Current Height" class=" form-control" id="currentHeight" required="required" value=<?php echo '"'.$profile['player_height'].'"';?> data-mask="999.99">
                                </div>
                                 <div class="form-group col-md-6 col-lg-6">
                                    <label for="currentWeight"  class="control-label">Current Weight (kg)*</label>
                                    <input type="number" name="currentWeight" placeholder="Current Weight" class="form-control" id="currentWeight" required="required" value=<?php echo '"'.$profile['player_weight'].'"';?> min="50" step="0.01">
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group col-md-6 col-lg-6" >
                                        <label for="previousHighSchool" class="control-label">Previous High School*</label>
                                        <input type="text" name="previousHighSchool" placeholder="e.g. Olkejuado High School" class=" form-control" id="previousHighSchool" required="required" value=<?php echo '"'.$profile['prev_hschool'].'"';?> maxlength="50">
                                    </div>

                                     <div class="form-group col-md-6 col-lg-6">
                                        <label for="prevStatus" class="control-label" >Have you ever played for any team?<span class="star">*</span></label><br>
                                        <?php $play_status_before= $profile['prev_play_state'];  if ($play_status_before==1){?>
                                            <?php  echo '<label class="radio-inline ">
                                                <input type="radio" name="prevStatus" id="prevStatus" value="1" autocomplete="off" required="required" checked="true">Yes
                                            </label>

                                             <label class="radio-inline ">
                                                <input type="radio" name="prevStatus" id="prevStatus" value="0" autocomplete="off" required="required">No
                                            </label>';}else if ($play_status_before==0){echo '
                                            <label class="radio-inline ">
                                                <input type="radio" name="prevStatus" id="prevStatus" value="1" autocomplete="off" required="required">Yes
                                            </label>
                                            <label class="radio-inline ">
                                                <input type="radio" name="prevStatus" id="prevStatus" value="0" autocomplete="off" required="required" checked="true">No
                                            </label>';}?>

                                       <br><br>
                                    </div>

                                    <div class="form-group col-md-6 col-lg-6" >
                                        <label for="previousTeam" class="control-label">Previous Team & Role</label>
                                        <input type="text" name="previousTeam" placeholder="e.g. Captain, Olkejuado High School Rugby Team" class=" form-control" id="previousTeam" value=<?php echo '"'.$profile['prev_team'].'"';   ?> maxlength="50">
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="highestAchievement" class="control-label">Highest Sports Achievement</label>
                                        <input type="text" name="highestAchievement" placeholder="e.g. Voted Player of the Year 2016" class=" form-control" id="highestAchievement" value=<?php echo '"'.$profile['h_achievement'].'"';?> maxlength="50">
                                    </div>
                                     <div class="form-group col-md-6 col-lg-6">
                                        <label for="course" class="control-label">Course*</label>
                                        <select type="text" name="course" placeholder="Course Taken" class=" form-control" id="course" required="required">
                                            <option value=<?php echo '"'.$profile['stud_course_id'].'"';?>><?php echo $profile['stud_course_id'];?></option>
                                          <?php  foreach($courses as $course){ 
                                                ?>
                                            <option value=<?php  echo '"'.$course['course_id'].'"';?>><?php  echo $course['course_id'];}?></option>

                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6">
                                    <?php $user_agreement= $profile['agreement'];
                                        if($user_agreement==1)
                                            {?>
                                            <label for="User agreement" class="control-label">User Agreement</label><br>
                                            <?php echo '<input type="checkbox" name="agreement" id="agreement" value="1" required="required" autocomplete="off" style="display: inline;" checked="true"><label for="agreement" class="control-label" style="font-weight: normal">&nbsp;I agree with the Strathmore Games rules and regulations<span class="star">*</span></label>'; }else { echo '<input type="checkbox" name="agreement" id="agreement" value="1" required="required" autocomplete="off" style="display: inline;"><label for="agreement" class="control-label" style="font-weight: normal">&nbsp;I agree with the Strathmore Games rules and regulations<span class="star">*</span></label>';} 
                                            ?>
                                    </div>
                                    <div class="form-group col-md-12 col-lg-12">
                                      <input class="btn btn-warning nextBtn  pull-right" type="submit" value="Update">
                                      <input class="btn btn-primary prevBtn  pull-left" type="button" value="Back">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php  }?>
                <!-- /.players-updating-modal -->
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
         "aoColumnDefs": [{ "aTargets": [0],"bSortable":false, "orderable": false},{"aTargets": [3], "orderable": false}]
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
