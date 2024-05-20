<x-mail::message>
    # Ciao {{ $order->name }}

    Your payment of ${{ $order->total_price }} has been successfully completed.

    Order Details:
    @foreach ($order->dishes as $dish)
        - {{ $dish->name }} (Quantità: {{ $dish->pivot->quantity }})
    @endforeach

    Thank you for ordering from us!

    {{-- <x-mail::button :url="$proj_url">
        Vedi dettagli ordine
    </x-mail::button> --}}

    Grazie, il team di Deliveboo
</x-mail::message>