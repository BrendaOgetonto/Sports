<!DOCTYPE html>
<html>
<head>
 
  <title>Macheo | Game Sheet</title>
<?php $this->load->view('headerlinks/headerlinks.php'); ?>
  
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
                <h4><b>Dashboard</b> <span class="fa fa-angle-double-right"></span> Game Sheet (League)</h4>
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
                <table  class="table table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%" id="studentslist">
                    <tbody style="color: #17202A  ;">
                        <div class="form-group col-md-12 col-lg-12">
                            <label class="control-label">Quarter</label>
                            <select type="text" name="quarter" placeholder="" class="form-control" id="quarter">
                                <option>--Select Quarter--</option>
                                <option value="1">1<sup>st</sup></option>
                                <option value="2">2<sup>nd</sup></option>
                                <option value="3">3<sup>rd</sup></option>
                                <option value="4">4<sup>th</sup></option>
                            </select>
                        </div>
                     <?php foreach($players as $player){ ?>
                        <tr >
                            <td colspan=100% >
                                 <div class="box box-solid collapsed-box" style="margin-bottom: 0px!important;padding: 0px!important;background-color: #F0F3F4;">
                                    <div class="box-header">
                                        <h3 class="box-title"><?php  echo $player['player_fname']. " ".$player['player_lname'];?></h3>
                                        <div class="box-tools pull-right clicked" >
                                            <button class="btn btn-default btn-sm " data-widget="collapse" ><i class="fa fa-plus"></i></button>
                                            <!-- <button class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i></button> -->
                                        </div>
                                    </div>
                                    <div style="background-color: #FFFFFF;color: #000000;" class="box-body">
                                        <form method="post" action="">
                                            <div class="col-md-12">
                                                <div class="col-md-2 col-lg-2 text-center">
                                                    <div class="form-group col-md-12 col-lg-12 text-center">
                                                        <label class="control-label ">Score</label>
                                                        <input type="number" name="minute" class="form-control" id="minute" min="0">
                                                    </div>
                                                </div>
                                                <div class="col-md-7 col-lg-7 text-center">
                                                    <div class="form-group col-md-4 col-lg-4 text-center">
                                                        <label class="control-label"><span style="color:#196F3D;">Green</span></label><br>
                                                        <input type="radio" name="card" id="green" style="background: #196F3D;">
                                                    </div>
                                                    <div class="form-group col-md-4 col-lg-4 text-center">
                                                        <label class="control-label"><span style="color:#F1C40F;">Yellow</span></label><br>
                                                        <input type="radio" name="card" placeholder="" id="yellow" style="background: #F1C40F;">
                                                    </div>
                                                     <div class="form-group col-md-4 col-lg-4 text-center">
                                                        <label class="control-label"><span style="color:#D35400;">Red</span></label><br>
                                                        <input type="radio" name="card" placeholder="" id="red" style="background: #D35400;">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-lg-3 text-center">
                                                    <div class="form-group col-md-12 col-lg-12 text-left">
                                                        <br>
                                                        <input type="submit" value="Save" class="btn btn-primary">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div><!-- /.box-body -->
                                </div>
                              <!-- /.box -->
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
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>v</b>1.0 | By Phenom Research Lab
    </div>
    <strong>Copyright &copy; 2017<a href="#"> Macheo </a>.</strong> All rights
    reserved.
  </footer>
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
$( "#refresh").click( function(event)
    {
        window.setTimeout(function(){location.reload()},1)

    });
</script>
</body>
</html>
