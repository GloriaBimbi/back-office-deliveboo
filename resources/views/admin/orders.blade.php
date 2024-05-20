@extends('layouts.app')

@section('title', 'Received Orders')

@section('content')
    <section>
        <div class="container my-5">
            <h1 class="text-white text-center mb-3">Received Orders</h1>
            {{-- go back to homepage  --}}
            <a href="{{ route('admin.dashboard') }}" class="back-button from-dashboard"><i
            class="fa-solid fa-arrow-rotate-left"></i> Back to Dashboard</a>

            <table class="table bg-white">
                <thead>
                    <tr>
                        <th scope="col">
                            <a href="{{ route('admin.orders.index', ['sort' => 'id', 'direction' => $sortField == 'id' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">
                                ID
                                @if ($sortField == 'id')
                                    @if ($sortDirection == 'asc')
                                        &uarr;
                                    @else
                                        &darr;
                                    @endif
                                @endif
                            </a>
                        </th>

                        <th scope="col">
                            <a href="{{ route('admin.orders.index', ['sort' => 'id', 'direction' => $sortField == 'name' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">
                                Customer's Name
                                @if ($sortField == 'id')
                                    @if ($sortDirection == 'asc')
                                        &uarr;
                                    @else
                                        &darr;
                                    @endif
                                @endif
                            </a>
                        </th>

                        <th scope="col">
                            <a href="{{ route('admin.orders.index', ['sort' => 'id', 'direction' => $sortField == 'lastname' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">
                                Customer's Lastname
                                @if ($sortField == 'id')
                                    @if ($sortDirection == 'asc')
                                        &uarr;
                                    @else
                                        &darr;
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th scope="col">
                            <a href="{{ route('admin.orders.index', ['sort' => 'id', 'direction' => $sortField == 'address' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">
                                Delivery Address
                                @if ($sortField == 'id')
                                    @if ($sortDirection == 'asc')
                                        &uarr;
                                    @else
                                        &darr;
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th scope="col">
                            <a href="{{ route('admin.orders.index', ['sort' => 'id', 'direction' => $sortField == 'email' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">
                                Customer's Email
                                @if ($sortField == 'id')
                                    @if ($sortDirection == 'asc')
                                        &uarr;
                                    @else
                                        &darr;
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th scope="col">
                            <a href="{{ route('admin.orders.index', ['sort' => 'id', 'direction' => $sortField == 'phone' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">
                                Customer's Phone Number
                                @if ($sortField == 'id')
                                    @if ($sortDirection == 'asc')
                                        &uarr;
                                    @else
                                        &darr;
                                    @endif
                                @endif
                            </a>
                        </th>

                        <th scope="col">
                            <a href="{{ route('admin.orders.index', ['sort' => 'created_at', 'direction' => $sortField == 'created_at' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">
                                Data 
                                @if ($sortField == 'created_at')
                                    @if ($sortDirection == 'asc')
                                        &uarr;
                                    @else
                                        &darr;
                                    @endif
                                @endif
                            </a>
                        </th>

                        <th scope="col">
                            <a href="{{ route('admin.orders.index', ['sort' => 'total_price', 'direction' => $sortField == 'total' && $sortDirection == 'asc' ? 'desc' : 'asc']) }}">
                                Totale
                                @if ($sortField == 'total')
                                    @if ($sortDirection == 'asc')
                                        &uarr;
                                    @else
                                        &darr;
                                    @endif
                                @endif
                            </a>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <th scope="row">{{ $order->id }}</th>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->lastname }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>${{ $order->total_price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{ $orders->appends(request()->except('page'))->links() }}
            
        </div>
    </section>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .container{
        position: relative;
    }
</style>
@endsection