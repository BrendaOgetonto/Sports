<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class MainModel extends CI_Model
{
function __construct()
{
     parent::__construct();
     $this->load->database();
}




//player registration
public function new_player($player_details)
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

//player profile
public function player_profile($player_auto_id)
{
    $this->db->select('p.*,t.*');
    $this->db->from('players p,teams t');
    $this->db->where('p.player_auto_id',$player_auto_id);
    $this->db->where('p.team_id=t.team_id');
    $result=$this->db->get()->result_array();
    return $result;
}
//player profile update
public function update_player($player_details,$player_auto_id)
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

//list of active team players
public function active_players_list($teamId)
{
    $this->db->select('*');
    $this->db->from('players');
    $this->db->where('active_status',1);
    $this->db->where('team_id',$teamId);
    $result=$this->db->get()->result_array();
    return $result;
}
//list of all active  players
public function all_active_players_list()
{
    $this->db->select('*');
    $this->db->from('players');
    $this->db->where('active_status',1);
    $result=$this->db->get()->result_array();
    return $result;
}



//list of active teams
public function active_teams_list()
{
    $this->db->select('*');
    $this->db->from('teams');
    $this->db->where('status',1);
    $result=$this->db->get()->result_array();
    return $result;
}
//list of courses
public function courses_list()
{
    $this->db->select('*');
    $this->db->from('courses');
    $result=$this->db->get()->result_array();
    return $result;
}
//save training days
public function new_tr_days($tr_days_details)
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
public function tr_days_list($teamId)
{
    $this->db->select('trds.*');
    $this->db->from('training_days trds');
    $this->db->where('trds.trd_team_id',$teamId);
    $result=$this->db->get()->result_array();
    return $result;
}
//training days for per team
public function trd_list($trdId)
{
    $this->db->select('*');
    $this->db->from('training_days');
    $this->db->where('trd_auto_id',$trdId);
    $result=$this->db->get()->result_array();
    return $result;
}
//update training days
public function update_tr_days($tr_days_details,$trdId)
{
     $this->db->where('trd_auto_id',$trdId);
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
public function new_injury_record($injury_details)
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
public function injury_records()
{
    $this->db->select('ir.*, p.player_fname, p.player_lname,p.player_auto_id');
    $this->db->from('injury_records ir, players p');
    $this->db->where('ir.player_auto_id=p.player_auto_id');
    $result=$this->db->get()->result_array();
    return $result;
}
//individual injury record edit
public function injury_record($recordId)
{
    $this->db->select('ir.*, p.player_fname, p.player_lname,p.player_other_names,p.player_auto_id');
    $this->db->from('injury_records ir, players p');
    $this->db->where('ir.injury_auto_id',$recordId);
    $this->db->where('ir.player_auto_id=p.player_auto_id');
    $result=$this->db->get()->result_array();
    return $result;
}

//check if an injury record has a injury management record entered
public function hasIMR()
{
$this->db->select('ir.*');
$this->db->from('injury_records ir, injury_management im');
$this->db->where('ir.injury_auto_id=im.injury_record_id');
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
    $this->db->from('injury_records ir, players p');
    $this->db->where('ir.player_auto_id=p.player_auto_id');
    $this->db->where('ir.injury_auto_id',$recordId);
    $this->db->group_by('p.player_auto_id');
    $result=$this->db->get()->result_array();
    return $result;
}

//injury management records
public function injury_management_records($teamId)
{
    $this->db->select('ir.*, p.player_fname, p.player_lname,p.player_auto_id,p.player_other_names');
    $this->db->from('injury_records ir, players p,teams t');
    $this->db->where('ir.player_auto_id=p.player_auto_id');
    $this->db->where('p.team_id',$teamId);
    $this->db->group_by('ir.injury_auto_id');
    $result=$this->db->get()->result_array();
    return $result;
}
//injury management records
public function all_injury_management_records()
{
    $this->db->select('ir.*, p.player_fname, p.player_lname,p.player_auto_id,p.player_other_names,t.team_category');
    $this->db->from('injury_records ir, players p,teams t');
    $this->db->where('ir.player_auto_id=p.player_auto_id');
    $this->db->group_by('ir.injury_auto_id');
    $result=$this->db->get()->result_array();
    return $result;
}
//get specific injury management record
public function get_injury_record($injury_id)
{
    $this->db->select('ir.*, p.player_fname, p.player_lname,p.player_auto_id');
    $this->db->from('injury_records ir, players p');
    $this->db->where('ir.player_auto_id=p.player_auto_id');
    $this->db->where('ir.injury_auto_id',$injury_id);
    $result=$this->db->get()->result_array();
    return $result;
}

//new physio therapist
public function new_physio_therapist($phyth_details)
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
public function expenses_men($teamId)
    {
        $this->db->select('exs.*');
        $this->db->from('expenditures exs');
        $this->db->where('exs.expense_team_auto_id',$teamId);
        $this->db->where('exs.expense_category',"Men");
        $result=$this->db->get()->result_array();
        return $result;
    }
// expenditure per team (women)
public function expenses_women($teamId)
    {
        $this->db->select('exs.*');
        $this->db->from('expenditures exs');
        $this->db->where('exs.expense_team_auto_id',$teamId);
        $this->db->where('exs.expense_category',"Women");
        $result=$this->db->get()->result_array();
        return $result;
    }
// expenditure per team (mix)
public function expenses_mixed($teamId)
    {
        $this->db->select('exs.*');
        $this->db->from('expenditures exs');
        $this->db->where('exs.expense_team_auto_id',$teamId);
        $this->db->where('exs.expense_category',"Mixed");
        $result=$this->db->get()->result_array();
        return $result;
    }
//specific expense details 
public function expense_details($expsId)
{
    $this->db->select('exs.*');
    $this->db->from('expenditures exs');
    $this->db->where('exs.expense_auto_id',$expsId);
    $result=$this->db->get()->result_array();
    return $result;
}
//new expenditure
public function new_exp($expdetails)
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
// hockey matches
public function hockey_matches($teamId)
{
    $this->db->select('hms.*');
    $this->db->from('hockey_matches hms');
    $this->db->where('hms.hkm_team_auto_id',$teamId);
    $result=$this->db->get()->result_array();
    return $result;
}

// Specific hockey matches
public function hockey_match($teamId,$hmsId)
{
    $this->db->select('hms.*');
    $this->db->from('hockey_matches hms');
    $this->db->where('hms.hkm_team_auto_id',$teamId);
    $this->db->where('hms.hkm_auto_id',$hmsId);
    $result=$this->db->get()->result_array();
    return $result;
}
public function new_hockey_tournament($matchdetails)
{
    if($this->db->insert('hockey_matches',$matchdetails))
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
}