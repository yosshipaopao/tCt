const admin = require("firebase-admin");

const serviceAccount = require("/home/trvvdmle/public_html/todo/fcm/serviceAccountKey.json");

let n_title = process.argv[3];
let n_body = process.argv[4];
let n_url = process.argv[5];
if(n_title==undefined){n_title="通知のタイトル"}
if(n_body==undefined){n_body="通知の本文%n本文?"}
if(n_url==undefined){n_url="https://todo.yosshipaopao.com"}

console.log(n_title,n_body,n_url)


admin.initializeApp({
  credential: admin.credential.cert(serviceAccount)
});

const topic = process.argv[2];

const message = {
  data: {
    title: n_title,
    body: n_body,
    url : n_url,
  },
  topic: topic
};

// Send a message to devices subscribed to the provided topic.
admin.messaging().send(message)
  .then((response) => {
    // Response is a message ID string.
    console.log('Successfully sent message:', response);
  })
  .catch((error) => {
    console.log('Error sending message:', error);
  });