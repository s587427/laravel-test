<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {

    return redirect("/todo");

    return view('welcome');
});

Route::get("/todo", function () {

    // Log::info($request->session()->all());
    $todos = DB::select("select * from todos");

    return view("todo", [
        "todos" => $todos,
    ]);

    return $todos;

});

Route::post("/createTodo", function (Request $request) {

    dd("123");

    // $validated = $request->validate([
    //     'addTodo' => 'required|max:2',
    //     'body'    => 'required',
    // ]);

    // $addTodo = $request->input('addTodo');

    // $result = DB::insert(
    //     "insert into todos(title) values (?)",
    //     array($addTodo)
    // );

    // Log::info("addTodo: {$addTodo}, csrf token:" . csrf_token() . "result: " . var_export($result, true));

    // return redirect("/todo");

});

Route::post("/updateTodo/{id}", function (Request $request, $id) {

    $newTitle = $request->input("title");

    $result = DB::update("update todos set title=:title, done = 1 where id =:id",
        array(
            "title" => $newTitle,
            "id"    => $id,
        ));

    Log::info("updateTodo: {$result}");

    return redirect("/todo");
});

Route::get("/deleteTodo/{id}", function (Request $request, $id) {

    $result = DB::delete("delete from todos where id = :id", array("id" => $id));
    Log::info("delete id:" . $id . ",result: " . var_export($result, true));

    return redirect("/todo");
});

Route::get("/login", function () {
    return view("login");
});

Route::post("/login", function (Request $request) {

    $validated = $request->validate([
        "account"  => "required",
        "password" => "required",
    ]);

    // store session
    $request->session()->put("account", $request->input("account"));
    $request->session()->put("password", $request->input("password"));
    $request->session()->put("isLoign", true);
    // session(['account' => 'value']); // global session helper

    // get session
    // $request->session()->get('account');
    // $data = $request->session()->all();
    // $value = session('account'); // global session helper

    // remove session
    // Forget a single key...
    // $request->session()->forget('name');
    // Forget multiple keys...
    // $request->session()->forget(['name', 'status']);
    // $request->session()->flush();

    // $request->session()->has('users') // null值 = false
    // $request->session()->exists('users') null值 = true
    // $request->session()->missing('users')
    return redirect("/todo");

});

// 定義一個web route Route:get('/xxxx', callback)
// callback, 且可以接收到一個Request的實例對象作為參數
// return值會自動將http response的Conent-Type自動轉換成相應格式
// Route::get("/todos", function (Request $request) {
//     return array(
//         array(
//             "id"      => 1,
//             "title"   => "play",
//             "checked" => false,
//         ),
//         array(
//             "id"      => 2,
//             "title"   => "work",
//             "checked" => false,
//         ),
//     );
// });

// 可以註冊侷限對應的http method
// Route::get($uri, $callback);
// Route::post($uri, $callback);
// Route::put($uri, $callback);
// Route::patch($uri, $callback);
// Route::delete($uri, $callback);
// Route::options($uri, $callback);

// 命名路由(name should be unique)
// Route::get('/user/profile', function () {})->name('profile');
// 得動命名的路由方法
// $url = route('profile')
// $url = route('profile', ['id' => 1]); 可傳參假如url包含動態參數id
// $url = route('profile', ['id' => 1, 'photos' => 'yes']); 假如url都不包含動態參數 /profile?id=1&photos=yes

// 動態路由
// Route::get('/posts/{post}/comments/{comment}', function (string $postId, string $commentId) {});
// Route::get('/user/{id}', function (Request $request, string $id) { return 'User '.$id;});

// 選項路由(parameters)
// Route::get('/user/{name?}', function (?string $name = null) { return $name;});

// 正則路由Regular Expression(parameters)
// Route::get('/user/{name}', function (string $name) {})->where('name', '[A-Za-z]+');
// Route::get('/user/{id}/{name}', function (string $id, string $name) {})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);
// 借助helper方法
// Route::get('/user/{id}/{name}', function (string $id, string $name) {})->whereNumber('id')->whereAlpha('name');
// Route::get('/user/{name}', function (string $name) {})->whereAlphaNumeric('name');
// Route::get('/user/{id}', function (string $id) {})->whereUuid('id');
// Route::get('/user/{id}', function (string $id) {})->whereUlid('id');
// Route::get('/category/{category}', function (string $category) {})->whereIn('category', ['movie', 'song', 'painting']);

// 導向路由
// Route::redirect('/here', '/there');
// Route::redirect('/here', '/there', 301);
// Route::permanentRedirect('/here', '/there');

// 自訂http methods | 全部 , (這些方法應該都在放所有route之後以便正確route運作)
// Route::match(['get', 'post'], '/', $callback);
// Route::any('/', $callback);

// 視圖路由 parameter 1.uri 2.view name 3. pass array of data
// Route::view('/welcome', 'welcome');
// Route::view('/welcome', 'welcome', ['name' => 'Taylor']);

// ---------------------------------------------------------------- //

// Route Gropus
// 經過中間層的路由
// Route::middleware(['first', 'second'])->group(function () {
//     Route::get('/', function () {
//          Uses first & second middleware...
//     });
//     Route::get('/user/profile', function () {
//         Uses first & second middleware...
//     });
// });

// 如果一組路由都教給同一個控制器
// Route::controller(OrderController::class)->group(function () {
//     show, store皆為OrderController::class的方法
//     Route::get('/orders/{id}', 'show');
//     Route::post('/orders', 'store');
// });

// 為一組內的路由都加上prefix
// Route::prefix('admin')->group(function () {
//     Matches The "/admin/users" URL
//     Route::get('/users', function () {
//     });
// });

// 為一組內的路由命名路由再加上一層命名 Route assigned name "admin.users"...
// Route::name('admin.')->group(function () {
//     Route::get('/users', function () {
//     })->name('users');
// });

// ---------------------------------------------------------------- //

// Route Model Binding

// 隱式綁定(Contoller定義的methods也可以這樣用)
// use App\Models\User;
// Route::get('/users/{user}', function (User $user) {
//     return $user->email;
// });

// ---------------------------------------------------------------- //

// 查看當前的Route資訊
// use Illuminate\Support\Facades\Route;
// $route  = Route::current(); // Illuminate\Routing\Route
// $name   = Route::currentRouteName(); // string
// $action = Route::currentRouteAction(); // string