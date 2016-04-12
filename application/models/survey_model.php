<?php 
class Survey_model extends CI_Model{
	private $tab_name ='survey';
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
	public function get_by_uid($uid){
		$this->db->where('uid',$uid);
                $query = $this->db->get($this->tab_name);
                return $query->result_array();
	}
	public function get_all(){
		$query = $this->db->get($this->tab_name);
                return $query->result_array();
	}
	public function get_by_pid($pid){
		$this->db->where('project_id',$pid);
                $query = $this->db->get($this->tab_name);
                return $query->result_array();
	}
	public function get_live_by_pid($pid){
                $this->db->where('project_id',$pid);
		$this->db->where('status',1);
                $query = $this->db->get($this->tab_name);
                return $query->result_array();
        }
	public function get_by_id($id){
		$this->db->where('id',$id);
		$query = $this->db->get($this->tab_name);
		return $query->row_array();
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

}

?>
