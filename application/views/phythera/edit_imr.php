
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SUSMS - Injury Management </title>
    
   <?php $this->load->view('headerlinks/headerlinks.php'); ?>
   <link href="<?php echo base_url(); ?>assets/css/core.css" rel="stylesheet" type="text/css" />

   
</head>

<body>

<div id="wrapper">

    <?php $this->load->view('phythera/phynav.php'); ?><!--navigation -->


    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:darkgrey"> Edit Injury Management</h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
             <div class="form-group col-md-12 col-lg-12">
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
                            <form role="form" method="post" action="<?php echo base_url(); ?>MC/update_imr" id="injury_management" >
                                <div class="row setup-content" >
                                    <div class="col-xs-12">
                                        <div class="col-md-12">
                                        <?php foreach ($record as $record){?>
                                            <div class="form-group col-md-12 col-lg-12" hidden="true">
                                                <label for="recordId" class="control-label">Record ID*</label>
                                                <input required="required" class="form-control" name="recordId" id="recordId" placeholder="101" value="<?php echo $record['injury_auto_id']; ?>">
                                            </div>
                                            <div class="form-group col-md-12 col-lg-12">
                                                <label for="playerid" class="control-label">Player Name</label>
                                                <input type="text" name="playerid" placeholder="Name of Player" class=" form-control" id="playerid" required="required" value="<?php echo $record['player_fname']." ".$record['player_lname']; ?>" disabled="true">
                                                    <option ><?php   ?></option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12 col-lg-12" >
                                                <label for="injuryDate" class="control-label">Date Injured</label>
                                                <input required="required" class="form-control" name="injuryDate" id="injuryDate" placeholder="101" value="<?php echo $record['injury_date']; ?>" disabled="true">
                                            </div>
                                           
                                            
                                            <div class="form-group col-md-6 col-lg-6 ">
                                                <label for="diagnosis" class="control-label">Diagnosis/Complaints*</label>
                                                <textarea required="required" class="form-control" name="diagnosis" placeholder="e.g. Muscle ache, twisted nerves"><?php echo $record['diagnosis'];  ?></textarea>
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6">
                                                <label for="treatment" class="control-label">Treatment*</label>
                                                <textarea required="required" class="form-control" name="treatment" placeholder="e.g. Massage"><?php echo $record['treatment'];  ?></textarea>
                                            </div>
                                            <div class="form-group col-md-12 col-lg-12">
                                                <label for="physioRemarks" class="control-label">Physio Remarks*</label>
                                                <textarea required="required" class="form-control" name="physioRemarks" placeholder="e.g. Stable"><?php echo $record['physio_remarks'];}  ?></textarea>
                                            </div>
                                            <div class="form-group col-md-12 col-lg-12">
                                            <div class="modal-header"></div>
                                                <br>
                                                <input type="submit" class="btn btn-warning" value="Update">
                                                
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
