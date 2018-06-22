<?php
	include('conf/src/simple_html_dom/simple_html_dom.php');

	function random_strings ($length) {
		$string = "";
		$character_sets = array_merge(range('A','Z'), range('a','z'), range('0','9'));
		$max = count($character_sets) - 1;
		for ($i = 0; $i <= $length; $i++) {
			$rand = mt_rand(0, $max);
			$string .= $character_sets[$rand];
		}
		return($string);
	}

	function anti_injection($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = htmlentities($data);
		return $data;
	}

	function disguise_curl($url) {
		$curl = curl_init();
		$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
		$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
		$header[] = "Cache-Control: max-age=0";
		$header[] = "Connection: keep-alive";
		$header[] = "Keep-Alive: 300";
		$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
		$header[] = "Accept-Language: en-us,en;q=0.5";
		$header[] = "Pragma: "; // browsers keep this blank.

		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_USERAGENT, 'Googlebot/2.1 (+http://www.google.com/bot.html)');
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($curl, CURLOPT_REFERER, 'http://www.google.com');
		curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate');
		curl_setopt($curl, CURLOPT_AUTOREFERER, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

		$html = curl_exec($curl); // execute the curl command
		curl_close($curl);
		return $html;
	}

	function view_short_link($id) {
		include("connection.php");
		$id = anti_injection($id);
		$short = array();
		$qry = mysql_query("SELECT * FROM short WHERE short_id='$id'");
		if (mysql_num_rows($qry) === 1) {
			while ($row = mysql_fetch_assoc($qry)) {
				$short["short_id"] = $row["short_id"];
				$short["short_url"] = $row["short_url"];
				$short["short_slug"] = $row["short_slug"];
				$short["short_title"] = $row["short_title"];
				$short["short_keyword"] = $row["short_keyword"];
				$short["short_description"] = $row["short_description"];
				$short["short_content"] = $row["short_content"];
				$short["short_date"] = $row["short_date"];
				$short["short_time"] = $row["short_time"];
				$short["short_privacy"] = $row["short_privacy"];
				$short["short_password"] = $row["short_password"];
			}
		}
		mysql_close();
		return $short;
	}

	function get_content($content,$start,$end){
	    $r = explode($start, $content);
	    if (isset($r[1])){
	        $r = explode($end, $r[1]);
	        return $r[0];
	    }
	    return "";
	}

	function go_gurisa_config($config) {
		include("connection.php");
		$sql = mysql_query("SELECT config_value FROM config WHERE config_id='".$config."'");
		$go_config = mysql_fetch_row($sql);
		mysql_close();
		return $go_config[0];
	}

	function go_gurisa_pages($page_id) {
		include("connection.php");
		$query = mysql_query("SELECT page_content FROM page WHERE page_id='".$page_id."'");
		$go_pages = mysql_fetch_row($query);
		mysql_close();
		return $go_pages[0];
	}

	function get_page_part($page, $methods, $times) {
    if ($methods == 'include') {
			$result = include($page);
			if ($times == 'once') {
				$result = include_once($page);
			}
    }
    else if ($methods == 'required') {
			$result = required($page);
			if ($times == 'once') {
				$result = required_once($page);
			}
    }
    else {
			$result = include($page);
			if ($times == 'once') {
				$result = include_once($page);
			}
    }
    return $result;
  }

	function get_home_page() {
		$currentPath = $_SERVER['PHP_SELF'];
		$pathInfo = pathinfo($currentPath);
		$hostName = $_SERVER['HTTP_HOST'];
		$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
		$home_page = $protocol . $hostName . $pathInfo['dirname'] . "/";
		return $home_page;
	}

	function check_short_links() {
		include("connection.php");
		$result =	false;
		$qry = mysql_query("SELECT * FROM short WHERE short_privacy='PUBLIC' LIMIT 0,1");
		if (mysql_num_rows($qry) > 0) {
			$result =	true;
		}
		mysql_close();
		return $result;
	}

	function get_short_links() {
		include("connection.php");
		$shorts = array();
		$qry = mysql_query("SELECT * FROM short WHERE short_privacy='PUBLIC' ORDER BY short_date, short_time DESC LIMIT 0,5 ");
		if (mysql_num_rows($qry) > 0) {
			while ($row = mysql_fetch_assoc($qry)) {
				$shorts[] = $row;
			}
		}
		mysql_close();
		return $shorts;
	}

	function has_thumbnails($id) {
		include("connection.php");
		$id = anti_injection($id);
		$result = false;
		$qry = mysql_query("SELECT thumbnail_url FROM thumbnail WHERE short_id='$id'");
		if (mysql_num_rows($qry) > 0) {
			$result = true;
		}
		mysql_close();
		return $result;
	}

	function get_thumbnails($id) {
		include("connection.php");
		$id = anti_injection($id);
		$thumbnails = array();
		$qry = mysql_query("SELECT thumbnail_url FROM thumbnail WHERE short_id='$id'");
		if (mysql_num_rows($qry) > 0) {
			while ($row = mysql_fetch_assoc($qry)) {
				$thumbnails[] = $row;
			}
		}
		mysql_close();
		return $thumbnails;
	}

	function has_password($id) {
		include("connection.php");
		$id = anti_injection($id);
		$result = false;
		$qry = mysql_query("SELECT short_password FROM short WHERE short_id='$id'");
		if (mysql_num_rows($qry) === 1) {
			if ($row = mysql_fetch_assoc($qry)) {
				if (isset($row["short_password"]) && !empty($row["short_password"]) && !$row["short_password"] == null) {
					$result = true;
				}
			}
		}
		mysql_close();
		return $result;
	}

	function check_password($id, $confirm_password) {
		include("connection.php");
		$id = anti_injection($id);
		$confirm_password = anti_injection($confirm_password);
		$result = false;
		$qry = mysql_query("SELECT short_password FROM short WHERE short_id='$id'");
		if (mysql_num_rows($qry) === 1) {
			if ($row = mysql_fetch_assoc($qry)) {
				if ($row["short_password"] == $confirm_password) {
					$result = true;
				}
			}
		}
		mysql_close();
		return $result;
	}

	function get_short_id() {
		include("connection.php");
		$id = random_strings(1);
		$short_id = array();
		$result = false;
		$sql = mysql_query("SELECT short_id FROM short");
		if ($sql) {
			while ($row = mysql_fetch_assoc($sql)) {
				$short_id[] = $row;
			}
			for ($i = 0; $i < count($short_id); $i++) {
				if ($short_id[$i] == $id) {
					$id = random_strings(1);
					$i--;
				}
			}
		}
		mysql_close();
		return $id;
	}

	function validate_url($url) {
		$url = filter_var($url, FILTER_SANITIZE_URL);
		if (filter_var($url, FILTER_VALIDATE_URL) === false) {
			$url = "http://" . $url;
		}
		return $url;
	}

	function short_link($link, $post_privacy, $post_password) {
		$link = validate_url($link);
		$title = "";
		$keywords = "";
		$description = "";
		$content = "";
		$default = go_gurisa_config("WSNAME") . " - " . $link;
		$content_result = disguise_curl($link);

		if (preg_match('/<title.*?>(.*?)<\/title>/is', $content_result, $match)) {
			if (isset($match[1]) && !empty($match[1]) && !$match[1] == "") {
				$title = anti_injection($match[1]);
			}
			else {
				$title = $default;
			}
		}
		else {
			$title = $default;
		}

		if (preg_match('/<meta.*?name=["|\']description["|\'].*?content=["|\'](.*?)["|\'].*?>/is', $content_result, $match)) {
			if ($match[1] == null) {
				$description = $default;
			}
			else {
				$description = anti_injection($match[1]);
			}
		}
		else if (preg_match('/<meta.*?content=["|\'](.*?)["|\'].*?name=["|\']description["|\'].*?>/is', $content_result, $match)) {
			if ($match[1] == null) {
				$description = $default;
			}
			else {
				$description = anti_injection($match[1]);
			}
		}
		else if (preg_match('/<meta.*?property=["|\']og:description["|\'].*?content=["|\'](.*?)["|\'].*?>/is', $content_result, $match)) {
			if ($match[1] == null) {
				$description = $default;
			}
			else {
				$description = anti_injection($match[1]);
			}
		}
		else if (preg_match('/<meta.*?content=["|\'](.*?)["|\'].*?property=["|\']og:description["|\'].*?>/is', $content_result, $match)) {
			if ($match[1] == null) {
				$description = $default;
			}
			else {
				$description = anti_injection($match[1]);
			}
		}
		else {
			$description = $default;
		}

		if (preg_match('/<meta.*?name=["|\']keywords["|\'].*?content=["|\'](.*?)["|\'].*?>/is', $content_result, $match)) {
			if ($match[1] == null) {
				$keywords = $default;
			}
			else {
				$keywords = anti_injection($match[1]);
			}
		}
		else if (preg_match('/<meta.*?content=["|\'](.*?)["|\'].*?name=["|\']keywords["|\'].*?>/is', $content_result, $match)) {
			if ($match[1] == null) {
				$keywords = $default;
			}
			else {
				$keywords = anti_injection($match[1]);
			}
		}
		else if (preg_match('/<meta.*?property=["|\']og:keywords["|\'].*?content=["|\'](.*?)["|\'].*?>/is', $content_result, $match)) {
			if ($match[1] == null) {
				$keywords = $default;
			}
			else {
				$keywords = anti_injection($match[1]);
			}
		}
		else if (preg_match('/<meta.*?content=["|\'](.*?)["|\'].*?property=["|\']og:keywords["|\'].*?>/is', $content_result, $match)) {
			if ($match[1] == null) {
				$keywords = $default;
			}
			else {
				$keywords = anti_injection($match[1]);
			}
		}
		else {
			$keywords = $default;
		}

		$content_result_method_3 = file_get_html($link);
		$content = $content_result_method_3->plaintext;
		if (!$content) {
			$content = $default;
		}
		if (!preg_match('/^[a-zA-Z ]*$/is', $content, $match)) {
			$content = str_replace('"', '', $content);
			$content = str_replace("'", '', $content);
		}

		date_default_timezone_set("Asia/Jakarta");
		$date = date("Y-m-d");
		$time = date("H:i:s");

		include("connection.php");
		$link = anti_injection($link);
		$title = anti_injection($title);
		$keywords = anti_injection($keywords);
		$description = anti_injection($description);
		$content = anti_injection($content);
		$privacy = $post_privacy;
		$password = $post_password;
		if (!isset($privacy) && empty($privacy)) {
			$privacy = "PUBLIC";
		}
		if (!isset($password) && empty($password)) {
			$password = null;
		}
		$sql = mysql_query("INSERT INTO short (short_id,short_url,short_slug,short_title,short_keyword,short_description,short_content,short_date,short_time,short_privacy,short_password) VALUES ('','$link','','$title','$keywords','$description','$content','$date','$time','$privacy','$password')") or die (mysql_error());
		if ($sql) {
			$short_id = mysql_insert_id();
			mysql_close();
			include("connection.php");
			/*
			$i = 1;
			foreach ($content_result_method_3->find('img') as $image_url) {
				if ((preg_match('/.*?src=["|*?|\'][\/\/|*?](.*?)["|*?|\'].*?/is', $image_url, $match)) || (preg_match('/.*?src=["|*?|\'](.*?)["|*?|\'].*?/is', $image_url, $match))) {
					//Jika Relative Path
					if (preg_match('/[\/.*?](.*)/is', $match[1], $match_2)) {
						$match[1] = $match_2[1];
					}
					//Periksa Ketersediaan Gambar Sebelum Dimasukan Ke Database
					$sql_thumbnail = mysql_query("INSERT INTO thumbnail (thumbnail_url,short_id) VALUES ('$match[1]','$short_id')") or die (mysql_error());
					if ($sql_thumbnail) {
						if ($i <= 5) {
							echo $match[1] . "<br />";
							$i++;
						}
					}
				}
			}
			*/
			mysql_close();
			$home = get_home_page();
			$result =  $short_id;
		}
		else {
			$result = "ERROR";
		}
		return $result;
	}

?>
