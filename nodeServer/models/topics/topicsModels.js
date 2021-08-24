// 新增一个帖子
exports.addTopics = async params => {
  let title = params.title || ''
  let userId = params.userId || ''
  let ip = params.ip || ''
  let sql = 'INSERT INTO topics (title, user_id, ip, views_count, posts_count, last_post_user_id, created_at, updated_at) VALUES (?, ?, ?, 0, 0, ?,now(),now())'
  sql = mysql.format(sql, [title, userId, ip, userId])
  return await pool.query(sql);
}

// 删除一个贴子
exports.deleteTopics = async params => {
  let topicId = params.topicId || ''
  let sql = 'UPDATE topics SET deleted_at = now() WHERE id = ?'
  sql = mysql.format(sql, [topicId])
  return await pool.query(sql);
 }

// 增加帖子一个浏览量
exports.addTopicsViewsCount = async params => {
  let topicId = params.topicId || ''
  let sql = 'UPDATE topics SET views_count = views_count + 1 WHERE id = ?'
  sql = mysql.format(sql, [topicId])
  return await pool.query(sql);
}

// 增加帖子的留言数以及最后留言人 
exports.addTopicsPostsCount = async params => {
  let topicId = params.topicId || ''
  let userId = params.userId || ''
  let sql = 'UPDATE topics SET posts_count = posts_count + 1, last_post_user_id = ?, updated_at = now() WHERE id = ?'
  sql = mysql.format(sql, [userId, topicId])
  return await pool.query(sql);
}

// 查找所有的帖子 --- 分页 
exports.getTopicsList = async params => {
  let pageNum = params.pageNum || 1
  let pageSize = params.pageSize || 20

  let sql = 'SELECT a.id, a.title, b.name AS user_name, a.views_count, a.posts_count \
                FROM topics a LEFT JOIN users b ON a.user_id = b.id \
                WHERE a.deleted_at IS NULL \
                ORDER BY a.updated_at DESC '

  if (pageNum > 1) {
    sql += " limit " + (pageNum - 1) * pageSize + ',' + pageSize;
  } else {
    sql += " limit 0," + pageSize;
  }
  return await pool.query(sql);
}

// 查找所有帖子的数量
exports.getTopicsListCount = async () => {
  let sql = 'SELECT COUNT(*) AS count  FROM topics a LEFT JOIN users b ON a.user_id = b.id WHERE a.deleted_at IS NULL'
  return await pool.query(sql);
}

