<!DOCTYPE html>
<html>
<head>
   <title>SU Sports | Physiotherapists</title>
<?php $this->load->view('headerlinks/headerlinks.php'); ?> 
<link href="<?php echo base_url(); ?>assets/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
 <style>
    @media (max-width:767px){.select2 {width: 100% !important;}}
    @media (min-width:768px){.select2 {width: 100% !important;}}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini" style="background-color: #222d32;">
<div class="wrapper">
<?php $this->load->view('admin/adminnav'); ?><!--navigation -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row" style="margin-bottom: -15px;">
            <div class="col-lg-12 ">
                <h4 class="pull-left"><b>Dashboard</b> <span class="fa fa-angle-double-right"></span> Physiotherapists</h4>
                <div class="pull-right">
                    <span data-placement="top" data-toggle="tooltip" title="Add Physiotherapist">
                      <button class="btn btn-info btn-xs" data-title="Add Physiotherapist" data-toggle="modal" data-target="#physiotherapists-registration-modal" ><span class="fa fa-plus-circle"></span>&nbsp;Add Physio</button>
                    </span>
                    <span data-placement="top" data-toggle="tooltip" title="Refresh">
                        <button class="btn btn-xs" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh</button>
                    </span>
                    <span data-placement="top" data-toggle="tooltip" title="Print All">
                        <a class="btn btn-xs" data-title="Print All" type="button" href="<?php echo base_url('');?>"><span class="fa fa-print"></span>&nbsp;Print All</a>
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
            <div class="box-body"  >
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
                            <i class="fa fa-check"></i>
                            <strong><span>';echo $msg['success'];echo '</span></strong>
                        </div> 
                </div>';}?>

                <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%" id="phytheslist"  >
                    <thead>
                        <tr>
                            <th class="text-left">Full Name</th>
                            <th class="text-left">ID</th>
                            <th class="text-left">Phone Number</th>
                            <th class="text-left"></th>
                         </tr>
                    </thead>
                    <tbody >
                        <?php foreach($phythes as $phyth){ ?>
                        <tr>
                            <td class="text-left"><?php  echo $phyth['phyth_fname']. " ".$phyth['phyth_lname']; ?></td>
                            <td class="text-left"><?php  echo $phyth['phyth_nid'];  ?></td>
                            <td class="text-left"><?php  echo $phyth['phyth_phone']; ?></td>
                            <td class="text-center">
                               <form style="display:inline;" name=<?php echo '"formMore_'. $phyth['phyth_auto_id'].'"';  ?> method="post" action="<?php echo base_url('dos/physioprofile');?>">
                                    <div class="form-group col-md-12 col-lg-12" style="display:none">
                                        <label for="phythId" class="control-label">Physiotherapist ID*</label>
                                        <input required="required" class="form-control" name="phythId" id="phythId" placeholder="" value="<?php echo $phyth['phyth_auto_id']; ?>">
                                    </div>
                                    <button class="btn btn-default btn-xs" data-title="View More" id=<?php echo '"more_'. $phyth['phyth_auto_id'].'"';  ?> name=<?php echo '"more_'. $phyth['phyth_auto_id'].'"';  ?>  type="submit" style="background-color: #ECF0F1;color: #000000;"> <span class="fa fa-eye"></span> View </button>
                                </form>
                                <form style="display:inline;" name=<?php echo '"formEdit_'. $phyth['phyth_auto_id'].'"';  ?> method="post" action="<?php echo base_url('dos/editphysio');?>">
                                    <div class="form-group col-md-12 col-lg-12" style="display:none">
                                        <label for="phythId" class="control-label">Physiotherapist ID*</label>
                                        <input required="required" class="form-control" name="phythId" id="phythId" placeholder="" value="<?php echo $phyth['phyth_auto_id']; ?>">
                                    </div>
                                    <button class="btn btn-default btn-xs" data-title="Edit Physiotherapist" id=<?php echo '"edit_'. $phyth['phyth_auto_id'].'"';  ?> name=<?php echo '"edit_'. $phyth['phyth_auto_id'].'"';  ?>  type="submit" style="background-color: #7B7D7D;color: #FFFFFF;"><span class="fa fa-edit"></span> Edit </button>
                                </form> 
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- /.table-responsive -->

                <!--  expenses-modal -->
                <div id="physiotherapists-registration-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-full">
                        <div class="modal-content">
                            <div class="modal-header" style="border-bottom: none!important;margin-bottom: -20px">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="full-width-modalLabel" ><strong style="color: darkred">New Physiotherapist</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form role="form" id="newExpenditure" method="post" action="<?php echo base_url(); ?>mc/newtherapist">
                                    <div class="row setup-content" >
                                        <div class="col-xs-12">
                                            <div class="col-md-12" >
                                                 <!-- <h3> Step 1</h3> -->
                                            <div class="form-group col-md-6 col-lg-6 ">
                                              <label for="firstName" class="control-label">First Name*</label>
                                              <input type="text" name="firstName" placeholder="" class="form-control" id="firstName" required="required" maxlength="15">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6" >
                                                <label for="lastName" class="control-label">Last Name*</label>
                                                <input type="text" name="lastName" placeholder="" class="form-control" id="lastName" required="required" maxlength="15">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6">
                                                <label for="otherNames" class="control-label">Other Names</label>
                                                <input type="text" name="otherNames" placeholder="" class="form-control" id="otherNames" maxlength="20">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6">
                                                <label for="staffID" class="control-label">Staff ID*</label>
                                                <input type="text" name="staffID" placeholder="" class=" form-control" id="staffID" required="required"  data-mask="099999">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6">
                                                <label for="userName" class="control-label">Username*</label>
                                                <input type="text" name="userName" placeholder="smokoro" class=" form-control" id="userName" required="required" maxlength="15" minlength="4">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6">
                                                <label for="nationalID" class="control-label">National ID No.*</label>
                                                <input type="number" name="nationalID" placeholder="" class=" form-control" id="nationalID" required="required" min="0" max="999999999999">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6">
                                                <label for="phoneNumber" class="control-label"> Current Phone No.*</label>
                                                <input type="text" name="phoneNumber" placeholder="" class=" form-control" id="phoneNumber" required="required" data-mask="0799999999">
                                            </div>

                                            <div class="form-group col-md-6 col-lg-6">
                                                <label for="emailAddress" class="control-label"> Current Email Address*</label>
                                                <input type="email" name="emailAddress" placeholder="" class=" form-control" id="emailAddress" required="required" maxlength="50">
                                            </div>
                                             <div class="form-group col-md-6 col-lg-6">
                                                <label for="currentResidence" class="control-label"> Current Residence*</label>
                                                <input type="text" name="currentResidence" placeholder="Madaraka Estate, Tulia Court (HSE1137)" class=" form-control" id="currentResidence" required="required">
                                            </div>
                                            <div class="form-group col-md-6 col-lg-6">
                                            <label for="" class="control-label">User Agreement</label><br>
                                                <input type="checkbox" name="agreement" id="agreement" value="1" required="required" autocomplete="off" style="display: inline;">
                                                <label for="agreement" class="control-label" style="font-weight: normal">&nbsp;I agree with set rules<span class="star">*</span></label><br><br>
                                            </div>
                                            <div class="form-group col-md-12 col-lg-12">
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
                <!-- /.physiotherapists-registration-modal -->
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
    //define datatable
     var table=$('#phytheslist').dataTable({responsive:true,"iDisplayLength": 7,"lengthMenu": [[7, 25, 50, 100, 200, -1], [7, 25, 50, 100, 200, "All"]],
         "aoColumnDefs": [{"bSortable":false, "aTargets": [3]}],'aaSorting':[]
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
});
//to refresh the page
$( "#refresh").click( function(event)
    {
        window.setTimeout(function(){location.reload()},1)

    });
</script>
</body>
</html>
