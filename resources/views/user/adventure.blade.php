@include('template.header')
@include('template.menu')
<h3>Adventure</h3>
@if(session::get('success'))
<green>{{ session::get('success') }}</green>
@endif
@if(session::get('fail'))
<red>{{ session::get('fail') }}</red>
@endif

<h3 style="color: greenyellow">Select area</h5>
    <style>

    </style>
<div class="centerDiv" >
    <div style="display: flex;">
        <div><a href="{{ route('user.adventure.woods') }}"><img src="{{ asset('maps/woods.PNG') }}" alt="" style="width: 200px; height: 150px;" name="woods"><br>Woods</a><br>[Rec lvl. 1-15]</div>
        <div><a href="{{ route('user.adventure.Orcs_valley') }}"><img src="{{ asset('maps/woods.PNG') }}" alt="" style="width: 200px; height: 150px; margin-left:auto; margin-right:auto;" name="Orcs_valley"><br>Orcs valley</a><br>[Rec lvl. 15-30]</div>
        <div><a href=""><img src="{{ asset('maps/woods.PNG') }}" alt="" style="width: 200px; height: 150px; margin-left:auto; margin-right:auto;" name="woods"><br>Woods</a></div>
        <div><a href=""><img src="{{ asset('maps/woods.PNG') }}" alt="" style="width: 200px; height: 150px; margin-left:auto; margin-right:auto;" name="woods"><br>Woods</a></div>
        <div><a href=""><img src="{{ asset('maps/woods.PNG') }}" alt="" style="width: 200px; height: 150px; margin-left:auto; margin-right:auto;" name="woods"><br>Woods</a></div>
    </div>
    <div style="display: flex; margin-top: 5%;">
        <div><a href=""><img src="{{ asset('maps/woods.PNG') }}" alt="" style="width: 200px; height: 150px;" name="woods"><br>Woods</a></div>
        <div><a href=""><img src="{{ asset('maps/woods.PNG') }}" alt="" style="width: 200px; height: 150px; margin-left:auto; margin-right:auto;" name="woods"><br>Woods</a></div>
        <div><a href=""><img src="{{ asset('maps/woods.PNG') }}" alt="" style="width: 200px; height: 150px; margin-left:auto; margin-right:auto;" name="woods"><br>Woods</a></div>
        <div><a href=""><img src="{{ asset('maps/woods.PNG') }}" alt="" style="width: 200px; height: 150px; margin-left:auto; margin-right:auto;" name="woods"><br>Woods</a></div>
        <div><a href=""><img src="{{ asset('maps/woods.PNG') }}" alt="" style="width: 200px; height: 150px; margin-left:auto; margin-right:auto;" name="woods"><br>Woods</a></div>
    </div>
    
</div>
@include('template.footer')