
                                                   //CONTROLLER


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
							





						//model



						public function getSelectedUserData() 
        {
                    $formData = $this->input->post();
                    $viewName = $formData['view_name'];
                    unset($formData['view_name']);          
                    $userPreferences = $this->db->get_where('user_view_preferences', ['view_name' => $viewName])->row_array();
                    //print_r($userPreferences);
                    if(isset($userPreferences)){
                        if($formData)
                {
                    $showColumns = implode(",",array_keys($formData));
                    $this->db->where('view_name',$viewName);
                    $this->db->update('user_view_preferences',['selected_columns' => $showColumns]);
                }
                $finalhideshow = $this->db->get_where('user_view_preferences', ['view_name' => $viewName])->row_array();
                $this->db->select($finalhideshow['selected_columns']);
                $result = $this->db->get('testing')->result_array();
                $finalhideshow['selected_columns'] = explode(",",$finalhideshow['selected_columns']);
                return ['testing'=>$result,'user_view_preferences'=>$finalhideshow];
            }
            else
            {
                    if($formData)
                {
                    $selectedColumns = array();
                    foreach ($formData as $fieldName => $fieldValue) {
                    if ($fieldValue === 'on') {
                        $selectedColumns[] = $fieldName;
                    }
                    }   
            
                    // Convert the array of selected columns to a comma-separated string
                    $showColumns = implode(",", $selectedColumns);
                
                    $data = array(
                    'view_name' => $viewName,
                    'selected_columns' => $showColumns
                    );
                
                    $this->db->insert('user_view_preferences', $data);
                }
                $finalhideshow = $this->db->get_where('user_view_preferences', ['view_name' => $viewName])->row_array();
                $this->db->select($finalhideshow['selected_columns']);
                $result = $this->db->get('testing')->result_array();
                return ['testing'=>$result,'user_view_preferences'=>$finalhideshow];
            }
        }

        public function getSelectedUserData1($data)
        {
            //print_r($data);die;
            if (empty($data)) {
                return null; // or any other desired behavior when $data is empty
            }
            else{
                    $formData = $data;
                    //print_r($formData);die;
                   $viewName = $formData['view_name'];
                    //print_r($viewName);die;
                    unset($formData['view_name']);
                    //print_r($viewName);print_r($formData);die;         
                    $userPreferences = $this->db->get_where('user_view_preferences', ['view_name' => $viewName])->row_array();
                    //print_r($userPreferences);
                    if(isset($userPreferences)){
                        if($formData)
                {
                    $showColumns = implode(",",array_keys($formData));
                    $this->db->where('view_name',$viewName);
                    $this->db->update('user_view_preferences',['selected_columns' => $showColumns]);
                }
                $finalhideshow = $this->db->get_where('user_view_preferences', ['view_name' => $viewName])->row_array();
                $this->db->select($finalhideshow['selected_columns']);
                $result = $this->db->get('testing')->result_array();
                $finalhideshow['selected_columns'] = explode(",",$finalhideshow['selected_columns']);
                $finalhideshow['selected_columns'] = array_flip($finalhideshow['selected_columns']);
                //echo '<pre>'; print_r($result);
                //echo '<pre>'; print_r($finalhideshow);die;
                return ['testing'=>$result,'user_view_preferences'=>$finalhideshow];
            }
            else
            {
                    if($formData)
                {
                    //print_r($formData);die;
                    $selectedColumns = array();
                    foreach ($formData as $fieldName => $fieldValue) {
                    if ($fieldValue === 'on') {
                        $selectedColumns[] = $fieldName;
                    }
                    }   
            
                    // Convert the array of selected columns to a comma-separated string
                    $showColumns = implode(",", $selectedColumns);
                
                    $data = array(
                    'view_name' => $viewName,
                    'selected_columns' => $showColumns
                    );
                
                    $this->db->insert('user_view_preferences', $data);
                }
                $finalhideshow = $this->db->get_where('user_view_preferences', ['view_name' => $viewName])->row_array();
                $this->db->select($finalhideshow['selected_columns']);
                $result = $this->db->get('testing')->result_array();
                $finalhideshow['selected_columns'] = explode(",",$finalhideshow['selected_columns']);
                $finalhideshow['selected_columns'] = array_flip($finalhideshow['selected_columns']);
                //$user_view_preferences['selected_columns'] = array_flip($user_view_preferences['selected_columns']);
                
                //echo '<pre>'; print_r($finalhideshow);
                //echo '<pre>'; print_r($result);die;
                return ['testing'=>$result,'user_view_preferences'=>$finalhideshow];
            }
        }
        }

        public function testing() 
        {
            $data = $this->input->post();
           // print_r($data); // Check if $data contains expected data
            $result = $this->getSelectedUserData1($data);
            //echo '<pre>'; print_r($result);die;
            return $result;
        }
        


                            public function getviewname() 
                        {                
                            $this->db->select('view_name');
                            $result = $this->db->get('user_view_preferences')->result_array();
                            return $viewNames = array_column($result, 'view_name');
                            
                        }


                        public function gettestingdata()
                        {
                            return $this->db->get('testing')->result_array();
                        }




                        public function filterData($selectedField, $selectedOperator, $enteredValue, $andor) {
                            //print_r($selectedField);print_r($selectedOperator);print_r($enteredValue);die;
                            
                            $filteredData = array();
                            $sql = "SELECT * FROM testing WHERE ";
                            
                            for ($i = 0; $i < count($selectedField); $i++) {
                                switch ($selectedOperator[$i]) {
                                    case 'contains':
                                        $sql .= $selectedField[$i] . " LIKE '%" . $enteredValue[$i] . "%'";
                                        break;
                                    case 'does not contain':
                                        $sql .= $selectedField[$i] . " NOT LIKE '%" . $enteredValue[$i] . "%'";
                                        break;
                                    case 'is':
                                        $sql .= $selectedField[$i] . " = '" . $enteredValue[$i] . "'";
                                        break;
                                    case 'is not':
                                        $sql .= $selectedField[$i] . " != '" . $enteredValue[$i] . "'";
                                        break;
                                    case 'is empty':
                                        $sql .= $selectedField[$i] . " = ''";
                                        break;
                                    case '>':
                                        $sql .= $selectedField[$i] . " > '" . $enteredValue[$i] . "'";
                                        break;
                                    case '>=':
                                        $sql .= $selectedField[$i] . " >= '" . $enteredValue[$i] . "'";
                                        break;
                                    case '<=':
                                        $sql .= $selectedField[$i] . " <= '" . $enteredValue[$i] . "'";
                                        break;
                                    case '<':
                                        $sql .= $selectedField[$i] . " < '" . $enteredValue[$i] . "'";
                                        break;
                                    case 'is not empty':
                                        $sql .= $selectedField[$i] . " != ''";
                                        break;
                                    default:
                                        // Handle other cases or errors as needed
                                        break;
                                        
                                }
                        
                                // If there are more conditions and an AND/OR condition is specified, add it
                                if ($i < count($selectedField) - 1 && isset($andor[$i])) {
                                    $sql .= " " . $andor[$i] . " ";
                                }
                            }
                            
                            $query = $this->db->query($sql); // Execute the query
                            //print_r($sql);die;
                        
                            // Check if the query was successful
                            if ($query) {
                                // Fetch the result data
                                $filteredData = $query->result_array();
                                //print_r($filteredData);die;
                            
                            }
                        
                            return $filteredData;
                        }
                        
                        

                    public function filterData1($selectedField, $selectedOperator, $enteredValue, $andor)
                    {
                        $filteredData = array();
                        $this->db->select('*');
                            for ($i = 0; $i < count($selectedField); $i++){
                                if($i == 0){
                                    $this->db->where($selectedField[$i].' '.$selectedOperator[$i],$enteredValue[$i]);
                                }
                                if($i > 0){
                                    if($andor[$i-1]=='or'){
                                        $this->db->or_where($selectedField[$i].' '.$selectedOperator[$i],$enteredValue[$i]);
                                    }
                                    else{
                                        $this->db->where($selectedField[$i].' '.$selectedOperator[$i],$enteredValue[$i]);
                                    }
                                    
                                }
                                $query = $this->db->get('testing');
                                if ($query) {
                                    $filteredData = $query->result_array();
                                }
                                return $filteredData;
                        }
                    }

                                public function combined() 
                            {
                               
                               
                            }

                    
                                public function testing2($data) {
                                    if (empty($data)) {
                                        //print_r('sakshi');die;
                                        return null; // or any other desired behavior when $data is empty
                                    }
                                    //print_r($data);die;
                                    $viewName = $data['view_name'];
                                    $userPreferences = $this->db->get_where('user_view_preferences', ['view_name' => $viewName])->row_array();
                                    unset($data['view_name']);
                                    $showColumns = implode(",",array_keys($data));
                                    //print_r($showColumns);die;
                                
                                    if ($userPreferences) {
                                        $this->db->where('view_name', $viewName);
                                        $this->db->update('user_view_preferences', ['selected_columns' => $showColumns]);
                                    } else {
                                        $data = [
                                            'view_name' => $viewName,
                                            'selected_columns' => $showColumns
                                        ];
                                        $this->db->insert('user_view_preferences', $data);
                                    }
                                
                                    $this->db->select($showColumns);
                                    $result = $this->db->get('testing')->result_array();
                                    //print_r($result);die;
                                
                                    return [
                                        'testing' => $result,
                                        'user_view_preferences' => explode(",", $showColumns),
                                    ];
                                }
                                
                            }						