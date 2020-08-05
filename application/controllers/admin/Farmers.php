<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Farmers extends CI_Controller {

	
	
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
		$data['base_path']=base_url().'uploads/farmers/';
		$data['result'] = $this->common->get_table('or_farmers','id,name,thumb,product_code,status,date_added',[],'id','DESC');
		$this->load->view('admin/farmers/list',$data);
	}
	public function form(){

		$banner_id = $this->uri->segment(3);
		$data['headding'] = 'Add farmers';
		if($banner_id){
			$data['farmer']=$this->common->get_row('or_farmers','*',['id'=>$banner_id]);
			$data['headding'] = 'Edit farmers';
		}
		$data['action']=base_url().'farmers/save';
		$data['base_path']=base_url().'uploads/farmers/';
		$this->load->view('admin/farmers/form',$data);


	}
	public function save(){
		if($this->input->post()){
			 $post_data  = $this->input->post();
			 $array_data = [
			 	'name' 				=> $post_data['name'],
			 	'product_code' 		=> $post_data['product_code'],
			 	'status' 			=> $post_data['status'],
			 ];

			 if(isset($_FILES['image']['name'])){

			 	$image_result = $this->common->upload_file('./uploads/farmers/','image');
			 	
			 	if($image_result['status']=='success'){
			 		$array_data['image'] = $image_result['file_name'];
			 		$array_data['thumb'] = $image_result['thumb_name'];
			 	}
			 }
			 if($this->input->post('id')){
			 	$arr_where = ['id'=>$post_data['id']];
			 	$insert_id = $this->common->update_Details($array_data,'or_farmers',$arr_where);
				$this->session->set_flashdata('success_msg','Successfully updated banner');
			 	$json=['status'=>'success','message'=>'Successfully updated farmer data'];
			 }else{
			 	if(!isset($_FILES['image']['name'])){
			 		$json = ['status'=>'error','message'=>'Please choose a image file'];
			 		$this->session->set_flashdata('error_msg','Please choose a image file');
			 	}else{
					$insert_id=$this->common->Insert_Data('or_farmers',$array_data);
					$this->session->set_flashdata('success_msg','Successfully inserted banner');
					$json = ['status'=>'success','message'=>'Successfully inserted banner'];
			 	}
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
			$this->common->Delete_data('or_farmers',$arr_where);
			$json = ['status'=>'success','message'=>'Successfully deleted data'];
		}else{
			$json = ['status'=>'error','message'=>'Something went wrong...!'];
		}
		echo json_encode($json);
	}
}