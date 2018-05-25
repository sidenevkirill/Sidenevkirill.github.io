package main

import (
	"Organs"
)

func main() {
	groupId := int32(166878888) // id сообщества
	accessToken := "1ba480f143d3243fba526c88a64a7a650e422061352e74adb1e0c91cf374458f266b1c4a4fd3b3322f065" // Ключ доступа
	
	//Строка для подтверждения адреса сервера из настроек Callback API
        $confirmationToken = '7cf2a4e1';

	/* Создаем контекст бота */
	bot := Organs.CreateBot(groupId, accessToken)

	/* Подписка на события о новых сообщения */
	bot.HandleMessageNewFunc(func(message Organs.Message) {
		replyMessage := message.Reply(bot) // Передаем контекст бота
		replyMessage.SetText("О, пришло сообщение")
		replyMessage.Send() // Отправка сообщения
	})

	/* Подписка на события о втуплении в сообщество */
	bot.HandleGroupJoinFunc(func(groupJoin Organs.GroupJoin) {
		replyMessage := bot.Message(groupJoin.UserId) // Генерируем сообщение
		replyMessage.SetText("Спасибо что вступили!")
		replyMessage.Send() // Отправка сообщения
	})
	bot.Listener() // Запускаем бота и получаем события
}
