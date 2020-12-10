<?php
class ControllerExtensionModulePopupNik extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/popup_nik');
        static $module = 0;

		$data = $setting;

        $data['text'] = html_entity_decode($data['text']);
        $data['module'] = $module++;

//        var_dump($data);

        return $this->load->view('extension/module/popup_nik', $data);
	}
}