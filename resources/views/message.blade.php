@include('navbar')

<form method="POST" action="/message/{{ $receiver->name }}">
    @csrf
    <textarea name="content"></textarea>
    <button type="submit">Trimite</button>
</form>

@foreach ($messages as $message)
    <div style="text-align: {{ $message->sender_id == auth()->id() ? 'right' : 'left' }}">
        {{ $message->content }}
    </div>
@endforeach
