<?php
require_once('core.php');
$settings = (object) [
 'confirmation_token' => 'd0c2df8b', 
 'token' => 'e92e5fbaa553fb6fb8fd6c466b62046cdc9a45cf2fe0c00143d92ca16ee5f2168d0bd97e6dae96a34e4fd',
 'utoken' => '91817962',
 'data' => json_decode(file_get_contents('php://input'))
];
$vk = new bot_vk($settings);
$vk->start();
?>
