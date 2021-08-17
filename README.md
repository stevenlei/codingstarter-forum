# CodingStarter 論壇

## 前言

CodingStarter [(https://codingstarter.com)](https://codingstarter.com) ，一個屬於網頁開發者的論壇，同時是讓開發者學習與實踐的項目。

我們在學習新技術的時候，常常遇到學了但沒有案例去實現、不知道項目開發的流程、沒有團隊合作經驗等問題。這個項目就是為此而生：它是一個真正上線的項目，你可以將想法付諸實行，提 PR，動手寫，一直迭代更新。

## 技術棧

本項目使用到的技術包括：

- 後端
  - Laravel 框架 (PHP)
  - MySQL 資料庫
- 前端
  - Laravel Blade 模版
  - Tailwind CSS
  - Livewire
- Web Socket (Laravel WebSockets + Echo)

下一步會進行前後端分離，希望以 Nuxt (Vue) 建立新的前端版本。當然，後端也就需要準備好一套 API。

## 版本

目前是一個很初步的階段，就定它為 0.1 版本。

### v0.1
- 建立主題
  - 主題分頁 (瀏覽更多)
- 瀏覽主題及帖子
- 回覆主題
- GitHub 登入
- 以 Tailwind CSS 建立的 Dark Theme 佈局
- 以 Web Socket 方式，在有新主題或回覆時，進行實時頁面刷新。
- 免刷新瀏覽頁面（除了 /new 建立主題頁）
- 支持 Markdown 及代碼塊高亮
- 2021/08/17: 讚好／差評帖子功能
- 2021/08/17: 按時間（順序）或熱度（讚好數量倒序）排序主題回覆帖文

---

## 教學資源

- **CodingStartup** —— Made with ❤️ in Macao
  - [BiliBili](https://space.bilibili.com/451368848)
  - [YouTube](https://youtube.com/codingstartup)

---

(本文檔待完善)