<?php
	
class Survey extends MY_Controller{
		public function __construct(){
			parent::__construct();
            		$this->load->model('project_model');
			$this->load->model('question_model');
			$this->load->model('question_option_model');
			$this->load->model('question_return_model');
			$this->load->model('survey_model');
			$this->load->model('survey_question_model');
			$this->load->model('answer_model');
			$this->load->model('model_model');
			$this->load->model('home_info_model');
			$this->load->model('category_model');
			$this->load->model('account_model');

		}
		public function get_survey_list(){
			$data = array('code'=>1,'message'=>'ok');
                        $project_id = $this->input->get_post('project_id');
                        if(!$project_id) {
                                $data['code'] = 4001;
                                $data['message'] = 'error parameters';
                                echo json_encode($data);
                                return;
                        }
                        $survey_list = $this->survey_model->get_live_by_pid($project_id);
			$data['survey_list'] = $survey_list;
                        echo json_encode($data, JSON_UNESCAPED_UNICODE); 
		}
		public function get_survey_detail(){
			$data = array('code'=>1,'message'=>'ok');
			$survey_id = $this->input->get_post('survey_id');
			if(!$survey_id) {
				$data['code'] = 4001;
                                $data['message'] = 'error parameters';
                                echo json_encode($data);
                                return;
			}
			$question_list = $this->get_question_list($survey_id);
			$data['list'] = $question_list;
			echo json_encode($data, JSON_UNESCAPED_UNICODE); 
		}
		private function get_question_list($survey_id){
			$result = array();
			$question_list = $this->question_model->get_by_survey($survey_id);
                        if(!empty ($question_list)){
                                foreach ($question_list as $question){
					if($question['type'] == 2 || $question['type'] == 3){
						$question['option_list'] = $this->question_option_model->get_by_questionid($question['id']);
					}else{
						$question['option_list'] = array();
					}
                                        $result[] = $question;
                                }
                        }
			return $result;
		}
		public function move_data(){
			$survey = $this->input->get_post('survey');
			$uname = $this->input->get_post('uname');
			if (!file_exists("/home/data/$uname/$survey")){ 
				mkdir ("/home/data/$uname/$survey");
			}
				$home_list = $this->home_info_model->get_by_sid($survey);
				if(!empty($home_list)){
					foreach($home_list as $home_info){
						$dir = "/home/data/$uname/$survey/".$home_info['identifier'];
						if (!file_exists($dir)){
							mkdir ($dir);
						}
						$pics = explode(';',$home_info['picture']);
                                        	foreach($pics as $tmp){
                                                	if(!empty($tmp)){
								copy("/alidata/www/wj/upload/images/$tmp","$dir/$tmp");
                                                	}	
                                        	}
						$auto = $home_info['auto'];
						if(!empty($auto)){
							copy("/alidata/www/wj/upload/audio/$auto","$dir/$auto");
						}
					}
				}
		}
		public function upload_data(){
			$result=array('status'=>0,'message'=>'');
                	$json = $this->input->get_post('surver');
			$data = json_decode($json,true);
			$auto = $this->input->get_post('audio');
			$uuid = $this->input->get_post('uuid');
			$audio = "";
			if(!empty($data)){
				$home_info = $this->home_info_model->get_by_uuid($uuid,$data['createTime']);
				if(empty($home_info)){
					$survey = $this->survey_model->get_by_id($data['wid']);
					$account = $this->account_model->get_user_by_uid($data['userId']);
					$home_num = $this->home_info_model->get_home_num($data['userId']);
                                	$newId= sprintf('%03s', $survey['project_id']);
					$newSid = sprintf('%04s', $survey['id']);
                                	if(isset ($account['name'])){
                                        	$newUid= sprintf('%04s', $account['name']);
                                	}
                                	$newNum= sprintf('%04s', $home_num['num']+1 );
					$newNum = $newId.$newSid.$newUid.$newNum;
					if(isset($data['audio_path'])){
						$audio = $data['audio_path'];
						if(!empty($audio)){
						$base_path = "/alidata/www/wj/upload/audio/";
						$target_path = $base_path . basename ( $_FILES ['audio'] ['name'] );  
						if (move_uploaded_file ( $_FILES ['audio'] ['tmp_name'], $target_path )) {  
							$audio = basename ( $_FILES ['audio'] ['name'] );
						}  
						}
					}
					if(isset($data['pics'])){
						$pics = explode(',',$data['pics']);
						$str = '';
						if(!empty($pics)){
						$base_path = "/alidata/www/wj/upload/images/";
						foreach($pics as $picture){
							if(!empty($picture)){
							$target_path = $base_path . basename ( $picture );
							$key = basename ( $picture,'.jpg' );
							if (move_uploaded_file ( $_FILES[$key]['tmp_name'], $target_path )) { 
                                                                $str = $str .basename ( $picture ).";";
                                                        }   
							}
						}
						}
					}
					$survey_time = ceil(($data['endTime'] - $data['createTime'])/60000);
					if($survey_time < 0 ){
						$survey_time =1;
					}
					$home_id = $this->home_info_model->insert(array('address'=>$data['signin_address'],'lat'=>$data['signin_X'],'lng'=>$data['signin_Y'],'user_id'=>$data['userId'],'home_id'=>$data['id'],'survey_id'=>$data['wid'],'start_time'=>date('Y-m-d H:i:s',$data['createTime']/1000),'end_time'=>date('Y-m-d H:i:s',$data['endTime']/1000),'create_date'=>date('Y-m-d H:i:s',time()),'timestamp'=>$data['createTime'],'picture'=>$str,'auto'=>$audio,'identifier'=>$newNum,'survey_time'=>$survey_time));
                                	if(isset($data['question_and_answer'])){
                                        $arrs = explode('||',$data['question_and_answer']);
                                        if(!empty($arrs)){
                                                foreach($arrs as $arr){
                                                        $key_values = explode('::',$arr);
                                                        if(!empty($key_values)){
                                                                $question = $key_values[0];
								if(isset($key_values[1])){
                                                                	$answer = $key_values[1];
								}
								if(!empty( $question)){
                                                                	$this->answer_model->insert(array('survey_No'=>$home_id,'number'=>$question,'result'=>$answer,'result_id'=>$data['wid']));
								}
                                                        }
                                                }
                                        }
                                	}
					$result['status'] = 1;
                                	$result['message'] = "ok";
				}else{
                                	$result['status'] = 4002;
                                	$result['message'] = "data has exists";
                       	 	}
				
			}else{
                        	$result['status'] = 4001;
                        	$result['message'] = "invalid data";
                	}
			echo json_encode($result);
		}
		private function get_file_name($path){
			if(!empty($path)){
				
			}
		}
}
?>
