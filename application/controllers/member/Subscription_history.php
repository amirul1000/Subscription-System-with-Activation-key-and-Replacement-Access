<?php

 /**
 * Author: Amirul Momenin
 * Desc:Subscription_history Controller
 *
 */
class Subscription_history extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->library('Customlib');
		$this->load->helper(array('cookie', 'url')); 
		$this->load->database();  
		$this->load->model('Subscription_history_model');
		if(! $this->session->userdata('validated')){
				redirect('member/login/index');
		}  
    } 
	
    /**
	 * Index Page for this controller.
	 *@param $start - Starting of subscription_history table's index to get query
	 *
	 */
    function index($start=0){
		$limit = 10;
        $data['subscription_history'] = $this->Subscription_history_model->get_limit_users_subscription_history($limit,$start);
		//pagination
		$config['base_url'] = site_url('member/subscription_history/index');
		$config['total_rows'] = $this->Subscription_history_model->get_count_users_subscription_history();
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
		
        $data['_view'] = 'member/subscription_history/index';
        $this->load->view('layouts/member/body',$data);
    }
	
	 /**
     * Save subscription_history
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
					 'subscription_id' => html_escape($this->input->post('subscription_id')),
'activation_key' => html_escape($this->input->post('activation_key')),
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
			$data['subscription_history'] = $this->Subscription_history_model->get_subscription_history($id);
            if(isset($_POST) && count($_POST) > 0){   
                $this->Subscription_history_model->update_subscription_history($id,$params);
				$this->session->set_flashdata('msg','Subscription_history has been updated successfully');
                redirect('member/subscription_history/index');
            }else{
                $data['_view'] = 'member/subscription_history/form';
                $this->load->view('layouts/member/body',$data);
            }
        } //save
		else{
			if(isset($_POST) && count($_POST) > 0){   
                $subscription_history_id = $this->Subscription_history_model->add_subscription_history($params);
				$this->session->set_flashdata('msg','Subscription_history has been saved successfully');
                redirect('member/subscription_history/index');
            }else{  
			    $data['subscription_history'] = $this->Subscription_history_model->get_subscription_history(0);
                $data['_view'] = 'member/subscription_history/form';
                $this->load->view('layouts/member/body',$data);
            }
		}
        
    } 
	
	/**
     * Details subscription_history
	 * @param $id - primary key to get record
	 *
     */
	function details($id){
        $data['subscription_history'] = $this->Subscription_history_model->get_subscription_history($id);
		$data['id'] = $id;
        $data['_view'] = 'member/subscription_history/details';
        $this->load->view('layouts/member/body',$data);
	}
	
    /**
     * Deleting subscription_history
	 * @param $id - primary key to delete record
	 *
     */
    function remove($id){
        $subscription_history = $this->Subscription_history_model->get_subscription_history($id);

        // check if the subscription_history exists before trying to delete it
        if(isset($subscription_history['id'])){
            $this->Subscription_history_model->delete_subscription_history($id);
			$this->session->set_flashdata('msg','Subscription_history has been deleted successfully');
            redirect('member/subscription_history/index');
        }
        else
            show_error('The subscription_history you are trying to delete does not exist.');
    }
	
	/**
     * Search subscription_history
	 * @param $start - Starting of subscription_history table's index to get query
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
$this->db->or_like('subscription_id', $key, 'both');
$this->db->or_like('activation_key', $key, 'both');
$this->db->or_like('created_at', $key, 'both');
$this->db->or_like('updated_at', $key, 'both');


		$this->db->order_by('id', 'desc');
		
        $this->db->limit($limit,$start);
        $data['subscription_history'] = $this->db->get('subscription_history')->result_array();
		$db_error = $this->db->error();
		if (!empty($db_error['code'])){
			echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
			exit;
		}
		
		//pagination
		$config['base_url'] = site_url('member/subscription_history/search');
		$this->db->reset_query();		
		$this->db->like('id', $key, 'both');
$this->db->or_like('subscription_id', $key, 'both');
$this->db->or_like('activation_key', $key, 'both');
$this->db->or_like('created_at', $key, 'both');
$this->db->or_like('updated_at', $key, 'both');

		$config['total_rows'] = $this->db->from("subscription_history")->count_all_results();
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
		$data['_view'] = 'member/subscription_history/index';
        $this->load->view('layouts/member/body',$data);
	}
	
    /**
     * Export subscription_history
	 * @param $export_type - CSV or PDF type 
     */
	function export($export_type='CSV'){
	  if($export_type=='CSV'){	
		   // file name 
		   $filename = 'subscription_history_'.date('Ymd').'.csv'; 
		   header("Content-Description: File Transfer"); 
		   header("Content-Disposition: attachment; filename=$filename"); 
		   header("Content-Type: application/csv; ");
		   // get data 
		   $this->db->order_by('id', 'desc');
		   $subscription_historyData = $this->Subscription_history_model->get_all_subscription_history();
		   // file creation 
		   $file = fopen('php://output', 'w');
		   $header = array("Id","Subscription Id","Activation Key","Created At","Updated At"); 
		   fputcsv($file, $header);
		   foreach ($subscription_historyData as $key=>$line){ 
			 fputcsv($file,$line); 
		   }
		   fclose($file); 
		   exit; 
	  }else if($export_type=='Pdf'){
		    $this->db->order_by('id', 'desc');
		    $subscription_history = $this->db->get('subscription_history')->result_array();
		   // get the HTML
			ob_start();
			include(APPPATH.'views/member/subscription_history/print_template.php');
			$html = ob_get_clean();
			require_once FCPATH.'vendor/autoload.php';			
			$mpdf = new \Mpdf\Mpdf();
			$mpdf->WriteHTML($html);
			$mpdf->Output();
			exit;
	  }
	   
	}
}
//End of Subscription_history controller