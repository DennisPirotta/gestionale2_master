@foreach($other_hours as $type=>$other_hour)
    <tr class="bg-gray-50 dark:bg-gray-400 dark:text-white">
        <td class="py-2 px-4 border-l">{{ __(\App\Models\HourType::find($type)->description) }}</td>
        <td colspan="{{$period->count()+1}}" class="py-2 px-4"></td>
    </tr>
    <tr class="bg-gray-100 border-b dark:bg-gray-500 dark:text-white dark:border-gray-400">
        <th scope="row" class="border-r p-1.5 dark:border-gray-400"></th>
        @php($count = 0)
        @foreach($period as $day)
            <td class="border-r dark:border-gray-400 @if($day->isWeekend() || $day->isHoliday()) bg-blue-200 dark:bg-blue-300 @endif ">
                <div    contenteditable="true"
                        data-date="{{ $day->format('Y-m-d') }}"
                        data-hour_type_id="{{ $type }}"
                        @if($other_hour->contains(function($value,$key) use ($day){ return $value->date == $day->format('Y-m-d'); })) class="hidden" @endif
                ></div>
                @foreach($other_hour as $record)
                    @if($record->date == $day->format('Y-m-d'))
                        @php($count+=$record->count)
                        <div contenteditable="true" data-hour="{{ $record->id }}">
                            {{ $record->count }}
                        </div>
                        @if($record->description)
                            <i class="bi bi-info-circle text-blue-500" data-bs-toggle="popover" data-bs-title="Info" data-bs-content="{{ $record->description }}"></i>
                        @endif
                    @endif
                @endforeach
            </td>
        @endforeach
        <td>{{ $count }}</td>
    </tr>
@endforeach
