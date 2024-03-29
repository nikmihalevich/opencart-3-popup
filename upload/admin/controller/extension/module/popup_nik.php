<?php
class ControllerExtensionModulePopupNik extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/popup_nik');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_setting_module->addModule('popup_nik', $this->request->post);
			} else {
				$this->model_setting_module->editModule($this->request->get['module_id'], $this->request->post);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		if (isset($this->error['width'])) {
			$data['error_width'] = $this->error['width'];
		} else {
			$data['error_width'] = '';
		}

		if (isset($this->error['top_distance'])) {
			$data['error_top_distance'] = $this->error['top_distance'];
		} else {
			$data['error_top_distance'] = '';
		}

		if (isset($this->error['show_freq'])) {
			$data['error_show_freq'] = $this->error['show_freq'];
		} else {
			$data['error_show_freq'] = '';
		}

		if (isset($this->error['button_class'])) {
			$data['error_button_class'] = $this->error['button_class'];
		} else {
			$data['error_button_class'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/popup_nik', 'user_token=' . $this->session->data['user_token'], true)
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/popup_nik', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true)
			);
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('extension/module/popup_nik', 'user_token=' . $this->session->data['user_token'], true);
		} else {
			$data['action'] = $this->url->link('extension/module/popup_nik', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'], true);
		}

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_setting_module->getModule($this->request->get['module_id']);
		}

        $this->load->model('tool/image');

		$data['user_token'] = $this->session->data['user_token'];

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}

		if (isset($this->request->post['title'])) {
			$data['title'] = $this->request->post['title'];
		} elseif (!empty($module_info)) {
			$data['title'] = $module_info['title'];
		} else {
			$data['title'] = '';
		}

		if (isset($this->request->post['text'])) {
			$data['text'] = $this->request->post['text'];
		} elseif (!empty($module_info)) {
			$data['text'] = $module_info['text'];
		} else {
			$data['text'] = '';
		}

		if (isset($this->request->post['size_type'])) {
			$data['size_type'] = $this->request->post['size_type'];
		} elseif (!empty($module_info)) {
			$data['size_type'] = $module_info['size_type'];
		} else {
			$data['size_type'] = 0;
		}

		if (isset($this->request->post['window_type'])) {
			$data['window_type'] = $this->request->post['window_type'];
		} elseif (!empty($module_info)) {
			$data['window_type'] = $module_info['window_type'];
		} else {
			$data['window_type'] = 0;
		}

        if (isset($this->request->post['top_distance'])) {
            $data['top_distance'] = $this->request->post['top_distance'];
        } elseif (!empty($module_info)) {
            $data['top_distance'] = $module_info['top_distance'];
        } else {
            $data['top_distance'] = '';
        }

        if (isset($this->request->post['top_distance_unit'])) {
            $data['top_distance_unit'] = $this->request->post['top_distance_unit'];
        } elseif (!empty($module_info)) {
            $data['top_distance_unit'] = $module_info['top_distance_unit'];
        } else {
            $data['top_distance_unit'] = 'px';
        }

        if (isset($this->request->post['window_location'])) {
            $data['window_location'] = $this->request->post['window_location'];
        } elseif (!empty($module_info)) {
            $data['window_location'] = $module_info['window_location'];
        } else {
            $data['window_location'] = 0;
        }

        if (isset($this->request->post['window_bg_color'])) {
            $data['window_bg_color'] = $this->request->post['window_bg_color'];
        } elseif (!empty($module_info)) {
            $data['window_bg_color'] = $module_info['window_bg_color'];
        } else {
            $data['window_bg_color'] = '';
        }

        if (isset($this->request->post['window_bg_image'])) {
            $data['window_bg_image'] = $this->request->post['window_bg_image'];
        } elseif (!empty($module_info)) {
            $data['window_bg_image'] = $module_info['window_bg_image'];
        } else {
            $data['window_bg_image'] = '';
        }

        $data['thumb'] = $data['window_bg_image'] ? $this->model_tool_image->resize($data['window_bg_image'], 100, 100) : $this->model_tool_image->resize('no_image.png', 40, 40);

        $data['img_placeholder'] = $this->model_tool_image->resize('no_image.png', 40, 40);

        if (isset($this->request->post['show_type'])) {
            $data['show_type'] = $this->request->post['show_type'];
        } elseif (!empty($module_info)) {
            $data['show_type'] = $module_info['show_type'];
        } else {
            $data['show_type'] = 0;
        }

        if (isset($this->request->post['button_class'])) {
            $data['button_class'] = $this->request->post['button_class'];
        } elseif (!empty($module_info)) {
            $data['button_class'] = $module_info['button_class'];
        } else {
            $data['button_class'] = '';
        }

        if (isset($this->request->post['show_freq'])) {
            $data['show_freq'] = $this->request->post['show_freq'];
        } elseif (!empty($module_info)) {
            $data['show_freq'] = $module_info['show_freq'];
        } else {
            $data['show_freq'] = '';
        }

        if (isset($this->request->post['show_freq_type'])) {
            $data['show_freq_type'] = $this->request->post['show_freq_type'];
        } elseif (!empty($module_info)) {
            $data['show_freq_type'] = $module_info['show_freq_type'];
        } else {
            $data['show_freq_type'] = 0;
        }

        if (isset($this->request->post['width'])) {
            $data['width'] = $this->request->post['width'];
        } elseif (!empty($module_info)) {
            $data['width'] = $module_info['width'];
        } else {
            $data['width'] = 600;
        }

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/popup_nik', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/popup_nik')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		if ($this->request->post['window_type'] == 1) {
		    if($this->request->post['top_distance'] == '') {
                $this->error['top_distance'] = $this->language->get('error_top_distance');
            }
        }

		if (!$this->request->post['width']) {
			$this->error['width'] = $this->language->get('error_width');
		}

        if ($this->request->post['show_type'] == 1) {
            if(!$this->request->post['show_freq']) {
                $this->error['show_freq'] = $this->language->get('error_show_freq');
            }
        } else {
            if(!$this->request->post['button_class']) {
                $this->error['button_class'] = $this->language->get('error_button_class');
            }
        }

		return !$this->error;
	}
}
