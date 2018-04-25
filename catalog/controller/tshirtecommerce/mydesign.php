<?php 
// @since version 4.2.1

class ControllerTshirtecommerceMydesign extends Controller 
{
	public function more()
	{
		$page = isset($this->request->post['page']) ? $this->request->post['page'] : 2;

		$segment = 16;
		$start = ($page - 1) * $segment;
		$end = $start + $segment;

		$this->load->language('extension/module/tshirtecommerce');
		$json = array(
			'continue' => 1,
			'html' => '',
		);
		$html = '';

		if ($page < 2) {
			$json['html'] = '';
			return json_encode($json);
		}

		if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);
		if (!defined('ROOT')) define('ROOT', dirname(DIR_SYSTEM).DS.'tshirtecommerce');
		include_once ROOT.DS.'includes'.DS.'functions.php';
		$dg = new dg();
		$cache = $dg->cache();
		$user_id = md5($this->customer->getId());
		$designs = $cache->get($user_id);

		if ($this->request->server['HTTPS']) {
			$site_url = HTTPS_SERVER;
		} else {
			$site_url = HTTP_SERVER;
		}

		if ($start >= count($designs)) {
			$json['continue'] = 0;
			$json['html'] = '';
			return json_encode($json);
		}

		if ($end >= count($designs)) {
			$json['continue'] = 0;
		}

		if (count($designs)) {
			$count = 1;
			foreach ($designs as $key => $design) {
				if ($count >= $start && $count < $end) {
					$params = sprintf('product_id=%s:%s:%s:%s&parent_id=%s', $user_id, $key, $design['product_id'], $design['product_options'], $design['parent_id']);
					$link_edit = $this->url->link('tshirtecommerce/designer', $params, true);

					$html .= '<div id="mydesign-item-'.$key.'" class="mydesign-item">';
					$html .= 	'<span class="iconclear" title="'.$this->language->get('label_delete').'" onclick="removemydesign(\''.$key.'\')"><i class="material-icons">clear</i></span>';
					$html .= 	'<a target="_blank" href="'.$link_edit.'" title="'.$design['title'].'">';
					$html .= 		'<img src="'.$site_url.'/tshirtecommerce/'.$design['image'].'" alt="'.$design['title'].'" />';
					$html .= 	'</a>';
					$html .= '</div>';
				}
				$count++;
			}
		} else {
			$json['continue'] = 0;
			$html .= '<p>'.$this->language->get('tshirtecommerce_design_not_found').'</p>';
		}

		$json['html'] = $html;

		echo json_encode($json);
		return;
	}

	public function delete()
	{
		$this->load->language('extension/module/tshirtecommerce');
		$key = isset($this->request->post['key']) ? $this->request->post['key'] : '';

		$json = array(
			'error' => 0,
			'msg' => $this->language->get('tshirtecommerce_design_delete_success'),
		);

		if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);
		if (!defined('ROOT')) define('ROOT', dirname(DIR_SYSTEM).DS.'tshirtecommerce');
		include_once ROOT.DS.'includes'.DS.'functions.php';
		$dg = new dg();
		$cache = $dg->cache();
		$user_id = md5($this->customer->getId());
		$designs = $cache->get($user_id);

		$is_changed = false;
		if (count($designs)) {
			foreach ($designs as $k => &$design) {
				if ($key == $k) {
					unset($designs[$key]);
					$is_changed = true;
					break;
				}
			}
		}
		if ($is_changed === true) {
			$cache->set($user_id, $designs);
		} else {
			$json['error'] = 1;
			$json['msg'] = $this->language->get('tshirtecommerce_design_delete_fail');
		}

		echo json_encode($json);
		return;
	}
}