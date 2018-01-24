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
              <div class="form-group col-md-2 col-lg-2">
                <span data-placement="top" data-toggle="tooltip" title="Refresh">
                    <button class="btn btn-s" data-title="Refresh "  id="refresh" ><span class="fa fa-refresh"></span>&nbsp;Refresh
                        </button>
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
              </div>
                
                <!-- training-days-modal -->
                <?php foreach($tr_days as $trd){?>
                <div class="modal-body">
                   <form role="form" method="post" action="<?php echo base_url(); ?>MC/utrdays">
                      <div class="row setup-content" >
                          <div class="col-s-12">
                              <div class="form-group col-lg-12">
                                <label for="trainingYear" class="control-label">Training Year*</label>
                                <input type="text" name="trainingYear" required="required" placeholder="2017" class="form-control" id="trainingYear" value="<?php echo $trd['trd_year']; ?>" readonly="true">
                              </div>
                              <div class="form-group col-md-2 col-lg-2">
                                  <label for="january" class="control-label">January*</label>
                                  <input type="number" name="january" required="required" placeholder="" class="form-control" id="january" value="<?php echo $trd['january']; ?>" min="0" max="31">
                              </div>
                              <div class="form-group col-md-2 col-lg-2">
                                  <label for="february" class="control-label">February*</label>
                                  <input type="number"  name="february" required="required" placeholder="" class="form-control" id="february" value="<?php echo $trd['february']; ?>" min="0" max="29">
                              </div>
                               <div class="form-group col-md-2 col-lg-2">
                                  <label for="march" class="control-label">March*</label>
                                  <input type="number" name="march"required="required" placeholder="" class="form-control" id="march" value="<?php echo $trd['march']; ?>" min="0" max="31">
                              </div>
                             <div class="form-group col-md-2 col-lg-2">
                                  <label for="april" class="control-label">April*</label>
                                  <input type="number"  name="april" required="required" placeholder="" class="form-control" id="april" value="<?php echo $trd['april']; ?>" min="0" max="30">
                              </div>
                             <div class="form-group col-md-2 col-lg-2">
                                  <label for="may" class="control-label">May*</label>
                                  <input type="number" name="may" required="required" placeholder="24" class="form-control" id="may" value="<?php echo $trd['may']; ?>" min="0" max="">
                              </div>
                             <div class="form-group col-md-2 col-lg-2">
                                  <label for="june" class="control-label">June*</label>
                                  <input type="number" name="june" required="required" placeholder="" class="form-control" id="june" value="<?php echo $trd['june']; ?>" min="0" max="30">
                              </div>
                             <div class="form-group col-md-2 col-lg-2">
                                  <label for="july" class="control-label">July*</label>
                                  <input type="number" required="required" name="july" placeholder="" class="form-control" id="july" value="<?php echo $trd['july']; ?>" min="0" max="31">
                              </div>
                             <div class="form-group col-md-2 col-lg-2">
                                  <label for="august" class="control-label">August*</label>
                                  <input type="number" name="august" required="required" placeholder="" class="form-control" id="august" value="<?php echo $trd['august']; ?>" min="0" max="31">
                              </div>
                             <div class="form-group col-md-2 col-lg-2">
                                  <label for="september" class="control-label">September*</label>
                                  <input type="number" name="september" required="required" placeholder="" class="form-control" id="september" value="<?php echo $trd['september']; ?>" min="0" max="30">
                              </div>
                             <div class="form-group col-md-2 col-lg-2">
                                  <label for="october" class="control-label">October*</label>
                                  <input type="number" name="october" required="required"  placeholder="" class="form-control" id="october" value="<?php echo $trd['october']; ?>" min="0" max="31">
                              </div>
                             <div class="form-group col-md-2 col-lg-2">
                                  <label for="november" class="control-label">November*</label>
                                  <input type="number" name="november" required="required" placeholder="" class="form-control" id="november" value="<?php echo $trd['november']; ?>" min="0" max="30">
                              </div>
                             <div class="form-group col-md-2 col-lg-2">
                                  <label for="december" class="control-label">December*</label>
                                  <input type="number" name="december"  required="required" placeholder="" class="form-control" id="december" value="<?php echo $trd['december']; ?>" min="0" max="31">
                              </div>
                              <div class="form-group col-md-12 col-lg-12">
                                  <input type="submit" class="btn btn-warning" value="Submit">
                              </div>
                          </div>
                      </div>
                  </form>
                </div>
                <?php }?>
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
         "aoColumnDefs": [{"bSortable":false, "aTargets": [0],"bSearchable": false,"orderable":false},{"bSortable":false, "aTargets": [13],"bSearchable": false,"sWidth":"10%" }]
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
