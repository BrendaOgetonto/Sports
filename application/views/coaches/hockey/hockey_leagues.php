<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SUSMS - Matches</title>
   <?php $this->load->view('headerlinks/headerlinks.php'); ?>
   <link href="<?php echo base_url(); ?>assets/css/core.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
    <?php $coachnav= $this->session->userdata('coachnav'); $this->load->view($coachnav); ?><!--navigation -->
    <div id="page-wrapper">
        <div class="row" style="margin-bottom: -15px;">
            <div class="col-lg-12 ">
                <h4><b>Dashboard</b> <span class="fa fa-angle-right"></span> Matches</h4>
                <hr>
            </div>
            <!-- /.col-lg-12 -->
        </div>
            <span data-placement="top" data-toggle="tooltip" title="Add Match">
                    <button class="btn btn-primary btn-s" data-title="Add Match" data-toggle="modal" data-target="#matches-modal" ><span class="fa fa-plus-circle"></span>&nbsp;Add Match</button></span>
             <span data-placement="top" data-toggle="tooltip" title="Refresh"><button class="btn btn-s" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
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
                            <i class="fa fa-exclamation-circle"></i>
                            <strong><span>';echo $msg['error']; echo '</span></strong>
                        </div> 
                </div>';}else if($successful=="" && $failed==""){echo '<div></div>';} else if ($successful!="" && $failed==""){ echo '
                <div class="messagebox alert alert-success" style="display: block">
                        <button type="button" class="close" data-dismiss="alert">*</button>
                        <div class="cs-text">
                            <i class="fa fa-check"></i>
                            <strong><span>';echo $msg['success'];echo '</span></strong>
                        </div> 
                </div>';}?>
        <div class="row">
            <div class="col-md-12">
                <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%" id="expenselist"  >
                    <thead>
                        <tr>
                            <th class="text-center">Match Dates</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Match Title</th>
                            <th class="text-center">Venue</th>
                            <th class="text-center">Action</th>
                         </tr>
                    </thead>
                    <tbody >
                       <?php foreach($hmatches as $hms){ 
                           ?>
                        <tr>
                            <td class="text-center"><?php  echo $hms['hkm_dates']; ?></td>
                            <td class="text-center"><?php  echo $hms['hkm_category'];  ?></td>
                            <td class="text-center"><?php  echo $hms['hkm_title']; ?></td>
                            <td class="text-center"><?php  echo $hms['hkm_venue']; ?></td>
                            <td class="text-center">
                                <form style="display:inline;" name=<?php echo '"formMore_'. $hms['hkm_auto_id'].'"';  ?> method="post" action="<?php echo base_url('coach/hkmore');?>">
                                    <div class="form-group col-md-12 col-lg-12" style="display:none">
                                        <label for="hmsId" class="control-label">hms ID*</label>
                                        <input required="required" class="form-control" name="hmsId" id="hmsId" placeholder="101" value="<?php echo $hms['hkm_auto_id']; ?>">
                                    </div>
                                    <button class="btn btn-success btn-s" data-title="View More" id=<?php echo '"more_'. $hms['hkm_auto_id'].'"';  ?> name=<?php echo '"more_'. $hms['hkm_auto_id'].'"';  ?>  type="submit" > <span class="fa fa-eye"></span> View More </button>
                                </form>
                                <form style="display:inline;" name=<?php echo '"formMore_'. $hms['hkm_auto_id'].'"';  ?> method="post" action="<?php echo base_url('coach/hkmore');?>">
                                    <div class="form-group col-md-12 col-lg-12" style="display:none">
                                        <label for="hmsId" class="control-label">hms ID*</label>
                                        <input required="required" class="form-control" name="hmsId" id="hmsId" placeholder="101" value="<?php echo $hms['hkm_auto_id']; ?>">
                                    </div>
                                    <button class="btn btn-success btn-s" data-title="View More" id=<?php echo '"more_'. $hms['hkm_auto_id'].'"';  ?> name=<?php echo '"more_'. $hms['hkm_auto_id'].'"';  ?>  type="submit" > <span class="fa fa-eye"></span> View More </button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- /.table-responsive -->
            </div>
        </div>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<?php $this->load->view('scriptlinks/scriptlinks.php'); ?>
<script>
$(document).ready(function () {
    $("#expenselist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh
    //define datatable
     var table=$('#expenselist').dataTable({responsive:true,"iDisplayLength": 10,"lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],
         "aoColumnDefs": [{"bSortable":false, "aTargets": [4],"bSearchable": false,"sWidth":"10%" }]
   });
     //--end define datatable
});
  
//to refresh the page
$( "#refresh").click( function(event)
        {
            window.setTimeout(function(){location.reload()},1)

        });
  
</script>
</body>
</html>
