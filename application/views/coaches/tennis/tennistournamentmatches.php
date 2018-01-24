<!DOCTYPE html>
<html>
<head>
   <title>SU Sports | Tournaments</title>
<?php $this->load->view('headerlinks/headerlinks.php'); ?> 
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
                <div class="pull-right">
                     <span data-placement="top" data-toggle="tooltip" title="Back to Tournaments">
                        <a href="<?php echo base_url('coach/').strtolower($this->session->userdata('tournamentTeamCategory')).'tournaments';?>" class="btn btn-xs" data-title="Back to Tournaments " style="text-decoration: none;color: #000000;"><span class="fa fa-mail-reply"></span>&nbsp;Back
                        </a>
                    </span>
                </div> 
                <h4><b>Dashboard</b> <span class="fa fa-angle-double-right"></span><span style="color: ;font-weight: bolder;text-shadow: #7D3C98 0 0 25px;"> <?php echo $team_name.' '.$this->session->userdata('tournamentTitle');?> Tournament Matches</span></h4>
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
                <div class="box box-solid collapsed-box" style="background:lightgrey">
                    <div class="box-header">
                        <h3 class="box-title" style="color: #21618C;" >New Match</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            <!-- <button class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i></button> -->
                        </div>
                    </div>
                    <div style="display: none;background-color: #FFFFFF;color: #000000;border-bottom: 2px solid;border-color: #979A9A;" class="box-body">
                        <?php echo form_open('coach/newtournmatch',array('id' => 'tournament_match_registration','method'=>'post'));?>
                        <div class="row setup-content" >
                            <div class="col-xs-12">
                                <div class="col-md-12">
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="matchDate" class="control-label green">Match Date</label>
                                        <input type="text" name="matchDate" placeholder="" class="form-control" id="matchDate" required="required" value="<?php echo date('Y-m-d');  ?>" readonly="true">
                                    </div>
                                     <div class="form-group col-md-6 col-lg-6">
                                        <label for="matchVenue" class="control-label green">Match Venue</label>
                                        <input type="text" name="matchVenue" placeholder="" class="form-control" id="matchVenue" required="required">
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="matchOpponents" class="control-label green">Opponents</label>
                                        <input type="text" name="matchOpponents" placeholder="" class="form-control" id="matchOpponents" required="required">
                                    </div>
                                    <div class="form-group col-md-6 col-lg-6">
                                        <label for="matchLevel" class="control-label">Game Level <span class="star">*</span></label>
                                        <select type="text" name="matchLevel" class=" form-control" id="matchLevel" required="required">
                                            <option value="">--Select Level--</option>
                                            <option value="Preliminaries">Preliminaries</option>
                                            <option value="Quarters">Quarters</option>
                                            <option value="Semis">Semis</option>
                                            <option value="Finals">Finals</option>
                                        </select>
                                    </div>
                                   <div class="form-group col-md-6 col-lg-6">
                                        <label>Start Time</label>
                                        <!-- <input class="form-control" placeholder="Adjournment time" name="endtime" id="endtime" type="time"> -->
                                         <div class='input-group time' id='matchStartTime'>
                                            <input class="form-control" placeholder="9:15 AM" name="matchStartTime" required="required" autocomplete="off" />
                                            <span class="input-group-addon">
                                                <span class="fa fa-clock-o"></span>
                                            </span>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group col-md-12 col-lg-12">
                                        <table id="list" class="table table-bordred table-striped">
                                           <thead>
                                                <th class="text-left"><input type="checkbox" id="checkall" /> &nbsp;&nbsp;Full Name</th>
                                                <th class="text-center" id="pid">Player PID</th>
                                            </thead>
                                            <tbody>
                                                <?php foreach($players as $player){ 
                                                       ?>
                                                    <tr>
                                                        <td class="text-left"><input type="checkbox" name="playerList[]" class="checkthis" value="<?php  echo $player['player_auto_id']; ?>"  /> &nbsp;&nbsp;<?php  echo $player['player_fname']. " ".$player['player_lname'];?></td>
                                                        <td class="text-left"><?php  echo $player['player_auto_id']; ?></td><!--td not used. Important when submiting via ajax-->
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                        <button id="submitmatch" class="btn btn-primary" style="margin-top: 10px" >Submit</button>
                                    </div><!--/.form-group-->
                                </div><!--/.col-md-12-->
                            </div><!--/.col-xs-12-->
                        </div><!--/.setup-content-->
                        <?php echo form_close();?>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
              
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
                <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%" id="matchlist"  >
                    <thead>
                        <tr style="display: none;">
                            <th class="text-left"></th>
                         </tr>
                    </thead>
                    <tbody style="color: #17202A  ;">
                       <?php   foreach($matches as $match){
                           ?>
                        <tr>
                            <td colspan=100% style="padding: 0px!important;margin: 0px!important; ">
                                 <div class="box box-solid collapsed-box" style="background: #222d32;">
                                    <div class="box-header">
                                        <h3 class="box-title" style="color: #FFFFFF;"> SU vs <?php  echo $match['match_opponents']; ?> on <?php  echo date_format(date_create($match['match_date']),"j<\s\up>S</\s\up> M, Y"); ?>  at <?php  echo $match['match_venue']; ?> </h3>
                                        <div class="box-tools pull-right clicked" style="margin-left: 10px;">
                                            <button class="btn btn-default btn-sm " data-widget="collapse"><i class="fa fa-plus" style="color: #FFFF00;"></i></button>
                                            <!-- <button class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i></button> -->
                                        </div>
                                    </div>
                                    <div style="background-color: #FFFFFF;color: #000000;" class="box-body" style="padding: 0px!important;margin: 0px!important">
                                         <table  class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">From</th>
                                                        <th class="text-center">To</th>
                                                        <th class="text-center"></th>
                                                     </tr>
                                                </thead>
                                                <tbody style="color: #17202A  ;">
                                                    <tr>
                                                        <td class="text-center"> <?php echo date('h:i A', strtotime($match['match_start_time']));  ?> </td>
                                                        <td class="text-center"><?php $endtime=$match['match_end_time']; if($endtime==""){echo "";}else{ echo date('h:i A', strtotime($match['match_end_time'])); } ?></td>
                                                        <td class="text-center pull-right">
                                                            <form style="display:inline;" name=<?php echo '"formLiveScores_'. $match['match_auto_id'].'"';  ?> method="post" action="#" >
                                                                <div class="form-group col-md-12 col-lg-12" style="display:none">
                                                                    <label for="matchId" class="control-label">Match ID*</label>
                                                                    <input required="required" class="form-control" name="matchId" id="matchId" value="<?php echo $match['match_auto_id']; ?>">
                                                                </div>
                                                                
                                                                <div class="form-group col-md-12 col-lg-12" style="display:none">
                                                                    <label for="matchDetails" class="control-label">Match Details*</label>
                                                                    <input required="required" class="form-control" name="matchDetails" id="matchDetails" value="<?php echo date_format(date_create($match['match_date']),"j<\s\up>S</\s\up> M, Y"); ?> Match at <?php echo $match['match_venue']; ?> from  <?php echo date('h:i A', strtotime($match['match_start_time']));?> (Opponents:<?php echo $match['match_opponents']; ?>)">
                                                                </div>
                                                                <button class="btn btn-primary btn-s " data-title="New Team Scores" id=<?php echo '"teamscore_'. $match['match_auto_id'].'"';  ?> name=<?php echo '"teamscore_'. $match['match_auto_id'].'"';  ?>  type="submit" style="margin-right: 5px;margin-top: 5px;"><span class="fa fa-plus-circle"></span> Live Scores</button>  
                                                            </form>
                                                            <button class="btn btn-danger btn-s " data-title="Opponent Scores" id=<?php echo '"oppscore_'. $match['match_auto_id'].'"';  ?> name=<?php echo '"oppscore_'. $match['match_auto_id'].'"';  ?>  type="submit" value="<?php echo $match['match_auto_id'];?>" onclick="opponentscore(this);" style="margin-top:5px; "><span class="fa fa-plus-circle"></span> Rival Score</button>  
                                                        </td>
                                                    </tr>

                                                    <td colspan=100% style="padding: 0px!important;margin: 0px!important; ">
                                                         <div class="box box-solid collapsed-box" style="background-color: #D0D3D4;" >
                                                            <div class="box-header">
                                                                <h3 class="box-title"> <span style="color: #000000;font-weight: bold;">Summary</span></h3>
                                                                <div class="box-tools pull-right clicked2" >
                                                                <button class="btn btn-default btn-sm " data-widget="collapse" value=<?php echo '"'. $match['match_auto_id'].'"';  ?> id="matchid"><i class="fa fa-plus"></i></button>
                                                                </div>
                                                            </div>
                                                            <div style="display: none;background-color: #FFFFFF;color: #000000;" class="box-body">
                                                                <table class="table table-striped table-bordered table-hover display responsive nowrap" cellspacing="0" width="100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center">Scores</th>
                                                                            <th class="text-center" style="border:none;"></th>
                                                                            <th class="text-center" style="border:none;"></th>
                                                                            <th class="text-center" style="border:none;"></th>
                                                                        </tr>
                                                                    </thead>
                                                                     <tbody style="color: #17202A;">
                                                                        <tr>
                                                                            <td class="text-center"><?php echo $match['team_alias'] ?> <span id="suScore"></span> - <span id="opponentScore"><?php echo $match['match_opponents_score'];?></span> <?php echo $match['match_opponents'] ?></td>
                                                                            <td class="text-center" style="background-color:#F1C40F;color: #FFFFFF;"><span id="yellowcard"></span></td>
                                                                            <td class="text-center" style="background-color:#FF0000;color: #FFFFFF;"><span id="redcard"></span></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div><!-- /.box-body -->
                                                        </div>
                                                        <!-- /.box -->
                                                        <div class="box box-solid collapsed-box" style="background-color: #D0D3D4;">
                                                            <div class="box-header">
                                                                <h3 class="box-title"> <span style="color: #000000;font-weight: bold;">Players</span></h3>
                                                                <div class="box-tools pull-right clicked3" >
                                                                <button class="btn btn-default btn-sm " data-widget="collapse" value=<?php echo '"'. $match['match_auto_id'].'"';  ?> id="matchid"><i class="fa fa-plus"></i></button>
                                                                </div>
                                                            </div>
                                                            <div style="display: none;background-color: #FFFFFF;color: #000000;" class="box-body" id="playersDiv">
                                                            </div><!-- /.box-body -->
                                                        </div>
                                                    </td>
                                                </tbody>
                                            </table>
                                            <!-- /.table-responsive -->

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

      <!--  opponentscore -->
        <div id="opponentsScoreModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-full">
                <div class="modal-content">
                    <div class="modal-header" style="border-bottom: none!important;margin-bottom: -20px">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="full-width-modalLabel" ><strong style="color: darkred">Opponent Score</strong></h4>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open('coach/new'.strtolower($this->session->userdata('coachSportName')).'opponentscore',array('id' => 'opponentscore','method'=>'post'));?>
                            <div class="row setup-content" >
                                <div class="col-xs-12">
                                    <div class="col-md-12" >
                                         <div class="form-group col-md-6 col-lg-6 " hidden="true">
                                            <label for="matchId" class="control-label">Match Id*</label>
                                            <input type="text" name="matchId" class="form-control" id="matchId" required="required" >
                                        </div>
                                        <div class="form-group col-md-12 col-lg-12">
                                            <label for="opponentScore" class="control-label"> Opponent Score*</label>
                                            <input type="number" name="opponentScore" placeholder="" class=" form-control" id="opponentScore" required="required" min="0">
                                        </div>
                                        <div class="form-group col-md-12 col-lg-12">
                                            <label>End Time</label>
                                             <div class='input-group time' id='matchEndTime'>
                                                <input class="form-control" placeholder="9:15 AM" name="matchEndTime" required="required" autocomplete="off" id="endTime" />
                                                <span class="input-group-addon">
                                                    <span class="fa fa-clock-o"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 col-lg-12">
                                            <input type="submit" class="btn btn-primary" value="Submit" id="opponentscorebtn">
                                            <input type="reset" class="btn btn-default" value="Reset">
                                            <input type="button" class="btn btn-danger pull-right" data-dismiss="modal" value="Close">
                                        </div>
                                    </div>
                                </div>
                            </div>
                          <?php echo form_close();?>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- /.opponents-modal -->
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
(function() {var matched, browser;
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
     $('#matchlist').dataTable({responsive:true,"iDisplayLength": 5,"lengthMenu": [[5, 25, 50, 100, 200, -1], [5, 25, 50, 100, 200, "All"]]
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
    
$("#list #checkall").click(function () {if ($("#list #checkall").is(':checked')) {$("#list input[type=checkbox]").each(function () {$(this).prop("checked", true);});} else {$("#list input[type=checkbox]").each(function () {$(this).prop("checked", false);}); }});
       // get players for playerList match
$('.clicked2').click(function() {var clicks = $(this).data('clicks');
  if (clicks) {} else {var item=$(this);
     // even clicks
     //get the id of the match from the expand button
    var pid=$(this).parent().find('button').val();
    // alert(pid);
    $.ajax({type:"post", url: "<?php echo base_url(); ?>coach/hockeymatchscore",data:{ pid:pid},
    dataType:'json',success:function(data){item.parent().closest('div').parent().children('div').eq(1).find('#suScore').text(data);}});
     $.ajax({type:"post", url: "<?php echo base_url(); ?>coach/hockeygreen",data:{ pid:pid},
    dataType:'json',success:function(data){item.parent().closest('div').parent().children('div').eq(1).find('#greencard').text(data);}});
      $.ajax({type:"post", url: "<?php echo base_url(); ?>coach/hockeyyellow",data:{ pid:pid},
    dataType:'json',success:function(data){item.parent().closest('div').parent().children('div').eq(1).find('#yellowcard').text(data);}});
     $.ajax({type:"post", url: "<?php echo base_url(); ?>coach/hockeyred",data:{ pid:pid},
    dataType:'json',success:function(data){item.parent().closest('div').parent().children('div').eq(1).find('#redcard').text(data);}});
}
    $(this).data("clicks", !clicks);
});
    
   // get players for playerList match
$('.clicked3').click(function() {
    var parentDiv = $(this).parent().closest('div').parent().children('div').eq(1);
    parentDiv.empty();
    // var ele = $(this).parent();
    // alert($(this).parent().find('button').val());
    var clicks = $(this).data('clicks');
  if (clicks) {
     // odd clicks
  } else {
    var item=$(this);
     // even clicks
    // alert($(this).parent().find('button').val());
    var pid=$(this).parent().find('button').val();
    // alert(pid);
    $.ajax({type:"post", url: "<?php echo base_url(); ?>coach/getplayers",data:{ pid:pid},
    dataType:'json',success:function(data){var count=0;$.each(data,function(a,b){ count=count+1;var opt = $('<div class="col-md-3" />');opt.val(a);opt.text(count+'. '+b); parentDiv.append(opt);}); }});}$(this).data("clicks", !clicks);
});
   
});//close document.ready
function opponentscore(obj)
{
    var match_id=obj.value;
    // alert(matchid);
    $('#opponentsScoreModal #matchId').val(match_id);
    $('#opponentsScoreModal').modal('show');
};

 //datetimepicker
  $(function () {$('#matchStartTime').datetimepicker({format: 'LT'});});
  $(function () {$('#matchEndTime').datetimepicker({format: 'LT'});});

//to refresh the page
$( "#refresh").click( function(event)
    {
        window.setTimeout(function(){location.reload()},1)

    });
</script>
</body>
</html>
