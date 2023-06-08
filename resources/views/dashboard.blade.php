<form action="/logout" method="POST">
    @csrf
    <button type="submit">logout</button>
</form>

@php
    var_dump(auth()->user(),auth()->user()->membership_type)
    @endphp
