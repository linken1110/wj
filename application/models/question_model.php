<?php 
class Question_model extends CI_Model{
	private $tab_name ='question';
	public function __construct(){
		$this->load->database('master');
	}
	public function insert($array){
		$this->db->insert($this->tab_name,$array);

		return $this->db->insert_id();

	}
	public function get_max_number($id){
                $this->db->select('number');
                $this->db->where('survey_id',$id);
                $this->db->order_by('number','desc');
                $this->db->limit(1);
                $query = $this->db->get($this->tab_name);
                return $query->row_array();
        }
	public function update($id,$array){
		$this->db->where('id',$id);
		$this->db->update($this->tab_name,$array);
		if($this->db->affected_rows() >0 ){
			return true;
		}
		return false;
	}
	public function update_by_delete($number,$survey_id,$count){
		$query =  $this->db->query("update question set number = number - $count where survey_id = $survey_id and number > $number");
		if($this->db->affected_rows() >0 ){
                        return true;
                }
                return false;
	}
	public function update_by_delete_page($page,$survey_id){
		$query =  $this->db->query("update question set page_index = page_index - 1 where survey_id = $survey_id and page_index > $page");
                if($this->db->affected_rows() >0 ){
                        return true;
                }
                return false;
	}
	public function get_by_survey($survey_id){
		$this->db->where('survey_id',$survey_id);
		$this->db->order_by('number','asc');
                $query = $this->db->get($this->tab_name);
                return $query->result_array();
	}
	public function get_pages_by_survey($survey_id){
		$query =  $this->db->query('select count(distinct page_index) as num from question where survey_id ='.$survey_id);
		return $query->row_array();
	}
	public function get_page_count($page,$survey_id){
		$query =  $this->db->query("select count(*) as count,max(number) as number from question where survey_id = $survey_id and page_index = $page");
		return $query->row_array();
	}
	public function get_by_id($id){
		$this->db->where('id',$id);
		$query = $this->db->get($this->tab_name);
		return $query->row_array();
	}
	public function get_by_parentid($id){
		$this->db->where('parent_id',$id);
                $query = $this->db->get($this->tab_name);
                return $query->result_array();
	}
	public function get_by_name($name){
		$this->db->where('name',$name);
		$query = $this->db->get($this->tab_name);
		return $query->row_array();
	}
	public function get_by_publisher($publisher){
		$this->db->where('publisher',$publisher);
		$query = $this->db->get($this->tab_name);
		return $query->row_array();
	}

	public function delete_by_id($id){
                $this->db->where('id',$id);
                $this->db->delete($this->tab_name);
		if($this->db->affected_rows() >0 ){
                        return true;
                }
                return false;
        }
	public function delete_by_page($page,$survey_id){
                $this->db->where('survey_id',$survey_id);
		$this->db->where('page_index',$page);
                $this->db->delete($this->tab_name);
                if($this->db->affected_rows() >0 ){
                        return true;
                }
                return false;
        }
}

?>
