<x-app-layout>
        @auth
        <div class="container mt-4 mb-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-8">
                <div class="feed p-2" id="feed-content">
                        @yield('content') 
                    <div id="posts-content"></div>
                </div>
            </div>
        </div>
        </div>
        @else 
        @yield('welcome')  
        @endauth
</x-app-layout>