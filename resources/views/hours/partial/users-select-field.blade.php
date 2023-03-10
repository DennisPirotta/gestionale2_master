<div class="flex flex-col items-center md:w-80 w-full">
    <div class="w-full flex flex-col items-center">
        <div class="w-full px-4">
            <div x-data="selectConfigs()" x-init="fetchOptions()" class="flex flex-col items-center relative">
                <div class="w-full">
                    <div @click.away="close()" class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="hidden" name="user" x-model="user">
                        <input
                            x-model="filter"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            @mousedown="open()"
                            @keydown.enter.stop.prevent="selectOption()"
                            @keydown.arrow-up.prevent="focusPrevOption()"
                            @keydown.arrow-down.prevent="focusNextOption()"
                            class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        />
                        <button type="submit"  @click="$('#queryData').find('input[name=user]').val(selected.id)" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Cerca
                        </button>
                    </div>
                </div>
                <div x-show="isOpen()" class="absolute shadow bg-white top-100 z-40 w-full lef-0 rounded max-h-select overflow-y-auto svelte-5uyqqj" style="max-height: 300px; top: 100%">
                    <div class="flex flex-col w-full">
                        <template x-for="(option, index) in filteredOptions()" :key="index">
                            <div @click="onOptionClick(index)" :class="classOption(option.id, index)" :aria-selected="focusedOptionIndex === index">
                                <div class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-teal-100">
                                    <div class="w-6 flex flex-col items-center" x-show="option.profile_photo_path">
                                        <div class="flex relative w-5 h-5 bg-orange-500 justify-center items-center m-1 mr-2 w-4 h-4 mt-1 rounded-full ">
                                            <img class="rounded-full" alt="A" x-bind:src="option.profile_photo_path ? 'storage/'+option.profile_photo_path : '{{ asset('images/HD_transparent_picture.png') }}'">
                                        </div>
                                    </div>
                                    <div class="relative inline-flex items-center justify-center w-6 h-6 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600" x-show="!option.profile_photo_path">
                                        <span class="font-medium text-gray-600 dark:text-gray-300" x-text="option.name[0]"></span>
                                    </div>
                                    <div class="w-full items-center flex">
                                        <div class="mx-2 -mt-1"><span x-text="option.name + ' ' + option.surname"></span>
                                            <div class="text-xs truncate w-full normal-case font-normal -mt-1 text-gray-500" x-text="option.email"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function selectConfigs() {
        return {
            filter: '',
            user: '',
            show: false,
            selected: null,
            focusedOptionIndex: null,
            options: null,
            close() {
                this.show = false;
                this.filter = this.selectedName();
                this.focusedOptionIndex = this.selected ? this.focusedOptionIndex : null;
            },
            open() {
                this.show = true;
                this.filter = '';
            },
            toggle() {
                if (this.show) {
                    this.close();
                }
                else {
                    this.open()
                }
            },
            isOpen() { return this.show === true },
            selectedName() { return this.selected ? this.selected.name + ' ' + this.selected.surname : this.filter; },
            classOption(id, index) {
                const isSelected = this.selected ? (id == this.selected.id) : false;
                const isFocused = (index == this.focusedOptionIndex);
                return {
                    'cursor-pointer w-full border-gray-100 border-b hover:bg-blue-50': true,
                    'bg-blue-100': isSelected,
                    'bg-blue-50': isFocused
                };
            },
            fetchOptions() {
                this.options = @json(\App\Models\User::all());
                this.selected = this.filteredOptions().find(item => item.id === {{ request('user',auth()->id()) }})
                this.filter = this.selectedName();
                this.user = this.selected.id
            },
            filteredOptions() {
                return this.options
                    ? this.options.filter(option => {
                        return (option.name.toLowerCase().indexOf(this.filter.toLowerCase()) > -1)
                            || (option.surname.toLowerCase().indexOf(this.filter.toLowerCase()) > -1)
                            || (option.email.toLowerCase().indexOf(this.filter.toLowerCase()) > -1)
                    })
                    : {}
            },
            onOptionClick(index) {
                this.focusedOptionIndex = index;
                this.selectOption();
            },
            selectOption() {
                if (!this.isOpen()) {
                    return;
                }
                this.focusedOptionIndex = this.focusedOptionIndex ?? 0;
                const selected = this.filteredOptions()[this.focusedOptionIndex]
                if (this.selected && this.selected.id == selected.id) {
                    this.filter = '';
                    this.selected = null;
                }
                else {
                    this.selected = selected;
                    this.filter = this.selectedName();
                    console.log(this.selected,this.filter)
                }
                this.close();
            },
            focusPrevOption() {
                if (!this.isOpen()) {
                    return;
                }
                const optionsNum = Object.keys(this.filteredOptions()).length - 1;
                if (this.focusedOptionIndex > 0 && this.focusedOptionIndex <= optionsNum) {
                    this.focusedOptionIndex--;
                }
                else if (this.focusedOptionIndex == 0) {
                    this.focusedOptionIndex = optionsNum;
                }
            },
            focusNextOption() {
                const optionsNum = Object.keys(this.filteredOptions()).length - 1;
                if (!this.isOpen()) {
                    this.open();
                }
                if (this.focusedOptionIndex == null || this.focusedOptionIndex == optionsNum) {
                    this.focusedOptionIndex = 0;
                }
                else if (this.focusedOptionIndex >= 0 && this.focusedOptionIndex < optionsNum) {
                    this.focusedOptionIndex++;
                }
            }
        }

    }
</script>
