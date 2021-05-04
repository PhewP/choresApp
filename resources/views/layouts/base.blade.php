<x-app-layout>
        @auth
        @yield('content') 
        @else 
        @yield('welcome')  
        @endauth
</x-app-layout>