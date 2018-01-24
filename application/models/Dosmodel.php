<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Dosmodel extends CI_Model
{
function __construct()
{
     parent::__construct();
     $this->load->database();
}
//list of active teams
public function activeTeamsList()
{
    $this->db->select('*');
    $this->db->from('teams');
    $this->db->where('status',1);
    $result=$this->db->get()->result_array();
    return $result;
}

//list of all active coaches
public function activeCoachesList()
{
    $this->db->select('c.*,t.*');
    $this->db->from('coaches c');
    $this->db->join('teams t','c.team_id=t.team_id');
    $this->db->where('c.active_status',1);
    $result=$this->db->get()->result_array();
    return $result;
}
//list of all active captains
public function activeCaptainsList()
{
    $this->db->select('c.*, t.*, p.player_fname, p.player_lname,p.player_auto_id, p.kin_phone,p.kin_alt_phone, p.player_phone');
    $this->db->from('captains c, teams t');
    $this->db->join('players p','p.player_auto_id=c.player_auto_id');
    $this->db->where('c.player_team_id=t.team_id');
    $this->db->where('c.active_status',1);
    $result=$this->db->get()->result_array();
    return $result;
}
//list of all active physio therapists 
public function activePhytherasList()
{
    $this->db->select('*');
    $this->db->from('physio_therapists');
    $this->db->where('active_status',1);
    $result=$this->db->get()->result_array();
    return $result;
}
//coach profile
public function coachProfile($staffId)
{
    $this->db->select('c.*,t.*');
    $this->db->from('coaches c');
    $this->db->join('teams t','c.team_id=t.team_id');
    $this->db->where('c.coach_staff_id',$staffId);
    $result=$this->db->get()->result_array();
    return $result;
}
//coach update
public function updateCoach($coach_details,$staffId)
{
        $this->db->where('coach_staff_id',$staffId);
        $this->db->update('coaches',$coach_details);
        $affected=$this->db->affected_rows();
         if($affected>0)
                {
                    return true;

                }else
                    {
                        return false;
                    }
}
//captain profile view
public function captainProfile($playerId)
{
    $this->db->select('cap.*,t.*,players.*');
    $this->db->from('captains cap');
    $this->db->join('teams t','cap.player_team_id=t.team_id');
    $this->db->join('players players','cap.player_auto_id=players.player_auto_id');
    $this->db->where('cap.player_auto_id',$playerId);
    $result=$this->db->get()->result_array();
    return $result;
}
//captain profile update
public function updateCaptain($captain_details,$captainId)
{
    $this->db->where('player_auto_id',$captainId);
        $this->db->update('captains',$captain_details);
        $affected=$this->db->affected_rows();
         if($affected>0)
                {
                    return true;

                }else
                    {
                        return false;
                    }
}
//captain registration
public function newCaptain($captain_details)
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
//coach registration
public function newCoach($coach_details)
{
    if($this->db->insert('coaches',$coach_details))
        {
            return true;
        }else
            {
                return false;
            }
}
public function physiotherapistProfile($phythId)
{
    $this->db->select('*');
    $this->db->from('physio_therapists');
    $this->db->where('phyth_auto_id',$phythId);
    $result=$this->db->get()->result_array();
    return $result;
}

//injuries 
public function allInjuries()
{
    $this->db->select('ir.*,p.player_fname, p.player_lname,p.player_auto_id,p.player_other_names,t.team_category');
    $this->db->from('injury_records ir');
    $this->db->join('players p','p.player_auto_id=ir.player_auto_id');
    $this->db->join('teams t','p.team_id=t.team_id');
    $this->db->order_by('ir.injury_date','DESC');
    $result=$this->db->get()->result_array();
    return $result;
}
// all teams expenditures
public function allExpenses()
{
    $this->db->select('exs.*,t.team_category');
    $this->db->from('expenditures exs');
    $this->db->join('teams t','exs.expense_team_auto_id=t.team_id');
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
}