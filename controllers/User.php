<?php 
	 
	class User extends CI_Controller {
		private $openaiApiKey = "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";
		public function __construct() {
			parent::__construct();
			$this->load->model('user_model');
			$this->load->library('pagination');
			$this->load->library('session');
		}
		
		public function index(){
			if($this->session->user_email){
				redirect(base_url('db'));
				die();
			}	
			$data['title']= 'DAVSY | Login';
			$data['scripts'] = ['comman/user.js'];
			$this->load->view('user/common/header_login',$data);
			$this->load->view('user/login');
			$this->load->view('user/common/footer_login');
		}
		
		public function dataup(){
		    $this->db->where('id>',496);
		    //$this->db->where('id<',3591);
		    //$this->db->select('')
		    $data = $this->db->get('traffic')->result_array();
		    $sdate = date('Y-m-d');
		    foreach($data as $value){
		        $this->db->like('website',$value['website']);
		        //$this->db->update('tbl_sites',['niche'=>$value['niche'],'site_category'=>$value['site_category'],'da'=>$value['da'],'pa'=>$value['pa'],'dr'=>$value['dr'],'spam_score'=>$value['spam_score'],'semrush_traffic'=>$value['semrush_traffic'],'traffic'=>$value['ahref_traffic'],'similarweb_traffic' => $value['similarweb_traffic'],'1st'=>$value['1st'],'2nd'=> $value['2nd'],'3rd' => $value['3rd'],'4th'=>$value['4th'],'5th'=>$value['5th'],'site_update_date'=>$sdate]);
	            $this->db->update('tbl_sites',['similarweb_traffic'=>$value['similarweb_traffic']]);
		    }
		    echo'<pre>';print_r($data);die;
		}
		
		public function check_sites(){
		    //$this->db->where('id>',3209);
		    $sites= $this->input->post('site_check');
		    $table_name = $this->input->post('table_name');
		    $pitched_id = $this->input->post('communication_id');
		    $datastore = $this->input->post('save_data');
		    //print_r($this->session->role);die;
		    $data = explode("\r\n",$sites);
		    //print_r($data);die;
		    $matched = '';$not_matched = '';$pitch = '';
		    $up_array = '';
		    
		    if($this->session->role == 'Manage' || $this->session->role == 'Vendor' || $this->session->role == 'Operator' || $this->session->role == 'Admin'){
    		    foreach($data as $key => $value){
    		        
    		        //$up_array = [$key];
    		        //echo'<pre>'; print_r($up_array);
    		        $this->db->where('website',$value);
					$this->db->order_by('cp_update_date','DESC');
    		        $datas = $this->db->get($table_name)->row_array();
    		        if(!empty($datas)){
    		            $matched.='<tr><td>'.$value.'</td><td>'.$datas['price'].'</td><td>'.$datas['niche'].'</td><td>'.$datas['da'].'</td><td>'.$datas['contact'].'</td><td>'.$datas['timestamp'].'</td><td>'.$datas['cp_update_date'].'</td><td>'.$datas['remark'].'</td><td></td><td style="color:red">DUPLICATE</tr>';
    		            
    		        }else{
    		            $this->db->where('website',$value);
    		            $pitched = $this->db->get('tbl_pitch')->row_array();
    		            if(!empty($pitched)){
    		                $matched.='<tr><td>'.$value.'</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>'.@$pitched['pitched_id'].'</td><td style="color:brown">PITCHED</tr></tr>';
    		                
    		            }else{
    		                $matched.='<tr><td>'.$value.'</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td style="color:green">UNIQUE</tr></tr>';
    		                $skkk[$key]['website'] = $value;
    		            }
    		        }
    		    }
		    }
		    //echo'<pre>'; print_r($up_array);die;
		   if(!empty($datastore)){
		      
    		            $this->db->where_in('website',$data);
    		            $this->db->update('tbl_pitch',['pitched_id' => $pitched_id]);
		        }
		    if(!empty($not_matched)){
		        
		        echo'<style>table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}</style><table class="table table-striped" style="border: 1px solid black;"><tr style="color:green"><th>UNIQUE WEBSITES</th></tr><tr><th>Website</th></tr>';print_r($not_matched);echo '</table></br></br>';
		        if(!empty($datastore)){
    		        foreach($skkk as $vls){
    		            $this->db->insert('tbl_pitch',['website'=>$vls['website'],'pitched_id' => $pitched_id]);
    		        }
		        }
		    }
		    if(!empty($pitch)){
		        echo'<style>table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}</style><table class="table table-striped" style="border: 1px solid black;"><tr style="color:orange"><th>PITCHED WEBSITES</th></tr><tr><th>Website</th><th>Pitched BY</th></tr>';print_r($pitch);echo '</table></br></br>';
		    }
		     if(!empty($matched)){
		        echo'<style>table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}</style><table class="table table-striped" style="border: 1px solid black;"><tr><th>Website Matching Result</th></tr><tr><th>Website</th><th>Cost Price</th><th>Nishe</th><th>DA</th><th>Vendor Contact</th><th>Data update Date</th><th>CP Update Date</th><th>Remark</th><th>Pitched By</th><th>Status</th></tr>';print_r($matched);echo '</table>';
		    }
		    
		}
		
		public function check_vendors(){
		    //$this->db->where('id>',3209);
		    $sites= $this->input->post('vendor_check');
		    //print_r($this->session->role);die;
		    $data = explode("\r\n",$sites);
		    //echo'<pre>';print_r($data);die;
		    $matched = '';$not_matched = '';
		    if($this->session->role == 'Manage' || $this->session->role == 'Vendor' || $this->session->role == 'Admin'){
    		    foreach($data as $value){
    		        $this->db->where('email',$value);
    		        $data = $this->db->get('tbl_vendors')->row_array();
					
    		        if(!empty($data)){
						
    		            $matched.='<style>table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}</style><table class="table table-striped" style="border: 1px solid black;"><tr style="color:green"><th>ID</th><th>Email</th></tr><tr><td>'.$data['id'].'</td><td>'.$value.'</td></tr></table>';
    		        }else{
    		            $not_matched.='<br>'.$value;
    		        }
    		    }
		    }
		    if(!empty($not_matched)){echo'<b style="color:green">Unique Vendor';echo '</b></br>';print_r($not_matched);echo '</br>';}
		    echo'<b style="color:red">Duplicate Vendors';echo'</b></br>';print_r($matched);
		}
		
		public function sent_sites(){
		    $glo = 1;
		    $client_name = $this->input->post('client_name');
		    $communication_id = $this->input->post('communication_id');
		    $added_by = $this->session->user_id;
		    
            set_time_limit(300);
            if(isset($_FILES["import"])){//echo '<pre>';print_r($client_name);die;
    		    $filename=time().'.csv';	
    		    move_uploaded_file($_FILES["import"]["tmp_name"], 'imports/'.$filename);
                if($_FILES["import"]["size"] > 0)
    		    {
        		  	$file = fopen(base_url('imports/'.$filename), "r");
        		  	$short_url = '';
        	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){ 
                        if($glo >1){
                            $rep = str_replace("https://","",$getData[1]);
                            $rep1 = str_replace("http://","",$rep);
                            $rep2 = str_replace("www.","",$rep1);
                            $data['website'] = 'www.'.$rep2;
                            $data['niche'] = $getData[2];
                            $data['da'] = $getData[3];
                            $data['pa'] = $getData[4];
                            $data['dr'] = $getData[5];
                            $data['spam_score'] = $getData[6];
                            $data['price'] = $getData[7];
                            $data['selling_price'] = $getData[8];
                            $data['traffic'] = $getData[9];
                            $data['follow'] = $getData[10];
                            $data['semrush_traffic'] = $getData[11];
                            $data['similarweb_traffic'] = $getData[12];
                            $data['first'] =  $getData[13];
                            $data['second'] = $getData[14];
                            $data['third'] =  $getData[15];
                            $data['four'] =   $getData[16];
                            $data['vendor'] = $getData[17];
                            $data['tat'] =      $getData[18];
                            $data['social_media'] = $getData[19];
                            $data['client_name'] = $client_name;
                            $data['communication_id'] = $communication_id;
                            $data['added_by'] = $added_by;
                            $data['timestamp'] = time();
                            $this->db->insert('sent_sites',$data);
                        }$glo++;
				    }
	            fclose($file);
	            echo "<script type=\"text/javascript\">alert(\"CSV File has been successfully Imported.\");
	            window.location = \"ss\"</script>";
		        }
            }
		}
		
		public function update_sites(){
		    $glo = 1;
		    $inc = 0;
		    $client_name = $this->input->post('client_name');
		    $communication_id = $this->input->post('communication_id');
		    $added_by = $this->session->user_id;
		    
            set_time_limit(300);
            if(isset($_FILES["import"]) ){//echo '<pre>';print_r($client_name);die;
    		    $filename=time().'.csv';	
    		    move_uploaded_file($_FILES["import"]["tmp_name"], 'imports/'.$filename);
                if($_FILES["import"]["size"] > 0)
    		    {
        		  	$file = fopen(base_url('imports/'.$filename), "r");
        		  	$short_url = '';
        		  	echo '<style>
table, th, td {
  border: 1px solid black;
}
</style><table><tr><td>WEBSITES</td><td>AHREF TRAFFIC</td><td>SEMRUSH TRAFFIC</td><td>SIMILARWEB TRAFFIC</td><td>1ST</td><td>2ND</td><td>3RD</td><td>4TH</td><td>5TH</td>';
        	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){ 
                        if($glo >1){
                            $data['website'] = $getData[0];
                            $data['traffic'] = $getData[1];
                            $data['semrush_traffic'] = $getData[2];
                            $data['similarweb_traffic'] = $getData[3];
                            $data['1st'] = $getData[4];
                            $data['2nd'] = $getData[5];
                            $data['3rd'] = $getData[6];
                            $data['4th'] = $getData[7];
                            $data['5th'] = $getData[8];
                            $inc++;   
                            
                            echo '<tr><td>'.$getData[0].'</td><td>'.$getData[1].'</td><td>'.$getData[2].'</td><td>'.$getData[3].'</td><td>'.$getData[4].'</td><td>'.$getData[5].'</td><td>'.$getData[6].'</td><td>'.$getData[7].'</td><td>'.$getData[8].'</td></tr>';
                            
                        }$glo++;
				    }
				     echo '</table><a href="https://master.outreachdeal.com/do_update_sites/'.$filename.'">Click Here to confirm!</button>';
				    
	            //fclose($file);
	            //echo "<script type=\"text/javascript\">if(document.getElementById('buttons').clicked == true) alert();</script>";
	            //echo '<pre>'; print_r($data);die;
		        }
            }
		}
		
		public function do_update_sites($filename){
		    $glo = 1;
		    $inc = 0;
            set_time_limit(300);
            
        		  	$file = fopen(base_url('imports/'.$filename), "r");
        		  
        	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){ 
                        if($glo >1){
                            $data['website'] = $getData[0];
                            $data['traffic'] = $getData[1];
                            $data['semrush_traffic'] = $getData[2];
                            $data['similarweb_traffic'] = $getData[3];
                            $data['1st'] = $getData[4];
                            $data['2nd'] = $getData[5];
                            $data['3rd'] = $getData[6];
                            $data['4th'] = $getData[7];
                            $data['5th'] = $getData[8];
                            $inc++;   
                            //echo $getData[0];
                            $this->db->where('website LIKE',$getData[0].'%');
                            $this->db->update('tbl_sites',$data);
                            
                        }$glo++;
				    }
				    echo "<script type=\"text/javascript\">alert(\"The data is successfully Updated.\");
	               window.location = 'https://master.outreachdeal.com/db'; </script>"; 
		}
		
		public function send_sites(){
		    $data = $this->input->post();
		    //print_r($data);die;
			$data['scripts'] = ['comman/user.js'];
			$data['user_info'] = $this->user_model->user_info();
			$datas = $this->input->post();
			$data['blog'] = $this->user_model->get_all_ss();
			$data['title'] = 'TOOL';
			$this->load->view('user/common/header',$data);
			$this->load->view('user/common/nav_bar');
			$this->load->view('user/table_ss',$data);
			$this->load->view('user/common/footer');
		    }
		    
		 public function ss($all=''){
			$data['scripts'] = ['comman/user.js'];
			$data['user_info'] = $this->user_model->user_info();
			$data['blog'] = $this->user_model->get_all_send_sites();
			$data['title'] = 'TOOL';
			$this->load->view('user/common/header',$data);
			$this->load->view('user/common/nav_bar');
			$this->load->view('user/send_sites',$data);
			$this->load->view('user/common/footer');
		}
		
		public function client_report(){
		    if($this->session->role=='Admin' || $this->session->role=='Salesperson'){
    			$data['scripts'] = ['comman/user.js'];
    			$data['user_info'] = $this->user_model->user_info();
    			$data['blog'] = $this->user_model->get_all_clients_report();
    			$data['title'] = 'TOOL';
    			$this->load->view('user/common/header',$data);
    			$this->load->view('user/common/nav_bar');
    			$this->load->view('user/client_report',$data);
    			$this->load->view('user/common/footer');
		    }
		}
		
		public function order_list(){
		    if($this->session->role=='Admin' || $this->session->role=='Salesperson'){
    			$data['scripts'] = ['comman/user.js'];
    			$data['user_info'] = $this->user_model->user_info();
    			$datas = $this->input->post();
    			$data['blog'] = $this->user_model->get_all_orders_client();
    			$data['title'] = 'TOOL';
    			$this->load->view('user/common/header',$data);
    			$this->load->view('user/common/nav_bar');
    			$this->load->view('user/order_list',$data);
    			$this->load->view('user/common/footer');
		    }
		 }
		    
		    
		public function vendor_report(){
			$data['scripts'] = ['comman/user.js'];
			$data['user_info'] = $this->user_model->user_info();
			$data['blog'] = $this->user_model->get_all_vendors_report();
			$data['venr'] = $this->user_model->get_all_vendors_report_payment();
			//echo'<pre>';print_r($data['venr']);die;
			$data['title'] = 'TOOL';
			$this->load->view('user/common/header',$data);
			$this->load->view('user/common/nav_bar');
			$this->load->view('user/vendor_report',$data);
			$this->load->view('user/common/footer');
		}
		
		public function vendor_order_list(){
			$data['scripts'] = ['comman/user.js'];
			$data['user_info'] = $this->user_model->user_info();
			$datas = $this->input->post();
			$data['blog'] = $this->user_model->get_all_orders_vendor();
			$data['title'] = 'TOOL';
			$this->load->view('user/common/header',$data);
			$this->load->view('user/common/nav_bar');
			$this->load->view('user/vendor_order_list',$data);
			$this->load->view('user/common/footer');
		    
		        
		    }

		public function do_login(){
			$this->output->set_content_type('application/json');
			$this->form_validation->set_rules('email','Email','required');
			$this->form_validation->set_rules('password','Password','required');
			if($this->form_validation->run()===FALSE) {
				$this->output->set_output(json_encode(['result' => 0,'errors' => $this->form_validation->error_array()]));
				return FALSE;
			}
			
			$result = $this->user_model->is_auth_user();
			//print_r($result);die;
			if($result) {
				$this->session->set_userdata('role',$result['role']);
				$this->session->set_userdata('user_id',$result['id']);
				$this->session->set_userdata('user_email',$result['email']);
				$this->session->set_userdata('user_login',$result['login_id']);
				if($this->session->role=='Admin'){
				    $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Login Successful' ,'url' => base_url('db')]));
				}elseif($this->session->role=='Salesperson'){
				     $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Login Successful' ,'url' => base_url('orders')]));
				}elseif($this->session->role=='Operator'){
				     $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Login Successful' ,'url' => base_url('operates')]));
				}elseif($this->session->role=='Vendor'){
				     $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Login Successful' ,'url' => base_url('db')]));
				}elseif($this->session->role=='Manage'){
				     $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Login Successful' ,'url' => base_url('db')]));
				}elseif($this->session->role=='Finance'){
				     $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Login Successful' ,'url' => base_url('finance')]));
				}
				
				return FALSE;
			}

			$this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid username/password']));
			return FALSE;
		}
		
		public function content_panel($id){
			$result = $this->user_model->is_auth_session($id);
			//print_r($result);die;
			if($result) {
				$this->session->set_userdata('role',$result['role']);
				$this->session->set_userdata('user_id',$result['id']);
				$this->session->set_userdata('user_email',$result['email']);
				$this->session->set_userdata('user_login',$result['login_id']);
				if($this->session->role=='Admin'){
				    redirect(base_url('db')); die();
				}elseif($this->session->role=='Salesperson'){
				    redirect(base_url('orders')); die();
				}elseif($this->session->role=='Operator'){
				     redirect(base_url('operates')); die();
				}elseif($this->session->role=='Vendor'){
				    redirect(base_url('vendors')); die();
				}elseif($this->session->role=='Manage'){
				     redirect(base_url('operates')); die();
				}
				
				return FALSE;
			}

			$this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid username/password']));
			return FALSE;
		}

		public function logout(){
			$this->user_model->logout_time();
			$this->session->unset_userdata('role');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('user_email');
			$this->session->unset_userdata('user_login');
			redirect(base_url());
		}

		public function profile(){
			if (!$this->session->role) {
				redirect(base_url()); die();
			}
			    $data['categories'] = $this->user_model->get_categories();
				$data['title'] = ' DAVSY | Profile';
				$data['user_info'] = $this->user_model->user_info();
				$data['scripts'] = ['comman/user.js'];
				$this->load->view('user/common/header',$data);
				//$this->load->view('user/common/side_bar');
				$this->load->view('user/common/nav_bar');
				$this->load->view('user/profile',$data);
				$this->load->view('user/common/footer');			
		}

		public function db($all='all'){
		    if($this->session->role=='Admin' || $this->session->role=='Manage' || $this->session->role=='Vendor'){
				
			$data['scripts'] = ['comman/user.js'];
			$data['user_info'] = $this->user_model->user_info();
			$data['total_rows'] = $this->user_model->total_rows();
			/*$datas = $this->input->post();
			$data['blog'] = $this->user_model->get_all_bl($all);
			
			$data['category'] = $this->user_model->get_all_category();
			$data['price_category1'] = $this->user_model->get_all_price_category();
			$data['names'] = $this->user_model->get_all_names();*/
			$data['title'] = 'TOOL';
			
			//print_r($datas);die;
			
		/*	if(!empty($datas)){
			   
			    $data['start_da'] = $datas['start_da'];
			    $data['end_da'] = $datas['end_da'];
			    $data['start_price'] = $datas['start_price'];
			    $data['end_price'] = $datas['end_price'];
			    $data['from_traffic'] = $datas['from_traffic'];
			    $data['to_traffic'] = $datas['to_traffic'];
			    $data['per_name'] = $datas['per_name'];
			    if(isset($datas['per_category'])){
			        $data['per_category'] = $datas['per_category'];
			    }
			    $data['web_category'] = $datas['web_category'];
			    //$data['price_category'] = $datas['price_category'];
			    if(isset($datas['price_category'])){
			        $data['price_category'] = $datas['price_category'];
			    }
			    $data['start_selling_price'] = $datas['start_selling_price'];
			    $data['end_selling_price'] = $datas['end_selling_price'];
			    $data['contact_from_id'] = $datas['contact_from_id'];
			    $data['vendor_country'] = $datas['vendor_country'];
			    if(isset($datas['duplicate'])){
			        $data['duplicate'] = $datas['duplicate'];
			    }
			    if(isset($datas['niche_choice'])){
			        $data['niche_choice'] = $datas['niche_choice'];
			    }
			    if(empty($datas['agency'])){
			        $data['agency'] = 'no_agency';
			    }
			    
			}*/
			
			$this->load->view('user/common/header',$data);
			//$this->load->view('user/common/side_bar',$data);
			$this->load->view('user/common/nav_bar');
			$this->load->view('user/table_data',$data);
			$this->load->view('user/common/footer');
		    }else{
        		redirect(base_url()); die();
			}
		        
		    }
		
		public function assign($all='all'){
		    if($this->session->role=='Admin' || $this->session->role=='Manage'){
				
			$data['scripts'] = ['comman/user.js'];
			$data['user_info'] = $this->user_model->user_info();
			$datas = $this->input->post();
			 //print_r($datas);die;
			$data['blog'] = $this->user_model->get_all_bl_assign($all);
		
			$data['total_rows'] = $this->user_model->total_rows();
			$data['category'] = $this->user_model->get_all_category();
			$data['price_category1'] = $this->user_model->get_all_price_category();
			$data['names'] = $this->user_model->get_all_names();
			$data['title'] = 'TOOL';
			
			//print_r($datas);die;
			
			if(!empty($datas)){
			   
			    $data['start_da'] = $datas['start_da'];
			    $data['end_da'] = $datas['end_da'];
			    $data['start_price'] = $datas['start_price'];
			    $data['end_price'] = $datas['end_price'];
			    $data['from_traffic'] = $datas['from_traffic'];
			    $data['to_traffic'] = $datas['to_traffic'];
			    $data['per_name'] = $datas['per_name'];
			    if(isset($datas['per_category'])){
			        $data['per_category'] = $datas['per_category'];
			    }
			    $data['web_category'] = $datas['web_category'];
			    //$data['price_category'] = $datas['price_category'];
			    if(isset($datas['price_category'])){
			        $data['price_category'] = $datas['price_category'];
			    }
			    $data['start_selling_price'] = $datas['start_selling_price'];
			    $data['end_selling_price'] = $datas['end_selling_price'];
			    $data['contact_from_id'] = $datas['contact_from_id'];
			    $data['vendor_country'] = $datas['vendor_country'];
			    if(isset($datas['duplicate'])){
			        $data['duplicate'] = $datas['duplicate'];
			    }
			    if(isset($datas['niche_choice'])){
			        $data['niche_choice'] = $datas['niche_choice'];
			    }
			    
			}
			
			$this->load->view('user/common/header',$data);
			//$this->load->view('user/common/side_bar',$data);
			$this->load->view('user/common/nav_bar');
			$this->load->view('user/assign_sheet',$data);
			$this->load->view('user/common/footer');
		    }else{
        		redirect(base_url()); die();
			}
		        
		    }
		    
		public function ms($all=''){
		    
				
			$data['scripts'] = ['comman/user.js'];
			$data['user_info'] = $this->user_model->user_info();
			$datas = $this->input->post();
			 //print_r($datas);die;
			$data['blog'] = $this->user_model->get_all_ms($all);
		
			$data['total_rows'] = $this->user_model->total_rows_ms();
			$data['category'] = $this->user_model->get_all_category_ms();
			//$data['price_category1'] = $this->user_model->get_all_price_category();
			$data['names'] = $this->user_model->get_all_names_ms();
			$data['title'] = 'TOOL';
			
			//print_r($datas);die;
			
			if(!empty($datas)){
			   
			    $data['start_da'] = $datas['start_da'];
			    $data['end_da'] = $datas['end_da'];
			    $data['start_price'] = $datas['start_price'];
			    $data['end_price'] = $datas['end_price'];
			    $data['from_traffic'] = $datas['from_traffic'];
			    $data['to_traffic'] = $datas['to_traffic'];
			    $data['per_name'] = $datas['per_name'];
			    $data['vendor_country'] = $datas['vendor_country'];
			    if(isset($datas['duplicate'])){
			        $data['duplicate'] = $datas['duplicate'];
			    }
			    if(isset($datas['niche_choice'])){
			        $data['niche_choice'] = $datas['niche_choice'];
			    }
			    
			}
			
			$this->load->view('user/common/header',$data);
			//$this->load->view('user/common/side_bar',$data);
			$this->load->view('user/common/nav_bar');
			$this->load->view('user/table_ms',$data);
			$this->load->view('user/common/footer');
		    
		        
		    }
		    
		    public function agency($all=''){
		    
				
			$data['scripts'] = ['comman/user.js'];
			$data['user_info'] = $this->user_model->user_info();
			$datas = $this->input->post();
			 //print_r($datas);die;
			$data['blog'] = $this->user_model->get_all_agency($all);
		
			$data['total_rows'] = $this->user_model->total_rows_agency();
			$data['category'] = $this->user_model->get_all_category_agency();
			//$data['price_category1'] = $this->user_model->get_all_price_category();
			$data['names'] = $this->user_model->get_all_names_agency();
			$data['title'] = 'TOOL';
			
			//print_r($datas);die;
			
			if(!empty($datas)){
			   
			    $data['start_da'] = $datas['start_da'];
			    $data['end_da'] = $datas['end_da'];
			    $data['start_price'] = $datas['start_price'];
			    $data['end_price'] = $datas['end_price'];
			    $data['from_traffic'] = $datas['from_traffic'];
			    $data['to_traffic'] = $datas['to_traffic'];
			    $data['per_name'] = $datas['per_name'];
			    $data['vendor_country'] = $datas['vendor_country'];
			    if(isset($datas['duplicate'])){
			        $data['duplicate'] = $datas['duplicate'];
			    }
			    if(isset($datas['niche_choice'])){
			        $data['niche_choice'] = $datas['niche_choice'];
			    }
			    
			}
			
			$this->load->view('user/common/header',$data);
			//$this->load->view('user/common/side_bar',$data);
			$this->load->view('user/common/nav_bar');
			$this->load->view('user/table_agency',$data);
			$this->load->view('user/common/footer');
		    
		        
		    }
        
        public function aid($all='all'){
		    if($this->session->role=='Admin' || $this->session->role=='Operator' || $this->session->role=='Salesperson' || $this->session->role=='Vendors' || $this->session->role=='Manage'){
				
			$data['scripts'] = ['comman/user.js'];
			$data['user_info'] = $this->user_model->user_info();
			//$datas = $this->input->post();
			 //print_r($datas);die;
			//$data['blog'] = $this->user_model->get_all_bl($all);
		
			//$data['total_rows'] = $this->user_model->total_rows();
			//$data['category'] = $this->user_model->get_all_category();
			//$data['price_category1'] = $this->user_model->get_all_price_category();
			//$data['names'] = $this->user_model->get_all_names();
			$data['title'] = 'TOOL';
			
			//print_r($datas);die;
			
			/*if(!empty($datas)){
			   
			    $data['start_da'] = $datas['start_da'];
			    $data['end_da'] = $datas['end_da'];
			    $data['start_price'] = $datas['start_price'];
			    $data['end_price'] = $datas['end_price'];
			    $data['from_traffic'] = $datas['from_traffic'];
			    $data['to_traffic'] = $datas['to_traffic'];
			    //$data['per_name'] = $datas['per_name'];
			    if(isset($datas['per_category'])){
			        $data['per_category'] = $datas['per_category'];
			    }
			    $data['web_category'] = $datas['web_category'];
			    //$data['price_category'] = $datas['price_category'];
			    if(isset($datas['price_category'])){
			        $data['price_category'] = $datas['price_category'];
			    }
			     if(isset($datas['niche_choice'])){
			        $data['niche_choice'] = $datas['niche_choice'];
			    }
			    //$data['start_selling_price'] = $datas['start_selling_price'];
			    //$data['end_selling_price'] = $datas['end_selling_price'];
			    //$data['contact_from_id'] = $datas['contact_from_id'];
			    $data['vendor_country'] = $datas['vendor_country'];
			    
			}*/
			
			$this->load->view('user/common/header',$data);
			//$this->load->view('user/common/side_bar',$data);
			$this->load->view('user/common/nav_bar');
			$this->load->view('user/aid',$data);
			$this->load->view('user/common/footer');
		    }else{
        		redirect(base_url()); die();
			}
		        
		    }
		    
		    public function language_tool(){
    		    if($this->session->role=='Admin' || $this->session->role=='Operator' || $this->session->role=='Salesperson' || $this->session->role=='Vendors' || $this->session->role=='Manage'){
        			$data['scripts'] = ['comman/user.js'];
        			$data['user_info'] = $this->user_model->user_info();
        			$data['languagewise'] = $this->user_model->languagedata();
        			//echo '<pre>'; print_r($data['languagewise']);die;
        			$data['title'] = 'LANGUAGE TOOL';
        			$this->load->view('user/common/header',$data);
        			//$this->load->view('user/common/side_bar',$data);
        			$this->load->view('user/common/nav_bar');
        			$this->load->view('user/language_tool',$data);
        			$this->load->view('user/common/footer');
    		    }else{
            		redirect(base_url()); die();
    			}
		    }

        public function agencydata($all='all'){
		    if($this->session->role=='Admin' || $this->session->role=='Operator' || $this->session->role=='Salesperson' || $this->session->role=='Vendors' || $this->session->role=='Manage'){
				
			$data['scripts'] = ['comman/user.js'];
			$data['user_info'] = $this->user_model->user_info();
			//$datas = $this->input->post();
			 //print_r($datas);die;
			//$data['blog'] = $this->user_model->get_all_bl($all);
			//$data['total_rows'] = $this->user_model->total_rows();
			//$data['category'] = $this->user_model->get_all_category();
			//$data['price_category1'] = $this->user_model->get_all_price_category();
			//$data['names'] = $this->user_model->get_all_names();
			$data['title'] = 'TOOL';
			//print_r($datas);die;
			/*if(!empty($datas)){
			    $data['start_da'] = $datas['start_da'];
			    $data['end_da'] = $datas['end_da'];
			    $data['start_price'] = $datas['start_price'];
			    $data['end_price'] = $datas['end_price'];
			    $data['from_traffic'] = $datas['from_traffic'];
			    $data['to_traffic'] = $datas['to_traffic'];
			    //$data['per_name'] = $datas['per_name'];
			    if(isset($datas['per_category'])){
			        $data['per_category'] = $datas['per_category'];
			    }
			    $data['web_category'] = $datas['web_category'];
			    //$data['price_category'] = $datas['price_category'];
			    if(isset($datas['price_category'])){
			        $data['price_category'] = $datas['price_category'];
			    }
			     if(isset($datas['niche_choice'])){
			        $data['niche_choice'] = $datas['niche_choice'];
			    }
			    //$data['start_selling_price'] = $datas['start_selling_price'];
			    //$data['end_selling_price'] = $datas['end_selling_price'];
			    //$data['contact_from_id'] = $datas['contact_from_id'];
			    $data['vendor_country'] = $datas['vendor_country'];
			    
			}*/
			
			$this->load->view('user/common/header',$data);
			//$this->load->view('user/common/side_bar',$data);
			$this->load->view('user/common/nav_bar');
			$this->load->view('user/agency_data',$data);
			$this->load->view('user/common/footer');
		    }else{
        		redirect(base_url()); die();
			}
		        
		    }

		public function delete_sites($id){
			$result = $this->user_model->data_deletion_site($id);
			if($result){
				redirect(base_url('db')); die();
			}
		}
		
		public function delete_order($id){
			$result = $this->user_model->order_deletion($id);
			if($result){
				redirect(base_url('orders')); die();
			}
		}
		
		public function delete_client($id){
			$result = $this->user_model->client_deletion($id);
			if($result){
				redirect(base_url('clients')); die();
			}
		}
		public function delete_user($id){
			$result = $this->user_model->user_deletion($id);
			if($result){
				redirect(base_url('users')); die();
			}
		}
		public function delete_vendor($id){
			$result = $this->user_model->vendor_deletion($id);
			if($result){
				redirect(base_url('vendors')); die();
			}
		}

		public function functions(){
        $glo = 1;
        set_time_limit(300);
        if(isset($_POST["Import"])){
		
		$filename=time().'.csv';	
		move_uploaded_file($_FILES["file"]["tmp_name"], 'imports/'.$filename);
        if($_FILES["file"]["size"] > 0)
		 {
		    $all_sites = $this->db->get_where('tbl_sites')->result_array();
		    //$primary_id = $all_sites[count($all_sites)-1]['id'];
		    $site_ids = array_column($all_sites,'id');
		    //print_r($primary_id);die;
		  	$file = fopen(base_url('imports/'.$filename), "r");
		  	$short_url = '';
	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         { 
                if(!in_array($getData[0],$site_ids) && $glo >2  && !empty($getData[0]) && !empty($getData[1]) && !empty($getData[2]) && !empty($getData[3]) && !empty($getData[4]) && !empty($getData[6]) && !empty($getData[7]) && !empty($getData[8]) && !empty($getData[11]) && !empty($getData[12]) && !empty($getData[13])){
                    $data['id'] = $getData[0];
                    $data['website'] = $getData[1];
                    $data['niche'] = $getData[2];
                    $data['person'] = $getData[3];
                    $data['price_category'] = $getData[4];
                    $data['price'] = $getData[5];
                    $data['discount'] = $getData[6];
                    $data['sailing_price'] = $getData[7];
                    $data['follow'] = $getData[8];
                    $data['da'] = $getData[9];
                    $data['traffic'] = $getData[10];
                    $data['web_category'] = $getData[11];
                    $data['contact'] = $getData[12];
                    $data['contact_from'] = $getData[13];
                    $data['remark'] = $getData[14];
                    $data['manual_date'] = date('Y-m-d');
                    $data['timestamp'] = time();
                    $this->db->insert('tbl_sites',$data);
    				
			    }elseif(in_array($getData[0],$site_ids)){

					echo "<script type=\"text/javascript\">
							alert(\"this (".$getData[0].") Duplicate Entry is not acceptable.\");
							window.location = \"db\"
						  </script>";	
				}elseif($glo >2){

				echo "<script type=\"text/javascript\">
							alert(\"something wrong with this Sr.No. (".$getData[0].").\");
							window.location = \"db\"
						  </script>";	
				}
				$glo++;
				
	         }
			
	         fclose($file);
	         echo "<script type=\"text/javascript\">alert(\"CSV File has been successfully Imported.\");
	         window.location = \"db\"</script>";
		 }
	}	 
    }

    public function getAddresses($domain='https://smuggbugg.com') {
    	$data = $this->user_model->get_all_websitess();//echo'<pre>';print_r($data);die;
    	foreach($data as $value){
    	    $short_url = str_replace('www.', '', $value['website']);
    	    $short_url = str_replace('https://', '', $short_url);
    	    $short_url = str_replace('http://', '', $short_url);
	        $short_url = str_replace('/', '', $short_url);
	        $ip = gethostbyname($short_url);
            $geopluginURL='http://www.geoplugin.net/php.gp?ip='.$ip;
            $addrDetailsArr = unserialize(file_get_contents($geopluginURL)); 
            //echo'<pre>';print_r($addrDetailsArr);die;
            $this->db->where('id',$value['id']);
            $this->db->update('tbl_sites',['web_ip'=>$ip,'web_country'=>$addrDetailsArr['geoplugin_countryName']]);
    	   
    	}
	    echo 'www.'.$short_url; die;
          $records = dns_get_record($domain);
          $res = array();
          foreach ($records as $r) {
            if ($r['host'] != $domain) continue; // glue entry
            if (!isset($r['type'])) continue; // DNSSec
        
            if ($r['type'] == 'A') $res[] = $r['ip'];
            if ($r['type'] == 'AAAA') $res[] = $r['ipv6'];
          }
          print_r($records);
        }
public function getAddresses_www($domain) {
  $res = $this->getAddresses($domain);
  
  if (count($res) == 0) {
    $res = $this->getAddresses('www.' . $domain);
  }
  if(!empty($res[0])){
      return $res[0];
  }
  
}

    public function moz_data($range=''){
        //echo '<pre>';print_r($range);die;
    	set_time_limit(900);
    	$accessID = "mozscape-d0a271e850";
    	$secretKey = "ca7e6fe84d4cfc5645db33f4f8fe9001";
        // Set your expires times for several minutes into the future.
        // An expires time excessively far in the future will not be honored by the Mozscape API.
    	$expires = time() + 300;

        // Put each parameter on a new line.
    	$stringToSign = $accessID."\n".$expires;
        // Get the "raw" or binary output of the hmac hash.
    	$binarySignature = hash_hmac('sha1', $stringToSign, $secretKey, true);
        // Base64-encode it and then url-encode that.
    	$urlSafeSignature = urlencode(base64_encode($binarySignature));
        // Add up all the bit flags you want returned.
        // Learn more here: https://moz.com/help/guides/moz-api/mozscape/api-reference/url-metrics
    	$cols = "103079215108";
    	$max = $range+50;
    	$all_sites = $this->db->get_where('tbl_sites',['id>='=>$range,'id<'=>$max])->result_array();
    	$batchedDomains = array_column($all_sites,'website');
    	$batchids = array_column($all_sites,'id');
        // Put it all together and you get your request URL.

    	$requestUrl = "http://lsapi.seomoz.com/linkscape/url-metrics/?Cols=".$cols."&AccessID=".$accessID."&Expires=".$expires."&Signature=".$urlSafeSignature;
        // Put your URLS into an array and json_encode them.
        //$batchedDomains = $sites;
    	$main_array = array_chunk($batchedDomains, 10);
    	$main_ids = array_chunk($batchids, 10);

        //echo '<pre>';print_r($main_ids);die;
    	$count = 0;
    	foreach ($main_array as $key => $value) {
    		$encodedDomains = json_encode($value);
        // Use Curl to send off your request.
        // Send your encoded list of domains through Curl's POSTFIELDS.
    		$options = array(
    			CURLOPT_RETURNTRANSFER => true,
    			CURLOPT_POSTFIELDS     => $encodedDomains
    		);
    		$ch = curl_init($requestUrl);
    		curl_setopt_array($ch, $options);
    		$content = curl_exec($ch);
    		curl_close( $ch );
    		$contents = json_decode($content);
    		echo '<pre>';print_r($contents);die;
    		foreach ($contents as $key1 => $value) {
    			$data['da'] = $value->pda;
    			$data['pa'] = $value->upa;
	         	//$short_url = str_replace('www.', '', $value->uu);
	         	//$short_url = str_replace('/', '', $short_url);
    			//$data['ip_address'] = $this->getAddresses_www($short_url);
    			//$alexa = $this->alexa($value->uu);
    			//$data['alexa_country_rank'] = $alexa['country_rank'];
    			//$data['alexa_world'] = $alexa['global_rank'];
    			//$data['alexa_country'] = $alexa['country_name'];
    			$this->db->where('id',$main_ids[$count][$key1]);
    			$this->db->update('tbl_sites',$data);
    		}
    		$count++;

    	}
    	redirect(base_url('db'));die();
    } 

    public function alexa($url=''){
		$api_url = "http://data.alexa.com/data?cli=10&url=".$url;
		$response = file_get_contents($api_url);
		$xml = simplexml_load_string($response);
		$data['global_rank'] = $xml->SD->POPULARITY['TEXT'];
		$data['country_name'] = $xml->SD->COUNTRY['NAME'];
		$data['country_rank'] = $xml->SD->COUNTRY['RANK'];
		$delta = $xml->SD->RANK['DELTA'];
		print_r($data);die;
    }

    public function add_site($id=''){
    	$data['scripts'] = ['comman/user.js'];
		$data['user_info'] = $this->user_model->user_info();
		$data['title'] = 'DB';
		if(!empty($id)){
			$data['site_info'] = $this->user_model->site_info($id);
		}
		//print_r($data['site_info']);die;
		$data['vendor_id'] = $this->user_model->vendor_id();
		//print_r($data['vendor_id']);die;
		$this->load->view('user/common/header',$data);
		//$this->load->view('user/common/side_bar',$data);
		$this->load->view('user/common/nav_bar');
		$this->load->view('user/add_site',$data);
		$this->load->view('user/common/footer');
    }  
    
    public function add_language_site($id=''){
    	$data['scripts'] = ['comman/user.js'];
		$data['user_info'] = $this->user_model->user_info();
		$data['title'] = 'DB';
		if(!empty($id)){
			$data['site_info'] = $this->user_model->language_site_info($id);
		}
		//print_r($data['site_info']);die;
		$data['vendor_id'] = $this->user_model->vendor_id();
		//print_r($data['vendor_id']);die;
		$this->load->view('user/common/header',$data);
		//$this->load->view('user/common/side_bar',$data);
		$this->load->view('user/common/nav_bar');
		$this->load->view('user/add_language_site',$data);
		$this->load->view('user/common/footer');
    }  

    public function do_add_site(){
    	$this->output->set_content_type('application/json');
			$this->form_validation->set_rules('person_id','Vendor ID','required');
			$this->form_validation->set_rules('website','Webite URL','required|is_unique[tbl_sites.website]');
			$this->form_validation->set_rules('niche','Category','required');
			$this->form_validation->set_rules('price','Price','required');
			$this->form_validation->set_rules('traffic','Website Traffic','required');
			if($this->form_validation->run()===FALSE) {
				$this->output->set_output(json_encode(['result' => 0,'errors' => $this->form_validation->error_array()]));
				return FALSE;
			}
			$result = $this->user_model->do_add_site();
			if($result){
			    if($this->session->role=='Vendor'){
				    $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Site Added Successfully','url'=>base_url('vendors')]));
			    }else{
			        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Site Added Successfully','url'=>base_url('db')]));
			    }
				return FALSE;
			}
    } 
    
     public function do_add_language_site(){
    	$this->output->set_content_type('application/json');
			$this->form_validation->set_rules('person_id','Vendor ID','required');
			$this->form_validation->set_rules('website','Webite URL','required|is_unique[tbl_sites.website]');
			$this->form_validation->set_rules('niche','Category','required');
			$this->form_validation->set_rules('price','Price','required');
			$this->form_validation->set_rules('traffic','Website Traffic','required');
			$this->form_validation->set_rules('language','Site Language','required');
			if($this->form_validation->run()===FALSE) {
				$this->output->set_output(json_encode(['result' => 0,'errors' => $this->form_validation->error_array()]));
				return FALSE;
			}
			//echo 'sujeet';die;
			$result = $this->user_model->do_add_language_site();
			if($result){
			    if($this->session->role=='Vendor'){
				    $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Site Added Successfully','url'=>base_url('vendors')]));
			    }else{
			        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Site Added Successfully','url'=>base_url('db')]));
			    }
				return FALSE;
			}
    } 

    public function do_update_site($id){
    	$this->output->set_content_type('application/json');
			$this->form_validation->set_rules('person_id','Vendor ID','required');
			$this->form_validation->set_rules('website','Webite URL','required');
			$this->form_validation->set_rules('niche','Category','required');
			$this->form_validation->set_rules('price','Price','required');
			$this->form_validation->set_rules('traffic','Website Traffic','required');
			if($this->form_validation->run()===FALSE) {
				$this->output->set_output(json_encode(['result' => 0,'errors' => $this->form_validation->error_array()]));
				return FALSE;
			}
			$result = $this->user_model->do_update_site($id);
			if($result){
				$this->output->set_output(json_encode(['result' => 1, 'msg' => 'Site Updated Successfully','url'=>base_url('db')]));
				return FALSE;
			}
    } 
    
    public function do_update_language_site($id){
    	$this->output->set_content_type('application/json');
			$this->form_validation->set_rules('person_id','Vendor ID','required');
			$this->form_validation->set_rules('website','Webite URL','required');
			$this->form_validation->set_rules('niche','Category','required');
			$this->form_validation->set_rules('price','Price','required');
			$this->form_validation->set_rules('traffic','Website Traffic','required');
			$this->form_validation->set_rules('language','Site Language','required');
			if($this->form_validation->run()===FALSE) {
				$this->output->set_output(json_encode(['result' => 0,'errors' => $this->form_validation->error_array()]));
				return FALSE;
			}
			$result = $this->user_model->do_update_language_site($id);
			if($result){
				$this->output->set_output(json_encode(['result' => 1, 'msg' => 'Site Updated Successfully','url'=>base_url('db')]));
				return FALSE;
			}
    } 

    public function site_info($id){
    	$data['scripts'] = ['comman/user.js'];
		$data['user_info'] = $this->user_model->user_info();
		$data['site_info'] = $this->user_model->site_info($id);
		$data['title'] = 'DB';
		$this->load->view('user/common/header',$data);
		//$this->load->view('user/common/side_bar',$data);
		$this->load->view('user/common/nav_bar');
		$this->load->view('user/view_site',$data);
		$this->load->view('user/common/footer');
    } 
    
    public function add_user($id=''){
    	$data['scripts'] = ['comman/user.js'];
		$data['user_info'] = $this->user_model->user_info();
		$data['title'] = 'DB';
		if(!empty($id)){
			$data['user_infor'] = $this->user_model->user_infor($id);
		}	
		$this->load->view('user/common/header',$data);
		//$this->load->view('user/common/side_bar',$data);
		$this->load->view('user/common/nav_bar');
		$this->load->view('user/add_user',$data);
		$this->load->view('user/common/footer');
    }
    
    /*This function Adds new user*/
    public function do_add_user(){
    	$this->output->set_content_type('application/json');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('email','Email','required');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('role','Role','required');
		if($this->form_validation->run()===FALSE) {
			$this->output->set_output(json_encode(['result' => 0,'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
		$result = $this->user_model->do_add_user();
		if($result){
			$this->output->set_output(json_encode(['result' => 1, 'msg' => 'User Added Successfully','url'=>base_url('users')]));
			return FALSE;
		}
    } 
    
    public function do_update_user($id){
    	$this->output->set_content_type('application/json');
			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('email','Email','required');
			$this->form_validation->set_rules('password','Password','required');
			$this->form_validation->set_rules('role','Role','required');
			if($this->form_validation->run()===FALSE) {
				$this->output->set_output(json_encode(['result' => 0,'errors' => $this->form_validation->error_array()]));
				return FALSE;
			}
			$result = $this->user_model->do_update_user($id);
			if($result){
				$this->output->set_output(json_encode(['result' => 1, 'msg' => 'User Updated Successfully','url'=>base_url('users')]));
				return FALSE;
			}
			$this->output->set_output(json_encode(['result' => 1, 'msg' => 'You have not updated anything']));
			return FALSE;
    } 
    
    public function add_client($id=''){
    	$data['scripts'] = ['comman/user.js'];
		$data['user_info'] = $this->user_model->user_info();
		$data['title'] = 'DB';
		if(!empty($id)){
			$data['client_info'] = $this->user_model->client_info($id);
		}
		
		$this->load->view('user/common/header',$data);
		//$this->load->view('user/common/side_bar',$data);
		$this->load->view('user/common/nav_bar');
		$this->load->view('user/add_client',$data);
		$this->load->view('user/common/footer');
    }
    
    public function do_add_client(){
    	$this->output->set_content_type('application/json');
			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('email','Email','required');
			//->form_validation->set_rules('phone','Mobile','required');
			//$this->form_validation->set_rules('fb_id','FB ID','required');
			//$this->form_validation->set_rules('contacted_id','Contacted From','required');
			//$this->form_validation->set_rules('site_name','Site Name','required');
			if($this->form_validation->run()===FALSE) {
				$this->output->set_output(json_encode(['result' => 0,'errors' => $this->form_validation->error_array()]));
				return FALSE;
			}
			$result = $this->user_model->do_add_client();
			if($result){
				$this->output->set_output(json_encode(['result' => 1, 'msg' => 'User Added Successfully','url'=>base_url('clients')]));
				return FALSE;
			}
    }
    
    public function do_update_client($id){
    	$this->output->set_content_type('application/json');
			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('email','Email','required');
			//$this->form_validation->set_rules('phone','Mobile','required');
			//$this->form_validation->set_rules('fb_id','FB ID','required');
			////$this->form_validation->set_rules('contacted_id','Contacted From','required');
			$this->form_validation->set_rules('site_name','Site Name','required');
			if($this->form_validation->run()===FALSE) {
				$this->output->set_output(json_encode(['result' => 0,'errors' => $this->form_validation->error_array()]));
				return FALSE;
			}
			$result = $this->user_model->do_update_client($id);
			if($result){
				$this->output->set_output(json_encode(['result' => 1, 'msg' => 'User Updated Successfully','url'=>base_url('clients')]));
				return FALSE;
			}
    }
    
    public function clients(){
        if($this->session->role=='Admin' || $this->session->role=='Salesperson'){
			$data['scripts'] = ['comman/user.js'];
			$data['user_info'] = $this->user_model->user_info();
			$data['title'] = 'TOOL';
			 //print_r($datas);die;
			$data['clients'] = $this->user_model->get_all_clients();
			//echo "<pre>"; print_r($data['clients']);die();
			$this->load->view('user/common/header',$data);
			//$this->load->view('user/common/side_bar',$data);
			$this->load->view('user/common/nav_bar');
			$this->load->view('user/clients',$data);
			$this->load->view('user/common/footer');
		}else{
		    redirect(base_url()); die();
			}
    }
    
    public function users(){
        if($this->session->role!='Admin'){
				redirect(base_url()); die();
			}
			$data['scripts'] = ['comman/user.js'];
			$data['user_info'] = $this->user_model->user_info();
			$data['title'] = 'TOOL';
			 //print_r($datas);die;
			$data['users'] = $this->user_model->get_all_users();
			$this->load->view('user/common/header',$data);
			//$this->load->view('user/common/side_bar',$data);
			$this->load->view('user/common/nav_bar');
			$this->load->view('user/users',$data);
			$this->load->view('user/common/footer');
    }
    
    public function vendors(){
        if($this->session->role=='Admin' || $this->session->role=='Vendor' || $this->session->role=='Manage'){
			
			$data['scripts'] = ['comman/user.js'];
			$data['user_info'] = $this->user_model->user_info();
			$data['title'] = 'TOOL';
			 //print_r($datas);die;
			 $data['blog'] = $this->user_model->get_all_bl('all');
		
			$data['total_rows'] = $this->user_model->total_rows();
			$data['category'] = $this->user_model->get_all_category();
			$data['price_category1'] = $this->user_model->get_all_price_category();
			$data['names'] = $this->user_model->get_all_names();
			$data['vendors'] = $this->user_model->get_all_vendors();
			$this->load->view('user/common/header',$data);
			//$this->load->view('user/common/side_bar',$data);
			$this->load->view('user/common/nav_bar');
			if($this->session->role=='Admin' || $this->session->role=='Manage' || $this->session->role=='Operator'){
			    $this->load->view('user/vendor',$data);
			}
			if($this->session->role=='Vendor'){
			    $this->load->view('user/ind_vendor',$data);
			}
			$this->load->view('user/common/footer');
		}else{	
		    redirect(base_url()); die();
			}
    }
    
    public function add_vendor($id=''){
    	$data['scripts'] = ['comman/user.js'];
		$data['user_info'] = $this->user_model->user_info();
		$data['title'] = 'DB';
		if(!empty($id)){
			$data['vendor_info'] = $this->user_model->vendor_info($id);
		}	
		$this->load->view('user/common/header',$data);
		//$this->load->view('user/common/side_bar',$data);
		$this->load->view('user/common/nav_bar');
		$this->load->view('user/add_vendor',$data);
		$this->load->view('user/common/footer');
    }
    
    public function do_add_vendor(){
    	$this->output->set_content_type('application/json');
			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('email','Email','required|is_unique[tbl_vendors.email]');
			//$this->form_validation->set_rules('phone','Mobile','required');
			if($this->form_validation->run()===FALSE) {
				$this->output->set_output(json_encode(['result' => 0,'errors' => $this->form_validation->error_array()]));
				return FALSE;
			}
			$result = $this->user_model->do_add_vendor();
			//print_r($result);die;
			if($result){
				$this->output->set_output(json_encode(['result' => 1, 'msg' => 'User Added Successfully Vendor ID '.$result.'','url'=>base_url('vendors')]));
				return FALSE;
			}
    }
    
    public function do_update_vendor($id){
    	$this->output->set_content_type('application/json');
			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('email','Email','required');
			if($this->form_validation->run()===FALSE) {
				$this->output->set_output(json_encode(['result' => 0,'errors' => $this->form_validation->error_array()]));
				return FALSE;
			}
			$result = $this->user_model->do_update_vendor($id);
			if($result){
				$this->output->set_output(json_encode(['result' => 1, 'msg' => 'User Updated Successfully','url'=>base_url('vendors')]));
				return FALSE;
			}
    }
    
    public function orders(){
        if($this->session->role=='Admin' || $this->session->role=='Salesperson'){
			$data['scripts'] = ['comman/user.js'];
			$data['user_info'] = $this->user_model->user_info();
			$data['title'] = 'TOOL';
			$data['orders'] = $this->user_model->get_all_orders_main();
			$data['order_numbers'] = $this->user_model->get_all_order_numbers();
			//echo '<pre>';print_r($data['orders']);die;
			$data['cnfrom'] = $this->user_model->get_all_orders_contacted_from();
			$data['adby'] = $this->user_model->get_all_orders_added_by();
			$data['clients'] = $this->user_model->get_all_clients();
			//echo '<pre>';print_r($data['orders']);die;
			$data['filter'] = $this->input->post();
			/*if(!empty($datas)){
			    $data['order_numbers'] = $datas['order_number'];
			}*/
			$this->load->view('user/common/header',$data);
			//$this->load->view('user/common/side_bar',$data);
			$this->load->view('user/common/nav_bar');
			$this->load->view('user/orders',$data);
			$this->load->view('user/common/footer');
		}	else{
			    redirect(base_url()); die();
			}
    }
    
    public function getwebsites(){
		    $this->db->select('id,website');
		    $data = $this->db->get('tbl_sites')->result_array();
		    $this->db->select('website,person');
		    $datas = $this->db->get('tbl_olt')->result_array();
		    $result = array_merge($data,$datas);
		    return $result;
		}
    
    public function add_order($id=''){
    	$data['scripts'] = ['comman/user.js'];
		$data['user_info'] = $this->user_model->user_info();
		$data['title'] = 'DB';
		if(!empty($id)){
			$data['order_info'] = $this->user_model->order_info($id);//print_r($data['order_info']);die;
		}
		
		$data['last_id'] = $this->user_model->order_last_id();
		$data['websites'] = $this->user_model->get_all_websites();
		$data['clients'] = $this->user_model->get_all_clients();
		$this->load->view('user/common/header',$data);
		//$this->load->view('user/common/side_bar',$data);
		$this->load->view('user/common/nav_bar');
		$this->load->view('user/add_order',$data);
		$this->load->view('user/common/footer');
    }
		
	public function add_order_test($id=''){
    	$data['scripts'] = ['comman/user.js'];
		$data['user_info'] = $this->user_model->user_info();
		$data['title'] = 'DB';
		if(!empty($id)){
			$data['order_info'] = $this->user_model->order_info($id);//print_r($data['order_info']);die;
		}
		$data['last_id'] = $this->user_model->order_last_id();
		$data['websites'] = $this->user_model->get_all_websites();
		$data['clients'] = $this->user_model->get_all_clients();
		$this->load->view('user/common/header',$data);
		//$this->load->view('user/common/side_bar',$data);
		$this->load->view('user/common/nav_bar');
		$this->load->view('user/add_order_test',$data);
		$this->load->view('user/common/footer');
    }
    
    public function do_add_order(){
    	$this->output->set_content_type('application/json');
			$this->form_validation->set_rules('client_name','Name','required');
			$this->form_validation->set_rules('client_email','Email','required');
			$this->form_validation->set_rules('order_number', 'Order Number', 'required|is_unique[tbl_orders.order_number]');
			if($this->form_validation->run()===FALSE) {
				$this->output->set_output(json_encode(['result' => 0,'errors' => $this->form_validation->error_array()]));
				return FALSE;
			}
			$result = $this->user_model->do_add_order();
			if($result){
			    if($result == 'fals'){
			        $this->output->set_output(json_encode(['result' => 2, 'msg' => 'This site does not have cost price for this specific site type Hence, the order can not be added','url'=>base_url('orders')]));
				    return FALSE;
			    }
				$this->output->set_output(json_encode(['result' => 1, 'msg' => 'User Added Successfully','url'=>base_url('orders')]));
				return FALSE;
			}
    }
    
    public function do_updation_order($id){
        $data = $this->input->post();
    	$this->output->set_content_type('application/json');
			$this->form_validation->set_rules('client_name','Client Name','required');
			//$this->form_validation->set_rules('client_email','Email','required');
			if($this->form_validation->run()===FALSE) {
				$this->output->set_output(json_encode(['result' => 0,'errors' => $this->form_validation->error_array()]));
				return FALSE;
			}
			$result = $this->user_model->do_updation_order($id);
			if($result){
				$this->output->set_output(json_encode(['result' => 1, 'msg' => 'Order Updated Successfully','url'=>base_url('orders')]));
				return FALSE;
			}
    }
    
    public function edit_order($id=''){
    	$data['scripts'] = ['comman/user.js'];
		$data['user_info'] = $this->user_model->user_info();
		$data['title'] = 'DB';
		if(!empty($id)){
			$data['order_info'] = $this->user_model->order_info($id);
		}
		$data['last_id'] = $this->user_model->order_last_id();
		$data['websites'] = $this->user_model->get_all_websites();
		$data['clients'] = $this->user_model->get_all_clients();
		$this->load->view('user/common/header',$data);
		//$this->load->view('user/common/side_bar',$data);
		$this->load->view('user/common/nav_bar');
		$this->load->view('user/edit_order',$data);
		$this->load->view('user/common/footer');
    }
    
    public function do_updation_orders($id){
    	$this->output->set_content_type('application/json');
			$this->form_validation->set_rules('client_name','Client Name','required');
			//$this->form_validation->set_rules('client_email','Email','required');
			if($this->form_validation->run()===FALSE) {
				$this->output->set_output(json_encode(['result' => 0,'errors' => $this->form_validation->error_array()]));
				return FALSE;
			}
			$result = $this->user_model->do_updation_orders($id);
			if($result){
				$this->output->set_output(json_encode(['result' => 1, 'msg' => 'Order Updated Successfully','url'=>base_url('account')]));
				return FALSE;
			}
    }
    
    
    public function operates(){
        if($this->session->role=='Admin' || $this->session->role=='Operator' || $this->session->role=='Manage'){
			$data['scripts'] = ['comman/user.js'];
			$data['user_info'] = $this->user_model->user_info();
			$data['title'] = 'TOOL';
			 //
			$data['orders'] = $this->user_model->get_all_orders_ven();
			//$data['orderss'] = $this->user_model->get_all_orders_number();
			$data['vendors'] = $this->user_model->get_all_vendors_operate();
			$data['filter'] = $this->input->post();
			//print_r($data['filter']);die;
			$this->load->view('user/common/header',$data);
			//$this->load->view('user/common/side_bar',$data);
			$this->load->view('user/common/nav_bar');
			$this->load->view('user/operate',$data);
			$this->load->view('user/common/footer');
        }else{
            redirect(base_url()); die();
			}
    }
		
	public function sujeet(){
        if($this->session->role=='Admin' || $this->session->role=='Operator' || $this->session->role=='Manage'){
			$data['scripts'] = ['comman/user.js'];
			$data['user_info'] = $this->user_model->user_info();
			$data['title'] = 'TOOL';
			 //
			$data['orders'] = $this->user_model->get_all_orders_ven();
			$data['orderss'] = $this->user_model->get_all_orders_number();
			$data['vendors'] = $this->user_model->get_all_vendors();
			$data['filter'] = $this->input->post();
			echo '<pre>'; print_r($data['orders']);die;
			$this->load->view('user/common/header',$data);
			//$this->load->view('user/common/side_bar',$data);
			$this->load->view('user/common/nav_bar');
			$this->load->view('user/operate',$data);
			$this->load->view('user/common/footer');
        }else{
            redirect(base_url()); die();
			}
    }
    
    public function update_order($id=''){
    	$data['scripts'] = ['comman/user.js'];
		$data['user_info'] = $this->user_model->user_info();
		$data['title'] = 'DB';
		if(!empty($id)){
			$data['site_info'] = $this->user_model->site_info($id);
		}	
		$data['order'] = $this->user_model->get_single_order($id);
		$this->load->view('user/common/header',$data);
		//$this->load->view('user/common/side_bar',$data);
		$this->load->view('user/common/nav_bar');
		$this->load->view('user/update_order',$data);
		$this->load->view('user/common/footer');
    }
    
    public function do_update_order($id){
    	$this->output->set_content_type('application/json');
			$this->form_validation->set_rules('status','Order Status','required');
			//$this->form_validation->set_rules('client_email','Email','required');
			if($this->form_validation->run()===FALSE) {
				$this->output->set_output(json_encode(['result' => 0,'errors' => $this->form_validation->error_array()]));
				return FALSE;
			}
			$result = $this->user_model->do_update_order($id);
			if($result){
				$this->output->set_output(json_encode(['result' => 1, 'msg' => 'Order Updated Successfully','url'=>base_url('operates')]));
				return FALSE;
			}
    }
    
    public function client_email($id){
        $data = $this->user_model->find_email($id);
        echo $data['email'];
    }
    
    public function finance(){
        if($this->session->role=='Admin' || $this->session->role=='Manage' || $this->session->role=='Finance'){
			$data['scripts'] = ['comman/user.js'];
			$data['user_info'] = $this->user_model->user_info();
			$data['title'] = 'TOOL';
			$data['orders'] = $this->user_model->get_all_orders();
			$data['orderss'] = $this->user_model->get_all_orders_number();
			$data['vendors'] = $this->user_model->get_all_vendors();
			$data['filter'] = $this->input->post();
			$data['clients'] = $this->user_model->get_all_clients();
			//print_r($data['orders']);die;
			$this->load->view('user/common/header',$data);
			//$this->load->view('user/common/side_bar',$data);
			$this->load->view('user/common/nav_bar');
			$this->load->view('user/finance',$data);
			$this->load->view('user/common/footer');
            }else{
                redirect(base_url()); die();
    		}
    }
    
    public function client_payment($id=''){
    	$data['scripts'] = ['comman/user.js'];
		$data['user_info'] = $this->user_model->user_info();
		$data['title'] = 'DB';
		if(!empty($id)){
			$data['order_info'] = $this->user_model->order_info($id);
		}
		$data['last_id'] = $this->user_model->order_last_id();
		$data['websites'] = $this->user_model->get_all_websites();
		$data['orders'] = $this->user_model->get_all_orders();
		$this->load->view('user/common/header',$data);
		//$this->load->view('user/common/side_bar',$data);
		$this->load->view('user/common/nav_bar');
		$this->load->view('user/client_payment',$data);
		$this->load->view('user/common/footer');
    }
    
    public function do_update_payment($id){
    	$this->output->set_content_type('application/json');
		$this->form_validation->set_rules('client_amount_received','Amount Received','required');
		$this->form_validation->set_rules('client_amount_received_date','Receiving Date','required');
		$this->form_validation->set_rules('client_amount_received_status','Receiving Status','required');
		$this->form_validation->set_rules('client_account_id','Account ID','required');
		//$this->form_validation->set_rules('client_email','Email','required');
		if($this->form_validation->run()===FALSE) {
			$this->output->set_output(json_encode(['result' => 0,'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
		$result = $this->user_model->do_update_payment($id);
		if($result){
			$this->output->set_output(json_encode(['result' => 1, 'msg' => 'Order Updated Successfully','url'=>base_url('finance')]));
			return FALSE;
		}
    }
    
    public function vendor_payment(){
        if($this->session->role=='Admin' || $this->session->role=='Manage' || $this->session->role=='Operator'){
			$data['scripts'] = ['comman/user.js'];
			$data['user_info'] = $this->user_model->user_info();
			$data['title'] = 'TOOL';
			$data['orders'] = $this->user_model->get_all_orders_vendorp();
			$data['orderss'] = $this->user_model->get_all_orders_number();
			$data['vendors'] = $this->user_model->get_all_vendors();
			$data['filter'] = $this->input->post();
			$data['clients'] = $this->user_model->get_all_clients();
			//print_r($data['filter']);die;
			$this->load->view('user/common/header',$data);
			//$this->load->view('user/common/side_bar',$data);
			$this->load->view('user/common/nav_bar');
			$this->load->view('user/vendor_payment',$data);
			$this->load->view('user/common/footer');
            }else{
                redirect(base_url()); die();
    		}
    }
    
    public function do_vendor_payment($id=''){
    	$data['scripts'] = ['comman/user.js'];
		$data['user_info'] = $this->user_model->user_info();
		$data['title'] = 'DB';
		if(!empty($id)){
			$data['order_info'] = $this->user_model->order_info($id);
		}
		$data['last_id'] = $this->user_model->order_last_id();
		$data['websites'] = $this->user_model->get_all_websites();
		$data['orders'] = $this->user_model->get_all_orders();
		$this->load->view('user/common/header',$data);
		//$this->load->view('user/common/side_bar',$data);
		$this->load->view('user/common/nav_bar');
		$this->load->view('user/vendor_payment_edit',$data);
		$this->load->view('user/common/footer');
    }
    
    public function do_update_vendor_payment($id){
    	$this->output->set_content_type('application/json');
		$this->form_validation->set_rules('vendor_payment_amount','Paid Amount','required');
		$this->form_validation->set_rules('vendor_payment_date','Date','required');
		$this->form_validation->set_rules('vendor_payment_status','Vendor Payment Status','required');
		//$this->form_validation->set_rules('vendor_payment_date','Paid Date','required');
		if($this->form_validation->run()===FALSE) {
			$this->output->set_output(json_encode(['result' => 0,'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
		$result = $this->user_model->do_update_vendor_payment($id);
		if($result){
			$this->output->set_output(json_encode(['result' => 1, 'msg' => 'Order Updated Successfully','url'=>base_url('vendor-payment')]));
			return FALSE;
		}
    }
    
    public function account(){
        if($this->session->role=='Admin'){
			$data['scripts'] = ['comman/user.js'];
			$data['user_info'] = $this->user_model->user_info();
			$data['title'] = 'TOOL';
			$data['orders'] = $this->user_model->get_all_orders();
			$data['orderss'] = $this->user_model->get_all_orders_number();
			$data['vendors'] = $this->user_model->get_all_vendors();
			$data['filter'] = $this->input->post();
			//print_r($data['filter']);die;
			$this->load->view('user/common/header',$data);
			//$this->load->view('user/common/side_bar',$data);
			$this->load->view('user/common/nav_bar');
			$this->load->view('user/account',$data);
			$this->load->view('user/common/footer');
        }else{
            redirect(base_url()); die();
		}
    }
    
    public function reports(){
        if($this->session->role=='Admin'){
            $datas = $this->input->post();
            
            if(!empty($datas['period'])){
               $data['period'] =  $datas['period'];
				$data['start_date'] =  date('Y-m-d', strtotime('-'.$data['period'].' months'));
               $data['end_date'] =  date('Y-m-d');
            }elseif(!empty($datas['start_date']) && !empty($datas['end_date'])){
               $data['start_date'] =  $datas['start_date'];
               $data['end_date'] =  $datas['end_date'];
            }else{
                if(empty($datas['month'])){
                $data['month'] = date('m');
                }else{
                    $data['month'] = $datas['month'];
                }
            }//print_r($data['month']);die;
			$data['scripts'] = ['comman/user.js'];
			$data['user_info'] = $this->user_model->user_info();
			$data['title'] = 'TOOL';
			$data['orders'] = $this->user_model->get_all_orders_for_reports();
			$data['orderss'] = $this->user_model->get_all_orders_number();
			$data['vendors'] = $this->user_model->get_all_vendors();
			$data['filter'] = $this->input->post();
			//print_r($data['filter']);die;
			$this->load->view('user/common/header',$data);
			//$this->load->view('user/common/side_bar',$data);
			$this->load->view('user/common/nav_bar');
			$this->load->view('user/reports',$data);
			$this->load->view('user/common/footer');
        }else{
            redirect(base_url()); die();
		}
    }
    
    public function reports_list($target,$month='',$start_date='',$end_date=''){
        if($this->session->role=='Admin'){
			$data['scripts'] = ['comman/user.js'];
			$data['user_info'] = $this->user_model->user_info();
			$data['title'] = 'TOOL';
			$data['orders'] = $this->user_model->get_all_orders_for_report_list($target,$month,$start_date,$end_date);
			$data['orderss'] = $this->user_model->get_all_orders_number();
			$data['clients'] = $this->user_model->get_all_clients();
			//echo '<pre>';print_r($data['orders']);die;
			$data['filter'] = $this->input->post();
			/*if(!empty($datas)){
			    $data['order_numbers'] = $datas['order_number'];
			}*/
			$this->load->view('user/common/header',$data);
			//$this->load->view('user/common/side_bar',$data);
			$this->load->view('user/common/nav_bar');
			$this->load->view('user/list',$data);
			$this->load->view('user/common/footer');
		}	else{
			    redirect(base_url()); die();
			}
    }
    
    // This function is used for sending report to email ID
    
    public function create_csv_string() {
        $list = $this->user_model->get_all_orders();
        $sk[0] = array("Client Name","ID","Client Name ID","Client Email","Contacted From","Order Date","Website","Proposed Amount","Content Amount","Website Remark","Order Number","Assign Date","Publish Date","Oublish Url","Pendor Email","Vendor Name","Aite Cost","Vendor Contacted From","Remark","Client Amount Received","Client Amount Received date","Client Amount Received status","Client Account Type","Client Account Id","Vendor Payment Amount","Vendor Payment Status","Vendor Payment Date","Vendor Transaction Id","Status");
        $list = array_merge($sk,$list);
        $file = fopen("contactsa.csv","w");
        $myoutput = '';
        foreach ($list as $key => $line)
          {
            $myoutput .= "\"".implode('","',$line)."\"\n";
            fputcsv($file,$line);
          }
        fclose($file);
        return chunk_split(base64_encode($myoutput));
    }


    public function send_csv_mail($body ="Order Report \r\n \r\n master.outreachdeal.com", $to = 'yogesh@emiactech.com', $subject = 'Order Report', $from = 'info@outreachdeal.com') {
    
        // This will provide plenty adequate entropy
        $multipartSep = '-----'.md5(time()).'-----';
        
        // Arrays are much more readable
        $headers = array(
            "From: $from",
            "Reply-To: $from",
            "Content-Type: multipart/mixed; boundary=".$multipartSep.""
        );
        $attachment = $this->create_csv_string(); 
    
        // Make the body of the message
        $body = "--$multipartSep\r\n"
            . "Content-Type: text/plain; charset=ISO-8859-1; format=flowed\r\n"
            . "Content-Transfer-Encoding: 7bit\r\n"
            . "\r\n"
            . "$body\r\n"
            . "--$multipartSep\r\n"
            . "Content-Type: text/csv\r\n"
            . "Content-Transfer-Encoding: base64\r\n"
            . "Content-Disposition: attachment; filename='Website-Report'.csv\r\n"
            . "\r\n"
            . "$attachment\r\n"
            . "--$multipartSep--";
    
        // Send the email, return the result
        mail($to, $subject, $body, implode("\r\n", $headers)); 
    
    }
    
    public function extension(){
        $this->output->set_content_type('application/json');
        $result = $this->user_model->get_extensions();
        //print_r($result);die;
       /* foreach($result as $value){
            //print_r($value);die;
            //echo $value; die;
            echo '<tr>';
            echo '<td>'.$value['url'].'</td>';
            echo '<td><button class="openurl" data-url="'.$value['url'].'" data-username="'.$value['username'].'" data-password="'.$value['password'].'">Open</button></td>';
            echo '</tr>';
        }*/
		if($result){
			$this->output->set_output(json_encode(['url' => $result[0]['url'], 'username' =>$result[0]['username'],'password' =>$result[0]['password'] ]));
			return FALSE;
		}
    }
    
    public function tabdata(){
		    
		    $sk = $this->input->get();
		    $datas = $this->db->get('tbl_sites')->result_array();
		    $column_a= array('website','niche','da','pa','price','sailing_price','remark','semrush_traffic','pure_category','1st','2nd','3rd','4th','dr','spam_score','price_category','price_category','sailing_price','discount','casino_adult','traffic','web_category','tbl_vendors.name','tbl_vendors.email','tbl_vendors.contacted_from','follow','cp_update_date','tbl_vendors.phone','tbl_sites.timestamp','web_ip','web_country','link_insertion_cost','tat','social_media_posting','site_category');
		    //echo '<pre>';print_r($sk['columns'][1]['search']['value']);die;
		    if(!empty($sk['search']['value'])){
		        $this->db->or_like(array('website' => $sk['search']['value'],'niche'=>$sk['search']['value'],'da'=>$sk['search']['value'],'pa'=>$sk['search']['value'],'price'=>$sk['search']['value'],'sailing_price'=>$sk['search']['value'],'remark'=>$sk['search']['value'],'semrush_traffic'=>$sk['search']['value'],'pure_category'=>$sk['search']['value'],'1st'=>$sk['search']['value'],'2nd'=>$sk['search']['value'],'3rd'=>$sk['search']['value'],'4th'=>$sk['search']['value'],'dr'=>$sk['search']['value'],'spam_score'=>$sk['search']['value'],'price_category'=>$sk['search']['value'],'price_category'=>$sk['search']['value'],'sailing_price'=>$sk['search']['value'],'discount'=>$sk['search']['value'],'casino_adult'=>$sk['search']['value'],'traffic'=>$sk['search']['value'],'web_category'=>$sk['search']['value'],'tbl_vendors.name'=>$sk['search']['value'],'tbl_vendors.email'=>$sk['search']['value'],'tbl_vendors.contacted_from'=>$sk['search']['value'],'follow' => $sk['search']['value'],'cp_update_date' => $sk['search']['value'],'tbl_vendors.phone' => $sk['search']['value'],'tbl_sites.timestamp'=>$sk['search']['value'],'web_ip'=>$sk['search']['value'],'web_country'=>$sk['search']['value'],'link_insertion_cost'=>$sk['search']['value'],'tat'=>$sk['search']['value'],'social_media_posting'=>$sk['search']['value'],'site_category'=>$sk['search']['value']));
		    }else{
    		    foreach($sk['columns'] as $key =>$search){
    		       if(!empty($search['search']['value']) && $search['data'] == 'da' && strpos($search['search']['value'],'@') > 1){
    		           $know_da = str_replace('@','',$search['search']['value']);
    		           //print_r($know_da);die;
    		           $da_arra = explode(',',$know_da);
    		           $this->db->where('da>=',$da_arra[0]);
    		           $this->db->where('da<=',$da_arra[1]);
    		        }elseif(!empty($search['search']['value']) && $search['data'] == 'web_category' && $search['search']['value'] == 'no'){
    		            $this->db->where('web_category!=','Com & Agency');
				        $this->db->where('web_category!=','Agency');
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'niche' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		                $this->db->where('niche',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'site_category' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		                $this->db->where('site_category',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'price' && strpos($search['search']['value'],'@') > 1){
    		           $know_price = str_replace('@','',$search['search']['value']);
    		           $price_arra = explode(',',$know_price);
    		            $this->db->where('price>=',$price_arra[0]);
    		           $this->db->where('price<=',$price_arra[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'traffic' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('traffic>=',$traffic_array[0]);
    		            $this->db->where('traffic<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'semrush_traffic' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('semrush_traffic>=',$traffic_array[0]);
    		            $this->db->where('semrush_traffic<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'pure_category' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('pure_category>=',$traffic_array[0]);
    		            $this->db->where('pure_category<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'dr' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('dr>=',$traffic_array[0]);
    		            $this->db->where('dr<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'spam_score' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('spam_score>=',$traffic_array[0]);
    		            $this->db->where('spam_score<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'casino_adult' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('casino_adult>=',$traffic_array[0]);
    		            $this->db->where('casino_adult<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && strpos($search['search']['value'],'*') > 1){
    		            if($search['data'] == 'vendor_name'){
    		                $search['data'] = 'tbl_vendors.name';
    		            }elseif($search['data'] == 'vendor_email'){
    		                $search['data'] = 'tbl_vendors.email';
    		            }elseif($search['data'] == 'vendor_contact'){
    		                $search['data'] = 'tbl_vendors.contacted_from';
    		            }elseif($search['data'] == 'phone_numbers'){
    		                $search['data'] = 'tbl_vendors.phone';
    		            }elseif($search['data'] == 'user_name'){
    		                $search['data'] = 'tbl_users.name';
    		            }elseif($search['data'] == 'timestamp'){
    		                $search['data'] = 'tbl_sites.timestamp';
    		            }
    		            $this->db->like($search['data'],$sk['columns'][$key]['search']['value']);
    		        }
    		    }
		    }
		    
		    //$this->db->group_by(['website']);
		    $this->db->order_by($column_a[$sk['order'][0]['column']],$sk['order'][0]['dir']);
			$this->db->select('tbl_vendors.name as vendor_name,tbl_vendors.email as vendor_email,tbl_vendors.contacted_from as vendor_contact,tbl_vendors.phone as phone_numbers,tbl_users.name as user_name, tbl_sites.*');
		    $this->db->from('tbl_vendors');
		    $this->db->join('tbl_sites', 'tbl_sites.person_id = tbl_vendors.id');
		    $this->db->join('tbl_users', 'tbl_users.id = tbl_sites.user_id');
		    $num_results = $this->db->count_all_results();
		    if(!empty($sk['search']['value'])){
		        $this->db->or_like(array('website' => $sk['search']['value'],'niche'=>$sk['search']['value'],'da'=>$sk['search']['value'],'pa'=>$sk['search']['value'],'price'=>$sk['search']['value'],'sailing_price'=>$sk['search']['value'],'remark'=>$sk['search']['value'],'pure_category'=>$sk['search']['value'],'1st'=>$sk['search']['value'],'2nd'=>$sk['search']['value'],'3rd'=>$sk['search']['value'],'4th'=>$sk['search']['value'],'dr'=>$sk['search']['value'],'spam_score'=>$sk['search']['value'],'price_category'=>$sk['search']['value'],'price_category'=>$sk['search']['value'],'sailing_price'=>$sk['search']['value'],'discount'=>$sk['search']['value'],'casino_adult'=>$sk['search']['value'],'traffic'=>$sk['search']['value'],'web_category'=>$sk['search']['value'],'tbl_vendors.name'=>$sk['search']['value'],'tbl_vendors.email'=>$sk['search']['value'],'tbl_vendors.contacted_from'=>$sk['search']['value'],'follow' => $sk['search']['value'],'cp_update_date' => $sk['search']['value'],'tbl_vendors.phone' => $sk['search']['value'],'tbl_sites.timestamp'=>$sk['search']['value'],'web_ip'=>$sk['search']['value'],'web_country'=>$sk['search']['value'],'link_insertion_cost'=>$sk['search']['value'],'tat'=>$sk['search']['value'],'site_category'=>$sk['search']['value'],'site_category'=>$sk['search']['value']));
		 //$this->db->or_like(array('sample_url' => $sk['search']['value'], 'tbl_users.name' => $sk['search']['value'],'timestamp'=>$sk['search']['value'],'web_ip'=>$sk['search']['value'],'web_country'=>$sk['search']['value'],'link_insertion_cost'=>$sk['search']['value'],'bank_details'=>$sk['search']['value'],'tat'=>$sk['search']['value'],'social_media_posting'=>$sk['search']['value']));

		    }else{
    		    foreach($sk['columns'] as $key =>$search){
    		        if(!empty($search['search']['value']) && $search['data'] == 'da' && strpos($search['search']['value'],'@') > 1){
    		           $know_da = str_replace('@','',$search['search']['value']);
    		           $da_arra = explode(',',$know_da);
    		           $this->db->where('da>=',$da_arra[0]);
    		           $this->db->where('da<=',$da_arra[1]);
    		        }elseif(!empty($search['search']['value']) && $search['data'] == 'web_category' && $search['search']['value'] == 'no'){
    		            $this->db->where('web_category!=','Com & Agency');
				        $this->db->where('web_category!=','Agency');
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'niche' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $this->db->where('niche',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'site_category' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $this->db->where('site_category',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'price' && strpos($search['search']['value'],'@') > 1){
    		           $know_price = str_replace('@','',$search['search']['value']);
    		           $price_arra = explode(',',$know_price);
    		            $this->db->where('price>=',$price_arra[0]);
    		           $this->db->where('price<=',$price_arra[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'traffic' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('traffic>=',$traffic_array[0]);
    		            $this->db->where('traffic<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'semrush_traffic' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('semrush_traffic>=',$traffic_array[0]);
    		            $this->db->where('semrush_traffic<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'pure_category' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('pure_category>=',$traffic_array[0]);
    		            $this->db->where('pure_category<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'dr' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$know_single_niche);
    		            //print_r($traffic_array);die;
    		            $this->db->where('dr>=',$traffic_array[0]);
    		            $this->db->where('dr<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'spam_score' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('spam_score>=',$traffic_array[0]);
    		            $this->db->where('spam_score<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'casino_adult' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('casino_adult>=',$traffic_array[0]);
    		            $this->db->where('casino_adult<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value'])){
    		            if($search['data'] == 'vendor_name'){
    		                $search['data'] = 'tbl_vendors.name';
    		            }elseif($search['data'] == 'vendor_email'){
    		                $search['data'] = 'tbl_vendors.email';
    		            }elseif($search['data'] == 'vendor_contact'){
    		                $search['data'] = 'tbl_vendors.contacted_from';
    		            }elseif($search['data'] == 'phone_numbers'){
    		                $search['data'] = 'tbl_vendors.phone';
    		            }elseif($search['data'] == 'user_name'){
    		                $search['data'] = 'tbl_users.name';
    		            }elseif($search['data'] == 'timestamp'){
    		                $search['data'] = 'tbl_sites.timestamp';
    		            }
    		           $search_specific = str_replace('*','',$sk['columns'][$key]['search']['value']);
    		            $this->db->like($search['data'],$search_specific);
    		        }
    		    }
		    }
		    //$this->db->group_by(['website']);
		    $this->db->order_by($column_a[$sk['order'][0]['column']],$sk['order'][0]['dir']);
			$this->db->select('tbl_vendors.name as vendor_name,tbl_vendors.email as vendor_email,tbl_vendors.contacted_from as vendor_contact,tbl_vendors.phone as phone_numbers,tbl_users.name as user_name, tbl_sites.*');
		    $this->db->from('tbl_vendors');
		    $this->db->join('tbl_sites', 'tbl_sites.person_id = tbl_vendors.id');
		    $this->db->join('tbl_users', 'tbl_users.id = tbl_sites.user_id');
		    //$num_results = $this->db->count_all_results();
		    if($sk['length'] > 0){
		        $this->db->limit($sk['length'],$sk['start']);
		    }
		    $data = $this->db->get()->result_array();
		    //print_r($this->db->last_query());die;
		    $results = [
            "draw" => $sk['draw'],
            "recordsTotal" => $num_results,
            "recordsFiltered" => $num_results,
            "data" => $data
            ];
		   echo json_encode($results);
		}
		
		 public function aidata(){
		    $sk = $this->input->get();
		    $datas = $this->db->get('tbl_sites')->result_array();
		    $column_a= array('website','remark','niche','cp_update_date','website_type','da','pa','price','sailing_price','follow','semrush_traffic','pure_category','semrush_india','semrush_us','semrush_uk','semrush_australia','semrush_updation_date','dr','spam_score','traffic','web_category','tbl_vendors.name','casino_adult','cbd_price','adult','banner_image_price','link_insertion_cost','tat','social_media_posting','sample_url','timestamp','site_category');
		    //echo '<pre>';print_r($sk);die;
		    $sd_vaue = '';
		    if(!empty($sk['search']['value'])){
		        $this->db->or_like(array('website' => $sk['search']['value'],'remark' => $sk['search']['value'],'niche'=>$sk['search']['value'],'cp_update_date'=>$sk['search']['value'],'website_type'=>$sk['search']['value'],'da'=>$sk['search']['value'],'pa'=>$sk['search']['value'],'price'=>$sk['search']['value'],'sailing_price'=>$sk['search']['value'],'semrush_traffic'=>$sk['search']['value'],'pure_category'=>$sk['search']['value'],'semrush_india'=>$sk['search']['value'],'site_category'=>$sk['search']['value'],'semrush_uk'=>$sk['search']['value'],'semrush_australia'=>$sk['search']['value'],'semrush_updation_date'=>$sk['search']['value'],'dr'=>$sk['search']['value'],'spam_score'=>$sk['search']['value'],'traffic'=>$sk['search']['value'],'web_category'=>$sk['search']['value'],'tbl_vendors.name'=>$sk['search']['value'],'follow' => $sk['search']['value'],'casino_adult'=>$sk['search']['value'],'cbd_price'=>$sk['search']['value'],'adult'=>$sk['search']['value'],'banner_image_price'=>$sk['search']['value'],'link_insertion_cost'=>$sk['search']['value'],'tat'=>$sk['search']['value'],'social_media_posting'=>$sk['search']['value'],'sample_url'=>$sk['search']['value'],'tbl_sites.timestamp'=>$sk['search']['value']));
		   		        //$this->db->or_like(array('id' => $sk['search']['value'], 'website' => $sk['search']['value'],'niche'=>$sk['search']['value'],'da'=>$sk['search']['value'],'pa'=>$sk['search']['value'],'price'=>$sk['search']['value']));,'semrush_traffic','similarweb_traffic','1st','2nd','3rd','4th',
		    $sd_vaue = $sk['search']['value'];
		        
		    }else{
    		    foreach($sk['columns'] as $key =>$search){
    		        if(!empty($search['search']['value']) && strpos($search['search']['value'],'*') > 1 || strpos($search['search']['value'],'@') > 1){
    		            $sd_vaue = $search['search']['value'];
    		        }elseif(!empty($search['search']['value']) && $search['data'] == 'da' && strpos($search['search']['value'],'@') > 1){
    		           $know_da = str_replace('@','',$search['search']['value']);
    		           //print_r($know_da);die;
    		           $da_arra = explode(',',$know_da);
    		           $this->db->where('da>=',$da_arra[0]);
    		           $this->db->where('da<=',$da_arra[1]);
    		        }elseif(!empty($search['search']['value']) && $search['data'] == 'pa' && strpos($search['search']['value'],'@') > 1){
    		           $know_da = str_replace('@','',$search['search']['value']);
    		           //print_r($know_da);die;
    		           $da_arra = explode(',',$know_da);
    		           $this->db->where('pa>=',$da_arra[0]);
    		           $this->db->where('pa<=',$da_arra[1]);
    		        }elseif(!empty($search['search']['value']) && $search['data'] == 'web_category' && $search['search']['value'] == 'no'){
    		            $this->db->where('web_category!=','Com & Agency');
    		            
				        $this->db->where('web_category!=','Agency');
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'niche' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		                $this->db->where('niche',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'cp_update_date' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		                $this->db->where('cp_update_date',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'site_category' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		                $this->db->where('site_category',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'website_type' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		                $this->db->where('website_type',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'price' && strpos($search['search']['value'],'@') > 1){
    		           $know_price = str_replace('@','',$search['search']['value']);
    		           $price_arra = explode(',',$know_price);
    		            $this->db->where('price>=',$price_arra[0]);
    		           $this->db->where('price<=',$price_arra[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'traffic' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('traffic>=',$traffic_array[0]);
    		            $this->db->where('traffic<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'semrush_traffic' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('semrush_traffic>=',$traffic_array[0]);
    		            $this->db->where('semrush_traffic<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'pure_category' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('pure_category',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'dr' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('dr>=',$traffic_array[0]);
    		            $this->db->where('dr<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'spam_score' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('spam_score>=',$traffic_array[0]);
    		            $this->db->where('spam_score<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'site_update_date' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            //$traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('tbl_sites.site_update_date>=',$search['search']['value']);
    		            //$this->db->where('tbl_sites.site_update_date<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'casino_adult' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('casino_adult>=',$traffic_array[0]);
    		            $this->db->where('casino_adult<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'cbd_price' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('cbd_price>=',$traffic_array[0]);
    		            $this->db->where('cbd_price<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'adult' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('adult>=',$traffic_array[0]);
    		            $this->db->where('adult<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value'])){
    		            if($search['data'] == 'vendor_name'){
    		                $search['data'] = 'tbl_vendors.name';
    		            }elseif($search['data'] == 'vendor_email'){
    		                $search['data'] = 'tbl_vendors.email';
    		            }elseif($search['data'] == 'vendor_contact'){
    		                $search['data'] = 'tbl_vendors.contacted_from';
    		            }elseif($search['data'] == 'phone_numbers'){
    		                $search['data'] = 'tbl_vendors.phone';
    		            }elseif($search['data'] == 'user_name'){
    		                $search['data'] = 'tbl_users.name';
    		            }elseif($search['data'] == 'banner_image_price'){
    		                $search['data'] = 'tbl_sites.banner_image_price';
    		            }elseif($search['data'] == 'timestamp'){
    		                $search['data'] = 'tbl_sites.timestamp';
    		            }elseif($search['data'] == 'remark'){
    		                $search['data'] = 'tbl_sites.remark';
    		            }
    		            $search_specific = str_replace('*','',$sk['columns'][$key]['search']['value']);
    		            $this->db->like($search['data'],$search_specific);
    		        }
    		    }
		    }
		    if(empty($sd_vaue)){
		        $results = 'You have not follow the rules';
		        echo json_encode($results);die;
		    }
		    $this->db->where('web_category!=','Lost Sites');
		    $this->db->group_by(['website']);
		    $this->db->order_by($column_a[$sk['order'][0]['column']],$sk['order'][0]['dir']);
			$this->db->select('tbl_vendors.name as vendor_name,tbl_vendors.email as vendor_email,tbl_vendors.contacted_from as vendor_contact,tbl_vendors.phone as phone_numbers,tbl_users.name as user_name, tbl_sites.*');
		    $this->db->from('tbl_vendors');
		    $this->db->join('tbl_sites', 'tbl_sites.person_id = tbl_vendors.id');
		    $this->db->join('tbl_users', 'tbl_users.id = tbl_sites.user_id');
		    $num_results = $this->db->count_all_results();
		    //$data = $this->db->get()->result_array();
		    //$ssd  = count($data);
		    
		    //echo $ssd;die;
		    //$this->db->limit($sk['length'],$sk['start']);
		    //
		    
		    if(!empty($sk['search']['value'])){
		        $this->db->or_like(array('website' => $sk['search']['value'],'remark' => $sk['search']['value'],'niche'=>$sk['search']['value'],'cp_update_date'=>$sk['search']['value'],'website_type'=>$sk['search']['value'],'da'=>$sk['search']['value'],'pa'=>$sk['search']['value'],'price'=>$sk['search']['value'],'sailing_price'=>$sk['search']['value'],'semrush_traffic'=>$sk['search']['value'],'pure_category'=>$sk['search']['value'],'semrush_india'=>$sk['search']['value'],'semrush_us'=>$sk['search']['value'],'semrush_uk'=>$sk['search']['value'],'semrush_australia'=>$sk['search']['value'],'semrush_updation_date'=>$sk['search']['value'],'dr'=>$sk['search']['value'],'spam_score'=>$sk['search']['value'],'traffic'=>$sk['search']['value'],'web_category'=>$sk['search']['value'],'tbl_vendors.name'=>$sk['search']['value'],'follow' => $sk['search']['value'],'casino_adult'=>$sk['search']['value'],'cbd_price'=>$sk['search']['value'],'adult'=>$sk['search']['value'],'banner_image_price'=>$sk['search']['value'],'link_insertion_cost'=>$sk['search']['value'],'tat'=>$sk['search']['value'],'social_media_posting'=>$sk['search']['value'],'sample_url'=>$sk['search']['value'],'tbl_sites.timestamp'=>$sk['search']['value'],'site_category' => $sk['search']['value']));
		        //$this->db->or_like(array('sample_url' => $sk['search']['value'], 'tbl_users.name' => $sk['search']['value'],'timestamp'=>$sk['search']['value'],'web_ip'=>$sk['search']['value'],'web_country'=>$sk['search']['value'],'link_insertion_cost'=>$sk['search']['value'],'bank_details'=>$sk['search']['value'],'tat'=>$sk['search']['value'],'social_media_posting'=>$sk['search']['value']));

		    }else{
    		    foreach($sk['columns'] as $key =>$search){
    		        if(!empty($search['search']['value']) && $search['data'] == 'da' && strpos($search['search']['value'],'@') > 1){
    		           $know_da = str_replace('@','',$search['search']['value']);
    		           $da_arra = explode(',',$know_da);
    		           $this->db->where('da>=',$da_arra[0]);
    		           $this->db->where('da<=',$da_arra[1]);
    		        }elseif(!empty($search['search']['value']) && $search['data'] == 'pa' && strpos($search['search']['value'],'@') > 1){
    		           $know_da = str_replace('@','',$search['search']['value']);
    		           //print_r($know_da);die;
    		           $da_arra = explode(',',$know_da);
    		           $this->db->where('pa>=',$da_arra[0]);
    		           $this->db->where('pa<=',$da_arra[1]);
    		        }elseif(!empty($search['search']['value']) && $search['data'] == 'web_category' && $search['search']['value'] == 'no'){
    		            $this->db->where('web_category!=','Com & Agency');
				        $this->db->where('web_category!=','Agency');
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'niche' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $this->db->where('niche',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'cp_update_date' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		                $this->db->where('cp_update_date',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'site_category' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		                $this->db->where('site_category',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'website_category' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		                $this->db->where('website_category',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'price' && strpos($search['search']['value'],'@') > 1){
    		           $know_price = str_replace('@','',$search['search']['value']);
    		           $price_arra = explode(',',$know_price);
    		            $this->db->where('price>=',$price_arra[0]);
    		           $this->db->where('price<=',$price_arra[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'traffic' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('traffic>=',$traffic_array[0]);
    		            $this->db->where('traffic<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'semrush_traffic' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('semrush_traffic>=',$traffic_array[0]);
    		            $this->db->where('semrush_traffic<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'pure_category' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $this->db->where('pure_category',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'dr' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('dr>=',$traffic_array[0]);
    		            $this->db->where('dr<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'spam_score' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('spam_score>=',$traffic_array[0]);
    		            $this->db->where('spam_score<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'timestamp' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('tbl_sites.timestamp>=',$traffic_array[0]);
    		            $this->db->where('tbl_sites.timestamp<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'casino_adult' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('casino_adult>=',$traffic_array[0]);
    		            $this->db->where('casino_adult<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'cbd_price' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('cbd_price>=',$traffic_array[0]);
    		            $this->db->where('cbd_price<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'adult' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('adult>=',$traffic_array[0]);
    		            $this->db->where('adult<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'site_update_date' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            //$traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('tbl_sites.site_update_date>=',$search['search']['value']);
    		            //$this->db->where('tbl_sites.site_update_date<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value'])){
    		            if($search['data'] == 'vendor_name'){
    		                $search['data'] = 'tbl_vendors.name';
    		            }elseif($search['data'] == 'vendor_email'){
    		                $search['data'] = 'tbl_vendors.email';
    		            }elseif($search['data'] == 'vendor_contact'){
    		                $search['data'] = 'tbl_vendors.contacted_from';
    		            }elseif($search['data'] == 'phone_numbers'){
    		                $search['data'] = 'tbl_vendors.phone';
    		            }elseif($search['data'] == 'user_name'){
    		                $search['data'] = 'tbl_users.name';
    		            }elseif($search['data'] == 'remark'){
    		                $search['data'] = 'tbl_sites.remark';
    		            }elseif($search['data'] == 'banner_image_price'){
    		                $search['data'] = 'tbl_sites.banner_image_price';
    		            }
    		            $search_specific = str_replace('*','',$sk['columns'][$key]['search']['value']);
    		            $this->db->like($search['data'],$search_specific);
    		        }
    		    }
		    }
		    $this->db->where('web_category!=','Lost Sites');
		    $this->db->group_by(['website']);
		    //$this->db->order_by($column_a[$sk['order'][0]['column']],$sk['order'][0]['dir']);
		    $this->db->order_by('price','DESC');
			$this->db->select('count(website) as nows,tbl_vendors.name as vendor_name,tbl_vendors.email as vendor_email,tbl_vendors.contacted_from as vendor_contact,tbl_vendors.phone as phone_numbers,tbl_users.name as user_name, tbl_sites.*');
		    $this->db->from('tbl_vendors');
		    $this->db->join('tbl_sites', 'tbl_sites.person_id = tbl_vendors.id');
		    $this->db->join('tbl_users', 'tbl_users.id = tbl_sites.user_id');
		    //$num_results = $this->db->count_all_results();
		    if($sk['length'] > 0){
		        $this->db->limit($sk['length'],$sk['start']);
		    }
		    $data = $this->db->get()->result_array();
		      $web_cate = array_column($data,'web_category');
		    foreach($web_cate as $index => $findlostsites){ //echo $findlostsites;die;
		        if($findlostsites == 'Lost Sites' && sizeof($web_cate) > 1){
		            unset($data[$index]);// = [];
		            
		        }else if($findlostsites == 'Lost Sites' && sizeof($web_cate) == 1){
		            $data = [];
		        }
		    }
		    $data = array_values($data);
		    //echo '<pre>'; print_r(count($data));die;
		    
		    $results = [
            "draw" => $sk['draw'],
            "recordsTotal" => $num_results,
            "recordsFiltered" => $num_results,
            "data" => $data
            ];
		   echo json_encode($results);
		}
		
		public function languagedata(){
		    
		    $sk = $this->input->get();
		    $datas = $this->db->get('tbl_olt')->result_array();
		    $column_a= array('website','remark','niche','site_category','main_category','da','pa','price','sailing_price','follow','semrush_traffic','similarweb_traffic','1st','2nd','3rd','4th','5th','dr','spam_score','traffic','web_category','tbl_vendors.name','casino_adult','cbd_price','adult','web_country','link_insertion_cost','tat','social_media_posting','sample_url','timestamp');
		    //echo '<pre>';print_r($column_a[$sk['order'][0]['column']]);die;
		    $sd_vaue = '';
		    if(!empty($sk['search']['value'])){
		        $this->db->or_like(array('website' => $sk['search']['value'],'remark' => $sk['search']['value'],'niche'=>$sk['search']['value'],'site_category'=>$sk['search']['value'],'main_category'=>$sk['search']['value'],'da'=>$sk['search']['value'],'pa'=>$sk['search']['value'],'price'=>$sk['search']['value'],'sailing_price'=>$sk['search']['value'],'semrush_traffic'=>$sk['search']['value'],'similarweb_traffic'=>$sk['search']['value'],'1st'=>$sk['search']['value'],'2nd'=>$sk['search']['value'],'3rd'=>$sk['search']['value'],'4th'=>$sk['search']['value'],'5th'=>$sk['search']['value'],'dr'=>$sk['search']['value'],'spam_score'=>$sk['search']['value'],'traffic'=>$sk['search']['value'],'web_category'=>$sk['search']['value'],'tbl_vendors.name'=>$sk['search']['value'],'follow' => $sk['search']['value'],'casino_adult'=>$sk['search']['value'],'cbd_price'=>$sk['search']['value'],'adult'=>$sk['search']['value'],'web_country'=>$sk['search']['value'],'link_insertion_cost'=>$sk['search']['value'],'tat'=>$sk['search']['value'],'social_media_posting'=>$sk['search']['value'],'sample_url'=>$sk['search']['value'],'tbl_olt.timestamp'=>$sk['search']['value']));
		   		        //$this->db->or_like(array('id' => $sk['search']['value'], 'website' => $sk['search']['value'],'niche'=>$sk['search']['value'],'da'=>$sk['search']['value'],'pa'=>$sk['search']['value'],'price'=>$sk['search']['value']));,'semrush_traffic','similarweb_traffic','1st','2nd','3rd','4th',
		    $sd_vaue = $sk['search']['value'];
		        
		    }else{
    		    foreach($sk['columns'] as $key =>$search){
    		        if(!empty($search['search']['value']) && strpos($search['search']['value'],'*') > 1 || strpos($search['search']['value'],'@') > 1){
    		            $sd_vaue = $search['search']['value'];
    		        }elseif(!empty($search['search']['value']) && $search['data'] == 'da' && strpos($search['search']['value'],'@') > 1){
    		           $know_da = str_replace('@','',$search['search']['value']);
    		           //print_r($know_da);die;
    		           $da_arra = explode(',',$know_da);
    		           $this->db->where('da>=',$da_arra[0]);
    		           $this->db->where('da<=',$da_arra[1]);
    		        }elseif(!empty($search['search']['value']) && $search['data'] == 'web_category' && $search['search']['value'] == 'no'){
    		            $this->db->where('web_category!=','Com & Agency');
    		            
				        $this->db->where('web_category!=','Agency');
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'niche' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		                $this->db->where('niche',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'site_category' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		                $this->db->where('site_category',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'language' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		                $this->db->where('language',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'price' && strpos($search['search']['value'],'@') > 1){
    		           $know_price = str_replace('@','',$search['search']['value']);
    		           $price_arra = explode(',',$know_price);
    		            $this->db->where('price>=',$price_arra[0]);
    		           $this->db->where('price<=',$price_arra[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'traffic' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('traffic>=',$traffic_array[0]);
    		            $this->db->where('traffic<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'semrush_traffic' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('semrush_traffic>=',$traffic_array[0]);
    		            $this->db->where('semrush_traffic<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'similarweb_traffic' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('similarweb_traffic>=',$traffic_array[0]);
    		            $this->db->where('similarweb_traffic<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'dr' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('dr>=',$traffic_array[0]);
    		            $this->db->where('dr<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'spam_score' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('spam_score>=',$traffic_array[0]);
    		            $this->db->where('spam_score<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'timestamp' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('tbl_olt.timestamp>=',$traffic_array[0]);
    		            $this->db->where('tbl_olt.timestamp<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'casino_adult' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('casino_adult>=',$traffic_array[0]);
    		            $this->db->where('casino_adult<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'cbd_price' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('cbd_price>=',$traffic_array[0]);
    		            $this->db->where('cbd_price<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'adult' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('adult>=',$traffic_array[0]);
    		            $this->db->where('adult<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value'])){
    		            if($search['data'] == 'vendor_name'){
    		                $search['data'] = 'tbl_vendors.name';
    		            }elseif($search['data'] == 'vendor_email'){
    		                $search['data'] = 'tbl_vendors.email';
    		            }elseif($search['data'] == 'vendor_contact'){
    		                $search['data'] = 'tbl_vendors.contacted_from';
    		            }elseif($search['data'] == 'phone_numbers'){
    		                $search['data'] = 'tbl_vendors.phone';
    		            }elseif($search['data'] == 'user_name'){
    		                $search['data'] = 'tbl_users.name';
    		            }elseif($search['data'] == 'timestamp'){
    		                $search['data'] = 'tbl_olt.timestamp';
    		            }elseif($search['data'] == 'timestamp'){
    		                $search['data'] = 'tbl_olt.timestamp';
    		            }elseif($search['data'] == 'remark'){
    		                $search['data'] = 'tbl_olt.remark';
    		            }
    		            $search_specific = str_replace('*','',$sk['columns'][$key]['search']['value']);
    		            $this->db->like($search['data'],$search_specific);
    		        }
    		    }
		    }
		    if(empty($sd_vaue)){
		        $results = 'You have not follow the rules';
		        echo json_encode($results);die;
		    }
		    $this->db->where('web_category!=','Lost Sites');
		    $this->db->group_by(['website']);
		    $this->db->order_by($column_a[$sk['order'][0]['column']],$sk['order'][0]['dir']);
			$this->db->select('tbl_vendors.name as vendor_name,tbl_vendors.email as vendor_email,tbl_vendors.contacted_from as vendor_contact,tbl_vendors.phone as phone_numbers,tbl_users.name as user_name, tbl_olt.*');
		    $this->db->from('tbl_vendors');
		    $this->db->join('tbl_olt', 'tbl_olt.person_id = tbl_vendors.id');
		    $this->db->join('tbl_users', 'tbl_users.id = tbl_olt.user_id');
		    $num_results = $this->db->count_all_results();
		    //$data = $this->db->get()->result_array();
		    //$ssd  = count($data);
		    
		    //echo $ssd;die;
		    //$this->db->limit($sk['length'],$sk['start']);
		    //
		    
		    if(!empty($sk['search']['value'])){
		        $this->db->or_like(array('website' => $sk['search']['value'],'remark' => $sk['search']['value'],'niche'=>$sk['search']['value'],'site_category'=>$sk['search']['value'],'main_category'=>$sk['search']['value'],'da'=>$sk['search']['value'],'pa'=>$sk['search']['value'],'price'=>$sk['search']['value'],'sailing_price'=>$sk['search']['value'],'semrush_traffic'=>$sk['search']['value'],'similarweb_traffic'=>$sk['search']['value'],'1st'=>$sk['search']['value'],'2nd'=>$sk['search']['value'],'3rd'=>$sk['search']['value'],'4th'=>$sk['search']['value'],'5th'=>$sk['search']['value'],'dr'=>$sk['search']['value'],'spam_score'=>$sk['search']['value'],'traffic'=>$sk['search']['value'],'web_category'=>$sk['search']['value'],'tbl_vendors.name'=>$sk['search']['value'],'follow' => $sk['search']['value'],'casino_adult'=>$sk['search']['value'],'cbd_price'=>$sk['search']['value'],'adult'=>$sk['search']['value'],'web_country'=>$sk['search']['value'],'link_insertion_cost'=>$sk['search']['value'],'tat'=>$sk['search']['value'],'social_media_posting'=>$sk['search']['value'],'sample_url'=>$sk['search']['value'],'tbl_olt.timestamp'=>$sk['search']['value']));
		        //$this->db->or_like(array('sample_url' => $sk['search']['value'], 'tbl_users.name' => $sk['search']['value'],'timestamp'=>$sk['search']['value'],'web_ip'=>$sk['search']['value'],'web_country'=>$sk['search']['value'],'link_insertion_cost'=>$sk['search']['value'],'bank_details'=>$sk['search']['value'],'tat'=>$sk['search']['value'],'social_media_posting'=>$sk['search']['value']));

		    }else{
    		    foreach($sk['columns'] as $key =>$search){
    		        if(!empty($search['search']['value']) && $search['data'] == 'da' && strpos($search['search']['value'],'@') > 1){
    		           $know_da = str_replace('@','',$search['search']['value']);
    		           $da_arra = explode(',',$know_da);
    		           $this->db->where('da>=',$da_arra[0]);
    		           $this->db->where('da<=',$da_arra[1]);
    		        }elseif(!empty($search['search']['value']) && $search['data'] == 'web_category' && $search['search']['value'] == 'no'){
    		            $this->db->where('web_category!=','Com & Agency');
				        $this->db->where('web_category!=','Agency');
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'niche' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $this->db->where('niche',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'site_category' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		                $this->db->where('site_category',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'language' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		                $this->db->where('language',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'price' && strpos($search['search']['value'],'@') > 1){
    		           $know_price = str_replace('@','',$search['search']['value']);
    		           $price_arra = explode(',',$know_price);
    		            $this->db->where('price>=',$price_arra[0]);
    		           $this->db->where('price<=',$price_arra[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'traffic' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('traffic>=',$traffic_array[0]);
    		            $this->db->where('traffic<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'semrush_traffic' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('semrush_traffic>=',$traffic_array[0]);
    		            $this->db->where('semrush_traffic<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'similarweb_traffic' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('similarweb_traffic>=',$traffic_array[0]);
    		            $this->db->where('similarweb_traffic<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'dr' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('dr>=',$traffic_array[0]);
    		            $this->db->where('dr<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'spam_score' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('spam_score>=',$traffic_array[0]);
    		            $this->db->where('spam_score<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'timestamp' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('tbl_olt.timestamp>=',$traffic_array[0]);
    		            $this->db->where('tbl_olt.timestamp<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'casino_adult' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('casino_adult>=',$traffic_array[0]);
    		            $this->db->where('casino_adult<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'cbd_price' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('cbd_price>=',$traffic_array[0]);
    		            $this->db->where('cbd_price<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'adult' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('adult>=',$traffic_array[0]);
    		            $this->db->where('adult<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value'])){
    		            if($search['data'] == 'vendor_name'){
    		                $search['data'] = 'tbl_vendors.name';
    		            }elseif($search['data'] == 'vendor_email'){
    		                $search['data'] = 'tbl_vendors.email';
    		            }elseif($search['data'] == 'vendor_contact'){
    		                $search['data'] = 'tbl_vendors.contacted_from';
    		            }elseif($search['data'] == 'phone_numbers'){
    		                $search['data'] = 'tbl_vendors.phone';
    		            }elseif($search['data'] == 'user_name'){
    		                $search['data'] = 'tbl_users.name';
    		            }elseif($search['data'] == 'timestamp'){
    		                $search['data'] = 'tbl_olt.timestamp';
    		            }elseif($search['data'] == 'remark'){
    		                $search['data'] = 'tbl_olt.remark';
    		            }
    		            $search_specific = str_replace('*','',$sk['columns'][$key]['search']['value']);
    		            $this->db->like($search['data'],$search_specific);
    		        }
    		    }
		    }
		    $this->db->where('web_category!=','Lost Sites');
		    $this->db->group_by(['website']);
		    //$this->db->order_by($column_a[$sk['order'][0]['column']],$sk['order'][0]['dir']);
		    $this->db->order_by('price','DESC');
			$this->db->select('count(website) as nows,tbl_vendors.name as vendor_name,tbl_vendors.email as vendor_email,tbl_vendors.contacted_from as vendor_contact,tbl_vendors.phone as phone_numbers,tbl_users.name as user_name, tbl_olt.*');
		    $this->db->from('tbl_vendors');
		    $this->db->join('tbl_olt', 'tbl_olt.person_id = tbl_vendors.id');
		    $this->db->join('tbl_users', 'tbl_users.id = tbl_olt.user_id');
		    //$num_results = $this->db->count_all_results();
		    if($sk['length'] > 0){
		        $this->db->limit($sk['length'],$sk['start']);
		    }
		    $data = $this->db->get()->result_array();
		      $web_cate = array_column($data,'web_category');
		    foreach($web_cate as $index => $findlostsites){ //echo $findlostsites;die;
		        if($findlostsites == 'Lost Sites' && sizeof($web_cate) > 1){
		            unset($data[$index]);// = [];
		            
		        }else if($findlostsites == 'Lost Sites' && sizeof($web_cate) == 1){
		            $data = [];
		        }
		    }
		    $data = array_values($data);
		    //echo '<pre>'; print_r($data);die;
		    
		    $results = [
            "draw" => $sk['draw'],
            "recordsTotal" => $num_results,
            "recordsFiltered" => $num_results,
            "data" => $data
            ];
		   echo json_encode($results);
		}
		
		public function languagedata_all(){
		    
		    $sk = $this->input->get();
		    $datas = $this->db->get('tbl_olt')->result_array();
		    $column_a= array('website','niche','da','email','language','price','currency','from_id','ahref_traffic','semrush_traffic','date');
		    $sd_vaue = '';
		    //echo '<pre>'; print_r($datas);die;
		    if(!empty($sk['search']['value'])){
		        $this->db->or_like(array('website' => $sk['search']['value'],'niche' => $sk['search']['value'],'da'=>$sk['search']['value'],'email'=>$sk['search']['value'],'language'=>$sk['search']['value'],'price'=>$sk['search']['value'],'currency'=>$sk['search']['value'],'from_id'=>$sk['search']['value'],'ahref_traffic'=>$sk['search']['value'],'semrush_traffic'=>$sk['search']['value'],'date'=>$sk['search']['value']));
		        $sd_vaue = $sk['search']['value'];
		    }else{
    		    foreach($sk['columns'] as $key =>$search){
    		        if(!empty($search['search']['value']) && strpos($search['search']['value'],'*') > 1 || strpos($search['search']['value'],'@') > 1){
    		            $sd_vaue = $search['search']['value'];
    		        }elseif(!empty($search['search']['value']) && $search['data'] == 'da' && strpos($search['search']['value'],'@') > 1){
    		           $know_da = str_replace('@','',$search['search']['value']);
    		           //print_r($know_da);die;
    		           $da_arra = explode(',',$know_da);
    		           $this->db->where('da>=',$da_arra[0]);
    		           $this->db->where('da<=',$da_arra[1]);
    		        }elseif(!empty($search['search']['value']) && $search['data'] == 'niche' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		                $this->db->where('niche',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'from_id' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		                $this->db->where('from_id',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'language' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		                $this->db->where('language',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'currency' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		                $this->db->where('currency',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'price' && strpos($search['search']['value'],'@') > 1){
    		           $know_price = str_replace('@','',$search['search']['value']);
    		           $price_arra = explode(',',$know_price);
    		            $this->db->where('price>=',$price_arra[0]);
    		           $this->db->where('price<=',$price_arra[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'ahref_traffic' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('ahref_traffic>=',$traffic_array[0]);
    		            $this->db->where('ahref_traffic<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'semrush_traffic' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('semrush_traffic>=',$traffic_array[0]);
    		            $this->db->where('semrush_traffic<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value'])){
    		             $search_specific = str_replace('*','',$sk['columns'][$key]['search']['value']);
    		            $this->db->like($search['data'],$search_specific);
    		         }
    		    }
		    }
		    if(empty($sd_vaue)){
		        $results = 'You have not follow the rules';
		        echo json_encode($results);die;
		    }
		    $this->db->select('website,niche,da,email,language,price,currency,from_id,ahref_traffic,semrush_traffic,date');
		    $this->db->from('tbl_olt');
		    $num_results = $this->db->count_all_results();
		    
		    if(!empty($sk['search']['value'])){
		        $this->db->or_like(array('website' => $sk['search']['value'],'niche' => $sk['search']['value'],'da'=>$sk['search']['value'],'email'=>$sk['search']['value'],'language'=>$sk['search']['value'],'price'=>$sk['search']['value'],'currency'=>$sk['search']['value'],'from_id'=>$sk['search']['value'],'ahref_traffic'=>$sk['search']['value'],'semrush_traffic'=>$sk['search']['value'],'date'=>$sk['search']['value']));
		        $sd_vaue = $sk['search']['value'];
		    }else{
    		    foreach($sk['columns'] as $key =>$search){
    		        if(!empty($search['search']['value']) && $search['data'] == 'da' && strpos($search['search']['value'],'@') > 1){
    		           $know_da = str_replace('@','',$search['search']['value']);
    		           //print_r($know_da);die;
    		           $da_arra = explode(',',$know_da);
    		           $this->db->where('da>=',$da_arra[0]);
    		           $this->db->where('da<=',$da_arra[1]);
    		        }elseif(!empty($search['search']['value']) && $search['data'] == 'niche' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		                $this->db->where('niche',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'from_id' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		                $this->db->where('from_id',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'language' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		                $this->db->where('language',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'currency' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		                $this->db->where('currency',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'price' && strpos($search['search']['value'],'@') > 1){
    		           $know_price = str_replace('@','',$search['search']['value']);
    		           $price_arra = explode(',',$know_price);
    		            $this->db->where('price>=',$price_arra[0]);
    		           $this->db->where('price<=',$price_arra[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'ahref_traffic' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('ahref_traffic>=',$traffic_array[0]);
    		            $this->db->where('ahref_traffic<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'semrush_traffic' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('semrush_traffic>=',$traffic_array[0]);
    		            $this->db->where('semrush_traffic<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value'])){
    		             $search_specific = str_replace('*','',$sk['columns'][$key]['search']['value']);
    		            $this->db->like($search['data'],$search_specific);
    		         }
    		    }
		    }
		    $this->db->select('website,niche,da,email,language,price,currency,from_id,ahref_traffic,semrush_traffic,date');
		    $this->db->order_by($column_a[$sk['order'][0]['column']],$sk['order'][0]['dir']);
		    $this->db->from('tbl_olt');
		    if($sk['length'] > 0){
		        $this->db->limit($sk['length'],$sk['start']);
		    }
		    $data = $this->db->get()->result_array();
		    $results = [
            "draw" => $sk['draw'],
            "recordsTotal" => $num_results,
            "recordsFiltered" => $num_results,
            "data" => $data
            ];
		   echo json_encode($results);
		}
		
		
		public function agendata(){
		    
		    $sk = $this->input->get();
		    $datas = $this->db->get('tbl_agencies')->result_array();
		    $column_a= array('website','niche','da','pa','web_category','age','price','note','person','contact','contact_from','follow','spam_score','sample_url','link_price','min_words','traffic2','ahref_traffic','related_price','links','traffic','site_description','casino_cbd','tat','rd','ar','dr','cf','tf','indexd');
		    //echo '<pre>';print_r($sk['columns']);die;
		    $sd_vaue = '';
		    if(!empty($sk['search']['value'])){
		        $this->db->or_like(array('website' => $sk['search']['value'],'ahref_traffic' => $sk['search']['value'],'niche' => $sk['search']['value'],'da'=>$sk['search']['value'],'pa'=>$sk['search']['value'],'web_category'=>$sk['search']['value'],'age'=>$sk['search']['value'],'price'=>$sk['search']['value'],'note'=>$sk['search']['value'],'price'=>$sk['search']['value'],'contact'=>$sk['search']['value'],'contact_from'=>$sk['search']['value'],'follow'=>$sk['search']['value'],'spam_score'=>$sk['search']['value'],'sample_url'=>$sk['search']['value'],'link_price'=>$sk['search']['value'],'min_words'=>$sk['search']['value'],'traffic2'=>$sk['search']['value'],'spam_score'=>$sk['search']['value'],'traffic'=>$sk['search']['value'],'related_price'=>$sk['search']['value'],'links'=>$sk['search']['value'],'site_description' => $sk['search']['value'],'traffic'=>$sk['search']['value'],'casino_cbd'=>$sk['search']['value'],'tat'=>$sk['search']['value'],'rd'=>$sk['search']['value'],'ar'=>$sk['search']['value'],'dr'=>$sk['search']['value'],'cf'=>$sk['search']['value'],'tf'=>$sk['search']['value'],'indexd'=>$sk['search']['value']));
		   		        //$this->db->or_like(array('id' => $sk['search']['value'], 'website' => $sk['search']['value'],'niche'=>$sk['search']['value'],'da'=>$sk['search']['value'],'pa'=>$sk['search']['value'],'price'=>$sk['search']['value']));,'semrush_traffic','similarweb_traffic','1st','2nd','3rd','4th',
		    $sd_vaue = $sk['search']['value'];
		        
		    }else{
		        
    		    foreach($sk['columns'] as $key =>$search){
    		        //print_r($search['search']['value']);
    		        if(!empty($search['search']['value']) && strpos($search['search']['value'],'*') > 1 || strpos($search['search']['value'],'@') > 1){
    		            $sd_vaue = $search['search']['value'];
    		        }if(!empty($search['search']['value']) && $search['data'] == 'da' && strpos($search['search']['value'],'@') > 1){
    		           $know_da = str_replace('@','',$search['search']['value']);
    		           //print_r($know_da);die;
    		           $da_arra = explode(',',$know_da);
    		           $this->db->where('da>=',$da_arra[0]);
    		           $this->db->where('da<=',$da_arra[1]);
    		        }elseif(!empty($search['search']['value']) && $search['data'] == 'web_category' && $search['search']['value'] == 'no'){
    		            $this->db->where('web_category!=','Com & Agency');
    		            
				        $this->db->where('web_category!=','Agency');
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'niche' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            //echo $know_single_niche;
    		                $this->db->where('niche',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'price' && strpos($search['search']['value'],'@') > 1){
    		           $know_price = str_replace('@','',$search['search']['value']);
    		           $price_arra = explode(',',$know_price);
    		            $this->db->where('price>=',$price_arra[0]);
    		           $this->db->where('price<=',$price_arra[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'traffic' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('traffic>=',$traffic_array[0]);
    		            $this->db->where('traffic<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'traffic2' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('traffic2>=',$traffic_array[0]);
    		            $this->db->where('traffic2<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'ahref_traffic' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('ahref_traffic>=',$traffic_array[0]);
    		            $this->db->where('ahref_traffic<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'dr' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('dr>=',$traffic_array[0]);
    		            $this->db->where('dr<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'spam_score' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('spam_score>=',$traffic_array[0]);
    		            $this->db->where('spam_score<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'casino_cbd' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('casino_cbd>=',$traffic_array[0]);
    		            $this->db->where('casino_cbd<=',$traffic_array[1]);
    		         }
    		    }
		    }
		    if(empty($sd_vaue)){
		        $results = 'You have not follow the rules';
		        echo json_encode($results);die;
		    }
		    
		    $this->db->group_by(['website']);
		    $this->db->order_by($column_a[$sk['order'][0]['column']],$sk['order'][0]['dir']);
		    $datass = $this->db->get('tbl_agencies')->result_array();
		    $num_results = count($datass);//$this->db->count_all_results();
		    //echo '<pre>'; print_r($num_results);die;
		    //$data = $this->db->get()->result_array();
		    //$ssd  = count($data);
		    
		     if(!empty($sk['search']['value'])){
		        $this->db->or_like(array('website' => $sk['search']['value'],'ahref_traffic' => $sk['search']['value'],'niche' => $sk['search']['value'],'da'=>$sk['search']['value'],'pa'=>$sk['search']['value'],'web_category'=>$sk['search']['value'],'age'=>$sk['search']['value'],'price'=>$sk['search']['value'],'note'=>$sk['search']['value'],'price'=>$sk['search']['value'],'contact'=>$sk['search']['value'],'contact_from'=>$sk['search']['value'],'follow'=>$sk['search']['value'],'spam_score'=>$sk['search']['value'],'sample_url'=>$sk['search']['value'],'link_price'=>$sk['search']['value'],'min_words'=>$sk['search']['value'],'traffic2'=>$sk['search']['value'],'spam_score'=>$sk['search']['value'],'traffic'=>$sk['search']['value'],'related_price'=>$sk['search']['value'],'links'=>$sk['search']['value'],'site_description' => $sk['search']['value'],'traffic'=>$sk['search']['value'],'casino_cbd'=>$sk['search']['value'],'tat'=>$sk['search']['value'],'rd'=>$sk['search']['value'],'ar'=>$sk['search']['value'],'dr'=>$sk['search']['value'],'cf'=>$sk['search']['value'],'tf'=>$sk['search']['value'],'indexd'=>$sk['search']['value']));
		   		        //$this->db->or_like(array('id' => $sk['search']['value'], 'website' => $sk['search']['value'],'niche'=>$sk['search']['value'],'da'=>$sk['search']['value'],'pa'=>$sk['search']['value'],'price'=>$sk['search']['value']));,'semrush_traffic','similarweb_traffic','1st','2nd','3rd','4th',
		    $sd_vaue = $sk['search']['value'];
		        
		    }else{
    		    foreach($sk['columns'] as $key =>$search){
    		        if(!empty($search['search']['value']) && strpos($search['search']['value'],'*') > 1 || strpos($search['search']['value'],'@') > 1){
    		            $sd_vaue = $search['search']['value'];
    		        }if(!empty($search['search']['value']) && $search['data'] == 'da' && strpos($search['search']['value'],'@') > 1){
    		           $know_da = str_replace('@','',$search['search']['value']);
    		           //print_r($know_da);die;
    		           $da_arra = explode(',',$know_da);
    		           $this->db->where('da>=',$da_arra[0]);
    		           $this->db->where('da<=',$da_arra[1]);
    		        }elseif(!empty($search['search']['value']) && $search['data'] == 'web_category' && $search['search']['value'] == 'no'){
    		            $this->db->where('web_category!=','Com & Agency');
    		            
				        $this->db->where('web_category!=','Agency');
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'niche' && strpos($search['search']['value'],'@') >= 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		                $this->db->where('niche',$know_single_niche);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'price' && strpos($search['search']['value'],'@') > 1){
    		           $know_price = str_replace('@','',$search['search']['value']);
    		           $price_arra = explode(',',$know_price);
    		            $this->db->where('price>=',$price_arra[0]);
    		           $this->db->where('price<=',$price_arra[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'traffic' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('traffic>=',$traffic_array[0]);
    		            $this->db->where('traffic<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'traffic2' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('traffic2>=',$traffic_array[0]);
    		            $this->db->where('traffic2<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'ahref_traffic' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('ahref_traffic>=',$traffic_array[0]);
    		            $this->db->where('ahref_traffic<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'dr' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('dr>=',$traffic_array[0]);
    		            $this->db->where('dr<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'spam_score' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('spam_score>=',$traffic_array[0]);
    		            $this->db->where('spam_score<=',$traffic_array[1]);
    		         }elseif(!empty($search['search']['value']) && $search['data'] == 'casino_cbd' && strpos($search['search']['value'],'@') > 1){
    		            $know_single_niche = str_replace('@','',$search['search']['value']);
    		            $traffic_array = explode(',',$search['search']['value']);
    		            $this->db->where('casino_cbd>=',$traffic_array[0]);
    		            $this->db->where('casino_cbd<=',$traffic_array[1]);
    		         }
    		    }
		    }
		    
		    $this->db->group_by(['website']);
		    $this->db->order_by($column_a[$sk['order'][0]['column']],$sk['order'][0]['dir']);
			
		    if($sk['length'] > 0){
		        $this->db->limit($sk['length'],$sk['start']);
		    }
		    $data = $this->db->get('tbl_agencies')->result_array();
		     
		    //echo '<pre>'; print_r(count($data));die;
		    
		    $results = [
            "draw" => $sk['draw'],
            "recordsTotal" => $num_results,
            "recordsFiltered" => $num_results,
            "data" => $data
            ];
		   echo json_encode($results);
		}
		
    public function download(){
        /*$old_name = "imports/1579587475.docx" ; 
        $new_name = "sujeet.docx" ; 
        rename( $new_name, $old_name) ;*/
        $this->load->helper('download');
        force_download('imports/1579587475.docx', NULL);
    }
    
    public function bulk_client_payment_update(){
         $this->output->set_content_type('application/json');
        $form_data = $this->input->post();
        //echo '<pre>';print_r($form_data);die;
        if(!empty($form_data)){
            foreach($form_data['order_ids'] as $key => $value){
                
                $data['actual_received_amount'] = $form_data['actual_received_amount'][$key];
    			$data['client_amount_received'] = $form_data['client_amount_received'][$key];
    			$data['client_amount_received_date'] = $form_data['client_amount_received_date'][$key];
    			$data['client_amount_received_status'] = $form_data['client_amount_received_status'][$key];
    			$data['client_account_type'] = $form_data['client_account_type'][$key];
    			$data['client_account_id'] = $form_data['client_account_id'][$key];
    			$payment_status = $this->db->get_where('tbl_orders',['id'=>$value])->row_array();
    			if($payment_status['client_amount_received_status']=='Received'){
    			    $this->send_data($value);
    			}
    			//echo '<pre>';print_r($data);die;
    			$this->db->where('id',$value);
    			$this->db->update('tbl_orders',$data);
            }
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Order Updated Successfully','url'=>base_url('finance')]));
			return FALSE;
        }
    }
    
    public function quick_update_order(){
        $this->output->set_content_type('application/json');
		$this->form_validation->set_rules('assign_date','Assign Date','required');
		$this->form_validation->set_rules('status','Status','required');
		$id = $this->security->xss_clean($this->input->post('update_id'));
		//$this->form_validation->set_rules('vendor_payment_date','Paid Date','required');
		if($this->form_validation->run()===FALSE) {
			$this->output->set_output(json_encode(['result' => 0,'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
		$result = $this->user_model->quick_updation();
		if($result){
			$this->output->set_output(json_encode(['result' => 1, 'msg' => 'Order Updated Successfully','id'=>$id]));
			return FALSE;
		}
    }
    
    public function bulk_assign_update(){
         $this->output->set_content_type('application/json');
        $form_data = $this->input->post();
        //echo '<pre>';print_r($form_data);die;
        if(!empty($form_data)){
            foreach($form_data['order_ids'] as $key => $value){
                
                $data['vendor_website_ramark'] = $form_data['remark'][$key];
                $data['publish_url'] = $form_data['publish_url'][$key];
                $data['publish_date'] = $form_data['publish_date'][$key];
                $data['assign_date'] = $form_data['assign_date'][$key];
                $data['status'] = $form_data['status'][$key];
    		    //echo '<pre>';print_r($data);die;
    			$this->db->where('id',$value);
    			$this->db->update('tbl_orders',$data);
            }
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Order Updated Successfully','url'=>base_url('operates')]));
			return FALSE;
        }
    }
    
    public function bulk_vendor_payment_update(){
         $this->output->set_content_type('application/json');
        $form_data = $this->input->post();
        //echo '<pre>';print_r($form_data);die;
        if(!empty($form_data)){
            foreach($form_data['order_ids'] as $key => $value){
                
                $data['vendor_transaction_id'] = $form_data['vendor_transaction_id'][$key];
                $data['vendor_payment_status'] = $form_data['vendor_payment_status'][$key];
                $data['vendor_invoice_status'] = $form_data['vendor_invoice_status'][$key];
                $data['vendor_payment_date'] = $form_data['vendor_payment_date'][$key];
                $data['actual_paid_amount'] = $form_data['actual_paid_amount'][$key];
    		    //echo '<pre>';print_r($data);die;
    			$this->db->where('id',$value);
    			$this->db->update('tbl_orders',$data);
            }
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Order Updated Successfully','url'=>base_url('vendor-payment')]));
			return FALSE;
        }
    }
    
    public function quick_update_payment(){
        $this->output->set_content_type('application/json');
		$this->form_validation->set_rules('vendor_payment_date','Payment Date','required');
		$id = $this->security->xss_clean($this->input->post('order_id'));
		//$this->form_validation->set_rules('vendor_payment_date','Paid Date','required');
		if($this->form_validation->run()===FALSE) {
			$this->output->set_output(json_encode(['result' => 0,'errors' => $this->form_validation->error_array()]));
			return FALSE;
		}
		$result = $this->user_model->quick_updation_payment();
		if($result){
			$this->output->set_output(json_encode(['result' => 2, 'msg' => 'Order Updated Successfully','id'=>$id]));
			return FALSE;
		}
    }
		
		public function get_website(){
			$data['scripts'] = ['comman/user.js'];
			$data['title']= 'Website';
			$data['user_info'] = $this->user_model->user_info();
			$data['websites'] = $this->user_model->get_all_ordered_website();
			//echo '<pre>';print_r($data['websites']);die;
			$this->load->view('user/common/header',$data);
			//$this->load->view('user/common/side_bar',$data);
			$this->load->view('user/common/nav_bar');
			$this->load->view('user/websites_orders',$data);
			$this->load->view('user/common/footer');
		}
		
		public function find_aid(){
			$data['scripts'] = ['comman/user.js'];
			$data['title']= 'Website';
			$data['user_info'] = $this->user_model->user_info();
			$sites= $this->input->post('multiple_site_check');
		    $datas = explode("\r\n",$sites);
			$this->db->where_in('website',$datas);
			$data['websites'] = $this->db->get('tbl_sites')->result_array();
			//echo '<pre>';print_r($data['websites']);die;
			$this->load->view('user/common/header',$data);
			//$this->load->view('user/common/side_bar',$data);
			$this->load->view('user/common/nav_bar');
			$this->load->view('user/findaid',$data);
			$this->load->view('user/common/footer');
		}
		
		public function send_data($id){
			$data = $this->db->get_where('tbl_orders',['id' => $id])->row_array();
			$date=explode("/",$data['assign_date']);
			$date1=explode("/",$data['publish_date']);
			$date2=explode("/",$data['client_amount_received_date']);
			$date3=explode("/",$data['vendor_payment_date']);
			$data['assign_date'] = $date[2].'-'.$date[1].'-'.$date[0];  
			$data['publish_date'] = $date1[2].'-'.$date1[1].'-'.$date1[0];
			$data['client_amount_received_date'] = $date2[2].'-'.$date2[1].'-'.$date2[0];
			$data['vendor_payment_date'] = $date3[2].'-'.$date3[1].'-'.$date3[0];
			//$json_data = json_encode($data);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,"https://n8n.emiactech.com/webhook-test/739ae735-dc8a-47f6-91f0-4ea47c499025");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$server_output = curl_exec($ch);
			curl_close ($ch);
			//echo '<pre>'; print_r($data);die;
		}
		
		
		public function get_web(){
			if(!isset($_POST['searchTerm'])){ 
  $search = 'heal';
}else{ 
  $search = $_POST['searchTerm'];   
  
} 
	        $this->db->like('website',$search);
			$this->db->select('website');
	        $data = $this->db->get('tbl_sites')->result_array();
	        //$url = base_url('get_cities');
	        //echo '<select id="state" name="state" class="select-filter" url="'.$url.'">';
	        //echo '<option value="">Select State*</option>';
	        foreach($data as $weba){
				$data[] = array("id"=>$weba['website'], "text"=>$weba['website']);
	            //'<option value="'.$weba['website'].'">'.$weba['website'].'</option>';
	        }
			echo json_encode($data);
	        //echo '</select>';
	    }
		public function update_tool_data($website,$vendor_id,$cp){
				$cdate = date('Y-m-d');
				$this->db->where('website',$website);
				$this->db->where('person_id',$vendor_id);
				$this->db->update('tbl_sites',['price'=>$cp,'cp_update_date'=>$cdate]);
				print_r($this->db->affected_rows());
		}
		
		public function update_tool_data_now(){
			$skd = file_get_contents('php://input');
			$post_data = json_decode($skd,true);
			
			 $result = array();
			 if(!empty($post_data['da'])){
				 $result['da'] = $post_data['da'];
				 $result['semrush_updation_date'] = date('Y-m-d');
			 }
			if(!empty($post_data['pa'])){
				 $result['pa'] = $post_data['pa'];
				$result['semrush_updation_date'] = date('Y-m-d');
			 }
			if(!empty($post_data['spam_score'])){
				 $result['spam_score'] = $post_data['spam_score'];
				$result['semrush_updation_date'] = date('Y-m-d');
			 }
			if(!empty($post_data['semrush_traffic'])){
				 $result['semrush_traffic'] = $post_data['semrush_traffic'];
				$result['semrush_updation_date'] = date('Y-m-d');
			 }
			if(!empty($post_data['semrush_india'])){
				 $result['semrush_india'] = $post_data['semrush_india'];
				$result['semrush_updation_date'] = date('Y-m-d');
			 }
			if(!empty($post_data['semrush_uk'])){
				 $result['semrush_uk'] = $post_data['semrush_uk'];
				$result['semrush_updation_date'] = date('Y-m-d');
			 }
			if(!empty($post_data['semrush_us'])){
				 $result['semrush_us'] = $post_data['semrush_us'];
				$result['semrush_updation_date'] = date('Y-m-d');
			 }
			if(!empty($post_data['semrush_australia'])){
				 $result['semrush_australia'] = $post_data['semrush_australia'];
				$result['semrush_updation_date'] = date('Y-m-d');
			 }
			if(!empty($post_data['dr'])){
				 $result['dr'] = $post_data['dr'];
				$result['semrush_updation_date'] = date('Y-m-d');
			 }
			if(!empty($post_data['traffic'])){
				 $result['traffic'] = $post_data['traffic'];
				$result['semrush_updation_date'] = date('Y-m-d');
			 }
			if(!empty($post_data['web_ip'])){
				 $result['web_ip'] = $post_data['web_ip'];
				$result['semrush_updation_date'] = date('Y-m-d');
			}
			if(!empty($post_data['pure_category'])){
				 $result['pure_category'] = $post_data['pure_category'];
				$result['semrush_updation_date'] = date('Y-m-d');
			 }
			if(!empty($post_data['niche'])){
				 $result['niche'] = $post_data['niche'];
				$result['semrush_updation_date'] = date('Y-m-d');
			 }
			if(!empty($post_data['site_category'])){
				 $result['site_category'] = $post_data['site_category'];
				$result['semrush_updation_date'] = date('Y-m-d');
			 }
			//print_r($result);die;
			$this->db->where('website',$post_data['website']);
			$this->db->update('tbl_sites',$result);
			//print_r($this->db->affected_rows());die;
			if($this->db->affected_rows()){
				echo 'new';
			}else{
				echo 'old';
			}
		}
		
		
		// This API is working with N8N scenario to verify weather the scraped websites is already available or not
		
		public function check_website($website){
				$this->db->select('id');
				$web = $this->db->get_where('tbl_sites',['website'=>$website])->row_array();;
				//print_r($web['id']);die;
		}
		
	 public function shop_shiprocket_token_cron($id){
	        if($id == 1){
	            $email = 'sakshi.agrawal@emiactech.com';
	        }elseif($id == 2){
	            $email = 'yogesh@emiactech.com';
	        }elseif($id == 3){
	            $email = 'ajhar@emiactech.com';
	        }elseif($id == 4){
	            $email = 'sujeet@emiactech.com';
	        }elseif($id == 5){
	            $email = 'sujeet@gmail.com';
	        }
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => false,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS =>"{\n    \"email\": \"$email\",\n    \"password\": \"s&571988\"\n}",
              CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
              ),
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            if ($err) {
              echo "cURL Error #:" . $err;
            } else {
              $data = json_decode($response);//echo '<pre>';print_r($data);die;
				//echo '<pre>';print_r($data);die;
              $cron_data = $this->db->get_where('cron_token',['id'=>$id])->row_array();
              $timestamp = time();
              if(!empty($cron_data)){
                  $this->db->where('id',$id);
                  $this->db->update('cron_token',['token'=>$data->token,'timestamp'=>$timestamp]);
              }
              
            } 
	    }

		public function get_token($id){
	        $this->db->where('id',$id);
	        $data = $this->db->get('cron_token')->row_array();
	        echo $data['token'];
	    }

	public function get_tokenff(){
	 		$websites = [];
			$semrush = [];
			$india = [];
			$us = [];
			$uk = [];
			$aust = [];
		$updateArray = array();
			foreach($websites as $key => $value){
				$updateArray[] = array(
					'website'=>$value,
					'semrush_traffic'=>$semrush[$key],
					'semrush_india' => $india[$key],
					'semrush_us' => $us[$key],
					'semrush_uk' => $uk[$key],
					'semrush_australia' => $aust[$key]
				);
			}
		$this->db->update_batch('tbl_sites',$updateArray, 'website'); 
		echo '<pre>';print_r($updateArray);die;
		}

		public function outreach_data_store() 
        { 
                $data = array(); 
                $data['website'] = $this->input->post('website'); 
                $data['niche'] = $this->input->post('niche'); 
                $data['da'] = $this->input->post('da'); 
                $data['pa'] = $this->input->post('pa');  
                $data['person_id'] = $this->input->post('person_id'); 
                $data['price'] = $this->input->post('price'); 
                $data['sailing_price'] =$this->input->post('sailing_price'); 
                $data['discount'] = 0;
                $data['casino_adult'] = $this->input->post('casino');
                $data['web_category'] = $this->input->post('web_category'); 
                $data['follow'] = $this->input->post('follow'); 
                $data['adult'] = $this->input->post('adult'); 
                $data['traffic'] = $this->input->post('traffic'); 
                $data['spam_score'] = $this->input->post('spam_score'); 
                $data['cbd_price'] = $this->input->post('cbd_price'); 
                $data['remark'] = $this->input->post('remark');  
                $data['sample_url'] = $this->input->post('sample_url');
                $data['dr'] = $this->input->post('dr'); 
                $data['user_id'] = 2; 
                $data['link_insertion_cost'] = $this->input->post('link_insertion_cost'); 
                $data['tat'] = $this->input->post('tat'); 
                $data['social_media_posting'] = $this->input->post('social_media_posting'); 
                $data['semrush_traffic'] = $this->input->post('semrush_traffic');
                $data['1st'] = $this->input->post('1st'); 
                $data['2nd'] = $this->input->post('2nd'); 
                $data['3rd'] = $this->input->post('3rd'); 
                $data['4th'] = $this->input->post('4th'); 
                $data['5th'] = $this->input->post('5th');
                $data['banner_image_price'] = $this->input->post('banner_image_price');
				//Vendor Details Fetched from Vendor Table
				$vendor_info = $this->db->get_where('tbl_vendors',['id'=>$data['person_id']])->row_array();
				$data['contact'] = $vendor_info['email'];
				$data['contact_from'] = $vendor_info['contacted_from'];
				$data['person'] = $vendor_info['name'];
                $data['phone_number'] = $vendor_info['phone'];
				
                $response = $this->db->insert('tbl_sites',$data);
			//echo "<pre>"; print_r($response);die;
 				if($this->db->insert_id()){
					echo 'Website added Successfully';die;
				}
                echo "Website not added please check"; // creates the entry in database 
        }

		public function do_add_vendor_api(){
			$data = array(); 
			$data['name'] = $this->security->xss_clean($this->input->post('name'));
			$data['email'] = $this->security->xss_clean($this->input->post('email'));
		    $data['phone'] = $this->security->xss_clean($this->input->post('phone'));
			$data['contacted_from'] = $this->security->xss_clean($this->input->post('contacted_from'));
			$data['vendor_bank_name'] = $this->security->xss_clean($this->input->post('vendor_bank_name'));
			$data['bank_name'] = $this->security->xss_clean($this->input->post('bank_ifsc'));
			$data['bank_ifsc'] = $this->security->xss_clean($this->input->post('bank_name'));
			$data['paypal_id'] = $this->security->xss_clean($this->input->post('paypal_id'));
			$data['skype_id'] = $this->security->xss_clean($this->input->post('skype_id'));
			$data['upi_id'] = $this->security->xss_clean($this->input->post('upi_id'));
			$data['account_number'] = $this->security->xss_clean($this->input->post('account_number'));
			$data['user_id'] = $this->session->user_id;
			$data['timestamp'] = time();
			
			$this->db->insert('tbl_vendors',$data);
			return $this->db->insert_id();
		}

		public function update_invoices(){
			$data = $this->input->post();
			//$this->output->set_content_type('application/json');
			$result = $this->user_model->do_update_invoices();
			//echo '<pre>'; print_r($result);die;
			if($result){
				echo "<script type=\"text/javascript\">alert(\"Invoice number is updated Successfully.\");
	            window.location = \"orders\"</script>";
			}
			echo "<script type=\"text/javascript\">alert(\"Invoice number is not updated.\");
	            window.location = \"orders\"</script>";
		}

		public function bulk_update_invoices(){
			$data = $this->input->post();
			//$this->output->set_content_type('application/json');
			$result = $this->user_model->do_bulk_update_invoices();
			//echo '<pre>'; print_r($result);die;
			if($result){
				echo "<script type=\"text/javascript\">alert(\"Client Amount Received Status updated Successfully.\");
	            window.location = \"finance\"</script>";
			}
			echo "<script type=\"text/javascript\">alert(\"Client Amount Received Status is not updated.\");
	            window.location = \"finance\"</script>";
		}

		public function published_url(){
			$data['scripts'] = ['comman/user.js'];
			$data['user_info'] = $this->user_model->user_info();
			$data['title'] = 'TOOL';
			$data['orders'] = $this->user_model->get_all_published_url();
			//echo '<pre>';print_r($data['orders']);die;
			$this->load->view('user/common/header',$data);
			//$this->load->view('user/common/side_bar',$data);
			$this->load->view('user/common/nav_bar');
			$this->load->view('user/publish_orders',$data);
			$this->load->view('user/common/footer');
    }
		//gpt work here
	public function gpt() {
        $this->load->view('user/question_form');
    }

    public function get_answer() {
        $inputData = file_get_contents('php://input');
		$postData = json_decode($inputData, true); // Convert JSON to associative array
		$userQuestion = isset($postData['question']) ? $postData['question'] : '';
		$main_question = 'Generate a Mysql Query of this question:,\n '.$userQuestion;
        $answer = $this->gpttest($main_question);
        echo json_encode(array('response' => $answer));
    }

    public function get_answer_from_gpt3($question, $websiteData) {
        $context = "Websites: " . $websiteData['website'] . "\nDomain Authorities: " . $websiteData['da'] . "\nPage Authorities: " . $websiteData['pa'] . "\n\n";
        $prompt = $context . "Question: " . $question . "\nAnswer:";
        $postData = array(
            "prompt" => $prompt,
            "max_tokens" => 50 // Adjust the response length
        );
        $ch = curl_init("https://api.openai.com/v1/engines/gpt-3.5-turbo/completions");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $this->openaiApiKey));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        $response = json_decode(curl_exec($ch), true);
		echo'<pre>';print_r($response);die;
        curl_close($ch);
        return $response['choices'][0]['text'];
    }

	public function getAnswerUsingGPT35Turbo($question, $websiteData, $openaiApiKey='sk-		KPyx2WVGPRCjLbspAglUT3BlbkFJ3FQoMVgxjXZ3tnBIfYzZ') {
		$context = "Website: " . $websiteData['website'] . "\nDomain Authority: " . $websiteData['da'] . "\nPage Authority: " . $websiteData['pa'] . "\n\n";
		$messages = array(
			array("role" => "system", "content" => $context),
			array("role" => "user", "content" => "Question: " . $question)
		);
		$postData = array(
			"messages" => $messages,
			"max_tokens" => 100, // Adjust the response length
			"model" => "gpt-3.5-turbo" // Specify the model
		);
		$ch = curl_init("https://api.openai.com/v1/chat/completions");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $openaiApiKey));
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
		$response = json_decode(curl_exec($ch), true);
		//echo'<pre>';print_r($response);die;
		curl_close($ch);
		return $response['choices'][0]['message']['content'];
	}								

	public function gpttest($question, $websiteData='', $openaiApiKey='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') {
		$messages = array(
			array("role" => "system", "content" => 'Table:tbl_sites, Columns: website:this column contain website url and it a varchar type, da:this column contain domain authority provided by moz and integer type, pa:this column contain domain authority provided by moz and integer type, niche:this is a website category like health, sports etc and varchar type'),
			array("role" => "user", "content" => "Question: " . $question)
		);
		$postData = array(
			"messages" => $messages,
			"max_tokens" => 100, // Adjust the response length
			"model" => "gpt-3.5-turbo" // Specify the model
		);
		$ch = curl_init("https://api.openai.com/v1/chat/completions");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $openaiApiKey));
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
		$response = json_decode(curl_exec($ch), true);
		curl_close($ch);
		$dataContent = $response['choices'][0]['message']['content'];
		$data = $this->user_model->get_gpt_data($dataContent);
		return $data;
	}

public function fetch_response() {
        $api_key = "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";
		$questions = 'Give me 2 more';
		$answers = 'Banana, Apple';
		//$this->session->sess_destroy();die;
        // Get the user input from the form
        $user_input = array('Questions:'=>$questions);

        // Load conversation history from session (if available)
        $conversation_history = $this->session->userdata('conversation_history');

        // If conversation history doesn't exist, create a new array
        if (!$conversation_history) {
            $conversation_history = array();
        }

        // Add user input to conversation history
        //$conversation_history[] = array('role' => 'user', 'content' => "questions:Give me 2 more,answers:Watermelons and oranges");

        // Limit the conversation history to the last 10 turns
        $max_history_length = 3;
        if (count($conversation_history) > $max_history_length) {
            $conversation_history = array_slice($conversation_history, - $max_history_length);
        }

        // Construct the prompt using the conversation history

        // Make the API call to generate a response
        $api_url = "https://api.openai.com/v1/chat/completions";
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $api_key
        );
        
	$conversation_history = array(
			array("role" => "system", "content" => 'Table:tbl_sites, Columns: website:this column contain website url and it a varchar type, da:this column contain domain authority provided by moz and integer type, pa:this column contain domain authority provided by moz and integer type, niche:this is a website category like health, sports etc and varchar type'),
			array("role" => "user", "content" => "Generate a Mysql Query of this question:,\n please give me 5 website of health niche"),
array("role" => "system", "content" => "Answer of previous question:\n SELECT website FROM tbl_sites WHERE niche = 'health' LIMIT 5"),
			array("role" => "user", "content" => "Generate a Mysql Query of this question:,\n give me 2 more")
		);
	$max_history_length = 5;
        if (count($conversation_history) > $max_history_length) {
            $conversation_history = array_slice($conversation_history, - $max_history_length);
        }
	//print_r($conversation_history);die;
		$postData = array(
			"messages" => $conversation_history,
			"max_tokens" => 150, // Adjust the response length
			"model" => "gpt-3.5-turbo" // Specify the model
		);
        // Initialize cURL session
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute cURL session
        $response = curl_exec($ch);

        // Close cURL session
        curl_close($ch);

        // Decode the JSON response
        $response_data = json_decode($response, true);
print_r($response_data);die;
        // Extract the assistant's reply from the API response
        $assistant_reply = $response_data['choices'][0]['text'];

        // Add assistant reply to conversation history
        $conversation_history[] = array('role' => 'assistant', 'content' => $assistant_reply);

        // Store updated conversation history in session
        $this->session->set_userdata('conversation_history', $conversation_history);
		
        // Load the view to display the conversation
        //$data['conversation_history'] = $conversation_history;
        //$this->load->view('conversation_view', $data);
    }

		
	public function sujeetTest() {
        $this->user_model->get_gpt_data("");
    }	

	public function cpct(){
		$postData = $this->input->post();
		//print_r($postData);die;
		$allresult = $this->user_model->getEmployees($postData);
		//print_r($allresult);die;
		$data['postData'] = $allresult['showColumns'];
        $data['employees'] =  $allresult['employees'];
		$this->load->view('user/testing',$data);
	}


	
					public function form()  //my form
			{
					$this->load->view('user/testform'); 
			}

					public function form_new_entry() //on submit my form
			{ 
					$this->user_model->getformdata();
					redirect(base_url().'viewformusers'); 
			}
	
					public function viewformusers()  // my form List or read in table format
			{ 
					$forms = $this->user_model->all_users();
					$abc['forms'] = $forms;
					$this->load->view('user/viewformusers',$abc);
			}










    						public function create() //you tube tutorial form
						{ 
								$this->load->view('user/create');
						}

							public function create_new_entry() //youtube tutorial form submit
						{ 
							$this->user_model->create();
							//$this->session->set_flashdata('success','Record Added Successfully!!');
							redirect(base_url().'viewusers');
						}

							public function viewusers() //youtube tutorial form List or read in table format
						{      
							$users = $this->user_model->all();
							$data['users'] = $users;
							$this->load->view('user/viewusers',$data);
						}

	
							public function edit($userid) // You tube form Edit View with prepopulated data
							
						{
							$data['user'] = $this->user_model->getuser($userid);
							//print_r($data['user']);
							$this->load->view('user/editusers',$data);
						}


					
								public function update($userid)
							{
								
								$formarray = $this->input->post();
								$this->user_model->updateuser($userid,$formarray);
								redirect(base_url().'viewusers');
								//print_r($userid);
								//print_r($formarray);die();
								/*Retrieve the form data from the POST request
								//$data['userid']=$this->user_model->getuser($userid);
								
								 Call the updateuser method with the user ID and form data
								$this->user_model->updateuser($userid,$formarray);*/
								
							}
							
	
								public function delete($userid)
							{
							
								 $this->user_model->deleteuser($userid);
								 redirect(base_url().'viewusers');
							}
	

							public function view($page = 'home')
							{
								if(! file_exists(APPPATH.'views/user/basic.php'))
								{
									show_404();
								}
								//print_r($page);die;
								$data['title'] = $page; 
								$this->load->view('user/templates/header', $data);
        						$this->load->view('user/basic', $data);
       							$this->load->view('user/templates/footer', $data);
							}
	
							


							public function get_news()
							
						{
							//$data['news'] = $this->user_model->news();
							//print_r($data['news']);
							//$this->load->view('user/news',$data);
							$news_item = $this->user_model->news();
							$data['news']=$news_item;
							//print_r($data['news']);
							$this->load->view('user/news',$data);
						}

							
							


							

						public function testing1() 
						{
							$users = $this->user_model->testing();
							$views = $this->user_model->getviewname();
							//echo '<pre>'; print_r($users);
							//echo '<pre>'; print_r($views);die();
							
							if($users)
							{
								//echo '<pre>'; print_r($users);die();
								$data['testingTable'] = $users['testing'];
								$data['filterViewData'] = $users['user_view_preferences'];
								$data['views'] = $views;
								$data['postData'] = $users['user_view_preferences']['selected_columns'];
								//echo '<pre>'; print_r($data);die();
								$this->load->view('user/loadview',$data);
							}

							else{
							$data['user'] = $this->user_model->gettestingdata();
							$data['view'] = $this->user_model->getviewname();
							$this->load->view('user/loadview',$data);
							}
							
						}


								
							public function filter2() 
						{
    						$selectedField = $this->input->post('tableHeader[]'); // Field selected by the user
    						$selectedOperator = $this->input->post('textOperator[]'); // Operator selected by the user
    						$enteredValue = $this->input->post('userInput[]'); // Value entered by the user
							$andor = $this->input->post('andOr[]'); // AND/OR entered by the user
							
							//echo '<pre>'; print_r($selectedField);echo '<pre>'; print_r($selectedOperator);echo '<pre>'; print_r($enteredValue);echo '<pre>'; print_r($andor);echo '<pre>';die;//print_r($tableHeaderSec);echo '<pre>'; print_r($textOperatorSec);echo '<pre>'; print_r($userInputSec);die;
							
    						if ($selectedField && $selectedOperator) 
							{
								//$data = array('user' => array());
        						// Filter criteria provided, call the model function to filter the data
								//echo '<pre>'; print_r($selectedOperator);die;
        						$filteredData = $this->user_model->filterData($selectedField, $selectedOperator, $enteredValue,$andor);
								//echo '<pre>'; print_r($filteredData);die;
        						$fdata['filteredData'] = $filteredData;
								$keys = array_keys($fdata['filteredData'][0]);
								$fdata['selectedHeader'] = $keys;
								$fdata['xyz'] = '';
								//echo '<pre>'; print_r($fdata);die;
								$this->load->view('user/filteredview',$fdata);
    						} 						
							else 
							{	
        						$data['user'] = $this->user_model->gettestingdata();// No filter criteria provided, load full data
								$keys = array_keys($data['user'][0]);
    							$data['selectedHeader'] = $keys;
								$data['xyz'] = 's';
								//echo '<pre>'; print_r($data);die;
    							$this->load->view('user/filteredview', $data);
    						}

    						
						}
							public function combined() 
				{
					//When Nothing no input is given by the user OR freshly loaded page
						//for view
							//$users = $this->user_model->testing();
							//echo '<pre>'; print_r($this->input->post('view_name'));die;
							$viewName = $this->input->post('view_name');
							
					//for applying filter data
								$views = $this->user_model->getviewname();
								$selectedField = $this->input->post('tableHeader[]'); 
								$selectedOperator = $this->input->post('textOperator[]');
								$enteredValue = $this->input->post('userInput[]');
								$andor = $this->input->post('andOr[]');
								
							if ($selectedField && $selectedOperator)
						{
        						$data['user'] = $this->user_model->filterData($selectedField, $selectedOperator, $enteredValue,$andor);
								//echo '<pre>'; print_r($filteredData);die;
        						//$fdata['user'] = $filteredData;
								//echo '<pre>'; print_r($data);die;
								$keys = array_keys($data['user'][0]);
								$data['selectedHeader'] = $keys;
								$data['view'] = $views;
								$data['xyz'] = 'sakshi';
								//echo '<pre>'; print_r($data);
								$this->load->view('user/combinedview',$data);
								
    					}elseif($viewName){
								$users = $this->user_model->testing();
								//print_r('sakshi');die;
								$data['testingTable'] = $users['testing'];
								$data['filterViewData'] = $users['user_view_preferences'];
								$data['views'] = $views;
								$data['xyz'] = 'first';
								//$tbheader = array_flip($users['user_view_preferences']['selected_columns']);
								//$data['tbheader'] = $tbheader;
								//echo '<pre>'; print_r($data['tbheader']);die();
								$data['postData'] = $users['user_view_preferences']['selected_columns'];
								//echo '<pre>'; print_r($data['postData']);die();
								//echo '<pre>'; print_r($data);die();
								$this->load->view('user/combinedview',$data);
						}
						else{
							$data['user'] = $this->user_model->gettestingdata();
								$data['view'] = $this->user_model->getviewname();
							//for filter data
								$keys = array_keys($data['user'][0]);
								$data['selectedHeader'] = $keys;
								$data['xyz'] = 's';
								//echo '<pre>'; print_r($data);die;
							
								$this->load->view('user/combinedview',$data);
						}
								
								
					}
					/*else
							
								$users = $this->user_model->testing();
								//print_r('sakshi');die;
								$data['testingTable'] = $users['testing'];
								$data['filterViewData'] = $users['user_view_preferences'];
								$data['views'] = $views;
								$tbheader = array_flip($users['user_view_preferences']['selected_columns']);
								$data['tbheader'] = $tbheader;
								//echo '<pre>'; print_r($data['tbheader']);die();
								$data['postData'] = $users['user_view_preferences']['selected_columns'];
								//echo '<pre>'; print_r($data['postData']);die();
								//echo '<pre>'; print_r($data);die();
								$this->load->view('user/combinedview',$data);
							
						}
							
							/*else //When Nothing no input is given by the user OR freshly loaded page
						{
							//for view
							$data['user'] = $this->user_model->gettestingdata();
							$data['view'] = $this->user_model->getviewname();
							//echo '<pre>'; print_r($data);die;

							//for filter data
							//$data['user'] = $this->user_model->gettestingdata();// No filter criteria provided, load full data
							$keys = array_keys($data['user'][0]);
    						$data['selectedHeader'] = $keys;
							$data['xyz'] = 's';
							//echo '<pre>'; print_r($data);die;
							$this->load->view('user/combinedview',$data);
						}
						}

						

							/*{
            					$data = $this->input->post();
           						print_r($data); // Check if $data contains expected data
            					$result = $this->getSelectedUserData1($data);
            					return $result;
        					}
							
							
								/*	public function filter() 
								{      
									$data['user'] = $this->user_model->gettestingdata();
									//if($data){
									//echo '<pre>'; print_r($data);die;
									$keys = array_keys($data['user'][0]);
									$data['selectedHeader'] = $keys;
									//echo '<pre>'; print_r($data);die;
									$this->load->view('user/filteredview',$data);
								}
								public function filter1() {
									
									$selectedField = $this->input->post('tableHeader'); // Field selected by the user
									$selectedOperator = $this->input->post('textOperator'); // Operator selected by the user
									$enteredValue = $this->input->post('userInput'); // Value entered by the user
									//print_r($selectedField);print_r($selectedOperator);print_r($enteredValue);die;
									// Call the model function to filter the data
									$filteredData = $this->user_model->filterData($selectedField, $selectedOperator, $enteredValue);
									$fdata['filteredData'] = $filteredData;
									$keys = array_keys($fdata['filteredData'][0]);
									$fdata['selectedHeader'] = $keys;
									//echo '<pre>'; print_r($fdata);
									$this->load->view('user/filteredview',$fdata);
								}
								


								public function testing2() 
						{
							$data = $this->input->post();
							//$result = $this->getSelectedUserData1($data);
							$result = $this->user_model->testing2($data);
							$views = $this->user_model->getviewname();
							//echo '<pre>'; print_r($users);die();
							if($result)
							{
								//echo '<pre>'; print_r($result);die();
								$data['testingTable'] = $result['testing'];
								$data['filterViewData'] = $result['user_view_preferences'];
								$data['views'] = $views;
								//echo '<pre>'; print_r($data['views']);die();
								$data['postData'] = $result['user_view_preferences']['selected_columns'];
								echo '<pre>'; print_r($data);die();
								$this->load->view('user/loadview',$data);
							}

							else{
							$data['user'] = $this->user_model->gettestingdata();
							$data['view'] = $this->user_model->getviewname();
							$this->load->view('user/loadview',$data);
							}
							
						}
							public function testing() 
						{      
							$users = $this->user_model->testing();
							$views = $this->user_model->getviewname();
							$data['testingTable'] = $users['testing'];
							$data['filterViewData'] = $users['user_view_preferences'];
							$data['postData'] = $users['user_view_preferences']['selected_columns'];
							$data['views'] = $views;
							$this->load->view('user/loadview.php',$data);
						}	
								
								*/
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
						


}


