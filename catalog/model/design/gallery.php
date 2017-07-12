<?php
class ModelDesignGallery extends Model {
	public function getLatestGalleryImage(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "gallery_image ORDER BY gallery_image_id DESC LIMIT 6");
		
		return $query->rows;
	}
	
	public function getGallery($gallery_id) {
		$query = $this->db->query("SELECT image FROM " . DB_PREFIX . "gallery_image WHERE gallery_id = '". $gallery_id ."'");

		return $query->rows;
	}
}