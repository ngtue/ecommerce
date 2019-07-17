@extends('layouts.app')
@section('content')
    <div class="w-full h-screen flex items-center justify-center text-center">
        <div>
            <p class="text-5xl font-bold">Thank you for</p>
            <p class="text-5xl font-bold">Your Order!</p>
            <p class="text-xl mb-10">A confirmation email was sent</p>
            <a href="{{ route('home') }}" class="text-3xl p-3 bg-indigo-600 text-white font-bold hover:bg-indigo-500">Home Page</a>
        </div>
    </div>
@endsection