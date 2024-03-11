# 快速了解

## Routings
* 位於/routes
* routes資料夾內的檔案都會被app/RouteServiceProvider自動載入
* routes
  * api: 定義無狀態的route, 且會經過api的middleware group
    1. 嵌套在RouteServiceProvider路由中
    2. 定義的路由無需加入prefx /api/xxxx, 但可以在RouteServiceProvider修改api的設定
  * web: 定義網頁的route,  且會經過web的middleware group, 可以做一些session, csrf等等的防護
* 透過指令查看所有定義路由 php artisan route:list [options]