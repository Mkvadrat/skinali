<?php
class ControllerModuleBlock4 extends Controller {
	public function index($setting) {
		if (isset($setting['block4'][$this->config->get('config_language_id')])) {
			$data['heading_title'] = html_entity_decode($setting['block4'][$this->config->get('config_language_id')]['title'], ENT_QUOTES, 'UTF-8');
			$data['html'] = html_entity_decode($setting['block4'][$this->config->get('config_language_id')]['description'], ENT_QUOTES, 'UTF-8');
			
			$this->load->model('design/gallery');
			$this->load->model('tool/image');
			
			$gallery_info = $this->model_design_gallery->getLatestGalleryImage();
			
			$data['latest_gallery'] = array();
			
			foreach($gallery_info as $info){
				if ($info['image']) {
					$image = $this->model_tool_image->resize($info['image'], 963, 600);
				} else {
					$image = $this->model_tool_image->resize('no_image.png', 963, 600);
				}
				
				$data['latest_gallery'][] = array(
					'image_id' => $info['gallery_image_id'],
					'image' => $image,
				);
			}
									
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/block4.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/block4.tpl', $data);
			} else {
				return $this->load->view('default/template/module/block4.tpl', $data);
			}
		}
	}
	
	public function ajaxGallery(){
		$json = array();
		
		$this->load->model('design/gallery');
		$this->load->model('tool/image');
		
		$gallery_id = $this->config->get('gallery_id');
			
		$gallery_images = $this->model_design_gallery->getGallery($gallery_id);
		
		foreach($gallery_images as $images){
			if ($images['image']) {
				$image = $this->model_tool_image->resize($images['image'], 963, 600);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 963, 600);
			}
			
			$json['image'][] = $image;
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
			
		
	}
	
	
	
	
	
	
}