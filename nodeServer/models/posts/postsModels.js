
// 获取主题内的贴文    --- 首先按照isfirst排序然后再按照更新时间
exports.getPostsList = async (params) => {
  let topic_id = params.topicId || ''
  let sort_flag = params.sortFlag || 0   // 0是默认排序 1是last排序 2 是按照hot 排序
  let sql = "SELECT a.id AS postsId, b.name AS userName,a.content,a.likes_count,a.dislikes_count,a.updated_at \
                FROM posts a LEFT JOIN users b ON a.user_id = b.id \
                WHERE a.topic_id = ? ORDER BY a.is_first DESC ";
  switch (sort_flag) {
    case 1:
      sql += ' , a.created_at  DESC'
      break;
    case 2:
      sql += ' ,  a.likes_count DESC '
      break;
    // case 2:
    //   sql += ' ,  a.likes_count + a.dislikes_count DESC '
    //   break;
    default:
      sql += ' , a.created_at ASC '
      break
  }
  sql = mysql.format(sql, [topic_id])
  return await pool.query(sql);
}

// 新增主题内贴文
exports.addPosts = async (params) => {
  let topic_id = params.topicId || ''
  let is_first = params.isFirst || 0
  let user_id = params.userId || ''
  let content = params.content || ''
  let ip = params.ip || ''
  let sql = 'INSERT INTO posts (topic_id, is_first, user_id, content, likes_count, dislikes_count, ip, created_at, updated_at) VALUES (?, ?, ?, ?, 0, 0, ?, now(), now())'
  sql = mysql.format(sql, [topic_id, is_first, user_id, content, ip])
  return await pool.query(sql);
}

//  删除主题内的贴文
exports.deletePosts = async params => {
  let post_id = params.postId || ''
  let sql = ' UPDATE posts SET deleted_at = now() WHERE id = ? '
  sql = mysql.format(sql, [post_id])
  return await pool.query(sql);
}

// 赞贴文
exports.likePosts = async params => {
  let like_flag = params.likeFlag || '0'      // 如果是 1 那么就是点赞 如果是 -1 那么就取消赞
  let sql = ' UPDATE posts SET likes_count = likes_count + ?, updated_at = now()  WHERE id = ? '
  sql = mysql.format(sql, [like_flag])
  return await pool.query(sql);
}

// 踩贴文
exports.dislikePosts = async params => {
  let like_flag = params.likeFlag || '0'      // 如果是 1 那么就是踩 如果是 -1 那么就取消踩
  let sql = ' UPDATE posts SET dislikes_count = dislikes_count + ?, updated_at = now()  WHERE id = ? '
  sql = mysql.format(sql, [like_flag])
  return await pool.query(sql);
}

