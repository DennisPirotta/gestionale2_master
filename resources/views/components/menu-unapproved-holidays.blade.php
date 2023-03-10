<div class="h-full p-6 bg-white shadow-lg border border-gray-200 rounded-lg w-full dark:border-gray-700 dark:bg-gray-800">
    <div class="flex items-center justify-center md:justify-start">
        <div class="text-2xl justify-start flex items-end dark:text-white">
            <span>
                {{ __('Unapproved Holidays') }}
            </span>
            <span class="border-l ml-2 pl-2 text-gray-400 text-lg align-bottom">
                {{ __('Lifetime') }}
            </span>
        </div>
    </div>
    <div class="pt-3 pb-2">
        <ol class="overflow-y-auto fancy-scrollbar max-h-60 space-y-4 text-gray-500 list-decimal list-inside dark:text-gray-400">
            @foreach($holidays as $user => $user_holidays)
                @php($user = \App\Models\User::find($user))
                <div class="flex items-center space-x-4 ml-5 mr-16">
                    <div class="flex-shrink-0">
                        @if($user->profile_photo_path)
                            <img src="{{ asset('storage').'/'.$user->profile_photo_path }}" alt="{{ $user->name }}" class="rounded-full h-10 w-10 object-cover">
                        @else
                            <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                <span class="font-medium text-gray-600 dark:text-gray-300">{{ $user->name[0] }}{{ $user->surname[0] }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                            {{ $user->name }}{{ $user->surname }}
                        </p>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        {{ $user_holidays->count() }}
                    </div>
                </div>
                <ul class="pl-5 mt-2 space-y-1 list-disc list-inside">
                    @foreach($user_holidays as $holiday)
                        <div class="inline-flex md:w-96 w-72 items-center justify-between p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="w-full">
                                Da <b>{{ Carbon\Carbon::parse($holiday->start)->translatedFormat('l j F Y') }}</b><br>
                                a <b>{{ Carbon\Carbon::parse($holiday->end)->translatedFormat('l j F Y') }}</b>
                            </div>
                            <svg aria-hidden="true" class="w-6 h-6 ml-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </div>
                    @endforeach
                </ul>
            @endforeach
        </ol>

    </div>
</div>
