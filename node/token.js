const fs = require('fs');
const readline = require('readline');
const {google} = require('googleapis');
const mysql = require('mysql');
const connection = mysql.createConnection({
	host: 'localhost',
	user: 'trvvdmle_todo',
	password: 'todo-yosshipaopao-jiyujin',
	database: 'trvvdmle_todo'
});
// If modifying these scopes, delete token.json.
const SCOPES = [
	'https://www.googleapis.com/auth/classroom.courses',
	'https://www.googleapis.com/auth/classroom.courses.readonly',
	'https://www.googleapis.com/auth/classroom.rosters',
	'https://www.googleapis.com/auth/classroom.coursework.me',
	'https://www.googleapis.com/auth/classroom.coursework.students',
	'https://www.googleapis.com/auth/classroom.announcements',
	'https://www.googleapis.com/auth/classroom.profile.emails',
  'https://www.googleapis.com/auth/classroom.profile.photos',
  'https://www.googleapis.com/auth/classroom.rosters',
  'https://www.googleapis.com/auth/classroom.rosters.readonly',
];
// The file token.json stores the user's access and refresh tokens, and is
// created automatically when the authorization flow completes for the first
// time.
const TOKEN_PATH = 'token.json';
var courses_index = [];
fs.readFile('credentials.json', (err, content) => {
	if (err) return console.log('Error loading client secret file:', err);
	// Authorize a client with credentials, then call the Google Classroom API.
	authorize(JSON.parse(content), listWorks);
});
/**
 * Create an OAuth2 client with the given credentials, and then execute the
 * given callback function.
 * @param {Object} credentials The authorization client credentials.
 * @param {function} callback The callback to call with the authorized client.
 */
function authorize(credentials, callback) {
	const {
		client_secret,
		client_id,
		redirect_uris
	} = credentials.installed;
	const oAuth2Client = new google.auth.OAuth2(client_id, client_secret, redirect_uris[0]);
	// Check if we have previously stored a token.
	fs.readFile(TOKEN_PATH, (err, token) => {
		if (err) return getNewToken(oAuth2Client, callback);
		oAuth2Client.setCredentials(JSON.parse(token));
		callback(oAuth2Client);
	});
}
/**
 * Get and store new token after prompting for user authorization, and then
 * execute the given callback with the authorized OAuth2 client.
 * @param {google.auth.OAuth2} oAuth2Client The OAuth2 client to get token for.
 * @param {getEventsCallback} callback The callback for the authorized client.
 */
function getNewToken(oAuth2Client, callback) {
	const authUrl = oAuth2Client.generateAuthUrl({
		access_type: 'offline',
		scope: SCOPES,
	});
	console.log('Authorize this app by visiting this url:', authUrl);
	const rl = readline.createInterface({
		input: process.stdin,
		output: process.stdout,
	});
	rl.question('Enter the code from that page here: ', (code) => {
		rl.close();
		oAuth2Client.getToken(code, (err, token) => {
			if (err) return console.error('Error retrieving access token', err);
			oAuth2Client.setCredentials(token);
			// Store the token to disk for later program executions
			fs.writeFile(TOKEN_PATH, JSON.stringify(token), (err) => {
				if (err) return console.error(err);
				console.log('Token stored to', TOKEN_PATH);
			});
			callback(oAuth2Client);
		});
	});
}
///////////
//?????????
//////////
function listCoursesWork(Classroom, courseId) {
	//?????????id??????id,????????????,??????,url,?????????(????????????)
	//return?????????:[[id],[????????????],[??????],[url],[?????????]]
	var worksList = [];
	var titles = [];
	var urls = [];
	var times = [];
	var descriptions = [];
	//Api???????????????
	const course = Classroom.Courses.CourseWork.list(courseId).courseWork;
	//??????????????????????????????????????????
	if (course != null) {
		//?????????push
		for (let works of course) {
			let list = works.id;
			worksList.push(list);
			titles.push(works.title);
			urls.push(works.alternateLink);
			times.push(works.updateTime);
			descriptions.push(works.description);
		}
	}
	return [worksList, titles, descriptions, urls, times];
}
//////////
///???????????????
//////////
function main(auth) {
	const classroom = google.classroom({
		version: 'v1',
		auth
	});
	classroom.courses.list((err, res) => {
		if (err) return console.error('The API returned an error: ' + err);
		const courses = res.data.courses;
		if (courses && courses.length) {
			courses.forEach((course) => {
				var course_id = course.id;
                  classroom.Courses.coursework.list(courseId,(errw,resw => {
                      const works = resw.data.works;
                      works.forEach((work) => {
                          console.log(work);
                      });
                    
                
                  }));
        
				
				
				
			});
		} else {
			console.log('No courses found.');
		}
	});
}
/**
 * Lists the first 10 courses the user has access to.
 *
 * @param {google.auth.OAuth2} auth An authorized OAuth2 client.
 */
function listCourses(auth) {
	const classroom = google.classroom({
		version: 'v1',
		auth
	});
	classroom.courses.list({
		pageSize: 10,
	}, (err, res) => {
		if (err) return console.error('The API returned an error: ' + err);
		const courses = res.data.courses;
		if (courses && courses.length) {
			console.log('Courses:');
			courses.forEach((course) => {
				console.log(`${course.name} (${course.id})`);
			});
		} else {
			console.log('No courses found.');
		}
	});
}

function listWorks(auth) {
	const classroom = google.classroom({
		version: 'v1',
		auth
	});
	classroom.courseWork.list('389603622179',{
		pageSize: 10,
	}, (err, res) => {
		if (err) return console.error('The API returned an error: ' + err);
		const courses = res.data.works;
		if (courses && courses.length) {
			console.log('Courses:');
			courses.forEach((course) => {
				console.log(`${course.title} (${course.id})`);
			});
		} else {
			console.log('No courses found.');
		}
	});
}

function listCoursesaa(auth) {
	const classroom = google.classroom({
		version: 'v1',
		auth
	});
	//????????????id,????????????,url??????????????????
	//returun?????????:[[id],[????????????],[url]]
	var courselist = [];
	var titles = [];
	var urls = [];
	//Api???????????????????????????
	classroom.courses.list({}, (err, res) => {
		if (err) return console.error('The API returned an error: ' + err);
		const courses = res.data.courses;
		for (var course of courses) {
			courselist.push(course.id);
			titles.push(course.name);
			urls.push(course.alternateLink)
		}
		//console.log([courselist,titles,urls])
		courses_index = [courselist, titles, urls];
	});
	//?????????????????????
	//console.log([courselist,titles,urls]);
	//return [courselist,titles,urls];
}