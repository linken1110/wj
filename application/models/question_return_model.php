<?php 
class Question_return_model extends CI_Model{
	private $tab_name ='question_return';
	public function __construct(){
		$this->load->database('master');
	}
	public function insert($array){
		$this->db->insert($this->tab_name,$array);

		return $this->db->insert_id();

	}
	public function update($id,$array){
		$this->db->where('id',$id);
		$this->db->update($this->tab_name,$array);
		if($this->db->affected_rows() >0 ){
			return true;
		}
		return false;
	}
	public function get_by_questionid($question_id){
		$this->db->select('result,return_id,show_list');
		$this->db->where('question_id',$question_id);
		$query = $this->db->get($this->tab_name);
		return $query->result_array();
	}
	public function delete_by_questionid($question_id){
                $this->db->where('question_id',$question_id);
                $query = $this->db->delete($this->tab_name);
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


}

?>
