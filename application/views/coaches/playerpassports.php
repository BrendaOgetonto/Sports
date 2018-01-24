<!DOCTYPE html>
<html>
<head>
   <title>SU Sports | Travel Documents</title>
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
                <h4><b>Dashboard</b> <span class="fa fa-angle-double-right"></span> Travel Documents</h4>
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
                  <table  class="table table-striped table-hover display responsive nowrap" cellspacing="0" width="100%" id="plslist">
                    <thead>
                        <tr>
                            <th class="text-left">Full Name</th>
                            <th class="text-left">Passport No.</th>
                            <th class="text-left">Issue Date</th>
                            <th class="text-left">Expiry Date</th>
                            <th class="text-left">Months Due</th>
                            <th class="text-left">Country</th>
                            <th class="text-center"><i class="fa fa-cog"></i></th>
                         </tr>
                    </thead>
                    <tbody >
                       <?php foreach($players as $player){ 
                           ?>
                        <tr>
                            <?php $photo=$player['player_profile_photo']; if($photo==""){$profile="defaultimage.png";}else{$profile=$player['player_profile_photo'];}?>
                          <td class="text-left"><img src="<?php echo base_url();echo 'uploads/profile_photos/players/'.$profile?>" width="25" height="25" class="img-circle" alt="Intern Photo"> <?php  echo $player['player_fname']. " ".$player['player_lname']; ?></td>
                            <td class="text-center"><?php  $passportNumber= $player['passport_number']; if($passportNumber==""){echo "-";}else{echo $passportNumber;}?></td>
                            <td class="text-center"><?php $dateOfIssue= $player['issue_date']; if($dateOfIssue==""){echo "-";}else{echo $dateOfIssue;} ?></td>
                            <td class="text-center"><?php  $dateOfExpiry= $player['expiry_date']; if($dateOfExpiry==""){echo "-";}else{echo $dateOfExpiry;} ?></td>
                            <td class="text-center">
                                <?php 
                                if($player['expiry_date']=="")
                                {
                                    echo "-";
                                }else{
                                        $ts1 = strtotime(date('Y-m-d'));
                                        $ts2 = strtotime($player['expiry_date']);

                                        $year1 = date('Y', $ts1);
                                        $year2 = date('Y', $ts2);

                                        $month1 = date('m', $ts1);
                                        $month2 = date('m', $ts2);

                                        $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
                                        if($diff<6){echo $diff. " <span class='fa fa-warning text-danger'></span>";}else{echo $diff. " <span class='fa fa-check-circle-o text-success'></span>";}
                                    }
                                 ?>
                            </td>
                            <td class="text-center"><?php $issueCountry= $player['issue_country']; if($issueCountry==""){echo "-";}else{echo $issueCountry;} echo $player['issue_country']; ?></td>
                            <td class="text-center">
                                <?php $passport= $player['passport_number']; if($passport==""){?>
                                 <form style="display:inline;" name=<?php echo '"formPassport_'. $player['player_auto_id'].'"';  ?> method="post" action="<?php echo base_url('coach/addplayerpspt');?>">
                                    <div class="form-group col-md-12 col-lg-12" style="display:none">
                                        <label for="playerId" class="control-label">Player ID<span class="star">*</span></label>
                                        <input required="required" class="form-control" name="playerId" id="playerId" placeholder="" value="<?php echo $player['player_auto_id']; ?>">
                                    </div>
                                    <div class="form-group col-md-12 col-lg-12" style="display:none">
                                        <label for="playerName" class="control-label">Player ID<span class="star">*</span></label>
                                        <input required="required" class="form-control" name="playerName" id="playerName" placeholder="" value="<?php echo $player['player_fname']." ".$player['player_lname']; ?>">
                                    </div>
                                    <button class="btn btn-default btn-xs" data-title="View Player Passport" id=<?php echo '"playerPspt_'. $player['player_auto_id'].'"';  ?> name=<?php echo '"playerPspt_'. $player['player_auto_id'].'"';  ?>  type="submit" style="background-color: #4D5656;color: #FFFFFF;"> <span class="fa fa-plus-circle"></span> Pspt </button>
                                </form>
                                <?php } else{?>
                                <form style="display:inline;" name=<?php echo '"formEdit_'. $player['player_auto_id'].'"';  ?> method="post" action="<?php echo base_url('coach/editplayerpspt');?>">
                                    <div class="form-group col-md-12 col-lg-12" style="display:none">
                                        <label for="passportId" class="control-label">Passport ID*</label>
                                        <input required="required" class="form-control" name="passportId" id="passportId" placeholder="" value="<?php echo $player['passport_auto_id']; ?>">
                                    </div>
                                    <div class="form-group col-md-12 col-lg-12" style="display:none">
                                        <label for="playerName" class="control-label">Player ID<span class="star">*</span></label>
                                        <input required="required" class="form-control" name="playerName" id="playerName" placeholder="" value="<?php echo $player['player_fname']." ".$player['player_lname']; ?>">
                                    </div>
                                    <button class="btn btn-default btn-xs" data-title="Edit Player Passport" id=<?php echo '"playerPspt_'. $player['player_auto_id'].'"';  ?> name=<?php echo '"playerPspt_'. $player['player_auto_id'].'"';  ?>  type="submit" style="background-color: #808080;color: #FFFFFF;"> <span class="fa fa-edit"></span> Pspt </button>
                                </form>
                                <?php }?>
                                <form style="display:inline;" name=<?php echo '"formMore_'. $player['player_auto_id'].'"';  ?> method="post" action="<?php echo base_url('coach/playerpsptdetails');?>">
                                    <div class="form-group col-md-12 col-lg-12" style="display:none">
                                        <label for="playerId" class="control-label">Player ID*</label>
                                        <input required="required" class="form-control" name="playerId" id="playerId" placeholder="" value="<?php echo $player['player_auto_id']; ?>">
                                    </div><!--not using player id. May be used in future-->
                                    <div class="form-group col-md-12 col-lg-12" style="display:none">
                                        <label for="passportId" class="control-label">Passport ID*</label>
                                        <input required="required" class="form-control" name="passportId" id="passportId" placeholder="" value="<?php echo $player['passport_auto_id']; ?>">
                                    </div>
                                    <button class="btn btn-default btn-xs" data-title="View More" id=<?php echo '"more_'. $player['player_auto_id'].'"';  ?> name=<?php echo '"more_'. $player['player_auto_id'].'"';  ?>  type="submit" style="background-color: #ECF0F1;color: #000000;"> <span class="fa fa-eye"></span> View </button>
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
     $('#plslist').dataTable({responsive:true,"iDisplayLength": 5,"lengthMenu": [[5, 25, 50, 100, 200, -1], [5, 25, 50, 100, 200, "All"]],
         "aoColumnDefs": [{ "aTargets": [0],"bSortable":false, "orderable": false},{"aTargets": [6], "orderable": false}]
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
