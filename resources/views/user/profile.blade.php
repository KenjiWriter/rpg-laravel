@include('template.header')
@include('template.menu')
    <div class="FormContainer centerDiv">
        <h3>Profile</h3>
        <img src="{{ asset('avatars/1.PNG') }}" alt="avatar" style="border-radius: 10%; width: 200px; height: 150px"><br>
        <label for="level" style="margin-top: 10px; margin-right: 5px;">Level </label>{{ auth()->user()->level }} <br>
        <progress  name="lvl-bar" value="{{ auth()->user()->exp  }}" max="{{ auth()->user()->exp_needed }}"> 1% </progress><br>
        <label for="lvl-bar">{{ $exp  }}/{{ $exp_needed }}</label><br>
        <hr>
        <label for="nick" style="margin-right: 5px;">Nick:</label>{{ auth()->user()->login }} <br>
        <hr>
        <label for="" style=" margin-right: 5px;">Max HP:</label>{{ $health}} <br>
        <label for="" style="margin-top: 20px; margin-right: 5px;">Max MP:</label>{{ $mana}} <br>
        <label for="" style="margin-top: 20px; margin-right: 5px;">Max SP:</label>{{ $stamina}} <br>
        <hr>
        <label for=""><strong>Stats @if (auth()->user()->stats_point > 0)({{  auth()->user()->stats_point }}) @endif</strong></label><br>
        @if (Session::get('added'))
            <div style="color: greenyellow">{{ Session::get('added') }}</div>
        @endif
        @if (auth()->user()->stats_point <= 0)
        <label for="" style="margin-top: 20px; margin-right: 5px;">Strength:</label>{{ $strength}} <blue>||</blue> (<red>Physical damage</red> {{ $dmg }}-{{ $dmg_max }})<br>
        <label for="" style="margin-top: 20px; margin-right: 5px;">Intelligence:</label>{{ $intelligence}} <blue>||</blue> (<deepblue>Magical damage</deepblue> {{ $magic_dmg }}-{{ $magic_dmg_max }}, <deepblue>MP</deepblue> {{ $mana }})<br>
        <label for="" style="margin-top: 20px; margin-right: 5px;">Enduracne:</label>{{ $endurance}} <blue>||</blue> (<green>HP</green> {{ $health }}, <yellow>SP</yellow> {{ $stamina }})<br>
        <label for="" style="margin-top: 20px; margin-right: 5px;">Luck:</label>{{ $luck}} <blue>||</blue> (<red>Critical chance</red> {{ $crit_chance }}%)<br>
            @else
        <form action="{{ route('stat.add') }}" method="POST">@csrf <label for="" style="margin-top: 20px; margin-right: 5px;">Strength:</label>{{ $strength}}  <input type="submit" name="strength" value="&plus;"> <blue>||</blue> (<red>Physical damage</red> {{ $dmg }}-{{ $dmg_max }})</form>
        <form action="{{ route('stat.add') }}" method="POST">@csrf <label for="" style="margin-top: 20px; margin-right: 5px;">Intelligence:</label>{{ $intelligence }} <input type="submit" name="intelligence" value="&plus;"> <blue>||</blue> (<deepblue>Magical damage</deepblue> {{ $magic_dmg }}-{{ $magic_dmg_max }}, <deepblue>MP</deepblue> {{ $mana }})</form>
        <form action="{{ route('stat.add') }}" method="POST">@csrf <label for="" style="margin-top: 20px; margin-right: 5px;">Endurance:</label>{{ $endurance}} <input type="submit" name="endurance" value="&plus;"> <blue>||</blue> (<green>HP</green> {{ $health }}, <yellow>SP</yellow> {{ $stamina }})</form>
        <form action="{{ route('stat.add') }}" method="POST">@csrf <label for="" style="margin-top: 20px; margin-right: 5px;">Luck:</label>{{ $luck }} <input type="submit" name="luck" value="&plus;"> <blue>||</blue> (<red>Critical chance</red> {{ $crit_chance }}%)</form>
        @endif
        
    </div>
    
@include('template.footer')