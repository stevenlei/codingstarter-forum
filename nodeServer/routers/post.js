const Router = require ('koa-router')
const router = new Router()
const postDeals = require('../logics/post/postDeal');

/**
 * 新增一条评论
 * @param {int} topicId  话题id
 * @param {int} userId  用户id
 * @param {str} content 内容
 */
router.post('/addpost',postDeals.addPost)

/**
 * 获取评论列表
 * @param {int} topicId  话题id
 * @param {int} sortFlag  排序  0是默认排序 1是last排序 2 是按照hot
 */
router.post('/getpostslist',postDeals.getPostsList)

// router.post('/likeorunlikepost',postDeals.likeOrUnlikePost)

module.exports =router