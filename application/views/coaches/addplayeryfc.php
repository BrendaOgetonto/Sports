<!DOCTYPE html>
<html>
<head>
   <title>SU Sports | New Yellow Fever Card</title>
<?php $this->load->view('headerlinks/headerlinks.php');?> 
</head>
<body class="hold-transition skin-blue sidebar-mini" style="background-color: #222d32;">
<div class="wrapper">
<?php $coachnav= $this->session->userdata('coachnav'); $this->load->view($coachnav); ?><!--navigation -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row" style="margin-bottom: -15px;">
            <div class="col-lg-12 ">
                <h4><b>Dashboard</b> <span class="fa fa-angle-double-right"></span>Add Yellow Fever Card for <b class="text-success"><?php echo $this->session->userdata('pst_player_name');?></b></h4>
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
                <?php echo form_open_multipart('coach/newplayeryfc',array('id' => 'player_yfc','method'=>'post'));?>
                    <div class="row setup-content" id="step-1">
                        <div class="col-sm-12">
                            <div class="col-md-6">
                                <!-- <h3> Step 1</h3> -->
                              <div class="col-md-11 col-md-offset-1">
                                <div class="form-group">
                                    <div class="main-img-preview">
                                      <img class="thumbnail img-preview" src="<?php echo base_url();?>assets/img/default_yfc.jpg" title="Player Photo" width="340" height="230">
                                    </div>
                                    <!-- <p class="help-block">* Upload admin passport photo.</p> -->
                                  </div>
                              </div>
                              <div class="col-md-6 col-md-offset-3">
                                <div class="input-group">
                                  <input id="fakeUploadLogo" class="form-control fake-shadow"  disabled="disabled" style="display: none; ">
                                  <div class="input-group-btn">
                                    <div class="fileUpload btn btn-default fake-shadow">
                                     <span><i class="fa fa-upload"></i> Yellow Fever Card Page</span>
                                      <input id="photo-id" name="photo" type="file" class="attachment_upload" required="required">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div><!--/.col-md-6-->
                            <div class="col-md-6">
                              <div class="form-group col-md-12 col-lg-12" hidden="true">
                                <label for="playerId" class="control-label" style="margin-top: 10px;">Player Id <span class="star">*</span></label>
                                <input type="text" name="playerId" placeholder="" class=" form-control" id="playerId" required="required"  value="<?php echo $this->session->userdata('pst_player_id');?>" readonly="true">
                              </div>
                                <div class='col-md-12'>
                                    <label for="issue_date" class="control-label">Date of Issue</label>
                                    <div class="form-group">
                                        <div class='input-group date' id='issue_date'>
                                            <input type='text' class="form-control" readonly="true" name="issue_date" />
                                            <span class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class='col-md-12'>
                                    <label for="expiry_date" class="control-label">Date of Expiry</label>
                                    <div class="form-group">
                                        <div class='input-group date' id='expiry_date'>
                                            <input type='text' class="form-control" readonly="true" name="expiry_date" />
                                            <span class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <!--/.col-md-6-->

                            <div class="col-md-12">
                              <div class="form-group col-md-12 col-lg-12">
                                  <input class="btn btn-primary  pull-left" type="submit" value="Submit">
                                </div>
                            </div>
                            <!--/.col-md-6-->
                        </div>
                    </div>
                <?php echo form_close();?>
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
     $('#plslist').dataTable({responsive:true,"iDisplayLength": 5,"lengthMenu": [[5, 25, 50, 100, 200, -1], [5, 25, 50, 100, 200, "All"]],
         "aoColumnDefs": [{ "aTargets": [0],"bSortable":false, "orderable": false},{"aTargets": [3], "orderable": false}]
      });
   var  submitBtn = $('input[type="submit"]');
        // allWells.show();
    submitBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            curInputs = curStep.find("input,select,file"),
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
    
    //image upload
    var brand = document.getElementById('photo-id');
    brand.className = 'attachment_upload';
    brand.onchange = function() {
        document.getElementById('fakeUploadLogo').value = this.value.substring(12);
    };

    // Source: http://stackoverflow.com/a/4459419/6396981
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                $('.img-preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#photo-id").change(function() {
        readURL(this);
    });
    //datepicker
    $(function () {$('#issue_date').datepicker({format: "yyyy-mm-dd",minDate:new Date(),todayHighlight: true});$('#expiry_date').datepicker({format: "yyyy-mm-dd",todayHighlight: true});});
});
//to refresh the page
$( "#refresh").click( function(event)
    {
        window.setTimeout(function(){location.reload()},1)

    });
</script>
</body>
</html>
