
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SUSMS - Injury Record </title>
    
   <?php $this->load->view('headerlinks/headerlinks.php'); ?>
   <link href="<?php echo base_url(); ?>assets/css/core.css" rel="stylesheet" type="text/css" />

   
</head>

<body>

<div id="wrapper">

    <?php $this->load->view('phythera/phynav.php'); ?><!--navigation -->
    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header" style="margin-top:10px;color:darkgrey"> Injury Record</h4>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <span data-placement="top" data-toggle="tooltip" title="Add Record">
                    <button class="btn btn-primary btn-xs" data-title="Add Record" data-toggle="modal" data-target="#injury-record-modal" ><span class="fa fa-plus-circle"></span>&nbsp;New Record</button></span>

             <span data-placement="top" data-toggle="tooltip" title="Refresh"><button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
            </span>

            <span data-placement="top" data-toggle="tooltip" title="Print All">
                    <a class="btn btn-xs" data-title="Print All" type="button" href="<?php echo base_url('');?>"><span class="fa fa-print"></span>&nbsp;Print All</a>
            </span>
            <br><br>
             
            <div class="form-group col-md-12 col-lg-12">
            
                <?php $msg = $this->session->flashdata('msg');
                $successful= $msg['success']; $failed=  $msg['error']; $edit= $msg['edit'];if ($successful=="" && $edit=="" && $failed!=""){ echo '
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
                    <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%" id="injury_list"  >
                        <thead>
                            <tr>
                                        
                                <th class="text-center">#</th>
                                <th class="text-center">Full Name</th>
                                <th class="text-center">Date of Injury</th>
                                <th class="text-center">Injury Desc</th>
                                <th class="text-center"></th>
                             </tr>
                        </thead>
                        <tbody >
                        <?php $count=1; foreach($injuries as $record)
                            { ?>
                            <tr>
                                <td class="text-center"><?php echo $count; ?></td>
                                <td class="text-left"><?php echo $record['player_fname']. " ". $record['player_lname']; ?></td>
                                <td class="text-center"><?php echo $record['injury_date'];?></td>
                                <td class="text-left"><?php echo $record['injury_description'];?></td>
                                <td class="text-center">
                                <?php  echo '<form style="display:inline;" name='; echo '"formMore_'. $record['injury_auto_id'].'"';  echo 'method="post" action="'; echo base_url('MC/mai_view');echo '">
                                        <div class="form-group col-md-12 col-lg-12" style="display:none">
                                            <label for="recordId" class="control-label">Record ID*</label>
                                            <input required="required" class="form-control" name="recordId" id="recordId" placeholder="101" value="'; echo $record['injury_auto_id'];echo '">
                                        </div>
                                        <button class="btn btn-default btn-xs" data-title="More" id='; echo '"more_'. $record['injury_auto_id'].'"';  echo ' name='; echo '"more_'. $record['injury_auto_id'].'"'; echo 'type="submit" >More</button>
                                    </form> 
                                    <form style="display:inline;" name='; echo '"formManage_'. $record['injury_auto_id'].'"';echo 'method="post" action="'; echo base_url('MC/injury_management');echo '">
                                        <div class="form-group col-md-12 col-lg-12" style="display:none">
                                            <label for="recordId" class="control-label">Record ID*</label>
                                            <input required="required" class="form-control" name="recordId" id="recordId" placeholder="101" value="';echo $record['injury_auto_id']; echo '" >
                                        </div>';?>

                                        <?php $status=$record['diagnosis'].$record['treatment'].$record['physio_remarks'] ; if($status=="")
                                        { echo' <form style="display:inline;" name='; echo '"formAddIM_'. $record['injury_auto_id'].'"';  echo 'method="post" action="'; echo base_url("MC/injury_management");echo '">
                                            <div class="form-group col-md-12 col-lg-12" style="display:none">
                                                <label for="recordId" class="control-label">Record ID*</label>
                                                <input required="required" class="form-control" name="recordId" id="recordId" placeholder="101" value="'; echo $record["injury_auto_id"]; echo '">
                                            </div>
                                            <button class="btn btn-primary btn-xs" data-title="IM Record" id='; echo '"newimrecord_'. $record['injury_auto_id'].'"';  echo ' name='; echo '"newimrecord_'. $record['injury_auto_id'].'"';  echo 'type="submit" ><span class="fa fa-plus-circle "> IM Record</span> </button></form>';
                                        }else {
                                                echo' <form style="display:inline;" name='; echo '"formIM_'. $record['injury_auto_id'].'"';  echo 'method="post" action="'; echo base_url("MC/injury_management");echo '">
                                            <div class="form-group col-md-12 col-lg-12" style="display:none">
                                                <label for="recordId" class="control-label">Record ID*</label>
                                                <input required="required" class="form-control" name="recordId" id="recordId" placeholder="101" value="'; echo $record["injury_auto_id"]; echo '">
                                            </div>
                                            <button class="btn btn-warning btn-xs" data-title="IM Record" id='; echo '"imrecord_'. $record['injury_auto_id'].'"';  echo ' name='; echo '"imrecord_'. $record['injury_auto_id'].'"';  echo 'type="submit" ><span class="fa fa-minus-circle "> IM Record</span> </button></form>';
                                            }?>
                                    </form>  

                                    <form style="display:inline;" name=<?php echo '"formEdit_'. $record['injury_auto_id'].'"';  ?> method="post" action="<?php echo base_url('MC/eir_view');?>">
                                        <div class="form-group col-md-12 col-lg-12" style="display:none">
                                            <label for="recordId" class="control-label">Record ID*</label>
                                            <input required="required" class="form-control" name="recordId" id="recordId" placeholder="101" value="<?php echo $record['injury_auto_id']; ?>">
                                        </div>
                                        <input class="btn btn-info btn-xs" data-title="Edit" id=<?php echo '"edit_'. $record['injury_auto_id'].'"';  ?> name=<?php echo '"edit_'. $record['injury_auto_id'].'"';  ?>  type="submit" value="Edit IR">
                                    </form> 
                                    <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" id=<?php echo '"del_'. $record['injury_auto_id'].'"';  ?> name=<?php echo '"del_'. $record['injury_auto_id'].'"';  ?> value=<?php echo '"'.$record['injury_auto_id'].'"';  ?> onclick="delIRId(this);">Delete</button>
                                </td>
                            </tr>
                            <?php $count=$count+1;} ?>
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
            </div>
             <div id="injury-record-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-full">
                    <div class="modal-content">
                        <div class="modal-header" style="border-bottom: none!important;margin-bottom: -20px">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="full-width-modalLabel" ><strong style="color: darkred"> New Injury Record</strong></h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" method="post" action="<?php echo base_url(); ?>MC/new_injury_record" id="injury_record" >
                                <div class="row setup-content" >
                                    <div class="col-xs-12">
                                        <div class="col-md-12">
                                            <div class="form-group col-md-12 col-lg-12">
                                                <label for="playerid" class="control-label">Select Player*</label>
                                                <select type="text" name="playerid" placeholder="Name of Player" class=" form-control" id="playerid" required="required">
                                                    <option value="">--Select Player--</option>
                                                    <?php foreach($players as $player){ ?>
                                                    <option  value="<?php echo $player['player_auto_id']; ?>"> <?php echo $player['player_fname']." ".$player['player_lname'];} ?></option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6">
                                                <label for="dateOfInjury" class="control-label">Date of Injury*</label>
                                                <input required="required" class="form-control" name="dateOfInjury" id="dateOfInjury" placeholder="e.g. 27-April-2017">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6">
                                                <label for="dateInHospital" class="control-label">Date Seen*</label>
                                                <input required="required" class="form-control" name="dateInHospital" id="dateInHospital" placeholder="e.g. 28-April-2017">
                                            </div>
                                            <div class="form-group col-md-12 col-lg-12 ">
                                                <label for="injuryDescription" class="control-label">Injury Description*</label>
                                                <textarea required="required" class="form-control" name="injuryDescription" placeholder="e.g. Twisted leg"></textarea>
                                            </div>
                                            <div class="form-group col-md-12 col-lg-12">
                                            <div class="modal-header"></div>
                                                <br>
                                                <input type="submit" class="btn btn-primary" value="Submit">
                                                <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->


            <!-- Delete player modal -->
             <div class="modal fade" id="delete_ir" tabindex="-1" role="dialog" aria-labelledby="Delete" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> -->
                            <button class="btn btn-danger" style="width: 100%!important;"><span class="pull-left"><span class="fa fa-warning"></span> Are you really sure you want to delete this Injury record?</span></button>
                        </div>
                    
                        <form role="form" method="post"  id="ir_delete" action="<?php echo base_url(); ?>MC/deleteIR">
                            <div class="modal-body ">
                             <div class="form-group col-md-12 col-lg-12" hidden="true">
                                    <label for="recordId" class="control-label">Record Id</label>
                                    <input type="text" name="recordId" placeholder="Record Id" class=" form-control" id="recordId" required="required" readonly="true" >
                                </div>
                            <h4> <strong class="text-danger">Warning!! Injury record of Id: <span id="injid" style="color:darkblue"></span> will be permanently deleted</strong></h4>
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" class="btn btn-warning" id="disable_confirm"><span class="fa fa-check"></span> PROCEED</button>
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
    $("#injury_list").dataTable().fnDestroy();//destroy the table and recreate it for every refresh
    //define datatable
     $('#injury_list').dataTable({responsive:true,"iDisplayLength": 10,"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],
         "aoColumnDefs": [
                    {
                         "aTargets": [0],"bSortable":false, "orderable": false
                    },
                    {
                        "aTargets": [4], "orderable": false
                    }]
   });
     //--end define datatable
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
        $('#injury_record #dateOfInjury').datepicker({
        format: "yyyy-mm-dd",
        todayHighlight: true,
        autoclose: true,
        calendarWeeks: false
        });

        $('#injury_record #dateInHospital').datepicker({
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
