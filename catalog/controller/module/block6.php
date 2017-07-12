<?php
class ControllerModuleBlock6 extends Controller {
	public function index() {
		$this->load->language('module/block6');

		$data['heading_title'] = $this->language->get('heading_title');
		
		$this->load->model('catalog/product');
		$this->load->model('tool/image');
		
		$product_info = $this->model_catalog_product->getLatestOurProject();
		
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
				'href'  => $this->url->link('product/product', $url . '&product_id=' . $info['product_id'])
			);
		}
		
		$data['view_all'] = $this->url->link('product/category&path=59', '', 'SSL');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/block6.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/block6.tpl', $data);
		} else {
			return $this->load->view('default/template/module/block6.tpl', $data);
		}
	}
}