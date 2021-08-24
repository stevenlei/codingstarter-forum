const request = require('request');
const usersModels = require('../../models/users/usersModels')

// 登录
exports.login = async ctx => {
  let { code } = ctx.request.qurey
  let res = await getUserInfoByPhp(code)
  console.log(res, '11111')
  if (!res) {
    ctx.response.body = {
      status: constant.SYSERR,
      statusMsg: constant.SYSERR_DESC
    }
  } else {
    ctx.response.body = {
      data: {
        ...userInfo[0],
        // token     // 预留token 以后可以做token 验证
      },
      status: constant.SUCCESS,
      statusMsg: constant.SUCCESS_DESC
    }
  }
  // let res = await getUserInfoByGithub(code)
  // // 验证有无github验证信息
  // if (!res) {
  //   ctx.response.body = {
  //     status: constant.SYSERR,
  //     statusMsg: constant.SYSERR_DESC
  //   }
  // }
  // // 查找该用户是否注册过存在
  // let userInfo = await usersModels.findUserInfoById(res.id)
  // if (userInfo.length > 0) {
  //   ctx.response.body = {
  //     data: {
  //       ...userInfo[0],
  //       // token     // 预留token 以后可以做token 验证
  //     },
  //     status: constant.SUCCESS,
  //     statusMsg: constant.SUCCESS_DESC
  //   }
  // } else {
  //   await usersModels.saveUserInfo(res)
  //   ctx.response.body = {
  //     data: {
  //       name: res.nickname,
  //       id: res.id,
  //       avatar: res.avatar,
  //       // token     // 预留token 以后可以做token 验证
  //     },
  //     status: constant.SUCCESS,
  //     statusMsg: constant.SUCCESS_DESC
  //   }
  // }
}

// 向github获取个人信息
const getUserInfoByGithub = (code) => {
  return new Promise((resolve, reject) => {
    let params = {
      client_id: config.github.client_id,
      client_secret: config.github.client_secret,
      code: code,
    }
    request({
      url: config.github.client_url,
      method: "POST",
      json: true,
      headers: {
        "content-type": "application/json",
      },
      body: JSON.stringify(params),
    }, (err, res, body) => {
      if (!err) {
        resolve(body)
      }
    })
  })
}

// 向php端请求个人信息
const getUserInfoByPhp = (code) => {
  return new Promise((resolve, reject) => {
    let params = {
      code
    }
    request({
      url: config.github.client_url,
      method: "POST",
      json: true,
      headers: {
        "content-type": "application/json",
      },
      body: JSON.stringify(params),
    }, (err, res, body) => {
      console.log(err, body)
      if (!err) {
        resolve(body)
      }
    })
  })
}

