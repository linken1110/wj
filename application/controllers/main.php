<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	* 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		$this->need_login = true;
        	parent::__construct();
		$this->load->model('survey_model');
		$this->load->model('answer_model');
		$this->load->model('question_model');
		$this->load->model('question_option_model');
		$this->load->model('home_info_model');
        }
	public function create(){
		$data= array();
		$data['user'] = $this->user_info;
                $this->load->view('createindex',$data);
	}
	public function create_new(){
		$data= array();
                $user = $this->user_info;
                $id = $this->survey_model->insert(array('name'=>'问卷标题','project_id'=>$user['project'],'uid'=>$user['uid'],'create_date'=>date('Y-m-d H:i:s',time())));
		redirect('/main/survey_detail?id='.$id, 'refresh');
		return;
	}
	public function survey_detail(){
		$id = $this->input->get_post('id');
                $data = $this->get_detail($id);
		$data['user'] = $this->user_info;
		$this->load->view('mywj',$data);
	}
	public function update_survey(){
		$id = $this->input->get_post('id');
		$name = $this->input->get_post('name');
		$description = $this->input->get_post('description');
		$this->survey_model->update($id,array('name'=>$name,'description'=>$description));
		$data['result'] = 1;
		echo json_encode($data);
	}
	public function get_detail($survey_id){
		$survey = $this->survey_model->get_by_id($survey_id);
		$survey['question_list'] =  $this->get_question_list($survey_id);
		$survey['list'] =  $this->get_list($survey_id);
		$pages = $this->question_model->get_pages_by_survey($survey_id);
		$number = $this->question_model->get_max_number($survey_id);
		$survey['number'] = (isset ($number['number']))?$number['number']:0;
		$survey['pages'] = ($pages['num'] <1) ? 1:$pages['num'];
		return $survey;
	}
	private function get_question_list($survey_id){
                        $result = array();
                        $question_list = $this->question_model->get_by_survey($survey_id);
                        if(!empty ($question_list)){
                                foreach ($question_list as $question){
					$page_index = $question['page_index'];
                                        if($question['type'] == 2 || $question['type'] == 3){
                                                $question['option_list'] = $this->question_option_model->get_by_questionid($question['id']);
                                        }else{
                                                $question['option_list'] = array();
                                        }
                                        $result[$page_index][] = $question;
                                }
                        }
                        return $result; 
        } 
	private function get_question_list_detail($survey_id,$home_id){
                        $result = array();
                        $question_list = $this->question_model->get_by_survey($survey_id);
                        if(!empty ($question_list)){
                                foreach ($question_list as $question){
					$page_index = $question['page_index'];
					$tmp = $this->answer_model->get_by_condition(array('survey_No'=>$home_id,'number'=>$question['number']));
					if(!empty($tmp)){
						$question['answer'] = $tmp[0]['result'];
					}else{
						$question['answer'] = 0;
					}
                                        if($question['type'] == 2 || $question['type'] == 3){
                                                $question['option_list'] = $this->question_option_model->get_by_questionid($question['id']);
                                        }else{
                                                $question['option_list'] = array();
                                        }
                                        $result[$page_index][] = $question;
                                }
                        }
                        return $result;
        }
	public function copy_survey(){
		$survey_id = $this->input->get_post('survey_id');
		$survey = $this->survey_model->get_by_id($survey_id);
		unset($survey['id']); 
		unset($survey['create_date']);
		$user = $this->user_info;
		$survey['uid'] = $user['uid'];
		$new_id = $this->survey_model->insert($survey);
		$questions= $this->get_list($survey_id);
		if(!empty($questions)){
			foreach($questions as $question){
				unset($question['id']);
				$new_question = $question;
				unset($question['option_list']);
				$question['survey_id'] = $new_id;
				$question_id = $this->question_model->insert($question);
				if(!empty($new_question['option_list'])){
					foreach($new_question['option_list'] as $option){
						unset($option['id']);
						$option['question_id'] = $question_id;
						$this->question_option_model->insert($option);
					}
				}
			}
		}
	}
	public function get_new_list(){
		$id = $this->input->get_post('id');
		$survey['list'] =  $this->get_list($id);
		echo json_encode($survey);
	} 
	private function get_list($survey_id){
                        $result = array();
                        $question_list = $this->question_model->get_by_survey($survey_id);
                        if(!empty ($question_list)){
                                foreach ($question_list as $question){
                                        $page_index = $question['page_index'];
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
	public function demo1(){
                $data= array();
		$data['user'] = $this->user_info;
                $this->load->view('demo1',$data);
        }
	public function index(){
                $data= array();
                $data['user'] = $this->user_info;
		if($data['user']['uid'] ==1){
			$list = $this->survey_model->get_all();
		}else{
			$list = $this->survey_model->get_by_pid($data['user']['project']);	
		}
		$survey_list = array();
		if(!empty($list)){
			foreach($list as $tmp){
				$total = $this->home_info_model->get_home_num_by_sid($tmp['id']);
				$tmp['all'] = $total['num'];
				$survey_list[] = $tmp;
			}
		}
		$data['survey_list'] = $survey_list;

                $this->load->view('list',$data);
        }
	public function indexGrid(){
                $data= array();
                $data['user'] = $this->user_info;
		$list = $this->survey_model->get_by_uid($data['user']['uid']);
                $survey_list = array();
                if(!empty($list)){
                        foreach($list as $tmp){
                                $total = $this->home_info_model->get_home_num_by_sid($tmp['id']);
                                $tmp['all'] = $total['num'];
                                $survey_list[] = $tmp;
                        }
                }
                $data['survey_list'] = $survey_list;

                $this->load->view('index',$data);
        }
	public function delete_survey(){
		$survey_id = $this->input->get_post('survey_id');
		$data= array();
		$data['result'] = $this->survey_model->delete_by_id($survey_id);
		echo json_encode($data);
	}
	public function update_status(){
		$survey_id = $this->input->get_post('survey_id');
		$survey = $this->survey_model->get_by_id($survey_id);
		$status = ($survey['status']==1)?0:1;
		$data = array();
		$data['result'] = $this->survey_model->update($survey_id,array('status'=>$status));
		$data['status'] = $status;
                echo json_encode($data);
	}
	public function update_audio(){
                $survey_id = $this->input->get_post('survey_id');
                $survey = $this->survey_model->get_by_id($survey_id);
                $status = ($survey['is_audio_open']==1)?0:1;
                $data = array();
                $data['result'] = $this->survey_model->update($survey_id,array('is_audio_open'=>$status));
                $data['status'] = $status;
                echo json_encode($data);
        }

	public function map(){
                $survey_id = $this->input->get_post('id');
                $data['user'] = $this->user_info;
		$home_list = $this->home_info_model->get_by_sid($survey_id);
		$data['list'] = $home_list;
                $data['id'] = $survey_id;
                $this->load->view('map_main',$data);
        }
	public function result_page(){
                $home_id = $this->input->get_post('id');
                $survey_id = $this->input->get_post('survey_id');
                $survey = $this->survey_model->get_by_id($survey_id);
		$question_list = $this->get_question_list_detail($survey_id,$home_id);
                $survey['question_list'] =  $question_list;
                $survey['list'] =  $this->get_list($survey_id);
                $pages = $this->question_model->get_pages_by_survey($survey_id);
                $number = $this->question_model->get_max_number($survey_id);
                $survey['number'] = (isset ($number['number']))?$number['number']:0;
                $survey['pages'] = ($pages['num'] <1) ? 1:$pages['num'];
		$survey['user'] = $this->user_info;
		$home_info = $this->home_info_model->get($home_id);
		$answers = $this->answer_model->get_by_condition(array('survey_No'=>$home_id));
		$survey['answers'] = $answers;
		$pictures = array();
		if(!empty ($home_info)){
			if(!empty($home_info['picture'])){
				$pics = explode(';',$home_info['picture']);
                               		foreach($pics as $tmp){
						if(!empty($tmp)){
							$pictures[] = $tmp;
						}
					}
			}
		}
		$survey['home_info'] = $home_info;
		$survey['pictures'] = $pictures;
                $this->load->view('result_page',$survey);
        }
	public function get_answers(){
		$home_id = $this->input->get_post('home_id');
		$answers = $this->answer_model->get_by_condition(array('survey_No'=>$home_id));
		echo json_encode($answers);
	}
	public function get_page(){
		$home_id = $this->input->get_post('home_id');
                $survey_id = $this->input->get_post('survey_id');
		$type = $this->input->get_post('type');
		if($type ==1){
			$home_info = $this->home_info_model->get_front_page($home_id,$survey_id);
		}else{
			$home_info = $this->home_info_model->get_next_page($home_id,$survey_id);
		}
		if(empty($home_info)){
			$data['id'] = 0;
		}else{
			$data['id'] = $home_info['id'];
		}
		$data['result'] = 1;
                echo json_encode($data);
	}
	public function add_result(){
		$survey_id = $this->input->get_post('survey_id');
                $survey = $this->survey_model->get_by_id($survey_id);
                $question_list = $this->get_question_list($survey_id);
                $survey['question_list'] =  $question_list;
                $survey['list'] =  $this->get_list($survey_id);
                $pages = $this->question_model->get_pages_by_survey($survey_id);
                $number = $this->question_model->get_max_number($survey_id);
                $survey['number'] = (isset ($number['number']))?$number['number']:0;
                $survey['pages'] = ($pages['num'] <1) ? 1:$pages['num'];
                $survey['user'] = $this->user_info;
		$this->load->view('add_result',$survey);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
