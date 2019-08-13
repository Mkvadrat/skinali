<?php
class ControllerModuleBidbanner extends Controller {
	private $error = array();
	
	public function index() {
		$this->load->language('module/bidbanner');

		$data['heading_title'] = $this->language->get('heading_title');
		
		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status')) {
			$data['captcha'] = $this->load->controller('captcha/' . $this->config->get('config_captcha'), $this->error);
		} else {
			$data['captcha'] = '';
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/bidbanner.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/bidbanner.tpl', $data);
		} else {
			return $this->load->view('default/template/module/bidbanner.tpl', $data);
		}
	}
	
	public function sendFormHeader(){
		$json = array();
		
		$this->load->language('module/bidbanner');
	
		$site_url = $_SERVER['SERVER_NAME'];

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateFormHeader()) {
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
			
			$mail->setTo($this->config->get('config_email'));
			$mail->setFrom($site_url);
			$mail->setSender(html_entity_decode($this->request->post['name'], ENT_QUOTES, 'UTF-8'));
			$mail->setSubject(html_entity_decode(sprintf($this->language->get('email_subject'), $this->request->post['name']), ENT_QUOTES, 'UTF-8'));
			$mail->setHTML('Телефон: ' . $this->request->post['tel']);
			
			$mail->send();
		
			if ($mail){
				$json = array(
					'status' => 200,
					'success' => 'Ваше сообщение отправлено'
				);
			}		
		}
				
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
			$json['error'][] = $this->language->get('error_name');
		}
		
		if ((utf8_strlen($this->request->post['tel']) < 3) || (utf8_strlen($this->request->post['tel']) > 32)) {
			$json['error'][] = $this->language->get('error_tel');
		}
				
		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status')) {
			$captcha = $this->load->controller('captcha/' . $this->config->get('config_captcha') . '/validate');

			if ($captcha) {
				$json['error'][] = $captcha;
			}
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	protected function validateFormHeader() {
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if ((utf8_strlen($this->request->post['tel']) < 3) || (utf8_strlen($this->request->post['tel']) > 32)) {
			$this->error['tel'] = $this->language->get('error_tel');
		}

		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status')) {
			$captcha = $this->load->controller('captcha/' . $this->config->get('config_captcha') . '/validate');

			if ($captcha) {
				$this->error['captcha'] = $captcha;
			}
		}

		return !$this->error;
	}
}

