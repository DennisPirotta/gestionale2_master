<div class="row-span-2 p-6 bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl dark:border-gray-700 dark:bg-gray-800">
    <div class="flex items-center justify-center md:justify-start">
        <div class="text-2xl justify-start flex items-end">
            <span>
                {{ __('Recent Activities') }}
            </span>
            <span class="border-l ml-2 pl-2 text-gray-400 text-lg align-bottom">
                {{ __('Today') }}
            </span>
        </div>
    </div>
    <ol class="mx-3 relative border-l border-gray-200 dark:border-gray-700">
        @if(($activities = \App\Models\Activity::with('user')->orderByDesc('datetime')->take(5)->get())->count() > 0)
            @foreach($activities as $activity)
                <li class="mb-5 ml-8">
                    <span class="absolute flex items-center justify-center w-8 h-8 bg-blue-100 rounded-full -left-4 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                        @if($activity->action === 'created')
                            <svg class="w-5 h-5 text-green-800 dark:text-green-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z"></path></svg>
                        @elseif($activity->action === 'updated')
                            <svg class="w-5 h-5 text-blue-800 dark:text-blue-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path></svg>
                        @elseif($activity->action === 'deleted')
                            <svg class="w-5 h-5 text-red-800 dark:text-red-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path></svg>
                        @endif
                    </span>
                </li>
                <div class="mb-5 ml-8">
                    <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">{{ __("{$activity->user->name} {$activity->user->surname} has {$activity->action} {$activity->object}") }}
                        <a class="ml-auto text-blue-600 underline dark:text-white decoration-indigo-500" href="{{ $activity->url }}">
                            [#{{ $activity->symbolic_id }}]
                        </a>
                    </h3>
                    <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ \Carbon\Carbon::parse($activity->datetime)->diffForHumans() }}</time>
                </div>
                @endforeach
            <div class="w-full text-blue-600 underline dark:text-white decoration-indigo-500 text-center mt-16">
                <a href="#">
                    {{ __('See more activities') }}
                </a>
            </div>
        @else
            <li class="ml-6">
                <span class="absolute flex items-center justify-center w-8 h-8 bg-blue-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                    <svg class="w-5 h-5 text-blue-800 dark:text-blue-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"></path>
                    </svg>
                </span>
                <h3 class="ml-2 flex items-center text-lg font-semibold text-gray-900 dark:text-white">{{ __('No recent activity found') }}</h3>
            </li>
        @endif
    </ol>
</div>
