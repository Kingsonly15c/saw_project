<?php 
// @since version 4.2.1

class ModelTshirtecommerceMydesign extends Model
{
	public function getDefaultProduct($parent_id = 0)
    {
    	$product_id = 0;
    	$query = $this->db->query('SELECT `design_product_id` FROM `'.DB_PREFIX.'product` WHERE `product_id` = '.(int)$parent_id);

    	if ($query->num_rows) {
    		$product_id = $query->row['design_product_id'];
    	}

    	$pos = explode(':', $product_id);
    	if (count($pos) > 1 && isset($pos[2])) {
    		$product_id = $pos[2];
    	}

    	return $product_id;
    }

    public function getDesigns()
    {
    	$segment = 16;
    	$json = array(
    		'continue' => 1,
    		'html' => ''
    	);

    	$this->load->language('extension/module/tshirtecommerce');
    	$html = '';

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

		if (count($designs)) {
			$count = 1;
			foreach ($designs as $key => $design) {
				if ($count <= $segment) {
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
			$html .= '<p>'.$this->language->get('tshirtecommerce_design_not_found').'</p>';
		}

		if (count($designs) <= $segment) {
			$json['continue'] = 0;
		}

		$json['html'] = $html;

    	return $json;
    }
}