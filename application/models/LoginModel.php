<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class LoginModel extends CI_Model
{
	function __construct()
		{
		     parent::__construct();
		     $this->load->database();
		}

    //login sports manager
	public function validate_dos($username, $password) 
        {
            $this->db->select('*');
            $this->db->from('admin');
            $this->db->where('admin_username', $username);
            $this->db->where('password', $password);
            $this->db->where('active_status', 1);
            $this->db->limit(1);
            $query = $this->db->get();
             if ($query->num_rows() == 1) 
                {
                    return $query->result(); 

                } else 
                        {
                            return false;
                        }
        }
     //login coach
    public function validate_coach($username, $password) 
        {
            $this->db->select('cs.*,sports.*');
            $this->db->from('coaches cs');
            $this->db->join('sports sports','sports.sport_id=cs.coach_sport_id');
            $this->db->where('cs.coach_sport_id=sports.sport_id');
            $this->db->where('cs.password', $password);
            $this->db->where('cs.coach_username', $username);
            $this->db->where('cs.active_status', 1);
            $this->db->limit(1);
            $query = $this->db->get();
             if ($query->num_rows() == 1) 
                {
                    return $query->result(); 

                } else 
                        {
                            return false;
                        }
    }
    //login physio therapist
    public function validate_physiothera($username, $password) 
        {
            $this->db->select('*');
            $this->db->from('physio_therapists');
            $this->db->where('phyth_username', $username);
            $this->db->where('password', $password);
            $this->db->where('active_status', 1);
            $this->db->limit(1);
            $query = $this->db->get();
             if ($query->num_rows() == 1) 
                {
                    return $query->result(); 

                } else 
                        {
                            return false;
                        }
        }
}