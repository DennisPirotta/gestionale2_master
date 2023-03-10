<a href="{{ route($route,$parameters ?? []) }}" class="flex flex-col justify-center p-4 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700">
    <div class="flex justify-center items-center mx-auto mb-2 bg-gray-200 dark:bg-gray-500 rounded-full w-14 h-14 @if(request()->routeIs($route)) !bg-blue-300 @endif ">
        <i class="text-xl text-gray-500 dark:text-gray-300 @if(request()->routeIs($route)) dark:text-gray-600 @endif bi {{ $icon }}"></i>
    </div>
    <div class="font-medium text-center text-gray-500 dark:text-gray-400">{{ $title }}</div>
</a>
