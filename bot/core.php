<?
class bot_vk {
 const v = '5.0';
 const METHOD_URL = 'https://api.vk.com/method/';
 const v_bot = '1.0';
 function __construct($settings) {
  $this->settings = (object) $settings;
 }
 public function start() {
  global $settings, $body, $user_id;
  switch ($settings->data->type) {
   case 'confirmation': 
    echo $settings->confirmation_token; 
   break;
   case 'message_new':
    $get = $this->api('messages.get', [
     'count' => 1,
     'access_token' => $settings->token 
    ]);
    if($get->response[1]->read_state == 0) {
     $oot = $settings->data->object->attachments;
     $user_id = $settings->data->object->user_id;
     $body_mess = mb_strtolower($settings->data->object->body);
     $body = explode(' ', $body_mess);
     if($body[0] == '/commands' || $body[0] == '/cmd' || $body[0] == '/команды') {
      $this->send_message("Список доступных команд ".$this->random(['⁣💜⁣🔥', '⁣⁣💙⁣🔥'])."\n/commands \n/music \n/fact \n/saved \n/utter \n/update \n/advice \n/wiki \n/help \n/news");
     } else {
      $this->send_message($this->random(['⁣💜⁣🔥', '⁣⁣💙⁣🔥']));
     }
    }
    echo('ok'); 
   break;
   case 'group_join':
    $info = $this->api('users.get', ['user_ids' => $settings->data->object->user_id]);
    $this->send_message($info->response[0]->first_name.', спасибо за подписку '.$this->random(['⁣💜⁣🔥', '⁣⁣💙⁣🔥']));
   break;
   default: echo('ok');
  }
 }
 public function random($array) {
  return $array[mt_rand(0, count($array)-1)];
 }
 public function api($method, $param) {
  return json_decode($this->curl('https://api.vk.com/method/'.$method, $param));
 }
 public function send_message($message, $attach = null) {
  global $settings, $user_id;
  return $this->api('messages.send', [
   'message' => $message,
   'attachment' => $attach,
   'user_id' => $user_id,
   'access_token' => $settings->token,
   'v' => self::v
  ]);
 }
 public function curl($url, $post = null) {
  if(is_array($post)) $url .= '?'.http_build_query($post);
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  if($post) {
   curl_setopt($ch, CURLOPT_POST, 1); 
   curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
  }
  $response = curl_exec($ch);
  curl_close($ch);
  return $response;
 }
}
?>
