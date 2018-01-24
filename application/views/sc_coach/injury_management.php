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
<?php $this->load->view('coaches/coachnav.php'); ?><!--navigation -->
    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:darkgrey"> Coach Remarks</h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
             <span data-placement="top" data-toggle="tooltip" title="Refresh"><button class="btn btn-s" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
            </span>
            <span data-placement="top" data-toggle="tooltip" title="Print All">
                    <a class="btn btn-s" data-title="Print All" type="button" href="<?php echo base_url('');?>"><span class="fa fa-print"></span>&nbsp;Print All</a>
            </span>
            <br><br>
            <div class="form-group col-md-12 col-lg-12">
                  <?php $msg = $this->session->flashdata('msg');
                $successful= $msg['success']; $failed=  $msg['error']; $edit= $msg['edit'];
                if ($successful=="" && $edit=="" && $failed!=""){ echo '
                <div class="messagebox alert alert-danger" style="display: block">
                        <button type="button" class="close" data-dismiss="alert">*</button>
                        <div class="cs-text">
                            <i class="fa fa-close"></i>
                            <strong><span>';echo $msg['error']; echo '</span></strong>
                        </div> 
                </div>';}else if($successful=="" && $failed=="" && $edit==""){echo '<div></div>';} else if ($successful!="" && $failed=="" && $edit=="" ){ echo '
                <div class="messagebox alert alert-success" style="display: block">
                        <button type="button" class="close" data-dismiss="alert">*</button>
                        <div class="cs-text">
                            <i class="fa fa-check-circle-o"></i>
                            <strong><span>';echo $msg['success'];echo '</span></strong>
                        </div> 
                </div>';}else if ($successful=="" && $failed=="" && $edit!==""){ echo '
                <div class="messagebox alert alert-info" style="display: block">
                        <button type="button" class="close" data-dismiss="alert">*</button>
                        <div class="cs-text">
                            <i class="fa fa-info-circle"></i>
                            <strong><span>';echo 'No Remark added. &nbsp;&nbsp;

                        <form style="display:inline;" name='; echo '"formAddRemark_'. $edit.'"';  echo 'method="post" action="'; echo base_url("MC/crmks_view");echo '">
                            <div class="form-group col-md-12 col-lg-12" style="display:none">
                                <label for="recordId" class="control-label">Record ID*</label>
                                <input required="required" class="form-control" name="recordId" id="recordId" placeholder="101" value="'; echo $edit; echo '">
                            </div>
                            <button class="btn btn-primary btn-s" data-title="Add Remark" id='; echo '"addRemark_'. $edit.'"';  echo ' name='; echo '"addRemark_'. $edit.'"';  echo 'type="submit" ><span class="fa fa-plus-circle "> Add Remark</span> 
                           </button>
                        </form>';echo '</span></strong>
                        </div> 
                </div>';}else if ($successful=="" && $failed=="" && $edit!==""){ echo '
                <div class="messagebox alert alert-danger" style="display: block">
                        <button type="button" class="close" data-dismiss="alert">*</button>
                        <div class="cs-text">
                            <i class="fa fa-warning"></i>
                            <strong><span>';echo 'Record exists.&nbsp;&nbsp;

                        <form style="display:inline;" name='; echo '"formEditIM_'. $edit.'"';  echo 'method="post" action="'; echo base_url("MC/eimr_view");echo '">
                            <div class="form-group col-md-12 col-lg-12" style="display:none">
                                <label for="recordId" class="control-label">Record ID*</label>
                                <input required="required" class="form-control" name="recordId" id="recordId" placeholder="101" value="'; echo $edit; echo '">
                            </div>
                            <button class="btn btn-default btn-s" data-title="Edit IM Record" id='; echo '"editimrecord_'. $edit.'"';  echo ' name='; echo '"editimrecord_'. $edit.'"';  echo 'type="submit" ><span class="fa fa-edit "> Edit instead</span> 
                           </button>
                        </form>';echo '</span></strong>
                        </div> 
                </div>';}?>
            <div class="row">
                <div class="col-md-12">
                    <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%" id="imlist"  >
                        <thead>
                            <tr>
                                        
                                <th class="text-center">Full Name</th>
                                <th class="text-center">Diagnosis</th>
                                <th class="text-center"></th>
                             </tr>
                        </thead>
                        <tbody >
                        <?php foreach($injury_management as $record)
                            { ?>
                            <tr>
                                <td class="text-left"><?php echo $record['player_fname']. " ". $record['player_lname']; ?></td>
                                <td class="text-left"><?php echo $record['diagnosis'];?></td>
                                <td class="text-center">
                                <?php  echo '<form style="display:inline;" name='; echo '"formMore_'. $record['injury_auto_id'].'"';  echo 'method="post" action="'; echo base_url('MC/coachmai_view');echo '">
                                        <div class="form-group col-md-12 col-lg-12" style="display:none">
                                            <label for="recordId" class="control-label">Record ID*</label>
                                            <input required="required" class="form-control" name="recordId" id="recordId" placeholder="101" value="'; echo $record['injury_auto_id'];echo '">
                                        </div>
                                        <button class="btn btn-default btn-s" data-title="More" id='; echo '"more_'. $record['injury_auto_id'].'"';  echo ' name='; echo '"more_'. $record['injury_auto_id'].'"'; echo 'type="submit" >More</button>
                                    </form> ';?>

                                       <?php $status=$record['coach_remarks']; if($status=="")
                                        { echo' <form style="display:inline;" name='; echo '"formAddRemark_'. $record['injury_auto_id'].'"';  echo 'method="post" action="'; echo base_url("MC/crmks_view");echo '">
                                            <div class="form-group col-md-12 col-lg-12" style="display:none">
                                                <label for="recordId" class="control-label">Record ID*</label>
                                                <input required="required" class="form-control" name="recordId" id="recordId" placeholder="101" value="'; echo $record["injury_auto_id"]; echo '">
                                            </div>
                                            <button class="btn btn-primary btn-s" data-title="Coach Remark" id='; echo '"newRemark_'. $record['injury_auto_id'].'"';  echo ' name='; echo '"newRemark_'. $record['injury_auto_id'].'"';  echo 'type="submit" ><span class="fa fa-plus-circle "> Coach Remark</span> </button></form>';
                                        }else {
                                                echo' <form style="display:inline;" name='; echo '"formRemarked_'. $record['injury_auto_id'].'"';  echo 'method="post" action="'; echo base_url("MC/crmks_view");echo '">
                                            <div class="form-group col-md-12 col-lg-12" style="display:none">
                                                <label for="recordId" class="control-label">Record ID*</label>
                                                <input required="required" class="form-control" name="recordId" id="recordId" placeholder="101" value="'; echo $record["injury_auto_id"]; echo '">
                                            </div>
                                            <button class="btn btn-warning btn-s" data-title="Coach Remark" id='; echo '"remarked_'. $record['injury_auto_id'].'"';  echo ' name='; echo '"remarked_'. $record['injury_auto_id'].'"';  echo 'type="submit" ><span class="fa fa-minus-circle "> Coach Remark</span> </button></form>';}
                                            ?>
                                    </form>  
                                    <?php  echo '<form style="display:inline;" name='; echo '"formEditRemark_'. $record['injury_auto_id'].'"';  echo 'method="post" action="'; echo base_url('MC/ecr_view');echo '">
                                        <div class="form-group col-md-12 col-lg-12" style="display:none">
                                            <label for="recordId" class="control-label">Record ID*</label>
                                            <input required="required" class="form-control" name="recordId" id="recordId" placeholder="101" value="'; echo $record['injury_auto_id'];echo '">
                                        </div>
                                        <button class="btn btn-info btn-s" data-title="Edit Remark" id='; echo '"edit_'. $record['injury_auto_id'].'"';  echo ' name='; echo '"edit_'. $record['injury_auto_id'].'"'; echo 'type="submit" >Edit Remark</button>
                                    </form> ';?> 
                                    <button class="btn btn-danger btn-s" data-title="Delete" data-toggle="modal" data-target="#delete" id=<?php echo '"del_'. $record['injury_auto_id'].'"';  ?> name=<?php echo '"del_'. $record['injury_auto_id'].'"';  ?> value=<?php echo '"'.$record['injury_auto_id'].'"';  ?> onclick="delRemark(this);">Delete</button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
            </div>
            <!-- Delete player modal -->
             <div class="modal fade" id="delete_remark" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="btn btn-danger" style="width: 100%!important;"><span class="pull-left"><span class="fa fa-warning"></span> Are you really sure you want to delete this remark?</span></button>
                        </div>
                        <h4 style="margin-top:40px;margin-bottom:-20px"> <strong class="text-info">This remark will be deleted</strong></h4>
                        <form role="form" method="post"  id="remark_delete" action="<?php echo base_url(); ?>MC/deleteRemark">
                            <div class="modal-body ">
                             <div class="form-group col-md-12 col-lg-12" hidden="true">
                                    <label for="recordId" class="control-label">Record Id</label>
                                    <input type="text" name="recordId" placeholder="Record Id" class=" form-control" id="recordId" required="required" readonly="true" >
                                </div>
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" class="btn btn-warning" id="delete_confirm"><span class="fa fa-check"></span> PROCEED</button>
                                <button type="button" class="btn " data-dismiss="modal"><span class="fa fa-remove"></span> Exit</button>
                            </div>
                    </div>
                    <!-- /.modal-content --> 
                </div>
                <!-- /.modal-dialog --> 
            </div>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
 <?php $this->load->view('scriptlinks/scriptlinks.php'); ?>
<script>
$(document).ready(function () {
 //define datatable
     var table=$('#imlist').dataTable({responsive:true,"iDisplayLength": 10,"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],
         "aoColumnDefs": [ {"aTargets": [0],"bSortable":false, "orderable": false},{"aTargets": [2], "orderable": false}]
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
