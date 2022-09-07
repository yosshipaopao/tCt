const mysql = require('mysql2/promise');

(async () => {
  const connection = await mysql.createConnection(
    {
      	host: 'localhost',
		user: 'trvvdmle_classroom',
		password: 'classroom-yosshipaopao-jiyujin',
		database: 'trvvdmle_classroom'
    }
  );
  try {
      
    const sql = "INSERT INTO `class` (`id`) VALUES ('?')";
    for(var i = 0; i< 10; i++){
        console.log(mysql.format(sql, i*i*i+i));
        const [rows, fields] = await connection.query(sql, i*i*i+i);
    }
    const [rows, fields] = await connection.query('select * from class');
    for (const val of rows) {
      console.log(val.id);
    }
  } catch(e) {
    console.log(e);
  } finally {
    connection.end();
  }
})();