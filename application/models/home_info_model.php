<?php 
class Home_info_model extends CI_Model{
	private $tab_name ='home_info';
	public function __construct(){
		$this->load->database('master');
	}
	public function insert($array){
		$this->db->insert($this->tab_name,$array);

		return $this->db->insert_id();

	}
	public function get($id){
		$this->db->where('id',$id);
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
	public function get_by_sid($sid){
		$this->db->where('survey_id',$sid);
                $query = $this->db->get($this->tab_name);
                return $query->result_array();
	}
	public function get_by_uuid($uuid){
                $this->db->where('uuid',$uuid);
                $query = $this->db->get($this->tab_name);
                return $query->result_array();
        }
	public function get_latest_by_sid($sid){
                $this->db->where('survey_id',$sid);
		$this->db->order_by('create_date','desc');
                $query = $this->db->get($this->tab_name);
                return $query->result_array();
        }
	public function get_by_id($uid,$time){
		$this->db->where('user_id',$uid);
		$this->db->where('timestamp',$time);
		$query = $this->db->get($this->tab_name);
		return $query->row_array();
	}
	public function get_max_home_id($uid){
		$this->db->where('user_id',$uid);
		$this->db->order_by('home_id','desc');
		$this->db->limit(1);
		$query = $this->db->get($this->tab_name);
                return $query->row_array();
	}
	public function get_next_page($id,$survey_id){
		$this->db->select_min('id');
		$this->db->where('survey_id',$survey_id);
		$this->db->where('id >',$id);
                $query = $this->db->get($this->tab_name);
                return $query->row_array();
	}
	public function get_front_page($id,$survey_id){
		$this->db->select_max('id');
                $this->db->where('survey_id',$survey_id);
                $this->db->where('id <',$id);
                $query = $this->db->get($this->tab_name);
                return $query->row_array();
	}
	public function get_home_num($uid){
		$this->db->select("count(*) as num");
		$this->db->where('user_id',$uid);
		$query = $this->db->get($this->tab_name);
                return $query->row_array();
	}
	public function get_home_num_by_sid($sid){
		$this->db->select("count(*) as num");
                $this->db->where('survey_id',$sid);
                $query = $this->db->get($this->tab_name);
                return $query->row_array();
	}
	public function get_checked_num_by_sid($sid){
		$this->db->select("count(*) as num");
                $this->db->where('survey_id',$sid);
		$this->db->where('status',1);
                $query = $this->db->get($this->tab_name);
                return $query->row_array();
	}
	public function get_unpassed_num_by_sid($sid){
                $this->db->select("count(*) as num");
                $this->db->where('survey_id',$sid);
                $this->db->where('status',2);
                $query = $this->db->get($this->tab_name);
                return $query->row_array();
        }
	public function get_unchecked_num_by_sid($sid){
                $this->db->select("count(*) as num");
                $this->db->where('survey_id',$sid);
                $this->db->where('status',0);
                $query = $this->db->get($this->tab_name);
                return $query->row_array();
        }
	public function get_today_num_by_sid($sid){
		$this->db->select("count(*) as num");
                $this->db->where('survey_id',$sid);
                $this->db->where('date(create_date)',date("Y-m-d"));
                $query = $this->db->get($this->tab_name);
                return $query->row_array();
	}
	public function get_by_condition($param){
                foreach($param as $key=>$val){
                        $this->db->where($key,$val);
                }
		$this->db->order_by('create_date','desc');
                $query = $this->db->get($this->tab_name);
                return $query->result_array();
        }
	public function delete_by_id($id){
                $this->db->where('id',$id);
                $this->db->delete($this->tab_name);
        }
	
}

?>
