
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SUSMS - Coach Remarks </title>
    
   <?php $this->load->view('headerlinks/headerlinks.php'); ?>
   <link href="<?php echo base_url(); ?>assets/css/core.css" rel="stylesheet" type="text/css" />

   
</head>

<body>

<div id="wrapper">
    <?php $coachnav= $this->session->userdata('coachnav'); $this->load->view($coachnav); ?><!--navigation -->
    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:darkgrey"> Coach Remarks</h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
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
            
        <div class="modal-body">
            <form role="form" method="post" action="<?php echo base_url(); ?>coach/new_remark" id="coach_remarks" >
                <div class="row setup-content" >
                    <div class="col-xs-12">
                        <?php foreach($injury_management as $record){ ?>
                        <div class="col-md-12">
                            <div class="form-group col-md-12 col-lg-12" hidden="true">
                                <label for="record_id" class="control-label">Record Id</label>
                                <input type="text" name="record_id" placeholder="Record Id" class=" form-control" id="record_id" required="required" readonly="true" value="<?php echo $record['injury_auto_id']; ?>">
                            </div>
                            <div class="form-group col-md-12 col-lg-12">
                                <label for="playerid" class="control-label">Player Name</label>
                                <input type="text" name="playerid" placeholder="Name of Player" class=" form-control" id="playerid" required="required" disabled="true" value=<?php echo '"'.$record['player_fname'].' '.$record['player_lname'].'"';    ?>>
                            </div>
                            <div class="form-group col-md-6 col-lg-6 " >
                                <label for="diagnosis" class="control-label">Diagnosis/Complaints*</label>
                                <textarea required="required" class="form-control" name="diagnosis" placeholder="e.g. Muscle ache, twisted nerves" readonly="true"><?php echo $record['diagnosis']; ?></textarea>
                            </div>
                            <div class="form-group col-md-6 col-lg-6">
                                <label for="treatment" class="control-label">Treatment*</label>
                                <textarea required="required" class="form-control" name="treatment" placeholder="e.g. Massage" readonly="true"><?php echo $record['treatment']; ?></textarea>
                            </div>
                            <div class="form-group col-md-12 col-lg-12">
                                <label for="physioRemarks" class="control-label">Physio Remarks*</label>
                                <textarea required="required" class="form-control" name="physioRemarks" placeholder="e.g. Stable" readonly="true"><?php echo $record['physio_remarks'];} ?></textarea>
                            </div>
                            <div class="form-group col-md-12 col-lg-12">
                                <label for="coachRemarks" class="control-label">S&C Coach Remarks*</label>
                                <textarea required="required" class="form-control" name="coachRemarks" placeholder="e.g. Give training break"></textarea>
                            </div>
                            <div class="modal-header"></div>
                                <br>
                                <input type="submit" class="btn btn-primary" value="Submit">
                                <input type="reset" class="btn btn-default" value="Reset">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

     <?php $this->load->view('scriptlinks/scriptlinks.php'); ?>

    
 
<script>

$(document).ready(function () {

    var  submitBtn = $('input[type="submit"]');
        // allWells.show();

    submitBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            curInputs = curStep.find("input,select,textarea"),
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
 
//to refresh the page
$( "#refresh").click( function(event)
        {
            window.setTimeout(function(){location.reload()},1)

        });

  
</script>


</body>
</html>
