@if($technical_report_hours->count() > 0)
    <tr class="bg-gray-50 dark:bg-gray-400 dark:text-white">
        <td class="py-2 px-4 border-l">{{__('Technical Reports')}}</td>
        <td colspan="{{$period->count()+1}}" class="py-2 px-4"></td>
    </tr>
    @foreach($technical_report_hours as $technical_report_hour)
        <tr class="bg-gray-100 border-b dark:bg-gray-500 dark:text-white dark:border-gray-400">
            <th scope="row" class="border-r p-1.5">
                {{ $technical_report_hour->first()->technical_report->number }} <br>
                {{ $technical_report_hour->first()->technical_report->customer->name }}
            </th>
            @php($count=0)
            @foreach($period as $day)
                <td class="border-r dark:border-gray-400 @if($day->isWeekend() || $day->isHoliday()) bg-blue-200 dark:bg-blue-300 @endif ">
                    <div    contenteditable="true"
                            data-technical_report_id="{{ $technical_report_hour->first()->technical_report->id }}"
                            data-date="{{ $day->format('Y-m-d') }}"
                            data-hour_type_id="2"
                            @if($technical_report_hour->contains(function($value,$key) use ($day){ return $value->hour->date == $day->format('Y-m-d'); })) class="hidden" @endif
                    ></div>
                    @foreach($technical_report_hour as $record)
                        @if($record->hour->date == $day->format('Y-m-d'))
                            @php($count+=$record->hour->count)
                            <div contenteditable="true" data-hour="{{ $record->hour->id }}">
                                {{ $record->hour->count }}
                            </div>
                            @if($record->nightEU)
                                <div data-popover-target="night-{{ $record->id }}" data-popover-trigger="click" class="cursor-pointer mx-1 bg-blue-200 text-blue-800 text-sm font-medium px-1 py-0.5 rounded">
                                    EU
                                </div>
                            @elseif($record->nightExtraEU)
                                <div data-popover-target="night-{{ $record->id }}" data-popover-trigger="click" class="cursor-pointer mx-1 bg-green-300 text-green-800 text-sm font-medium px-1 py-0.5 rounded">
                                    XEU
                                </div>
                            @else
                                <div data-popover-target="night-{{ $record->id }}" data-popover-trigger="click" class="cursor-pointer mx-1 bg-yellow-100 text-yellow-800 text-sm font-medium px-1 py-0.5 rounded">
                                    NO
                                </div>
                            @endif
                                <div data-popover id="night-{{ $record->id }}" role="tooltip" class="absolute z-10 invisible inline-block w-64 text-sm font-light text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0">
                                    <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg">
                                        <p class="mb-0 font-semibold text-gray-900">{{__('Edit Night')}}</p>
                                    </div>
                                    <div class="px-3 py-2">
                                        <button type="submit" onclick="axios.post('{{ route('technical-report-details.update',$record) }}', { '_method': 'PUT', 'night_eu':1, 'night_xeu':0 }).then(()=>{location.reload()})" class="cursor-pointer mx-2 text-sm font-medium px-2.5 py-0.5 rounded bg-blue-200 text-blue-800">
                                            EU
                                        </button>
                                        <button type="submit" onclick="axios.post('{{ route('technical-report-details.update',$record) }}', { '_method': 'PUT', 'night_eu':0, 'night_xeu':1 }).then(()=>{location.reload()})" class="cursor-pointer mx-2 text-sm font-medium px-2.5 py-0.5 rounded bg-green-300 text-green-800">
                                            XEU
                                        </button>
                                        <button type="submit" onclick="axios.post('{{ route('technical-report-details.update',$record) }}', { '_method': 'PUT', 'night_eu':0, 'night_xeu':0 }).then(()=>{location.reload()})" class="cursor-pointer mx-2 text-sm font-medium px-2.5 py-0.5 rounded bg-yellow-100 text-yellow-800">
                                            NO
                                        </button>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                        @endif
                    @endforeach
                </td>
            @endforeach
            <td>{{ $count }}</td>
        </tr>
    @endforeach
@endif
