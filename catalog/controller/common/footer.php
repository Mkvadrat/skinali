<?php
class ControllerCommonFooter extends Controller {
	public function index() {
		$this->load->language('common/footer');

		$data['scripts'] = $this->document->getScripts('footer');

		$data['text_information'] = $this->language->get('text_information');
		$data['text_service'] = $this->language->get('text_service');
		$data['text_extra'] = $this->language->get('text_extra');
		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_return'] = $this->language->get('text_return');
		$data['text_sitemap'] = $this->language->get('text_sitemap');
		$data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$data['text_voucher'] = $this->language->get('text_voucher');
		$data['text_affiliate'] = $this->language->get('text_affiliate');
		$data['text_special'] = $this->language->get('text_special');
		$data['text_account'] = $this->language->get('text_account');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_wishlist'] = $this->language->get('text_wishlist');
		$data['text_newsletter'] = $this->language->get('text_newsletter');

		$this->load->model('catalog/information');

		$data['informations'] = array();

		foreach ($this->model_catalog_information->getInformations() as $result) {
			if ($result['bottom']) {
				$data['informations'][] = array(
					'title' => $result['title'],
					'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
				);
			}
		}
		
		$data['name'] = $this->config->get('config_name');
		$data['home'] = $this->url->link('common/home');
		
		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}
		
		if (is_file(DIR_IMAGE . $this->config->get('config_logo_footer'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo_footer');
		} else {
			$data['logo'] = '';
		}

		$data['contact'] = $this->url->link('information/contact');
		$data['return'] = $this->url->link('account/return/add', '', 'SSL');
		$data['sitemap'] = $this->url->link('information/sitemap');
		$data['manufacturer'] = $this->url->link('product/manufacturer');
		$data['voucher'] = $this->url->link('account/voucher', '', 'SSL');
		$data['affiliate'] = $this->url->link('affiliate/account', '', 'SSL');
		$data['special'] = $this->url->link('product/special');
		$data['account'] = $this->url->link('account/account', '', 'SSL');
		$data['order'] = $this->url->link('account/order', '', 'SSL');
		$data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$data['newsletter'] = $this->url->link('account/newsletter', '', 'SSL');
		$data['instagram'] = $this->config->get('config_instagram');
		$data['facebook'] = $this->config->get('config_facebook');
		$data['footer_text'] = html_entity_decode($this->config->get('config_footer_text'), ENT_QUOTES, 'UTF-8');
		$data['contact_inf'] = html_entity_decode($this->config->get('config_contact_inf'), ENT_QUOTES, 'UTF-8');

		$data['powered'] = sprintf($this->language->get('text_powered'), $this->config->get('config_name'), date('Y', time()));

		// Whos Online
		if ($this->config->get('config_customer_online')) {
			$this->load->model('tool/online');

			if (isset($this->request->server['REMOTE_ADDR'])) {
				$ip = $this->request->server['REMOTE_ADDR'];
			} else {
				$ip = '';
			}

			if (isset($this->request->server['HTTP_HOST']) && isset($this->request->server['REQUEST_URI'])) {
				$url = 'http://' . $this->request->server['HTTP_HOST'] . $this->request->server['REQUEST_URI'];
			} else {
				$url = '';
			}

			if (isset($this->request->server['HTTP_REFERER'])) {
				$referer = $this->request->server['HTTP_REFERER'];
			} else {
				$referer = '';
			}

			$this->model_tool_online->addOnline($ip, $this->customer->getId(), $url, $referer);
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/footer.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/footer.tpl', $data);
		} else {
			return $this->load->view('default/template/common/footer.tpl', $data);
		}
	}
	
	//Формы
	public function sendForm(){
		$json = array();
		
		$json = array(
			'status' => 0,
			'message' => ''
		);
		
		$site_url = $_SERVER['SERVER_NAME'];
	
		if (isset($this->request->post['name'])) {$name = $this->request->post['name']; if ($name == '') {unset($name);}}
		if (isset($this->request->post['tel'])) {$tel = $this->request->post['tel']; if ($tel == '') {unset($tel);}}
	
		if (isset($name) && isset($tel)){
			
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
			$mail->setSubject(html_entity_decode(sprintf($this->language->get($site_url), $this->request->post['name']), ENT_QUOTES, 'UTF-8'));
			$mail->setText("Имя: $name \nТелефон: $tel \n");
			$send = $mail->send();
						
			if ($mail){
				$json = array(
					'status' => 1,
					'message' => 'Ваше сообщение отправлено'
				);
			}else{
				$json = array(
					'status' => 1,
					'message' => 'Ошибка, сообщение не отправлено!'
				);
			}
		}
	
		if (isset($this->request->post['name']) && isset($this->request->post['tel'])){
			$name = $this->request->post['name'];
			$tel = $this->request->post['tel'];
	
			if ($name == '' || $tel == '') {
				unset($name);
				unset($tel);
				
				$json = array(
					'status' => 1,
					'message' => 'Ошибка, сообщение не отправлено! Заполните все поля!'
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function sendFullForm(){
		$json = array();
		
		$json = array(
			'status' => 0,
			'message' => ''
		);
		
		$site_url = $_SERVER['SERVER_NAME'];
	
		if (isset($this->request->post['name'])) {$name = $this->request->post['name']; if ($name == '') {unset($name);}}
		if (isset($this->request->post['tel'])) {$tel = $this->request->post['tel']; if ($tel == '') {unset($tel);}}
		if (isset($this->request->post['question'])) {$question = $this->request->post['question']; if ($question == '') {unset($question);}}
	
		if (isset($name) && isset($tel) && isset($question)){
			
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
			$mail->setSubject(html_entity_decode(sprintf($this->language->get($site_url), $this->request->post['name']), ENT_QUOTES, 'UTF-8'));
			$mail->setText("Имя: $name \nТелефон: $tel \nВопрос: $question\n");
			$send = $mail->send();
						
			if ($mail){
				$json = array(
					'status' => 1,
					'message' => 'Вы отправили заявку на ЗВОНОК. Наш менеджер свяжется с Вами в ближайшее время'
				);
			}else{
				$json = array(
					'status' => 1,
					'message' => 'Ошибка, сообщение не отправлено!'
				);
			}
		}
	
		if (isset($this->request->post['name']) && isset($this->request->post['tel']) && isset($this->request->post['question'])){
			$name = $this->request->post['name'];
			$tel = $this->request->post['tel'];
			$question = $this->request->post['question'];
	
			if ($name == '' || $tel == '' || $question == '') {
				unset($name);
				unset($tel);
				unset($question);
				
				$json = array(
					'status' => 1,
					'message' => 'Ошибка, сообщение не отправлено! Заполните все поля!'
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function sendBidForm(){
		$json = array();
		
		$json = array(
			'status' => 0,
			'message' => ''
		);
		
		$site_url = $_SERVER['SERVER_NAME'];
	
		if (isset($this->request->post['name'])) {$name = $this->request->post['name']; if ($name == '') {unset($name);}}
		if (isset($this->request->post['tel'])) {$tel = $this->request->post['tel']; if ($tel == '') {unset($tel);}}
	
		if (isset($name) && isset($tel)){
			
			if(isset($_POST['check'])){
				$check = $_POST['check'];
	
				if($check == 1){
					$checked = '<p style="background-color:#f00; width:500px;">Пользователь согласился на обработку своих данных, указаных в заявке.</p>';
				}else{
					$checked = '';
				}
			}
			
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
			$mail->setSubject(html_entity_decode(sprintf($this->language->get($site_url), $this->request->post['name']), ENT_QUOTES, 'UTF-8'));
			$mail->setHtml('Имя: ' . $name . '<br>' . 'Телефон: ' . $tel . '<br>' . $checked);
			$send = $mail->send();
						
			if ($mail){
				$json = array(
					'status' => 1,
					'message' => 'Вы отправили заявку на расчет стоимости. Наш менеджер свяжется с Вами в ближайшее время'
				);
			}else{
				$json = array(
					'status' => 1,
					'message' => 'Ошибка, сообщение не отправлено!'
				);
			}
		}
	
		if (isset($this->request->post['name']) && isset($this->request->post['tel'])){
			$name = $this->request->post['name'];
			$tel = $this->request->post['tel'];
	
			if ($name == '' || $tel == '') {
				unset($name);
				unset($tel);
				
				$json = array(
					'status' => 1,
					'message' => 'Ошибка, сообщение не отправлено! Заполните все поля!'
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}	
}
