<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Coachmodel extends CI_Model
{
function __construct()
{
     parent::__construct();
     $this->load->database();
}
//coach registration
public function new_coach($coach_details)
{
	if($this->db->insert('coaches',$coach_details))
        {
            return true;
        }else
            {
                return false;
            }
}

//player registration
public function newPlayer($player_details)
{
	if($this->db->insert('players',$player_details))
        {
            return true;
        }
         else
            {
                return false;
            }
}
//Tournament match registration
public function newTournMatch($match_details)
{
    if($this->db->insert('game_matches',$match_details))
        {
            $insert_id = $this->db->insert_id();
            return  $insert_id;
        }
         else
            {
                return false;
            }
}
//delete/undo the latest insert if players list insertion fails
public function deleteTournMatch($tournMatchId)
 {
        $this->db->where('match_auto_id',$tournMatchId);
        $this->db->delete('game_matches');
        $affected=$this->db->affected_rows();
        if($affected>0)
            {
                return true;

            }else
                 {
                    return false;
                 }
 }
//Tournament match players registration
public function tournMatchPlayers($playInfo)
{
    if($this->db->insert_batch('match_players',$playInfo))
        {
            return true;
        }
         else
            {
                return false;
            }
}
//get match players
public function getMatchPlayers($matchId)
{
    $this->db->select('mp.*, pls.player_fname,pls.player_lname,pls.player_auto_id,pls.player_profile_photo');
    $this->db->from('match_players mp');
    $this->db->join('players pls', 'pls.player_auto_id=mp.match_player_id');
    $this->db->where('mp.match_id',$matchId);
    return $this->db->get()->result_array();
}
//get match Scores
public function getHockeyMatchScores($matchId)
{
    $this->db->select('scores.*');
    $this->db->from('hockey_match_scores scores');
    $this->db->join('game_matches gms', 'gms.match_auto_id=scores.match_id');
    $this->db->where('gms.match_auto_id',$matchId);
    $this->db->where('scores.score_time!=',NULL);
    return $this->db->get()->result_array();
}
//Insert hockey match scores 
public function newHockeyScore($scoreDetails)
{
    if($this->db->insert('hockey_match_scores',$scoreDetails))
        {
            return true;
        }
         else
            {
                return false;
            }
}
//Insert hockey match scores 
public function newHockeyOpponentScore($opponentScoreDetails,$matchId)
{
    $this->db->where('match_auto_id',$matchId);
    $this->db->update('game_matches',$opponentScoreDetails);
    $affected=$this->db->affected_rows();
     if($affected>0)
            {
                return true;

            }else
                {
                    return false;
                }
}

//get match Green Cards
public function getMatchGreenCards($matchId)
{
    $this->db->select('scores.*');
    $this->db->from('hockey_match_scores scores');
    $this->db->join('game_matches gms', 'gms.match_auto_id=scores.match_id');
    $this->db->where('gms.match_auto_id',$matchId);
    $this->db->where('scores.green_time!=',NULL);
    return $this->db->get()->result_array();
}
//get match Yellow Cards
public function getMatchYellowCards($matchId)
{
    $this->db->select('scores.*');
    $this->db->from('hockey_match_scores scores');
    $this->db->join('game_matches gms', 'gms.match_auto_id=scores.match_id');
    $this->db->where('gms.match_auto_id',$matchId);
    $this->db->where('scores.yellow_time!=',NULL);
    return $this->db->get()->result_array();
}
//get match Red Cards
public function getMatchRedCards($matchId)
{
    $this->db->select('scores.*');
    $this->db->from('hockey_match_scores scores');
    $this->db->join('game_matches gms', 'gms.match_auto_id=scores.match_id');
    $this->db->where('gms.match_auto_id',$matchId);
    $this->db->where('scores.red_time!=',NULL);
    return $this->db->get()->result_array();
}
//player profile
public function playerProfile($playerId)
{
    $this->db->select('p.*,team.*');
    $this->db->from('players p');
    $this->db->join('teams team','team.team_auto_id=p.player_team_id');
    $this->db->where('p.player_auto_id',$playerId);
    $this->db->group_by('p.player_auto_id');
    $result=$this->db->get()->result_array();
    return $result;
}
//player profile update: no photo uploaded
public function updatePlayerNoPhoto($player_details,$player_auto_id)
{
        $this->db->where('player_auto_id',$player_auto_id);
        $this->db->update('players',$player_details);
        $affected=$this->db->affected_rows();
         if($affected>0)
                {
                    return true;

                }else
                    {
                        return false;
                    }
}
//player profile update: new photo uploaded
public function updatePlayer($player_details,$player_auto_id,$initFile)
{
        $this->db->where('player_auto_id',$player_auto_id);
        $this->db->update('players',$player_details);
        unlink("uploads/profile_photos/players/".$initFile);
        $affected=$this->db->affected_rows();
         if($affected>0)
                {
                    return true;

                }else
                    {
                        return false;
                    }
}
//disable player
public function disablePlayer($updateDetails,$player_auto_id)
{
    $this->db->where('player_auto_id',$player_auto_id);
    $this->db->update('players',$updateDetails);
    $affected=$this->db->affected_rows();
     if($affected>0)
            {
                return true;
            }else
                {
                    return false;
                }
}
//delete player with all records
public function deletePlayer($player_auto_id)
{
    $this->db->where('auto_id',$auto_id);
    $this->db->delete('players');
    $affected=$this->db->affected_rows();
     if($affected>0)
            {
                return true;
            }else
                {
                    return $this->db->error();
                }
}
//list of all active players per sport e.g. hockey
public function activePlayersList($sportId)
{
    $this->db->select('p.*,t.team_name');
    $this->db->from('players p');
    $this->db->join('teams t','t.team_auto_id=p.player_team_id');
    $this->db->where('player_sport_id',$sportId);
    $this->db->where('active_status',1);
    $result=$this->db->get()->result_array();
    return $result;
}
//list of all active players per sport e.g. hockey and their travel documents
public function activePlayersAndPassports($sportId)
{
    $this->db->select('pls.*,td.*');
    $this->db->from('players pls');
    $this->db->join('travel_documents td','pls.player_auto_id=td.player_id','left');
    $this->db->where('pls.active_status',1);
    $this->db->where('pls.player_sport_id',$sportId);
    $result=$this->db->get()->result_array();
    return $result;
}
//list of active players per team e.g. hockey's scorpions
public function activePlayers($sportId,$teamId)
{
    $this->db->select('pls.*');
    $this->db->from('players pls');
    $this->db->join('sports sport','sport.sport_id=pls.player_sport_id');
    $this->db->join('teams team','team.team_sport_id=sport.sport_id AND team.team_gender=pls.player_gender AND team.team_auto_id='.$teamId);
    $this->db->where('pls.active_status',1);
    $this->db->where('pls.player_sport_id',$sportId);
    // $this->db->where('team.team_auto_id',$teamId);
    $this->db->group_by('pls.player_auto_id');
    $result=$this->db->get()->result_array();
    return $result;
}
//list of active male team players
// public function activePlayersMen($teamId)
// {
//     $this->db->select('*');
//     $this->db->from('players');
//     $this->db->where('active_status',1);
//     $this->db->where('team_id',$teamId);
//     $this->db->where('player_gender','Male');
//     $result=$this->db->get()->result_array();
//     return $result;
// }
//list of active gladiators team players
// public function activeGladiators($teamId)
// {
//     $this->db->select('*');
//     $this->db->from('players');
//     $this->db->where('active_status',1);
//     $this->db->where('team_id',$teamId);
//     $this->db->where('player_gender','Male');
//     $result=$this->db->get()->result_array();
//     return $result;
// }
//list of all active  players
public function allActivePlayersList()
{
    $this->db->select('*');
    $this->db->from('players');
    $this->db->where('active_status',1);
    $result=$this->db->get()->result_array();
    return $result;
}
//captain registration
public function new_captain($captain_details)
{
    if($this->db->insert('captains',$captain_details))
        {
           return true;
        }
         else
            {
                return false;
            }
}


//list of active teams per sport e.g. Scorpions and Gladiators for Hockey Sport
public function activeTeamsListPerSport($sportId)
{
    $this->db->select('*');
    $this->db->from('teams');
    $this->db->where('team_sport_id',$sportId);
    $this->db->where('team_status',1);
    $result=$this->db->get()->result_array();
    return $result;
}
//list of courses
public function coursesList()
{
    $this->db->select('*');
    $this->db->from('courses');
    $result=$this->db->get()->result_array();
    return $result;
}
//save training days
public function newTrDays($tr_days_details)
{
    if($this->db->insert('training_days',$tr_days_details))
        {
            return true;
        }
         else
            {
                return false;
            }
}
//list of training days per team
public function trDaysList($sportId)
{
    $this->db->select('trds.*');
    $this->db->from('training_days trds');
    $this->db->where('trds.trd_sport_id',$sportId);
    $result=$this->db->get()->result_array();
    return $result;
}
//training days for per team
public function trdList($trdId)
{
    $this->db->select('*');
    $this->db->from('training_days');
    $this->db->where('trd_auto_id',$trdId);
    $result=$this->db->get()->result_array();
    return $result;
}
//update training days
public function updateTrDays($tr_days_details,$training_year)
{
     $this->db->where('trd_year',$training_year);
        $this->db->update('training_days',$tr_days_details);
        $affected=$this->db->affected_rows();
         if($affected>0)
                {
                    return true;

                }else
                    {
                        return false;
                    }
}
//new injury record
public function newInjuryRecord($injury_details)
{
     if($this->db->insert('injury_records',$injury_details))
        {
            return true;
        }
         else
            {
                return false;
            }
}
//update injury record
public function update_injury_record($record_details,$record_id)
{
     $this->db->where('injury_auto_id',$record_id);
        $this->db->update('injury_records',$record_details);
        $affected=$this->db->affected_rows();
         if($affected>0)
                {
                    return true;

                }else
                    {
                        return false;
                    }
}
//update injury management record
public function update_imr_record($record_details,$record_id)
{
     $this->db->where('injury_auto_id',$record_id);
        $this->db->update('injury_records',$record_details);
        $affected=$this->db->affected_rows();
         if($affected>0)
                {
                    return true;

                }else
                    {
                        return false;
                    }
}
//injury records
// public function injuryRecords()
// {
//     $this->db->select('ir.*, p.player_fname, p.player_lname,p.player_auto_id');
//     $this->db->from('injury_records ir');
//     $this->db->join('players p', 'injury_records ir, players p');
//     $this->db->where('ir.player_auto_id=p.player_auto_id');
//     $result=$this->db->get()->result_array();
//     return $result;
// }
//individual injury record edit
public function injuryRecord($recordId)
{
    $this->db->select('ir.*, p.player_fname, p.player_lname,p.player_other_names,p.player_auto_id');
    $this->db->from('injury_records ir');
    $this->db->where('ir.injury_auto_id',$recordId);
    $this->db->join('players p','ir.player_auto_id=p.player_auto_id');
    $result=$this->db->get()->result_array();
    return $result;
}

//check if an injury record has a injury management record entered
public function hasIMR()
{
$this->db->select('ir.*');
$this->db->from('injury_records ir');
$this->db->join('injury_management im','ir.injury_auto_id=im.injury_record_id');
$result=$this->db->get()->result_array();
return $result;
}
//delete injury record
public function deleteIR($recordId)
{
    $this->db->where('injury_auto_id',$recordId);
    $this->db->delete('injury_records');
    $affected=$this->db->affected_rows();
     if($affected>0)
            {
                return true;

            }else
                {
                    return false;
                }
}

//individual injury record edit
public function injuredPerson($recordId)
{
    $this->db->select('ir.*, p.player_fname, p.player_lname,p.player_other_names,p.player_auto_id');
    $this->db->from('injury_records ir');
    $this->db->join('players p','ir.player_auto_id=p.player_auto_id');
    $this->db->where('ir.injury_auto_id',$recordId);
    $this->db->group_by('p.player_auto_id');
    $result=$this->db->get()->result_array();
    return $result;
}
    // $this->db->join('students stud', 'mentor.mentorAutoId=stud.studMentorId', 'left');

//injury management records
public function injuryRecords($sportId)
{
    $this->db->select('ir.*,p.player_fname, p.player_lname,p.player_auto_id,p.player_other_names');
    $this->db->from('injury_records ir');
    $this->db->join('players p','p.player_auto_id=ir.player_auto_id');
    $this->db->where('p.player_sport_id',$sportId);
    $this->db->order_by('ir.injury_date','desc');
    $result=$this->db->get()->result_array();
    return $result;
}

//get specific injury management record
public function getInjuryRecord($injury_id)
{
    $this->db->select('ir.*, p.player_fname, p.player_lname,p.player_auto_id');
    $this->db->from('injury_records ir');
    $this->db->join('players p','ir.player_auto_id=p.player_auto_id');
    $this->db->where('ir.injury_auto_id',$injury_id);
    $result=$this->db->get()->result_array();
    return $result;
}

//new physio therapist
public function newPhysioTherapist($phyth_details)
{
    if($this->db->insert('physio_therapists',$phyth_details))
        {
            return true;
        }
         else
            {
                return false;
            }
}

//new injury management record insert
public function new_im_record($im_details,$record_id)
{
     $this->db->where('injury_auto_id',$record_id);
        $this->db->update('injury_records',$im_details);
        $affected=$this->db->affected_rows();
         if($affected>0)
                {
                    return true;

                }else
                    {
                        return false;
                    }
}
//new coach remarks insert (update table injury_records)
public function new_remarks($record_id,$remarks)
{
        $this->db->where('injury_auto_id',$record_id);
        $this->db->update('injury_records',$remarks);
        $affected=$this->db->affected_rows();
         if($affected>0)
                {
                    return true;

                }else
                    {
                        return false;
                    }
}
//update coach remarks (update table injury_records)
public function update_remarks($recordId,$remarks)
{
    $this->db->where('injury_auto_id',$recordId);
    $this->db->update('injury_records',$remarks);
    $affected=$this->db->affected_rows();
     if($affected>0)
            {
                return true;

            }else
                {
                    return false;
                }
}
//update coach remarks (set to null)
public function deleteRemark($recordId,$remarks)
{
    $this->db->where('injury_auto_id',$recordId);
    $this->db->update('injury_records',$remarks);
    $affected=$this->db->affected_rows();
     if($affected>0)
            {
                return true;

            }else
                {
                    return false;
                }
}
// expenditure per team (men)
public function expensesMen($teamId)
    {
        $this->db->select('exs.*');
        $this->db->from('expenditures exs');
        $this->db->where('exs.expense_team_auto_id',$teamId);
        $this->db->where('exs.expense_category',"Men");
        $this->db->order_by('exs.expense_date','DESC');
        $result=$this->db->get()->result_array();
        return $result;
    }
// expenditure per team (women)
public function expensesWomen($teamId)
    {
        $this->db->select('exs.*');
        $this->db->from('expenditures exs');
        $this->db->where('exs.expense_team_auto_id',$teamId);
        $this->db->where('exs.expense_category',"Women");
        $this->db->order_by('exs.expense_date','DESC');
        $result=$this->db->get()->result_array();
        return $result;
    }
// expenditure per team (mix)
public function expensesMixed($teamId)
    {
        $this->db->select('exs.*');
        $this->db->from('expenditures exs');
        $this->db->where('exs.expense_team_auto_id',$teamId);
        $this->db->where('exs.expense_category',"General");
        $this->db->order_by('exs.expense_date','DESC');
        $result=$this->db->get()->result_array();
        return $result;
    }
//specific expense details 
public function expenseDetails($expsId)
{
    $this->db->select('exs.*');
    $this->db->from('expenditures exs');
    $this->db->where('exs.expense_auto_id',$expsId);
    $result=$this->db->get()->result_array();
    return $result;
}
//new expenditure without receipt
public function newExpenseWithoutReceipt($expdetails)
{
    if($this->db->insert('expenditures',$expdetails))
        {
            return true;
        }
         else
            {
                return false;
            }
}
//new expenditure without receipt
public function newExpenseWithReceipt($expdetails)
{
    if($this->db->insert('expenditures',$expdetails))
        {
            return true;
        }
         else
            {
                return false;
            }
}
//  women tournaments
public function getWomenTournas($sportId)
{
    $this->db->select('g.*,team.team_alias');
    $this->db->from('games g');
    $this->db->join('teams team', 'g.game_team=team.team_auto_id AND team.team_category="Women"');
    $this->db->where('g.game_sport_auto_id',$sportId);
    $this->db->where('g.game_match_type',1);//tournament
    $this->db->order_by('g.game_start_date','desc');
    $result=$this->db->get()->result_array();
    return $result;
}
// Hockey women leagues
public function getScorpionLeagues($teamId)
{
    $this->db->select('g.*,team.team_alias');
    $this->db->from('games g');
    $this->db->join('teams team', 'g.game_team=team.team_auto_id');
    $this->db->where('g.game_sport_auto_id',$teamId);
    $this->db->where('g.game_team',2);//scorpions
    $this->db->where('g.game_match_type',2);//league
    $this->db->order_by('g.game_start_date','desc');
    $result=$this->db->get()->result_array();
    return $result;
}
// Hockey Men leagues
public function getGladiatorsLeagues($teamId)
{
    $this->db->select('g.*,team.*');
    $this->db->from('games g');
    $this->db->join('teams team', 'g.game_team=team.team_auto_id');
    $this->db->where('g.game_sport_auto_id',$teamId);
    $this->db->where('g.game_team',1);//gladiators
    $this->db->where('g.game_match_type',2);//league
    $this->db->order_by('g.game_start_date','desc');
    $result=$this->db->get()->result_array();
    return $result;
}
// men tournaments
public function getMenTournas($sportId)
{
    $this->db->select('g.*,team.*');
    $this->db->from('games g');
    $this->db->join('teams team', 'g.game_team=team.team_auto_id AND team.team_category="Men"');
    $this->db->where('g.game_sport_auto_id',$sportId);
    $this->db->where('g.game_match_type',1);//tournament
    $this->db->order_by('g.game_start_date','desc');
    $result=$this->db->get()->result_array();
    return $result;
}
//  game matches
public function gameMatches($gameId)
{
    $this->db->select('gs.*,team.team_alias');
    $this->db->from('game_matches gs');
    $this->db->join('games game','game.game_auto_id=gs.match_game_id');
    $this->db->join('teams team','game.game_team=team.team_auto_id');
    $this->db->where('gs.match_game_id',$gameId);
    $this->db->order_by('gs.match_date','desc');
    $this->db->order_by('gs.match_start_time','desc');
    // $this->db->limit(3);
    $result=$this->db->get()->result_array();
    return $result;
}
// gladiators tournaments
public function gladsTournas($teamId)
{
    $this->db->select('*');
    $this->db->from('hockey_matches');
    $this->db->where('hkm_team_auto_id',$teamId);
    $this->db->where('hkm_team_auto_id',$teamId);
    $this->db->where('hkm_category','Men');
    $this->db->order_by('hkm_start_date','desc');
    $result=$this->db->get()->result_array();
    return $result;
}
// Specific hockey matches
public function hockey_match($teamId,$hmsId)
{
    $this->db->select('*');
    $this->db->from(' hockey_matches');
    $this->db->where('hkm_team_auto_id',$teamId);
    $this->db->where('hkm_auto_id',$hmsId);
    $this->db->order_by('hkm_start_date','desc');
    // $this->db->order_by('hms.hkm_start_date desc');
    $result=$this->db->get()->result_array();
    return $result;
}
public function new_tournament($tournamentdetails)
{
    if($this->db->insert('games',$tournamentdetails))
        {
            return true;
        }else
            {
                return false;
            }
}
public function trainingAttendance($attendanceinfo=NULL)
{
    if($this->db->insert('training_attendance',$attendanceinfo))
        {
            return true;
        }else
            {
                return false;
            }
}
public function getPreScore($hmsId)
{
    $this->db->select('hkm_preliminary_scores');
    $this->db->from('hockey_matches');
    $this->db->where('hkm_auto_id',$hmsId);
    return $this->db->get()->result_array();
}
public function getQuarterScore($hmsId)
{
    $this->db->select('hkm_quarters');
    $this->db->from('hockey_matches');
    $this->db->where('hkm_auto_id',$hmsId);
    return $this->db->get()->result_array();
}
public function getSemiScore($hmsId)
{
    $this->db->select('hkm_semis');
    $this->db->from('hockey_matches');
    $this->db->where('hkm_auto_id',$hmsId);
    return $this->db->get()->result_array();
}
public function getFinalScore($hmsId)
{
    $this->db->select('hkm_finals');
    $this->db->from('hockey_matches');
    $this->db->where('hkm_auto_id',$hmsId);
    return $this->db->get()->result_array();
}
public function addhkscore($scoreArray,$hmsId)
{
   $this->db->where('hkm_auto_id',$hmsId);
        $this->db->update('hockey_matches',$scoreArray);
        $affected=$this->db->affected_rows();
         if($affected>0)
                {
                    return true;

                }else
                    {
                        return false;
                    }
}
//insert hockey tournament summary
public function new_hockey_summary($summarydetails,$hmsId)
{
    $this->db->where('hkm_auto_id',$hmsId);
        $this->db->update('hockey_matches',$summarydetails);
        $affected=$this->db->affected_rows();
         if($affected>0)
                {
                    return true;

                }else
                    {
                        return false;
                    }
}
//save new passport details
public function addPlayerPspt($passport_details)
{
    if($this->db->insert('travel_documents',$passport_details))
        {
            return true;
        }else
            {
                return false;
            }
}
//get passport details
public function getPassportDetails($passportId)
{
    $this->db->select('pls.*,td.*');
    $this->db->from('players pls');
    $this->db->join('travel_documents td','pls.player_auto_id=td.player_id','right');
    $this->db->where('td.passport_auto_id',$passportId);
    $result=$this->db->get()->result_array();
    return $result;
}
//update passport info when no new passport photo is uploaded
public function updatePassportNoPhoto($passport_details,$passportId)
{
    $this->db->where('passport_auto_id',$passportId);
    $this->db->update('travel_documents',$passport_details);
    $affected=$this->db->affected_rows();
     if($affected>0)
            {
                return true;

            }else
                {
                    return false;
                }

}
//update passport info when no new passport photo is uploaded. Includes deleting the previous passport image
public function updatePassport($passport_details,$passportId,$initFile)
{
        $this->db->where('passport_auto_id',$passportId);
        $this->db->update('travel_documents',$passport_details);
        unlink("uploads/travel_documents".$initFile);
        $affected=$this->db->affected_rows();
         if($affected>0)
                {
                    return true;

                }else
                    {
                        return false;
                    }
}
//dashboard counts

 //count macheo exams
public function activePlayersCount($sportId)
{
    $this->db->select('*');
    $this->db->from('players');
    $this->db->where('active_status',1);
    $this->db->where('player_sport_id',$sportId);
    $result=$this->db->get();
    if ( $result->num_rows() > 0 )
        {
            return $result->num_rows();
        }else
            {
                return 0;
            }
}
//get sport_specific reports
public function sportSpecificReports($sportId)
{
   $this->db->select('report.*,sport.sport_name');
    $this->db->from('coach_reports report');
    $this->db->join('sports sport', 'sport.sport_id=report.report_sport_id');
    $this->db->where('report.report_sport_id',$sportId);
    $this->db->where('report.specific_1_general_0',1);
    return $this->db->get()->result_array();
    // return $result;
}
//get sport_specific reports
public function sportGeneralReports()
{
   $this->db->select('report.*,sport.sport_name');
    $this->db->from('coach_reports report');
    $this->db->join('sports sport', 'sport.sport_id=report.report_sport_id');
    $this->db->where('report.specific_1_general_0',0);
    return $this->db->get()->result_array();
    // return $result;
}
// public function sportSpecificReports($sportId);
// {
    // $this->db->select('report.*,sport.sport_name');
    // $this->db->from('coach_reports report');
    // $this->db->join('sports sport', 'sport.sport_auto_id=report.report_sport_id');
    // $this->db->where('report.report_sport_id',$sportId);
    // return $this->db->get()->result_array();
// }
//get m
public function newCoachReport($report_details)
{

    if($this->db->insert('coach_reports',$report_details))
        {
            // $insert_id = $this->db->insert_id();
            return  true;
        }
         else
            {
                return false;
            }
}
public function activePlayersAndYFC($sportId)
{
    $this->db->select('pls.*,yfc.*');
    $this->db->from('players pls');
    $this->db->join('yellowfever_card yfc','pls.player_auto_id=yfc.player_auto_id','left');
    $this->db->where('pls.active_status',1);
    $this->db->where('pls.player_sport_id',$sportId);
    $result=$this->db->get()->result_array();
    return $result;
}
public function addPlayeryfc($yfc_details)
{
    if($this->db->insert('yellowfever_card',$yfc_details))
        {
            return true;
        }else
            {
                return false;
            }
}
public function getyfcDetails($passportId)
{
    $this->db->select('pls.*,yfc.*');
    $this->db->from('players pls');
    $this->db->join('yellowfever_card yfc','pls.player_auto_id=td.player_auto_id','right');
    $this->db->where('yfc.card_auto_id',$card_auto_id);
    $result=$this->db->get()->result_array();
    return $result;
}
public function updateyfcNoPhoto($card_details,$card_auto_id)
{
    $this->db->where('card_auto_id',$card_auto_id);
    $this->db->update('yellowfever_card',$card_details);
    $affected=$this->db->affected_rows();
     if($affected>0)
            {
                return true;

            }else
                {
                    return false;
                }

}
//update passport info when no new passport photo is uploaded. Includes deleting the previous passport image
public function updateyfc($card_details,$card_auto_id,$initFile)
{
        $this->db->where('card_auto_id',$card_auto_id);
        $this->db->update('yellowfever_card',$card_details);
        unlink("uploads/YFCard".$initFile);
        $affected=$this->db->affected_rows();
         if($affected>0)
                {
                    return true;

                }else
                    {
                        return false;
                    }
}

}//close Coachmodel