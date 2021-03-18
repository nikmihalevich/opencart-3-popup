<?php
class ControllerExtensionModulePopupNik extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/popup_nik');
        static $module = 0;

        $this->load->model('tool/image');

		$data = $setting;

		if ($data['window_bg_image']) {
            if ($this->request->server['HTTPS']) {
                $data['window_bg_image'] = $this->config->get('config_ssl') . 'image/' . $setting['window_bg_image'];
            } else {
                $data['window_bg_image'] = $this->config->get('config_url') . 'image/' . $setting['window_bg_image'];
            }
        }

        $data['text'] = html_entity_decode($data['text']);
        $data['module'] = $module++;

        return $this->load->view('extension/module/popup_nik', $data);
	}
}