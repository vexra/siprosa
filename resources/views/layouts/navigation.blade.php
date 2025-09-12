<nav class="bg-white border-b border-gray-100 p-4 flex items-center justify-between">
    <div class="flex items-center">
        <h1 class="text-xl font-bold text-gray-800">HostD Internet Media</h1>
    </div>

    <div class="flex items-center space-x-4">
        <a href="{{ route('profile.edit') }}" class="text-gray-500 hover:text-gray-700">
            <i class="fas fa-user-circle fa-2x"></i>
        </a>

        <form method="POST" action="{{ route('logout') }}" class="inline-block">
            @csrf
            <a href="{{ route('logout') }}" 
               onclick="event.preventDefault(); this.closest('form').submit();"
               class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-sign-out-alt fa-2x"></i>
            </a>
        </form>
    </div>
</nav>