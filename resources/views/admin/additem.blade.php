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
    <label for="strength" style="width: 15em">Strength: </label><input type="number" name="strength_min" placeholder="10" style="width: 35px;">-<input type="number" name="strength_max" placeholder="15" style="width: 35px;"><br>
    <span align="center" style="color: red;">@error('strength_min') {{ $message }} <br> @enderror</span><br>
    <label for="intelligence" style="width: 15em">Intelligence: </label><input type="number" name="intelligence_min" placeholder="10" style="width: 35px;">-<input type="number" name="intelligence_max" placeholder="10" style="width: 35px;"><br>
    <span align="center" style="color: red;">@error('intelligence_min') {{ $message }} <br> @enderror</span><br>
    <label for="endurance" style="width: 15em">Endurance: </label><input type="number" name="endurance_min" placeholder="11" style="width: 35px;">-<input type="number" name="endurance_max" placeholder="19" style="width: 35px;"><br>
    <span align="center" style="color: red;">@error('endurance_min') {{ $message }} <br> @enderror</span><br>
    <label for="endurance" style="width: 15em">Vitality: </label><input type="number" name="vitality_min" placeholder="11" style="width: 35px;">-<input type="number" name="vitality_max" placeholder="19" style="width: 35px;"><br>
    <span align="center" style="color: red;">@error('vitality_min') {{ $message }} <br> @enderror</span><br>
    <label for="luck" style="width: 15em">Dexterity: </label><input type="number" name="dexterity_min" placeholder="28" style="width: 35px;">-<input type="number" name="dexterity_max" placeholder="35" style="width: 35px;"><br>
    <span align="center" style="color: red;">@error('luck_min') {{ $message }} <br> @enderror</span><br>
    <label for="buyPrice" style="width: 15em">Buy price: </label><input type="number" name="buyPrice" placeholder="399" style="width: 45px;"><br>
    <span align="center" style="color: red;">@error('buyPrice') {{ $message }} <br> @enderror</span><br>
    <input type="submit" value="Create">
</form>
@include('template.footer')