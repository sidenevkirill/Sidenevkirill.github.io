<?php

if (!isset($_REQUEST)) {
    return;
}

//Строка для подтверждения адреса сервера из настроек Callback API
$confirmationToken = '7cf2a4e1';

//Ключ доступа сообщества
$token = '1ba480f143d3243fba526c88a64a7a650e422061352e74adb1e0c91cf374458f266b1c4a4fd3b3322f065';

// Secret key
$secretKey = 'e910fdb';

//Получаем и декодируем уведомление
$data = json_decode(file_get_contents('php://input'));

// проверяем secretKey
if(strcmp($data->secret, $secretKey) !== 0 && strcmp($data->type, 'confirmation') !== 0)
    return;

//Проверяем, что находится в поле "type"
switch ($data->type) {
    //Если это уведомление для подтверждения адреса сервера...
    case 'confirmation':
        //...отправляем строку для подтверждения адреса
        echo $confirmationToken;
        break;

    //Если это уведомление о новом сообщении...
    case 'message_new':
        //...получаем id его автора
        $userId = $data->object->user_id;
        //затем с помощью users.get получаем данные об авторе
        $userInfo = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$userId}&v=5.0"));

        //и извлекаем из ответа его имя
        $user_name = $userInfo->response[0]->first_name;

        //С помощью messages.send и токена сообщества отправляем ответное сообщение
        $request_params = array(
            'message' => "{$user_name}, я очень рад твоему сообщению!<br>".
                            "Мы постараемся подобрать стикеры в ближайшее время.",
            'user_id' => $userId,
            'access_token' => $token,
            'v' => '5.0'
        );
        
         

        $get_params = http_build_query($request_params);

        file_get_contents('https://api.vk.com/method/messages.send?' . $get_params);

        //Возвращаем "ok" серверу Callback API
        echo('ok');

        break;

    // Если это уведомление о вступлении в группу
    case 'group_join':
        //...получаем id нового участника
        $userId = $data->object->user_id;

        //затем с помощью users.get получаем данные об авторе
        $userInfo = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$userId}&v=5.0"));

        //и извлекаем из ответа его имя
        $user_name = $userInfo->response[0]->first_name;

        //С помощью messages.send и токена сообщества отправляем ответное сообщение
        $request_params = array(
            'message' => "Добро пожаловать в наше сообщество, {$user_name}!<br>" .
                            "Если захочешь получить стикеры, то напиши мне.<br>" .
                            "Их у меня много, но только активные участники их получают<br>" .
                            "Не упусти их!",
            'user_id' => $userId,
            'access_token' => $token,
            'v' => '5.0'
        );

        $get_params = http_build_query($request_params);

        file_get_contents('https://api.vk.com/method/messages.send?' . $get_params);

        //Возвращаем "ok" серверу Callback API
        echo('ok');

        break;
        
          

    // Если это уведомление о выходе из группы
    case 'group_leave':
        //...получаем id ушедшего участника
        $userId = $data->object->user_id;

        //затем с помощью users.get получаем данные об авторе
        $userInfo = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$userId}&v=5.0"));

        //и извлекаем из ответа его имя
        $user_name = $userInfo->response[0]->first_name;

        //С помощью messages.send и токена сообщества отправляем ответное сообщение
        $request_params = array(
            'message' => "{$user_name}, мне очень жаль прощаться с тобой дорогой друг ??<br>" .
                            "Я всегда буду ждать тебя :(<br>" .
                            "Твой бот - https://vk.com/stickertops",
            'user_id' => $userId,
            'access_token' => $token,
            'v' => '5.0'
        );

        $get_params = http_build_query($request_params);

        file_get_contents('https://api.vk.com/method/messages.send?' . $get_params);

        //Возвращаем "ok" серверу Callback API
        echo('ok');

        break;
}
?>
