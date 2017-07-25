<?php
class ControllerCatalogJobs extends Controller {
	private $error = array();
	
	public function index() {
		$this->language->load('catalog/jobs');
		
		$this->load->model('catalog/jobs');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$url = '';
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL')
		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/jobs', 'token=' . $this->session->data['token'] . $url, 'SSL')
   		);
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->error['warning'])) {
			$data['error'] = $this->error['warning'];
		
			unset($this->error['warning']);
		} else {
			$data['error'] = '';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else { 
			$page = 1;
		}
		
		$url = '';
		
		$filter_data = array(
			'page' => $page,
			'limit' => $this->config->get('config_limit_admin'),
			'start' => $this->config->get('config_limit_admin') * ($page - 1),
		);
		
		$total = $this->model_catalog_jobs->getTotalposts();
		
		$pagination = new Pagination();
		$pagination->total = $total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($total - $this->config->get('config_limit_admin'))) ? $total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $total, ceil($total / $this->config->get('config_limit_admin')));

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_title'] = $this->language->get('text_title');
		$data['text_short_description'] = $this->language->get('text_short_description');
		$data['text_date'] = $this->language->get('text_date');
		$data['text_action'] = $this->language->get('text_action');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		
		
		$data['button_add'] = $this->language->get('button_add');
		$data['button_delete'] = $this->language->get('button_delete');
		
		$url = '';
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$data['add'] = $this->url->link('catalog/jobs/insert', '&token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('catalog/jobs/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		$data['all_posts'] = array();
		
		$all_posts = $this->model_catalog_jobs->getAllposts($filter_data);
		
		foreach ($all_posts as $posts) {
			$data['all_posts'][] = array (
				'jobs_id' 			    => $posts['jobs_id'],
				'title' 			=> $posts['title'],
				'short_description'	=> $posts['short_description'],
				'module_status' => $posts['module']==0 ? 'Нет' : 'Да',
				'module' => $posts['module'],
				'date_added' 		=> date($this->language->get('date_format_short'), strtotime($posts['date_added'])),
				'edit' 				=> $this->url->link('catalog/jobs/edit', 'jobs_id=' . $posts['jobs_id'] . '&token=' . $this->session->data['token'] . $url, 'SSL')
			);
		}
		$data['token']=$this->session->data['token'];
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/jobs_list.tpl', $data));	
	}
	
	public function edit() {
		$this->language->load('catalog/jobs');
		
		$this->load->model('catalog/jobs');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_catalog_jobs->editposts($this->request->get['jobs_id'], $this->request->post);		
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('catalog/jobs', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$this->form();
	}
	
	public function insert() {
		$this->language->load('catalog/jobs');
		
		$this->load->model('catalog/jobs');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_catalog_jobs->addposts($this->request->post);		
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('catalog/jobs', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->form();
	}
	
	protected function form() {
		$this->language->load('catalog/jobs');
		
		$this->load->model('catalog/jobs');
		
		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/jobs', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		if (isset($this->request->get['jobs_id'])) {
			$data['action'] = $this->url->link('catalog/jobs/edit', '&jobs_id=' . $this->request->get['jobs_id'] . '&token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('catalog/jobs/insert', '&token=' . $this->session->data['token'], 'SSL');
		}
		
		$data['cancel'] = $this->url->link('catalog/jobs', '&token=' . $this->session->data['token'], 'SSL');
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_image'] = $this->language->get('text_image');
		$data['text_title'] = $this->language->get('text_title');
		$data['text_description'] = $this->language->get('text_description');
		$data['text_short_description'] = $this->language->get('text_short_description');
		$data['text_status'] = $this->language->get('text_status');
		$data['text_keyword'] = $this->language->get('text_keyword');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_browse'] = $this->language->get('text_browse');
		$data['text_clear'] = $this->language->get('text_clear');
		$data['text_image_manager'] = $this->language->get('text_image_manager');
		$data['text_model'] = $this->language->get('text_model');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		$data['token'] = $this->session->data['token'];
		
		$this->load->model('localisation/language');
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		if (isset($this->error['warning'])) {
			$data['error'] = $this->error['warning'];
		} else {
			$data['error'] = '';
		}
		
		if (isset($this->request->get['jobs_id'])) {
			$jobs = $this->model_catalog_jobs->getposts($this->request->get['jobs_id']);
		} else {
			$jobs = array();
		}
		
		if (isset($this->request->post['jobs'])) {
			$data['jobs'] = $this->request->post['jobs'];
		} elseif (!empty($jobs)) {
			$data['jobs'] = $this->model_catalog_jobs->getpostsDescription($this->request->get['jobs_id']);
		} else {
			$data['jobs'] = '';
		}
		
		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($jobs)) {
			$data['image'] = $jobs['image'];
		} else {
			$data['image'] = '';
		}
		
		if (isset($this->request->post['full_image'])) {
			$data['full_image'] = $this->request->post['full_image'];
		} elseif (!empty($jobs)) {
			$data['full_image'] = $jobs['full_image'];
		} else {
			$data['full_image'] = '';
		}
		
		$this->load->model('tool/image');
		
		if (isset($this->request->post['full_image'])) {
			$data['preview'] = $this->model_tool_image->resize($this->request->post['full_image'], 100, 100);
		} elseif (!empty($jobs)) {
			$data['preview'] = $this->model_tool_image->resize($jobs['full_image'] ? $jobs['full_image'] : 'no_image.png', 100, 100);
		} else {
			$data['preview'] = $this->model_tool_image->resize('no_image.png', 100, 100);;
		}
		
		if (isset($this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($jobs)) {
			$data['thumb'] = $this->model_tool_image->resize($jobs['image'] ? $jobs['image'] : 'no_image.png', 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);;
		}
		
		$data['no_image'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		if (isset($this->request->post['keyword'])) {
			$data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($jobs)) {
			$data['keyword'] = $jobs['keyword'];
		} else {
			$data['keyword'] = '';
		}
				
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($jobs)) {
			$data['status'] = $jobs['status'];
		} else {
			$data['status'] = '';
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/jobs_form.tpl', $data));
	}
	
	public function delete() {
		$this->language->load('catalog/jobs');
		
		$this->load->model('catalog/jobs');

		$this->document->setTitle($this->language->get('heading_title'));
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $jobs_id) {
				$this->model_catalog_jobs->deleteposts($jobs_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');
		}
		
		$this->response->redirect($this->url->link('catalog/jobs', 'token=' . $this->session->data['token'], 'SSL'));
	}
	
	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/jobs')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
 
		if (!$this->error) {
			return true; 
		} else {
			return false;
		}
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'catalog/jobs')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}