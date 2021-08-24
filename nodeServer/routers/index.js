const Router = require('koa-router')
const router = new Router()
const user = require('./user')
const topic = require('./topic')
const post = require('./post')

router.use('/user', user.routes(), user.allowedMethods())
router.use('/topic', topic.routes(), topic.allowedMethods())
router.use('/post', post.routes(), post.allowedMethods())

module.exports = router