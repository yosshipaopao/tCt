<?php
require("settings/head.php");
?>
<style>
    @import url( 'https://fonts.googleapis.com/css?family=Roboto+Condensed:700&subset=cyrillic');
.block input {
    display: none;
}
.block {
    width: auto;
    position: relative;
    clear: both;
    margin: 0 0 25px;
    float: left;
}
.block span {
    text-transform: uppercase;
    font-family: 'Roboto Condensed', sans-serif;
    font-weight: bold;
    letter-spacing: 1px;
    font-size: 30px;
    float: right;
    width: auto;
    margin: 2px 10px 0;
}
.block label {
    width: 100px;
    height: 50px;
    box-sizing: border-box;
    border: 3px solid;
    float: left;
    border-radius: 100px;
    position: relative;
    cursor: pointer;
    transition: 0.3s ease;
}
input[type=checkbox]:checked + label {
    background: #55e868;
}
input[type=checkbox]:checked + label:before {
    left: 50px;
}
.block label:before {
    transition: 0.3s ease;
    content: '';
    width: 40px;
    height: 40px;
    position: absolute;
    background: white;
    left: 2px;
    top: 2px;
    box-sizing: border-box;
    border: 3px solid;
    color: black;
    border-radius: 100px;
}
</style>
    <form name="form" action="" method="post">
    <input type="hidden" name="token" value="">
    <!--ああああああああああああ-->
    <div style="display: inline-block;">
    <?php
    require "settings/classroom.php";
    ?>
    </div>
    <br>
    <div style="display: block;">
    <input id="submit" type="submit" disabled></form>
    </div>
    </form>
    <!-- div to display the generated registration token -->
          <div id="token_div" style="display: none;">
            <p id="token" style="word-break: break-all;"></p>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"
                    onclick="deleteToken()">Delete Token</button>
          </div>
          <!-- div to display the UI to allow the request for permission to
               notify the user. This is shown if the app has not yet been
               granted permission to notify. -->
          <div id="permission_div" style="display: none;">
            <h4>Needs Permission</h4>
            <p id="token"></p>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"
                    onclick="requestPermission()">Request Permission</button>
          </div>
          <!-- div to display messages received by this app. -->
          <div id="messages"></div>
          <script src="https://www.gstatic.com/firebasejs/9.8.3/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.8.3/firebase-firestore-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.8.3/firebase-auth-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.8.3/firebase-messaging-compat.js"></script>

<script>
  firebase.initializeApp({
    apiKey: "AIzaSyCooYth-0sWKKjXKKjLtyLEWRviA07lJ4c",
    authDomain: "todo-354303.firebaseapp.com",
    projectId: "todo-354303",
    storageBucket: "todo-354303.appspot.com",
    messagingSenderId: "417337901126",
    appId: "1:417337901126:web:72c0aee41ffc6cb6760a47",
    measurementId: "G-B7GM91NX8C"
  });
  
  // Retrieve Firebase Messaging object.
  const messaging = firebase.messaging();

  // IDs of divs that display registration token UI or request permission UI.
  const tokenDivId = 'token_div';
  const permissionDivId = 'permission_div';

  // Handle incoming messages. Called when:
  // - a message is received while the app has focus
  // - the user clicks on an app notification created by a service worker
  //   `messaging.onBackgroundMessage` handler.
  messaging.onMessage((payload) => {
    console.log('Message received. ', payload);
    // Update the UI to include the received message.
    appendMessage(payload);
  });

  function resetUI() {
    clearMessages();
    showToken('loading...');
    // Get registration token. Initially this makes a network call, once retrieved
    // subsequent calls to getToken will return from cache.
    messaging.getToken({ vapidKey: "BJmrwq8HIkhjFxZncreBAJLGDjVjQG7SBS5CaRf2wwpB7Z0Aa9rw-7vFLyUCsebtTw0ne1N_2yBLLGAclymD47Y" }).then((currentToken) => {
      if (currentToken) {
        sendTokenToServer(currentToken);
        updateUIForPushEnabled(currentToken);
      } else {
        // Show permission request.
        console.log('No registration token available. Request permission to generate one.');
        // Show permission UI.
        updateUIForPushPermissionRequired();
        setTokenSentToServer(false);
      }
    }).catch((err) => {
      console.log('An error occurred while retrieving token. ', err);
      showToken('Error retrieving registration token. ', err);
      setTokenSentToServer(false);
    });
  }


  function showToken(currentToken) {
    const tokenElement = document.querySelector('#token');
    tokenElement.textContent = currentToken;
      document.forms.form.token.value = currentToken;
      document.getElementById("submit").disabled = false;
      setTokenSentToServer(true);
  }

  function sendTokenToServer(currentToken) {
    if (!isTokenSentToServer()) {
      console.log('Sending token to server...');
      console.log(currentToken);
      document.forms.form.token.value = currentToken;
      document.getElementById("submit").disabled = false;
      setTokenSentToServer(true);
    } else {
      console.log('Token already sent to server so won\'t send it again ' +
          'unless it changes');
    }
  }

  function isTokenSentToServer() {
    return window.localStorage.getItem('sentToServer') === '1';
  }

  function setTokenSentToServer(sent) {
    window.localStorage.setItem('sentToServer', sent ? '1' : '0');
  }

  function showHideDiv(divId, show) {
    const div = document.querySelector('#' + divId);
    if (show) {
      div.style = 'display: visible';
    } else {
      div.style = 'display: none';
    }
  }

  function requestPermission() {
    console.log('Requesting permission...');
    Notification.requestPermission().then((permission) => {
      if (permission === 'granted') {
        console.log('Notification permission granted.');
        // TODO(developer): Retrieve a registration token for use with FCM.
        // In many cases once an app has been granted notification permission,
        // it should update its UI reflecting this.
        resetUI();
      } else {
        console.log('Unable to get permission to notify.');
      }
    });
  }

  function deleteToken() {
    // Delete registration token.
    messaging.getToken().then((currentToken) => {
      messaging.deleteToken(currentToken).then(() => {
        console.log('Token deleted.');
        setTokenSentToServer(false);
        // Once token is deleted update UI.
        resetUI();
      }).catch((err) => {
        console.log('Unable to delete token. ', err);
      });
    }).catch((err) => {
      console.log('Error retrieving registration token. ', err);
      showToken('Error retrieving registration token. ', err);
    });
  }

  // Add a message to the messages element.
  function appendMessage(payload) {
    const messagesElement = document.querySelector('#messages');
    const dataHeaderElement = document.createElement('h5');
    const dataElement = document.createElement('pre');
    dataElement.style = 'overflow-x:hidden;';
    dataHeaderElement.textContent = 'Received message:';
    dataElement.textContent = JSON.stringify(payload, null, 2);
    messagesElement.appendChild(dataHeaderElement);
    messagesElement.appendChild(dataElement);
  }

  // Clear the messages element of all children.
  function clearMessages() {
    const messagesElement = document.querySelector('#messages');
    while (messagesElement.hasChildNodes()) {
      messagesElement.removeChild(messagesElement.lastChild);
    }
  }

  function updateUIForPushEnabled(currentToken) {
    showHideDiv(tokenDivId, true);
    showHideDiv(permissionDivId, false);
    showToken(currentToken);
  }

  function updateUIForPushPermissionRequired() {
    showHideDiv(tokenDivId, false);
    showHideDiv(permissionDivId, true);
  }

  resetUI();
</script>
<?php
require("settings/foot.php");
?>