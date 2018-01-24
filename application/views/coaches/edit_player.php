<!DOCTYPE html>
<html>
<head>
   <title>SU Sports | Players</title>
<?php $this->load->view('headerlinks/headerlinks.php');?> 
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
                    <?php echo form_open_multipart('coach/updateplayer',array('id' => 'player_update','method'=>'post'));
                     $photo=$profile['player_profile_photo']; if($photo==""){$ppic="defaultimage.png";}else{$ppic=$profile['player_profile_photo'];}
                   ?>
                            <div class="row setup-content" id="step-1">
                                <div class="col-sm-12">
                                      <div class="col-md-6">
                                          <!-- <h3> Step 1</h3> -->
                                        <div class="col-md-9 col-md-offset-3">
                                            <div class="form-group">
                                                <div class="main-img-preview">
                                                  <img class="thumbnail img-preview " src="<?php echo base_url();echo 'uploads/profile_photos/players/'.$ppic?>" alt="Player Photo" width="210" height="230">
                                                </div>
                                                <!-- <p class="help-block">* Upload mentee passport photo.</p> -->
                                              </div>
                                        </div>
                                        <div class="col-md-6 col-md-offset-4">
                                            <div class="input-group">
                                              <input id="fakeUploadLogo" class="form-control fake-shadow"  disabled="disabled" style="display: none; " required="required">
                                              <div class="input-group-btn">
                                                <div class="fileUpload btn btn-default fake-shadow">
                                                 <span><i class="fa fa-upload"></i> Upload Photo</span>
                                                  <input id="photo-id" name="photo" type="file" class="attachment_upload">
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6 " hidden="true">
                                            <label for="playerAutoId" class="control-label">Player Auto ID*</label>
                                            <input type="text" name="playerAutoId" placeholder="Player Auto ID" class="form-control" id="playerAutoId" required="required"  value=<?php echo '"'.$profile['player_auto_id'].'"';?> >
                                        </div>
                                        <div class="form-group col-md-12 col-lg-12 ">
                                            <label for="firstName" class="control-label">First Name*</label>
                                            <input type="text" name="firstName" placeholder="First Name" class="form-control" id="firstName" required="required"  value=<?php echo '"'.$profile['player_fname'].'"';?> maxlength="15">
                                        </div>
                                        <div class="form-group col-md-12 col-lg-12" >
                                            <label for="lastName" class="control-label">Last Name*</label>
                                            <input type="text" name="lastName" placeholder="Last Name" class="form-control" id="lastName" required="required" value=<?php echo '"'.$profile['player_lname'].'"';?> maxlength="15">
                                        </div>
                                        <div class="form-group col-md-12 col-lg-12">
                                            <label for="otherNames" class="control-label">Other Names</label>
                                            <input type="text" name="otherNames" placeholder="Other Names" class="form-control" id="otherNames" value=<?php echo '"'.$profile['player_other_names'].'"';?> maxlength="15">
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label class="">Gender <span class="star">*</span>
                                            </label>
                                            <br>
                                            <?php $play_gender= $profile['player_gender'];  if ($play_gender=='Female'){?>
                                                <?php  echo '
                                             <label class="radio-inline ">
                                                <input type="radio" name="gender" id="male" value="Male" autocomplete="off" required="required">Male
                                            </label>
                                            <label class="radio-inline ">
                                                <input type="radio" name="gender" id="female" value="Female" autocomplete="off" required="required" checked="true">Female
                                            </label>

                                            ';}else if ($play_gender=="Male"){echo '
                                            <label class="radio-inline ">
                                                <input type="radio" name="gender" id="male" value="Male" autocomplete="off" required="required" checked="true">Male
                                            </label>

                                             <label class="radio-inline ">
                                                <input type="radio" name="gender" id="female" value="Female" autocomplete="off" required="required" >Female
                                            </label>';}?>
                                            <br><br>
                                        </div>
                                    </div>
                                    <!--/.col-md-6-->

                                    <div class="col-md-6">
                                        <div class='col-md-12 col-lg-12'>
                                          <label for="dateOfBirth" class="control-label">Date of Birth</label>
                                          <div class="form-group">
                                              <div class='input-group date' id='dateOfBirth'>
                                                  <input type='text' class="form-control" readonly="true" name="dateOfBirth" value=<?php echo '"'.$profile['player_dob'].'"';?>/>
                                                  <span class="input-group-addon">
                                                      <span class="fa fa-calendar"></span>
                                                  </span>
                                              </div>
                                          </div>
                                        </div>
                                        <div class="form-group col-md-12 col-lg-12">
                                          <label for="studentID" class="control-label">Student ID</label>
                                          <input type="text" name="studentID" placeholder="" class=" form-control" id="studentID" value=<?php echo '"'.$profile['stud_id'].'"';?>>
                                        </div>
                                        <div class="form-group col-md-12 col-lg-12">
                                            <label for="course" class="control-label">Course</label>
                                            <select type="text" name="course" placeholder="Course Taken" class=" form-control" id="course">
                                                <option value=<?php echo '"'.$profile['stud_course_id'].'"';?>><?php echo $profile['stud_course_id'];?></option>
                                              <?php  foreach($courses as $course){ 
                                                    ?>
                                                <option value=<?php  echo '"'.$course['course_id'].'"';?>><?php  echo $course['course_id'];}?></option>

                                            </select>
                                        </div>
                                        <div class="form-group col-md-12 col-lg-12">
                                            <label for="idNo" class="control-label">ID/Passport/Birth Cert No*</label>
                                            <input type="text" name="idNo" placeholder="" class=" form-control" id="idNo" required="required"  maxlength="12" minlength="4" value=<?php echo '"'.$profile['player_nid'].'"';?>>
                                        </div>
                                        <div class="form-group col-md-12 col-lg-12">
                                            <label for="idType" class="control-label">Type of ID Used</label>
                                            <select type="text" name="idType" placeholder="ID Type" class=" form-control" id="idType" required="required">
                                                  <option value=<?php echo '"'.$profile['id_type'].'"';   ?>><?php echo $profile['id_type'];   ?></option>
                                                    <option value="National ID">National ID</option>
                                                    <option value="Passport">Passport</option>
                                                    <option value="Birth Certificate">Birth Certificate</option>
                                              </select>
                                        </div>
                                        <div class="form-group col-md-12 col-lg-12">
                                            <label for="phoneNumber" class="control-label"> Current Phone No.*</label>
                                            <input type="text" name="phoneNumber" placeholder="" class=" form-control" id="phoneNumber" required="required" data-mask="0799999999" value=<?php echo '"'.$profile['player_phone'].'"';?>>
                                        </div>

                                        <div class="form-group col-md-12 col-lg-12">
                                            <label for="emailAddress" class="control-label"> Current Email Address*</label>
                                            <input type="email" name="emailAddress" placeholder="" class=" form-control" id="emailAddress" required="required" maxlength="50" value=<?php echo '"'.$profile['player_email'].'"'; ?>>
                                        </div>
                                    </div>
                                    <!--/.col-md-6-->
                                    <div class="col-md-6">
                                        <div class="form-group col-md-12 col-lg-12">
                                            <input class="btn btn-primary nextBtn pull-right" type="button" value="Next">
                                        </div>
                                    </div>
                                    <!--/.col-md-6-->
                                </div>
                                <!--/.col-sm-12-->
                            </div>
                            <!--/.setup-content-->

                            <div class="row setup-content" id="step-2">
                                <div class="col-s-12">
                                    <div class="col-md-12">
                                        <div class="form-group col-md-6 col-lg-6 ">
                                            <label for="kinFirstName" class="control-label">First Name*</label>
                                            <input type="text" name="kinFirstName" placeholder="" class="form-control" id="kinFirstName" required="required" maxlength="15" value=<?php echo '"'.$profile['kin_fname'].'"';?>>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6" >
                                            <label for="kinLastName" class="control-label">Last Name*</label>
                                            <input type="text" name="kinLastName" placeholder="" class="form-control" id="kinLastName" required="required" maxlength="15" value=<?php echo '"'.$profile['kin_lname'].'"';?>>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="kinOtherNames" class="control-label">Other Names</label>
                                            <input type="text" name="kinOtherNames" placeholder="" class="form-control" id="kinOtherNames" maxlength="15" value=<?php echo '"'.$profile['kin_other_names'].'"';?>>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="kinNationalID" class="control-label">National ID No.*</label>
                                            <input type="text" name="kinNationalID"  placeholder="" class=" form-control" id="kinNationalID" required="required" maxlength="12" minlength="4" value=<?php echo '"'.$profile['kin_nid'].'"';?>>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="kinPhoneNumber" class="control-label"> Current Phone No.*</label>
                                            <input type="text" name="kinPhoneNumber" placeholder="" class=" form-control" id="kinPhoneNumber" required="required"  data-mask="0799999999" value=<?php echo '"'.$profile['kin_phone'].'"';?>>
                                        </div>
                                         
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="kinAltPhoneNumber" class="control-label"> Alternative Phone No.</label>
                                            <input type="text" name="kinAltPhoneNumber" placeholder="" class=" form-control" id="kinAltPhoneNumber" data-mask="0799999999" value=<?php echo '"'.$profile['kin_alt_phone'].'"'; ?>>
                                        </div>

                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="kinEmailAddress" class="control-label">Current Email Address</label>
                                            <input type="email" name="kinEmailAddress"  placeholder="" class=" form-control" id="kinEmailAddress" value=<?php echo '"'.$profile['kin_email'].'"';?>>
                                        </div>
                                        <div class="form-group col-md-6 col-lg-6">
                                            <label for="kinCurrentResidence" class="control-label">Current Residence*</label>
                                            <input type="text" name="kinCurrentResidence"  placeholder="" class=" form-control" id="kinCurrentResidence" required="required" value=<?php echo '"'.$profile['kin_residence'].'"';?>>
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
                                        <input type="number" name="currentHeight" placeholder="" class=" form-control" id="currentHeight" required="required" step="0.1" max="200" value=<?php echo '"'.$profile['player_height'].'"';?>>
                                    </div>
                                     <div class="form-group col-md-6 col-lg-6">
                                        <label for="currentWeight"  class="control-label">Current Weight (kg)*</label>
                                        <input type="number" name="currentWeight" placeholder="" class="form-control" id="currentWeight" required="required" step="0.1" max="150" value=<?php echo '"'.$profile['player_weight'].'"';?>>
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6" >
                                        <label for="previousHighSchool" class="control-label">Previous High School*</label>
                                         <input type="text" name="previousHighSchool" placeholder="e.g. Olkejuado High School" class=" form-control" id="previousHighSchool" required="required" maxlength="50" value=<?php echo '"'.$profile['prev_hschool'].'"';?>>
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="prevStatus" class="control-label" >Have you ever played for any team?<span class="star">*</span>
                                        </label>
                                        <br>
                                        <?php $play_status_before= $profile['prev_play_state'];  if ($play_status_before==1){?>
                                            <?php  echo '
                                        <label class="radio-inline ">
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
                                        <input type="text" name="previousTeam" placeholder=" Captain, Olkejuado High School Rugby Team" class=" form-control" id="previousTeam" maxlength="50" value=<?php echo '"'.$profile['prev_team'].'"';?> >
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="highestAchievement" class="control-label">Highest Sports Achievement</label>
                                        <input type="text" name="highestAchievement" placeholder="Player of the Year 2016" class=" form-control" id="highestAchievement" maxlength="50" value=<?php echo '"'.$profile['h_achievement'].'"';?>>
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="teamId" class="control-label">Team</label>
                                        <select type="text" name="teamId" placeholder="" class=" form-control" id="teamId">
                                            <option value=<?php echo '"'.$profile['player_team_id'].'"';?>><?php echo $profile['team_name'];?></option>
                                          <?php  foreach($teams as $team){ 
                                                ?>
                                            <option value=<?php  echo '"'.$team['team_auto_id'].'"';?>><?php  echo $team['team_name'];}?></option>

                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="currentResidence" class="control-label"> Current Residence*</label>
                                        <input type="text" name="currentResidence" placeholder="Tulia Court, Madaraka Estate(HSE1137)" class=" form-control" id="currentResidence" required="required" maxlength="100" value=<?php echo '"'.$profile['player_residence'].'"';?>>
                                    </div>
                                    <div class="form-group col-md-12 col-lg-12">
                                        <input class="btn btn-warning nextBtn  pull-right" type="submit" value="Update">
                                        <input class="btn btn-primary prevBtn  pull-left" type="button" value="Back">
                                    </div>
                                </div>
                            </div>
                          <?php echo form_close();?>
                    <?php  }?>
               <!--/.modal-body-->
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


    // image upload
    var brand = document.getElementById('photo-id');
    brand.className = 'attachment_upload';
    brand.onchange = function() {
        document.getElementById('fakeUploadLogo').value = this.value.substring(12);
    };

    // Source: http://stackoverflow.com/a/4459419/6396981
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                $('.img-preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#photo-id").change(function() {
        readURL(this);
    });
    
    //datepicker
    $(function () {$('#dateOfBirth').datepicker({format: "yyyy-mm-dd",minDate:new Date(),todayHighlight: true});});
});

//to refresh the page
$( "#refresh").click( function(event){window.setTimeout(function(){location.reload()},1)});
</script>
</body>
</html>
