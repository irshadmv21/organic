<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('session_data')){
			//$this->session->set_userdata('error_msg', INVALID_AUTH);
			header("Location: ");
		}else{
			if(isset($_SESSION['redirect_url'])){
				$url=$_SESSION['redirect_url'];
			}else{
				$url='dashboard';
			}
			header("Location: ".$url);
			$this->session->unset_userdata('error_msg');
		}

	}
	public function index()
	{
		

		if(isset($_POST) && $_POST != []){
			$username=$_POST['username'];
			$password=md5($_POST['password']);
			$get_user=$this->common->get_row('or_admin','first_name,last_name,email,id',['email'=>$username,'password'=>$password]);
			if($get_user){
				$this->session->unset_userdata('session_data');
				$data = array(
					'login_id'		=>	$get_user['id'],
					'username'		=>	$get_user['email'],
					'name'			=>	$get_user['first_name']." ".$get_user['last_name'],
					'mr_sess_created'	=>	TRUE
				);
				$this->session->set_userdata('session_data', $data);
				if(isset($_SESSION['redirect_url'])){
					$url=$_SESSION['redirect_url'];
				}else{
					$url='dashboard';
				}
				
				$json=['status'=>'success','message'=>'successfully logged','redirect_ulr'=>$url];
	            echo json_encode($json);
			}else{
				$json=['status'=>'error','message'=>'Invalid username or password'];
	            echo json_encode($json);
			}
		}else{

			$this->load->view('login');
		}
		
	}
	public function forgot(){

		if(isset($_POST) && $_POST['email']){
			$get_user=$this->common->get_row('or_admin','first_name,last_name,email,id',['email'=>$_POST['email']]);
			if(!empty($get_user)){
				$subject='REST PASSWORD';
				$data['password']=rand();
				$arr_data=['password'=>md5($data['password'])];
				$arr_where=['email'=>$_POST['email']];
				$this->common->update_Details($arr_data,'or_admin',$arr_where);
				$body=$this->load->view('forgot_template',$data,true);
				
				$this->common->send_mail($_POST['email'],$subject,$body);
				$json=['status'=>'success','message'=>'An email was sent to your account please check it'];
			}else{
				$json=['status'=>'error','message'=>'Invalid email-id'];
			}
		}else{
			$json=['status'=>'error','message'=>'Invalid access !'];
		}
		echo json_encode($json);
	}
	public function logout(){
		$this->session->unset_userdata('session_data');
		$this->session->unset_userdata('error_msg');
		redirect('login');
		
	}
}
