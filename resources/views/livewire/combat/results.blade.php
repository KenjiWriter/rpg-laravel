<div>
    @if (isset($result))
        @if($result === 1)
            <h3><green>Won!</green></h3>
            Gain: <yellow>{{ $gold }}</yellow> coins and <green>{{ $exp }}</green> exp!   
        @else 
            <h3><red>Lose!</red></h3>
        @endif
    @endif
</div>
