<!-- error display -->
@if($errors->any())
    <div>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form method="POST" action="/login">
    {{csrf_field()}}

    <div>
        <label for="account">Account</label>
        <input type="text" id="account" name="account"/>
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password"/>
    </div>

    <button type="submit">Login</button>

</form>


