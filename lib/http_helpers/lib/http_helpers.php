<?php
/**
 * TODO: slash
 *
 * @param unknown_type $url
 * @param unknown_type $hostname
 * @return unknown_type
 */
function http_redirect_to($url, $hostname = null, $ssl = false) {
  if (substr($url, 0, 4) !== 'http') {
    if ($hostname) {
  		$url = $hostname . $url;
  	}
  	
    $url = ($ssl ? 'https://' : 'http://') . $url;
  }

  header('Location: ' . $url);
  exit;
}

# EOF