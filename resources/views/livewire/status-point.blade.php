<div>
<label for=""><strong>Stats (<green>{{ $user->stats_point }}</green>)</strong></label><br>
<input type="number" wire:model="amount" style="height: 30px; width: 30px;"><br>
@if ($fail != '')
    <br><red><b>{{ $fail }}</b></red><br>
@endif
@if ($success != '')
    <br><green><b>{{ $success }}</b></green><br>
@endif  
<label for="" style="margin-top: 20px; margin-right: 5px;">Strength:</label>{{ $user->strength}}  <button wire:click="strength" wire:model="strengthbind">&plus;</button> <blue>||</blue> (<red>Physical damage</red> {{ $user->physical_damage }}-{{ $user->physical_damage_max }})<br>
<label for="" style="margin-top: 20px; margin-right: 5px;">Intelligence:</label>{{ $user->intelligence }} <button wire:click="intelligence">&plus;</button> <blue>||</blue> (<deepblue>Magical damage</deepblue> {{ $user->magical_damage }}-{{ $user->magical_damage_max }}, <deepblue>MP</deepblue> {{ $user->mana }})<br>
<label for="" style="margin-top: 20px; margin-right: 5px;">Endurance:</label>{{ $user->endurance}} <button wire:click="endurance">&plus;</button> <blue>||</blue> (<green>HP</green> {{ $user->health }}, <yellow>SP</yellow> {{ $user->stamina }})<br>
<label for="" style="margin-top: 20px; margin-right: 5px;">Dexterity:</label>{{ $user->dexterity }} <button wire:click="dexterity">&plus;</button> <blue>||</blue> (<red>Critical chance</red> {{ $user->critical_chance }}%)<br>
</div>