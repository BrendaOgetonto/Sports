
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SUSMS - Edit Injury Record </title>
    
   <?php $this->load->view('headerlinks/headerlinks.php'); ?>
   <link href="<?php echo base_url(); ?>assets/css/core.css" rel="stylesheet" type="text/css" />

   
</head>

<body>

<div id="wrapper">

    <?php $this->load->view('phythera/phynav.php'); ?><!--navigation -->
    
    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:darkgrey">Edit Injury Record</h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <br><br>
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
                    <form role="form" method="post" action="<?php echo base_url(); ?>MC/update_ir" id="update_injury_record" >
                        <div class="row setup-content" >
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                <?php foreach($record as $record){ ?>
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
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="dateOfInjury" class="control-label">Date of Injury*</label>
                                        <input required="required" class="form-control" name="dateOfInjury" id="dateOfInjury" placeholder="e.g. 27-April-2017" value="<?php echo $record['injury_date']; ?>">
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="dateSeen" class="control-label">Date Seen*</label>
                                        <input required="required" class="form-control" name="dateSeen" id="dateSeen" placeholder="e.g. 28-April-2017" value="<?php echo $record['date_seen']; ?>">
                                    </div>
                                    <div class="form-group col-md-12 col-lg-12 ">
                                        <label for="injuryDescription" class="control-label">Injury Description*</label>
                                        <textarea required="required" class="form-control" name="injuryDescription" placeholder="e.g. Twisted leg" ><?php echo $record['injury_description'];} ?></textarea>
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


$(function () 
    {
        $('#update_injury_record #dateOfInjury').datepicker({
        format: "yyyy-mm-dd",
        todayHighlight: true,
        autoclose: true,
        calendarWeeks: false
        });

        $('#update_injury_record #dateSeen').datepicker({
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
