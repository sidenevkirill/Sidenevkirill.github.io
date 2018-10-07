<? PHP

define ('YANDEX_API_ENDPOINT', 'https://tts.voicetech.yandex.net/generate');

функция yandexApi_getVoice ($ text) {
  $ file_name = BOT_AUDIO_DIRECTORY. '/ audio _'. md5 ($ text). '. ogg';
  if (file_exists ($ file_name)) {
    return $ file_name;
  }

  $ file_handler = fopen ($ file_name, 'w +');

  $ query = http_build_query (массив (
    'format' => 'opus',
    'lang' => 'ru-RU',
    'speaker' => 'jane',
    'key' => YANDEX_API_KEY,
    «эмоция» => «хорошая»,
    'text' => $ text,
  ));

  $ url = YANDEX_API_ENDPOINT. '?'. $ query;

  $ curl_handler = curl_init ($ url);
  curl_setopt ($ curl_handler, CURLOPT_FILE, $ file_handler);
  curl_exec ($ curl_handler);

  $ error = curl_error ($ curl_handler);
  if ($ error) {
    log_error ($ ошибка);
    throw new Exception ("Ошибка {$ url} запрос");
  }

  curl_close ($ curl_handler);
  fclose ($ записи file_handler);

  return $ file_name;
}
