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
        <label for=""><strong>Stats @if (auth()->user()->stats_point > 0)({{  auth()->user()->stats_point }}) @endif</strong></label>
        @if (auth()->user()->stats_point == 0)
        <label for="" style="margin-top: 20px; margin-right: 5px;">Strength:</label>{{ $strength}} <br>
        <label for="" style="margin-top: 20px; margin-right: 5px;">Intelligence:</label>{{ $intelligence}} <br>
        <label for="" style="margin-top: 20px; margin-right: 5px;">Enduracne:</label>{{ $endurance}} <br>
        <label for="" style="margin-top: 20px; margin-right: 5px;">Luck:</label>{{ $luck}} <br>
            @else

        @endif
        
    </div>
@include('template.footer')