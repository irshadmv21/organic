<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

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
		$data['base_path']=base_url().'uploads/products/';
		$data['result'] = $this->common->get_table('or_products','id,name,thumb,price,qty,status,date_added',[],'id','DESC');
		$this->load->view('admin/products/list',$data);
	}
	public function form(){ 

		$id = $this->uri->segment(3);
		$data['headding'] 	= 'Add Product';
		$data['categories'] = $this->common->get_categories();
		$data['farmers']=$this->common->get_table('or_farmers','id,name',['status'=>'A']);
		$data['category_ids']=[];
		$data['option_count']=0;
		if($id){
			$data['product']=$this->common->get_row('or_products','*',['id'=>$id]);
			$categories=$this->common->get_table('or_product_to_category','category_id',['product_id'=>$id]);
			if(!empty($categories)){
				foreach ($categories as $key => $value) {
					$data['category_ids'][]=$value['category_id'];
				}
			}
			$farmers=$this->common->get_table('or_product_to_farmers','farmer_id',['product_id'=>$id]);
			if(!empty($farmers)){
				foreach ($farmers as $key => $value) {
					$data['farmers_id'][]=$value['farmer_id'];
				}
			}
			$data['product_options']=$this->common->get_table('or_product_options','*',['product_id'=>$id]);
			$data['option_count'] = count($data['product_options']);

			$data['headding'] = 'Edit Product';
		}
		//print_r($data);exit;
		$data['action']=base_url().'products/save';
		$data['base_path']=base_url().'uploads/products/';
		$this->load->view('admin/products/form',$data);


	}
	public function save(){
		
		if($this->input->post()){
			 $post_data  = $this->input->post();
			 //print_r($post_data);exit;
			 $array_data = [
			 	'name' 				=> $post_data['name'],
			 	'description' 		=> $post_data['description'],
			 	'price' 			=> $post_data['price'],
			 	'qty' 				=> $post_data['qty'],
			 	'unit_size' 		=> $post_data['unit_size'],
			 	'offer_percentage' 	=> $post_data['offer_percentage'],
			 	'status' 			=> $post_data['status'],
			 ];

			 if(isset($_FILES['image']['name'])){

			 	$image_result = $this->common->upload_file('./uploads/products/','image');
			 	
			 	if($image_result['status']=='success'){
			 		$array_data['image'] = $image_result['file_name'];
			 		$array_data['thumb'] = $image_result['thumb_name'];
			 	}
			 }
			 

			 if($this->input->post('id')){
			 	$arr_where  = ['id'=>$post_data['id']];
			 	$product_id = $post_data['id'];
			 	$this->common->update_Details($array_data,'or_products',$arr_where);
				$this->session->set_flashdata('success_msg','Successfully updated product details');
			 	$json=['status'=>'success','message'=>'Successfully updated category'];
			 }else{
			 	if(!isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){
			 		$json = ['status'=>'error','message'=>'Please choose a image file'];
			 		$this->session->set_flashdata('error_msg','Successfully updated category');
			 	}else{
					$product_id=$this->common->Insert_Data('or_products',$array_data);
					$this->session->set_flashdata('success_msg','Successfully inserted product');
					$json = ['status'=>'success','message'=>'Successfully inserted product'];
			 	}
			 }
			 // option data
			 if(!empty($post_data['option_name'][0])){
			 	$where_delete=['product_id'=>$product_id];
				$this->common->Delete_data('or_product_options',$where_delete);
				foreach ($post_data['option_name'] as $key => $option) {
					if($option){
						$option_data['name'] = $option;
						$option_data['price'] = $post_data['option_price'][$key];
						$option_data['price'] = $post_data['option_price'][$key];
						$option_data['qty'] = $post_data['option_quantity'][$key];
						$option_data['price_prefix'] = $post_data['price_prifix'][$key];
						$option_data['product_id'] = $product_id;
						if($post_data['option_id'][$key]){
							$arr_where  = ['id'=>$post_data['option_id'][$key]];
						 	$this->common->update_Details($option_data,'or_product_options',$arr_where);
						}else{
							$this->common->Insert_Data('or_product_options',$option_data);
						}
						
					}
				}
			 }
			 // categories
			 $category_ids=$this->input->post('category_id');
			 if($category_ids){
	            $where_delete=['product_id'=>$product_id];
				$this->common->Delete_data('or_product_to_category',$where_delete);
				foreach ($category_ids as $keys => $cat_id) {
					$cat_data = ['product_id'=>$product_id,'category_id'=>$cat_id];
					$this->common->Insert_Data('or_product_to_category',$cat_data);
				}
			 }
			 // farmers
			 $farmers_ids=$this->input->post('farmers_id');
			 if($farmers_ids){
	            $where_delete=['product_id'=>$product_id];
				$this->common->Delete_data('or_product_to_farmers',$where_delete);
				foreach ($farmers_ids as $keys => $farm_id) {
					$farm_data = ['product_id'=>$product_id,'farmer_id'=>$farm_id];
					$this->common->Insert_Data('or_product_to_farmers',$farm_data);
				}
			 }
			 //print_r($_FILES['pro_image']['name']);exit;
			if(!empty($_FILES['pro_image']['name'])){

				$get_images=$this->common->get_table('or_product_images','id,image',['product_id'=>$product_id]);	
				if($get_images){
					foreach ($get_images as $key => $product_images) {
						unlink('./uploads/products/'.$product_images['image']);
					}
				}
				$where_delete=['product_id'=>$product_id];
				$this->common->Delete_data('or_product_images',$where_delete);
				$this->common->multiple_upload_files('./uploads/products/',$_FILES['pro_image'],$product_id);
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
			$this->common->Delete_data('or_categories',$arr_where);
			$json = ['status'=>'success','message'=>'Successfully deleted data'];
		}else{
			$json = ['status'=>'error','message'=>'Something went wrong...!'];
		}
		echo json_encode($json);
	}
}