<div class="FormContainer" @if(!isset($stop)) wire:poll.3s="attack" @endif>
    <img src="{{ asset('avatars/1.PNG') }}" alt="avatar" style="border-radius: 10%; width: 200px; height: 150px">
    <h3>{{ $user->login }}<br> [LVL. {{ $user->level }}]</h3>
    <hr>
    <b style="margin-right: 10px;"><red>HP</red></b><progress value="{{ Illuminate\Support\Facades\session::get('player_current_hp') }}" max="{{ $user->health }}"></progress>
    <br>{{ Illuminate\Support\Facades\session::get('player_current_hp') }}/{{ $user->health }}
</div>