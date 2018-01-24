<!DOCTYPE html>
<html>
<head>
  <title>Sports | Game Sheet</title>
<?php $this->load->view('headerlinks/headerlinks.php'); ?>
<style>
@media (max-width:767px){button{display: block!important;margin-bottom: 5px!important;width: 100%!important;} 
   }
@media (min-width:768px){ button{display: block!important;margin-bottom: 5px!important;width: 100%!important; }

</style>
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
                <div class="pull-right">
                     <span data-placement="top" data-toggle="tooltip" title="Back to Matches" >
                        <a href="<?php echo base_url('coach/tournmatches');?>" class="btn btn-xs" data-title="Back to Matches " style="text-decoration: none;color: #000000;" ><span class="fa fa-mail-reply "></span>&nbsp;Back
                        </a>
                    </span>
                </div> 
                <h4><b>Dashboard</b> <span class="fa fa-angle-double-right"></span><span style="color: ;font-weight: bolder;text-shadow: #7D3C98 0 0 25px;"> <?php echo $this->session->userdata('tournamentTeamName')." ".$this->session->userdata('tournamentTitle');?> Tournament </span>: Match Score Sheet</h4>
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
                <br>

                <div class="col-md-12 text-center"><label class="control-label" style="background-color: #1a2226;color: #FFFFFF;padding: 10px;"><b><?php echo $this->session->userdata('matchDetails');?> </b></label>
                </div>
                <br><br>
                <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%" id="playerlist">
                    <thead>
                        <tr style="display: none;">
                            <th class="text-left text-primary" style=""></th>
                         </tr>
                    </thead>
                    <tbody style="color: #17202A  ;">
                     <?php foreach($players as $player){ ?>
                        <tr>
                            <td colspan=100% style="padding: 0px!important;margin: 0px!important; ">
                                 <div class="box box-solid collapsed-box" style="background: #F0F3F4;">
                                    <div class="box-header">
                                        <h3 class="box-title" style="color: #000000;">
                                            <?php $photo=$player['player_profile_photo']; if($photo==""){$profile="defaultimage.png";}else{$profile=$player['player_profile_photo'];}?>
                                                <img src="<?php echo base_url();echo 'uploads/profile_photos/players/'.$profile?>" width="25" height="25" class="img-circle" alt="User Image">  <?php  echo $player['player_fname']. " ".$player['player_lname'];?></h3>
                                        <div class="box-tools pull-right clicked" >
                                            <button class="btn btn-default btn-sm " data-widget="collapse"><i class="fa fa-plus" style="color: #000000;"></i></button>
                                            <!-- <button class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i></button> -->
                                        </div>
                                    </div>
                                    <div style="background-color: #FFFFFF;color: #000000;" class="box-body">
                                        <div class="col-md-3 col-sm-12">
                                            <button class="btn btn-primary" value="<?php echo $player['player_auto_id'] ?>" id="scoreTime" onclick="scoreTime(this);" >Score Minute</button>
                                        </div>
                                        <div class="col-md-3 ol-sm-12">
                                            <button class="btn btn-success" value="<?php echo $player['player_auto_id'] ?>" id="greenCard" onclick="greenCard(this);">Green Card</button>
                                        </div>
                                        <div class="col-md-3">
                                            <button class="btn btn-warning" value="<?php echo $player['player_auto_id'] ?>" id="yellowCard" onclick="yellowCard(this);">Yellow Card</button>
                                        </div>
                                        <div class="col-md-3 ">
                                            <button class="btn btn-danger" value="<?php echo $player['player_auto_id'] ?>" value="redCard" onclick="redCard(this);">Red Card</button>
                                        </div>
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
   $("#playerlist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh
    //define datatable
     var table=$('#playerlist').dataTable({responsive:true,"iDisplayLength": 7,"lengthMenu": [[7, 25, 50, 100, 200, -1], [7, 25, 50, 100, 200, "All"]]});
});
  
function scoreTime(obj)
{
    var playerId=obj.value;
    var item="score_time";
    $.ajax({type:"post", url: "<?php echo base_url(); ?>coach/newhockeyscore",data:{playerId:playerId,item:item},
    dataType:'json',success:function(data){ alert(data); }});
};
function greenCard(obj)
{
    var playerId=obj.value;
    var item="green_time";
    $.ajax({type:"post", url: "<?php echo base_url(); ?>coach/newhockeyscore",data:{playerId:playerId,item:item},
    dataType:'json',success:function(data){ alert(data); }});
};
function yellowCard(obj)
{
    var playerId=obj.value;
    var item="yellow_time";
    $.ajax({type:"post", url: "<?php echo base_url(); ?>coach/newhockeyscore",data:{playerId:playerId,item:item},
    dataType:'json',success:function(data){ alert(data); }});
};
function redCard(obj)
{
    var playerId=obj.value;
    var item="red_time";
    $.ajax({type:"post", url: "<?php echo base_url(); ?>coach/newhockeyscore",data:{playerId:playerId,item:item},
    dataType:'json',success:function(data){ alert(data); }});
};

$( "#refresh").click( function(event)
    {
        window.setTimeout(function(){location.reload()},1)

    });
</script>
</body>
</html>
