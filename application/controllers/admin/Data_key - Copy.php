<?php

 /**
 * Author: Amirul Momenin
 * Desc:Data_key Controller
 *
 */
 
 require 'vendor/autoload.php';

  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
  use PhpOffice\PhpSpreadsheet\Writer\Xls;
  use PhpOffice\PhpSpreadsheet\Writer\Csv;

  use PhpOffice\PhpSpreadsheet\Reader;
  
class Data_key extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('Customlib');
		$this->load->helper(array('cookie', 'url')); 
		$this->load->database();  
		$this->load->model('Data_key_model');
		$this->load->model('Service_type_model');
		if(! $this->session->userdata('validated')){
				redirect('admin/login/index');
		}  
    } 
	
    /**
	 * Index Page for this controller.
	 *@param $start - Starting of data_key table's index to get query
	 *
	 */
    function index($start=0){
		$limit = 10;
        $data['data_key'] = $this->Data_key_model->get_limit_data_key($limit,$start);
		//pagination
		$config['base_url'] = site_url('admin/data_key/index');
		$config['total_rows'] = $this->Data_key_model->get_count_data_key();
		$config['per_page'] = 10;
		//Bootstrap 4 Pagination fix
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close']   = '<span aria-hidden="true"></span></span></li>';
		$config['next_tag_close']   = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close']   = '</span></li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close']  = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close']   = '</span></li>';		
		$this->pagination->initialize($config);
        $data['link'] =$this->pagination->create_links();
		
        $data['_view'] = 'admin/data_key/index';
        $this->load->view('layouts/admin/body',$data);
    }
	
	 /**
     * Save data_key
	 *@param $id - primary key to update
	 *
     */
    function save($id=-1){   
		 
		$created_at = "";
$updated_at = "";

		if($id<=0){
															 $created_at = date("Y-m-d H:i:s");
														 }
else if($id>0){
															 $updated_at = date("Y-m-d H:i:s");
														 }

		$params = array(
					 'service_type_id' => html_escape($this->input->post('service_type_id')),
'activation_key' => html_escape($this->input->post('activation_key')),
'status' => html_escape($this->input->post('status')),
'created_at' =>$created_at,
'updated_at' =>$updated_at,

				);
		 
		if($id>0){
							                        unset($params['created_at']);
						                          }if($id<=0){
							                        unset($params['updated_at']);
						                          } 
		$data['id'] = $id;
		//update		
        if(isset($id) && $id>0){
			$data['data_key'] = $this->Data_key_model->get_data_key($id);
            if(isset($_POST) && count($_POST) > 0){   
                $this->Data_key_model->update_data_key($id,$params);
				$this->session->set_flashdata('msg','Data_key has been updated successfully');
                redirect('admin/data_key/index');
            }else{
                $data['_view'] = 'admin/data_key/form';
                $this->load->view('layouts/admin/body',$data);
            }
        } //save
		else{
			if(isset($_POST) && count($_POST) > 0){   
                $data_key_id = $this->Data_key_model->add_data_key($params);
				$this->session->set_flashdata('msg','Data_key has been saved successfully');
                redirect('admin/data_key/index');
            }else{  
			    $data['data_key'] = $this->Data_key_model->get_data_key(0);
                $data['_view'] = 'admin/data_key/form';
                $this->load->view('layouts/admin/body',$data);
            }
		}
        
    } 
	
	
	function import_excell()
	 {
         /*     $_SESSION['start_time'] = time();
			  $_SESSION['old_data_count'] = $this->Data_key_model->get_count_checker();

		if(is_uploaded_file($_FILES['file']['tmp_name'])){
			// Load CSV reader library
			$this->load->library('CSVReader');
			
			// Parse data from CSV file
			$csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
			
			// Insert/update CSV data into database
			if(!empty($csvData)){
				foreach($csvData as $row){ 
				$rowCount++;
			
			
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			$users_pay_details_id = $row['users_pay_details_id'];
			$start_date  = $row['start_date'];
			$end_date  = $row['end_date'];
			$leave_type  = $row['leave_type'];


            $EMAIL 	 =  $row['EMAIL'];
				$PASSWORD1  = $row['PASSWORD1'];
				$CHECK1 = 0;
				$BAD  = 0;
				$HIT	 = 0;
				$GUARD  = 0;
				$TwoFA = 0;
				$capture  = 0;
				
				
				
				$params = array(
					'EMAIL' => $EMAIL,
					'PASSWORD1' => $PASSWORD1,
					'CHECK1' => $CHECK1,
					'BAD' => $BAD,
					'HIT' => $HIT,
					'GUARD' => $GUARD,
					'TwoFA' => $TwoFA,
					'capture' => $capture,
					
									);

				if(strlen($EMAIL)>0){
					$this->Data_key_model->add_checker($params);
				}
								 

			 }
		}
	 
		}*/
		

		$file_picture = "";
		$created_at = date("Y-m-d H:i:s");	 
		$updated_at = "";
		if(isset($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"]; 
			
			$arr_file 	= explode('.', $_FILES["file"]["name"]);
			$extension 	= end($arr_file);
			
			$reader=NULL;
			if('csv' == $extension) {     
			  $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} else if('xls' == $extension) {  
			  $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			} else{     
			  $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			} 
			

			try {
			$spreadsheet 	= $reader->load($path);
			$sheet_data 	= $spreadsheet->getActiveSheet()->toArray(); 
		} catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
			throw $e;
		}
			
			for($row=1; $row<=count($sheet_data); $row++)
		    {
			    $service_type_id 	 = $this->get_id_by_name(isset($sheet_data[$row][0])?$sheet_data[$row][0]:'');
				$activation_key  = isset($sheet_data[$row][1])?$sheet_data[$row][1]:'';
				$status = isset($sheet_data[$row][2])?$sheet_data[$row][2]:'open';
				
				$params = array(
					'service_type_id' => $service_type_id,
					'activation_key' => $activation_key,
					'status' => $status
									);
		 
                if(strlen($activation_key)>0){
			  		 $this->Data_key_model->add_data_key($params);
				}
				
		}
	
		}
		ob_start();
		ob_clean(); 
		 
		redirect('admin/data_key/index'); 
	 }
	 
	 
	 function get_id_by_name($service_name){
		  $result = $this->db->get_where('service_type',array('service_name'=>$service_name))->row_array();
			if(!(array)$result){
				$fields = $this->db->list_fields('data_key');
				foreach ($fields as $field)
				{
				   $result[$field] = ''; 	  
				}
			} 
			
			if($result['service_name']==$service_name){
				return $result['id'];
			}else{
				$created_at = date("Y-m-d H:i:s");	 
				$params = array(
						 'service_name' => html_escape($service_name),
						 'created_at' =>$created_at,
					);
			    return $this->Service_type_model->add_service_type($params);
			}
	 }

	
	/**
     * Details data_key
	 * @param $id - primary key to get record
	 *
     */
	function details($id){
        $data['data_key'] = $this->Data_key_model->get_data_key($id);
		$data['id'] = $id;
        $data['_view'] = 'admin/data_key/details';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Deleting data_key
	 * @param $id - primary key to delete record
	 *
     */
    function remove($id){
        $data_key = $this->Data_key_model->get_data_key($id);

        // check if the data_key exists before trying to delete it
        if(isset($data_key['id'])){
            $this->Data_key_model->delete_data_key($id);
			$this->session->set_flashdata('msg','Data_key has been deleted successfully');
            redirect('admin/data_key/index');
        }
        else
            show_error('The data_key you are trying to delete does not exist.');
    }
	
	/**
     * Search data_key
	 * @param $start - Starting of data_key table's index to get query
     */
	function search($start=0){
		if(!empty($this->input->post('key'))){
			$key =$this->input->post('key');
			$_SESSION['key'] = $key;
		}else{
			$key = $_SESSION['key'];
		}
		
		$limit = 10;		
		$this->db->like('id', $key, 'both');
$this->db->or_like('service_type_id', $key, 'both');
$this->db->or_like('activation_key', $key, 'both');
$this->db->or_like('status', $key, 'both');
$this->db->or_like('created_at', $key, 'both');
$this->db->or_like('updated_at', $key, 'both');


		$this->db->order_by('id', 'desc');
		
        $this->db->limit($limit,$start);
        $data['data_key'] = $this->db->get('data_key')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		
		//pagination
		$config['base_url'] = site_url('admin/data_key/search');
		$this->db->reset_query();		
		$this->db->like('id', $key, 'both');
$this->db->or_like('service_type_id', $key, 'both');
$this->db->or_like('activation_key', $key, 'both');
$this->db->or_like('status', $key, 'both');
$this->db->or_like('created_at', $key, 'both');
$this->db->or_like('updated_at', $key, 'both');

		$config['total_rows'] = $this->db->from("data_key")->count_all_results();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		$config['per_page'] = 10;
		// Bootstrap 4 Pagination fix
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close']   = '<span aria-hidden="true"></span></span></li>';
		$config['next_tag_close']   = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close']   = '</span></li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close']  = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close']   = '</span></li>';
		$this->pagination->initialize($config);
        $data['link'] =$this->pagination->create_links();
		
		$data['key'] = $key;
		$data['_view'] = 'admin/data_key/index';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Export data_key
	 * @param $export_type - CSV or PDF type 
     */
	function export($export_type='CSV'){
	  if($export_type=='CSV'){	
		   // file name 
		   $filename = 'data_key_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   // get data 
		   $this->db->order_by('id', 'desc');
		   $data_keyData = $this->Data_key_model->get_all_data_key();
		   // file creation 
		   $file = fopen('php://output', 'w');
		   $header = array("Id","Service Type Id","Activation Key","Status","Created At","Updated At"); 
		   fputcsv($file, $header);
		   foreach ($data_keyData as $key=>$line){ 
			 fputcsv($file,$line); 
		   }
		   fclose($file); 
		   exit; 
	  }else if($export_type=='Pdf'){
		    $this->db->order_by('id', 'desc');
		    $data_key = $this->db->get('data_key')->result_array();
		   // get the HTML
			ob_start();
			include(APPPATH.'views/admin/data_key/print_template.php');
			$html = ob_get_clean();
			require_once FCPATH.'vendor/autoload.php';			
			$mpdf = new \Mpdf\Mpdf();
			$mpdf->WriteHTML($html);
			$mpdf->Output();
			exit;
	  }
	   
	}
}
//End of Data_key controller