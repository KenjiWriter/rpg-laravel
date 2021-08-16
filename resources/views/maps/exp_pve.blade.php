@include('template.header')
@include('template.menu')
<div class="FormContainer centerDiv">
    <h3>{{ $current_map }}</h3>
    @if(session::get('success'))
    <green>{{ session::get('success') }}</green>
    @endif
    @if(session::get('fail'))
    <red>{{ session::get('fail') }}</red>
    @endif
    @if(session::get('drop'))
    <green><br>{{ session::get('drop') }}</green>
    @endif
    <div style="display: flex;">
        <div class="FormContainer">
            <img src="{{ asset('avatars/1.PNG') }}" alt="avatar" style="border-radius: 10%; width: 200px; height: 150px">
            <h3>{{ auth()->user()->login }} [LVL. {{ auth()->user()->level }}]</h3>
            <hr>
            <b style="margin-right: 10px;"><red>HP</red></b><progress value="{{ $player_current_hp}}" max="{{ auth()->user()->health }}"></progress>
            <br>{{ $player_current_hp }}/{{ auth()->user()->health }}
        </div>
        <div class="FormContainer">
            @foreach ($monster as $enemi)
            <img src="{{ asset('monsters/'.$enemi->avatar) }}" alt="avatar" style="border-radius: 10%; width: 200px; height: 150px">
            <h3>
                @if ($enemi->class == 1)
                [BOSS] <br>
                @endif
                {{ $enemi->name }} <br>
                 [LVL. {{ $enemi->level }}]
                </h3> 
            <hr>
            <b style="margin-right: 10px;"><red>HP</red></b><progress value="{{ $monster_current_hp }}" max="{{ $enemi->health }}"></progress>
            <br>{{ $monster_current_hp }}/{{ $enemi->health }}
            @endforeach
        </div>
    </div>
    <div>
        @if(session::get('damage'))
        <h3><green>{{ session::get('damage') }}<br></green></h3>
        @endif
        @if(session::get('monster damage'))
        <h3><red>{{ session::get('monster damage') }} <br></red></h3>
        @endif
    </div>
    <div>
        <button><a href="{{ route('user.adventure.cancel') }}">Finish adventure</a></button>
    </div>
</div>
@include('template.footer')