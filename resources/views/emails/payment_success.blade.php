<x-mail::message>
    # Hi! 😎

    Your payment of ${{ $order->total_price }} has been successfully completed.

    Order Details:
    @foreach ($order->dishes as $dish)
        - {{ $dish->name }} (Quantità: {{ $dish->pivot->quantity }})
    @endforeach

    Thank you for ordering from us!

    {{-- <x-mail::button :url="$proj_url">
        Vedi dettagli ordine
    </x-mail::button> --}}

    Thank You from the Deliveboo Team
</x-mail::message>