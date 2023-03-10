<x-app-layout>

    <x-slot name="path">
        <x-breadcrumb-element route="hours.index" :title="__('Hours')"/>
    </x-slot>

    @php($user = App\Models\User::find(request('user',auth()->id())))
        <div class="overflow-x-auto relative shadow-md rounded-lg bg-white dark:bg-gray-800">
            @if($order_hours->count() === 0 && $technical_report_hours->count() === 0 && $other_hours->count() === 0)
                <h1 class="p-6 text-gray-900">Nessuna ora disponibile</h1>
            @else
                <div class="p-5 grid grid-cols-1 md:grid-cols-3 gap-y-3">
                    <div class="flex items-center justify-center md:justify-start">
                        <div class="text-3xl justify-start flex items-end">
                        <span class="dark:text-white">
                            {{ \App\Models\User::find(request('user',auth()->id()))->surname }}
                            {{ \App\Models\User::find(request('user',auth()->id()))->name }}
                        </span>
                            <span class="border-l ml-2 pl-2 text-gray-400 text-xl align-bottom">{{ \Carbon\Carbon::parse(request('month','now'))->translatedFormat('F Y') }}</span>
                        </div>
                    </div>
                    <div class="text-3xl justify-center flex items-center">

                    </div>
                    <form class="md:flex md:justify-end" id="queryData">
                        <input name="month" type="month" value="{{ request('month',\Carbon\Carbon::now()->format('Y-m')) }}" class="md:h-full w-full mb-2 md:mb-0 md:w-auto form-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block pl-5 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                        @include('hours.partial.users-select-field')
                    </form>
                </div>
                <div class="overflow-x-auto mx-5  rounded-lg">
                    <table class="w-full text-sm text-center text-gray-500 overflow-hidden">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-600 dark:text-white">
                        <tr>
                            <th scope="col" class="py-2 px-4">
                                #
                            </th>
                            @foreach($period as $day)
                                <th scope="col" class="border-l border-gray-300 dark:border-gray-500 @if($day->isToday()) bg-gray-400 dark:bg-gray-500 @endif ">{{ $day->translatedFormat('D') }}<br>{{ $day->translatedFormat('j') }}</th>
                            @endforeach
                            <th scope="col">Tot</th>
                        </tr>
                        </thead>
                        <tbody>
                        @include('hours.partial.order-table-section')
                        @include('hours.partial.technical-report-table-section')
                        @include('hours.partial.other-hours-table-section')
                        </tbody>
                        <tfoot>
                        <tr class="bg-gray-50 dark:bg-gray-400 dark:text-white">
                            <td class="py-2 px-4 border-l ">Parziale</td>
                            <td colspan="{{$period->count()+1}}" class="py-2 px-4 "></td>
                        </tr>
                        <tr class="bg-gray-100 border-b dark:bg-gray-500 dark:text-white dark:border-gray-400">
                            <th scope="row" class="border-r dark:border-gray-400">
                                Totale
                            </th>
                            @foreach($period as $day)
                                <td class="border-r dark:border-gray-400 @if($day->isWeekend() || $day->isHoliday()) bg-blue-200 dark:bg-blue-300 @endif ">
                                    {{ $user->hoursInDay($day)['total'] }}
                                </td>
                            @endforeach
                            <td class="border-r dark:border-gray-400 @if($day->isWeekend() || $day->isHoliday()) bg-blue-200 dark:bg-blue-300 @endif ">{{ $user->hourDetails($period)['total'] }}</td>
                        </tr>
                        <tr class="bg-gray-100 border-b dark:bg-gray-500 dark:text-white dark:border-gray-400">
                            <th scope="row" class="border-r dark:border-gray-400">
                                Straordinari 25%
                            </th>
                            @foreach($period as $day)
                                <td class="border-r dark:border-gray-400 @if($day->isWeekend() || $day->isHoliday()) bg-blue-200 dark:bg-blue-300 @endif @if($user->hoursInDay($day)['str25'] < 0) bg-red-200 text-red-900 @endif">
                                    {{ $user->hoursInDay($day)['str25'] }}
                                </td>
                            @endforeach
                            <td class="border-r dark:border-gray-400 @if($day->isWeekend() || $day->isHoliday()) bg-blue-200 dark:bg-blue-300 @endif @if($user->hourDetails($period)['str25'] < 0) bg-red-200 text-red-900 @endif">{{ $user->hourDetails($period)['str25'] }}</td>
                        </tr>
                        <tr class="bg-gray-100 border-b dark:bg-gray-500 dark:text-white dark:border-gray-400">
                            <th scope="row" class="border-r dark:border-gray-400">
                                Straordinari 50%
                            </th>
                            @foreach($period as $day)
                                <td class="border-r dark:border-gray-400 @if($day->isWeekend() || $day->isHoliday()) bg-blue-200 dark:bg-blue-300 @endif ">{{ $user->hoursInDay($day)['str50'] }}</td>
                            @endforeach
                            <td class="border-r dark:border-gray-400 @if($day->isWeekend() || $day->isHoliday()) bg-blue-200 dark:bg-blue-300 @endif ">{{ $user->hourDetails($period)['str50'] }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="p-5 grid grid-cols-1 md:grid-cols-3 gap-3">
                    <x-report-card :title="'Totale ore'" :icon="'bi-bar-chart'"
                                   :value="$user->hourDetails($period)['total']"></x-report-card>
                    <x-report-card :title="'Ferie'" :icon="'bi-cup-hot'"
                                   :value="$user->hourDetails($period)['holidays']"></x-report-card>
                    <x-report-card :title="'Notte UE'" :icon="'bi-currency-euro'"
                                   :value="$user->hourDetails($period)['eu']"></x-report-card>
                    <x-report-card :title="'Notte Extra UE'" :icon="'bi-globe2'"
                                   :value="$user->hourDetails($period)['xeu']"></x-report-card>
                    <x-report-card :title="'Straordinari 25%'" :icon="'bi-plug'"
                                   :value="$user->hourDetails($period)['str25']"></x-report-card>
                    <x-report-card :title="'Straordinari 50%'" :icon="'bi-plug'"
                                   :value="$user->hourDetails($period)['str50']"></x-report-card>
                </div>
            @endif
        </div>
    <script type="module">
        $(document).click((e)=>{
            $('div[data-popover]').not($('#'+$(e.target).attr('data-popover-target'))).each((i,e)=>{
                $(e).addClass('invisible opacity-0')
                $(e).removeClass('visible opacity-100')
            })
        })

        $('input[name=month]').change( () => {
            $('#queryData').submit()
        })

        $(()=>{
            $('td').focusout( (e)=>{

                let data = $(e.target).data()                               // Prelevo i dati dall' HTML
                let route = '{{ route('hours.store') }}'                    // Route di default create

                data['user_id'] = {{ request('user',auth()->id()) }}        // Ottengo l'utente attivo o desiderato
                data['count'] = parseFloat($(e.target).text().replace(',','.'))              // Prelevo il numero inserito
                data['_method'] = 'POST'                                    // Metodo di default POST

                if (data.hour){                                             // Controllo se la cella modificata contiene già un ora
                    route = '{{ url('hours') }}/'+data.hour                 // Cambio la route in update
                    isNaN(data['count']) ? data['_method'] = 'DELETE' : data['_method'] = 'PUT'
                }

                axios.post(route, data).then( response => {
                    switch (response.data['hour_type_id']){
                        case 1 :
                            axios.post('{{ route('order-details.store') }}',{
                                'order_id': data['order_id'],
                                'hour_id': response.data['id'],
                            }).then(()=>{ location.reload() })
                            break
                        case 2 :
                            axios.post('{{ route('technical-report-details.store') }}',{
                                'technical_report_id': data['technical_report_id'],
                                'hour_id': response.data['id'],
                            }).then(()=>{ location.reload() })
                            break
                        case 6 :
                            console.log('Ora Ferie')
                            break
                        default: location.reload()
                    }
                }).catch(error => console.error(error.response.data.message) )

            }).keypress( e => {
                if (e.which < 48 || e.which > 57) {
                    if(!(e.which == 44 || e.which == 46))
                        e.preventDefault();
                }
                if (e.keyCode === 13) {
                    e.preventDefault();
                    $(e.target).blur()
                }
            })
        })
    </script>
</x-app-layout>
