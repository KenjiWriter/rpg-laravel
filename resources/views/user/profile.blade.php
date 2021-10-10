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
        @livewire('status-point')
        
    </div>
    
@include('template.footer')