<!DOCTYPE html>
<html>
<head>
   <title>SU Sports | Hockey Tornaments</title>
<?php $this->load->view('headerlinks/headerlinks.php'); ?> 
   <link href="<?php echo base_url(); ?>assets/css/core.css" rel="stylesheet" type="text/css" />
   <style>
    @media (max-width:767px){ ul.typeahead.dropdown-menu
        { background-color: #E8F8F5;margin-right: 0px!important; margin-left: 5%!important;margin-right: 5%!important; margin-top: 40%!important;}
    #selectscorers{margin-left: 10px!important;min-width: 98%!important;}
     #selectscrs{margin-left: -3%!important;}}
    @media (min-width:768px){ ul.typeahead.dropdown-menu{background-color: #E8F8F5;margin-right: 0px!important;margin-left: 20%!important; margin-right: 3%!important; margin-top: 11%!important;}#selectscorers{ margin-left: 10px!important; min-width: 98%!important;}#selectscrs{margin-left: -2%!important;}}

   </style>
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
                <h4><b>Dashboard</b> <span class="fa fa-angle-double-right"></span> Tournament Summary</h4>
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
                <div class="messagebox alert alert-danger" style="display: none" id="alertselect">
                    <button type="button" class="close" data-dismiss="alert">*</button>
                    <div class="cs-text">
                        <i class="fa fa-close"></i>
                        <strong><span>Refresh lost tournament id. Please select afresh to proceed</span></strong>
                    </div> 
                </div>
                <div class="col-xs-12" id="selectscrs">
                    <div class="col-md-12" >
                        <div class="form-group  col-md-12 col-lg-12 text-left" >
                            <strong style="color: darkred">Select Scorers</strong>
                        </div>
                    </div>
                </div>
                <br><br>
                <div id="selectscorers" contenteditable="true" class="form-group  col-md-11" style="margin-left: 30px;min-height: 35px; border:1px solid;border-radius: 10px;padding: 8px;">
                </div>
                <form role="form" id="newHockeySummary" method="post" action="<?php echo base_url(); ?>coach/addhoksummary">
                    <div class="row setup-content" >
                        <div class="col-md-12" >
                            <div class="form-group col-md-12 col-lg-12" hidden="true">
                                <label for="hmsId" class="control-label">Match Id</label>
                                <input type="text" name="hmsId"  class=" form-control" id="hmsId" value="<?php foreach($hmatches as $match){ echo $match['hkm_auto_id']; }?>">
                            </div>
                            <div class="form-group col-md-12 col-lg-12">
                                <label for="scorers" class="control-label">Goal Scorers*</label>
                                <input type="text" name="scorers" placeholder=" " class=" form-control" id="scorers" required="required" readonly="true">
                            </div>
                            <div class="form-group col-md-12 col-lg-12">
                                <label for="refComments" class="control-label">Comments on Refereeing</label>
                                <textarea type="text" name="refComments" placeholder="" class=" form-control" id="refComments" required="required"></textarea>
                            </div>
                            <div class="form-group col-md-12 col-lg-12">
                                <label for="summary" class="control-label"> Game Summary</label>
                                <textarea type="text" name="summary" placeholder="" class=" form-control" id="summary" required="required"></textarea>
                            </div>
                            
                            <div class="form-group col-md-12 col-lg-12">
                            <div class="modal-header"></div>
                                <br>
                                <input type="submit" class="btn btn-primary" value="Submit">
                                <input type="reset" class="btn btn-default" value="Reset">
                            </div>
                        </div>
                    </div>
                </form> 
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
<script src="<?php echo base_url();?>assets/customjs/bootstrap-typeahead.js"></script>
<script src="<?php echo base_url();?>assets/customjs/rangy-core.js"></script>
<script src="<?php echo base_url();?>assets/customjs/caret-position.js"></script>
<script src="<?php echo base_url();?>assets/customjs/bootstrap-tagautocomplete.js"></script>
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
    $('#selectscorers').keyup(function() { $('#scorers').val($(this).text()); });});
        $('div#selectscorers').tagautocomplete({
          source: function( request, response ) { $.ajax({
                type:"post",
                url: "<?php echo base_url('coach/getplayers');?>",
                dataType:'json',
                success: function(data) {response(data);console.log(data); }});}
    });

</script>
</body>
</html>
