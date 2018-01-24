<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class mc extends CI_Controller
{

function __construct()
{
     parent::__construct();
     $this->load->model('MainModel','mm');
}

public function index()
{
	$this->load->view('login');
}
//players view page
public function pls()
{
	$teamId=$this->session->userdata('coachTeamID');
	$list['players']=$this->mm->active_players_list($teamId);
	$list['teams']=$this->mm->active_teams_list();
	$list['courses']=$this->mm->courses_list();
	$this->load->view('coaches/plsreg',$list);
}
//players view page
public function players()
{
	$teamId=$this->session->userdata('coachTeamID');
	$list=$this->mm->active_players_list($teamId);
	$info=array();
    foreach ($list as $pls) 
        {   
            $info[]= '@'.$pls['player_fname']." ".$pls['player_lname'];
        }
    echo json_encode($info);
}
// public function seteam()
// {
// 	$this->session->unset_userdata('seteam');
// 	$sessdata=array();
//     $sessdata = array('seteam' =>$this->input->post('teamId',TRUE)); 
//     $this->session->set_userdata($sessdata);
// 	echo json_encode($this->session->userdata('seteam'));
// }
//get player for autocomplete in captain registration
public function getplayer()
{
		// $teamId=$this->session->userdata('seteam');
		// $keyword=$this->input->get("q");
		// $json = [];
		// if(!empty($this->input->get("q"))){
		// 	$this->db->or_like(array('player_fname' => $keyword, 'player_lname' => $keyword, 'player_other_names' => $keyword));
		// 	$this->db->select('player_auto_id as id,CONCAT(player_fname," ",player_lname) as text');
		// 	$this->db->where('team_id',1);
		// 	$this->db->limit(10);
		// 	$query=$this->db->get("players");
		// 	$json = $query->result();
		// }
		$keyword=$this->input->get("q");
		$json = [];
		if(!empty($this->input->get("q"))){
			$this->db->or_like(array('player_fname' => $keyword, 'player_lname' => $keyword, 'player_other_names' => $keyword));
			$this->db->select('player_auto_id as id,CONCAT(player_fname," ",player_lname) as text');
			$this->db->limit(10);
			$query=$this->db->get("players");
			$json = $query->result();
		}
		echo json_encode($json);
	
}
//dashboard view page for coach
public function coachdash()
{
	$teamId=$this->session->userdata('coachTeamID');
	$list['players']=$this->mm->active_players_list($teamId);
	$list['teams']=$this->mm->active_teams_list();
	$list['courses']=$this->mm->courses_list();

	if($teamId=='1')
	{
		//rugby coach nav 
		$sessdata = array('coachnav'=>"coaches/rugby/coachnav");
        $this->session->set_userdata($sessdata);
		$this->load->view('coaches/plsreg',$list);
	}else if($teamId=='2')
		{
			//volley coach nav 
			$sessdata = array('coachnav'=>"coaches/volleyball/coachnav");
	        $this->session->set_userdata($sessdata);
			$this->load->view('coaches/plsreg',$list);
		}else if($teamId=='3')
			{
				//basketball coach nav 
				$sessdata = array('coachnav'=>"coaches/basketball/coachnav");
		        $this->session->set_userdata($sessdata);
				$this->load->view('coaches/plsreg',$list);
			}else if($teamId=='4')
				{
					//soccer coach nav 
					$sessdata = array('coachnav'=>"coaches/soccer/coachnav");
			        $this->session->set_userdata($sessdata);
					$this->load->view('coaches/plsreg',$list);
				}else if($teamId=='5')
					{
						//hockey coach nav 
						$sessdata = array('coachnav'=>"coaches/hockey/coachnav");
				        $this->session->set_userdata($sessdata);
						$this->load->view('coaches/dashboard',$list);
					}else if($teamId=='6')
						{
							//handball coach nav 
							$sessdata = array('coachnav'=>"coaches/handball/coachnav");
					        $this->session->set_userdata($sessdata);
							$this->load->view('coaches/plsreg',$list);
						}else if($teamId=='7')
							{
								//karate coach nav 
								$sessdata = array('coachnav'=>"coaches/karate/coachnav");
						        $this->session->set_userdata($sessdata);
								$this->load->view('coaches/plsreg',$list);
							}else if($teamId=='8')
								{
									//swimming coach nav 
									$sessdata = array('coachnav'=>"coaches/swimming/coachnav");
							        $this->session->set_userdata($sessdata);
									$this->load->view('coaches/plsreg',$list);
								}else if($teamId=='9')
									{
										//rugby coach nav 
										$sessdata = array('coachnav'=>"coaches/archery/coachnav");
								        $this->session->set_userdata($sessdata);
										$this->load->view('coaches/plsreg',$list);
									}else if($teamId=='10')
										{
											//rugby coach nav 
											$sessdata = array('coachnav'=>"coaches/chess/coachnav");
									        $this->session->set_userdata($sessdata);
											$this->load->view('coaches/plsreg',$list);
										}else if($teamId=='11')
											{
												//rugby coach nav 
												$sessdata = array('coachnav'=>"coaches/scrabble/coachnav");
										        $this->session->set_userdata($sessdata);
												$this->load->view('coaches/plsreg',$list);
											}else if($teamId=='12')
												{
													//rugby coach nav 
													$sessdata = array('coachnav'=>"coaches/tennis/coachnav");
											        $this->session->set_userdata($sessdata);
													$this->load->view('coaches/plsreg',$list);
												}else if($teamId=='13')
													{
														//rugby coach nav 
														$sessdata = array('coachnav'=>"coaches/s&c/coachnav");
												        $this->session->set_userdata($sessdata);
														$this->load->view('coaches/plsreg',$list);
													}else 
														{
	                    									redirect('mc/index');
														}
}
//Player profile (more_about_player :map) for coach
public function map()
{
	$player_profile['player_profile']=$this->mm->player_profile($this->input->post('playerId', TRUE));
	$this->load->view('coaches/player_profile',$player_profile);
}

//Next of Kin Profile (more_about_kin :mak)
public function mak()
{
	$kin['nxtkin']=$this->mm->player_profile($this->input->post('playerId', TRUE));
	$this->load->view('coaches/nxt_kin',$kin);
}

//player profile update (edit player :ep_)
public function ep()
{
	$player_profile['courses']=$this->mm->courses_list();
	$player_profile['teams']=$this->mm->active_teams_list();
	$player_profile['player_profile']=$this->mm->player_profile($this->input->post('playerId', TRUE));
	$this->load->view('coaches/edit_player',$player_profile);
}

//training days page view
public function trds()
{
	$teamId=$this->session->userdata('coachTeamID');
	$training_days['tr_days']=$this->mm->tr_days_list($teamId);
	$this->load->view('coaches/training_days',$training_days);
}
//edit training days vpage view
public function etrd()
{
	$trdId=$this->input->post('trdId', TRUE);
	$training_days['tr_days']=$this->mm->trd_list($trdId);
	$this->load->view('coaches/edit_trds',$training_days);
}
//training attendance view
public function trat()
{
	$teamId=$this->session->userdata('coachTeamID');
	$players_list['players']=$this->mm->active_players_list($teamId);
	$this->load->view('coaches/training_attendance',$players_list);
}
//physio therapist injury management
public function injury_management()
{
	$record_id=$this->input->post('recordId', TRUE);
	$this->db->select('*');
	$this->db->from('injury_records');
	$this->db->where('diagnosis',NULL);
	$this->db->where('treatment',NULL);
	$this->db->where('physio_remarks',NULL);
	$this->db->where('injury_auto_id',$record_id);
	$result=$this->db->get();
	if($result->num_rows()>0)
	{
		$record['injured']=$this->mm->injuredPerson($record_id);
		// $record['injury_management']=$this->mm->injury_management_records();
		$this->load->view('phythera/injury_management',$record);
	}else 
		{
			$feedback = array('error'=>'','success'=>'','edit' => $record_id,'success' => "");
			$this->session->set_flashdata('msg',$feedback);
	        redirect(base_url(('mc/injury_record')));
		} 
}

//injury management page view for coach
public function cim()
{
	$teamId=$this->session->userdata('coachTeamID');
	$record['injuries']=$this->mm->injury_management_records($teamId);
	$this->load->view('coaches/injury_records',$record);
}

//injury management page view for coach
public function allinjuries()
{
	$record['injuries']=$this->mm->all_injury_management_records();
	$this->load->view('admin/injury_records',$record);
}
//injury record view
public function injury_record()
{
	$teamId=$this->session->userdata('coachTeamID');
	$record['players']=$this->mm->active_players_list($teamId);
	$record['injuries']=$this->mm->injury_records();//view entered records
	$this->load->view('phythera/injury_record',$record);
}

//edit injury record
public function eir()
{
	$recordId=$this->input->post('recordId', TRUE);
	$teamId=$this->session->userdata('coachTeamID');
	$record['players']=$this->mm->active_players_list($teamId);
	$record['record']=$this->mm->injury_record($recordId);
	$this->load->view('phythera/edit_irecord',$record);
}
//edit injury Management record
public function eimr()
{
	$recordId=$this->input->post('recordId', TRUE);
	$record['record']=$this->mm->injury_record($recordId);
	$this->load->view('phythera/edit_imr',$record);
}
//display more about injury for physio with ability to add IM Record if not added
// public function injury_more()
// {
// 	$recordId=$this->input->post('recordId', TRUE);
// 	$this->db->select('*');
// 	$this->db->from('injury_records');
// 	$this->db->where('diagnosis',NULL);
// 	$this->db->where('treatment',NULL);
// 	$this->db->where('physio_remarks',NULL);
// 	$this->db->where('injury_auto_id',$recordId);
// 	$result=$this->db->get();
// 	if($result->num_rows()>0)
// 	{
// 		$record['injury_record']=$this->mm->injury_record($recordId);
// 		$feedback = array('addIMRId'=>$recordId,'edit'=>'','error'=>"",'success'=>"");
// 		$this->session->set_flashdata('msg',$feedback);
// 		$this->load->view('phythera/injury_more',$record);
// 	}else{
// 		$record['injury_record']=$this->mm->injury_record($recordId);
// 		$feedback = array('addIMRId'=>"",'edit'=>'','error'=> "",'success'=>"");
// 		$this->session->set_flashdata('msg',$feedback);
// 		$this->load->view('phythera/injury_more',$record);
// 	}
// }

//more about injury record by physiotherapist
public function mai()
{
	$recordId=$this->input->post('recordId', TRUE);
	$this->db->select('*');
	$this->db->from('injury_records');
	$this->db->where('diagnosis',NULL);
	$this->db->where('treatment',NULL);
	$this->db->where('physio_remarks',NULL);
	$this->db->where('injury_auto_id',$recordId);
	$result=$this->db->get();
	if($result->num_rows()>0)
	{
		$record['recordID']=$recordId;
		$record['injury_record']=$this->mm->injury_record($recordId);
		$this->load->view('phythera/injury_more',$record);
	}else
	{
		$record['recordID']="";
		$record['injury_record']=$this->mm->injury_record($recordId);
		$this->load->view('phythera/injury_more',$record);
	}
}

//more about injury record by coach
public function cmai()
{
	$recordId=$this->input->post('recordId', TRUE);
	$this->db->select('*');
	$this->db->from('injury_records');
	$this->db->where('coach_remarks',NULL);
	$this->db->where('injury_auto_id',$recordId);
	$result=$this->db->get();
	if($result->num_rows()>0)
	{
		$record['recordID']=$recordId;
		$record['injury_record']=$this->mm->injury_record($recordId);
		$this->load->view('coaches/injury_more',$record);
	}else
	{
		$record['recordID']="";
		$record['injury_record']=$this->mm->injury_record($recordId);
		$this->load->view('coaches/injury_more',$record);
	}
	
}
//more about injury record by dean of students
public function injurydetails()
{
	$recordId=$this->input->post('recordId', TRUE);
	$this->db->select('*');
	$this->db->from('injury_records');
	$this->db->where('coach_remarks',NULL);
	$this->db->where('injury_auto_id',$recordId);
	$result=$this->db->get();
	if($result->num_rows()>0)
	{
		$record['recordID']=$recordId;
		$record['injury_record']=$this->mm->injury_record($recordId);
		$this->load->view('admin/injury_more',$record);
	}else
	{
		$record['recordID']="";
		$record['injury_record']=$this->mm->injury_record($recordId);
		$this->load->view('coaches/injury_more',$record);
	}
	
}
//more about injury record by dean of students
public function _injurydetails()
{
	$recordId=$this->input->post('recordId', TRUE);
	$this->db->select('*');
	$this->db->from('injury_records');
	$this->db->where('coach_remarks',NULL);
	$this->db->where('injury_auto_id',$recordId);
	$result=$this->db->get();
	if($result->num_rows()>0)
	{
		$record['recordID']=$recordId;
		$record['injury_record']=$this->mm->injury_record($recordId);
		$this->load->view('admin/injury_more',$record);
	}else
	{
		$record['recordID']="";
		$record['injury_record']=$this->mm->injury_record($recordId);
		$this->load->view('admin/injury_more',$record);
	}
	
}
//delete injury record
public function deleteIR()
{
	$recordId=$this->input->post('recordId', TRUE);
	$result=$this->mm->deleteIR($recordId);
	if($result)
		{
			$feedback = array('edit'=>'','error' => "",'success' => "Record deleted");
			$this->session->set_flashdata('msg',$feedback);
           redirect(base_url(('mc/injury_record')));
		}else 
			{
				$feedback = array('edit'=>'','error' => "Could not delete",'success' => "");
				$this->session->set_flashdata('msg',$feedback);
               redirect(base_url(('mc/injury_record')));
			}
}

//load coaches page 
public function coaches()
{
	$coaches_list['teams']=$this->mm->active_teams_list();
	$coaches_list['coaches']=$this->mm->active_coaches_list();
	$this->load->view('admin/coach_registration',$coaches_list);
}




//coach remarks view
public function crmks()
{
	//check if remark already added
	$this->db->select('physio_remarks');
	$this->db->from('injury_records');
	$this->db->where('injury_auto_id',$this->input->post('recordId', TRUE));
	$this->db->where('coach_remarks',NULL);
	$query=$this->db->get();
	$num=$query->num_rows(); 
    if($num>0)
        {
        	$record['injury_management']=$this->mm->get_injury_record($this->input->post('recordId', TRUE));
			$this->load->view('coaches/coach_remarks',$record);
        }else 
            {
            	$feedback = array('edit'=>'','error' => "Remarks exist. Please edit instead",'success' => "");
				$this->session->set_flashdata('msg',$feedback);
	            redirect(base_url(('mc/cim')));
            }
}

//edit coach remark view page
public function ecr()
{
	$recordId=$this->input->post('recordId', TRUE);

	//check if remark already added
	$this->db->select('physio_remarks');
	$this->db->from('injury_records');
	$this->db->where('injury_auto_id',$recordId);
	$this->db->where('coach_remarks',NULL);
	$query=$this->db->get();
	$num=$query->num_rows(); 
    if($num>0)
        {
        	$feedback = array('error'=>'','success'=>'','edit' => $recordId,'success' => "");
			$this->session->set_flashdata('msg',$feedback);
	        redirect(base_url(('mc/cim')));
			
		}else
			{
				$teamId=$this->session->userdata('coachTeamID');
				$record['players']=$this->mm->active_players_list($teamId);
				$record['injury_management']=$this->mm->injury_record($recordId);
				$this->load->view('coaches/edit_coach_remarks',$record);
			}
}
//new coach registration 
public function nc()
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
            redirect(base_url(('mc/coaches')));
        }else 
            {
            	$this->db->select('*');
				$this->db->from('coaches');
				$this->db->where('coach_username',$coach_username);
				$query = $this->db->get();
	            $num=$query->num_rows(); 
	            if($num>0)
		            {
		            	$feedback = array('error' => "Duplicate username",'success' => "");
						$this->session->set_flashdata('msg',$feedback);
			            redirect(base_url(('mc/coaches')));
		            }else
		            	{
					            	$result=$this->mm->new_coach($coach_details);

									if($result)
										{
											$feedback = array('error' => "",'success' => "New coach added");
											$this->session->set_flashdata('msg',$feedback);
						                   redirect(base_url(('mc/coaches')));
										}else 
											{
												$feedback = array('error' => "Registration failed",'success' => "");
												$this->session->set_flashdata('msg',$feedback);
							                   redirect(base_url(('mc/coaches')));
											}
            			}
           }

}


//player registration
public function np()
	{
		$student_id=$this->input->post('studentID', TRUE);
		$player_fname=$this->input->post('firstName', TRUE);
		$player_lname=$this->input->post('lastName', TRUE);
		$player_other_names=$this->input->post('otherNames', TRUE);
		$player_dob=$this->input->post('dateOfBirth', TRUE);
		$player_nid=$this->input->post('idNo', TRUE);
		$player_id_type=$this->input->post('idType', TRUE);
		$player_phone_no=$this->input->post('phoneNumber', TRUE);
		$player_email=$this->input->post('emailAddress', TRUE);
		$player_residence=$this->input->post('currentResidence', TRUE);
       
        $kin_other_names=$this->input->post('kinOtherNames', TRUE);
		$kin_fname=$this->input->post('kinFirstName', TRUE);
		$kin_lname=$this->input->post('kinLastName', TRUE);
		$kin_nid_no=$this->input->post('kinNationalID', TRUE);
        $kin_phone_no=$this->input->post('kinPhoneNumber', TRUE);
        $kin_alt_phone_no=$this->input->post('kinAltPhoneNumber', TRUE);
        $kin_email=$this->input->post('kinEmailAddress', TRUE);
        $kin_current_residence=$this->input->post('kinCurrentResidence', TRUE);
        $current_height=$this->input->post('currentHeight', TRUE);
        $current_weight=$this->input->post('currentWeight', TRUE);
        $prev_high_school=$this->input->post('previousHighSchool', TRUE);
        $prev_play_status=$this->input->post('prevStatus', TRUE);
        $prev_team=$this->input->post('previousTeam', TRUE);
        $team_joining_id=$this->input->post('teamID', TRUE);
        $highest_achievement=$this->input->post('highestAchievement', TRUE);
        $student_course_id=$this->input->post('course', TRUE);
        $agreement=$this->input->post('agreement',TRUE);
		$dateRegistered= date("Y-m-d"); 

		$player_details =array('stud_id'=>$student_id,'player_fname'=>$player_fname,'player_lname'=>$player_lname,'player_other_names'=>$player_other_names,'player_dob'=>$player_dob,'player_nid'=>$player_nid,'id_type'=>$player_id_type,'player_phone'=>$player_phone_no,'player_email'=>$player_email,'player_residence'=>$player_residence,'kin_fname'=>$kin_fname, 'kin_lname'=>$kin_lname, 'kin_other_names'=>$kin_other_names, 'kin_nid'=>$kin_nid_no, 'kin_phone'=>$kin_phone_no,'kin_alt_phone'=>$kin_alt_phone_no, 'kin_email'=>$kin_email, 'kin_residence'=>$kin_current_residence,'player_weight'=>$current_weight,'player_height'=>$current_height,'prev_hschool'=>$prev_high_school,'prev_play_state'=>$prev_play_status,'prev_team'=>$prev_team,'team_id'=>$team_joining_id,'h_achievement'=>$highest_achievement,'stud_course_id'=>$student_course_id,'agreement'=>$agreement,'date_registered'=>$dateRegistered);

		$this->db->select('*');
		$this->db->from('players');
		$this->db->where('player_nid',$player_id_no);
		$this->db->or_where('stud_id',$student_id);
		$query = $this->db->get();
        $num=$query->num_rows(); 
        if($num>0)
            {
            	$feedback = array('error' => "Already registered",'success' => "");
				$this->session->set_flashdata('msg',$feedback);
	            redirect(base_url(('mc/pls')));
            }else 
	            {
	            	$result=$this->mm->new_player($player_details);

					if($result)
						{
							$feedback = array('error' => "",'success' => "New player added");
							$this->session->set_flashdata('msg',$feedback);
		                   redirect(base_url(('mc/pls')));
						}else 
							{
								$feedback = array('error' => "Registration failed",'success' => "");
								$this->session->set_flashdata('msg',$feedback);
			                   redirect(base_url(('mc/pls')));
							}
	            }

}

//update player profile
public function upp()
	{
		$player_auto_id=$this->input->post('playerAutoId', TRUE);
		$student_id=$this->input->post('studentID', TRUE);
		$player_fname=$this->input->post('firstName', TRUE);
		$player_lname=$this->input->post('lastName', TRUE);
		$player_other_names=$this->input->post('otherNames', TRUE);
		$player_dob=$this->input->post('dateOfBirth', TRUE);
		$player_nid=$this->input->post('idNo', TRUE);
		$player_id_type=$this->input->post('idType', TRUE);
		$player_phone_no=$this->input->post('phoneNumber', TRUE);
		$player_email=$this->input->post('emailAddress', TRUE);
		$player_residence=$this->input->post('currentResidence', TRUE);
       
        $kin_other_names=$this->input->post('kinOtherNames', TRUE);
		$kin_fname=$this->input->post('kinFirstName', TRUE);
		$kin_lname=$this->input->post('kinLastName', TRUE);
		$kin_nid_no=$this->input->post('kinNationalID', TRUE);
        $kin_phone_no=$this->input->post('kinPhoneNumber', TRUE);
        $kin_alt_phone_no=$this->input->post('kinAltPhoneNumber', TRUE);
        $kin_email=$this->input->post('kinEmailAddress', TRUE);
        $kin_current_residence=$this->input->post('kinCurrentResidence', TRUE);
        $current_height=$this->input->post('currentHeight', TRUE);
        $current_weight=$this->input->post('currentWeight', TRUE);
        $prev_high_school=$this->input->post('previousHighSchool', TRUE);
        $prev_play_status=$this->input->post('prevStatus', TRUE);
        $prev_team=$this->input->post('previousTeam', TRUE);
        $highest_achievement=$this->input->post('highestAchievement', TRUE);
        $student_course_id=$this->input->post('course', TRUE);
        $agreement=$this->input->post('agreement',TRUE);

		$player_details =array('player_nid'=>$player_nid,'id_type'=>$player_id_type,'stud_id'=>$student_id,'player_fname'=>$player_fname,'player_lname'=>$player_lname,'player_other_names'=>$player_other_names,'player_dob'=>$player_dob,'player_phone'=>$player_phone_no,'player_email'=>$player_email,'player_residence'=>$player_residence,'kin_fname'=>$kin_fname, 'kin_lname'=>$kin_lname, 'kin_other_names'=>$kin_other_names, 'kin_nid'=>$kin_nid_no, 'kin_phone'=>$kin_phone_no,'kin_alt_phone'=>$kin_alt_phone_no, 'kin_email'=>$kin_email, 'kin_residence'=>$kin_current_residence,'player_weight'=>$current_weight,'player_height'=>$current_height,'prev_hschool'=>$prev_high_school,'prev_play_state'=>$prev_play_status,'prev_team'=>$prev_team,'h_achievement'=>$highest_achievement,'stud_course_id'=>$student_course_id,'agreement'=>$agreement);

	$result=$this->mm->update_player($player_details,$player_auto_id);
	if($result)
		{
			$feedback = array('error' => "",'success' => "Updated!");
			$this->session->set_flashdata('msg',$feedback);
           redirect(base_url(('mc/pls')));
		}else 
			{
				$feedback = array('error' => "No changes made",'success' => "");
				$this->session->set_flashdata('msg',$feedback);
               redirect(base_url(('mc/pls')));
			}

}

//disable Player
public function disablePlayer()
{
	$player_auto_id=$this->input->post('playerAutoId', TRUE);
	$reasonToDisable=$this->input->post('reasonToDisable', TRUE);
	$updateDetails=array('active_status'=>0, 'reason_inactive'=>$reasonToDisable);
	$result=$this->mm->disablePlayer($updateDetails,$player_auto_id);
	if($result)
		{
			$feedback = array('error' => "",'success' => "Player disabled!");
			$this->session->set_flashdata('msg',$feedback);
           redirect(base_url(('mc/pls')));
		}else 
			{
				$feedback = array('error' => "Failed to disable!",'success' => "");
				$this->session->set_flashdata('msg',$feedback);
               redirect(base_url(('mc/pls')));
			}
}




//save new training days
public function newtds()
{
   	$training_year=date("Y");
	$teamId=$this->session->userdata('coachTeamID');
	$january=$this->input->post('january', TRUE);
	$february=$this->input->post('february', TRUE);
	$march=$this->input->post('march', TRUE);
	$april=$this->input->post('april', TRUE);
	$may=$this->input->post('may', TRUE);
	$june=$this->input->post('june', TRUE);
	$july=$this->input->post('july', TRUE);
	$august=$this->input->post('august', TRUE);
	$september=$this->input->post('september', TRUE);
	$october=$this->input->post('october', TRUE);
	$november=$this->input->post('november', TRUE);
	$december=$this->input->post('december', TRUE);

	$tr_days_details=array('trd_year'=>$training_year,'trd_team_id'=>$teamId,'january'=>$january,'february'=>$february,'march'=>$march,'april'=>$april,'may'=>$may,'june'=>$june,'july'=>$july,'august'=>$august,'september'=>$september,'october'=>$october,'november'=>$november,'december'=>$december);
	//check if training days for the year already exists
	$this->db->select('*');
	$this->db->from('training_days');
	$this->db->where('trd_year',$training_year);
	$this->db->where('trd_team_id',$teamId);
	$query=$this->db->get();
	 $num=$query->num_rows(); 
    if($num>0)
       {
       		$feedback = array('error' => "Record  for ".$training_year." exists",'success' => "");
			$this->session->set_flashdata('msg',$feedback);
            redirect(base_url(('mc/trds')));
       }else
           	{
           		$result=$this->mm->new_tr_days($tr_days_details);

				if($result)
					{
						$feedback = array('error' => "",'success' => "New record added");
						$this->session->set_flashdata('msg',$feedback);
	                   redirect(base_url(('mc/trds')));
					}else 
						{
							$feedback = array('error' => "Failed to add",'success' => "");
							$this->session->set_flashdata('msg',$feedback);
		                   redirect(base_url(('mc/trds')));
						}
           	}

}

//update training days
public function utrdays()
{
	$training_year=$this->input->post('trainingYear', TRUE);
	$january=$this->input->post('january', TRUE);
	$february=$this->input->post('february', TRUE);
	$march=$this->input->post('march', TRUE);
	$april=$this->input->post('april', TRUE);
	$may=$this->input->post('may', TRUE);
	$june=$this->input->post('june', TRUE);
	$july=$this->input->post('july', TRUE);
	$august=$this->input->post('august', TRUE);
	$september=$this->input->post('september', TRUE);
	$october=$this->input->post('october', TRUE);
	$november=$this->input->post('november', TRUE);
	$december=$this->input->post('december', TRUE);

	$tr_days_details=array('january'=>$january,'february'=>$february,'march'=>$march,'april'=>$april,'may'=>$may,'june'=>$june,'july'=>$july,'august'=>$august,'september'=>$september,'october'=>$october,'november'=>$november,'december'=>$december);
	
		$result=$this->mm->update_tr_days($tr_days_details,$training_year);
	if($result)
		{
			$feedback = array('error' => "",'success' => "Updated!");
			$this->session->set_flashdata('msg',$feedback);
           redirect(base_url(('mc/trds')));
		}else 
			{
				$feedback = array('error' => "No changes made",'success' => "");
				$this->session->set_flashdata('msg',$feedback);
               redirect(base_url(('mc/trds')));
			}
}
public function new_tr_attendance()
{
	$data=$this->input->post('selected[]');/*attendance is submitted as a json array*/
   	$date_of_training=  $this->input->post('dateOfTraining');
   	$year_of_training=date("Y");

   foreach( $_POST as $posted )/*loop through and create an array of the data*/ 
       {
        if( is_array( $posted ) ) /*if is array created*/
            {
                foreach( $posted as $record ) /*loop through and get individual items*/
                    {
                        $attendanceinfo=array('training_date'=>$date_of_training,'player_nid'=>$record['player_nid'],'status'=>$record['status'],'training_year'=>$year_of_training);
                       		$result=$this->mm->new_tr_record();
                    }
                    if($result)
                    		{
        			
                                $message['successful'][]=  "Attendance Successfully Added";
                           
                                echo json_encode($message);//return success 
                            }else
                                {
                                    $message['error'][]=  "An error occurred";
                               
                                    echo json_encode($message);//return No changes made
                                }
			}
		}
}
//new injury recording
public function new_injury_record()
{
	$player_auto_id=$this->input->post('playerid', TRUE);
	$injury_date=$this->input->post('dateOfInjury', TRUE);
	$date_seen=$this->input->post('dateInHospital', TRUE);
	$injury_description=$this->input->post('injuryDescription', TRUE);
	$date_recorded= date("Y-m-d");

	$injury_details=array('player_auto_id'=>$player_auto_id,'injury_date'=>$injury_date,'date_seen'=>$date_seen,'injury_description'=>$injury_description,'date_recorded'=>$date_recorded);

	$result=$this->mm->new_injury_record($injury_details);
		if($result)
			{
				$feedback = array('edit'=>'','error' => "",'success' => "New record added");
				$this->session->set_flashdata('msg',$feedback);
               redirect(base_url(('mc/injury_record')));
			}else 
				{
					$feedback = array('edit'=>'','error' => "Failed to add record",'success' => "");
					$this->session->set_flashdata('msg',$feedback);
                   redirect(base_url(('mc/injury_record')));
				} 
}
//injury record updating
public function update_ir()
{
	$record_id=$this->input->post('recordId', TRUE);
	// $player_nid=$this->input->post('playerid', TRUE);
	$injury_date=$this->input->post('dateOfInjury', TRUE);
	$date_seen=$this->input->post('dateInHospital', TRUE);
	$injury_description=$this->input->post('injuryDescription', TRUE);

	$record_details=array('injury_date'=>$injury_date,'date_seen'=>$date_seen,'injury_description'=>$injury_description);

	$result=$this->mm->update_injury_record($record_details,$record_id);
		if($result)
			{
				$feedback = array('edit'=>'','error' => "",'success' => "Injury record updated");
				$this->session->set_flashdata('msg',$feedback);
               redirect(base_url(('mc/injury_record')));
			}else 
				{
					$feedback = array('edit'=>'','error' => "No changes made",'success' => "");
					$this->session->set_flashdata('msg',$feedback);
                   redirect(base_url(('mc/injury_record')));
				} 
}

//new injury management record
public function new_imr()
{

	$record_id=$this->input->post('recordId', TRUE);
	// $player_nid=$this->input->post('playerid', TRUE);
	$diagnosis=$this->input->post('diagnosis', TRUE);
	$treatment=$this->input->post('treatment', TRUE);
	$physioRemarks=$this->input->post('physioRemarks', TRUE);
	$date_recorded= date("Y-m-d");

	$im_details=array('diagnosis'=>$diagnosis,'treatment'=>$treatment,'physio_remarks'=>$physioRemarks,'date_recorded'=>$date_recorded);

	
		$result=$this->mm->new_im_record($im_details,$record_id);
			if($result)
				{
					$feedback = array('edit'=>'','error' => "",'success' => "IM record added");
					$this->session->set_flashdata('msg',$feedback);
                   redirect(base_url(('mc/injury_record')));
				}else 
					{
						$feedback = array('edit'=>'','error' => "Failed to add record",'success' => "");
						$this->session->set_flashdata('msg',$feedback);
	                   redirect(base_url(('mc/injury_record')));
					}
	
}
//injury management record updating
public function update_imr()
{
	$record_id=$this->input->post('recordId', TRUE);
	$diagnosis=$this->input->post('diagnosis', TRUE);
	$treatment=$this->input->post('treatment', TRUE);
	$physio_remarks=$this->input->post('physioRemarks', TRUE);

	$record_details=array('diagnosis'=>$diagnosis,'treatment'=>$treatment,'physio_remarks'=>$physio_remarks);

	$result=$this->mm->update_imr_record($record_details,$record_id);
		if($result)
			{
				$feedback = array('edit'=>'','error' => "",'success' => "IM record updated");
				$this->session->set_flashdata('msg',$feedback);
               redirect(base_url(('mc/injury_record')));
			}else 
				{
					$feedback = array('edit'=>'','error' => "No changes made",'success' => "");
					$this->session->set_flashdata('msg',$feedback);
                   redirect(base_url(('mc/injury_record')));
				} 
}

//coach remarks
public function new_remark()
{
	$record_id=$this->input->post('record_id', TRUE);
	$remarks = array('coach_remarks' => $this->input->post('coachRemarks', TRUE));
	$result=$this->mm->new_remarks($record_id,$remarks);
			if($result)
				{
					$feedback = array('error' => "",'success' => "New remark added",'edit'=>"");
					$this->session->set_flashdata('msg',$feedback);
                   redirect(base_url(('mc/cim')));
				}else 
					{
						$feedback = array('error' => "Failed to add remark",'success' => "",'edit'=>"");
						$this->session->set_flashdata('msg',$feedback);
	                   redirect(base_url(('mc/cim')));
					} 

}
//coach remarks
public function update_remark()
{
	$recordId=$this->input->post('recordId', TRUE);
	$remarks = array('coach_remarks' => $this->input->post('coachRemarks', TRUE));
	$result=$this->mm->update_remarks($recordId,$remarks);
			if($result)
				{
					$feedback = array('error' => "",'success' => "Remark updated",'edit'=>'');
					$this->session->set_flashdata('msg',$feedback);
                   redirect(base_url(('mc/cim')));
				}else 
					{
						$feedback = array('error' => "Failed to update",'success' => "",'edit'=>'');
						$this->session->set_flashdata('msg',$feedback);
	                   redirect(base_url(('mc/cim')));
					} 

}
//delete coach remark
public function deleteRemark()
{
	$recordId=$this->input->post('recordId', TRUE);
	$remarks = array('coach_remarks' => NULL);
	$result=$this->mm->deleteRemark($recordId,$remarks);
	if($result)
		{
			$feedback = array('edit'=>'','error' => "",'success' => "Remark deleted");
			$this->session->set_flashdata('msg',$feedback);
           redirect(base_url(('mc/cim')));
		}else 
			{
				$feedback = array('edit'=>'','error' => "Could not delete",'success' => "");
				$this->session->set_flashdata('msg',$feedback);
               redirect(base_url(('mc/cim')));
			}
}
//Physio therapist registration 
public function newtherapist()
{
	$phyth_staff_id=$this->input->post('staffID', TRUE);
	$first_name=$this->input->post('firstName', TRUE);
	$last_name=$this->input->post('lastName', TRUE);
	$other_names=$this->input->post('otherNames', TRUE);
	$phyth_nid=$this->input->post('nationalID', TRUE);
	$phone_no=$this->input->post('phoneNumber', TRUE);
	$email=$this->input->post('emailAddress', TRUE);
	$residence=$this->input->post('currentResidence', TRUE);
	$phyth_username=$this->input->post('userName', TRUE);
	$user_agreement=$this->input->post('agreement', TRUE);
	$password=md5($phyth_username.$phyth_staff_id);
	$dateRegistered= date("Y-m-d"); 

	//create an array of the data to be inserted at once
	$phyth_details = array('phyth_staff_id' => $phyth_staff_id, 'phyth_fname'=>$first_name, 'phyth_lname'=>$last_name, 'phyth_other_names'=>$other_names,'phyth_nid'=>$phyth_nid,'phyth_phone'=>$phone_no,'phyth_email'=>$email, 'phyth_residence'=>$residence,'phyth_username'=>$phyth_username,'user_agreement'=>$user_agreement,'date_registered'=>$dateRegistered,'password'=>$password);


	$this->db->select('*');
	$this->db->from('physio_therapists');
	$this->db->where('phyth_nid',$phyth_nid);
	$this->db->or_where('phyth_staff_id',$phyth_staff_id);
	$query = $this->db->get();
    $num=$query->num_rows(); 
    if($num>0)
        {
        	$feedback = array('error' => "Duplicate National/Staff ID",'success' => "");
			$this->session->set_flashdata('msg',$feedback);
            redirect(base_url(('mc/physiotherapists')));
        }else 
            {
            	$this->db->select('*');
				$this->db->from('physio_therapists');
				$this->db->where('phyth_username',$phyth_username);
				$query = $this->db->get();
	            $num=$query->num_rows(); 
	            if($num>0)
		            {
		            	$feedback = array('error' => "Duplicate username",'success' => "");
						$this->session->set_flashdata('msg',$feedback);
			            redirect(base_url(('mc/physiotherapists')));
		            }else
		            	{
					            	$result=$this->mm->new_physio_therapist($phyth_details);

									if($result)
										{
											$feedback = array('error' => "",'success' => "New physiotherapist added");
											$this->session->set_flashdata('msg',$feedback);
						                   redirect(base_url(('mc/physiotherapists')));
										}else 
											{
												$feedback = array('error' => "Registration failed",'success' => "");
												$this->session->set_flashdata('msg',$feedback);
							                   redirect(base_url(('mc/physiotherapists')));
											}
            			}
           }

}



public function tratt()/*function to save attendance for a given meeting*/
{
	if(!$this->session->userdata('clubhead_login'))
        {
            $data = array('profile'=>$this->mainmodel->clubProfile());
            $this->load->view('login',$data);
        }else
            {
                 $data=$this->input->post('selected[]');/*attendance is submitted as a json array*/
                 $meeting=  $this->input->post('meetingid');
                 ;
                $clubid=$this->session->userdata('clubEmail');
                $dateRecorded = date("Y-m-d H:i:s"); 
                     //check if required fields are empty
                if ( $clubid=="" || $meeting=="" ||$data==NULL )
                    {
                        $message['null'][]=  "Null entry";// message if required field is empty
                                           
                        echo json_encode($message);//return null message
                    }else
                        {/*check if the attendance for the meeting has already been added*/
                                $this->db->select('*');
                                $this->db->from('meetingattendance');
                                $this->db->where('meetingID',$meeting);
                                $this->db->where('clubID',$clubid);
                                $query = $this->db->get();
                                $num=$query->num_rows(); 
                        if($num >0 )
                            {/*message if attendance already exists*/
                                $message['alreadyadded'][]=  "Attendance for this meeting has already been added";
                                echo json_encode($message);//return fail 
                            } else
                                {
                                   foreach( $_POST as $posted )/*loop through and create an array of the data*/ 
                                       {
                                        if( is_array( $posted ) ) /*if is array created*/
                                            {
                                                foreach( $posted as $record ) /*loop through and get individual items*/
                                                    {
                                                        $attendanceinfo=array('clubID'=>$clubid,'meetingID'=>$meeting,'studentID'=>$record['studentID'],'pID'=>$record['pID'],'status'=>$record['status'],'dateRecorded'=>$dateRecorded);

                                                        //pass array of data to model for saving
                                                        $result=$this->model->meetingattendanceinfosave($attendanceinfo);
                                                    }
                                                    if ($result) 
                                                                    {
                                                                        $message['successful'][]=  "Attendance Successfully Added";
                                                                   
                                                                        echo json_encode($message);//return success 
                                                                    }else
                                                                        {
                                                                            $message['error'][]=  "An error occurred";
                                                                       
                                                                            echo json_encode($message);//return No changes made
                                                                        }
                                            } else 
                                                {
                                                    $message['notarray'][]=  "No array was posted";
                                                }
                                        }
                                }
                
                    }
        }

}

// Team Expenditure Men (Coach view)
public function cexm()
{
	$teamId=$this->session->userdata('coachTeamID');
	$list['expenses']=$this->mm->expenses_men($teamId);
	$this->load->view('coaches/expemen',$list);
}
// Team Expenditure Women (Coach view)
public function cexf()
{
	$teamId=$this->session->userdata('coachTeamID');
	$list['expenses']=$this->mm->expenses_women($teamId);
	$this->load->view('coaches/expewomen',$list);
}
// Team Expenditure Both Men & Women (Coach view)
public function cexmix()
{
	$teamId=$this->session->userdata('coachTeamID');
	$list['expenses']=$this->mm->expenses_mixed($teamId);
	$this->load->view('coaches/expemix',$list);
}
//more about team expenditure
public function expmore()
{
	$expsId=$this->input->post('expsId',TRUE);
	$list['expenses']=$this->mm->expense_details($expsId);
	$this->load->view('coaches/expemore',$list);
}
//record new expenditure for men
public function nmexp()
{

	$teamId=$this->session->userdata('coachTeamID');
	$category=$this->input->post('category', TRUE);
	$exDate=$this->input->post('exDate', TRUE);
	$cash=$this->input->post('cash', TRUE);
	$lpoNo=$this->input->post('lpoNo', TRUE);
	$lpo=$this->input->post('lpo', TRUE);
	$lunches=$this->input->post('lunches', TRUE);
	$comments=$this->input->post('comments', TRUE);
	$date_recorded= date("Y-m-d H:i:s");

	$expdetails=array('expense_team_auto_id'=>$teamId,'expense_category'=>$category,'expense_date'=>$exDate,'expense_cash'=>$cash,'expense_lpo_no'=>$lpoNo,'expense_lpo_amount'=>$lpo,'expense_lunches'=>$lunches,'expense_comment'=>$comments,'	expense_record_date'=>$date_recorded);

		$result=$this->mm->new_exp($expdetails);
			if($result)
				{
					$feedback = array('edit'=>'','error' => "",'success' => "Expense added successfully");
					$this->session->set_flashdata('msg',$feedback);
                   redirect(base_url(('mc/cexm')));
				}else 
					{
						$feedback = array('edit'=>'','error' => "Failed to add expense",'success' => "");
						$this->session->set_flashdata('msg',$feedback);
	                   redirect(base_url(('mc/cexm')));
					}
	
}
//record new expenditure for men
public function nwexp()
{

	$teamId=$this->session->userdata('coachTeamID');
	$category=$this->input->post('category', TRUE);
	$exDate=$this->input->post('exDate', TRUE);
	$cash=$this->input->post('cash', TRUE);
	$lpoNo=$this->input->post('lpoNo', TRUE);
	$lpo=$this->input->post('lpo', TRUE);
	$lunches=$this->input->post('lunches', TRUE);
	$comments=$this->input->post('comments', TRUE);
	$date_recorded= date("Y-m-d H:i:s");

	$expdetails=array('expense_team_auto_id'=>$teamId,'expense_category'=>$category,'expense_date'=>$exDate,'expense_cash'=>$cash,'expense_lpo_no'=>$lpoNo,'expense_lpo_amount'=>$lpo,'expense_lunches'=>$lunches,'expense_comment'=>$comments,'expense_record_date'=>$date_recorded);

		$result=$this->mm->new_exp($expdetails);
			if($result)
				{
					$feedback = array('edit'=>'','error' => "",'success' => "Expense added successfully");
					$this->session->set_flashdata('msg',$feedback);
                   redirect(base_url(('mc/cexf')));
				}else 
					{
						$feedback = array('edit'=>'','error' => "Failed to add expense",'success' => "");
						$this->session->set_flashdata('msg',$feedback);
	                   redirect(base_url(('mc/cexf')));
					}
	
}
//load hockey tournaments page
public function htourn()
{
	$teamId=$this->session->userdata('coachTeamID');
	$list['hmatches']=$this->mm->hockey_matches($teamId);
	$this->load->view('coaches/hockey/hockey_matches',$list);
}

//More about hockey match
public function hkmore()
{
	$hmsId=$this->input->post('hmsId',TRUE);
	$teamId=$this->session->userdata('coachTeamID');
	$list['hmatches']=$this->mm->hockey_match($teamId,$hmsId);
	$this->load->view('coaches/hockey/hockey_match_more',$list);
}
//record new hockey match 
public function newht()
{
	$teamId=$this->session->userdata('coachTeamID');
	$matchTitle=$this->input->post('matchTitle',TRUE);
	$venue=$this->input->post('venue',TRUE);
	$startDate=$this->input->post('startDate',TRUE);
	$endDate=$this->input->post('endDate',TRUE);
	$category=$this->input->post('category',TRUE);
	$opponents=$this->input->post('opponents',TRUE);

	$matchdetails=array('hkm_team_auto_id'=>$teamId,'hkm_category'=>$category,'hkm_match_type'=>'1','hkm_title'=>$matchTitle,'hkm_opponents'=>$opponents,'hkm_venue'=>$venue,'hkm_start_date'=>$startDate,'hkm_end_date'=>$startDate);

		$result=$this->mm->new_hockey_tournament($matchdetails);
			if($result)
				{
					$feedback = array('edit'=>'','error' => "",'success' => "Tournament added successfully");
					$this->session->set_flashdata('msg',$feedback);
                   redirect(base_url(('mc/htourn')));
				}else 
					{
						$feedback = array('edit'=>'','error' => "Failed to add tournament",'success' => "");
						$this->session->set_flashdata('msg',$feedback);
	                   redirect(base_url(('mc/htourn')));
					}
}
//new hockey  match score input page
public function hknsc()
{
	$hmsId=$this->input->post('hmsId',TRUE);
	$teamId=$this->session->userdata('coachTeamID');
	$list['hmatches']=$this->mm->hockey_match($teamId,$hmsId);
	$this->load->view('coaches/hockey/tournament_score',$list);
}

//saving new hockey score
public function addhkscore()
{
	$hmsId=$this->input->post('hmsId',TRUE);
	$actualScore=$this->input->post('actualScore',TRUE);
	
	// used to tell which column to update
	$scoreLevel=$this->input->post('scoreLevel',TRUE);
	
	if($scoreLevel=='1')
	{
		$scoreArray=array('hkm_preliminary_scores'=>$actualScore);
		$result=$this->mm->addhkscore($scoreArray,$hmsId);
			if($result)
				{
					$feedback = array('edit'=>'','error' => "",'success' => "Preliminary scores added successfully");
					$this->session->set_flashdata('msg',$feedback);
                   redirect(base_url(('mc/htourn')));
				}else 
					{
						$feedback = array('edit'=>'','error' => "You did not add new scores",'success' => "");
						$this->session->set_flashdata('msg',$feedback);
	                   redirect(base_url(('mc/htourn')));
					}

	}else if($scoreLevel=='2')
		{
			$scoreArray=array('hkm_quarters'=>$actualScore);
			$result=$this->mm->addhkscore($scoreArray,$hmsId);
			if($result)
				{
					$feedback = array('edit'=>'','error' => "",'success' => "Quarter scores added successfully");
					$this->session->set_flashdata('msg',$feedback);
                   redirect(base_url(('mc/htourn')));
				}else 
					{
						$feedback = array('edit'=>'','error' => "You did not add new scores",'success' => "");
						$this->session->set_flashdata('msg',$feedback);
	                   redirect(base_url(('mc/htourn')));
					}
		}else if($scoreLevel=='3')
			{
				$scoreArray=array('hkm_semis'=>$actualScore);
				$result=$this->mm->addhkscore($scoreArray,$hmsId);
				if($result)
					{
						$feedback = array('edit'=>'','error' => "",'success' => "Semi-finals scores added successfully");
						$this->session->set_flashdata('msg',$feedback);
	                   redirect(base_url(('mc/htourn')));
					}else 
						{
							$feedback = array('edit'=>'','error' => "You did not add new scores",'success' => "");
							$this->session->set_flashdata('msg',$feedback);
		                   redirect(base_url(('mc/htourn')));
						}
			}else if($scoreLevel=='4')
				{
					$scoreArray=array('hkm_finals'=>$actualScore);
					$result=$this->mm->addhkscore($scoreArray,$hmsId);
					if($result)
						{
							$feedback = array('edit'=>'','error' => "",'success' => "Finals scores added successfully");
							$this->session->set_flashdata('msg',$feedback);
		                   redirect(base_url(('mc/htourn')));
						}else 
							{
								$feedback = array('edit'=>'','error' => "You did not add new scores",'success' => "");
								$this->session->set_flashdata('msg',$feedback);
			                   redirect(base_url(('mc/htourn')));
							}
				}else{
							$feedback = array('edit'=>'','error' => "An error occurred. Please try again",'success' => "");
							$this->session->set_flashdata('msg',$feedback);
	                   		redirect(base_url(('mc/htourn')));
	                 }


}
//get score for update
public function getScore()
{
	$hmsId=$this->input->post('hmsid');
	$scoreLevelId=$this->input->post('scorelevelid');
	$info=array();
	if($scoreLevelId=='1')
		{
			$data =$this->mm->getPreScore($hmsId);
			foreach ($data as $dat) 
		        {
		            $info= array('score'=>$dat['hkm_preliminary_scores']); 
		        }
    		echo json_encode($info);
		}else if($scoreLevelId=='2')
			{
				$data =$this->mm->getQuarterScore($hmsId);
				foreach ($data as $dat) 
			        {
			            $info= array('score'=>$dat['hkm_quarters']); 
			        }
    			echo json_encode($info);
			}else if($scoreLevelId=='3')
				{
					$data =$this->mm->getSemiScore($hmsId);
					foreach ($data as $dat) 
				        {
				            $info= array('score'=>$dat['hkm_semis']); 
				        }
	    			echo json_encode($info);
				}else if($scoreLevelId=='4')
					{
						$data =$this->mm->getFinalScore($hmsId);
						foreach ($data as $dat) 
					        {
					            $info= array('score'=>$dat['hkm_finals']); 
					        }
		    			echo json_encode($info);
					}else if($scoreLevelId==''){
								$info= array('score'=>"");
								echo json_encode($info);
							}
}

       
//load page to add hockey game summary
public function hksummary()
{
	$hmsId=$this->input->post('hmsId',TRUE);
	$teamId=$this->session->userdata('coachTeamID');
	$list['hmatches']=$this->mm->hockey_match($teamId,$hmsId);
	$this->load->view('coaches/hockey/hockey_summary',$list);

	// $scorers=$this->input->post('scorers',TRUE);
	// $refComments=$this->input->post('refComments',TRUE);
	// $summary=$this->input->post('summary',TRUE);
}
public function addhksummary()
{
	$hmsId=$this->input->post('hmsId',TRUE);
	$scorers=str_replace("@","",$this->input->post('scorers',TRUE));
	$refComments=$this->input->post('refComments',TRUE);
	$summary=$this->input->post('summary',TRUE);

	$summarydetails=array('hkm_scorers'=>$scorers,'hkm_ref_comments'=>$refComments,'hkm_summary'=>$summary);

		$result=$this->mm->new_hockey_summary($summarydetails,$hmsId);
			if($result)
				{
					$feedback = array('edit'=>'','error' => "",'success' => "Tournament summary added successfully");
					$this->session->set_flashdata('msg',$feedback);
                   redirect(base_url(('mc/htourn')));
				}else 
					{
						$feedback = array('edit'=>'','error' => "Failed to add tournament",'success' => "");
						$this->session->set_flashdata('msg',$feedback);
	                   redirect(base_url(('mc/htourn')));
					}
}

//load page to add hockey league
public function addhkleague()
{
	$this->load->view('coaches/hockey/hockey_league');
}

public function newTraining()
{
	$data=$this->input->post('selected[]');
	$dateOfTraining = date("Y-m-d");//today's date
	$yearOfTraining = date("Y");//current year 
	$teamId=$this->session->userdata('coachTeamID');

	if ($data=="" )
        {
            $message['null'][]=  "Null entry";
            echo json_encode($message);
        }else{
        			//check if attendance has been added for the day
				$this->db->select('*');
				$this->db->from('training_attendance');
				$this->db->where('training_date',$dateOfTraining);
				$this->db->where('training_year',$yearOfTraining);
				$result=$this->db->get();

				if($result->num_rows()>0)
				{
					$message['exists'][]=  "Attendance for today has been added";
			            echo json_encode($message);
				}else {

			               	foreach($_POST as $posted )/*loop through and create an array of the data*/ 
			                   {
			                    if(is_array( $posted ) ) /*if is array created*/
			                        {
			                            foreach( $posted as $record ) /*loop through and get individual items*/
			                                {
			                                    $attendanceinfo=array('training_date'=>$dateOfTraining,'training_year'=>$yearOfTraining,'team_id'=>$teamId,'player_auto_id'=>$record['playerPID'],'attendance_state'=>$record['status']);
			                                    $result=$this->mm->trainingAttendance($attendanceinfo);
			                                }
			                                if ($result) 
			                                    {
			                                        $message['successful'][]=  "Attendance Successfully Added";
			                                   
			                                        echo json_encode($message);//return success 
			                                    }else
			                                        {
			                                            $message['error'][]=  "An error occurred";
			                                       
			                                            echo json_encode($message);//return No changes made
			                                        }
			                        } else 
			                            {
			                                $message['notarray'][]=  "No array was posted";
			                                echo json_encode($message);//return No changes made

			                            }
			                    }
			            }
            }
}



	//coach remarks view
	public function crmks_view()
		{
			//check if remark already added
			$this->db->select('physio_remarks');
			$this->db->from('injury_management');
			$this->db->where('auto_id',$this->input->get('injmid', TRUE));
			$this->db->where('coach_remarks',NULL);
			$query=$this->db->get();
			$num=$query->num_rows(); 
            if($num>0)
	            {
	            	$record['injury_management']=$this->mm->get_injury_record($this->input->get('injmid', TRUE));
					$this->load->view('coaches/coach_remarks',$record);
	            }else 
		            {
		            	$feedback = array('error' => "Remarks exist. Please edit instead",'success' => "");
						$this->session->set_flashdata('msg',$feedback);
			            redirect(base_url(('MC/cim_view')));
		            }
		}
}
