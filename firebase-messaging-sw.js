importScripts('https://www.gstatic.com/firebasejs/9.2.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.2.0/firebase-messaging-compat.js');

firebase.initializeApp({
  apiKey: "AIzaSyCooYth-0sWKKjXKKjLtyLEWRviA07lJ4c",
  authDomain: "todo-354303.firebaseapp.com",
  projectId: "todo-354303",
  storageBucket: "todo-354303.appspot.com",
  messagingSenderId: "417337901126",
  appId: "1:417337901126:web:72c0aee41ffc6cb6760a47",
  measurementId: "G-B7GM91NX8C"
});

const messaging = firebase.messaging();


self.addEventListener('push', event => {
    
  const data = event.data.json();
  const title = data.data.title;
  const body = data.data.body;
  const url = data.data.url;
  const icon = "Classroom_icon.png"

  self.registration.showNotification(title, {
    body,
    icon,
    data : { url }
  });
});

self.addEventListener('notificationclick', event => {
    event.waitUntil(self.clients.openWindow(event.notification.data.url));
  event.notification.close();

  
});