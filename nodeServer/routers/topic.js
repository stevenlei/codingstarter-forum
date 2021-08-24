const Router = require ('koa-router')
const router = new Router()
const topicDeals = require('../logics/topic/topicDeal');

/**
 * 新增一个topic  /topic/addtopic
 * @param  {Int}     title        topic‘s title
 * @param  {Int}     userId     用户id
 * @param  {Int}     topicId     
 * @param  {Int}     content     topic‘s content
 * 
 */
router.post('/addtopic',topicDeals.addTopic)

/**
 * 删除一个topic  /topic/deletetopic
 * @param  {Int}     topicId     话题id
 */
router.get('/deletetopic',topicDeals.deleteTopics)

/**
 * 查找topic  /topic/gettopiclist
 * @param  {Int}   pageNum 当前页
 * @param  {Int}   pageSize   
 */
router.get('/gettopiclist',topicDeals.getTopicList)

/**
 * 增加topic浏览量  /topic/addtopicsviewcount
 * @param  {Int}     topicId     话题id
 */
 router.get('/addtopicsviewcount',topicDeals.addTopicsViewCount)

module.exports =router