<?php
class ControllerModuleBlock5 extends Controller {
	public function index() {
		$this->load->language('module/block5');

		$data['heading_title'] = $this->language->get('heading_title');
		
		$this->load->model('extension/jobs');
		$this->load->model('tool/image');
		
		$product_info = $this->model_extension_jobs->getLatestJobs();
		
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
				'href'  => $this->url->link('information/jobs/posts', $url . '&jobs_id=' . $info['jobs_id'])
			);
		}
			
		$data['view_all'] = $this->url->link('information/jobs', '', 'SSL');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/block5.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/block5.tpl', $data);
		} else {
			return $this->load->view('default/template/module/block5.tpl', $data);
		}
	}
}