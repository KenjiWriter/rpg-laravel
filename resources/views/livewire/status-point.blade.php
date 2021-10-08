<div>
<label for=""><strong>Stats (<green>{{ $user->stats_point }}</green>)</strong></label><br>
<input type="number" wire:model="amount" style="height: 30px; width: 30px;"><br>
@if ($fail != '')
    <br><red><b>{{ $fail }}</b></red><br>
@endif
@if ($success != '')
    <br><green><b>{{ $success }}</b></green><br>
@endif  
<label for="" style="margin-top: 20px; margin-right: 5px;">Strength:</label>{{ $user->strength}}  <button wire:click="strength">&plus;</button> <blue>||</blue> (<red>Physical damage</red> {{ App\Http\Controllers\FunctionsController::numConverter($user->physical_damage); }}-{{ App\Http\Controllers\FunctionsController::numConverter($user->physical_damage_max); }})<br>
<label for="" style="margin-top: 20px; margin-right: 5px;">Intelligence:</label>{{ $user->intelligence }} <button wire:click="intelligence">&plus;</button> <blue>||</blue> (<deepblue>Magical damage</deepblue> {{ App\Http\Controllers\FunctionsController::numConverter($user->magical_damage); }}-{{ App\Http\Controllers\FunctionsController::numConverter($user->magical_damage_max); }}, <deepblue>MP</deepblue> {{ App\Http\Controllers\FunctionsController::numConverter($user->mana); }})<br>
<label for="" style="margin-top: 20px; margin-right: 5px;">Endurance:</label>{{ $user->endurance}} <button wire:click="endurance">&plus;</button> <blue>||</blue> (<green>HP</green> {{ App\Http\Controllers\FunctionsController::numConverter($user->health); }}, <yellow>SP</yellow> {{ App\Http\Controllers\FunctionsController::numConverter($user->stamina); }})<br>
<label for="" style="margin-top: 20px; margin-right: 5px;">Dexterity:</label>{{ $user->dexterity }} <button wire:click="dexterity">&plus;</button> <blue>||</blue> (<red>Critical chance</red> {{ App\Http\Controllers\FunctionsController::numConverter($user->critical_chance); }}%)<br>
</div>