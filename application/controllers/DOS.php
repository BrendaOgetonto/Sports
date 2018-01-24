<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*@author Mokoro Stephen 
*/
class DOS extends CI_Controller
{

function __construct()
{
     parent::__construct();
     $this->load->model('Dosmodel','dosmodel');
}

//load list of coaches page
public function coaches()
{
	$coaches_list['teams']=$this->dosmodel->activeTeamsList();
	$coaches_list['coaches']=$this->dosmodel->activeCoachesList();
	$this->load->view('admin/coach_registration',$coaches_list);
}
//captains view page
public function captains()
{
	$captains_list['teams']=$this->dosmodel->activeTeamsList();
	$captains_list['captains']=$this->dosmodel->activeCaptainsList();
	$this->load->view('admin/captain_registration',$captains_list);
}
//physio therapist page
public function physiotherapists()
{
	$phy_thera_list['phythes']=$this->dosmodel->activePhytherasList();
	$this->load->view('admin/physio_therapist_registration',$phy_thera_list);
}
//coach profile
public function coachprofile()
{
	$staffId=$this->input->post('staffId', TRUE);
	$coach_profile['coach_profile']=$this->dosmodel->coachProfile($staffId);
	$this->load->view('admin/coach_profile',$coach_profile);
}
//coach profile edit page
public function editcoach()
{
	$staffId=$this->input->post('staffId', TRUE);
	$coach_profile['teams']=$this->dosmodel->activeTeamsList();
	$coach_profile['coach_profile']=$this->dosmodel->coachProfile($staffId);
	$this->load->view('admin/edit_coach',$coach_profile);
}
//save updated coach profile info
public function updatecoach()
{
	//coach details
	$coach_nid=$this->input->post('nationalID', TRUE);
	$staffId=$this->input->post('staffID', TRUE);
	$first_name=$this->input->post('firstName', TRUE);
	$last_name=$this->input->post('lastName', TRUE);
	$other_names=$this->input->post('otherNames', TRUE);
	$phone_no=$this->input->post('phoneNumber', TRUE);
	$email=$this->input->post('emailAddress', TRUE);
	$residence=$this->input->post('currentResidence', TRUE);
	$coaching_before=$this->input->post('prevStatus', TRUE);
	$previous_team=$this->input->post('previousTeam', TRUE);
	$team_to_coach=$this->input->post('teamCoaching', TRUE);
	$coach_highest_achievement=$this->input->post('highestAchievement', TRUE);
	$coach_username=$this->input->post('userName', TRUE);
	$user_agreement=$this->input->post('agreement', TRUE);

	//create an array of the data to be inserted at once
	$coach_details = array('coach_fname'=>$first_name, 'coach_lname'=>$last_name, 'coach_other_names'=>$other_names,'coach_phone'=>$phone_no,'coach_email'=>$email, 'coach_residence'=>$residence,'prev_coaching_state'=>$coaching_before,'prev_team'=>$previous_team,'team_id'=>$team_to_coach, 'coach_h_achievement'=>$coach_highest_achievement,'coach_username'=>$coach_username,'user_agreement'=>$user_agreement);

	$result=$this->dosmodel->updateCoach($coach_details,$staffId);

	if($result)
		{
			$feedback = array('error' => "",'success' => "Coach updated");
			$this->session->set_flashdata('msg',$feedback);
           redirect(base_url(('dos/coaches')));
		}else 
			{
				$feedback = array('error' => "No changes made",'success' => "");
				$this->session->set_flashdata('msg',$feedback);
               redirect(base_url(('dos/coaches')));
			}

}
//Captain profile 
public function captainprofile()
{
	$player_profile['captains']=$this->dosmodel->captainProfile($this->input->post('playerId', TRUE));
	$this->load->view('admin/captain_profile',$player_profile);
}
//captain edit (edit captain : editcaptain)
public function editcaptain()
{
	$captain_profile['teams']=$this->dosmodel->activeTeamsList();
	$captain_profile['captain_profile']=$this->dosmodel->captainProfile($this->input->post('playerId', TRUE));
	$this->load->view('admin/edit_captain',$captain_profile);
}
//captain update
public function updatecaptain()
{
	$captainId=$this->input->post('playerId', TRUE);
	$player_team_id=$this->input->post('teamID', TRUE);
	$date_appointed=$this->input->post('dateAppointed', TRUE);
	$capt_before=$this->input->post('prevStatus', TRUE);
	$rules_agreement=$this->input->post('agreement', TRUE);

	$captain_details=array('player_team_id'=>$player_team_id, 'date_appointed'=>$date_appointed,'user_agreement'=>$rules_agreement,'capt_before'=>$capt_before);
	//check if the captain is registered as player in the selected team
		$this->db->select('*');
		$this->db->from('players pl');
		$this->db->where("`team_id` IN ($player_team_id)", NULL, FALSE);
		$query = $this->db->get();
        $num=$query->num_rows(); 
        if($num>0)
           {
				$result=$this->dosmodel->updateCaptain($captain_details,$captainId);
				if($result)
					{
						$feedback = array('error' => "",'success' => "Captain updated");
						$this->session->set_flashdata('msg',$feedback);
			           redirect(base_url(('dos/captains')));
					}else 
						{
							$feedback = array('error' => "No changes made",'success' => "");
							$this->session->set_flashdata('msg',$feedback);
			               redirect(base_url(('dos/captains')));
						}
			}else{
					$feedback = array('error' => "Not a member of the selected team",'success' => "");
					$this->session->set_flashdata('msg',$feedback);
			        redirect(base_url(('dos/captains')));
			}
}
//captain registration
public function newcaptain()
{
	$playerId=$this->input->post('playerId', TRUE);
	$player_team_id=$this->input->post('teamID', TRUE);
	$date_appointed=$this->input->post('dateAppointed', TRUE);
	$capt_before=$this->input->post('prevStatus', TRUE);
	$rules_agreement=$this->input->post('agreement', TRUE);

	$dateRegistered= date("Y-m-d"); 

	$captain_details=array('player_auto_id'=>$playerId,'player_team_id'=>$player_team_id, 'date_appointed'=>$date_appointed,'user_agreement'=>$rules_agreement,'capt_before'=>$capt_before,'date_registered'=>$dateRegistered);
	//check if the captain is a registered player 
	$this->db->select('*');
	$this->db->from('players');
	$this->db->where('player_auto_id',$playerId);
	$query = $this->db->get();
    $num=$query->num_rows(); 
    if($num>0)
    {
    	//check if the captain is registered as player in the selected team
		$this->db->select('*');
		$this->db->from('players pl');
		$this->db->where("`team_id` IN ($player_team_id)", NULL, FALSE);
		$query = $this->db->get();
        $num=$query->num_rows(); 
        if($num>0)
           {
            	//check if the captain is already registered
				$this->db->select('*');
				$this->db->from('captains');
				$this->db->where('player_auto_id',$playerId);
				$query = $this->db->get();
	            $num=$query->num_rows(); 
	            if($num>0)
	               {
						$feedback = array('error' => "Already registered",'success' => "");
						$this->session->set_flashdata('msg',$feedback);
			            redirect(base_url(('dos/captains')));
	        		}else
	                	{//If 
	                		$result=$this->dosmodel->newCaptain($captain_details);

							if($result)
								{
									$feedback = array('error' => "",'success' => "New captain registered");
									$this->session->set_flashdata('msg',$feedback);
				                   redirect(base_url(('dos/captains')));
								}else 
									{
										$feedback = array('error' => "Error",'success' => "");
										$this->session->set_flashdata('msg',$feedback);
					                   redirect(base_url(('dos/captains')));
									}	
	                	}
	        }else
		        {
		        	$feedback = array('error' => "Not a member of the selected team",'success' => "");
					$this->session->set_flashdata('msg',$feedback);
                   	redirect(base_url(('dos/captains')));
		        }
	}else{
			$feedback = array('error' => "Unregistered player",'success' => "");
			$this->session->set_flashdata('msg',$feedback);
			redirect(base_url(('dos/captains')));
		}
}
//new coach registration 
public function newcoach()
{
	//coach registration
	$coach_staff_id=$this->input->post('staffID', TRUE);
	$first_name=$this->input->post('firstName', TRUE);
	$last_name=$this->input->post('lastName', TRUE);
	$other_names=$this->input->post('otherNames', TRUE);
	$coach_nid=$this->input->post('nationalID', TRUE);
	$phone_no=$this->input->post('phoneNumber', TRUE);
	$email=$this->input->post('emailAddress', TRUE);
	$residence=$this->input->post('currentResidence', TRUE);
	$coaching_before=$this->input->post('prevStatus', TRUE);
	$previous_team=$this->input->post('previousTeam', TRUE);
	$team_to_coach=$this->input->post('teamCoaching', TRUE);
	$coach_highest_achievement=$this->input->post('highestAchievement', TRUE);
	$coach_username=$this->input->post('userName', TRUE);
	$user_agreement=$this->input->post('agreement', TRUE);
	$password=md5($coach_username.$coach_staff_id);
	$dateRegistered= date("Y-m-d"); 

	//create an array of the data to be inserted at once
	$coach_details = array('coach_staff_id' => $coach_staff_id, 'coach_fname'=>$first_name, 'coach_lname'=>$last_name, 'coach_other_names'=>$other_names,'coach_nid'=>$coach_nid,'coach_phone'=>$phone_no,'coach_email'=>$email, 'coach_residence'=>$residence,'prev_coaching_state'=>$coaching_before,'prev_team'=>$previous_team,'team_id'=>$team_to_coach, 'coach_h_achievement'=>$coach_highest_achievement,'coach_username'=>$coach_username,'user_agreement'=>$user_agreement,'date_registered'=>$dateRegistered,'password'=>$password);
	$this->db->select('*');
	$this->db->from('coaches');
	$this->db->where('coach_nid',$coach_nid);
	$this->db->or_where('coach_staff_id',$coach_staff_id);
	$query = $this->db->get();
    $num=$query->num_rows(); 
    if($num>0)
        {
        	$feedback = array('error' => "Duplicate National/Staff ID",'success' => "");
			$this->session->set_flashdata('msg',$feedback);
            redirect(base_url(('dos/coaches')));
        }else 
            {
            	$this->db->select('*');
				$this->db->from('coaches');
				$this->db->where('coach_username',$coach_username);
				$query = $this->db->get();
	            $num=$query->num_rows(); 
	            if($num>0)
		            {
		            	$feedback = array('error' => "Username already taken",'success' => "");
						$this->session->set_flashdata('msg',$feedback);
			            redirect(base_url(('dos/coaches')));
		            }else
		            	{
			            	$result=$this->dosmodel->newCoach($coach_details);

							if($result)
								{
									$feedback = array('error' => "",'success' => "New coach registered");
									$this->session->set_flashdata('msg',$feedback);
				                   redirect(base_url(('dos/coaches')));
								}else 
									{
										$feedback = array('error' => "Failed to register new coach",'success' => "");
										$this->session->set_flashdata('msg',$feedback);
					                   redirect(base_url(('dos/coaches')));
									}
            			}
           }

}
//physiotherapist profile
public function physioprofile()
{
	$phythId=$this->input->post('phythId', TRUE);
	$physio_profile['physio_profile']=$this->dosmodel->physiotherapistProfile($phythId);
	$this->load->view('admin/physiotherapist_profile',$physio_profile);
}

//all injuries 
public function allinjuries()
{
	$record['injuries']=$this->dosmodel->allInjuries();
	$this->load->view('admin/all_injuries',$record);
}
// All Teams Expenditure 
public function allexpenditures()
{
	$list['expenses']=$this->dosmodel->allExpenses();
	$this->load->view('admin/all_expenses',$list);
}
//dashboard page
public function dashboard()
{
	$this->load->view('admin/dashboard');
}
//expenditure more details
public function expenditureinfo()
{
	$expsId=$this->input->post('expsId',TRUE);
	$list['expenses']=$this->dosmodel->expenseDetails($expsId);
	$this->load->view('admin/expenditure_details',$list);
}

}
