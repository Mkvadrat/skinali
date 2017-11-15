<?php
class ModelCatalogJobs extends Model {
	public function addPosts($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "jobs SET image = '" . $this->db->escape($data['image']) . "', full_image = '" . $this->db->escape($data['full_image']) . "',  date_added = NOW(), status = '" . (int)$data['status'] . "'");
		
		$jobs_id = $this->db->getLastId();
		
		foreach ($data['jobs'] as $key => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX ."jobs_description SET jobs_id = '" . (int)$jobs_id . "', language_id = '" . (int)$key . "', title = '" . $this->db->escape($value['title']) . "', model = '" . $this->db->escape($value['model']) . "'");
		}
		
		if (isset($data['jobs_image'])) {
			foreach ($data['jobs_image'] as $jobs_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "jobs_image SET jobs_id = '" . (int)$jobs_id . "', image = '" . $this->db->escape($jobs_image['image']) . "', sort_order = '" . (int)$jobs_image['sort_order'] . "'");
			}
		}
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'jobs_id=" . (int)$jobs_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
	}
	
	public function editPosts($jobs_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "jobs SET image = '" . $this->db->escape($data['image']) . "', full_image = '" . $this->db->escape($data['full_image']) . "', status = '" . (int)$data['status'] . "' WHERE jobs_id = '" . (int)$jobs_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "jobs_description WHERE jobs_id = '" . (int)$jobs_id. "'");
		
		foreach ($data['jobs'] as $key => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX ."jobs_description SET jobs_id = '" . (int)$jobs_id . "', language_id = '" . (int)$key . "', title = '" . $this->db->escape($value['title']) . "', model = '" . $this->db->escape($value['model']) . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "jobs_image WHERE jobs_id = '" . (int)$jobs_id . "'");

		if (isset($data['jobs_image'])) {
			foreach ($data['jobs_image'] as $jobs_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "jobs_image SET jobs_id = '" . (int)$jobs_id . "', image = '" . $this->db->escape($jobs_image['image']) . "', sort_order = '" . (int)$jobs_image['sort_order'] . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'jobs_id=" . (int)$jobs_id. "'");
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'jobs_id=" . (int)$jobs_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
	}
	
	public function getPosts($jobs_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'jobs_id=" . (int)$jobs_id . "') AS keyword FROM " . DB_PREFIX . "jobs WHERE jobs_id = '" . (int)$jobs_id . "'"); 
 
		if ($query->num_rows) {
			return $query->row;
		} else {
			return false;
		}
	}
   
	public function getPostsDescription($jobs_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "jobs_description WHERE jobs_id = '" . (int)$jobs_id . "'"); 
		
		foreach ($query->rows as $result) {
			$jobs_description[$result['language_id']] = array(
				'title'       			=> $result['title'],
				'model'		            => $result['model'],
			);
		}
		
		return $jobs_description;
	}
 
	public function getAllPosts($data) {
		$sql = "SELECT * FROM " . DB_PREFIX . "jobs n LEFT JOIN " . DB_PREFIX . "jobs_description nd ON n.jobs_id = nd.jobs_id WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY date_added DESC";
		
		if (isset($data['start']) && isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}
			
			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
		
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}	
		
		$query = $this->db->query($sql);
 
		return $query->rows;
	}
	
	public function getJobsImages($jobs_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "jobs_image WHERE jobs_id = '" . (int)$jobs_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}
   
	public function deletePosts($jobs_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "jobs WHERE jobs_id = '" . (int)$jobs_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "jobs_image WHERE jobs_id = '" . (int)$jobs_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "jobs_description WHERE jobs_id = '" . (int)$jobs_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'jobs_id=" . (int)$jobs_id. "'");
	}
   
	public function getTotalposts() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "jobs");
	
		return $query->row['total'];
	}

	public function setModule($jobs_id, $value){
		$this->db->query("UPDATE " . DB_PREFIX . "jobs SET module = '" . (int)$value . "' WHERE jobs_id = '" . (int)$jobs_id . "'"); 
	}
}