<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SUSMS - Expenditures</title>
   <?php $this->load->view('headerlinks/headerlinks.php'); ?>
</head>
<body>
<div id="wrapper">
    <?php $coachnav= $this->session->userdata('coachnav'); $this->load->view($coachnav); ?><!--navigation -->
    <div id="page-wrapper">
           <div class="row ">
            <div class="col-lg-12 ">
                <h4><b>Dashboard</b> <span class="fa fa-angle-right"></span> Expenditures</h4>
                <hr>
            </div>
            <!-- /.col-lg-12 -->
        </div>
            <span data-placement="top" data-toggle="tooltip" title="Add Expense">
                    <button class="btn btn-primary btn-s" data-title="Add Expenditure" data-toggle="modal" data-target="#expenses-modal" ><span class="fa fa-plus-circle"></span>&nbsp;Add Expense</button></span>
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
             <div class="row">
                <div class="col-md-12">
                    <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%" id="expenselist"  >
                        <thead>
                            <tr>
                                <th class="text-center">Expense Date</th>
                                <th class="text-center">Cash(Kshs)</th>
                                <th class="text-center">LPO(Kshs)</th>
                                <th class="text-center">Lunches(Kshs)</th>
                                <th class="text-center">Action</th>
                             </tr>
                        </thead>
                        <tbody >
                           <?php foreach($expenses as $exps){ 
                               ?>
                            <tr>
                                <td class="text-center"><?php  echo $exps['expense_date']; ?></td>
                                <td class="text-center"><?php  echo $exps['expense_cash'];  ?></td>
                                <td class="text-center"><?php  echo $exps['expense_lpo_amount']; ?></td>
                                <td class="text-center"><?php  echo $exps['expense_lunches']; ?></td>
                                <td class="text-center">
                                    <form style="display:inline;" name=<?php echo '"formMore_'. $exps['expense_auto_id'].'"';  ?> method="post" action="<?php echo base_url('mc/expmore');?>">
                                        <div class="form-group col-md-12 col-lg-12" style="display:none">
                                            <label for="expsId" class="control-label">exps ID*</label>
                                            <input required="required" class="form-control" name="expsId" id="expsId" placeholder="101" value="<?php echo $exps['expense_auto_id']; ?>">
                                        </div>
                                        <button class="btn btn-success btn-s" data-title="View More" id=<?php echo '"more_'. $exps['expense_auto_id'].'"';  ?> name=<?php echo '"more_'. $exps['expense_auto_id'].'"';  ?>  type="submit" > <span class="fa fa-eye"></span> View More </button>
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <!-- /.table-responsive -->
                </div>
            </div>
            <div id="expenses-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-full">
                    <div class="modal-content">
                        <div class="modal-header" style="border-bottom: none!important;margin-bottom: -20px">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="full-width-modalLabel" ><strong style="color: darkred">New Expenditure</strong></h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" id="newExpenditure" method="post" action="<?php echo base_url(); ?>MC/nexp">
                                <div class="row setup-content" >
                                    <div class="col-xs-12">
                                        <div class="col-md-12" >
                                             <div class="form-group col-md-6 col-lg-6 " hidden="true">
                                                <label for="category" class="control-label">Category*</label>
                                                <input type="text" name="category" class="form-control" id="category" required="required" value="Mixed" >
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6" >
                                                <label for="exDate" class="control-label"> Expenditure Date*</label>
                                                <input type="text" name="exDate" placeholder="YYYY-MM-DD" class="form-control" id="exDate" required="required">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6">
                                                <label for="cash" class="control-label">Cash (Kshs)*</label>
                                                <input type="text" name="cash" placeholder="Cash (Kshs.)" class="form-control" id="cash" required="required">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6">
                                                <label for="lpoNo" class="control-label">LPO No.*</label>
                                                <input type="text" name="lpoNo" placeholder="LPO No." class=" form-control" id="lpoNo" required="required">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6">
                                                <label for="lpo" class="control-label">LPO (Kshs)*</label>
                                                <input type="text" name="lpo" placeholder="LPO (Kshs.)" class=" form-control" id="lpo" required="required">
                                            </div>
                                             <div class="form-group col-md-6 col-lg-6">
                                                <label for="lunches" class="control-label">Lunches (Kshs)*</label>
                                                <input type="text" name="lpo" placeholder="Lunches (Kshs.)" class=" form-control" id="lpo" required="required">
                                            </div>
                                            <div class="form-group col-md-12 col-lg-12">
                                                <label for="comments" class="control-label"> Comments*</label>
                                                <input type="text" name="comments" placeholder="e.g. Fare and Lunch" class=" form-control" id="comments" required="required">
                                            </div>
                                           
                                            <div class="form-group col-md-12 col-lg-12">
                                            <div class="modal-header"></div>
                                                <br>
                                                <input type="submit" class="btn btn-primary" value="Submit">
                                                <input type="reset" class="btn btn-default" value="Reset">
                                                <input type="button" class="btn btn-danger pull-right" data-dismiss="modal" value="Close">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
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
         "aoColumnDefs": [{"bSortable":false, "aTargets": [4] }]
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
