
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SUSMS - Injury Details </title>
   <?php $this->load->view('headerlinks/headerlinks.php'); ?>
   <link href="<?php echo base_url(); ?>assets/css/core.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
    <?php $this->load->view('phythera/phynav.php'); ?><!--navigation -->
    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:darkgrey">Injury Description</h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <?php $msg = $this->session->flashdata('msg');
             $addIMRId=$recordID;
            if ($addIMRId==""){echo '<div></div>';}else if($addIMRId!=""){ echo '
             <div class="modal-body">
                <div class="row setup-content" >
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <div class="messagebox alert text-left" style="display: block">
                                <div class="cs-text">
                                <form style="display:inline;" name='; echo '"formAddIMR_'. $addIMRId.'"';  echo 'method="post" action="'; echo base_url("MC/injury_management");echo '">
                                    <div class="form-group col-md-12 col-lg-12" style="display:none">
                                        <label for="recordId" class="control-label">Record ID*</label>
                                        <input required="required" class="form-control" name="recordId" id="recordId" placeholder="101" value="'; echo $addIMRId; echo '">
                                    </div>
                                    <button class="btn btn-primary btn-s" data-title="Add IM Record" id='; echo '"addIMR_'. $addIMRId.'"';  echo ' name='; echo '"addIMR_'. $addIMRId.'"';  echo 'type="submit" ><span class="fa fa-plus-circle "> Add IM Record</span> 
                                   </button>
                                </form>';echo '</span></strong>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>';}?>
           
            <div class="modal-body" style="margin-top: -50px">
                <div class="row setup-content" >
                    <div class="col-xs-12">
                        <div class="col-md-12">
                        <?php foreach($injury_record as $record){ ?>
                            <div class="form-group col-md-12 col-lg-12">
                            <strong>Full Name: </strong><strong style="color:purple"><?php echo $record['player_fname']. " ".$record['player_other_names']." ".$record['player_lname']; ?></strong>
                            </div>
                            <div class="form-group col-md-12 col-lg-12">
                                <label for="dateOfInjury" class="control-label">Date of Injury</label>

                                <?php echo ": ".$record['injury_date']; ?>
                            </div>
                            <div class="form-group col-md-12 col-lg-12">
                                <label for="dateSeen" class="control-label">Date Seen </label>
                               <?php echo ": ".$record['date_seen']; ?>
                            </div>
                            <div class="form-group col-md-12 col-lg-12 ">
                                <label for="injuryDescription" class="control-label">Injury Description</label><br>
                                <?php echo $record['injury_description']; ?></textarea>
                            </div>
                            <div class="form-group col-md-12 col-lg-12">
                                <div class="modal-header"></div>
                            </div>
                            <div class="form-group col-md-12 col-lg-12 ">
                                <label for="diagnosis" class="control-label">Diagnosis</label><br>
                                <?php echo $record['diagnosis']; ?></textarea>
                            </div>
                            <div class="form-group col-md-12 col-lg-12">
                                <div class="modal-header"></div>
                            </div>
                             <div class="form-group col-md-12 col-lg-12 ">
                                <label for="treatment" class="control-label">Treatment</label><br>
                                <?php echo $record['treatment'];?></textarea>
                            </div>
                             <div class="form-group col-md-12 col-lg-12">
                                <div class="modal-header"></div>
                            </div>
                             <div class="form-group col-md-12 col-lg-12 ">
                                <label for="physioRemarks" class="control-label">Physio Remarks</label><br>
                                <?php echo $record['physio_remarks'];} ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<?php $this->load->view('scriptlinks/scriptlinks.php'); ?>
<script>
//to refresh the page
$( "#refresh").click( function(event)
    {
        window.setTimeout(function(){location.reload()},1)
    });
</script>
</body>
</html>
