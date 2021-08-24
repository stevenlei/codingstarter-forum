const initglobal = () => {
  global.pool = require('./utils/mysql') //初始化数据库连接池
  global.mysql = require('mysql') //mysql
  global.constant = require('./config/constant.json')
  global.config = require('./config/config')
}
initglobal()

const Koa = require('koa');
const app = new Koa()
const router = require('./routers')
const koajwt = require('koa-jwt');

// 设置监听端口
const port = 8001;
app.use(async (ctx, next) => {
  return next().catch((err) => {
    if (err.status === 401) {
      // 自定义返回结果
      ctx.body = {
        status: constant.SYSERR,
        statusMsg: constant.NEED_LOGIN_DESC
      }
    } else {
      ctx.body = {
        status: constant.SYSERR,
        msg: err.message,
        statusMsg: constant.SYSERR_DESC,

      }
    }
  })
});

// app.use(koajwt({ secret: constant.SECRET }).unless({
//   // 登录接口不需要验证
//   path: [/^\/user\/login/,/^\/user\/register/]
// }));

app.use(router.routes(), router.allowedMethods())

app.listen(port, () => {
  console.log(`服务已启动,开始监听端口${port}`)
});