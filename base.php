<?
class base
{
	function request($url, $type, $data)
	{
		if (strtolower($type) == 'post')
			return $this->post($url, $data, $this->curl);
		else
			return $this->get($url, $data, $this->curl);
	}
	
	function post($url, $data, &$curl)
	{
		if (!is_array($curl['cookies']))
			$curl['cookies'] = array();
		$context = stream_context_create(
				array(
					'http' => array(
					'method'  => 'POST',
					'header'  => "Host: " . current(explode("/", str_replace(array("http://", "https://"), "", $url))) . "\r\n" .
								"User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10\r\n" .
								"Cookie: " . implode(" ", $curl['cookies']) . "\r\n" .
								"Accept-language: en\r\n" .
		                		"Content-length: " . strlen(http_build_query($data)) . "\r\n" . 
		                		"Content-type:application/x-www-form-urlencoded\r\n",
					'content' => http_build_query($data),
					'proxy'   => ($curl->proxy['ip'] && $curl->proxy['port'])?("tcp://" . $curl->proxy['ip'] . ":" . $curl->proxy['port']):"",
					'max_redirects' => 10
				),
			));
		$ret = file_get_contents($url, false, $context);
		$curl['last_page'] = $url;
		foreach ($http_response_header as $k => $v)
			if (stristr($v, "Set-Cookie") > -1 && (strlen(end(explode("=", current(explode(";", end(explode(": ", $v))))))) > 0 || !$curl['cookies'][current(explode("=", current(explode(";", end(explode(": ", $v))))))]))
				$curl['cookies'][current(explode("=", current(explode(";", end(explode(": ", $v))))))] = current(explode(";", end(explode(": ", $v)))) . ";";
		return $ret;
	}
	
	function get($url, $data = null, &$curl = null, $header = '')
	{
		if (!is_array($curl['cookies']))
			$curl['cookies'] = array();
		$context = stream_context_create(
			array(
				'http' => array(
				'method'  => 'GET',
				'header'  => "Host: " . current(explode("/", str_replace(array("http://", "https://"), "", $url))) . "\r\n" .
							"Cookie: " . implode(" ", $curl['cookies']) . "\r\n" .
							"User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10\r\n" .
							"Accept-language: en\r\n" . 
							$header,
				'timeout' => 5,
				'proxy'   => ($curl->proxy['ip'] && $curl->proxy['port'])?("tcp://" . $curl->proxy['ip'] . ":" . $curl->proxy['port']):"",
				'max_redirects' => 10
			),
		));
		@$ret = file_get_contents($url . ((count($data) > 0)?"?" . str_replace(array("+", "%2C"), array("%20", ","), http_build_query($data)):""), false, $context);
		//echo $url . ((count($data) > 0)?"?" . str_replace(array("+", "%2C"), array("%20", ","), http_build_query($data)):"");
		$curl['last_page'] = $url;
		foreach ($http_response_header as $k => $v)
			if (stristr($v, "Set-Cookie") > -1 && (strlen(end(explode("=", current(explode(";", end(explode(": ", $v))))))) > 0 || !$curl['cookies'][current(explode("=", current(explode(";", end(explode(": ", $v))))))]))
				$curl['cookies'][current(explode("=", current(explode(";", end(explode(": ", $v))))))] = current(explode(";", end(explode(": ", $v)))) . ";";	
		return $ret;
	}
}