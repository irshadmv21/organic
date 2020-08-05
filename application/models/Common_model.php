<?php
class Common_model extends CI_Model
{
	function get_table($tablename = '', $fields = '', $where = '', $ord_field = '', $ord_dir = '')
	{
		if (!empty($where)) {
			$this->db->where($where);
		}
		if ($ord_field != '') {
			$this->db->order_by($ord_field, $ord_dir);
		}
		$this->db->select($fields);
		$this->db->from($tablename);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		$result = $query->result_array();
		/* if($this->db->_error_message())
          return FALSE;
          else */
		return $result;
	} //end of function  
	function get_table_order($tablename = '', $fields = '', $where = '', $order_by = '', $order_cond = '', $limit = false)
	{
		$this->db->order_by($order_by, $order_cond);
		if ($limit) {
			$this->db->limit($limit);
		}
		$this->db->where($where);
		$this->db->select($fields);
		$this->db->from($tablename);
		$query = $this->db->get();
		$result = $query->result_array();
		//echo $this->db->last_query();exit;
		/*if($this->db->_error_message())
			return FALSE;
		else*/
		return $result;
	} //end function
	function get_row($tablename = '', $fields = '', $where = '')
	{
		$this->db->where($where);
		$this->db->select($fields);
		$this->db->from($tablename);
		$query = $this->db->get();
		//echo $this->db->last_query();exit();
		$result = $query->row_array();
		/*if($this->db->_error_message())*/
		if (!$result)
			return false;
		else
			return $result;
	}
	function get_row_order($tablename = '', $fields = '', $where = '', $order_by = '', $order_cond = '', $limit = false)
	{
		$this->db->order_by($order_by, $order_cond);
		if ($limit) {
			$this->db->limit($limit);
		}
		$this->db->where($where);
		$this->db->select($fields);
		$this->db->from($tablename);
		$query = $this->db->get();
		$result = $query->row_array();
		//echo $this->db->last_query();exit;
		/*if($this->db->_error_message())
			return FALSE;
		else*/
		return $result;
	} //end function
	//Create a new order record
	public function Insert_Data($table, $arr_Data)
	{
		$success = $this->db->insert($table, $arr_Data);
		if ($success)
			return $this->db->insert_id();
		else
			return FALSE;
	}
	public function update_Details($arr_Data, $table, $arr_where)
	{
		$this->db->where($arr_where);
		$this->db->update($table, $arr_Data);
		return TRUE;
	}
	//update information 
	public function update_Data($arr_Data, $value, $table, $field)
	{
		$this->db->where($field, $value);
		$this->db->update($table, $arr_Data);
		return TRUE;
	}
	//Delete Information
	public function Delete_data($table, $arr_Data)
	{
		$this->db->delete($table, $arr_Data);
	}
	function upload_variables($uploadpath)
	{
		$config['upload_path'] = @$uploadpath . '/';
		$config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
		$config['max_size']  = '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$config['encrypt_name'] = TRUE;
		/* Load the upload library */
		/* Create the config for image library */
		$configThumb = array();
		$config['image_library'] = 'gd2';
		$configThumb['source_image'] = '';
		$configThumb['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 140;
		$config['height'] = 210;
		return $config;
	}
	public function Truncate_data($table)
	{
		$this->db->empty_table($table);
	}

	public function upload_files($file_path, $input_name) //uploads the  image
	{
		$this->load->helper('file');
		$config_file = $this->common->upload_variables($file_path);
		$config_file['allowed_types'] 	= '*';
		$config_file['max_size'] 		= 0;
		$config_file['maintain_ratio'] 	= TRUE;
		$config_file['width'] 			= 250;
		$config_file['height'] 			= 250;

		$new_name = time() . $_FILES[$input_name]['name'];
		$config_file['file_name'] = $new_name;
		$this->load->library('Upload');
		$this->load->library('Image_lib');
		$this->upload->initialize($config_file);
		//$this->Image_lib->resize();
		if (!$this->upload->do_upload($input_name)) {
			$error_msg = $this->upload->display_errors();
			print_r($error_msg);
			//die();
		} else {
			$file = $this->upload->data();
			return $filename = $file['file_name'];
		}
	}
	public function multiple_upload_files($path, $files,$product_id)
    {
        $config = array(
            'upload_path'   => $path,
            'allowed_types' => 'jpg|gif|png',
            //'overwrite'     => 1,                       
        );

        $this->load->library('upload', $config);

		$images = array();
		

        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name']= $files['name'][$key];
            $_FILES['images[]']['type']= $files['type'][$key];
            $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
            $_FILES['images[]']['error']= $files['error'][$key];
            $_FILES['images[]']['size']= $files['size'][$key];

            $fileName = rand().time().'_'. $image;

            $images[] = $fileName;

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);
            if ($this->upload->do_upload('images[]')) {
				$arr_data=['product_id'=>$product_id,'image'=>$fileName];
				$this->db->insert('or_product_images',$arr_data);
	            $this->upload->data();
        	}
            
        }
        

        
    }
	public function get_all_orders()
	{
		$this->db->select("tb_order.*,tb_order_status.name as order_status");
		$this->db->from("tb_order");
		$this->db->join("tb_order_status", "tb_order.order_status_id=tb_order_status.order_status_id", "left");
		//$this->db->where('customer_id', $customer_id);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	

	public function get_customer_report($where)
	{
		$this->db->select("firstname,lastname,email_id,mobile,id,gender,image");
		$this->db->from("tb_user");
		if ($where['between']) {
			$this->db->where($where['between']);
		}
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function get_deliveryboy_report($where)
	{
		$this->db->select("*");
		$this->db->from("tb_delivery_boys");
		if ($where['between']) {
			$this->db->where($where['between']);
		}
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}


	public function get_comleted_orders()
	{
		$this->db->select("tb_order.*,tb_order_status.name as order_status");
		$this->db->from("tb_order");
		$this->db->join("tb_order_status", "tb_order.order_status_id=tb_order_status.order_status_id", "left");
		$this->db->where('tb_order.order_status_id', 5);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function get_orders($customer_id)
	{
		$this->db->select("tb_order.*,tb_order_status.name as order_status");
		$this->db->from("tb_order");
		$this->db->join("tb_order_status", "tb_order.order_status_id=tb_order_status.order_status_id", "left");
		$this->db->where('customer_id', $customer_id);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function send_mail($to,$subject,$body){
		    $this->load->library("phpmailer");
            $mail = new PHPMailer(); // create a new object
			$mail->IsSMTP(); // enable SMTP
			$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
			$mail->SMTPAuth = true; // authentication enabled
			$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 465; // or 587
			$mail->IsHTML(true);
			$mail->Username = MAIL_USERNBAME;
			$mail->Password = MAIL_PASSWORD;
			$mail->Subject = $subject;
			$mail->Body = $body;
			$mail->AddAddress($to);
            if ($mail->Send()) {
                return true;
            }else{
            	return false;
            }
	}
	public function upload_file($path,$file_name){

	    $this->load->library('upload');
	    $this->load->library('image_lib');
	    $config['upload_path'] = $path;
	    $config['allowed_types'] = '*';
	    $config['encrypt_name']= true;

	    $this->upload->initialize($config);
	    if(!$this->upload->do_upload($file_name)){
	       $error = array('error'=>$this->upload->display_errors());
	       $result=['status'=>'error','msg'=>$error];
	       return $result;
	    }else{
	       //Main image
	       $data = $this->upload->data();
	       // $config['image_library'] = 'gd2';
	       // $config['source_image'] = $path.$data["raw_name"].$data['file_ext'];
	       // $config['new_image'] = $path.$data["raw_name"].$data['file_ext'];
	       // $config['create_thumb'] = FALSE;
	       // $config['maintain_ratio'] = FALSE;
	       
	        //Thumb image
	       $dataThumb = $this->upload->data();
	       $configThumb['image_library'] = 'gd2';
	       $configThumb['source_image'] = $path.$dataThumb["raw_name"].$dataThumb['file_ext'];
	       $configThumb['new_image'] = $path.$dataThumb["raw_name"].$dataThumb['file_ext'];
	       $configThumb['create_thumb'] = TRUE;
	       $configThumb['maintain_ratio'] = TRUE;
	       $configThumb['width'] = 170;
	       $configThumb['height'] = 130;

	       $this->image_lib->initialize($config);
	       $this->image_lib->initialize($configThumb);
	       $this->image_lib->resize();

	       $result=['status'=>'success','file_name'=>$data["raw_name"].$data['file_ext'],'thumb_name'=>$dataThumb["raw_name"].$dataThumb['file_ext']];
	       return $result;
		}
    }
    public function get_categories()
	{
		$this->db->select("p.*,c.name as parent_name");
		$this->db->from("or_categories p");
		$this->db->join("or_categories c ", "p.parent_id=c.id", "left");
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
}
