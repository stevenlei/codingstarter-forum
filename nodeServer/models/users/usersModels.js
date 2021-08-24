// 根据用户id查找用户信息
exports.findUserInfoById = async params =>{
  let id = params.id ||''

  let sql = 'SELECT name, profile_image_url AS avatar, channel_user_id AS id FROM users where channel_user_id = ?'
  sql = mysql.format(sql, [id])
  let result = await pool.query(sql);

  return result
}

// 存储用户信息 ---->暂时不做
exports.saveUserInfo = async params =>{
  let {nickname,email, token,id,avatar} = params
  let sql ='INSERT INTO users (name, email, email_verified_at, password, channel, token, channel_user_id, profile_image_url, remember_token) VALUES(?,?,?)'
  return 'success'
}