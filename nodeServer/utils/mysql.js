const config = require('../config/config')
const mysql = require('mysql');

const pool = mysql.createPool({
    host: config.database.HOST,
    user: config.database.USERNAME,
    password: config.database.PASSWORD,
    database: config.database.DATABASE,
    port: config.database.PORT
});

exports.query = (sql) => {
    return new Promise((resolve, reject) => {
        pool.getConnection((err, connection) => {
            if (err) {
                console.log(err, '------err 16')
                reject(err)
            } else {
                connection.query(sql, (err, rows) => {
                    if (err) {
                        console.log(err, '------err 221')
                        reject(err)
                    } else {
                        resolve(rows)
                    }
                    connection.release()
                })
            }
        })
    })
}