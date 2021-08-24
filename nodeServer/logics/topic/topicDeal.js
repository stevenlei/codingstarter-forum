const topicsModels = require('../../models/topics/topicsModels')
const postsModels = require('../../models/posts/postsModels')

// 新增话题
/** 
 * TODO 
 * 如果参数不够第一个sql已经执行但是第二个sql 发生错误 那么就需要进行回滚操作
 * 删除第一条已经插进去的记录
 */
exports.addTopic = async (ctx) => {
    let params = {
        ...ctx.request.query,
        ip: ctx.ip
    }
    let res = await topicsModels.addTopics(params)
    params = {
        ...params,
        topicId: res.insertId,
        isFirst:1,
    }
    await postsModels.addPosts(params)
    ctx.response.body = {
        data: "success",
        status: constant.SUCCESS,
        statusMsg: constant.SUCCESS_DESC
    }
}

// 删除话题
exports.deleteTopics = async ctx => {
    await topicsModels.deleteTopics(ctx.request.query)
    ctx.response.body = {
        data: "success",
        status: constant.SUCCESS,
        statusMsg: constant.SUCCESS_DESC
    }
}

// 查找话题
exports.getTopicList = async ctx => {
    let listRes = await topicsModels.getTopicsList(ctx.request.query)
    let listCount = await topicsModels.getTopicsListCount(ctx.request.query)
    ctx.response.body = {
        data: listRes,
        total: listCount[0].count,
        status: constant.SUCCESS,
        statusMsg: constant.SUCCESS_DESC
    }

}

// 增加话题浏览量
exports.addTopicsViewCount = async ctx => {
    await topicsModels.addTopicsViewsCount(ctx.request)
    ctx.response.body = {
        data: "success",
        status: constant.SUCCESS,
        statusMsg: constant.SUCCESS_DESC
    }
}