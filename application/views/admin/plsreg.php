<!DOCTYPE html>
<html>
<head>
   <title>SU Sports | Players</title>
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
                <h4><b>Dashboard</b> <span class="fa fa-angle-double-right"></span> Players</h4>
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
                <span data-placement="top" data-toggle="tooltip" title="Add Player">
                    <button class="btn btn-info btn-s" data-title="Add Player" data-toggle="modal" data-target="#player-registration-modal" ><span class="fa fa-plus-circle"></span>&nbsp;Add Player</button>
                </span>
                <span data-placement="top" data-toggle="tooltip" title="Refresh">
                    <button class="btn btn-s" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh
                        </button>
                </span>
                <span data-placement="top" data-toggle="tooltip" title="Print All">
                    <a class="btn btn-s" data-title="Print All" type="button" href="<?php echo base_url('');?>"><span class="fa fa-print"></span>&nbsp;Print All</a>
                </span>
                <br><br>
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
                <table  class="table table-striped table-hover display responsive nowrap" cellspacing="0" width="100%" id="plslist"  >
                    <thead>
                        <tr>
                            <th class="text-center">Full Name</th>
                            <th class="text-center">ID / Passport</th>
                            <th class="text-center">Phone Number</th>
                            <th class="text-center"></th>
                         </tr>
                    </thead>
                    <tbody >
                       <?php foreach($players as $player){ 
                           ?>
                        <tr>
                            <td class="text-left"><?php  echo $player['player_fname']. " ".$player['player_lname']; ?></td>
                            <td class="text-center"><?php  echo $player['player_nid'];  ?></td>
                            <td class="text-center"><?php  echo $player['player_phone']; ?></td>
                            <td class="text-center">
                                <form style="display:inline;" name=<?php echo '"formMore_'. $player['player_auto_id'].'"';  ?> method="post" action="<?php echo base_url('mc/map');?>">
                                    <div class="form-group col-md-12 col-lg-12" style="display:none">
                                        <label for="playerId" class="control-label">Player ID*</label>
                                        <input required="required" class="form-control" name="playerId" id="playerId" placeholder="" value="<?php echo $player['player_auto_id']; ?>">
                                    </div>
                                    <button class="btn btn-default btn-xs" data-title="View More" id=<?php echo '"more_'. $player['player_auto_id'].'"';  ?> name=<?php echo '"more_'. $player['player_auto_id'].'"';  ?>  type="submit" style="background-color: #ECF0F1;color: #000000;"> <span class="fa fa-eye"></span> View </button>
                                </form>
                                <form style="display:inline;" name=<?php echo '"formEdit_'. $player['player_auto_id'].'"';  ?> method="post" action="<?php echo base_url('mc/ep');?>">
                                    <div class="form-group col-md-12 col-lg-12" style="display:none">
                                        <label for="playerId" class="control-label">Player ID*</label>
                                        <input required="required" class="form-control" name="playerId" id="playerId" placeholder="" value="<?php echo $player['player_auto_id']; ?>">
                                    </div>
                                    <button class="btn btn-default btn-xs" data-title="Edit Player" id=<?php echo '"edit_'. $player['player_auto_id'].'"';  ?> name=<?php echo '"edit_'. $player['player_auto_id'].'"';  ?>  type="submit" style="background-color: #7B7D7D;color: #FFFFFF;"><span class="fa fa-edit"></span> Edit </button>
                                </form>
                                <form style="display:inline;" name=<?php echo '"formNxt_'. $player['player_auto_id'].'"';  ?> method="post" action="<?php echo base_url('mc/mak');?>">
                                    <div class="form-group col-md-12 col-lg-12" style="display:none">
                                        <label for="playerId" class="control-label">Player ID*</label>
                                        <input required="required" class="form-control" name="playerId" id="playerId" placeholder="" value="<?php echo $player['player_auto_id']; ?>">
                                    </div>
                                    <button class="btn btn-default btn-xs" data-title="View Next of Kin" id=<?php echo '"kinMore_'. $player['player_auto_id'].'"';  ?> name=<?php echo '"kinMore_'. $player['player_auto_id'].'"';  ?>  type="submit" style="background-color: #4D5656;color: #FFFFFF;"> <span class="fa fa-eye"></span> Kin </button>
                                </form>
                                <form style="display:inline;" name=<?php echo '"formEmail_'. $player['player_auto_id'].'"';  ?> method="post" action="<?php echo base_url('mc/mail');?>">
                                    <div class="form-group col-md-12 col-lg-12" style="display:none">
                                        <label for="playerId" class="control-label">Player ID*</label>
                                        <input required="required" class="form-control" name="playerId" id="playerId" placeholder="" value="<?php echo $player['player_auto_id']; ?>">
                                    </div>
                                    <button class="btn btn-default btn-xs" data-title="Email Player" id=<?php echo '"edit_'. $player['player_auto_id'].'"';  ?> name=<?php echo '"edit_'. $player['player_auto_id'].'"';  ?>  type="submit" style="background-color: #374850;color: #FFFFFF;"><span class="fa fa-envelope"></span> Email </button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- /.table-responsive -->

                <!-- players-registration-modal -->
                <div id="player-registration-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                  <div class="modal-dialog modal-full">
                      <div class="modal-content">
                          <div class="modal-header" style="border-bottom: none!important;margin-bottom: -20px">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                  <h4 class="modal-title" id="full-width-modalLabel" ><strong style="color: darkred">Player registration</strong></h4>
                          </div>
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
                               <?php echo form_open_multipart('coach/newplayer',array('id' => 'player_registration','method'=>'post'));?>
                                  <div class="row setup-content" id="step-1">
                                      <div class="col-sm-12">
                                          <div class="col-md-12">
                                              <!-- <h3> Step 1</h3> -->
                                              <div class="form-group col-md-6 col-lg-6 ">
                                                  <label for="firstName" class="control-label">First Name*</label>
                                                  <input type="text" name="firstName" placeholder="" class="form-control" id="firstName" required="required" maxlength="15">
                                              </div>
                                              <div class="form-group col-md-6 col-lg-6" >
                                                  <label for="lastName" class="control-label">Last Name*</label>
                                                  <input type="text" name="lastName" placeholder="" class="form-control" id="lastName" required="required" maxlength="15">
                                              </div>
                                              <div class="form-group col-md-6 col-lg-6">
                                                  <label for="otherNames" class="control-label">Other Names</label>
                                                  <input type="text" name="otherNames" placeholder="" class="form-control" id="otherNames" maxlength="15">
                                              </div>
                                              <div class="form-group col-md-6 col-lg-6">
                                                  <label for="studentID" class="control-label">Student ID</label>
                                                  <input type="text" name="studentID" placeholder="" class=" form-control" id="studentID" data-mask="999999">
                                              </div>
                                              <div class="form-group col-md-6 col-lg-6">
                                                  <label for="dateOfBirth" class="control-label">D.O.B*</label>
                                                   <div class="input-group date">
                                                      <input type="text" name="dateOfBirth" placeholder="1994-11-20" class=" form-control" id="" required="required" data-mask="9999-99-99"/> <span class="input-group-addon btn">
                                                          <span class="fa fa-calendar"></span>
                                                  </div>
                                              </div>
                                              <div class="form-group col-md-6 col-lg-6">
                                                  <label for="idNo" class="control-label">ID/Passport/Birth Cert No*</label>
                                                  <input type="text" name="idNo" placeholder="" class=" form-control" id="idNo" required="required" maxlength="12" minlength="4">
                                              </div>
                                              <div class="form-group col-md-6 col-lg-6">
                                                  <label for="idType" class="control-label">Type of ID Used</label>
                                                  <select type="text" name="idType" placeholder="" class=" form-control" id="idType" required="required">
                                                  <
                                                      <option value="">--Please select Type--</option>
                                                      <option value="National ID">National ID</option>
                                                      <option value="Passport">Passport</option>
                                                      <option value="Birth Certificate">Birth Certificate</option>
                                                  </select>
                                              </div>
                                              <div class="form-group col-md-6 col-lg-6">
                                                  <label for="phoneNumber" class="control-label"> Current Phone No.*</label>
                                                  <input type="text" name="phoneNumber" placeholder="" class=" form-control" id="phoneNumber" required="required" data-mask="0799999999">
                                              </div>

                                              <div class="form-group col-md-6 col-lg-6">
                                                  <label for="emailAddress" class="control-label"> Current Email Address*</label>
                                                  <input type="email" name="emailAddress" placeholder="" class=" form-control" id="emailAddress" required="required" maxlength="50">
                                              </div>
                                              <div class="form-group col-md-6 col-lg-6">
                                                  <label for="currentResidence" class="control-label"> Current Residence*</label>
                                                  <input type="text" name="currentResidence" placeholder="Tulia Court, Madaraka Estate (HSE 1137)" class=" form-control" id="currentResidence" required="required" maxlength="100">
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
                                                  <input type="text" name="kinFirstName" placeholder="" class=" form-control" id="kinFirstName" required="required" maxlength="15">
                                              </div>
                                              <div class="form-group col-md-6 col-lg-6" >
                                                  <label for="kinLastName" class="control-label">Last Name*</label>
                                                  <input type="text" name="kinLastName" placeholder="Last Name" class=" form-control" id="kinLastName" required="required" maxlength="15">
                                              </div>
                                              <div class="form-group col-md-6 col-lg-6">
                                                  <label for="kinOtherNames" class="control-label">Other Names</label>
                                                  <input type="text" name="kinOtherNames" placeholder="" class="form-control" id="kinOtherNames" maxlength="15">
                                              </div>
                                             
                                              <div class="form-group col-md-6 col-lg-6">
                                                  <label for="kinNationalID" class="control-label">National ID No.*</label>
                                                  <input type="text" name="kinNationalID"  placeholder="" class=" form-control" id="kinNationalID" required="required" maxlength="12" minlength="4">
                                              </div>
                                              <div class="form-group col-md-6 col-lg-6">
                                                  <label for="kinPhoneNumber" class="control-label"> Current Phone No.*</label>
                                                  <input type="text" name="kinPhoneNumber" placeholder="" class=" form-control" id="kinPhoneNumber" required="required" data-mask="0799999999">
                                              </div>
                                             
                                              <div class="form-group col-md-6 col-lg-6">
                                                  <label for="kinAltPhoneNumber" class="control-label"> Alternative Phone No.</label>
                                                  <input type="text" name="kinAltPhoneNumber" placeholder="" class=" form-control" id="kinAltPhoneNumber" data-mask="0799999999">
                                              </div>

                                              <div class="form-group col-md-6 col-lg-6">
                                                  <label for="kinEmailAddress" class="control-label">Current Email Address</label>
                                                  <input type="email" name="kinEmailAddress"  placeholder="" class=" form-control" id="kinEmailAddress" maxlength="50">
                                              </div>
                                              <div class="form-group col-md-6 col-lg-6">
                                                  <label for="kinCurrentResidence" class="control-label">Current Residence*</label>
                                                  <input type="text" name="kinCurrentResidence"  placeholder="Central Court, Madaraka Estate" class=" form-control" id="kinCurrentResidence" required="required" maxlength="100">
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
                                              <input type="text" name="currentHeight" placeholder="180.00" class=" form-control" id="currentHeight" required="required" data-mask="999.99">
                                          </div>
                                           <div class="form-group col-md-6 col-lg-6">
                                              <label for="currentWeight"  class="control-label">Current Weight (kg)*</label>
                                              <input type="number" name="currentWeight" placeholder="72.50" class="form-control" id="currentWeight" required="required" min="50" step="0.01">
                                          </div>

                                          <div class="col-md-12">
                                              <div class="form-group col-md-6 col-lg-6" >
                                                  <label for="previousHighSchool" class="control-label">Previous High School*</label>
                                                  <input type="text" name="previousHighSchool" placeholder="Olkejuado High School" class=" form-control" id="previousHighSchool" required="required" maxlength="50">
                                              </div>

                                               <div class="form-group col-md-6 col-lg-6">
                                                  <label for="prevStatus" class="control-label" >Have you ever played for any team?<span class="star">*</span></label><br>
                                                  <label class="radio-inline ">
                                                      <input type="radio" name="prevStatus" id="prevStatus" value="1" required="required" autocomplete="off">Yes
                                                  </label>
                                                  <label class="radio-inline ">
                                                      <input type="radio" name="prevStatus" id="prevStatus" value="0" required="required" autocomplete="off">No
                                                  </label><br><br>
                                              </div>
                                              <div class="form-group col-md-6 col-lg-6" >
                                                  <label for="previousTeam" class="control-label">Previous Team & Role</label>
                                                  <input type="text" name="previousTeam" placeholder=" Captain, Olkejuado High School Rugby Team" class=" form-control" id="previousTeam" maxlength="50">
                                              </div>

                                              <div class="form-group col-md-6 col-lg-6">
                                                  <label for="teamID" class="control-label">Team to Join*</label>
                                                  <select type="text" name="teamID" placeholder="" class=" form-control" id="teamID" required="required" readonly="true">
                                                      <option value="<?php echo $this->session->userdata('coachTeamID');?>"><?php echo $this->session->userdata('coachTeamName');?></option>
                                                  </select>
                                              </div>

                                              <div class="form-group col-md-6 col-lg-6">
                                                  <label for="highestAchievement" class="control-label">Highest Sports Achievement</label>
                                                  <input type="text" name="highestAchievement" placeholder="Player of the Year 2016" class=" form-control" id="highestAchievement" maxlength="50">
                                              </div>
                                               <div class="form-group col-md-6 col-lg-6">
                                                  <label for="course" class="control-label">Course</label>
                                                  <select type="text" name="course" placeholder="Course Taken" class=" form-control" id="course" >
                                                      <option value="">--Select Your Course of Study--</option>
                                                    <?php  foreach($courses as $course){ 
                                                          ?>
                                                      <option value=<?php  echo '"'.$course['course_id'].'"';?>><?php  echo $course['course_id'];}?></option>
                                                  </select>
                                              </div>
                                              <div class="form-group col-md-12 col-lg-12">
                                              <label for="" class="control-label">User Agreement</label><br>
                                                  <input type="checkbox" name="agreement" id="agreement" value="1" required="required" autocomplete="off" style="display: inline;">
                                                  <label for="agreement" class="control-label" style="font-weight: normal">&nbsp;I agree with the Strathmore Games rules and regulations<span class="star">*</span></label><br><br>
                                              </div>
                                              <div class="form-group col-md-12 col-lg-12">
                                                <input class="btn btn-success nextBtn  pull-right" type="submit" value="Submit">
                                                <input class="btn btn-primary prevBtn  pull-left" type="button" value="Back">
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                <?php echo form_close();?>
                          </div>
                      </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
                <!-- /.players-registration-modal -->
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
