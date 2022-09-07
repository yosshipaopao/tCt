<?php
require 'vendor/autoload.php';

use Google\Client;
use Google\Service\Classroom;

/**
 * Returns an authorized API client.
 * @return Client the authorized client object
 */
function getClient() {
    $client = new Client();
    $client->setApplicationName('Google Classroom API PHP Quickstart');
    $client->setScopes('https://www.googleapis.com/auth/classroom.courses.readonly');
    $client->setAuthConfig('settings/credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    $tokenPath = 'settings/token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}
$client = getClient();
$service = new Classroom($client);
$courses_list=[];
// Print the first 10 courses the user has access to.
try{
    $optParams = array(
        'studentId' => $email
    );
    $results = $service->courses->listCourses($optParams);

    if (count($results->getCourses()) == 0) {
        print "No courses found.\n";
    } else {
        $i=1;
        foreach ($results->getCourses() as $course) {
            $id = $course->getId();
            printf('<div class="block"><span>%s</span><input type="checkbox" id="%s" name="%s" checked><label for="%s"></label></div><br>'."\n", $course->getName(),$id,$id,$id);
            $i++;
        }
    }
}
catch(Exception $e) {
    // TODO(developer) - handle error appropriately
    echo 'Message: ' .$e->getMessage();
}
?>