const fsp = require('fs').promises;
const readlines = require('readline-sync');
const {google} = require('googleapis');

const SCOPES = [
	'https://www.googleapis.com/auth/classroom.courses',
	'https://www.googleapis.com/auth/classroom.courses.readonly',
	'https://www.googleapis.com/auth/classroom.rosters',
	'https://www.googleapis.com/auth/classroom.coursework.me',
	'https://www.googleapis.com/auth/classroom.coursework.students',
	'https://www.googleapis.com/auth/classroom.announcements'
];

const mysql = require('mysql2/promise');

const TOKEN_PATH = 'token.json';

//メイン関数
async function setup_table() {
	const connection = await mysql.createConnection(
        {
          	host: 'localhost',
        	user: 'trvvdmle_classroom',
        	password: 'classroom-yosshipaopao-jiyujin',
        	database: 'trvvdmle_classroom'
        }
        );
	try{
    	const content = await fsp.readFile('credentials.json');
    	const func_auth = await authorize(JSON.parse(content));
    	const courses = await listCourses(func_auth);
    	var li_courses = [];
    	var results = await connection.query('SELECT * FROM class')
	    var result = []
	    results.forEach((res)=>{result.push(res.id)})
	    console.log(result)
	    
	    const sql_check = "SELECT * FROM `class` WHERE `id`=?"
    	const sql_crclass = "INSERT INTO `class` (`id`) VALUES (?)";
    	const sql_crtable = "CREATE TABLE `trvvdmle_classroom`.`?` ( `workid` BIGINT NULL , `anoid` BIGINT NULL ) ENGINE = InnoDB;";
    	const sql_drop = "DROP TABLE `?`"
    	for(let course of courses){
    	    const [result, fields] = await connection.query(sql_check, course.id);
    	    console.log("course")
    	    
    	    if(result.length == 0){
    	        console.log(course.id)
    	        const [res_cl, fie_cl] = await connection.query(sql_crclass, course.id);
    	        const [res_ta, fie_ta] = await connection.query(sql_crtable, course.id);
    	        const Works = await listWorks(func_auth, course.id,5);
    	        const Ano = await listAno(func_auth, course.id,5);
    	        
    	        if (Works && Works.length) {
    	            var work_ids = [];
    	            var sql_work = "INSERT INTO `?` (`workid`) VALUES ";
    	            for(let work of Works){
    	                work_ids.push(work.id);
    	                sql_work += "('"+work.id+"'),"; 
    	            }
    	            console.log(await connection.format(sql_work.slice( 0, -1 ),course.id));
    	            const [res_wo, fie_wo] = await connection.query(sql_work.slice( 0, -1 ),course.id);
    	        }
    	        if (Ano && Ano.length) {
    	            var ano_ids = [];
    	            var sql_ano = "INSERT INTO `?` (`anoid`) VALUES ";
    	            for(let An of Ano){
    	                ano_ids.push(An.id);
    	                sql_ano += "('"+An.id+"'),"; 
    	            }
    	            console.log(await connection.format(sql_ano.slice( 0, -1 ),course.id));
    	            const [res_ano, fie_ano] = await connection.query(sql_ano.slice( 0, -1 ),course.id);
    	        }
    	    }
    	}
	}catch(err){
	    console.error(err);
	}finally{
	    console.log("end")
	    connection.end()
	}
	
}

async function drop() {
	const connection = await mysql.createConnection({host: 'localhost',user: 'trvvdmle_classroom',password: 'classroom-yosshipaopao-jiyujin',database: 'trvvdmle_classroom'});
	try{
    	const content = await fsp.readFile('credentials.json');
    	const func_auth = await authorize(JSON.parse(content));
    	const courses = await listCourses(func_auth);
    	var li_courses = [];
    	var results = await connection.query('SELECT * FROM class')
	    var result = []
	    results.forEach((res)=>{result.push(res.id)})
	    
	    const sql_check = "SELECT * FROM `class` WHERE `id`=?"
    	const sql_drop = "DROP TABLE `?`"
    	for(let course of courses){
    	    const [result, fields] = await connection.query(sql_check, course.id);
    	    if(result.length == 0){
    	        const [res_ta, fie_ta] = await connection.query(sql_drop, course.id);
    	    }
    	}
	}catch(err){
	    console.error(err);
	}finally{
	    console.log("end")
	    connection.end()
	}
	
}

async function main() {
	const connection = await mysql.createConnection(
        {
          	host: 'localhost',
        	user: 'trvvdmle_classroom',
        	password: 'classroom-yosshipaopao-jiyujin',
        	database: 'trvvdmle_classroom'
        }
        );
	try{
	    
    	const content = await fsp.readFile('credentials.json');
    	const func_auth = await authorize(JSON.parse(content));
    	const courses = await listCourses(func_auth);
    	var li_courses = [];
    	var results = await connection.query('SELECT * FROM class')
	    var result = []
	    results.forEach((res)=>{result.push(res.id)})
	    console.log(result)
	    
	    const sql_check = "SELECT * FROM `class` WHERE `id`=?"
    	const sql_crclass = "INSERT INTO `class` (`id`) VALUES (?)";
    	const sql_crtable = "CREATE TABLE `trvvdmle_classroom`.`?` ( `workid` BIGINT NULL , `anoid` BIGINT NULL ) ENGINE = InnoDB;";
    	const sql_drop = "DROP TABLE `?`"
    	for(let course of courses){
    	    const [result, fields] = await connection.query(sql_check, course.id);
    	    console.log("course")
    	    
    	    if(result.length == 0){
    	        console.log(course.id)
    	        const [res_cl, fie_cl] = await connection.query(sql_crclass, course.id);
    	        const [res_ta, fie_ta] = await connection.query(sql_crtable, course.id);
    	    }
    	    
    	    
    		/*
    		li_courses.push([course.id, course.name, course.alternateLink]);
    		const ano = await listAno(func_auth, course.id);
    		console.log(course.name + "(" + course.id + "):");
    		if (ano && ano.length) {
    			ano.forEach((an) => {
    				console.log("    " + an.text)
    			});
    		} else {
    			console.log("    none")
    		}*/
    	}
    	/*
    	const [rows, fields] = await connection.query('select * from class');
        for (const val of rows) {
          console.log(val.id);
        }
        */
    	
	}catch(err){
	    console.error(err);
	}finally{
	    console.log("end")
	    connection.end()
	}
	
}

/**
 * authorize(credentials)でoAuth2Clientをreturnする。
 */
async function authorize(credentials) {
	const {
		client_secret, client_id, redirect_uris
	} = credentials.installed;
	const oAuth2Client = new google.auth.OAuth2(client_id, client_secret,
		redirect_uris[0]);

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
	//const rl = readlines.createInterface({input: process.stdin,output: process.stdout,});
	const code = readlines.question('Enter the code from that page here: ');
	//readlines.close();
	try {
		const token = await oAuth2Client.getToken(code);
		oAuth2Client.setCredentials(token);
		// Store the token to disk for later program executions
		await fsp.writeFile(TOKEN_PATH, JSON.stringify(token))
		console.log('Token stored to', TOKEN_PATH);
	} catch (err) {
		return console.error('Error retrieving access token', err);
	}
}

/**
 * 
 *サブ関数
 * 
 **/
async function listCourses(auth) {
	const classroom = google.classroom({
		version: 'v1',
		auth
	});
	try {
		const courses = await classroom.courses.list();
		return courses.data.courses;
	} catch (err) {
		return console.error('The API returned an error: ' + err);
	}
}

async function listWorks(auth, cid,pgsz) {
	const classroom = google.classroom({
		version: 'v1',
		auth
	});
	const work = await classroom.courses.courseWork.list({
		courseId: cid,
		pageSize: pgsz
	});
	return work.data.courseWork;
}

async function listAno(auth, cid,pgsz) {
	const classroom = google.classroom({
		version: 'v1',
		auth
	});
	const ano = await await classroom.courses.announcements.list({
		courseId: cid,
		pageSize: pgsz
	});
	//console.log(ano.data);
	return ano.data.announcements;
}

setup_table()
