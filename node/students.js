const fsp = require('fs').promises;
const readlines = require('readline-sync');
const {google} = require('googleapis');
const SCOPES = ['https://www.googleapis.com/auth/classroom.courses', 'https://www.googleapis.com/auth/classroom.courses.readonly', 'https://www.googleapis.com/auth/classroom.rosters', 'https://www.googleapis.com/auth/classroom.coursework.me', 'https://www.googleapis.com/auth/classroom.coursework.students', 'https://www.googleapis.com/auth/classroom.announcements'];

const TOKEN_PATH = 'token.json';

async function authorize(credentials) {
	const {
		client_secret,
		client_id,
		redirect_uris
	} = credentials.installed;
	const oAuth2Client = new google.auth.OAuth2(client_id, client_secret, redirect_uris[0]);
	try {
		const token = await fsp.readFile(TOKEN_PATH);
		oAuth2Client.setCredentials(JSON.parse(token));
		return oAuth2Client;
	} catch (err) {
		return getNewToken(oAuth2Client);
	}
}
/**
 * 多分ぶっ壊れてる
 */
async function getNewToken(oAuth2Client) {
	const authUrl = oAuth2Client.generateAuthUrl({
		access_type: 'offline',
		scope: SCOPES,
	});
	console.log('Authorize this app by visiting this url:', authUrl);
	const code = readlines.question('Enter the code from that page here: ');
	try {
		const token = await oAuth2Client.getToken(code);
		oAuth2Client.setCredentials(token);
		await fsp.writeFile(TOKEN_PATH, JSON.stringify(token))
		console.log('Token stored to', TOKEN_PATH);
	} catch (err) {
		return console.error('Error retrieving access token', err);
	}
}
var data = [];
(async () => {
    var uid = await process.argv[2];
    console.log(uid)
    const content = await fsp.readFile('credentials.json');
    console.log(uid)
    const auth = await authorize(JSON.parse(content));
    const classroom = google.classroom({version: 'v1',auth});
    //try {
        
		const courses = await classroom.courses.list({courseStates: 'ACTIVE',studentId: uid,});
		const course = courses.data.courses;
		for (let cour of course) {
		    data.push([cour.id,cour.name]);
		}
		//console.log(course)
	//} catch (err) {
	//	return console.error('The API returned an error: ' + err);
	//}
    
})()

