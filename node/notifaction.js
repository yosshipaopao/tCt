exports.notifaction = function (n_title, n_body, n_url) {
	if (n_title == undefined) {n_title = "通知のタイトル"}
	if (n_body == undefined) {n_body = "通知の本文%n本文?"}
	if (n_url == undefined) {n_url = "https://todo.yosshipaopao.com"}
	n_body = n_body.replace("%n", '\n');
	var admin = require("firebase-admin");
	var serviceAccount = require("/home/trvvdmle/public_html/todo/node/serviceAccountKey.json");
	if (admin.apps.length === 0) {
		admin.initializeApp({
			credential: admin.credential.cert(serviceAccount)
		});
	}
	const mysql = require('mysql');
	const connection = mysql.createConnection({
		host: 'localhost',
		user: 'trvvdmle_todo',
		password: 'todo-yosshipaopao-jiyujin',
		database: 'trvvdmle_todo'
	});
	var setTokens = new Set();
	connection.connect();
	connection.query("SELECT * FROM `user`", function (error, results, fields) {
		if (error) throw error;
		results.forEach(function (value) {
			setTokens.add(value.token);
		});
		registrationTokens = Array.from(setTokens);
		const message = {
			data: {
				title: n_title,
				body: n_body,
				url: n_url,
			},
			tokens: registrationTokens,
		};
		admin.messaging().sendMulticast(message).then((response) => {
			if (response.failureCount > 0) {
				const failedTokens = [];
				response.responses.forEach((resp, idx) => {
					if (!resp.success) {
						failedTokens.push(registrationTokens[idx]);
					}
				});
				console.log('List of tokens that caused failures: ' + failedTokens);
			}
		});
	});
	connection.end();
}