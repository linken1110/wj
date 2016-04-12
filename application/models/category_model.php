<?php 
class Category_model extends CI_Model{
	private $tab_name ='category';
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
	public function get_by_surveyid($survey_id){
		$this->db->where('survey_id',$survey_id);
		$query = $this->db->get($this->tab_name);
		return $query->result_array();
	}

}

?>
