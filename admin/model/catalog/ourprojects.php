<?php
class ModelCatalogOurprojects extends Model {
	public function addPosts($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "posts SET image = '" . $this->db->escape($data['image']) . "', full_image = '" . $this->db->escape($data['full_image']) . "',  date_added = NOW(), status = '" . (int)$data['status'] . "'");
		
		$posts_id = $this->db->getLastId();
		
		foreach ($data['posts'] as $key => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX ."posts_description SET posts_id = '" . (int)$posts_id . "', language_id = '" . (int)$key . "', title = '" . $this->db->escape($value['title']) . "', model = '" . $this->db->escape($value['model']) . "'");
		}
		
		if (isset($data['posts_image'])) {
			foreach ($data['posts_image'] as $posts_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "posts_image SET posts_id = '" . (int)$posts_id . "', image = '" . $this->db->escape($posts_image['image']) . "', sort_order = '" . (int)$posts_image['sort_order'] . "'");
			}
		}
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'posts_id=" . (int)$posts_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
	}
	
	public function editPosts($posts_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "posts SET image = '" . $this->db->escape($data['image']) . "', full_image = '" . $this->db->escape($data['full_image']) . "', status = '" . (int)$data['status'] . "' WHERE posts_id = '" . (int)$posts_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "posts_description WHERE posts_id = '" . (int)$posts_id. "'");
		
		foreach ($data['posts'] as $key => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX ."posts_description SET posts_id = '" . (int)$posts_id . "', language_id = '" . (int)$key . "', title = '" . $this->db->escape($value['title']) . "', model = '" . $this->db->escape($value['model']) . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "posts_image WHERE posts_id = '" . (int)$posts_id . "'");

		if (isset($data['posts_image'])) {
			foreach ($data['posts_image'] as $posts_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "posts_image SET posts_id = '" . (int)$posts_id . "', image = '" . $this->db->escape($posts_image['image']) . "', sort_order = '" . (int)$posts_image['sort_order'] . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'posts_id=" . (int)$posts_id. "'");
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'posts_id=" . (int)$posts_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
	}
	
	public function getPosts($posts_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'posts_id=" . (int)$posts_id . "') AS keyword FROM " . DB_PREFIX . "posts WHERE posts_id = '" . (int)$posts_id . "'"); 
 
		if ($query->num_rows) {
			return $query->row;
		} else {
			return false;
		}
	}
   
	public function getPostsDescription($posts_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "posts_description WHERE posts_id = '" . (int)$posts_id . "'"); 
		
		foreach ($query->rows as $result) {
			$posts_description[$result['language_id']] = array(
				'title'       			=> $result['title'],
				'model'		            => $result['model'],
			);
		}
		
		return $posts_description;
	}
 
	public function getAllPosts($data) {
		$sql = "SELECT * FROM " . DB_PREFIX . "posts n LEFT JOIN " . DB_PREFIX . "posts_description nd ON n.posts_id = nd.posts_id WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY date_added DESC";
		
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
	
	public function getPostsImages($posts_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "posts_image WHERE posts_id = '" . (int)$posts_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}
   
	public function deletePosts($posts_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "posts WHERE posts_id = '" . (int)$posts_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "posts_image WHERE posts_id = '" . (int)$posts_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "posts_description WHERE posts_id = '" . (int)$posts_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'posts_id=" . (int)$posts_id. "'");
	}
   
	public function getTotalposts() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "posts");
	
		return $query->row['total'];
	}

	public function setModule($posts_id, $value){
		$this->db->query("UPDATE " . DB_PREFIX . "posts SET module = '" . (int)$value . "' WHERE posts_id = '" . (int)$posts_id . "'"); 
	}
}