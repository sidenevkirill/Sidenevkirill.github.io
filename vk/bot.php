require "config.php";
$data = json_decode(file_get_contents('php://input'));
$u_id = $data->object->user_id;
$mess = $data->object->body;

$user_info = json_decode(file_get_contents($conf['apiurl'].'users.get?user_id='.$u_id.'&v='.$conf['v'].'&access_token='.$conf['standalone']));
$user_name = $user_info->response[0]->first_name;

$temp_link = file($conf['temp_link']);
if($temp_link[0] != $album) {
	file_put_contents($conf['temp_link'], $album);
	require "photos.php";
	return true;
}

switch($data->type) {
	case 'confirmation':
		echo $conf['contorm_token'];
		break;
	case "message_new":
		if($mess == $conf['mess']) {
			$file = file_get_contents($conf['photos']);
			$photos_all = explode("\n", $file);
			
			$myCurl = curl_init();
			curl_setopt_array($myCurl, array(
				CURLOPT_URL => $conf['apiurl'].'messages.send?user_id='.$u_id.'&group_id='.$conf['group_id'].'&attachment='.$photos_all[mt_rand(0, count($photos_all) - 1)].'&message='.urlencode('Держи свое фото').'&v='.$conf['v'].'&access_token='.$conf['standalone'],
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => http_build_query(array())
			));
			$response = curl_exec($myCurl);
			curl_close($myCurl);
		} else {
			$myCurl = curl_init();
			curl_setopt_array($myCurl, array(
				CURLOPT_URL => $conf['apiurl'].'messages.send?user_id='.$u_id.'&group_id='.$conf['group_id'].'&message='.urlencode($conf['not_command']).'&v='.$conf['v'].'&access_token='.$conf['standalone'],
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => http_build_query(array())
			));
			$response = curl_exec($myCurl);
			curl_close($myCurl);
		}
		echo 'ok';
		break;
}
