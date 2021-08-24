const Router = require ('koa-router')
const router = new Router()
const userDeal = require('../logics/user/userDeals');

router.get('/login',userDeal.login)

module.exports =router