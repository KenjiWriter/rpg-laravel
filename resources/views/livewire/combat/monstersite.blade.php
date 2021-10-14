<div class="FormContainer" @if(!isset($stop)) wire:poll.2s="attack" @endif>
    <img src="{{ asset('monsters/'.$enemi->avatar) }}" alt="avatar" style="border-radius: 10%; width: 200px; height: 150px">
    <h3>
        @if ($enemi->class == 1)
        [BOSS] <br>
        @endif
        {{ $enemi->name }} <br>
         [LVL. {{ $enemi->level }}]
        </h3> 
    <hr>
    <b style="margin-right: 10px;"><red>HP</red></b><progress value="{{ session::get('monster_current_hp'); }}" max="{{ $enemi->health }}"></progress>
    <br>{{ session::get('monster_current_hp'); }}/{{ $enemi->health }}
</div>
