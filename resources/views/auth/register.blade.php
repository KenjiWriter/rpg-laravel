@include('template.header')

    <form class="FormContainer centerDiv" method="POST" action="{{ route('auth.save') }}">
        @csrf
        <h3>Register</h3>
        @if (Session::get('success'))
            <div style="color: green;">Success! Now u can <a href="{{ route('auth.login') }}" style="text-decoration: none; color:rgb(53, 194, 53);">log in</a>!</div>
        @endif
        @if (Session::get('fail'))
        <div style="color: red;">{{ Session::get('fail') }}</div>
        @endif
        <label for="login">Login: </label><br><input type="text" id="login" name="login" placeholder="Username" value="{{ old('login') }}"><br>
        <span align="center" style="color: red;">@error('login') {{ $message }} <br> @enderror</span>
        <label for="password" style="margin-top: 10px;">Password: </label><br><input type="password" id="password" name="password" align="center" placeholder="password"><br>
        <span align="center" style="color: red;">@error('password') {{ $message }}<br> @enderror</span>
        <label for="password" style="margin-top: 10px;">Confirm password: </label><br><input type="password" id="password" name="password_confirmation" align="center" placeholder="password"><br>
        <input type="submit" style="cursor: pointer;  margin-bottom: 10px; margin-top: 10px;" value="Register"><br>
        <a href="{{ route('auth.login') }}" style="margin-top: 10px; color:green; text-decoration: none;">I have an account</a>
    </form>

@include('template.footer')