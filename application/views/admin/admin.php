
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SUSMS - Player Registration</title>
    
   <?php $this->load->view('headerlinks/headerlinks.php'); ?>
   <link href="<?php echo base_url(); ?>assets/css/core.css" rel="stylesheet" type="text/css" />
   <style>

.stepwizard-step p {
    margin-top: 10px;
}

.stepwizard-row {
    display: table-row;
}

.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}

.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}

.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;

}

.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}

.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}
   </style>
   
</head>

<body>

<div id="wrapper">

    <?php $this->load->view('admin/adminnav.php'); ?><!--navigation -->


    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:blue">Player Registration</h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <span data-placement="top" data-toggle="tooltip" title="Add Player">
                    <button class="btn btn-primary btn-xs" data-title="Add Player" data-toggle="modal" data-target="#player-registration-modal" ><span class="fa fa-plus-circle"></span>&nbsp;Add Player</button></span>

             <span data-placement="top" data-toggle="tooltip" title="Refresh"><button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
            </span>

            <span data-placement="top" data-toggle="tooltip" title="Print All">
                    <a class="btn btn-xs" data-title="Print All" type="button" href="<?php echo base_url('');?>"><span class="fa fa-print"></span>&nbsp;Print All</a>
            </span>
            <br><br>
            <div class="row">
                <div class="col-md-12">
                    <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%" id="clubslist"  >
                        <thead>
                            <tr>
                                        
                                <th class="text-center">#</th>
                                <th class="text-center">Full Name</th>
                                <th class="text-center">Phone Number</th>
                                <th class="text-center">NoK Phone No.</th>
                                <th class="text-center"></th>
                             </tr>
                        </thead>
                        <tbody >
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
            </div>
            
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
                                        <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                        <p>Personal Details</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                                        <p>Next of Kin</p>
                                    </div>
                                    <div class="stepwizard-step">
                                        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                                        <p>Other Details</p>
                                    </div>
                                </div>
                            </div>
                            <form role="form" style="">
                                <div class="row setup-content" id="step-1">
                                    <div class="col-xs-12">
                                        <div class="col-md-12">
                                            <!-- <h3> Step 1</h3> -->
                                            <div class="form-group col-lg-6">
                                                <label for="firstName" class="control-label">First Name*</label>
                                                <input type="text" name="firstName" placeholder="First Name" class="form-control" id="firstName" required="required">
                                            </div>
                                            <div class="form-group col-lg-6" >
                                                <label for="lastName" class="control-label">Last Name*</label>
                                                <input type="text" name="lastName" placeholder="Last Name" class="form-control" id="lastName" required="required">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="otherNames" class="control-label">Other Names</label>
                                                <input type="text" name="otherNames" placeholder="Other Names" class="form-control" id="otherNames" >
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="studentID" class="control-label">Student ID*</label>
                                                <input type="text" name="studentID" placeholder="Student ID" class=" form-control" id="studentID" required="required">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="dateOfBirth" class="control-label">D.O.B*</label>
                                                <input type="text" name="dateOfBirth" placeholder="Date of Birth" class=" form-control" id="dateOfBirth" required="required">
                                            </div>
                                            
                                            <div class="form-group col-lg-6">
                                                <label for="birthCertificateNumber" class="control-label">Birth Certificate No.*</label>
                                                <input type="text" name="birthCertificateNumber" placeholder="Birth Certificate No." class=" form-control" id="birthCertificateNumber" required="required">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="nationalID" class="control-label">National ID No.*</label>
                                                <input type="text" name="nationalID" placeholder="National ID No." class=" form-control" id="nationalID" required="required">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="phoneNumber" class="control-label"> Current Phone No.*</label>
                                                <input type="text" name="phoneNumber" placeholder="Current Phone Number" class=" form-control" id="phoneNumber" required="required">
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="emailAddress" class="control-label"> Current Email Address*</label>
                                                <input type="text" name="emailAddress" placeholder="Current Email Address" class=" form-control" id="emailAddress" required="required">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="currentResidence" class="control-label"> Current Residence*</label>
                                                <input type="text" name="currentResidence" placeholder="e.g. Madaraka Estate, Tulia Court, HSE 1137" class=" form-control" id="currentResidence" required="required">
                                            </div>
                                             <div class="form-group col-lg-6">
                                                <label for="currentHeight" class="control-label">Current Height*</label>
                                                <input type="text" name="currentHeight" placeholder="Current Height" class=" form-control" id="currentHeight" required="required">
                                            </div>
                                             <div class="form-group col-lg-6">
                                                <label for="currentWeight"  class="control-label">Current Weight*</label>
                                                <input type="text" name="currentWeight" placeholder="Current Weight" class="form-control" id="currentWeight" required="required">
                                            </div>

                                            <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row setup-content" id="step-2">
                                    <div class="col-xs-12">
                                        <div class="col-md-12">
                                            <div class="form-group col-lg-6" >
                                                <label for="firstName" class="control-label">First Name*</label>
                                                <input type="text" name="firstName" placeholder="First Name" class=" form-control" id="firstName" required="required">
                                            </div>
                                            <div class="form-group col-lg-6" >
                                                <label for="lastName" class="control-label">Last Name*</label>
                                                <input type="text" name="lastName" placeholder="Last Name" class=" form-control" id="lastName" required="required">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="otherNames" class="control-label">Other Names</label>
                                                <input type="text" name="otherNames" placeholder="Other Names" class="form-control" id="otherNames">
                                            </div>
                                           
                                            <div class="form-group col-lg-6">
                                                <label for="nationalID" class="control-label">National ID No.*</label>
                                                <input type="text" name="nationalID"  placeholder="National ID No." class=" form-control" id="nationalID" required="required">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="phoneNumber" class="control-label"> Current Phone No.*</label>
                                                <input type="text" name="phoneNumber" placeholder="Current Phone Number" class=" form-control" id="phoneNumber" required="required">
                                            </div>
                                           
                                            <div class="form-group col-lg-6">
                                                <label for="altPhoneNumber" class="control-label"> Alternative Phone No.</label>
                                                <input type="text" name="altPhoneNumber" placeholder="Current Phone Number" class=" form-control" id="altPhoneNumber">
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="emailAddress" class="control-label">Current Email Address*</label>
                                                <input type="text" name="emailAddress"  placeholder="Email Address" class=" form-control" id="emailAddress" required="required">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="currentResidence" class="control-label">Current Residence*</label>
                                                <input type="text" name="currentResidence"  placeholder="Current Residence" class=" form-control" id="currentResidence" required="required">
                                            </div>
                                            <button class="btn btn-default nextBtn btn-lg pull-right" type="button" >Next</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row setup-content" id="step-3">
                                    <div class="col-xs-12">
                                        <div class="col-md-12">
                                            <div class="form-group col-lg-6" >
                                                <label for="previousHighSchool" class="control-label">Previous High School*</label>
                                                <input type="text" name="previousHighSchool" placeholder="e.g. Olkejuado High School" class=" form-control" id="previousHighSchool" required="required">
                                            </div>

                                            <div class="form-group col-lg-6" >
                                                <label for="previousTeam" class="control-label">Previous Team & Role</label>
                                                <input type="text" name="previousTeam" placeholder="e.g. Captain, Olkejuado High School Rugby Team" class=" form-control" id="previousTeam">
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="teamName" class="control-label">Team to Join*</label>
                                                <select type="text" name="teamName" placeholder="Name of Team to Join" class=" form-control" id="teamName" required="required">
                                                    <option value="">--Select Name of Team--</option>
                                                    <option value="1">Leos</option>
                                                    <option value="2">Blades</option>
                                                    <option value="3">Football</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label for="highestAchievement" class="control-label">Highest Sports Achievement*</label>
                                                <input type="text" name="highestAchievement" placeholder="e.g. Voted Player of the Year 2016" class=" form-control" id="highestAchievement" required="required">
                                            </div>

                                            <button class="btn btn-success nextBtn btn-lg pull-right" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <!-- <div class="row">
                <div class="col-md-12">
                    <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%" id="clubslist"  >
                        <thead>
                            <tr>
                                        
                                <th class="text-center">#</th>
                                <th class="text-center">Club Name</th>
                                <th class="text-center">Club Email</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                             </tr>
                        </thead>
                        <tbody >
                        </tbody>
                    </table>
                    <!--table-responsive -->
              <!--   </div>
            </div> -->

    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

     <?php $this->load->view('scriptlinks/scriptlinks.php'); ?>

    
 
<script>

$(document).ready(function () {

    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault(e);
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url'],select[type='text']"),
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
