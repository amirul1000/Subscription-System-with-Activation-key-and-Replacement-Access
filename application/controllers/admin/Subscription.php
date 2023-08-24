<?php

 /**
 * Author: Amirul Momenin
 * Desc:Subscription Controller
 *
 */
class Subscription extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('Customlib');
		$this->load->helper(array('cookie', 'url')); 
		$this->load->database();  
		$this->load->model('Subscription_model');
		if($this->session->userdata('user_type')!='super'){
			   echo "Permission denied";
			   exit;
			}
		if(! $this->session->userdata('validated')){
				redirect('admin/login/index');
		}  
    } 
	
    /**
	 * Index Page for this controller.
	 *@param $start - Starting of subscription table's index to get query
	 *
	 */
    function index($start=0){
		$limit = 10;
        $data['subscription'] = $this->Subscription_model->get_limit_subscription($limit,$start);
		//pagination
		$config['base_url'] = site_url('admin/subscription/index');
		$config['total_rows'] = $this->Subscription_model->get_count_subscription();
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
		
        $data['_view'] = 'admin/subscription/index';
        $this->load->view('layouts/admin/body',$data);
    }
	
	 /**
     * Save subscription
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
					 'users_id' => html_escape($this->input->post('users_id')),
'service_type_id' => html_escape($this->input->post('service_type_id')),
'activation_key' => html_escape($this->input->post('activation_key')),
'limit_count' => html_escape($this->input->post('limit_count')),
'used_count' => html_escape($this->input->post('used_count')),
'expiration_date_time' => html_escape($this->input->post('expiration_date_time')),
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
			$data['subscription'] = $this->Subscription_model->get_subscription($id);
            if(isset($_POST) && count($_POST) > 0){   
                $this->Subscription_model->update_subscription($id,$params);
				$this->session->set_flashdata('msg','Subscription has been updated successfully');
                redirect('admin/subscription/index');
            }else{
                $data['_view'] = 'admin/subscription/form';
                $this->load->view('layouts/admin/body',$data);
            }
        } //save
		else{
			if(isset($_POST) && count($_POST) > 0){   
                $subscription_id = $this->Subscription_model->add_subscription($params);
				$this->session->set_flashdata('msg','Subscription has been saved successfully');
                redirect('admin/subscription/index');
            }else{  
			    $data['subscription'] = $this->Subscription_model->get_subscription(0);
                $data['_view'] = 'admin/subscription/form';
                $this->load->view('layouts/admin/body',$data);
            }
		}
        
    } 
	
	/**
     * Details subscription
	 * @param $id - primary key to get record
	 *
     */
	function details($id){
        $data['subscription'] = $this->Subscription_model->get_subscription($id);
		$data['id'] = $id;
        $data['_view'] = 'admin/subscription/details';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Deleting subscription
	 * @param $id - primary key to delete record
	 *
     */
    function remove($id){
        $subscription = $this->Subscription_model->get_subscription($id);

        // check if the subscription exists before trying to delete it
        if(isset($subscription['id'])){
            $this->Subscription_model->delete_subscription($id);
			$this->session->set_flashdata('msg','Subscription has been deleted successfully');
            redirect('admin/subscription/index');
        }
        else
            show_error('The subscription you are trying to delete does not exist.');
    }
	
	/**
     * Search subscription
	 * @param $start - Starting of subscription table's index to get query
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
$this->db->or_like('users_id', $key, 'both');
$this->db->or_like('service_type_id', $key, 'both');
$this->db->or_like('activation_key', $key, 'both');
$this->db->or_like('limit_count', $key, 'both');
$this->db->or_like('used_count', $key, 'both');
$this->db->or_like('expiration_date_time', $key, 'both');
$this->db->or_like('created_at', $key, 'both');
$this->db->or_like('updated_at', $key, 'both');


		$this->db->order_by('id', 'desc');
		
        $this->db->limit($limit,$start);
        $data['subscription'] = $this->db->get('subscription')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		
		//pagination
		$config['base_url'] = site_url('admin/subscription/search');
		$this->db->reset_query();		
		$this->db->like('id', $key, 'both');
$this->db->or_like('users_id', $key, 'both');
$this->db->or_like('service_type_id', $key, 'both');
$this->db->or_like('activation_key', $key, 'both');
$this->db->or_like('limit_count', $key, 'both');
$this->db->or_like('used_count', $key, 'both');
$this->db->or_like('expiration_date_time', $key, 'both');
$this->db->or_like('created_at', $key, 'both');
$this->db->or_like('updated_at', $key, 'both');

		$config['total_rows'] = $this->db->from("subscription")->count_all_results();
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
		$data['_view'] = 'admin/subscription/index';
        $this->load->view('layouts/admin/body',$data);
	}
	
    /**
     * Export subscription
	 * @param $export_type - CSV or PDF type 
     */
	function export($export_type='CSV'){
	  if($export_type=='CSV'){	
		   // file name 
		   $filename = 'subscription_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   // get data 
		   $this->db->order_by('id', 'desc');
		   $subscriptionData = $this->Subscription_model->get_all_subscription();
		   // file creation 
		   $file = fopen('php://output', 'w');
		   $header = array("Id","Users Id","Service Type Id","Activation Key","Limit Count","Used Count","Expiration Date Time","Created At","Updated At"); 
		   fputcsv($file, $header);
		   foreach ($subscriptionData as $key=>$line){ 
			 fputcsv($file,$line); 
		   }
		   fclose($file); 
		   exit; 
	  }else if($export_type=='Pdf'){
		    $this->db->order_by('id', 'desc');
		    $subscription = $this->db->get('subscription')->result_array();
		   // get the HTML
			ob_start();
			include(APPPATH.'views/admin/subscription/print_template.php');
			$html = ob_get_clean();
			require_once FCPATH.'vendor/autoload.php';			
			$mpdf = new \Mpdf\Mpdf();
			$mpdf->WriteHTML($html);
			$mpdf->Output();
			exit;
	  }
	   
	}
}
//End of Subscription controller