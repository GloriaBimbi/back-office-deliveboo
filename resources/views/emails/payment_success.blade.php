<x-mail::message>
    # Ciao {{ $order->name }}

    Il tuo pagamento di ${{ $order->total_price }} è stato completato con successo.

    Dettagli ordine:
    @foreach ($order->dishes as $dish)
        - {{ $dish->name }} (Quantità: {{ $dish->pivot->quantity }})
    @endforeach

    Grazie per aver acquistato con noi!

    {{-- <x-mail::button :url="$proj_url">
        Vedi dettagli ordine
    </x-mail::button> --}}

    Grazie, il team di Deliveboo
</x-mail::message>