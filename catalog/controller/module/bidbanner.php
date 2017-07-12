<?php
class ControllerModuleBidbanner extends Controller {
	public function index() {
		$this->load->language('module/bidbanner');

		$data['heading_title'] = $this->language->get('heading_title');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/bidbanner.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/bidbanner.tpl', $data);
		} else {
			return $this->load->view('default/template/module/bidbanner.tpl', $data);
		}
	}
}