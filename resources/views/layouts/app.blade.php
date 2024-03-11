<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>@yield("title")</title>
</head>
<body>

    <div>
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#todo">Todo</a></li>
                <li><a href="/login">Login</a></li>
            </ul>


            @if(session("isLoign"))
                <div>
                    account: {{session("account")}}, password: {{session("password")}}
                    <button type="button"  id="logout">Logout</button>
                </div>
            @endif

            <script>
                // document.querySelector("#logout")?.addEventListener("click", e =>{
                //     {{session()->flush()}}
                //     window.location.reload()
                // })

            </script>


        </nav>

        <div class="container">
            @yield("content")
        </div>
    </div>

    @section("sideabar")
        this is a section directive
    @show

</body>
</html>