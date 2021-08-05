@include('template.header')
@include('template.menu')
<form class="FormContainer centerDiv" method="POST" action="{{ route('monster.save') }}">
    <h3>Create new monster</h3>
    @if (Session::get('success'))
    <div style="color: greenyellow">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('fail'))
    <div style="color: red">{{ Session::get('fail') }}</div>
    @endif
    @csrf
    <label for="name" style="width: 15em;">Monster name:</label><input type="text" name="name" id="" placeholder="Wolf"><br>
    <span align="center" style="color: red;">@error('name') {{ $message }} <br> @enderror</span><br>
    <label for="level" style="width: 15em;">Monster level:</label><input type="number" name="level" id="" placeholder="level"><br>
    <span align="center" style="color: red;">@error('level') {{ $message }} <br> @enderror</span><br>
    <label for="health" style="width: 15em;">Monster HP:</label><input type="number" name="health" id="" placeholder="10000"><br>
    <span align="center" style="color: red;">@error('health') {{ $message }} <br> @enderror</span><br>
    <label for="dmg" style="width: 15em;">Monster min dmg:</label><input type="number" name="dmg" id="" placeholder="min dmg"><br>
    <span align="center" style="color: red;">@error('dmg') {{ $message }} <br> @enderror</span><br>
    <label for="level" style="width: 15em;">Monster max dmg:</label><input type="number" name="dmg_max" id="" placeholder="max dmg"><br>
    <span align="center" style="color: red;">@error('dmg_max') {{ $message }} <br> @enderror</span><br>
    <input type="submit" value="Create">
</form>
@include('template.footer')