// 增加点赞/踩的记录
exports.addPostReaction = async params => {
  let user_id = params.userId || ''
  let post_id = params.postId || ''
  let is_like = params.isLike || 0
  let ip = params.ip || ''
  let sql = 'INSERT INTO post_reactions (user_id, post_id, is_like, ip, created_at, updated_at ) VALUES (?,?, ?, ?,now(),now());'
  sql = mysql.format(sql, [user_id, post_id, is_like, ip])
  return await pool.query(sql);
}

// 查询用户有无点赞/踩 记录
exports.getPostReactionByUserId = async params => {
  let user_id = params.userId || ''
  let post_id = params.postId || ''
  let sql = 'SELECT id, is_like FROM post_reactions WHERE user_id =  ? AND post_id = ?'
  sql = mysql.format(sql, [user_id, post_id])
  return await pool.query(sql);
}

// 更新用户点赞/踩
exports.updatePostReactionById = async params => {
  let id = params.postReactionId || ''
  let is_like = params.isLike || ''
  let sql = 'UPDATE post_reactions SET is_like = ? , updated_at = now()  WHERE id = ? '
  sql = mysql.format(sql, [is_like, id])
  return await pool.query(sql);
}

// 删除用户赞踩记录
exports.deletePostReactionById = async (params) =>{
  let id = params.postReactionId || ''
  let sql = 'DELETE FROM post_reactions WHERE  id =  ? '
  sql = mysql.format(sql, [id])
  return await pool.query(sql);

}
