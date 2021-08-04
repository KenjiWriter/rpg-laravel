@include('template.header')

    <form class="FormContainer centerDiv" method="POST" action="{{ route('auth.check') }}">
        @csrf
        <h3>Login</h3>
        @if (Session::get('fail'))
        <div style="color: red;">{{ Session::get('fail') }}</div>
        @endif
        <label for="login">Login: </label><br><input type="text" name="login" placeholder="Username" value="{{ old('login') }}"><br>
        <span align="center" style="color: red;">@error('login') {{ $message }} <br> @enderror</span>
        <label for="password" style="margin-top: 10px;">Password: </label><br><input name="password" type="password" align="center" placeholder="password"><br>
        <span align="center" style="color: red;">@error('password') {{ $message }} <br> @enderror</span>
        <input type="submit" style="cursor: pointer;  margin-bottom: 10px; margin-top: 10px;" value="Login"><br>
        <a href="{{ route('auth.register') }}" style="margin-top: 10px; color:green; text-decoration: none;">Create account</a>
    </form>

@include('template.footer')