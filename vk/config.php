$album = 'https://vk.com/album-157337613_252902419';
$res = parse_url($album);
$path = substr($res['path'], 6);
$arr = explode('_', $path);
$owner_id = $arr[0];
$album_id = $arr[1];

$standalone = "4182274a27f6e4212f42408b857322f00fb3ff8d79fde8917cca747d6d572f310cafb9676f5c7ab6639f0";
$group_token = '267b03db95bbbb8285d85c10ee3d3d1efbdeb163bad49782e93c0343a2965c276c4e637e36b90e02cc271';
$conf = [
	'standalone' => $standalone,
	'group_token' => $group_token,
	'contorm_token' => '732be0d8',
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
