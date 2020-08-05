<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {

	
	
	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata('session_data')){
			$this->session->set_userdata('error_msg', INVALID_AUTH);
			header("Location: login");
		}else{
			$this->session->unset_userdata('error_msg');
		}


	}
	public function index()
	{
		$data['base_path']=base_url().'uploads/customers/';
		$data['result'] = $this->common->get_table('or_customers','id,first_name,last_name,email,phone,thumb,status,date_added',[],'id','DESC');
		$this->load->view('admin/customers/list',$data);
	}
	public function form(){

		$banner_id = $this->uri->segment(3);
		$data['headding'] = 'Add customer';
		if($banner_id){
			$data['customer']=$this->common->get_row('or_customers','*',['id'=>$banner_id]);
			$data['headding'] = 'Edit customer';
		}
		$data['action']=base_url().'customers/save';
		$data['base_path']=base_url().'uploads/customers/';
		$this->load->view('admin/customers/form',$data);


	}
	public function save(){
		if($this->input->post()){
			 $post_data  = $this->input->post();
			 $array_data = [
			 	'first_name' 	=> $post_data['first_name'],
			 	'last_name' 	=> $post_data['last_name'],
			 	'email' 		=> $post_data['email'],
			 	'phone' 		=> $post_data['phone'],
			 	'status' 		=> $post_data['status'],
			 ];

			 if(isset($_FILES['image']['name'])){

			 	$image_result = $this->common->upload_file('./uploads/customers/','image');
			 	
			 	if($image_result['status']=='success'){
			 		$array_data['image'] = $image_result['file_name'];
			 		$array_data['thumb'] = $image_result['thumb_name'];
			 	}
			 }
			 if($post_data['password'] !=""){
			 	$array_data['password']= md5($post_data['password']);
			 }

			 if($this->input->post('id')){
			 	$arr_where = ['id'=>$post_data['id']];
			 	$insert_id = $this->common->update_Details($array_data,'or_customers',$arr_where);
				$this->session->set_flashdata('success_msg','Successfully updated customer');
			 	$json=['status'=>'success','message'=>'Successfully updated customer'];
			 }else{
			 	if(!isset($_FILES['image']['name'])){
			 		$json = ['status'=>'error','message'=>'Please choose a image file'];
			 		echo json_encode($json);exit;
			 	}
			 	if($post_data['password'] ==""){
			 		$json = ['status'=>'error','message'=>'Password is requierd'];
			 		echo json_encode($json);exit;
			 	}
				$insert_id=$this->common->Insert_Data('or_customers',$array_data);
				$this->session->set_flashdata('success_msg','Successfully inserted customer');
				$json = ['status'=>'success','message'=>'Successfully inserted customer'];
			 }
		}else{
			$this->session->set_flashdata('error_msg','Invalid Access !');
			$json = ['status'=>'error','message'=>'Invalid Access !'];
		}
		echo json_encode($json);
	}
	public function delete(){
		if(isset($_POST['id'])){
			$arr_where=['id'=>$_POST['id']];
			$this->common->Delete_data('or_customers',$arr_where);
			$json = ['status'=>'success','message'=>'Successfully deleted data'];
		}else{
			$json = ['status'=>'error','message'=>'Something went wrong...!'];
		}
		echo json_encode($json);
	}
	public function checkEmail(){
	    $id=$_POST['id'];
		if($_POST['email']){
			$user_details=$this->common->get_row('or_customers','id',['email'=>$_POST['email'],'id !='=>$id]);
			if(empty($user_details)){
				echo 'true';
			}else{
				echo 'false';
			} 
		}else{
			echo 'false';
		}
		
	}
}