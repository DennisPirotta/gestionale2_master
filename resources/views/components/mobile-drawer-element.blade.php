<a href="{{ route($route,$parameters ?? []) }}" class="flex flex-col justify-center p-4 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 dark:hover:bg-gray-600 dark:bg-gray-700">
    <div class="flex justify-center items-center p-2 mx-auto mb-2 max-w-[48px] bg-gray-200 dark:bg-gray-500 rounded-full w-18 h-18 @if(request()->routeIs($route)) !bg-blue-300 @endif ">
        <i class="inline text-xl w-8 h-8 text-gray-500 pl-1.5 dark:text-gray-400 bi {{ $icon }}"></i>
    </div>
    <div class="font-medium text-center text-gray-500 dark:text-gray-400">{{ $title }}</div>
</a>
