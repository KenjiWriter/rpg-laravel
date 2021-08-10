@include('template.header')
@include('template.menu')
<div class="FormContainer centerDiv">
    <h3>Woods</h3>
    <div style="display: flex;">
        <div class="FormContainer">
            <img src="{{ asset('avatars/1.PNG') }}" alt="avatar" style="border-radius: 10%; width: 200px; height: 150px">
            <h3>{{ auth()->user()->login }} [LVL. {{ auth()->user()->level }}]</h3>
            <hr>
            <b style="margin-right: 10px;"><red>HP</red></b><progress value="{{ $player_current_hp}}" max="{{ auth()->user()->health }}"></progress>
        </div>
        <div class="FormContainer">
            @foreach ($monster as $enemi)
            <img src="{{ asset('monsters/wild_dog.PNG') }}" alt="avatar" style="border-radius: 10%; width: 200px; height: 150px">
            <h3>{{ $enemi->name }} [LVL. {{ $enemi->level }}]</h3> 
            <hr>
            <b style="margin-right: 10px;"><red>HP</red></b><progress value="{{ $monster_current_hp }}" max="{{ $enemi->health }}"></progress>
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
</div>
@include('template.footer')