<?php
class ControllerModuleBlock3 extends Controller {
	public function index($setting) {
		if (isset($setting['block3'][$this->config->get('config_language_id')])) {
			$data['heading_title'] = html_entity_decode($setting['block3'][$this->config->get('config_language_id')]['title'], ENT_QUOTES, 'UTF-8');
			$data['html'] = html_entity_decode($setting['block3'][$this->config->get('config_language_id')]['description'], ENT_QUOTES, 'UTF-8');
						
			$this->load->model('extension/ourprojects');
			$this->load->model('tool/image');
			
			$product_info = $this->model_extension_ourprojects->getLatestOurProjects();
			
			$data['results'] = array();
			
			foreach($product_info as $info){
				if ($info['image']) {
					$image = $this->model_tool_image->resize($info['image'], '305', '190');
				} else {
					$image = $this->model_tool_image->resize('no_image.png', '305', '190');;
				}
				
				$url = '';
				
				$data['results'][] = array(
					'image' => $image,
					'model' => $info['model'],
					'href'  => $this->url->link('information/ourprojects/posts', $url . '&posts_id=' . $info['posts_id'])
				);
			}
			
			$data['view_all'] = $this->url->link('information/ourprojects', '', 'SSL');
			
			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/block3.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/block3.tpl', $data);
			} else {
				return $this->load->view('default/template/module/block3.tpl', $data);
			}
		}
	}
}