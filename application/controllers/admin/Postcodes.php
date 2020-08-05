<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Postcodes extends CI_Controller {

	
	
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
		
		$data['result'] = $this->common->get_table('or_postcodes','id,name,postcode,status,date_added',[],'id','DESC');
		$this->load->view('admin/postcodes/list',$data);
	}
	public function form(){

		$banner_id = $this->uri->segment(3);
		$data['headding'] = 'Add postcode';
		if($banner_id){
			$data['postcode']=$this->common->get_row('or_postcodes','*',['id'=>$banner_id]);
			$data['headding'] = 'Edit postcode';
		}
		$data['action']=base_url().'postcodes/save';
		$this->load->view('admin/postcodes/form',$data);


	}
	public function save(){
		if($this->input->post()){
			 $post_data  = $this->input->post();
			 $array_data = [
			 	'name' 		=> $post_data['name'],
			 	'postcode' 	=> $post_data['postcode'],
			 	'status' 	=> $post_data['status'],
			 ];
			 if($this->input->post('id')){
			 	$arr_where = ['id'=>$post_data['id']];
			 	$insert_id = $this->common->update_Details($array_data,'or_postcodes',$arr_where);
				$this->session->set_flashdata('success_msg','Successfully updated postcode');
			 	$json=['status'=>'success','message'=>'Successfully updated banner'];
			 }else{
				$insert_id=$this->common->Insert_Data('or_postcodes',$array_data);
				$this->session->set_flashdata('success_msg','Successfully inserted postcode');
				$json = ['status'=>'success','message'=>'Successfully inserted postcode'];
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
			$this->common->Delete_data('or_banners',$arr_where);
			$json = ['status'=>'success','message'=>'Successfully deleted data'];
		}else{
			$json = ['status'=>'error','message'=>'Something went wrong...!'];
		}
		echo json_encode($json);
	}
	public function checkExist(){
	    $id=$_POST['id'];
		if($_POST['postcode']){
			$postcode=$this->common->get_row('or_postcodes','id',['postcode'=>$_POST['postcode'],'id !='=>$id]);
			if(empty($postcode)){
				echo 'true';
			}else{
				echo 'false';
			} 
		}else{
			echo 'false';
		}
		
	}
}