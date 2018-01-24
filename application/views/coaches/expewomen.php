<!DOCTYPE html>
<html>
<head>
   <title>SU Sports | Expenditures</title>
<?php $this->load->view('headerlinks/headerlinks.php'); ?> 
</head>
<body class="hold-transition skin-blue sidebar-mini" style="background-color: #222d32;">
<div class="wrapper">
<?php $coachnav= $this->session->userdata('coachnav'); $this->load->view($coachnav); ?><!--navigation -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row " style="margin-bottom: -15px;">
            <div class="col-lg-12 " >
                <h4 class="pull-left"><b>Dashboard</b> <span class="fa fa-angle-double-right"></span> Expenditures (Ladies)</h4>
                <div class="pull-right">
                    <span data-placement="top" data-toggle="tooltip" title="Refresh">
                        <button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh
                          </button>
                    </span>
                    <span data-placement="top" data-toggle="tooltip" title="Print All">
                        <a class="btn btn-xs" data-title="Print All" type="button" href="#"><span class="fa fa-print"></span>&nbsp;Print All</a>
                    </span>
                </div> 
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box" >
            <div class="box-body">
                              <div class="box box-solid collapsed-box" style="background:lightgrey">
                    <div class="box-header">
                        <h3 class="box-title" style="color: #21618C;" >New Expense</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            <!-- <button class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i></button> -->
                        </div>
                    </div>
                    <div style="display: none;background-color: #FFFFFF;color: #000000;border-bottom: 2px solid;border-color: #979A9A;" class="box-body">
                          <?php echo form_open('coach/newexpense_ladies',array('id' => 'newExpenditure','method'=>'post'));?>
                            <div class="col-md-12">
                                <div class="form-group col-md-6 col-lg-6 " hidden="true">
                                    <label for="category" class="control-label">Category<span class="star">*</span></label>
                                    <input type="text" name="category" class="form-control" id="category" required="required" value="Women" >
                                </div>
                                <div class='col-md-6 col-lg-6'>
                                  <label for="exDate" class="control-label">Expenditure Date</label>
                                  <div class="form-group">
                                      <div class='input-group date' id='exDate'>
                                          <input type='text' class="form-control" readonly="true" name="exDate" />
                                          <span class="input-group-addon">
                                              <span class="fa fa-calendar"></span>
                                          </span>
                                      </div>
                                  </div>
                                </div>                                
                                <div class="form-group col-md-6 col-lg-6">
                                    <label for="cash" class="control-label">Cash (Kshs)<span class="star">*</span></label>
                                    <input type="number" name="cash" placeholder="1975.00" class="form-control" id="cash" required="required" step="0.01" min="0">
                                </div>
                                <div class="form-group col-md-6 col-lg-6">
                                    <label for="lpoNo" class="control-label">LPO No.<span class="star">*</span></label>
                                    <input type="number" name="lpoNo" placeholder="102" class=" form-control" id="lpoNo" required="required"  min="1">
                                </div>
                                <div class="form-group col-md-6 col-lg-6">
                                    <label for="lpo" class="control-label">LPO (Kshs)<span class="star">*</span></label>
                                    <input type="number" name="lpo" placeholder="2000.00" class=" form-control" id="lpo" required="required" step="0.01" min="0">
                                </div>
                                 <div class="form-group col-md-6 col-lg-6">
                                    <label for="lunches" class="control-label">Lunches (Kshs)<span class="star">*</span></label>
                                    <input type="number" name="lunches" placeholder="575.50" class=" form-control" id="lunches" required="required" step="0.01" min="0">
                                </div>
                                <div class="form-group col-md-6 col-lg-6">
                                    <label for="receipt" class="control-label">Receipt</label>
                                    <input type="file" name="receipt" placeholder="" class=" form-control" id="receipt">
                                </div>
                                <div class="form-group col-md-12 col-lg-12">
                                    <label for="comments" class="control-label"> Comments<span class="star">*</span></label>
                                    <textarea type="text" name="comments" placeholder="Fare and Lunch" class=" form-control" id="comments" required="required" style="min-height: 40px;resize: none;overflow:hidden;" maxlength="100"></textarea>
                                </div>
                               
                                <div class="form-group col-md-12 col-lg-12">
                                <div class="modal-header"></div>
                                    <br>
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                    <input type="reset" class="btn btn-default" value="Reset">
                                </div>
                          </div>
                          <?php echo form_close();?>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
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

                <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%" id="expenselist"  >
                    <thead>
                        <tr>
                            <th class="text-left">Expense Date</th>
                            <th class="text-left">Cash(Kshs)</th>
                            <th class="text-left">LPO(Kshs)</th>
                            <th class="text-left">Lunches(Kshs)</th>
                            <th class="text-center"></th>
                         </tr>
                    </thead>
                    <tbody >
                       <?php foreach($expenses as $exps){ 
                           ?>
                        <tr>
                            <td class="text-left"><?php  echo date_format(date_create($exps['expense_date']),"D j<\s\up>S</\s\up> M, Y"); ?></td>
                            <td class="text-left"><?php  echo number_format($exps['expense_cash'],2); ?></td>
                            <td class="text-left"><?php  echo number_format($exps['expense_lpo_amount'],2); ?></td>
                            <td class="text-left"><?php  echo number_format($exps['expense_lunches'],2); ?></td>
                            <td class="text-center">
                                <form style="display:inline;" name=<?php echo '"formMore_'. $exps['expense_auto_id'].'"';  ?> method="post" action="<?php echo base_url('coach/expenditureinfo');?>">
                                    <div class="form-group col-md-12 col-lg-12" style="display:none">
                                        <label for="expsId" class="control-label">exps ID*</label>
                                        <input required="required" class="form-control" name="expsId" id="expsId" placeholder="101" value="<?php echo $exps['expense_auto_id']; ?>">
                                    </div>
                                    <button class="btn btn-success btn-xs" data-title="View More" id=<?php echo '"more_'. $exps['expense_auto_id'].'"';  ?> name=<?php echo '"more_'. $exps['expense_auto_id'].'"';  ?>  type="submit" style="background-color:#374850;color:#FFFFFF;"> <span class="fa fa-eye"></span> View More </button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- /.table-responsive -->
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
    $('#expenselist').dataTable({responsive:true,"iDisplayLength": 7,"lengthMenu": [[7, 25, 50, 100, 200, -1], [7, 25, 50, 100, 200, "All"]],
         "aoColumnDefs": [{"bSortable":false, "aTargets": [4]}],'aaSorting':[]
   });
     var  submitBtn = $('input[type="submit"]');
        // allWells.show();
    submitBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            curInputs = curStep.find("input,select"),
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
//datepicker
$(function () {$('#exDate').datepicker({format: "yyyy-mm-dd",minDate:new Date(),todayHighlight: true});});
  
});
//to refresh the page
$( "#refresh").click( function(event)
    {
        window.setTimeout(function(){location.reload()},1)

    });
</script>
</body>
</html>
