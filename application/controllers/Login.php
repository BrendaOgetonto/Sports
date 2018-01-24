<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 * @author Mokoro Stephen
	 */
	function __construct() 
	{
	    parent::__construct();
	    $this->load->model("LoginModel", "login");
	    // $this->load->model("MainModel", "mainmodel");
	}
	public function index()
	{
		$this->load->view('login');
	}

	public function lg()
	{
		//get submitted credentials
		$username=$this->input->post('username',TRUE);
	    $password=md5(trim($this->input->post('password',TRUE)));
	    //try login 
	    $dos = $this->login->validate_dos($username, $password);//admin
	    $coach = $this->login->validate_coach($username, $password);//coach
	    $physiothera = $this->login->validate_physiothera($username, $password);//physiotherapist
			if($dos) 
	        {
                //take the returned data and create a session for it (adminName and adminID). 
                foreach ($dos as $row)
                { 
                    $fullName=$row->admin_fname."&nbsp;".$row->admin_lname;
                    $userID=$row->staff_id;
                    $sessdata=array();
                    $sessdata = array('adminName' =>$fullName,'adminId'=>$userID,'admin_login'=>TRUE); 
                    $this->session->set_userdata($sessdata);
                            
                }
	                redirect('dos/coaches');
	   		} else if($coach)
	            {
	                foreach ($coach as $row)
	                { 
	                    $fullName=$row->coach_fname."&nbsp;".$row->coach_lname;
	                    $userID=$row->coach_staff_id;
	                    $coachSportID=$row->coach_sport_id;
	                    $coachSportName=$row->sport_name;
	                    $sessdata=array();
	                    $sessdata = array('coachName' =>$fullName,'coachId'=>$userID,'coach_login'=>TRUE,'coachSportID'=>$coachSportID,'coachSportName'=>$coachSportName); 
	                    $this->session->set_userdata($sessdata);
	                }
	                redirect('coach/dashboard');
	            } else if($physiothera)
	                    {
	                        foreach ($physiothera as $row)
	                        { 
	                            $fullName=$row->phyth_fname."&nbsp;".$row->phyth_lname;
	                            $userID=$row->phyth_staff_id;
	                            $sessdata=array();
	                            $sessdata = array('physioName' =>$fullName,'physioID'=>$userID,'physio_login'=>TRUE); 
	                            $this->session->set_userdata($sessdata);
	                                    
	                        }
	                        redirect('coach/injury_management');
	                    }else
	                            {
	                                
	                                $feedback = array('error' => "Wrong credentials. Please try again");
	                                $this->session->set_flashdata('msg',$feedback);
	                                redirect(base_url('login'));
	        	                }

	}

}
