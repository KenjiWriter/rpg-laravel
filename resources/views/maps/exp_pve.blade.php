@include('template.header')
@include('template.menu')
<div class="FormContainer centerDiv">
    <h3>{{ $current_map }}</h3>
    @livewire('combat.results')
    @livewire('combat.drop')
    <div style="display: flex;">
        @livewire('combat.playersite', ['map' => $current_map])
    </div>
    <div>
        @livewire('combat.messages')
    </div>
    <div>
        @livewire('combat.button', ['map' => $current_map])
    </div>
</div>
@include('template.footer')