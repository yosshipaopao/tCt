const fsp = require('fs').promises;
const readlines = require('readline-sync');
const {google} = require('googleapis');
const notifaction = require('./notifaction_topic.js');
const SCOPES = [
    'https://www.googleapis.com/auth/classroom.courses',
	'https://www.googleapis.com/auth/classroom.courses.readonly',
	'https://www.googleapis.com/auth/classroom.rosters',
	'https://www.googleapis.com/auth/classroom.coursework.me',
	'https://www.googleapis.com/auth/classroom.coursework.students',
	'https://www.googleapis.com/auth/classroom.announcements'
];
const mysql = require('mysql2/promise');
const mysql_config = {
	host: 'localhost',
	user: 'trvvdmle_classroom',
	password: 'classroom-yosshipaopao-jiyujin',
	database: 'trvvdmle_classroom'
};
const TOKEN_PATH = 'token.json';

//メイン関数
async function setup_table() {
	//make mysql
	const connection = await mysql.createConnection(mysql_config);
	try {
		const content = await fsp.readFile('credentials.json');
		const func_auth = await authorize(JSON.parse(content));
		const courses = await listCourses(func_auth);
		const sql_check = "SELECT * FROM `class` WHERE `id`=?"
		const sql_crclass = "INSERT INTO `class` (`id`) VALUES (?)";
		const sql_crtable =
			"CREATE TABLE `trvvdmle_classroom`.`?` ( `workid` BIGINT NULL , `anoid` BIGINT NULL ) ENGINE = InnoDB;";
		for (let course of courses) {
			const [result, fields] = await connection.query(sql_check, course.id);
			console.log(course.id)
			if (result.length == 0) {
				console.log(course.id)
				const [res_cl, fie_cl] = await connection.query(sql_crclass, course.id);
				const [res_ta, fie_ta] = await connection.query(sql_crtable, course.id);
				const Works = await listWorks(func_auth, course.id, 5);
				const Ano = await listAno(func_auth, course.id, 5);
				if (Works && Works.length) {
					let work_ids = [];
					let sql_work = "INSERT INTO `?` (`workid`) VALUES ";
					for (let work of Works) {
						work_ids.push(work.id);
						sql_work += "('" + work.id + "'),";
					}
					console.log(await connection.format(sql_work.slice(0, -1), course.id));
					const [res_wo, fie_wo] = await connection.query(sql_work.slice(0, -1),
						course.id);
				}
				if (Ano && Ano.length) {
					let ano_ids = [];
					let sql_ano = "INSERT INTO `?` (`anoid`) VALUES ";
					for (let An of Ano) {
						ano_ids.push(An.id);
						sql_ano += "('" + An.id + "'),";
					}
					console.log(await connection.format(sql_ano.slice(0, -1), course.id));
					const [res_ano, fie_ano] = await connection.query(sql_ano.slice(0, -1),
						course.id);
				}
			}
		}
	} catch (err) {
		console.error(err);
	} finally {
		console.log("end")
		connection.end()
	}
}
async function drop() {
	//make mysql
	const connection = await mysql.createConnection(mysql_config);
	try {
		//service account key 
		const content = await fsp.readFile('credentials.json');
		const func_auth = await authorize(JSON.parse(content));
		//get courses
		const courses = await listCourses(func_auth);
		//make sql ? is exchange to course.id
		const sql_check = 'SHOW TABLES LIKE "?"';
		const sql_drop = "DROP TABLE `?`";
		for (let course of courses) {
			const [result, fields] = await connection.query(sql_check, course.id);
			// if isset table
			if (result.length != 0) {
				//del table
				const [res_ta, fie_ta] = await connection.query(sql_drop, course.id);
			}
		}
	} catch (err) {
		console.error(err);
	} finally {
		console.log("end")
		//end mysql
		connection.end()
	}
}
async function main() {
	const connection = await mysql.createConnection(mysql_config);
	try {
		const content = await fsp.readFile('credentials.json');
		const func_auth = await authorize(JSON.parse(content));
		const courses = await listCourses(func_auth);
		const sql_check = 'SHOW TABLES LIKE "?"';
		const sql_checkwork = "SELECT * FROM `?` WHERE `workid` LIKE ?";
		const sql_checkano = "SELECT * FROM `?` WHERE `anoid` LIKE ?";
		for (let course of courses) {
			const [result, fields] = await connection.query(sql_check, course.id);
			if (result.length == 0) {
				setup_table()
			} else {
				console.log(course.id)
				const Works = await listWorks(func_auth, course.id, 1);
				const Ano = await listAno(func_auth, course.id, 1);
				if (Works && Works.length) {
					work = Works[0]
					console.log(work.title + "(" + work.id + ")")
					const [res_wo, fie_wo] = await connection.query(sql_checkwork, [course.id,
						work.id
					]);
					if (res_wo && res_wo.length) {
						console.log("not new")
					} else {
						console.log("NEW")
						not_title = "課題が作成されました:" + course.name;
						not_body = work.title + "\n" + work["description"];
						not_url = work.alternateLink;
						//do magic here
						notifaction.notifaction(course.id, not_title, not_body, not_url);
						let sql_inwo = "INSERT INTO `?` (`workid`) VALUES (?)"
						const [res_inwo, fie_inwo] = await connection.query(sql_inwo, [course.id,
							work.id
						]);
					}
				}
				if (Ano && Ano.length) {
					An = Ano[0]
					const [res_sn, fie_sn] = await connection.query(sql_checkano, [course.id,
						An.id
					]);
					if (res_sn && res_sn.length) {
						console.log("not new")
					} else {
						console.log("NEW")
						const maker_prof = await get_profile(func_auth, An.creatorUserId)
						not_title = maker_prof.name.fullName + "さんからのアナウンス:" + course.name;
						not_body = An.text;
						not_url = An.alternateLink;
						//do magic here
						notifaction.notifaction(course.id, not_title, not_body, not_url);
						let sql_inan = "INSERT INTO `?` (`anoid`) VALUES (?)"
						const [res_inan, fie_inan] = await connection.query(sql_inan, [course.id,
							An.id
						]);
					}
				}
			}
		}
	} catch (err) {
		console.error(err);
	} finally {
		console.log("end")
		connection.end()
	}
}
/**
 * authorize(credentials)でoAuth2Clientをreturnする。
 */
async function authorize(credentials) {
	const {
		client_secret,
		client_id,
		redirect_uris
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
		const courses = await classroom.courses.list({
			courseStates: 'ACTIVE',
		});
		return courses.data.courses;
	} catch (err) {
		return console.error('The API returned an error: ' + err);
	}
}
async function listWorks(auth, cid, pgsz) {
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
async function listAno(auth, cid, pgsz) {
	const classroom = google.classroom({
		version: 'v1',
		auth
	});
	const ano = await classroom.courses.announcements.list({
		courseId: cid,
		pageSize: pgsz
	});
	return ano.data.announcements;
}
async function get_profile(auth, uid) {
	const classroom = google.classroom({
		version: 'v1',
		auth
	});
	const user = await classroom.userProfiles.get({
		userId: uid
	});
	return user.data;
}
//setup_table()
//drop()
main()
