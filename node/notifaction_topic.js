exports.notifaction = function (classid_topic, n_title, n_body, n_url) {
	const admin = require("firebase-admin");
	const serviceAccount = require("/home/trvvdmle/public_html/todo/fcm/serviceAccountKey.json");
	if (n_title == undefined) {
		n_title = "通知のタイトル"
	}
	if (n_body == undefined) {
		n_body = "通知の本文%n本文?"
	}
	if (n_url == undefined) {
		n_url = "https://todo.yosshipaopao.com"
	}
	if (admin.apps.length === 0) {
		admin.initializeApp({
			credential: admin.credential.cert(serviceAccount)
		});
	}
	const message = {
		data: {
			title: n_title,
			body: n_body,
			url: n_url,
		},
		topic: classid_topic
	};
	console.log(message)
	// Send a message to devices subscribed to the provided topic.
	admin.messaging().send(message).then((response) => {
		// Response is a message ID string.
		console.log('Successfully sent message:', response);
	}).catch((error) => {
		console.log('Error sending message:', error);
	});
}