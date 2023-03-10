<li>
    <a href="{{ route($route,$parameters ?? []) }}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
        <i class="bi {{ $icon }} ml-2 text-xl text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
        <span class="ml-2">{{ $title }}</span>
        <i class="bi bi-arrow-right ml-auto text-xl font-bold text-blue-600 @if(!request()->routeIs($route)) hidden @endif"></i>
    </a>
</li>
