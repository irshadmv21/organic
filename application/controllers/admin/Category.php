<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

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
		$data['base_path']=base_url().'uploads/category/';
		$data['result'] = $this->common->get_categories();
		$this->load->view('admin/category/list',$data);
	}
	public function form(){

		$id = $this->uri->segment(3);
		$data['headding'] 	= 'Add Category';
		$data['categories'] = $this->common->get_table('or_categories','id,name',['parent_id'=>''],'id','DESC');
		
		if($id){
			$data['category']=$this->common->get_row('or_categories','*',['id'=>$id]);
			$data['headding'] = 'Edit Category';
		}
		$data['action']=base_url().'categories/save';
		$data['base_path']=base_url().'uploads/category/';
		$this->load->view('admin/category/form',$data);


	}
	public function save(){
		if($this->input->post()){
			 $post_data  = $this->input->post();
			 
			 if(isset($_POST['is_home']) && $_POST['is_home']=='Y'){
			 	$is_home='Y';
			 }else{
			 	$is_home='N';
			 }
			 $array_data = [
			 	'name' 				=> $post_data['name'],
			 	'parent_id' 		=> $post_data['parent_id'],
			 	'is_home'			=> $is_home,
			 	'status' 			=> $post_data['status'],
			 ];

			 if(isset($_FILES['image']['name'])){

			 	$image_result = $this->common->upload_file('./uploads/category/','image');
			 	
			 	if($image_result['status']=='success'){
			 		$array_data['image'] = $image_result['file_name'];
			 		$array_data['thumb'] = $image_result['thumb_name'];
			 	}
			 }
			 if($this->input->post('id')){
			 	$arr_where = ['id'=>$post_data['id']];
			 	$insert_id = $this->common->update_Details($array_data,'or_categories',$arr_where);
				$this->session->set_flashdata('success_msg','Successfully updated category');
			 	$json=['status'=>'success','message'=>'Successfully updated category'];
			 }else{
			 	if(!isset($_FILES['image']['name'])){
			 		$json = ['status'=>'error','message'=>'Please choose a image file'];
			 		$this->session->set_flashdata('error_msg','Successfully updated category');
			 	}else{
					$insert_id=$this->common->Insert_Data('or_categories',$array_data);
					$this->session->set_flashdata('success_msg','Successfully inserted category');
					$json = ['status'=>'success','message'=>'Successfully inserted category'];
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
			$arr_update_where=['parent_id'=>$_POST['id']];
			$array_data=['parent_id'=>0];
			$insert_id = $this->common->update_Details($array_data,'or_categories',$arr_update_where);
			$arr_where=['id'=>$_POST['id']];
			$this->common->Delete_data('or_categories',$arr_where);
			$json = ['status'=>'success','message'=>'Successfully deleted data'];
		}else{
			$json = ['status'=>'error','message'=>'Something went wrong...!'];
		}
		echo json_encode($json);
	}
}