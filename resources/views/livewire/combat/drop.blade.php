<div>
    @if (!empty($drops))
    <?php 
        $x = 1;
        $length = count($drops);
    ?>  
    <br><b>Drop:</b> <br>
    @foreach($drops as $drop)   
    <b><span style="color:@if($drop['quality'] === 1) #666699 @elseif($drop['quality'] === 2) #3366cc 
            @elseif($drop['quality'] === 3) #0040ff @elseif($drop['quality'] === 4) #cc00cc 
            @elseif($drop['quality'] === 5) #e6e600 @elseif($drop['quality'] === 6) #ff0000 @endif;">{{ $drop['name'] }}</span></b> x{{ $drop['amount'] }}@if ($x != $length),@endif
    <?php $x++; ?>
    @endforeach
    @endif
</div>
