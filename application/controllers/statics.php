<?php
require_once (APPPATH . 'PHPExcel/Classes/PHPExcel.php');	
require_once (APPPATH . 'PHPExcel/Classes/PHPExcel/IOFactory.php');
class Statics extends MY_Controller{
	public function __construct(){
			$this->need_login = true;
			parent::__construct();
            		$this->load->model('answer_model');
			$this->load->model('survey_model');
			$this->load->model('project_model');
			$this->load->model('account_model');
			$this->load->model('question_model');
			$this->load->model('question_option_model');
			$this->load->model('home_info_model');
			ini_set("memory_limit","-1");
	}
	public function question(){
		$user = $this->user_info;
                if($user['type'] != 1){
                        $this->question_result($user['project']);
                        return;
                }
                $data['user'] = $user;
                $data['list'] = $this->project_model->get_all();
                $this->load->view('statics_question_list',$data);
	}
	public function question_result($survey_id=0){
		if(empty($survey_id)){
		$survey_id = $this->input->get_post('survey_id');
		}
		$question_list = $this->get_question_list($survey_id);
		$result_list = array();
		if(!empty($question_list)){
			foreach($question_list as $question){
				if($question['type'] == 2){
				$total = $this->answer_model->get_by_condition(array('number'=>$question['id']));
				$totalnum = count($total);
				$options = $this->question_option_model->get_by_questionid($question['id']);
				$question['totalnum'] = $totalnum;
				if(!empty($options)){
					foreach($options as $option){
						$tmp['name'] = $option['content'];
						$total = $this->answer_model->get_by_condition(array('number'=>$question['id'],'result'=>$option['number']));
						$tmp['y'] = count($total);
						$question['result'][] = $tmp;
					}
				}
				$result_list[] = $question;
				}else if($question['type'] == 3){
					$total = $this->answer_model->get_by_condition(array('number'=>$question['id']));
					$options = $this->question_option_model->get_by_questionid($question['id']);
					$results = array();
					$totalnum = 0;
					foreach($options as $option){
						$tmp['name'] = $option['content'];
						$tmp['y'] = 0;
						$number = $option['number'];
						$results[$number] = $tmp;
					}
					if(!empty($total)){
						foreach($total as $answer){
							$arrs = explode(',',$answer['result']);
                                        		if(!empty($arrs)){
                                                		foreach($arrs as $arr){
                                                        		if(!empty($arr)){
										$results[$arr]['y']++;
										$totalnum ++;
									}
								}
                                                        }
						}
					}
					if(!empty($results)){
						foreach($results as $key=>$val){
							$question['result'][] = $val;
						}
					}
					$question['totalnum'] = $totalnum;
					$result_list[] = $question;
				}
			}
		}
		$data['user'] = $this->user_info;
		$data['list'] =$result_list;
		$this->load->view('statics_question',$data);
	}
	private function get_question_list($survey_id){
                        $result = array();
                        $question_list = $this->question_model->get_by_survey($survey_id);
                        if(!empty ($question_list)){
                                foreach ($question_list as $question){
                                        $tmp = $this->question_model->get_by_id($question['id']);
					if($tmp['type'] == 2 || $tmp['type'] == 3){
						$result[] = $tmp;
					}
                                }
                        }
                        return $result;
        }
	public function download_data(){
		$survey_id = $this->input->get_post('survey_id');
		$survey = $this->survey_model->get_by_id($survey_id);
		if(empty($survey)){
			return;
		}
		$excel = new PHPExcel();
                $objProps = $excel->getProperties ();
                $letter = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
				'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ',
				'BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ'
				);
                $question = array();
                $questions = $this->question_model->get_by_survey($survey_id);
		$num = 1;
                if(!empty($questions)){
                        foreach($questions as $tmp){
                                $question[] = $tmp['question'];
                                $num ++;
                        }
                }
		$tableheader = array_merge(array('上传顺序编号','项目编号','问卷编号','调查员编号','个人编号','调查日期','调查时间','质检状态'),$question);
		for($i = 0;$i < count($tableheader);$i++) {
			$excel->getActiveSheet()->setCellValue("$letter[$i]1","$tableheader[$i]");
                }	
		$i = 2;
		$home_list = $this->home_info_model->get_by_sid($survey_id);
                if(!empty($home_list)){
			foreach($home_list as $home_info){
				$excel->getActiveSheet()->setCellValue("$letter[0]$i",$home_info['identifier']);
                                $excel->getActiveSheet()->setCellValue("$letter[1]$i",substr($home_info['identifier'],0,3));
                                $excel->getActiveSheet()->setCellValue("$letter[2]$i",substr($home_info['identifier'],3,4));
                                $excel->getActiveSheet()->setCellValue("$letter[3]$i",substr($home_info['identifier'],7,4));
                                $excel->getActiveSheet()->setCellValue("$letter[4]$i",substr($home_info['identifier'],11,4));
				$time = strtotime($home_info['start_time']);
				$excel->getActiveSheet()->setCellValue("$letter[5]$i",date("Y-m-d",$time));
				$excel->getActiveSheet()->setCellValue("$letter[6]$i",date("H:i",$time));
				$status = 0;
				if($home_info['status'] == 0){
					$status = "未审核";
				}else if($home_info['status'] == 1){
                                        $status = "审核通过";
                                }else if($home_info['status'] == 2){
                                        $status = "审核不通过";
                                }
				$excel->getActiveSheet()->setCellValue("$letter[7]$i",$status);
				$j = 8;
				foreach($questions as $tmp){
                                	$answer = $this->answer_model->get_by_condition(array('number'=>$tmp['id'],'survey_No'=>$home_info['id']));
                                        if(!empty($answer)){
                                                                $myanswer = $answer[0];
                                                                if($myanswer['result'] == -1){$myanswer['result'] ="";}
                                                                $excel->getActiveSheet()->setCellValue("$letter[$j]$i",$myanswer['result']);
                                                        }
                                                        $j++;
                                        }
				$i++;
			}
                }
		$excel->getActiveSheet()->setTitle($survey['name']);
                $str = date("Y-m-d",time());
                $finalFileName= $survey['name'].$str.".xls";
                $write = new PHPExcel_Writer_Excel5($excel);

                        header("Pragma: public");
                        header("Expires: 0");
                        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
                        header("Content-Type:application/force-download");
                        header("Content-Type:application/vnd.ms-execl");
                header("Content-Type:application/octet-stream");
                header("Content-Type:application/download");;
                header("Content-Disposition:attachment;filename=\"$finalFileName\"");
                header("Content-Transfer-Encoding:binary");
                $write->save('php://output');
		
	}
}
?>
