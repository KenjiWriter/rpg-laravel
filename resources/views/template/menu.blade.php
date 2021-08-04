<div class="centerDiv" id="menu">
    <ul>
        <coin style="color: gold;"><b>Gold</b> {{ auth()->user()->coins }}</coin>
        <br>
        <li><a href=''>Profile</a></li>
        <li><a href=''>Shop</a></li>
        <li><a href=''>Adventure</a></li>
        <li><a href=''>blacksmith</a></li>
        <li><a href=''>Alhemist</a></li>
        <br>
        <li><a href='{{ route('auth.logout') }}' style="color: red;">Logout</a></li>
    </ul>
</div>