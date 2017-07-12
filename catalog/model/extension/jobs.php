<?php
class ModelExtensionJobs extends Model {	
	public function getPosts($jobs_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "jobs n LEFT JOIN " . DB_PREFIX . "jobs_description nd ON n.jobs_id = nd.jobs_id WHERE n.jobs_id = '" . (int)$jobs_id . "' AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		return $query->row;
	}
 
	public function getAllPosts($data) {
		$sql = "SELECT * FROM " . DB_PREFIX . "jobs n LEFT JOIN " . DB_PREFIX . "jobs_description nd ON n.jobs_id = nd.jobs_id WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n.status = '1' ORDER BY date_added DESC";
		
		if (isset($data['start']) && isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}
			
			if ($data['limit'] < 1) {
				$data['limit'] = 10;
			}	
		
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}	
		
		$query = $this->db->query($sql);
		
		return $query->rows;
	}

	public function getModulePosts($data) {
		$sql = "SELECT * FROM " . DB_PREFIX . "jobs n LEFT JOIN " . DB_PREFIX . "jobs_description nd ON n.jobs_id = nd.jobs_id WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n.status = '1' AND n.module = '1' ORDER BY date_added DESC";
		
		if (isset($data['start']) && isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}
			
			if ($data['limit'] < 1) {
				$data['limit'] = 10;
			}	
		
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}	
		
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	
	public function getTotalPosts() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "jobs");
	
		return $query->row['total'];
	}
	
	public function getLatestJobs(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "jobs AS p JOIN " . DB_PREFIX . "jobs_description AS pd ON (p.jobs_id = pd.jobs_id) ORDER BY p.jobs_id DESC LIMIT 6");
		
		return $query->rows;
	}
}