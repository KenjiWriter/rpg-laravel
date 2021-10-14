
@if (isset($result))
<button><a href="{{ route('user.adventure.'.$map) }}" style="color:green;">Next battle</a></button>
@endif
<button><a href="{{ route('user.adventure.cancel') }}" style="color: red;">Finish adventure</a></button>

