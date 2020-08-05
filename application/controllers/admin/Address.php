<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Address extends CI_Controller {

	
	
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
		$user_id = $this->uri->segment(3);
		$data['result'] = $this->common->get_table('or_address','*',['customer_id'=>$user_id],'id','DESC');
		$data['customer'] = $this->common->get_row('or_customers','first_name,id',['id'=>$user_id]);

		$this->load->view('admin/address/list',$data);
	}
	public function form(){
		$data['postcodes'] 	= $this->common->get_table('or_postcodes','name,id,postcode',['status'=>'A'],'id','DESC');
		$data['headding'] 	= 'Add Address';
		$url = $this->uri->segment(3);
		if($url == 'edit'){
			$address_id 		= $this->uri->segment(4);
			$data['address'] 	= $this->common->get_row('or_address','*',['id'=>$address_id]);
			$data['headding'] 	= 'Edit Address';
			$data['user_id']	= $data['address']['customer_id'];
		}else{
			$user_id = $this->uri->segment(4);
			$data['user_id']	= $user_id;
		}

		$data['action'] = base_url().'customers/address/save';
		$this->load->view('admin/address/form',$data);


	}
	public function save(){
		if($this->input->post()){
			 $post_data  = $this->input->post();
			 $array_data = [
			 	'customer_id' 	=> $post_data['customer_id'],
			 	'first_name' 	=> $post_data['first_name'],
			 	'last_name' 	=> $post_data['last_name'],
			 	'email' 		=> $post_data['email'],
			 	'phone' 		=> $post_data['phone'],
			 	'address_1' 	=> $post_data['address_1'],
			 	'address_2' 	=> $post_data['address_2'],
			 	'landmark' 		=> $post_data['landmark'],
			 	'city' 			=> $post_data['city'],
			 	'district' 		=> $post_data['district'],
			 	'postcode' 		=> $post_data['postcode'],
			 	'status' 		=> $post_data['status'],
			 ];

			 // if(isset($post_data['is_default'])){
			 // 	$array_data['is_default'] = 'Y';
			 // }else{
			 // 	$array_data['is_default'] = 'N';
			 // }

			 if($this->input->post('id')){
			 	$arr_where = ['id'=>$post_data['id']];
			 	$insert_id = $this->common->update_Details($array_data,'or_address',$arr_where);
				$this->session->set_flashdata('success_msg','Successfully updated Address');
			 	$json=['status'=>'success','message'=>'Successfully updated Address'];
			 }else{
				$insert_id=$this->common->Insert_Data('or_address',$array_data);
				$this->session->set_flashdata('success_msg','Successfully inserted Address');
				$json = ['status'=>'success','message'=>'Successfully inserted Address'];
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
			$this->common->Delete_data('or_address',$arr_where);
			$json = ['status'=>'success','message'=>'Successfully deleted data'];
		}else{
			$json = ['status'=>'error','message'=>'Something went wrong...!'];
		}
		echo json_encode($json);
	}
}