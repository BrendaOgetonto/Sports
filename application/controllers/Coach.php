<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
*@author Mokoro Stephen 
*/
class Coach extends CI_Controller
{

	function __construct()
	{
	     parent::__construct();
	     $this->load->model('Coachmodel','coachmodel');
	}

	public function index()
	{
		$this->load->view('login');
	}
	public function logout()
	{
		$array_items=array('coachName','coachId','coach_login','coachSportID','coachSportName'); 
	 	$this->session->unset_userdata($array_items);
		$this->load->view('login');
	}


	//players view page
	public function players()
	{
		if($this->session->userdata('coach_login'))
		{
			$sportId=$this->session->userdata('coachSportID');
			$list['players']=$this->coachmodel->activePlayersList($sportId);
			$list['teams']=$this->coachmodel->activeTeamsListPerSport($sportId);
			$list['courses']=$this->coachmodel->coursesList();
			$this->load->view('coaches/playerreg',$list);
		}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
	}
//player passports view page
public function playerpassports()
{
	if($this->session->userdata('coach_login'))
	{
		$sportId=$this->session->userdata('coachSportID');
		$list['players']=$this->coachmodel->activePlayersAndPassports($sportId);
		$this->load->view('coaches/playerpassports',$list);
	}else{
			$feedback = array('error' => "Your session has expired. Login to proceed.");
			$this->session->set_flashdata('msg',$feedback);
		    	redirect(base_url(('coach')));
	}
}
//load new player passport adding page
public function addplayerpspt()
{
	if($this->session->userdata('coach_login'))
	{
		$sportId=$this->session->userdata('coachSportID');
		$playerId=$this->input->post('playerId',TRUE);
		$playerName=$this->input->post('playerName',TRUE);

		if(isset ($playerId) && strlen($playerId) && isset($playerName) && strlen($playerName)){
			$sessdata = array('pst_player_id'=>$playerId,'pst_player_name'=>$playerName);
			$this->session->set_userdata($sessdata);
			$this->load->view('coaches/addplayerpassport');
		}else{
				$this->load->view('coaches/addplayerpassport');
		}
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
		    redirect(base_url(('coach')));
		}
}
//load player passport editing page
public function editplayerpspt()
{
	if($this->session->userdata('coach_login'))
	{
		$passportId=$this->input->post('passportId',TRUE);
		$playerName=$this->input->post('playerName',TRUE);

		if(isset ($passportId) && strlen($passportId) && isset($playerName) && strlen($playerName))
		{
			$sessdata = array('pst_player_id'=>$passportId,'pst_player_name'=>$playerName);
			$this->session->set_userdata($sessdata);

			$list['passport_details']=$this->coachmodel->getPassportDetails($passportId);

			$this->load->view('coaches/edit_passport',$list);
		}else{
				$passportId=$this->session->userdata('passportId');//use session if web browser hard refreshed
				$list['passport_details']=$this->coachmodel->getPassportDetails($passportId);
				$this->load->view('coaches/edit_passport',$list);
			}
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
		    redirect(base_url(('coach')));
		}

}
//
public function updateplayerpspt()
{
	if($this->session->userdata('coach_login'))
	{
    	$passportId=$this->input->post('passportId',TRUE);
		//get initial file name..this file should be deleted and a new one inserted on update
		$initFile=$this->input->post('initFile',TRUE);

		$passport_number=$this->input->post('passportNo',TRUE);
		$issue_date=$this->input->post('dateOfIssue',TRUE);
		$expiry_date=$this->input->post('dateOfExpiry',TRUE);
		$issue_country=$this->input->post('issueCountry',TRUE);


		$config['upload_path']          = 'uploads/travel_documents';
		$config['allowed_types']='jpg|png|jpeg|JPG|PNG|JPEG';
		$config['max_size']             = 700;
		$config['max_width']            = 700;
		$config['max_height']           = 700;
		$config['file_name']			=md5(time().$passport_number);
		$config['overwrite']           = true;
		$config['file_ext_tolower']     = true;

		$this->load->library('upload', $config);

		if (empty($_FILES['photo']['name'])) 
		{
	    		$passport_details=array('passport_number'=>$passport_number,'issue_date'=>$issue_date, 'expiry_date'=>$expiry_date,'issue_country'=>$issue_country);

				$result=$this->coachmodel->updatePassportNoPhoto($passport_details,$passportId);
				if($result)
				{
					$feedback = array('error' => "",'success' => "Passport updated");
					$this->session->set_flashdata('msg',$feedback);
		           redirect(base_url(('coach/playerpassports')));
				}else 
					{
						$feedback = array('error' => "No changes made ",'success' => "");
						$this->session->set_flashdata('msg',$feedback);
		               redirect(base_url(('coach/playerpassports')));
					}

		}else{ 

				if(!$this->upload->do_upload('photo'))
				{
					
					$passport_details=array('passport_number'=>$passport_number,'issue_date'=>$issue_date, 'expiry_date'=>$expiry_date,'issue_country'=>$issue_country);
					$result=$this->coachmodel->updatePassportNoPhoto($passport_details,$passportId);
					if($result)
						{
							$feedback = array('error' => "",'success' => "<span style='color:#FFFF00'>passport details updated. </span> However, ".$this->upload->display_errors());
							$this->session->set_flashdata('msg',$feedback);
				           redirect(base_url(('coach/playerpassports')));
						}else 
							{
								$feedback = array('error' => "No changes made  and, ".$this->upload->display_errors(),'success' => "");
								$this->session->set_flashdata('msg',$feedback);
				               redirect(base_url(('coach/playerpassports')));
							}
				}else{

					   	$data =$this->upload->data();//details of uploaded file

						$passport_details=array('passport_number'=>$passport_number,'issue_date'=>$issue_date, 'expiry_date'=>$expiry_date,'issue_country'=>$issue_country,'passport_photo'=>$config['file_name'].$data['file_ext']);

						//new session of admin profile photo
	                    $this->session->set_userdata("passport_photo",$config['file_name'].$data['file_ext']);

						$result=$this->coachmodel->updatePassport($passport_details,$passportId,$initFile);
						if($result)
							{
								$feedback = array('error' => "",'success' => "Passport info updated");
								$this->session->set_flashdata('msg',$feedback);
					           redirect(base_url(('coach/playerpassports')));
							}else 
								{
									$feedback = array('error' => "Failed to update ",'success' => "");
									$this->session->set_flashdata('msg',$feedback);
					               redirect(base_url(('coach/playerpassports')));
								}


				}

		}
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
			   redirect(base_url(('coach')));
			}

}
//save new player passport
public function newplayerpspt() 
{
	if($this->session->userdata('coach_login'))
	{
		$player_id=$this->input->post('playerId', TRUE);
		$passportNumber=$this->input->post('passportNo', TRUE);
		$dateOfIssue=$this->input->post('dateOfIssue', TRUE);
		$dateOfExpiry=$this->input->post('dateOfExpiry', TRUE);
		$issueCountry=$this->input->post('issueCountry', TRUE);

		$config['upload_path']          = 'uploads/travel_documents';
		$config['allowed_types']='jpg|png|jpeg|JPG|PNG|JPEG';
		$config['max_size']             = 700;
		$config['max_width']            = 700;
		$config['max_height']           = 700;
		$config['file_name']			=md5(time().$passportNumber);
		$config['overwrite']           = true;
		$config['file_ext_tolower']     = true;

		$this->load->library('upload', $config);

		if(isset($player_id) && strlen($player_id) && isset($passportNumber) && strlen($passportNumber) && isset($dateOfIssue) && strlen($dateOfIssue) && isset($dateOfExpiry) && strlen($dateOfExpiry) && isset($issueCountry) && strlen($issueCountry))
			{
			    $this->db->select('*');
				$this->db->from('travel_documents');
				$this->db->where('player_id',$player_id);
				$this->db->or_where('passport_number',$passportNumber);
				$query = $this->db->get();
		        $num=$query->num_rows(); 

		        if($num>0)
		            {
		            	$feedback = array('error' => "This player passport exists",'success' => "");
						$this->session->set_flashdata('msg',$feedback);
			        	redirect(base_url(('coach/playerpassports')));
		        	}else{
		        				
			           		//if no photo has been selected  uploaded
			           		if (empty($_FILES['photo']['name'])) 
							  	{
						           	$feedback = array('error' => "Please select passport photo file",'success' => "");
									$this->session->set_flashdata('msg',$feedback);
						        	redirect(base_url(('coach/addplayerpspt')));
						        }else{
							  			//confirm upload success
										if (!$this->upload->do_upload('photo'))
									    	{   
									        	$feedback = array('error' => $this->upload->display_errors(),'success' => "");
												$this->session->set_flashdata('msg',$feedback);
									       		redirect(base_url(('coach/addplayerpspt')));
									    	}else{
													$data =$this->upload->data(); //load data to page
										    		$passport_details =array('player_id'=>$player_id,'passport_number'=>$passportNumber,'issue_date'=>$dateOfIssue,'expiry_date'=>$dateOfExpiry,'issue_country'=>$issueCountry,'passport_photo'=>$config['file_name'].$data['file_ext']);

														$result=$this->coachmodel->addPlayerPspt($passport_details);

														if($result)
															{
																$feedback = array('error' => "",'success' => "Passport for ".$this->session->userdata('pst_player_name')." added.");
																$this->session->set_flashdata('msg',$feedback);
												           		redirect(base_url(('coach/playerpassports')));
															}else 
																{
																	$feedback = array('error' => "Passport not added",'success' => "");
																	$this->session->set_flashdata('msg',$feedback);
												               		redirect(base_url(('coach/playerpassports')));
																}

											    }
						   			}
						}
			}else{
					$feedback = array('error' => "A required field is missing",'success' => "");
					$this->session->set_flashdata('msg',$feedback);
		        	redirect(base_url(('coach/addplayerpspt')));
			}
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
			   redirect(base_url(('coach')));
		}
				
		
}
//get more details of a player's passport
public function playerpsptdetails()
{
	if($this->session->userdata('coach_login'))
	{
		$passportId=$this->input->post('passportId',TRUE);
		if(isset($passportId))
		{
			//create a session to handle browser refresh i.e not lose posted passport id
			$sessdata = array('passportId'=>$passportId);
			$this->session->set_userdata($sessdata);

			$list['passport_details']=$this->coachmodel->getPassportDetails($passportId);
			$this->load->view('coaches/player_passport_details',$list);

		}else {
				$passportId=$this->session->userdata('passportId');//use session if web browser hard refreshed
				$list['passport_details']=$this->coachmodel->getPassportDetails($passportId);
				$this->load->view('coaches/player_passport_details',$list);
		}
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
			   redirect(base_url(('coach')));
		}
}

//get players for autopick in goal scorers
// public function getplayers()
// {
// 	$teamId=$this->session->userdata('coachSportID');
// 	$list=$this->coachmodel->activePlayersList($teamId);
// 	$info=array();
//     foreach ($list as $pls) 
//         {   
//             $info[]= '@'.$pls['player_fname']." ".$pls['player_lname'];
//         }
//     echo json_encode($info);
// }
//get players of a match
public function getplayers()
{
	if($this->session->userdata('coach_login'))
	{
		$tournamentMatchId=$this->input->post('pid',TRUE);
		$list =$this->coachmodel->getMatchPlayers($tournamentMatchId);
		$data = array();
		foreach ($list as $player) 
		    {
		        $data[]= $player['player_fname'].' '.$player['player_lname'];
		    }

		echo json_encode($data);//data should be a plain array...
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
			   redirect(base_url(('coach')));
		}

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
	if($this->session->userdata('coach_login'))
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
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
			   redirect(base_url(('coach')));
		}
	
}
//dashboard view page for coach
public function dashboard()
{
	if($this->session->userdata('coach_login'))
	{
		$sportId=$this->session->userdata('coachSportID');
		$sportName=$this->session->userdata('coachSportName');//from login session

		$list['players']=$this->coachmodel->activePlayersList($sportId);
		$list['activeplayerscount']=$this->coachmodel->activePlayersCount($sportId);//count players active

		$teams=$this->coachmodel->activeTeamsListPerSport($sportId);

		$sessdata = array('coachnav'=>"coaches/".strtolower($sportName)."/coachnav",'perSportTeams'=>$teams);
		$this->session->set_userdata($sessdata);
		$this->load->view('coaches/dashboard',$list);
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
			   redirect(base_url(('coach')));
		}
	
}
//Player profile (more_about_player) for coach
public function playerprofile()
{
	if($this->session->userdata('coach_login'))
	{
		$playerId=$this->input->post('playerId', TRUE);
		if(isset ($playerId) && strlen($playerId)){
			$player_profile['player_profile']=$this->coachmodel->playerProfile($playerId);
			$this->load->view('coaches/player_profile',$player_profile);
		}else{
			$feedback = array('edit'=>'','error' => "Session was unset",'success' => "");
			$this->session->set_flashdata('msg',$feedback);
	       redirect(base_url(('coach/players')));
		}
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
			   redirect(base_url(('coach')));
		}
}

//player next of kin profile
public function nextofkin()
{
	if($this->session->userdata('coach_login'))
	{
		$playerId=$this->input->post('playerId', TRUE);
		if(isset ($playerId) && strlen($playerId)){
			$kin['nxtkin']=$this->coachmodel->playerProfile($playerId);
		$this->load->view('coaches/nxt_kin',$kin);
		}else{
			$feedback = array('edit'=>'','error' => "Session was unset",'success' => "");
			$this->session->set_flashdata('msg',$feedback);
	       redirect(base_url(('coach/players')));
		}
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
			   redirect(base_url(('coach')));
		}
	
}

//player profile edit (edit player )
public function editplayer()
{
	if($this->session->userdata('coach_login'))
	{
		$sportId=$this->session->userdata('coachSportID');//from login session
		$playerId=$this->input->post('playerId', TRUE);//
		if(isset ($playerId) && strlen($playerId)){
			$player_profile['courses']=$this->coachmodel->coursesList();
			// $player_profile['teams']=$this->coachmodel->activeTeamsList();
			$player_profile['player_profile']=$this->coachmodel->playerProfile($playerId);
			$list['teams']=$this->coachmodel->activeTeamsListPerSport($sportId);
			$this->load->view('coaches/edit_player',$player_profile);
		}else{
			$feedback = array('edit'=>'','error' => "Session was unset",'success' => "");
			$this->session->set_flashdata('msg',$feedback);
	       redirect(base_url(('coach/players')));
		}

	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
				  redirect(base_url(('coach')));
		}
	
}

//training days page view
public function trainingdays()
{
	if($this->session->userdata('coach_login'))
	{
		$sportId=$this->session->userdata('coachSportID');//from login session
		$training_days['tr_days']=$this->coachmodel->trDaysList($sportId);
		$this->load->view('coaches/training_days',$training_days);
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
				  redirect(base_url(('coach')));
		}
}
//edit training days vpage view
public function editdays()
{
	if($this->session->userdata('coach_login'))
	{
		$trdId=$this->input->post('trdId', TRUE);
		if(isset ($trdId) && strlen($trdId)){
			$training_days['tr_days']=$this->coachmodel->trdList($trdId);
			$this->load->view('coaches/edit_trds',$training_days);
		}else{
			$feedback = array('edit'=>'','error' => "Session was unset",'success' => "");
			$this->session->set_flashdata('msg',$feedback);
	       redirect(base_url(('coach/trainingdays')));
		}
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
				  redirect(base_url(('coach')));
		}
	
}
//training attendance view
public function trainingattendance()
{
	if($this->session->userdata('coach_login'))
	{
		$sportId=$this->session->userdata('coachSportID');
		$players_list['players']=$this->coachmodel->activePlayersList($sportId);
		$this->load->view('coaches/training_attendance',$players_list);
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
				  redirect(base_url(('coach')));
		}	
}
//physio therapist injury management
public function injury_management()
{
	if($this->session->userdata('coach_login'))
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
			$record['injured']=$this->coachmodel->injuredPerson($record_id);
			// $record['injury_management']=$this->coachmodel->injury_management_records();
			$this->load->view('phythera/injury_management',$record);
		}else 
			{
				$feedback = array('error'=>'','success'=>'','edit' => $record_id,'success' => "");
				$this->session->set_flashdata('msg',$feedback);
		        redirect(base_url(('coach/injury_record')));
			} 
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
				  redirect(base_url(('coach')));
		}	
}

//injuries
public function injuries()
{
	if($this->session->userdata('coach_login'))
	{
		$sportId=$this->session->userdata('coachSportID');
		$record['injuries']=$this->coachmodel->injuryRecords($sportId);
		$this->load->view('coaches/injury_records',$record);
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
				  redirect(base_url(('coach')));
		}	
}


//injury record view
public function injury_record()
{
	if($this->session->userdata('coach_login'))
	{
		$sportId=$this->session->userdata('coachSportID');
		$record['players']=$this->coachmodel->activePlayersList($sportId);
		$record['injuries']=$this->coachmodel->injuryRecords();//view entered records
		$this->load->view('phythera/injury_record',$record);
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
				  redirect(base_url(('coach')));
		}	

}

//edit injury record
public function eir()
{
	if($this->session->userdata('coach_login'))
	{
		$recordId=$this->input->post('recordId', TRUE);
		$sportId=$this->session->userdata('coachSportID');
		$record['players']=$this->coachmodel->activePlayersList($sportId);
		$record['record']=$this->coachmodel->injuryRecord($recordId);
		$this->load->view('phythera/edit_irecord',$record);
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
				  redirect(base_url(('coach')));
		}	
}
//edit injury Management record
public function eimr()
{
	if($this->session->userdata('coach_login'))
	{
		$recordId=$this->input->post('recordId', TRUE);
		$record['record']=$this->coachmodel->injuryRecord($recordId);
		$this->load->view('phythera/edit_imr',$record);
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
				  redirect(base_url(('coach')));
		}	
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
// 		$record['injury_record']=$this->coachmodel->injuryRecord($recordId);
// 		$feedback = array('addIMRId'=>$recordId,'edit'=>'','error'=>"",'success'=>"");
// 		$this->session->set_flashdata('msg',$feedback);
// 		$this->load->view('phythera/injury_more',$record);
// 	}else{
// 		$record['injury_record']=$this->coachmodel->injuryRecord($recordId);
// 		$feedback = array('addIMRId'=>"",'edit'=>'','error'=> "",'success'=>"");
// 		$this->session->set_flashdata('msg',$feedback);
// 		$this->load->view('phythera/injury_more',$record);
// 	}
// }

//more about injury record by physiotherapist
public function mai()
{
	if($this->session->userdata('coach_login'))
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
			$record['injury_record']=$this->coachmodel->injuryRecord($recordId);
			$this->load->view('phythera/injury_more',$record);
		}else
		{
			$record['recordID']="";
			$record['injury_record']=$this->coachmodel->injuryRecord($recordId);
			$this->load->view('phythera/injury_more',$record);
		}
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
				  redirect(base_url(('coach')));
		}	
}

//more about injury record by coach
// public function cmai()
// {
// 	$recordId=$this->input->post('recordId', TRUE);
// 	$this->db->select('*');
// 	$this->db->from('injury_records');
// 	$this->db->where('coach_remarks',NULL);
// 	$this->db->where('injury_auto_id',$recordId);
// 	$result=$this->db->get();
// 	if($result->num_rows()>0)
// 	{
// 		$record['recordID']=$recordId;
// 		$record['injury_record']=$this->coachmodel->injuryRecord($recordId);
// 		$this->load->view('coaches/injury_more',$record);
// 	}else
// 	{
// 		$record['recordID']="";
// 		$record['injury_record']=$this->coachmodel->injuryRecord($recordId);
// 		$this->load->view('coaches/injury_more',$record);
// 	}
	
// }
//more about injury record
public function injurydetails()
{
	if($this->session->userdata('coach_login'))
	{
		$recordId=$this->input->post('recordId', TRUE);
		if(isset ($recordId) && strlen($recordId)){
			$record['injury_record']=$this->coachmodel->injuryRecord($recordId);
			$this->load->view('coaches/injury_more',$record);
		}else{
			$feedback = array('edit'=>'','error' => "Session was unset",'success' => "");
			$this->session->set_flashdata('msg',$feedback);
	       redirect(base_url(('coach/injuries')));
		}
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
					  redirect(base_url(('coach')));
		}	
	
}
//more about injury record by dean of students
public function _injurydetails()
{
	if($this->session->userdata('coach_login'))
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
			$record['injury_record']=$this->coachmodel->injuryRecord($recordId);
			$this->load->view('admin/injury_more',$record);
		}else
		{
			$record['recordID']="";
			$record['injury_record']=$this->coachmodel->injuryRecord($recordId);
			$this->load->view('admin/injury_more',$record);
		}
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
		    redirect(base_url(('coach')));
		}
}
//delete injury record
public function deleteIR()
{
	if($this->session->userdata('coach_login'))
	{
		$recordId=$this->input->post('recordId', TRUE);
		$result=$this->coachmodel->deleteIR($recordId);
		if($result)
			{
				$feedback = array('edit'=>'','error' => "",'success' => "Record deleted");
				$this->session->set_flashdata('msg',$feedback);
	           redirect(base_url(('coach/injury_record')));
			}else 
				{
					$feedback = array('edit'=>'','error' => "Could not delete",'success' => "");
					$this->session->set_flashdata('msg',$feedback);
	               redirect(base_url(('coach/injury_record')));
				}
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
		    redirect(base_url(('coach')));
		}
}



//coach remarks view
public function crmks()
{
	if($this->session->userdata('coach_login'))
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
	        	$record['injury_management']=$this->coachmodel->get_injury_record($this->input->post('recordId', TRUE));
				$this->load->view('coaches/coach_remarks',$record);
	        }else 
	            {
	            	$feedback = array('edit'=>'','error' => "Remarks exist. Please edit instead",'success' => "");
					$this->session->set_flashdata('msg',$feedback);
		            redirect(base_url(('coach/cim')));
	            }
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
		    redirect(base_url(('coach')));
		}
}

//edit coach remark view page
public function ecr()
{
	if($this->session->userdata('coach_login'))
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
		        redirect(base_url(('coach/cim')));
				
			}else
				{
					$sportId=$this->session->userdata('coachSportID');
					$record['players']=$this->coachmodel->activePlayersList($sportId);
					$record['injury_management']=$this->coachmodel->injuryRecord($recordId);
					$this->load->view('coaches/edit_coach_remarks',$record);
				}
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
		    redirect(base_url(('coach')));
		}
}
//new coach registration 
public function nc()
{
	if($this->session->userdata('coach_login'))
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
	            redirect(base_url(('coach/coaches')));
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
				            redirect(base_url(('coach/coaches')));
			            }else
			            	{
						            	$result=$this->coachmodel->new_coach($coach_details);

										if($result)
											{
												$feedback = array('error' => "",'success' => "New coach added");
												$this->session->set_flashdata('msg',$feedback);
							                   redirect(base_url(('coach/coaches')));
											}else 
												{
													$feedback = array('error' => "Registration failed",'success' => "");
													$this->session->set_flashdata('msg',$feedback);
								                   redirect(base_url(('coach/coaches')));
												}
	            			}
	           }
	 }else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}


//player registration
public function newplayer()
{
	if($this->session->userdata('coach_login'))
	{
		//check if student id was not entered. If it was not entered, save null for both student id and course
		$studid=$this->input->post('studentID', TRUE);

		if($studid=="")
			{
				$student_id=NULL;
				$student_course_id=NULL;
			}else{
					$student_id=$this->input->post('studentID', TRUE);
	    			$student_course_id=$this->input->post('course', TRUE);
				}

		$player_fname=$this->input->post('firstName', TRUE);
		$player_lname=$this->input->post('lastName', TRUE);
		$player_other_names=$this->input->post('otherNames', TRUE);
		$player_dob=$this->input->post('dateOfBirth', TRUE);
		$player_gender=$this->input->post('gender', TRUE);
		$player_nid=$this->input->post('idNo', TRUE);
		$player_id_type=$this->input->post('idType', TRUE);
		$player_phone_no=$this->input->post('phoneNumber', TRUE);
		$player_email=$this->input->post('emailAddress', TRUE);
       
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
        $teamId=$this->input->post('teamId', TRUE);
        $highest_achievement=$this->input->post('highestAchievement', TRUE);
		$player_residence=$this->input->post('currentResidence', TRUE);
        $agreement=$this->input->post('agreement',TRUE);
        
		$dateRegistered= date("Y-m-d"); 
		
		$sportId=$this->session->userdata('coachSportID');//from session

		$this->db->select('*');
		$this->db->from('players');
		$this->db->where('player_nid',$player_nid);
		$this->db->or_where('stud_id',$student_id);
		$query = $this->db->get();
        $num=$query->num_rows(); 
        if($num>0)
            {
            	$feedback = array('error' => "Already registered",'success' => "");
				$this->session->set_flashdata('msg',$feedback);
	            redirect(base_url(('coach/players')));
            }else 
	            {
	            	$config['upload_path']          = 'uploads/profile_photos/players';
				    $config['allowed_types']='jpg|png|jpeg|JPG|PNG|JPEG';
				    // $config['max_size']             = 100;
				    $config['max_width']            = 500;
				    $config['max_height']           = 500;
				    $config['file_name']			=md5(time().$player_phone_no.$player_fname.$player_lname);
				    $config['overwrite']           = true;
				    $config['file_ext_tolower']     = true;

					 $this->load->library('upload', $config);

					 //if no photo uploaded
					  if (empty($_FILES['photo']['name'])) 
					  {
					  	$player_details =array('stud_id'=>$student_id,'player_fname'=>$player_fname,'player_lname'=>$player_lname,'player_other_names'=>$player_other_names,'player_dob'=>$player_dob,'player_nid'=>$player_nid,'id_type'=>$player_id_type,'player_phone'=>$player_phone_no,'player_email'=>$player_email,'player_residence'=>$player_residence,'kin_fname'=>$kin_fname, 'kin_lname'=>$kin_lname, 'kin_other_names'=>$kin_other_names, 'kin_nid'=>$kin_nid_no, 'kin_phone'=>$kin_phone_no,'kin_alt_phone'=>$kin_alt_phone_no, 'kin_email'=>$kin_email, 'kin_residence'=>$kin_current_residence,'player_weight'=>$current_weight,'player_height'=>$current_height,'prev_hschool'=>$prev_high_school,'prev_play_state'=>$prev_play_status,'prev_team'=>$prev_team,'player_sport_id'=>$sportId,'player_team_id'=>$teamId,'player_gender'=>$player_gender, 'h_achievement'=>$highest_achievement,'stud_course_id'=>$student_course_id,'agreement'=>$agreement,'date_registered'=>$dateRegistered);

				    	$result=$this->coachmodel->newPlayer($player_details);
						if($result)
							{
								$feedback = array('error' => "",'success' => "New player added");
								$this->session->set_flashdata('msg',$feedback);
					           redirect(base_url(('coach/players')));
							}else 
								{
									$feedback = array('error' => "Registration failed",'success' => "");
									$this->session->set_flashdata('msg',$feedback);
					               redirect(base_url(('coach/players')));
								}
					  }else{

							    if (!$this->upload->do_upload('photo'))
							    {   
							        $feedback = array('error' => $this->upload->display_errors(),'success' => "");
									$this->session->set_flashdata('msg',$feedback);
							       	redirect(base_url(('coach/players')));
							    }else{
					       
						       		$data =$this->upload->data();
						    		//details of uploaded file
						    			$player_details =array('stud_id'=>$student_id,'player_fname'=>$player_fname,'player_lname'=>$player_lname,'player_other_names'=>$player_other_names,'player_dob'=>$player_dob,'player_nid'=>$player_nid,'id_type'=>$player_id_type,'player_phone'=>$player_phone_no,'player_email'=>$player_email,'player_residence'=>$player_residence,'kin_fname'=>$kin_fname, 'kin_lname'=>$kin_lname, 'kin_other_names'=>$kin_other_names, 'kin_nid'=>$kin_nid_no, 'kin_phone'=>$kin_phone_no,'kin_alt_phone'=>$kin_alt_phone_no, 'kin_email'=>$kin_email, 'kin_residence'=>$kin_current_residence,'player_weight'=>$current_weight,'player_height'=>$current_height,'prev_hschool'=>$prev_high_school,'prev_play_state'=>$prev_play_status,'prev_team'=>$prev_team,'player_sport_id'=>$sportId,'player_team_id'=>$teamId,'player_gender'=>$player_gender, 'h_achievement'=>$highest_achievement,'stud_course_id'=>$student_course_id,'agreement'=>$agreement,'date_registered'=>$dateRegistered,'player_profile_photo'=>$config['file_name'].$data['file_ext']);

							    	$result=$this->coachmodel->newPlayer($player_details);
									if($result)
										{
											$feedback = array('error' => "",'success' => "New player added");
											$this->session->set_flashdata('msg',$feedback);
								           redirect(base_url(('coach/players')));
										}else 
											{
												$feedback = array('error' => "Registration failed",'success' => "");
												$this->session->set_flashdata('msg',$feedback);
								               redirect(base_url(('coach/players')));
											}
								  
								}
				    		}
				   	}
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}

//update player information
public function  updateplayer()
{
	if($this->session->userdata('coach_login'))
	{
		$sportId=$this->session->userdata('coachSportID');
		$player_auto_id=$this->input->post('playerAutoId',TRUE);

		//get initial file name..this file should be deleted and a new one inserted on update
		$initFile=$this->input->post('initFile',TRUE);

		//check if student id was not entered. If it was not entered, save null for both student id and course
		$studid=$this->input->post('studentID', TRUE);
		if($studid=="")
			{
				$student_id=NULL;
				$student_course_id=NULL;
			}else{
					$student_id=$this->input->post('studentID', TRUE);
	    			$student_course_id=$this->input->post('course', TRUE);
				}

		$player_fname=$this->input->post('firstName', TRUE);
		$player_lname=$this->input->post('lastName', TRUE);
		$player_other_names=$this->input->post('otherNames', TRUE);
		$player_dob=$this->input->post('dateOfBirth', TRUE);
		$player_gender=$this->input->post('gender', TRUE);
		$player_nid=$this->input->post('idNo', TRUE);
		$player_id_type=$this->input->post('idType', TRUE);
		$player_phone_no=$this->input->post('phoneNumber', TRUE);
		$player_email=$this->input->post('emailAddress', TRUE);
	   
		$kin_fname=$this->input->post('kinFirstName', TRUE);
		$kin_lname=$this->input->post('kinLastName', TRUE);
	    $kin_other_names=$this->input->post('kinOtherNames', TRUE);
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
	    $teamId=$this->input->post('teamId', TRUE);
	    $highest_achievement=$this->input->post('highestAchievement', TRUE);
		$player_residence=$this->input->post('currentResidence', TRUE);
	    $agreement=$this->input->post('agreement',TRUE);


		$config['upload_path']          = 'uploads/profile_photos/players';
	    $config['allowed_types']='jpg|png|jpeg|JPG|PNG|JPEG';
	      // $config['max_size']             = 100;
	    $config['max_width']            = 500;
	    $config['max_height']           = 500;
		$config['file_name']			=md5(time().$player_phone_no.$player_fname.$player_lname);
	    $config['overwrite']           = true;
	    $config['file_ext_tolower']     = true;

	    $this->load->library('upload', $config);

	    if (empty($_FILES['photo']['name'])) {
	    	$player_details =array('stud_id'=>$student_id,'player_fname'=>$player_fname,'player_lname'=>$player_lname,'player_other_names'=>$player_other_names,'player_dob'=>$player_dob,'player_nid'=>$player_nid,'id_type'=>$player_id_type,'player_phone'=>$player_phone_no,'player_email'=>$player_email,'player_residence'=>$player_residence,'kin_fname'=>$kin_fname, 'kin_lname'=>$kin_lname, 'kin_other_names'=>$kin_other_names, 'kin_nid'=>$kin_nid_no, 'kin_phone'=>$kin_phone_no,'kin_alt_phone'=>$kin_alt_phone_no, 'kin_email'=>$kin_email, 'kin_residence'=>$kin_current_residence,'player_weight'=>$current_weight,'player_height'=>$current_height,'prev_hschool'=>$prev_high_school,'prev_play_state'=>$prev_play_status,'prev_team'=>$prev_team,'player_sport_id'=>$sportId,'player_team_id'=>$teamId,'player_gender'=>$player_gender, 'h_achievement'=>$highest_achievement,'stud_course_id'=>$student_course_id,'agreement'=>$agreement);

				$result=$this->coachmodel->updatePlayerNoPhoto($player_details,$player_auto_id);
				if($result)
					{
						$feedback = array('error' => "",'success' => "Player updated!");
						$this->session->set_flashdata('msg',$feedback);
			           redirect(base_url(('coach/players')));
					}else 
						{
							$feedback = array('error' => "No changes made",'success' => "");
							$this->session->set_flashdata('msg',$feedback);
			               redirect(base_url(('coach/players')));
						}

		}else{ 

				if(!$this->upload->do_upload('photo'))
				{
					
					$player_details =array('stud_id'=>$student_id,'player_fname'=>$player_fname,'player_lname'=>$player_lname,'player_other_names'=>$player_other_names,'player_dob'=>$player_dob,'player_nid'=>$player_nid,'id_type'=>$player_id_type,'player_phone'=>$player_phone_no,'player_email'=>$player_email,'player_residence'=>$player_residence,'kin_fname'=>$kin_fname, 'kin_lname'=>$kin_lname, 'kin_other_names'=>$kin_other_names, 'kin_nid'=>$kin_nid_no, 'kin_phone'=>$kin_phone_no,'kin_alt_phone'=>$kin_alt_phone_no, 'kin_email'=>$kin_email, 'kin_residence'=>$kin_current_residence,'player_weight'=>$current_weight,'player_height'=>$current_height,'prev_hschool'=>$prev_high_school,'prev_play_state'=>$prev_play_status,'prev_team'=>$prev_team,'player_sport_id'=>$sportId,'player_team_id'=>$teamId,'player_gender'=>$player_gender, 'h_achievement'=>$highest_achievement,'stud_course_id'=>$student_course_id,'agreement'=>$agreement);

					$result=$this->coachmodel->updatePlayerNoPhoto($player_details,$player_auto_id);
					if($result)
						{
							$feedback = array('error' => "",'success' => "<span style='color:#FFFF00'>Player info updated. </span> However, ".$this->upload->display_errors());
							$this->session->set_flashdata('msg',$feedback);
				           redirect(base_url(('coach/players')));
						}else 
							{
								$feedback = array('error' => "No changes made  and, ".$this->upload->display_errors(),'success' => "");
								$this->session->set_flashdata('msg',$feedback);
				               redirect(base_url(('coach/players')));
							}
				}else{
					   	$data =$this->upload->data();//details of uploaded file

						$player_details =array('stud_id'=>$student_id,'player_fname'=>$player_fname,'player_lname'=>$player_lname,'player_other_names'=>$player_other_names,'player_dob'=>$player_dob,'player_nid'=>$player_nid,'id_type'=>$player_id_type,'player_phone'=>$player_phone_no,'player_email'=>$player_email,'player_residence'=>$player_residence,'kin_fname'=>$kin_fname, 'kin_lname'=>$kin_lname, 'kin_other_names'=>$kin_other_names, 'kin_nid'=>$kin_nid_no, 'kin_phone'=>$kin_phone_no,'kin_alt_phone'=>$kin_alt_phone_no, 'kin_email'=>$kin_email, 'kin_residence'=>$kin_current_residence,'player_weight'=>$current_weight,'player_height'=>$current_height,'prev_hschool'=>$prev_high_school,'prev_play_state'=>$prev_play_status,'prev_team'=>$prev_team,'player_sport_id'=>$sportId,'player_team_id'=>$teamId,'player_gender'=>$player_gender, 'h_achievement'=>$highest_achievement,'stud_course_id'=>$student_course_id,'agreement'=>$agreement,'player_profile_photo'=>$config['file_name'].$data['file_ext']);

						$result=$this->coachmodel->updatePlayer($player_details,$player_auto_id,$initFile);
						if($result)
							{
								$feedback = array('error' => "",'success' => "Mentee info updated");
								$this->session->set_flashdata('msg',$feedback);
					           redirect(base_url(('coach/players')));
							}else 
								{
									$feedback = array('error' => "Failed to update ",'success' => "");
									$this->session->set_flashdata('msg',$feedback);
					               redirect(base_url(('coach/players')));
								}


				}

		}
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
	
}
//disable Player
public function disablePlayer()
{
	if($this->session->userdata('coach_login'))
	{
		$player_auto_id=$this->input->post('playerAutoId', TRUE);
		$reasonToDisable=$this->input->post('reasonToDisable', TRUE);
		$updateDetails=array('active_status'=>0, 'reason_inactive'=>$reasonToDisable);
		$result=$this->coachmodel->disablePlayer($updateDetails,$player_auto_id);
		if($result)
			{
				$feedback = array('error' => "",'success' => "Player disabled!");
				$this->session->set_flashdata('msg',$feedback);
	           redirect(base_url(('coach/players')));
			}else 
				{
					$feedback = array('error' => "Failed to disable!",'success' => "");
					$this->session->set_flashdata('msg',$feedback);
	               redirect(base_url(('coach/players')));
				}
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}

//captain registration
public function newcaptain()
{
	if($this->session->userdata('coach_login'))
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
							$feedback = array('error' => "Duplicate entries",'success' => "");
							$this->session->set_flashdata('msg',$feedback);
				            redirect(base_url(('coach/captains')));
		        		}else
		                	{//If 
		                		$result=$this->coachmodel->new_captain($captain_details);

								if($result)
									{
										$feedback = array('error' => "",'success' => "New captain added");
										$this->session->set_flashdata('msg',$feedback);
					                   redirect(base_url(('coach/captains')));
									}else 
										{
											$feedback = array('error' => "Error",'success' => "");
											$this->session->set_flashdata('msg',$feedback);
						                   redirect(base_url(('coach/captains')));
										}	
		                	}
		        }else
			        {
			        	$feedback = array('error' => "Not a member of selected team",'success' => "");
						$this->session->set_flashdata('msg',$feedback);
	                   	redirect(base_url(('coach/captains')));
			        }
		}else{
				$feedback = array('error' => "Unregistered player",'success' => "");
				$this->session->set_flashdata('msg',$feedback);
				redirect(base_url(('coach/captains')));
			}
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}

}

//captain update
public function updatecaptain()
{
	if($this->session->userdata('coach_login'))
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
					$result=$this->coachmodel->update_captain($captain_details,$captainId);
					if($result)
						{
							$feedback = array('error' => "",'success' => "Captain updated!");
							$this->session->set_flashdata('msg',$feedback);
				           redirect(base_url(('coach/captains')));
						}else 
							{
								$feedback = array('error' => "No changes made",'success' => "");
								$this->session->set_flashdata('msg',$feedback);
				               redirect(base_url(('coach/captains')));
							}
				}else{
						$feedback = array('error' => "Not a member of selected team",'success' => "");
						$this->session->set_flashdata('msg',$feedback);
				        redirect(base_url(('coach/captains')));
				}
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}

//save new training days
public function newdays()
{
	if($this->session->userdata('coach_login'))
	{
	   	$training_year=date("Y");
		$sportId=$this->session->userdata('coachSportID');//from login session
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

		$tr_days_details=array('trd_year'=>$training_year,'trd_sport_id'=>$sportId,'january'=>$january,'february'=>$february,'march'=>$march,'april'=>$april,'may'=>$may,'june'=>$june,'july'=>$july,'august'=>$august,'september'=>$september,'october'=>$october,'november'=>$november,'december'=>$december);
		//check if training days for the year already exists
		$this->db->select('*');
		$this->db->from('training_days');
		$this->db->where('trd_year',$training_year);
		$this->db->where('trd_sport_id',$sportId);
		$query=$this->db->get();
		 $num=$query->num_rows(); 
	    if($num>0)
	       {
	       		$feedback = array('error' => "Training days  for ".$training_year." exist",'success' => "");
				$this->session->set_flashdata('msg',$feedback);
	            redirect(base_url(('coach/trainingdays')));
	       }else
	           	{
	           		$result=$this->coachmodel->newTrDays($tr_days_details);

					if($result)
						{
							$feedback = array('error' => "",'success' => "New training days added");
							$this->session->set_flashdata('msg',$feedback);
		                   redirect(base_url(('coach/trainingdays')));
						}else 
							{
								$feedback = array('error' => "Failed to add training days",'success' => "");
								$this->session->set_flashdata('msg',$feedback);
			                   redirect(base_url(('coach/trainingdays')));
							}
	           	}
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}

}

//update training days
public function updatedays()
{
	if($this->session->userdata('coach_login'))
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
		
		$result=$this->coachmodel->updateTrDays($tr_days_details,$training_year);
		if($result)
			{
				$feedback = array('error' => "",'success' => "Training days updated");
				$this->session->set_flashdata('msg',$feedback);
	           redirect(base_url(('coach/trainingdays')));
			}else 
				{
					$feedback = array('error' => "No changes made",'success' => "");
					$this->session->set_flashdata('msg',$feedback);
	               redirect(base_url(('coach/trainingdays')));
				}
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}

}
public function new_tr_attendance()
{
	if($this->session->userdata('coach_login'))
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
	                       		$result=$this->coachmodel->new_tr_record();
	                    }
	                    if($result)
	                    		{
	        			
	                                $message['successful'][]=  "Attendance  Added";
	                           
	                                echo json_encode($message);//return success 
	                            }else
	                                {
	                                    $message['error'][]=  "An error occurred";
	                               
	                                    echo json_encode($message);//return No changes made
	                                }
				}
			}
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}
//new injury recording
public function new_injury_record()
{
	if($this->session->userdata('coach_login'))
	{
		$player_auto_id=$this->input->post('playerid', TRUE);
		$injury_date=$this->input->post('dateOfInjury', TRUE);
		$date_seen=$this->input->post('dateInHospital', TRUE);
		$injury_description=$this->input->post('injuryDescription', TRUE);
		$date_recorded= date("Y-m-d");

		$injury_details=array('player_auto_id'=>$player_auto_id,'injury_date'=>$injury_date,'date_seen'=>$date_seen,'injury_description'=>$injury_description,'date_recorded'=>$date_recorded);

		$result=$this->coachmodel->new_injury_record($injury_details);
			if($result)
				{
					$feedback = array('edit'=>'','error' => "",'success' => "New record added");
					$this->session->set_flashdata('msg',$feedback);
	               redirect(base_url(('coach/injury_record')));
				}else 
					{
						$feedback = array('edit'=>'','error' => "Failed to add record",'success' => "");
						$this->session->set_flashdata('msg',$feedback);
	                   redirect(base_url(('coach/injury_record')));
					} 
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}
//injury record updating
public function update_ir()
{
	if($this->session->userdata('coach_login'))
	{
		$record_id=$this->input->post('recordId', TRUE);
		// $player_nid=$this->input->post('playerid', TRUE);
		$injury_date=$this->input->post('dateOfInjury', TRUE);
		$date_seen=$this->input->post('dateInHospital', TRUE);
		$injury_description=$this->input->post('injuryDescription', TRUE);

		$record_details=array('injury_date'=>$injury_date,'date_seen'=>$date_seen,'injury_description'=>$injury_description);

		$result=$this->coachmodel->update_injury_record($record_details,$record_id);
			if($result)
				{
					$feedback = array('edit'=>'','error' => "",'success' => "Injury record updated");
					$this->session->set_flashdata('msg',$feedback);
	               redirect(base_url(('coach/injury_record')));
				}else 
					{
						$feedback = array('edit'=>'','error' => "No changes made",'success' => "");
						$this->session->set_flashdata('msg',$feedback);
	                   redirect(base_url(('coach/injury_record')));
					} 
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}

//new injury management record
public function new_imr()
{
	if($this->session->userdata('coach_login'))
	{
		$record_id=$this->input->post('recordId', TRUE);
		// $player_nid=$this->input->post('playerid', TRUE);
		$diagnosis=$this->input->post('diagnosis', TRUE);
		$treatment=$this->input->post('treatment', TRUE);
		$physioRemarks=$this->input->post('physioRemarks', TRUE);
		$date_recorded= date("Y-m-d");

		$im_details=array('diagnosis'=>$diagnosis,'treatment'=>$treatment,'physio_remarks'=>$physioRemarks,'date_recorded'=>$date_recorded);

		
			$result=$this->coachmodel->new_im_record($im_details,$record_id);
				if($result)
					{
						$feedback = array('edit'=>'','error' => "",'success' => "IM record added");
						$this->session->set_flashdata('msg',$feedback);
	                   redirect(base_url(('coach/injury_record')));
					}else 
						{
							$feedback = array('edit'=>'','error' => "Failed to add record",'success' => "");
							$this->session->set_flashdata('msg',$feedback);
		                   redirect(base_url(('coach/injury_record')));
						}
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
	
}
//injury management record updating
public function update_imr()
{
	if($this->session->userdata('coach_login'))
	{
		$record_id=$this->input->post('recordId', TRUE);
		$diagnosis=$this->input->post('diagnosis', TRUE);
		$treatment=$this->input->post('treatment', TRUE);
		$physio_remarks=$this->input->post('physioRemarks', TRUE);

		$record_details=array('diagnosis'=>$diagnosis,'treatment'=>$treatment,'physio_remarks'=>$physio_remarks);

		$result=$this->coachmodel->update_imr_record($record_details,$record_id);
			if($result)
				{
					$feedback = array('edit'=>'','error' => "",'success' => "IM record updated");
					$this->session->set_flashdata('msg',$feedback);
	               redirect(base_url(('coach/injury_record')));
				}else 
					{
						$feedback = array('edit'=>'','error' => "No changes made",'success' => "");
						$this->session->set_flashdata('msg',$feedback);
	                   redirect(base_url(('coach/injury_record')));
					} 
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}

//coach remarks
public function new_remark()
{
	if($this->session->userdata('coach_login'))
	{
		$record_id=$this->input->post('record_id', TRUE);
		$remarks = array('coach_remarks' => $this->input->post('coachRemarks', TRUE));
		$result=$this->coachmodel->new_remarks($record_id,$remarks);
				if($result)
					{
						$feedback = array('error' => "",'success' => "New remark added",'edit'=>"");
						$this->session->set_flashdata('msg',$feedback);
	                   redirect(base_url(('coach/cim')));
					}else 
						{
							$feedback = array('error' => "Failed to add remark",'success' => "",'edit'=>"");
							$this->session->set_flashdata('msg',$feedback);
		                   redirect(base_url(('coach/cim')));
						} 
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}

}
//coach remarks
public function update_remark()
{
	if($this->session->userdata('coach_login'))
	{
		$recordId=$this->input->post('recordId', TRUE);
		$remarks = array('coach_remarks' => $this->input->post('coachRemarks', TRUE));
		$result=$this->coachmodel->update_remarks($recordId,$remarks);
				if($result)
					{
						$feedback = array('error' => "",'success' => "Remark updated",'edit'=>'');
						$this->session->set_flashdata('msg',$feedback);
	                   redirect(base_url(('coach/cim')));
					}else 
						{
							$feedback = array('error' => "Failed to update",'success' => "",'edit'=>'');
							$this->session->set_flashdata('msg',$feedback);
		                   redirect(base_url(('coach/cim')));
						} 
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}

}
//delete coach remark
public function deleteRemark()
{
	if($this->session->userdata('coach_login'))
	{
		$recordId=$this->input->post('recordId', TRUE);
		$remarks = array('coach_remarks' => NULL);
		$result=$this->coachmodel->deleteRemark($recordId,$remarks);
		if($result)
			{
				$feedback = array('edit'=>'','error' => "",'success' => "Remark deleted");
				$this->session->set_flashdata('msg',$feedback);
	           redirect(base_url(('coach/cim')));
			}else 
				{
					$feedback = array('edit'=>'','error' => "Could not delete",'success' => "");
					$this->session->set_flashdata('msg',$feedback);
	               redirect(base_url(('coach/cim')));
				}
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}
//Physio therapist registration 
public function newtherapist()
{
	if($this->session->userdata('coach_login'))
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
	            redirect(base_url(('coach/physiotherapists')));
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
				            redirect(base_url(('coach/physiotherapists')));
			            }else
			            	{
						            	$result=$this->coachmodel->new_physio_therapist($phyth_details);

										if($result)
											{
												$feedback = array('error' => "",'success' => "New physiotherapist added");
												$this->session->set_flashdata('msg',$feedback);
							                   redirect(base_url(('coach/physiotherapists')));
											}else 
												{
													$feedback = array('error' => "Registration failed",'success' => "");
													$this->session->set_flashdata('msg',$feedback);
								                   redirect(base_url(('coach/physiotherapists')));
												}
	            			}
	           }
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}

}



public function tratt()/*function to save attendance for a given meeting*/
{
	if($this->session->userdata('coach_login'))
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
	                                                        $result=$this->coachmodel->meetingattendanceinfosave($attendanceinfo);
	                                                    }
	                                                    if ($result) 
	                                                                    {
	                                                                        $message['successful'][]=  "Attendance  Added";
	                                                                   
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
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
		redirect(base_url(('coach')));
		}

}

// Team Expenditure Men (Coach view)
public function expenses_men()
{
	if($this->session->userdata('coach_login'))
	{
		$teamId=$this->session->userdata('coachSportID');
		$list['expenses']=$this->coachmodel->expensesMen($teamId);
		$this->load->view('coaches/team_expenses',$list);
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
		redirect(base_url(('coach')));
		}

}
// Team Expenditure Women (Coach view)
public function expenses_women()
{
	if($this->session->userdata('coach_login'))
	{
		$teamId=$this->session->userdata('coachSportID');
		$list['expenses']=$this->coachmodel->expensesWomen($teamId);
		$this->load->view('coaches/team_expenses',$list);
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}
// Team Expenditure Both Men & Women (Coach view)
public function expenditures()
{
	if($this->session->userdata('coach_login'))
	{
		$teamId=$this->session->userdata('coachSportID');
		$list['expenses']=$this->coachmodel->expensesMixed($teamId);
		$this->load->view('coaches/expemix',$list);
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}

}
//more about team expenditure
public function expenditureinfo()
{
	if($this->session->userdata('coach_login'))
	{
		$expsId=$this->input->post('expsId',TRUE);
		$list['expenses']=$this->coachmodel->expenseDetails($expsId);
		$this->load->view('coaches/expemore',$list);
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}

}
//record new expenditure for men's team
public function newexpense_men()
{
	if($this->session->userdata('coach_login'))
	{
		$teamId=$this->session->userdata('coachSportID');
		$category=$this->input->post('category', TRUE);
		$exDate=$this->input->post('exDate', TRUE);
		$cash=$this->input->post('cash', TRUE);
		$lpoNo=$this->input->post('lpoNo', TRUE);
		$lpo=$this->input->post('lpo', TRUE);
		$lunches=$this->input->post('lunches', TRUE);
		$exComment=$this->input->post('comments', TRUE);
		$date_recorded= date("Y-m-d H:i:s");

		$expdetails=array('expense_team_auto_id'=>$teamId,'expense_category'=>$category,'expense_date'=>$exDate,'expense_cash'=>$cash,'expense_lpo_no'=>$lpoNo,'expense_lpo_amount'=>$lpo,'expense_lunches'=>$lunches,'expense_comment'=>$exComment,'	expense_record_date'=>$date_recorded);

			$result=$this->coachmodel->newExpense($expdetails);
				if($result)
					{
						$feedback = array('edit'=>'','error' => "",'success' => "Expenditure added ");
						$this->session->set_flashdata('msg',$feedback);
	                   redirect(base_url(('coach/expenses_men')));
					}else 
						{
							$feedback = array('edit'=>'','error' => "Failed to add expenditure",'success' => "");
							$this->session->set_flashdata('msg',$feedback);
		                   redirect(base_url(('coach/expenses_men')));
						}
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
		
}
//record new expenditure for ladies team
public function newexpense_ladies()
{
	if($this->session->userdata('coach_login'))
	{

		$teamId=$this->session->userdata('coachSportID',TRUE);
		$category=$this->input->post('category', TRUE);
		$exDate=$this->input->post('exDate', TRUE);
		$cash=$this->input->post('cash', TRUE);
		$lpoNo=$this->input->post('lpoNo', TRUE);
		$lpo=$this->input->post('lpo', TRUE);
		$lunches=$this->input->post('lunches', TRUE);
		$receipt=$this->session->userdata('receipt',TRUE);
		$exComment=$this->input->post('comments', TRUE);
		$date_recorded= date("Y-m-d H:i:s");

		$config['upload_path']          = 'uploads/expenditures/coaches';
	    $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|doc|xml|docx|GIF|JPG|PNG|JPEG|PDF|DOC|XML|DOCX|xls|xlsx';
	    // $config['max_size']             = 100;
	    $config['max_width']            = 500;
	    $config['max_height']           = 500;
	    $config['file_name']			=md5(time().$exDate.$teamId.$lpoNo);
	    $config['overwrite']           = true;
	    $config['file_ext_tolower']     = true;

		 $this->load->library('upload', $config);

		 //if no photo uploaded
		  if (empty($_FILES['receipt']['name'])) 
		  {

			$expdetails=array('expense_team_auto_id'=>$teamId,'expense_category'=>$category,'expense_date'=>$exDate,'expense_cash'=>$cash,'expense_lpo_no'=>$lpoNo,'expense_lpo_amount'=>$lpo,'expense_lunches'=>$lunches,'expense_comment'=>$exComment,'expense_record_date'=>$date_recorded);
			$result=$this->coachmodel->newExpenseWithoutReceipt($expdetails);
				if($result)
					{
						$feedback = array('edit'=>'','error' => "",'success' => "Expenditure added ");
						$this->session->set_flashdata('msg',$feedback);
	                   redirect(base_url(('coach/team_expenses')));
					}else 
						{
							$feedback = array('edit'=>'','error' => "Failed to add expenditure",'success' => "");
							$this->session->set_flashdata('msg',$feedback);
		                   redirect(base_url(('coach/team_expenses')));
						}
			}else{
					if (!$this->upload->do_upload('receipt'))
					    {   
					        $feedback = array('error' => $this->upload->display_errors(),'success' => "");
							$this->session->set_flashdata('msg',$feedback);
					       	redirect(base_url(('coach/team_expenses')));
					    }else{
				   
					       		$data =$this->upload->data();
					    		//details of uploaded file
					    			$expdetails=array('expense_team_auto_id'=>$teamId,'expense_category'=>$category,'expense_date'=>$exDate,'expense_cash'=>$cash,'expense_lpo_no'=>$lpoNo,'expense_lpo_amount'=>$lpo,'expense_lunches'=>$lunches,'expense_comment'=>$exComment,'expense_record_date'=>$date_recorded,'expense_receipt'=>$config['file_name'].$data['file_ext']);

						    	$result=$this->coachmodel->newExpenseWithReceipt($player_details);
								if($result)
									{
										$feedback = array('error' => "",'success' => "New expense added");
										$this->session->set_flashdata('msg',$feedback);
							           redirect(base_url(('coach/team_expenses')));
									}else 
										{
											$feedback = array('error' => "Expense failed to add.",'success' => "");
											$this->session->set_flashdata('msg',$feedback);
							               redirect(base_url(('coach/team_expenses')));
										}
						}
		
				}
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}
//record new expenditure for mixed gender team
public function newexpense_mixed()
{
	if($this->session->userdata('coach_login'))
	{
		$teamId=$this->session->userdata('coachSportID');
		$category=$this->input->post('category', TRUE);
		$exDate=$this->input->post('exDate', TRUE);
		$cash=$this->input->post('cash', TRUE);
		$lpoNo=$this->input->post('lpoNo', TRUE);
		$lpo=$this->input->post('lpo', TRUE);
		$lunches=$this->input->post('lunches', TRUE);
		$exComment=$this->input->post('comments', TRUE);
		$date_recorded= date("Y-m-d H:i:s");

		$expdetails=array('expense_team_auto_id'=>$teamId,'expense_category'=>$category,'expense_date'=>$exDate,'expense_cash'=>$cash,'expense_lpo_no'=>$lpoNo,'expense_lpo_amount'=>$lpo,'expense_lunches'=>$lunches,'expense_comment'=>$exComment,'	expense_record_date'=>$date_recorded);

			$result=$this->coachmodel->newExpense($expdetails);
				if($result)
					{
						$feedback = array('edit'=>'','error' => "",'success' => "Expenditure added");
						$this->session->set_flashdata('msg',$feedback);
	                   redirect(base_url(('coach/expenses_men')));
					}else 
						{
							$feedback = array('edit'=>'','error' => "Failed to add expenditure",'success' => "");
							$this->session->set_flashdata('msg',$feedback);
		                   redirect(base_url(('coach/expenses_men')));
						}
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
	
}
//load women tournaments page
public function womentournaments()
{
	if($this->session->userdata('coach_login'))
	{
		$sportId=$this->session->userdata('coachSportID');
		$list['tournaments']=$this->coachmodel->getWomenTournas($sportId);
		$data = $this->db->query("SELECT team.team_name,team.team_auto_id,team.team_category FROM teams team join sports sport on sport.sport_id=team.team_sport_id WHERE sport.sport_id='$sportId' AND team.team_category='Women' LIMIT 1")->row();
		$list['team_name']=$data->team_name;
		$list['team_id']=$data->team_auto_id;
		$list['team_category']=$data->team_category;
		$this->load->view('coaches/womentournaments',$list);
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}
//load women leagues page
public function womenleagues()
{
	if($this->session->userdata('coach_login'))
	{
		$teamId=$this->session->userdata('coachSportID');
		$list['hmatches']=$this->coachmodel->getScorpionLeagues($teamId);
		$this->load->view('coaches/hockey/scorpionsleagues',$list);
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}

//load gladiators tournaments page
public function mentournaments()
{
	if($this->session->userdata('coach_login'))
	{
		$sportId=$this->session->userdata('coachSportID');
		$list['tournaments']=$this->coachmodel->getMenTournas($sportId);
		$data = $this->db->query("SELECT team.team_name,team.team_auto_id,team.team_category FROM teams team join sports sport on sport.sport_id=team.team_sport_id WHERE sport.sport_id='$sportId' AND team.team_category='Men' LIMIT 1")->row();
		$list['team_name']=$data->team_name;
		$list['team_id']=$data->team_auto_id;
		$list['team_category']=$data->team_category;
		$this->load->view('coaches/mentournaments',$list);
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}
//load tournament matches page
public function tournmatches()
{
	if($this->session->userdata('coach_login'))
	{
		$sportId=$this->session->userdata('coachSportID');//from session
		$sportName=$this->session->userdata('coachSportName');//from login session

		$teamName=$this->input->post('teamName',TRUE);
		$teamId=$this->input->post('teamId',TRUE);
		$teamCategory=$this->input->post('teamCategory',TRUE);
		$gameId=$this->input->post('gameId',TRUE);
		$tournamentTitle=$this->input->post('tournamentTitle',TRUE);


		if(isset($gameId) && strlen($gameId)){
			// set session for tournament id
			$sessdata=array();
		    $sessdata = array('tournamentId' =>$gameId,'tournamentTitle'=>$tournamentTitle,'tournamentTeamId'=>$teamId,'tournamentTeamName'=>$teamName,'tournamentTeamCategory'=>$teamCategory); 
		    $this->session->set_userdata($sessdata);

			$list['players']=$this->coachmodel->activePlayers($sportId,$teamId);
			$list['team_name']=$teamName;
			$list['matches']=$this->coachmodel->gameMatches($gameId);


			//dynamically generate links to tournament match views per sport. Ensure that view pages of tournament matches for each sport are in folder -sportname- and are named following the convention sportnametournamentmatches Note: your sports table must have sport names as one word e.g. volleyball not volley ball
			$link_to_view_per_sport=strtolower($sportName).'/'.strtolower($sportName).'tournamentmatches';

			$this->load->view('coaches/'.$link_to_view_per_sport,$list);
		}else{

			$sportId=$this->session->userdata('coachSportID');//from session
			$teamId=$this->session->userdata('tournamentTeamId');//from session
			$gameId=$this->session->userdata('tournamentId');//from session
			
			$list['players']=$this->coachmodel->activePlayers($sportId,$teamId);
			$list['team_name']=$this->session->userdata('tournamentTeamName');//from session;
			$list['matches']=$this->coachmodel->gameMatches($gameId);

			$link_to_view_per_sport=strtolower($sportName).'/'.strtolower($sportName).'tournamentmatches';

			$this->load->view('coaches/'.$link_to_view_per_sport,$list);
		}
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
	
}
//load scorpions leagues matches page
public function scorpleaguematches()
{
	if($this->session->userdata('coach_login'))
	{
		$gameId=$this->input->post('gameId',TRUE);
		$leagueTitle=$this->input->post('leagueTitle',TRUE);
		if(isset ($gameId) && strlen($gameId)){
			// set session for tournament id
			$sessdata=array();
		    $sessdata = array('hkleagueid' =>$gameId,'leagueTitle'=>$leagueTitle); 
		    $this->session->set_userdata($sessdata);

			$teamId=$this->session->userdata('coachSportID');
			$list['players']=$this->coachmodel->activePlayersLadies($teamId);
			$list['hmatches']=$this->coachmodel->gameMatches($gameId);
			$this->load->view('coaches/hockey/hockeyleaguematches',$list);
		}else{
			$feedback = array('edit'=>'','error' => "Session was unset",'success' => "");
			$this->session->set_flashdata('msg',$feedback);
	       redirect(base_url(('coach/scorpleagues')));
		}
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
		
}
//load gladiators leagues matches page
public function gladleaguematches()
{
	if($this->session->userdata('coach_login'))
	{
		$gameId=$this->input->post('gameId',TRUE);
		$leagueTitle=$this->input->post('leagueTitle',TRUE);
		if(isset ($gameId) && strlen($gameId)){
			// set session for tournament id
			$sessdata=array();
		    $sessdata = array('hkleagueid' =>$gameId,'leagueTitle'=>$leagueTitle); 
		    $this->session->set_userdata($sessdata);

			$teamId=$this->session->userdata('coachSportID');
			$list['players']=$this->coachmodel->activePlayersLadies($teamId);
			$list['hmatches']=$this->coachmodel->gameMatches($gameId);
			$this->load->view('coaches/hockey/hockeyleaguematches',$list);
		}else{
			$feedback = array('edit'=>'','error' => "Session was unset",'success' => "");
			$this->session->set_flashdata('msg',$feedback);
	       redirect(base_url(('coach/gladiatorsleagues')));
		}
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}
//load gladiators leagues page
public function gladsleagues()
{
	if($this->session->userdata('coach_login'))
	{
		$teamId=$this->session->userdata('coachSportID');
		$list['hmatches']=$this->coachmodel->getGladiatorsLeagues($teamId);
		$this->load->view('coaches/hockey/gladiatorsleagues',$list);
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}
// //load scorpions tournament matches page
// public function gladstournmatch()
// {
// 	$gameId=$this->input->post('gameId',TRUE);
// 	$tournamentTitle=$this->input->post('tournamentTitle',TRUE);
// 	if(isset ($gameId) && strlen($gameId)){
// 		// set session for tournament id
// 		$sessdata=array();
// 	    $sessdata = array('hktournid' =>$gameId,'tournamentTitle'=>$tournamentTitle); 
// 	    $this->session->set_userdata($sessdata);

// 		$teamId=$this->session->userdata('coachSportID');
// 		$list['players']=$this->coachmodel->activeGladiators($teamId);
// 		$list['hmatches']=$this->coachmodel->gladsTournas($teamId);
// 		$this->load->view('coaches/hockey/hockeytournamentmatches',$list);
// 	}else{
// 		$feedback = array('edit'=>'','error' => "Session was unset",'success' => "");
// 		$this->session->set_flashdata('msg',$feedback);
//        redirect(base_url(('coach/gladstournas')));
// 	}
	
// }
//record new tournament match 
public function newtournmatch()
{
	if($this->session->userdata('coach_login'))
	{
		$sportId=$this->session->userdata('coachSportID');//from session
		$tournamentId=$this->session->userdata('tournamentId');//from session created in loading tournaments matches page
		
		$matchDate=$this->input->post('matchDate',TRUE);
		$matchVenue=$this->input->post('matchVenue',TRUE);

		$matchStartTime= date("H:i", strtotime($this->input->post('matchStartTime',TRUE)));//convert to 24 hr
		$matchOpponents=$this->input->post('matchOpponents',TRUE);
		$matchLevel=$this->input->post('matchLevel',TRUE);

		$playerList=$this->input->post('playerList[]',TRUE);

		$match_details=array('match_game_id'=>$tournamentId,'match_date'=>$matchDate,'match_start_time'=>$matchStartTime,'match_opponents'=>$matchOpponents,'match_venue'=>$matchVenue,'match_level'=>$matchLevel);

		if(!empty($playerList)){
			//create array of players list to be inserted to a different table once the match details are added successfully
			$sessdata=array();
		    $sessdata = array('playerList' =>$playerList); 
		    $this->session->set_userdata($sessdata);

		    $result=$this->coachmodel->newTournMatch($match_details);
		    if(!$result)
				{
					$feedback = array('edit'=>'','error' => "Failed to add match",'success' => "");
					$this->session->set_flashdata('msg',$feedback);
	               redirect(base_url(('coach/tournmatches')));
				}else{
						$tournMatchId=$result;//auto id of the just inserted row. this will be used to undo/delete the record if players insertion fails.
						$playInfo=array();
					     foreach($playerList as $playerId ) /*loop through and get individual player Ids*/
				            {
				                $playInfo[]=array('match_id'=>$tournMatchId,'match_player_id'=>$playerId);

				                //pass array of data to model for saving
				                // $success=$this->model->tournMatchPlayers($playInfo);
				            }
					         	$success=$this->coachmodel->tournMatchPlayers($playInfo);
					         	if($success){
					                	$feedback = array('edit'=>'','error' => "",'success' => "Match successfully added");
										$this->session->set_flashdata('msg',$feedback);
					                   redirect(base_url(('coach/tournmatches')));
					               }else 
										{
											//delete last inserted match as a rollback
											$delresult=$this->coachmodel->deleteTournMatch($tournMatchId);
											if($delresult)
												{
													$feedback = array('edit'=>'','error' => "Failed to add match",'success' => "");
													$this->session->set_flashdata('msg',$feedback);
								                   	redirect(base_url(('coach/tournmatches')));
								                 }else{
								                 	$feedback = array('edit'=>'','error' => "Failed to add match. Only match details added",'success' => "");
													$this->session->set_flashdata('msg',$feedback);
								                 }
										}

						
					}

		}
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}


}

//More about hockey match
public function hockeymatchdetails()
{
	if($this->session->userdata('coach_login'))
	{
		$hmsId=$this->input->post('hmsId',TRUE);
		$teamId=$this->session->userdata('coachSportID');
		$list['hmatches']=$this->coachmodel->hockey_match($teamId,$hmsId);
		$this->load->view('coaches/hockey/hockey_match_more',$list);
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}


}
//record new hockey match 
public function newtournament()
{
	if($this->session->userdata('coach_login'))
	{
		$sportId=$this->session->userdata('coachSportID');//from session
		$tournamentTitle=$this->input->post('tournamentTitle',TRUE);
		$startDate=$this->input->post('startDate',TRUE);
		$endDate=$this->input->post('endDate',TRUE);
		$teamCategory=$this->input->post('teamCategory',TRUE);
		$matchTypeId=$this->input->post('matchTypeId',TRUE);
		$dateRecorded= date("Y-m-d"); 

		$data = $this->db->query("SELECT team_auto_id FROM teams WHERE team_sport_id='$sportId' AND team_category='$teamCategory' LIMIT 1")->row();
		$teamId=$data->team_auto_id;
		//dynamically create functions to redirect to depending on coach sport
		$functionName=strtolower($teamCategory).'tournaments';

		$tournamentdetails=array('game_sport_auto_id'=>$sportId,'game_team'=>$teamId,'game_match_type'=>$matchTypeId,'game_title'=>$tournamentTitle,'game_start_date'=>$startDate,'game_end_date'=>$endDate,'game_date_recorded'=>$dateRecorded);

			$result=$this->coachmodel->new_tournament($tournamentdetails);
				if($result)
					{
						$feedback = array('edit'=>'','error' => "",'success' => "Tournament added");
						$this->session->set_flashdata('msg',$feedback);
	                   redirect(base_url(('coach/'.$functionName)));
					}else 
						{
							$feedback = array('edit'=>'','error' => "Failed to add tournament",'success' => "");
							$this->session->set_flashdata('msg',$feedback);
		                   redirect(base_url(('coach/'.$functionName)));
						}
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}
//new hockey  league score input page
public function hkleaguesheet()
{
	if($this->session->userdata('coach_login'))
	{
		// $hmsId=$this->input->post('hmsId',TRUE);
		// $teamId=$this->session->userdata('coachSportID');
		// $list['hmatches']=$this->coachmodel->hockey_match($teamId,$hmsId);
		$sportId=$this->session->userdata('coachSportID');
		$list['players']=$this->coachmodel->activePlayersList($sportId);
		$this->load->view('coaches/hockey/leaguesheet',$list);
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}

}

//new  tournament score input page
public function tournamentscoresheet()
{
	if($this->session->userdata('coach_login'))
	{
		$sportName=$this->session->userdata('coachSportName');//from login session
		
		$matchId=$this->input->post('matchId',TRUE);
		
		$matchDetails=$this->input->post('matchDetails',TRUE);
		if(isset ($matchId) && strlen($matchId) && isset($matchDetails) && strlen($matchDetails))
			{
				// set session for tournament id
				$sessdata=array();
			    $sessdata = array('tournamentMatchId' =>$matchId,'matchDetails'=>$matchDetails); 
			    $this->session->set_userdata($sessdata);

				$list['players']=$this->coachmodel->getMatchPlayers($matchId);
				$link_to_view_per_sport=strtolower($sportName).'/'.strtolower($sportName).'scoresheet';
				
				$this->load->view('coaches/'.$link_to_view_per_sport,$list);
			}else{
					$matchId=$this->session->userdata('tournamentMatchId');//from session set above
					$list['players']=$this->coachmodel->getMatchPlayers($matchId);
					$link_to_view_per_sport=strtolower($sportName).'/'.strtolower($sportName).'scoresheet';
					$this->load->view('coaches/'.$link_to_view_per_sport,$list);
			}
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}

//saving new hockey score
public function newhockeyscore()
{
	if($this->session->userdata('coach_login'))
	{
		$matchId=$this->session->userdata('tournamentMatchId');//from session created on loading score sheet page
		$playerId=$this->input->post('playerId',TRUE);
		$item=$this->input->post('item',TRUE);//score_time or green_card or yellow_card or red_card

	    $time = date("H:i:s"); 


		if(isset($playerId) && strlen($playerId) && isset($item) && strlen($item) && isset($matchId) && strlen($matchId) ){
			$scoreDetails=array('player_id'=>$playerId,'match_id'=>$matchId,$item=>$time);
			$result=$this->coachmodel->newHockeyScore($scoreDetails);
			if($result)
				{
					echo json_encode("success");
				}else 
					{
						echo json_encode('fail');
					}
		}
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
	
}
public function newhockeyopponentscore()
{
	if($this->session->userdata('coach_login'))
	{
		$matchId=$this->input->post('matchId',TRUE);
		$matchEndTime= date("H:i", strtotime($this->input->post('matchEndTime',TRUE)));//convert to 24 hr
		$matchOpponentScore=$this->input->post('opponentScore',TRUE);

		if(isset($matchId) && strlen($matchId) && isset($matchEndTime) && strlen($matchEndTime) ){
			$opponentScoreDetails=array('match_opponents_score'=>$matchOpponentScore,'match_end_time'=>$matchEndTime);
			$result=$this->coachmodel->newHockeyOpponentScore($opponentScoreDetails,$matchId);
			if($result)
				{
					$feedback = array('edit'=>'','error' => "",'success' => "Opponent score added");
					$this->session->set_flashdata('msg',$feedback);
	               redirect(base_url(('coach/tournmatches')));
				}else{
						$feedback = array('edit'=>'','error' => "Opponent score not added",'success' => "");
						$this->session->set_flashdata('msg',$feedback);
		               redirect(base_url(('coach/tournmatches')));
				}
		}
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
	
}

//get hockey match score
public function hockeymatchscore()
{
	if($this->session->userdata('coach_login'))
	{
		$matchId=$this->input->post('pid',TRUE);
		$list =$this->coachmodel->getHockeyMatchScores($matchId);
		$data = array();
		$count=0;
		foreach ($list as $score) 
		    {
		    	$count=$count+1;
		        
		    }
		echo json_encode($count);//data should be a plain array...
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}

}
//get hockey match green cards
public function hockeygreen()
{
	if($this->session->userdata('coach_login'))
	{
		$tournamentMatchId=$this->input->post('pid',TRUE);
		$list =$this->coachmodel->getMatchGreenCards($tournamentMatchId);
		$data = array();
		$count=0;
		foreach ($list as $card) 
		    {
		    	$count=$count+1;
		        
		    }
		echo json_encode($count);//data should be a plain array...
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}
//get hockey match yellow cards
public function hockeyyellow()
{
	if($this->session->userdata('coach_login'))
	{
		$tournamentMatchId=$this->input->post('pid',TRUE);
		$list =$this->coachmodel->getMatchYellowCards($tournamentMatchId);
		$data = array();
		$count=0;
		foreach ($list as $card) 
		    {
		    	$count=$count+1;
		        
		    }
		echo json_encode($count);//data should be a plain array...
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}
//get hockey match red cards
public function hockeyred()
{
	if($this->session->userdata('coach_login'))
	{
		$tournamentMatchId=$this->input->post('pid',TRUE);
		$list =$this->coachmodel->getMatchRedCards($tournamentMatchId);
		$data = array();
		$count=0;
		foreach ($list as $card) 
		    {
		    	$count=$count+1;
		        
		    }
		echo json_encode($count);//data should be a plain array...
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}
//get score for upda
public function getScore()
{
	if($this->session->userdata('coach_login'))
	{
		$hmsId=$this->input->post('hmsid');
		$scoreLevelId=$this->input->post('scorelevelid');
		$info=array();
		if($scoreLevelId=='1')
			{
				$data =$this->coachmodel->getPreScore($hmsId);
				foreach ($data as $dat) 
			        {
			            $info= array('score'=>$dat['hkm_preliminary_scores']); 
			        }
	    		echo json_encode($info);
			}else if($scoreLevelId=='2')
				{
					$data =$this->coachmodel->getQuarterScore($hmsId);
					foreach ($data as $dat) 
				        {
				            $info= array('score'=>$dat['hkm_quarters']); 
				        }
	    			echo json_encode($info);
				}else if($scoreLevelId=='3')
					{
						$data =$this->coachmodel->getSemiScore($hmsId);
						foreach ($data as $dat) 
					        {
					            $info= array('score'=>$dat['hkm_semis']); 
					        }
		    			echo json_encode($info);
					}else if($scoreLevelId=='4')
						{
							$data =$this->coachmodel->getFinalScore($hmsId);
							foreach ($data as $dat) 
						        {
						            $info= array('score'=>$dat['hkm_finals']); 
						        }
			    			echo json_encode($info);
						}else if($scoreLevelId==''){
									$info= array('score'=>"");
									echo json_encode($info);
								}
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}

}

       
//load page to add hockey game summary
public function hoktournsummary()
{
	if($this->session->userdata('coach_login'))
	{
		$hmsId=$this->input->post('hmsId',TRUE);
		$teamId=$this->session->userdata('coachSportID');
		$list['hmatches']=$this->coachmodel->hockey_match($teamId,$hmsId);
		$this->load->view('coaches/hockey/hockey_summary',$list);
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}

		// $scorers=$this->input->post('scorers',TRUE);
		// $refComments=$this->input->post('refComments',TRUE);
		// $summary=$this->input->post('summary',TRUE);

}
public function addhoksummary()
{
	if($this->session->userdata('coach_login'))
	{
		$hmsId=$this->input->post('hmsId',TRUE);
		$scorers=str_replace("@","",$this->input->post('scorers',TRUE));
		$refComments=$this->input->post('refComments',TRUE);
		$summary=$this->input->post('summary',TRUE);

		$summarydetails=array('hkm_scorers'=>$scorers,'hkm_ref_comments'=>$refComments,'hkm_summary'=>$summary);

			$result=$this->coachmodel->new_hockey_summary($summarydetails,$hmsId);
				if($result)
					{
						$feedback = array('edit'=>'','error' => "",'success' => "Tournament summary added ");
						$this->session->set_flashdata('msg',$feedback);
	                   redirect(base_url(('coach/hockeytournaments')));
					}else 
						{
							$feedback = array('edit'=>'','error' => "Failed to add tournament",'success' => "");
							$this->session->set_flashdata('msg',$feedback);
		                   redirect(base_url(('coach/hockeytournaments')));
						}
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}

}

//load page to add hockey league
public function addhkleague()
{
	if($this->session->userdata('coach_login'))
	{
		$sportId=$this->session->userdata('coachSportID');
		$list['players']=$this->coachmodel->activePlayersList($sportId);
		$this->load->view('coaches/hockey/hockey_league',$list);
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}
public function newTraining()
{
	if($this->session->userdata('coach_login'))
	{
		$data=$this->input->post('selected[]');
		$dateOfTraining = date("Y-m-d");//today's date
		$yearOfTraining = date("Y");//current year 
		$sportId=$this->session->userdata('coachSportID');

		if ($data=="" )
	        {
	            $message['noselection'][]=  "You did not make any selection";
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
						$message['exists'][]=  "Attendance for today has been already added";
				            echo json_encode($message);
					}else {
							
				               	foreach($_POST as $posted )/*loop through and create an array of the data*/ 
				                   {
				                    if(is_array( $posted ) ) /*if is array created*/
				                        {
				                            foreach( $posted as $record ) /*loop through and get individual items*/
				                                {
				                                    $attendanceinfo=array('training_date'=>$dateOfTraining,'training_year'=>$yearOfTraining,'sport_id'=>$sportId,'player_auto_id'=>$record['playerPID'],'attendance_state'=>$record['status']);
				                                    $result=$this->coachmodel->trainingAttendance($attendanceinfo);
				                                }
				                                if ($result) 
				                                    {
				                                        $message['successful'][]=  "Attendance  Added";
				                                   
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
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}



	//coach remarks view
public function crmks_view()
{
	if($this->session->userdata('coach_login'))
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
	            	$record['injury_management']=$this->coachmodel->get_injury_record($this->input->get('injmid', TRUE));
					$this->load->view('coaches/coach_remarks',$record);
	            }else 
		            {
		            	$feedback = array('error' => "Remarks exist. Please edit instead",'success' => "");
						$this->session->set_flashdata('msg',$feedback);
			            redirect(base_url(('coach/cim_view')));
		            }
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}
//downloads
//download admin profile photo
public function download_playerphoto($filename = NULL) 
{
	if($this->session->userdata('coach_login'))
	{
	    // load download helder
        $this->load->helper('download');
        // read file contents
        $data = file_get_contents('uploads/profile_photos/players/'.$filename);
        force_download($filename, $data);
    }else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}
 //download of player passport/travel_document image
public function download_playerpspt($filename = NULL) 
{
    if($this->session->userdata('coach_login'))
	{
      // load download helder
        $this->load->helper('download');
        // read file contents
        $data = file_get_contents('uploads/travel_documents/'.$filename);
        force_download($filename, $data);
    }else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}

}

public function download_coach_report($filename = NULL) 
{
    if($this->session->userdata('coach_login'))
	{
      // load download helder
        $this->load->helper('download');
        // read file contents
        $data = file_get_contents('uploads/coach_reports/'.$filename);
        force_download($filename, $data);
    }else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}
//reports uploads (sport specific reports) and view page
public function sportspecificrpts()
{
	if($this->session->userdata('coach_login'))
	{
		$sportId=$this->session->userdata('coachSportID');
		$list['sportspecificrpts']=$this->coachmodel->sportSpecificReports($sportId);
		$this->load->view('coaches/sport_specific_reports',$list);
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}
//reports uploads (sport general reports) and view page
public function sportsgeneralrpts()
{
	if($this->session->userdata('coach_login'))
	{
		$list['sportsgeneralrpts']=$this->coachmodel->sportGeneralReports();
		$this->load->view('coaches/sport_general_reports',$list);
	}else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}
}

// public function newhockeyreport()
// {

	// $descriptiveName=$this->input->post('descriptiveName', TRUE);
	// $report=$this->input->post('report', TRUE);
	// $contentDescription=$this->input->post('contentDescription', TRUE);

// 	$config['upload_path']          = 'uploads/coach_reports';
// 	$config['allowed_types']='pdf';
// 	$config['max_size']             = 700;
// 	$config['max_width']            = 700;
// 	$config['max_height']           = 700;
// 	$config['file_name']			=md5(time().$passportNumber);
// 	$config['overwrite']           = true;
// 	$config['file_ext_tolower']     = true;

// 	$this->load->library('upload', $config);



// }
public function newcoachreport()
{
    if($this->session->userdata('coach_login'))
	{
		$sportId=$this->session->userdata('coachSportID');
    	$descriptiveName=$this->input->post('descriptiveName', TRUE);
		$contentDescription=$this->input->post('contentDescription', TRUE);
		$category=$this->input->post('category', TRUE);

	if(isset($descriptiveName) && strlen($descriptiveName) && isset($contentDescription) && strlen($contentDescription) && isset($category) && strlen($category))
		{
	        		$config['upload_path'] = 'uploads/coach_reports/';
                    // $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|doc|xml|docx|GIF|JPG|PNG|JPEG|PDF|DOC|XML|DOCX|xls|xlsx';
                    $config['allowed_types']        = 'pdf|PDF|docx|doc|DOCX|DOC|xls|xlsx';
                    // $config['max_size']             = 4096;
                    // $config['max_width']            = 1024;
                    // $config['max_height']           = 768;
					$config['file_name']			=md5(time().$descriptiveName);
                    $config['overwrite']           = true;
                    $config['file_ext_tolower']     = true;

                    $this->load->library('upload', $config);
                    $file="report";

                        //confirm upload success
						if (!$this->upload->do_upload($file))
					    	{   
					    		$feedback = array('error' => $this->upload->display_errors(),'success' => "");
								$this->session->set_flashdata('msg',$feedback);
					       		
									$this->session->set_flashdata('msg',$feedback);
								if($category=="1"){
									redirect(base_url(('coach/sportspecificrpts')));
								}else if($category=="0"){redirect(base_url(('coach/sportsgeneralrpts')));}

					    	}else{
					    			$data =$this->upload->data(); //load data to page
						    		$report_details =array('report_file_name'=>$config['file_name'].$data['file_ext'],'report_descriptive_name'=>$descriptiveName,'report_date_uploaded'=>date('Y-m-d'),'report_sport_id'=>$sportId,'specific_1_general_0'=>$category,'file_ext'=>$data['file_ext']);

									$result=$this->coachmodel->newCoachReport($report_details);

									if($result)
										{
											$feedback = array('error' => "",'success' => "Report added successfully");
											$this->session->set_flashdata('msg',$feedback);
							           		if($category=="1"){
												redirect(base_url(('coach/sportspecificrpts')));
											}else if($category=="0"){redirect(base_url(('coach/sportsgeneralrpts')));}
										}else 
											{
												$feedback = array('error' => "Report not added",'success' => "");
												$this->session->set_flashdata('msg',$feedback);
							               		if($category=="1"){
												redirect(base_url(('coach/sportspecificrpts')));
													}else if($category=="0"){redirect(base_url(('coach/sportsgeneralrpts')));}
											}
					    	}
		}else{
			$feedback = array('error' => "Some field is missing",'success' => "");
			$this->session->set_flashdata('msg',$feedback);
				if($category=="1"){
				redirect(base_url(('coach/sportspecificrpts')));
					}else if($category=="0"){redirect(base_url(('coach/sportsgeneralrpts')));}
		}
				

            
    }else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}

 
}
public function playeryfc()
{
	if($this->session->userdata('coach_login'))
	{
		$sportId=$this->session->userdata('coachSportID');
		$list['players']=$this->coachmodel->activePlayersAndYFC($sportId);
		$this->load->view('coaches/playeryfc',$list);
	}else{
			$feedback = array('error' => "Your session has expired. Login to proceed.");
			$this->session->set_flashdata('msg',$feedback);
		    	redirect(base_url(('coach')));
	}
}
public function addplayeryfc()
{
	if($this->session->userdata('coach_login'))
	{
		$player_auto_id=$this->input->post('player_auto_id',TRUE);
		$playerName=$this->input->post('playerName',TRUE);

		if(isset ($player_auto_id) && strlen($player_auto_id) && isset($playerName) && strlen($playerName)){
			$sessdata = array('pst_player_id'=>$player_auto_id,'pst_player_name'=>$playerName);
			$this->session->set_userdata($sessdata);
			$this->load->view('coaches/addplayeryfc');
		}else{
				$this->load->view('coaches/addplayeryfc');
		}
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
		    redirect(base_url(('coach')));
		}
}
public function newplayeryfc() 
{
	if($this->session->userdata('coach_login'))
	{
		$player_auto_id=$this->input->post('player_auto_id', TRUE);
		$issue_date=$this->input->post('issue_date', TRUE);
		$expiry_date=$this->input->post('expiry_date', TRUE);

		$config['upload_path']          = 'uploads/YFCard';
		$config['allowed_types']='jpg|png|jpeg|JPG|PNG|JPEG';
		$config['max_size']             = 700;
		$config['max_width']            = 700;
		$config['max_height']           = 700;
		$config['file_name']			=md5(time().$player_auto_id);
		$config['overwrite']           = true;
		$config['file_ext_tolower']     = true;

		$this->load->library('upload', $config);

		if(isset($player_auto_id) && strlen($player_auto_id) && isset($issue_date) && strlen($issue_date) && isset($expiry_date) && strlen($expiry_date))
			{
			    $this->db->select('*');
				$this->db->from('yellowfever_card');
				$this->db->where('player_auto_id',$player_auto_id);
				$query = $this->db->get();
		        $num=$query->num_rows(); 

		        if($num>0)
		            {
		            	$feedback = array('error' => "This player's yellow fever card exists",'success' => "");
						$this->session->set_flashdata('msg',$feedback);
			        	redirect(base_url(('coach/playeryfc')));
		        	}else{
		        				
			           		//if no photo has been selected  uploaded
			           		if (empty($_FILES['photo']['name'])) 
							  	{
						           	$feedback = array('error' => "Please select yellow fever card photo file",'success' => "");
									$this->session->set_flashdata('msg',$feedback);
						        	redirect(base_url(('coach/addplayeryfc')));
						        }else{
							  			//confirm upload success
										if (!$this->upload->do_upload('photo'))
									    	{   
									        	$feedback = array('error' => $this->upload->display_errors(),'success' => "");
												$this->session->set_flashdata('msg',$feedback);
									       		redirect(base_url(('coach/addplayeryfc')));
									    	}else{
													$data =$this->upload->data(); //load data to page
										    		$card_details =array('player_auto_id'=>$player_auto_id,'issue_date'=>$issue_date,'expiry_date'=>$expiry_date,'card_photo'=>$config['file_name'].$data['file_ext']);

														$result=$this->coachmodel->addPlayeryfc($card_details);

														if($result)
															{
																$feedback = array('error' => "",'success' => "Yellow Fever Card for ".$this->session->userdata('pst_player_name')." added.");
																$this->session->set_flashdata('msg',$feedback);
												           		redirect(base_url(('coach/playeryfc')));
															}else 
																{
																	$feedback = array('error' => "Yellow Fever Card not added",'success' => "");
																	$this->session->set_flashdata('msg',$feedback);
												               		redirect(base_url(('coach/playeryfc')));
																}

											    }
						   			}
						}
			}else{
					$feedback = array('error' => "A required field is missing",'success' => "");
					$this->session->set_flashdata('msg',$feedback);
		        	redirect(base_url(('coach/addplayeryfc')));
			}
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
			   redirect(base_url(('coach')));
		}
				
		
}
public function download_playeryfc($filename = NULL) 
{
    if($this->session->userdata('coach_login'))
	{
      // load download helder
        $this->load->helper('download');
        // read file contents
        $data = file_get_contents('uploads/YFCard/'.$filename);
        force_download($filename, $data);
    }else{
				$feedback = array('error' => "Your session has expired. Login to proceed.");
				$this->session->set_flashdata('msg',$feedback);
		          redirect(base_url(('coach')));
		}

}
public function editplayeryfc()
{
	if($this->session->userdata('coach_login'))
	{
		$card_auto_id=$this->input->post('card_auto_id',TRUE);
		$playerName=$this->input->post('playerName',TRUE);

		if(isset ($card_auto_id) && strlen($card_auto_id) && isset($playerName) && strlen($playerName))
		{
			$sessdata = array('pst_player_id'=>$card_auto_id,'pst_player_name'=>$playerName);
			$this->session->set_userdata($sessdata);

			$list['card_details']=$this->coachmodel->getyfcDetails($card_auto_id);

			$this->load->view('coaches/edit_yfc',$list);
		}else{
				$card_auto_id=$this->session->userdata('card_auto_id');//use session if web browser hard refreshed
				$list['card_details']=$this->coachmodel->getyfcDetails($card_auto_id);
				$this->load->view('coaches/edit_yfc',$list);
			}
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
		    redirect(base_url(('coach')));
		}

}
//
public function updateplayeryfc()
{
	if($this->session->userdata('coach_login'))
	{
    	$card_auto_id=$this->input->post('card_auto_id',TRUE);
		//get initial file name..this file should be deleted and a new one inserted on update
		$initFile=$this->input->post('initFile',TRUE);

		$player_auto_id=$this->input->post('player_auto_id', TRUE);
		$issue_date=$this->input->post('issue_date', TRUE);
		$expiry_date=$this->input->post('expiry_date', TRUE);


		$config['upload_path']          = 'uploads/YFCard';
		$config['allowed_types']='jpg|png|jpeg|JPG|PNG|JPEG';
		$config['max_size']             = 700;
		$config['max_width']            = 700;
		$config['max_height']           = 700;
		$config['file_name']			=md5(time().$player_auto_id);
		$config['overwrite']           = true;
		$config['file_ext_tolower']     = true;

		$this->load->library('upload', $config);

		if (empty($_FILES['photo']['name'])) 
		{
	    		$card_details =array('player_auto_id'=>$player_auto_id,'issue_date'=>$issue_date,'expiry_date'=>$expiry_date,);

				$result=$this->coachmodel->updateyfcNoPhoto($card_details,$card_auto_id);
				if($result)
				{
					$feedback = array('error' => "",'success' => "Passport updated");
					$this->session->set_flashdata('msg',$feedback);
		           redirect(base_url(('coach/playerpassports')));
				}else 
					{
						$feedback = array('error' => "No changes made ",'success' => "");
						$this->session->set_flashdata('msg',$feedback);
		               redirect(base_url(('coach/playerpassports')));
					}

		}else{ 

				if(!$this->upload->do_upload('photo'))
				{
					
					$card_details =array('player_auto_id'=>$player_auto_id,'issue_date'=>$issue_date,'expiry_date'=>$expiry_date,);

					$result=$this->coachmodel->updateyfcNoPhoto($card_details,$card_auto_id);
					if($result)
						{
							$feedback = array('error' => "",'success' => "<span style='color:#FFFF00'>Yellow Fever Card details updated. </span> However, ".$this->upload->display_errors());
							$this->session->set_flashdata('msg',$feedback);
				           redirect(base_url(('coach/playeryfc')));
						}else 
							{
								$feedback = array('error' => "No changes made  and, ".$this->upload->display_errors(),'success' => "");
								$this->session->set_flashdata('msg',$feedback);
				               redirect(base_url(('coach/playeryfc')));
							}
				}else{

					   	$data =$this->upload->data();//details of uploaded file

						$card_details =array('player_auto_id'=>$player_auto_id,'issue_date'=>$issue_date,'expiry_date'=>$expiry_date,'card_photo'=>$config['file_name'].$data['file_ext']);

						//new session of admin profile photo
	                    $this->session->set_userdata("card_photo",$config['file_name'].$data['file_ext']);

						$result=$this->coachmodel->updateyfc($card_details,$card_auto_id,$initFile);
						if($result)
							{
								$feedback = array('error' => "",'success' => "Yellow Fever Card info updated");
								$this->session->set_flashdata('msg',$feedback);
					           redirect(base_url(('coach/playeryfc')));
							}else 
								{
									$feedback = array('error' => "Failed to update ",'success' => "");
									$this->session->set_flashdata('msg',$feedback);
					               redirect(base_url(('coach/playeryfc')));
								}


				}

		}
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
			   redirect(base_url(('coach')));
			}

} 
public function playeryfcdetails()
{
	if($this->session->userdata('coach_login'))
	{
		$card_auto_id=$this->input->post('card_auto_id',TRUE);
		if(isset($card_auto_id))
		{
			//create a session to handle browser refresh i.e not lose posted passport id
			$sessdata = array('card_auto_id'=>$card_auto_id);
			$this->session->set_userdata($sessdata);

			$list['card_details']=$this->coachmodel->getyfcDetails($card_auto_id);
			$this->load->view('coaches/playeryfc_details',$list);

		}else {
				$card_auto_id=$this->session->userdata('card_auto_id');//use session if web browser hard refreshed
				$list['card_details']=$this->coachmodel->getyfcDetails($card_auto_id);
				$this->load->view('coaches/playeryfc_details',$list);
		}
	}else{
		$feedback = array('error' => "Your session has expired. Login to proceed.");
		$this->session->set_flashdata('msg',$feedback);
			   redirect(base_url(('coach')));
		}
}

}
