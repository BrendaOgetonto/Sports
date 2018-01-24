<!DOCTYPE html>
<html>
<head>
   <title>SU Sports | Training Days</title>
<?php $this->load->view('headerlinks/headerlinks.php'); ?> 
   <link href="<?php echo base_url(); ?>assets/general-css/smsgeneral.css" rel="stylesheet" type="text/css" />

</head>
<body class="hold-transition skin-blue sidebar-mini" style="background-color: #222d32;">
<div class="wrapper">
<?php $coachnav= $this->session->userdata('coachnav'); $this->load->view($coachnav); ?><!--navigation -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row ">
            <div class="col-lg-12 ">
                <h4><b>Dashboard</b> <span class="fa fa-angle-double-right"></span> Training Days</h4>
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
                <br>
                <span data-placement="top" data-toggle="tooltip" title="Add Training Days">
                    <button class="btn btn-info btn-s" data-title="Add Training Days" data-toggle="modal" data-target="#training-days-modal" ><span class="fa fa-plus-circle"></span>&nbsp;Add Days</button>
                </span>
                <span data-placement="top" data-toggle="tooltip" title="Refresh">
                    <button class="btn btn-s" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh
                        </button>
                </span>
                <span data-placement="top" data-toggle="tooltip" title="Print All">
                    <a class="btn btn-s" data-title="Print All" type="button" href="<?php echo base_url('');?>"><span class="fa fa-print"></span>&nbsp;Print All</a>
                </span>
                <br><br>
                <?php $msg = $this->session->flashdata('msg');
                $successful= $msg['success']; $failed=  $msg['error']; if ($successful=="" && $failed!=""){ echo '
                <div class="messagebox alert alert-warning" style="display: block">
                        <button type="button" class="close" data-dismiss="alert">*</button>
                        <div class="cs-text">
                            <i class="fa fa-info-circle"></i>
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
                <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%" id="tr_days_list"  >
                    <thead>
                        <tr>
                        <!-- <tr  style="background:#374850;color: #FFFFFF;"> -->
                            <th class="text-center">Year</th>
                            <th class="text-center">Jan</th>
                            <th class="text-center">Feb</th>
                            <th class="text-center">Mar</th>
                            <th class="text-center">Apr</th>
                            <th class="text-center">May</th>
                            <th class="text-center">Jun</th>
                            <th class="text-center">Jul</th>
                            <th class="text-center">Aug</th>
                            <th class="text-center">Sep</th>
                            <th class="text-center">Oct</th>
                            <th class="text-center">Nov</th>
                            <th class="text-center">Dec</th>
                            <th class="text-center"></th>
                         </tr>
                    </thead>
                    <tbody >
                        <?php foreach($tr_days as $tr_day){ 
                           ?>
                        <tr>
                            <td class="text-center"><?php  echo $tr_day['trd_year']; ?></td>
                            <td class="text-center"><?php  echo $tr_day['january']; ?></td>
                            <td class="text-center"><?php  echo $tr_day['february']; ?></td>
                            <td class="text-center"><?php  echo $tr_day['march']; ?></td>
                            <td class="text-center"><?php  echo $tr_day['april']; ?></td>
                            <td class="text-center"><?php  echo $tr_day['may']; ?></td>
                            <td class="text-center"><?php  echo $tr_day['june']; ?></td>
                            <td class="text-center"><?php  echo $tr_day['july']; ?></td>
                            <td class="text-center"><?php  echo $tr_day['august']; ?></td>
                            <td class="text-center"><?php  echo $tr_day['september']; ?></td>
                            <td class="text-center"><?php  echo $tr_day['october']; ?></td>
                            <td class="text-center"><?php  echo $tr_day['november']; ?></td>
                            <td class="text-center"><?php  echo $tr_day['december']; ?></td>
                            
                            <td class="text-center">
                            <form style="display:inline;" name=<?php echo '"formEdit_'. $tr_day['trd_auto_id'].'"';  ?> method="post" action="<?php echo base_url('MC/etrd');?>">
                                <div class="form-group col-md-12 col-lg-12" style="display:none">
                                    <label for="trdId" class="control-label">Trds ID*</label>
                                    <input required="required" class="form-control" name="trdId" id="trdId" placeholder="" value="<?php echo $tr_day['trd_auto_id']; ?>">
                                </div>
                                <button class="btn btn-success btn-xs" data-title="Edit" id=<?php echo '"edit_'.$tr_day['trd_auto_id'].'"';  ?> name=<?php echo '"edit_'.$tr_day['trd_auto_id'].'"';  ?>  type="submit" ><span class="fa fa-edit fa-fw"></span> Edit</button>
                            </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- /.table-responsive -->

                <!-- training-days-modal -->
                <div id="training-days-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-full">
                        <div class="modal-content">
                            <div class="modal-header" style="border-bottom: none!important;margin-bottom: -20px">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="full-width-modalLabel" ><strong style="color: darkred">New Training Days</strong></h4>
                                    <hr>
                            </div>
                            <div class="modal-body">
                               <form role="form" id="tr_days_registration" method="post" action="<?php echo base_url(); ?>MC/newtds">
                                  <div class="row setup-content" >
                                      <div class="col-s-12">
                                          <div class="form-group col-md-2 col-lg-2">
                                              <label for="january" class="control-label">January*</label>
                                              <input type="number" name="january" required="required" placeholder="" class="form-control" id="january" max="31" min="0" >
                                          </div>
                                          <div class="form-group col-md-2 col-lg-2">
                                              <label for="february" class="control-label">February*</label>
                                              <input type="number"  name="february" required="required" placeholder="" class="form-control" id="february" max="29" min="0" >
                                          </div>
                                           <div class="form-group col-md-2 col-lg-2">
                                              <label for="march" class="control-label">March*</label>
                                              <input type="number" name="march"required="required" placeholder="" class="form-control" id="march" max="31" min="0" >
                                          </div>
                                         <div class="form-group col-md-2 col-lg-2">
                                              <label for="april" class="control-label">April*</label>
                                              <input type="number"  name="april" required="required" placeholder="" class="form-control" id="april" max="30" min="0" >
                                          </div>
                                         <div class="form-group col-md-2 col-lg-2">
                                              <label for="may" class="control-label">May*</label>
                                              <input type="number" name="may" required="required" placeholder="" class="form-control" id="may" max="31" min="0" >
                                          </div>
                                         <div class="form-group col-md-2 col-lg-2">
                                              <label for="june" class="control-label">June*</label>
                                              <input type="number" name="june" required="required" placeholder="" class="form-control" id="june" max="30" min="0" >
                                          </div>
                                         <div class="form-group col-md-2 col-lg-2">
                                              <label for="july" class="control-label">July*</label>
                                              <input type="number" required="required" name="july" placeholder="" class="form-control" id="july" max="31" min="0" >
                                          </div>
                                         <div class="form-group col-md-2 col-lg-2">
                                              <label for="august" class="control-label">August*</label>
                                              <input type="number" name="august" required="required" placeholder="" class="form-control" id="august" max="31" min="0" >
                                          </div>
                                         <div class="form-group col-md-2 col-lg-2">
                                              <label for="september" class="control-label">September*</label>
                                              <input type="number" name="september" required="required" placeholder="" class="form-control" id="september" max="30" min="0" >
                                          </div>
                                         <div class="form-group col-md-2 col-lg-2">
                                              <label for="october" class="control-label">October*</label>
                                              <input type="number" name="october" required="required"  placeholder="" class="form-control" id="october" max="31" min="0" >
                                          </div>
                                         <div class="form-group col-md-2 col-lg-2">
                                              <label for="november" class="control-label">November*</label>
                                              <input type="number" name="november" required="required" placeholder="" class="form-control" id="november" max="30" min="0" >
                                          </div>
                                         <div class="form-group col-md-2 col-lg-2">
                                              <label for="december" class="control-label">December*</label>
                                              <input type="number" name="december"  required="required" placeholder="" class="form-control" id="december" max="31" min="0" > 
                                          </div>
                                          <div class="form-group col-md-12 col-lg-12">
                                            <hr>
                                          </div>
                                          <div class="form-group col-md-12 col-lg-12">
                                              <input type="submit" class="btn btn-primary" value="Submit">
                                              <input type="button" class="btn btn-warning" data-dismiss="modal" value="Close">
                                          </div>
                                      </div>
                                  </div>
                              </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <!-- /.training-days-modal -->
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
     $("#tr_days_list").dataTable().fnDestroy();//destroy the table and recreate it for every refresh
    //define datatable
     var table=$('#tr_days_list').dataTable({responsive:true,"iDisplayLength": 5,"lengthMenu": [[5, 25, 50, 100, 200, -1], [5, 25, 50, 100, 200, "All"]],
         "aoColumnDefs": [{"bSortable":false, "aTargets": [13],"bSearchable": false,"sWidth":"10%" }]
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
