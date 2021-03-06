<?php
class ModelExtensionOurprojects extends Model {	
	public function getPosts($posts_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "posts n LEFT JOIN " . DB_PREFIX . "posts_description nd ON n.posts_id = nd.posts_id WHERE n.posts_id = '" . (int)$posts_id . "' AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		return $query->row;
	}
 
	public function getAllPosts($data) {
		$sql = "SELECT * FROM " . DB_PREFIX . "posts n LEFT JOIN " . DB_PREFIX . "posts_description nd ON n.posts_id = nd.posts_id WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n.status = '1' ORDER BY date_added DESC";
		
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
		$sql = "SELECT * FROM " . DB_PREFIX . "posts n LEFT JOIN " . DB_PREFIX . "posts_description nd ON n.posts_id = nd.posts_id WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n.status = '1' AND n.module = '1' ORDER BY date_added DESC";
		
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
	
	public function getPostsImages($posts_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "posts_image WHERE posts_id = '" . (int)$posts_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}
	
	public function getTotalPosts() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "posts");
	
		return $query->row['total'];
	}
	
	public function getLatestOurProjects(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "posts AS p JOIN " . DB_PREFIX . "posts_description AS pd ON (p.posts_id = pd.posts_id) ORDER BY p.posts_id DESC LIMIT 6");
		
		return $query->rows;
	}
}