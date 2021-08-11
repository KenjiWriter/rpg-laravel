@include('template.header')
@include('template.menu')
<form action="{{ route('item.save') }}" method="POST" class="FormContainer centerDiv" enctype="multipart/form-data">
    @csrf
    <h3>Add new item</h3>
    @if (Session::get('success'))
    <div style="color: greenyellow">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('fail'))
    <div style="color: red">{{ Session::get('fail') }}</div>
    @endif
    <label for="class" style="width: 15em;">Type:</label>
    <select style="margin:1em;" name="type">
        <option value="1">1. Weapon</option>
        <option value="2">2. Helmet</option>
        <option value="3">3. Chestplate</option>
        <option value="4">4. Pants</option>
        <option value="5">5. Boots</option>
        <option value="6">6. ring</option>
        <option value="7">7. talisman</option>
        <option value="8">8. Enhancer</option>
        <option value="9">9. Money bag</option>
        <option value="10">10. Chest key</option>
    </select><br>
    <label for="rare" style="width: 15em;">Rare type:</label>
    <select style="margin:1em;" name="rare">
        <option value="1">1. Common</option>
        <option value="2">2. Uncommon</option>
        <option value="3">3. Rare</option>
        <option value="4">4. Epic</option>
        <option value="5">5. Legendary</option>
        <option value="6">6. Mythic</option>
    </select><br>
    <label for="icon" style="width: 15em">Item Icon: </label><input type="file" name="icon"><br>
    <span align="center" style="color: red;">@error('icon') {{ $message }} <br> @enderror</span><br>
    <label for="name" style="width: 15em">Name: </label><input type="text" name="name" placeholder="dagger"><br>
    <span align="center" style="color: red;">@error('name') {{ $message }} <br> @enderror</span><br>
    <label for="required_lvl" style="width: 15em">Required lvl: </label><input type="number" name="required_lvl" placeholder="99"><br>
    <span align="center" style="color: red;">@error('required_lvl') {{ $message }} <br> @enderror</span><br>
    <label for="strength" style="width: 15em">Strength: </label><input type="number" name="strength" placeholder="15"><br>
    <span align="center" style="color: red;">@error('strength') {{ $message }} <br> @enderror</span><br>
    <label for="intelligence" style="width: 15em">Intelligence: </label><input type="number" name="intelligence" placeholder="10"><br>
    <span align="center" style="color: red;">@error('intelligence') {{ $message }} <br> @enderror</span><br>
    <label for="endurance" style="width: 15em">Endurance: </label><input type="number" name="endurance" placeholder="11"><br>
    <span align="center" style="color: red;">@error('endurance') {{ $message }} <br> @enderror</span><br>
    <label for="luck" style="width: 15em">Luck: </label><input type="number" name="luck" placeholder="28"><br>
    <span align="center" style="color: red;">@error('luck') {{ $message }} <br> @enderror</span><br>
    <label for="buyPrice" style="width: 15em">Buy price: </label><input type="number" name="buyPrice" placeholder="399"><br>
    <span align="center" style="color: red;">@error('buyPrice') {{ $message }} <br> @enderror</span><br>
    <input type="submit" value="Create">
</form>
@include('template.footer')