const postsModels = require('../../models/posts/postsModels')
const postReactionsModel = require('../../models/posts/postReactionsModel')
const topicsModels = require('../../models/topics/topicsModels');
// 新增一条评论
exports.addPost = async ctx => {
  let params = {
    ...ctx.request.query,
    ip: ctx.ip
  }
  await postsModels.addPosts(params)
  await topicsModels.addTopicsPostsCount(params)
  ctx.response.body = {
    data: "success",
    status: constant.SUCCESS,
    statusMsg: constant.SUCCESS_DESC
  }
}

// 删除评论    
exports.deletePost = async ctx => { }

// 获取评论
exports.getPostsList = async ctx => {
  let res = await postsModels.getPostsList(ctx.request.query)
  ctx.response.body = {
    data: res,
    status: constant.SUCCESS,
    statusMsg: constant.SUCCESS_DESC
  }
}

// 点赞 ｜踩、取消点赞｜踩
exports.likeOrUnlikePost = async ctx => {
  let params = {
    ...ctx.request.query,
    ip: ctx.ip
  }
  let res = await postReactionsModel.getPostReactionByUserId(params)
  if (res.length > 0) {
    params = {
      ...params,
      postReactionId: res[0].id,
      isLikeFlag: res[0].is_like,
      likeFlag: 1
    }
    // 首先先删除原有的点赞记录
    await postReactionsModel.deletePostReactionById(params)
    // 新增一条点赞踩记录
    await postReactionsModel.addPostReaction(params)
    if(params.isLikeFlag){
      
    }
  } else {
    await postReactionsModel.addPostReaction(params)
    if (params.isLike) {
      // 没有点赞踩记录--- 如果是赞
      await postsModels.likePosts(params)
    } else {
      // 没有点赞踩记录--- 如果是踩
      await postsModels.dislikePosts(params)
    }
  }

  ctx.response.body = {
    data: "success",
    status: constant.SUCCESS,
    statusMsg: constant.SUCCESS_DESC
  }
}