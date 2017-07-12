<?php
class ControllerModuleBlock1 extends Controller {
	public function index($setting) {
		if (isset($setting['block1'][$this->config->get('config_language_id')])) {
			$data['heading_title'] = html_entity_decode($setting['block1'][$this->config->get('config_language_id')]['title'], ENT_QUOTES, 'UTF-8');
			$data['html'] = html_entity_decode($setting['block1'][$this->config->get('config_language_id')]['description'], ENT_QUOTES, 'UTF-8');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/block1.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/block1.tpl', $data);
			} else {
				return $this->load->view('default/template/module/block1.tpl', $data);
			}
		}
	}
}