$album = 'https://vk.com/album-113958919_252151167';
$res = parse_url($album);
$path = substr($res['path'], 6);
$arr = explode('_', $path);
$owner_id = $arr[0];
$album_id = $arr[1];

$standalone = "ваш standalone токен приложения";
$group_token = 'ваш токен группы';
$conf = [
	'standalone' => $standalone,
	'group_token' => $group_token,
	'contorm_token' => 'eae5d4a2',
	'mess' => 'Фото в студио',
	'not_command' => 'Ничего не понял!',
	'owner_id' => $owner_id,
	'album_id' => $album_id,
	'group_id' => '170785666',
	'apiurl' => 'https://api.vk.com/method/',
	'path' => substr($_SERVER['PHP_SELF'], 0, -2),
	'photos' => 'photos.txt',
	'temp_link' => 'temp_album.txt',
	'random_id' => mt_rand(0000000000, 999999999999),
	'v' => '5.50'
];
