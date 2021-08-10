<div class="centerDiv" id="menu">
    <ul>
        <coin style="color: gold;"><b>Gold</b> {{ auth()->user()->coins }}</coin>
        <br>
        <li><a href='{{ route('user.profile') }}'>Profile</a></li>
        <li><a href=''>Shop</a></li>
        <li><a href='{{ route('user.adventure') }}'>Adventure</a></li>
        <li><a href=''>blacksmith</a></li>
        <li><a href=''>Alhemist</a></li>
        <br>
        @if (auth()->user()->admin_power >= 10)
        <li><a href='{{ route('monster.add') }}'>Create new monster</a></li>
        <br>
        @endif
        
        <li><a href='{{ route('auth.logout') }}' style="color: red;">Logout</a></li>
    </ul>
</div>