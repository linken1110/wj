<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Question extends MY_Controller {
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
		$this->load->model('project_model');
		$this->load->model('survey_question_model');
		$this->load->model('question_model');
		$this->load->model('question_option_model');
        }
	public function quest_list(){
		$id = $this->input->get_post('id');
                $category_id = $this->input->get_post('category_id');
		$this->get_quest_list($id,$category_id);
	}
	public function get_quest_list($id,$category_id){
		$list  = $this->survey_question_model->get_by_condition(array('survey_id'=>$id,'category_id'=>$category_id));
		$result = array();
		if(!empty($list)){
			foreach($list as $tmp){
				$question = $this->get_question($tmp['question_id']);
				$result[] = $question;
			}
		}
		$data['id'] = $id;
		$data['category_id'] = $category_id;
		$data['category'] = $this->category_model->get_by_id($category_id);
		$data['list'] = $result;
		$data['user'] = $this->user_info;
		$status = 0;
		if($category_id == 4){
			$question = $this->survey_trip_question_model->get_by_id($id,1);
			if(!empty ($question)){
				$status = $question['status'];
			}
			$data['status'] = $status;
			$data['options1'] = $this->trip_question_option_model->get_by_type($id,1);
                        $data['options2'] = $this->trip_question_option_model->get_by_type($id,2);
                        $data['options3'] = $this->trip_question_option_model->get_by_type($id,3);
			$subtrain_list = array();
			$subtrains =  $this->subtrain_model->get_by_pid($id);
			if(!empty($subtrains)){
				foreach($subtrains as $train){
					$subtrain = $this->subtrain_detail_model->get_by_subtrain_id($train['id']);
					
					$tmp['name'] = $train['name'];
					$tmp['list'] = $subtrain;
					$tmp['id'] = $train['id'];
					$subtrain_list[] = $tmp;
				}
			}
                	$data['subtrain_list'] = $subtrain_list;
			$this->load->view('trip_quest_list',$data);
		}else{
			$this->load->view('quest_list',$data);
		}
	}
	public function delete_question(){
		$id = $this->input->get_post('id');
		$pid = $this->input->get_post('pid');
		$this->question_model->delete_by_id($id);
		$this->survey_question_model->delete_by_question_id($id);
                $category_id = $this->input->get_post('category_id');
                $this->get_quest_list($pid,$category_id);	
	}
	public function delete_question_ajax(){
		$id = $this->input->get_post('id');
		$question = $this->question_model->get_by_id($id);
		$this->question_model->update_by_delete($question['number'],$question['survey_id'],1);
                $data['result'] = $this->question_model->delete_by_id($id);
		$count_number = $this->question_model->get_page_count($question['page_index'],$question['survey_id']);
		$count = $count_number['count'];
		if($count == 0){
			$this->question_model->update_by_delete_page($question['page_index'],$question['survey_id']);
		}
		$data['count'] =  $count;
		$data['id'] =  $id ;
		echo json_encode($data);
	}
	public function delete_page_ajax(){
		$page = $this->input->get_post('page');
		$survey_id = $this->input->get_post('survey_id');
		$count_number = $this->question_model->get_page_count($page,$survey_id);
		$count = $count_number['count'];
		if($count > 0){
			$this->question_model->update_by_delete($count['number'],$survey_id,$count);
		}
		$data['result'] = $this->question_model->update_by_delete_page($page,$survey_id);
                echo json_encode($data);
	}
	public function update_return_id(){
		$id = $this->input->get_post('id');
		$option_list = $this->input->get_post('option_list');
		$is_skip = 0;
		$options = explode(';',$option_list);
		if(!empty($options)){
                                        foreach($options as $tmp){
                                                if(!empty($tmp)){
                                                        $str = explode(':',$tmp);
                                                        $num = $str[0];
                                                        $content = $str[1];
							if($content != 0 && $content != -1){
								$is_skip = 1;
							}
							$this->question_option_model->update_by_question($num,$id,array('return_id'=>$content));
                                                }
                                        }
                                }
		$data['result'] =1;
		$this->question_model->update($id,array('is_skip'=>$is_skip));
		echo json_encode($data);
	}
	public function get_question_detail(){
		$id = $this->input->get_post('id');
		$data = $this->get_question($id);
		echo json_encode($data);
	}
	private function get_question($question_id){
                        $data = array();
                        $question = $this->question_model->get_by_id($question_id);
                        if(!empty ($question)){
                                $question['option_list'] = $this->question_option_model->get_by_questionid($question_id);
                        }
                        return $question;
                }
	private function get_subquestion($question_id){
                        $result = array();
                        $data = $this->question_model->get_by_parentid($question_id);
                        if(!empty($data)){
                                foreach($data as $tmp){
                                $question = $this->get_question($tmp['id']);

				}
                        }
                        return $result;
       }
	public function edit_question(){
		$id = $this->input->get_post('id');
		$pid = $this->input->get_post('pid');
		$question = $this->get_question($id);
		$data['user'] = $this->user_info;
		$data['question'] = $question;
		$data['pid'] = $pid;
		if($question['is_parent'] == 0){
			$this->load->view('edit_question',$data);
		}else{
			$this->load->view('sub_quest_list',$data);
		}
	}
	public function add_question(){
		$id = $this->input->get_post('id');
                $category_id = $this->input->get_post('category_id');
		$data['user'] = $this->user_info;
                $data['category'] = $this->category_model->get_by_id($category_id);
		$data['project'] = $this->project_model->get_by_id($id);
		$this->load->view('add_quest',$data);
	}
	public function update_ajax(){
		$id = $this->input->get_post('id');
                $question = $this->input->get_post('question');
                $type = $this->input->get_post('type');
                $options = $this->input->get_post('option_list');
                $default = $this->input->get_post('default');
		$required = $this->input->get_post('required');
		$count = $this->input->get_post('count');
		$is_nessary = $required?1:0;
                $option_str ="";
                if($type == 2 || $type == 3){
                        $option_list = $this->question_option_model->get_by_questionid($id);
                        if(!empty ($option_list)){
                                foreach($option_list as $option){
                                        $option_str = $option_str.$option['number'].":".$option['content'].";";
                                }
                        }
                        if($options !== $option_str){
                                $this->question_option_model->delete_by_questionid($id);
                                $this->add_option_list($options,$id);
                        }
                }
                $result = $this->question_model->update($id,array('type'=>$type,'question'=>$question,'default_value' =>$default,'is_nessary'=>$is_nessary,'count'=>$count));
		$data['result'] = 1;
		$data['question'] = $this->get_question($id);
		echo json_encode($data);
	}
	public function update(){
		$id = $this->input->get_post('id');
		$pid = $this->input->get_post('pid');
		$question = $this->input->get_post('question');
		$type = $this->input->get_post('type');
		$options = $this->input->get_post('option_list');
		$default = $this->input->get_post('default');
		$option_str ="";
		if($type == 2 || $type == 3){
			$option_list = $this->question_option_model->get_by_questionid($id);
			if(!empty ($option_list)){
				foreach($option_list as $option){
					$option_str = $option_str.$option['number'].":".$option['content'].";";
				}
			}
			if($options !== $option_str){
				$this->question_option_model->delete_by_questionid($id);
				$this->add_option_list($options,$id);
			}
		}
		$this->question_model->update($id,array('type'=>$type,'question'=>$question,'default_value' =>$default));
		$question = $this->get_question($id);
		$category_id = $question['category_id'];
                $list  = $this->survey_question_model->get_by_condition(array('survey_id'=>$pid,'category_id'=>$category_id));
                $result = array();
                if(!empty($list)){
                        foreach($list as $tmp){
                                $question = $this->question_model->get_by_id($tmp['question_id']);
                                $result[] = $question;
                        }
                }
                $data['id'] = $pid;
                $data['category'] = $this->category_model->get_by_id($category_id);
                $data['list'] = $result;
                $data['user'] = $this->user_info;
                $this->load->view('quest_list',$data);	
	}
	private function add_option_list($options,$question_id){
		if(!empty($options)){
                                $arr = explode(';',$options);
                                if(!empty($arr)){
                                        foreach($arr as $tmp){
                                                if(!empty($tmp)){
                                                        $str = explode(':',$tmp);
                                                        $num = $str[0];
                                                        $content = $str[1];
                                                        $this->question_option_model->insert(array('number'=>$num,'question_id'=>$question_id,'content' =>$content));
                                                }
                                        }
                                }
               	}
	}
	public function add(){
		$id = $this->input->get_post('pid');
		$type = $this->input->get_post('type');
		$category_id = $this->input->get_post('category_id');
		$question = $this->input->get_post('question');
		$options = $this->input->get_post('option_list');
		$default = $this->input->get_post('default_value');		
		$question_id = $this->question_model->insert(array('type'=>$type,'category_id'=>$category_id,'question'=>$question,'default_value'=>$default));
		if($type == 2 || $type == 3){
			$this->add_option_list($options,$question_id);
		}
		$num = $this->survey_question_model->get_max_number($id);
		if(empty($num)){
			$number = 1;
		}else{
			$number = $num['number'] + 1;
		}
		$this->survey_question_model->insert(array('survey_id'=>$id,'category_id'=>$category_id,'question_id'=>$question_id,'number'=>$number));
		$list  = $this->survey_question_model->get_by_condition(array('survey_id'=>$id,'category_id'=>$category_id));
                $result = array();
                if(!empty($list)){
                        foreach($list as $tmp){
                                $question = $this->question_model->get_by_id($tmp['question_id']);
                                $result[] = $question;
                        }
                }
                $data['id'] = $id;
                $data['category'] = $this->category_model->get_by_id($category_id);
                $data['list'] = $result;
                $data['user'] = $this->user_info;
                $this->load->view('quest_list',$data);
	}
	public function add_ajax(){
		$id = $this->input->get_post('survey_id');
                $type = $this->input->get_post('type');
                $page = $this->input->get_post('page');
                $question = $this->input->get_post('question');
                $options = $this->input->get_post('option_list');
                $default = $this->input->get_post('default_value');
		$count = $this->input->get_post('count');
		$time = date("Y-m-d H:i:s", time());
		$num = $this->question_model->get_max_number($id);
                if(empty($num)){
                        $number = 1;
                }else{
                        $number = $num['number'] + 1;
                }
                $question_id = $this->question_model->insert(array('survey_id'=>$id,'number'=>$number,'type'=>$type,'page_index'=>$page,'question'=>$question,'default_value'=>$default,'update_date'=>$time,'count'=>$count));
                if($type == 2 || $type == 3){
                        $this->add_option_list($options,$question_id);
                }
		$data['result']= 1;
		$data['id'] = $question_id;
		echo json_encode($data);
	}
	public function resort(){
		$pid = $this->input->get_post('pid');
                $category_id = $this->input->get_post('category_id');
		$question_list = $this->input->get_post('question_list');
		$my_list = "";
		$list  = $this->survey_question_model->get_by_condition(array('survey_id'=>$pid,'category_id'=>$category_id));
                if(!empty($list)){
                        foreach($list as $tmp){
				$my_list = $my_list.$tmp['question_id'].";";
                        }
                }
		if($question_list != $my_list){
			$arr = explode(';',$question_list);
                        if(!empty($arr)){
				$index = 0;
                        	foreach($arr as $tmp){
					if(!empty($tmp)){
						if($tmp != $list[$index]['question_id']){
							$this->survey_question_model->update($tmp,array('number'=>$list[$index]['number']));
						}
						$index ++;
					}
					
				}
			}
		}
		$data['result'] = 1;
                echo json_encode($data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
