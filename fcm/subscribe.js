const admin = require("firebase-admin");
const mysql = require('mysql2/promise');
const serviceAccount = require("/home/trvvdmle/public_html/todo/fcm/serviceAccountKey.json");
admin.initializeApp({
	credential: admin.credential.cert(serviceAccount)
});
(async() => {
	const connection = await mysql.createConnection({
		host: 'localhost',
		user: 'trvvdmle_account',
		password: 'Sakagamipaopao0628',
		database: 'trvvdmle_account'
	});
	let sql = 'select * from `token` where uid = "' + process.argv[2] + '"';
	let d = [];
	const [row, field] = await connection.execute(sql, d);
	token = row[0].token;
	let sql2 = 'select * from `' + process.argv[2] + '`';
	let e = [];
	const [rows, fields] = await connection.execute(sql2, e);
	topics = [];
	rows.forEach(function (value) {
		topics.push(value.topic);
	});
	const registrationTokens = [
		token
	];
	
	//topics.forEach(function (topic) {
		admin.messaging().subscribeToTopic(registrationTokens, topics).then((response) => {
			console.log('Successfully subscribed to topic:', response);
		}).catch((error) => {
			console.log('Error subscribing to topic:', error);
		});
	//});
	if (connection) {
		connection.end();
	}
})();