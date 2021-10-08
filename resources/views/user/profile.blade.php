@include('template.header')
@include('template.menu')
    <div class="FormContainer centerDiv">
        <h3>Profile</h3>
        <img src="{{ asset('avatars/1.PNG') }}" alt="avatar" style="border-radius: 10%; width: 200px; height: 150px"><br>
        <label for="level" style="margin-top: 10px; margin-right: 5px;">Level </label>{{ auth()->user()->level }} <br>
        <progress  name="lvl-bar" value="{{ auth()->user()->exp  }}" max="{{ auth()->user()->exp_needed }}"> 1% </progress><br>
        <label for="lvl-bar">{{ $exp  }}/{{ $exp_needed }}</label><br>
        <hr>
        <label for="nick" style="margin-right: 5px;">Nick:</label><b>{{ auth()->user()->login }}</b><br>
        @if (auth()->user()->stats_point <= 0)
        <label for="" style="margin-top: 20px; margin-right: 5px;">Strength </label>{{ auth()->user()->strength}} <blue>||</blue> (<red>Physical damage</red> {{ App\Http\Controllers\FunctionsController::numConverter(auth()->user()->physical_damage); }}-{{ App\Http\Controllers\FunctionsController::numConverter(auth()->user()->physical_damage_max); }})<br>
        <label for="" style="margin-top: 20px; margin-right: 5px;">Intelligence </label>{{ auth()->user()->intelligence}} <blue>||</blue> (<deepblue>Magical damage</deepblue> {{ App\Http\Controllers\FunctionsController::numConverter(auth()->user()->magical_damage); }}-{{ App\Http\Controllers\FunctionsController::numConverter(auth()->user()->magical_damage_max); }}, <deepblue>MP</deepblue> {{ App\Http\Controllers\FunctionsController::numConverter(auth()->user()->mana); }})<br>
        <label for="" style="margin-top: 20px; margin-right: 5px;">Enduracne </label>{{ auth()->user()->endurance}} <blue>||</blue> (<green>HP</green> {{ App\Http\Controllers\FunctionsController::numConverter(auth()->user()->health); }}, <yellow>SP</yellow> {{ App\Http\Controllers\FunctionsController::numConverter(auth()->user()->stamina); }})<br>
        <label for="" style="margin-top: 20px; margin-right: 5px;">Dexterity </label>{{ auth()->user()->dexterity}} <blue>||</blue> (<red>Critical chance</red> {{ App\Http\Controllers\FunctionsController::numConverter(auth()->user()->critical_chance); }}%)<br>
            @else
        @livewire('status-point')
        @endif
        
    </div>
    
@include('template.footer')