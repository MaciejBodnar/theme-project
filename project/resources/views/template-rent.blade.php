{{--
  Template Name: Rent Space
  Template Post Type: page
--}}

@extends('layouts.app')

@section('content')
    <section class="bg-black text-white py-20 px-4" style="--gold: {{ $rent['settings']['gold_color'] }};">
        <div class="max-w-screen-xl mx-auto">

            <h1 class="text-[var(--gold)] text-4xl md:text-8xl mb-16 text-center md:text-left">
                {{ $rent['content']['title'] }}
            </h1>

            <div class="grid md:grid-cols-3 gap-12">

                <div class="space-y-8 text-white/80 leading-relaxed">
                    <div>
                        <h2 class="uppercase text-white font-bold mb-2">
                            {{ $rent['content']['subtitle'] }}</h2>
                        <p>{!! $rent['content']['description'] !!}</p>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <form class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label for="first_name" class="block text-[#B3B3B3] mb-2">Name</label>
                            <input type="text" name="first_name"
                                class="w-full bg-transparent border border-white/30 focus:outline-none focus:border-[#d1b07a] px-3 py-4 placeholder-white/40"
                                placeholder="">
                        </div>
                        <div>
                            <label for="last_name" class="block text-[#B3B3B3] mb-2">Surname</label>
                            <input type="text" name="last_name"
                                class="w-full bg-transparent border border-white/30 focus:outline-none focus:border-[#d1b07a] px-3 py-4 placeholder-white/40"
                                placeholder="">
                        </div>

                        <div>
                            <label for="email" class="block text-[#B3B3B3] mb-2">Email</label>
                            <input type="email" name="email"
                                class="w-full bg-transparent border border-white/30 focus:outline-none focus:border-[#d1b07a] px-3 py-4">
                        </div>
                        <div>
                            <label for="phone" class="block text-[#B3B3B3] mb-2">Contact Number</label>
                            <input type="tel" name="phone"
                                class="w-full bg-transparent border border-white/30 focus:outline-none focus:border-[#d1b07a] px-3 py-4">
                        </div>
                        <div class="relative">
                            <label for="preferred_date" class="block text-[#B3B3B3] mb-2">Preferred date</label>
                            <div class="relative">
                                <input type="text" id="preferred_date_display" readonly
                                    class="w-full bg-transparent border border-white/30 focus:outline-none focus:border-[#d1b07a] px-3 py-4 text-white cursor-pointer"
                                    placeholder="Select date">
                                <input type="date" name="preferred_date" id="preferred_date_hidden" class="hidden">
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                    <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div id="calendar_popup"
                                class="absolute top-full left-0 mt-2 bg-black border border-[#d1b07a] rounded-lg p-4 hidden z-50 w-80">
                                <div class="flex items-center justify-between mb-4">
                                    <button type="button" id="prev_month" class="text-white hover:text-[#d1b07a] p-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                    </button>
                                    <h3 id="current_month" class="text-white font-semibold"></h3>
                                    <button type="button" id="next_month" class="text-white hover:text-[#d1b07a] p-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="grid grid-cols-7 gap-1 mb-2">
                                    <div class="text-[#B3B3B3] text-xs text-center py-2">Sun</div>
                                    <div class="text-[#B3B3B3] text-xs text-center py-2">Mon</div>
                                    <div class="text-[#B3B3B3] text-xs text-center py-2">Tue</div>
                                    <div class="text-[#B3B3B3] text-xs text-center py-2">Wed</div>
                                    <div class="text-[#B3B3B3] text-xs text-center py-2">Thu</div>
                                    <div class="text-[#B3B3B3] text-xs text-center py-2">Fri</div>
                                    <div class="text-[#B3B3B3] text-xs text-center py-2">Sat</div>
                                </div>
                                <div id="calendar_days" class="grid grid-cols-7 gap-1"></div>
                            </div>
                        </div>

                        <div class="relative">
                            <label for="preferred_time" class="block text-[#B3B3B3] mb-2">Preferred time</label>
                            <div class="relative">
                                <input type="text" id="preferred_time_display" readonly
                                    class="w-full bg-transparent border border-white/30 focus:outline-none focus:border-[#d1b07a] px-3 py-4 text-white cursor-pointer"
                                    placeholder="Select time">
                                <input type="time" name="preferred_time" id="preferred_time_hidden" class="hidden">
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                    <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div id="time_popup"
                                class="absolute top-full left-0 mt-2 bg-black border border-[#d1b07a] rounded-lg p-4 hidden z-50 w-64">
                                <div class="flex items-center justify-center space-x-4">
                                    <div class="text-center">
                                        <label class="block text-[#B3B3B3] text-xs mb-2">Hour</label>
                                        <div class="flex flex-col">
                                            <button type="button" id="hour_up"
                                                class="text-white hover:text-[#d1b07a] p-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 15l7-7 7 7"></path>
                                                </svg>
                                            </button>
                                            <input type="number" id="hour_input" min="1" max="12"
                                                value="12"
                                                class="w-12 bg-transparent border border-white/30 text-center text-white py-2 focus:outline-none focus:border-[#d1b07a]">
                                            <button type="button" id="hour_down"
                                                class="text-white hover:text-[#d1b07a] p-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="text-white text-xl">:</div>
                                    <div class="text-center">
                                        <label class="block text-[#B3B3B3] text-xs mb-2">Minute</label>
                                        <div class="flex flex-col">
                                            <button type="button" id="minute_up"
                                                class="text-white hover:text-[#d1b07a] p-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 15l7-7 7 7"></path>
                                                </svg>
                                            </button>
                                            <input type="number" id="minute_input" min="0" max="59"
                                                value="00"
                                                class="w-12 bg-transparent border border-white/30 text-center text-white py-2 focus:outline-none focus:border-[#d1b07a]">
                                            <button type="button" id="minute_down"
                                                class="text-white hover:text-[#d1b07a] p-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <label class="block text-[#B3B3B3] text-xs mb-2">Period</label>
                                        <div class="flex flex-col space-y-1">
                                            <button type="button" id="am_btn"
                                                class="px-3 py-1 border border-white/30 text-white hover:border-[#d1b07a] hover:text-[#d1b07a] rounded text-sm">AM</button>
                                            <button type="button" id="pm_btn"
                                                class="px-3 py-1 border border-white/30 text-white hover:border-[#d1b07a] hover:text-[#d1b07a] rounded text-sm">PM</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 flex justify-end">
                                    <button type="button" id="time_confirm"
                                        class="px-4 py-2 bg-[#d1b07a] text-black rounded hover:bg-[#d1b07a]/80 text-sm">
                                        Set Time
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- TODO ADD ACF --}}
                        <div class="md:col-span-2 flex items-start gap-3 text-white/70">
                            <div class="relative flex-shrink-0 mt-[2px]">
                                <input id="consent" type="checkbox" class="sr-only">
                                <label for="consent" class="cursor-pointer">
                                    <div
                                        class="w-7 h-7 border border-white/40 bg-transparent rounded-sm flex items-center justify-center transition-all duration-200 hover:border-[#d1b07a] group">
                                        <svg class="w-4 h-4 text-[#d1b07a] opacity-0 transition-opacity duration-200 group-[.checked]:opacity-100"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </label>
                            </div>
                            <label for="consent" class="text-[#B3B3B3] cursor-pointer">
                                {!! $rent['form']['terms']['checkbox_text'] !!}
                            </label>
                        </div>
                        <div class="md:col-span-2 flex items-start gap-3 text-white/70">
                            <div class="relative flex-shrink-0 mt-[2px]">
                                <input id="consent" type="checkbox" class="sr-only">
                                <label for="consent" class="cursor-pointer">
                                    <div
                                        class="w-7 h-7 border border-white/40 bg-transparent rounded-sm flex items-center justify-center transition-all duration-200 hover:border-[#d1b07a] group">
                                        <svg class="w-4 h-4 text-[#d1b07a] opacity-0 transition-opacity duration-200 group-[.checked]:opacity-100"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </label>
                            </div>
                            <label for="consent" class="text-[#B3B3B3] cursor-pointer">
                                {!! $rent['form']['terms']['disclaimer_text'] !!}
                            </label>
                        </div>

                        <div class="md:col-span-2">
                            <button type="submit"
                                class="inline-flex items-center justify-center border border-[#d1b07a] px-30 py-5 text-sm hover:bg-white/5 transition">
                                {{ $rent['form']['submit_button_text'] }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateDisplay = document.getElementById('preferred_date_display');
            const dateHidden = document.getElementById('preferred_date_hidden');
            const calendarPopup = document.getElementById('calendar_popup');
            const currentMonthEl = document.getElementById('current_month');
            const calendarDays = document.getElementById('calendar_days');
            const prevMonthBtn = document.getElementById('prev_month');
            const nextMonthBtn = document.getElementById('next_month');

            let currentDate = new Date();
            let selectedDate = null;

            function showCalendar() {
                calendarPopup.classList.remove('hidden');
                renderCalendar();
            }

            function hideCalendar() {
                calendarPopup.classList.add('hidden');
            }

            function renderCalendar() {
                const year = currentDate.getFullYear();
                const month = currentDate.getMonth();

                currentMonthEl.textContent = new Intl.DateTimeFormat('en-US', {
                    month: 'long',
                    year: 'numeric'
                }).format(currentDate);

                const firstDay = new Date(year, month, 1).getDay();
                const daysInMonth = new Date(year, month + 1, 0).getDate();

                calendarDays.innerHTML = '';

                for (let i = 0; i < firstDay; i++) {
                    const emptyDay = document.createElement('div');
                    calendarDays.appendChild(emptyDay);
                }

                for (let day = 1; day <= daysInMonth; day++) {
                    const dayEl = document.createElement('button');
                    dayEl.type = 'button';
                    dayEl.textContent = day;
                    dayEl.className =
                        'w-8 h-8 text-white hover:bg-[#d1b07a] hover:text-black rounded text-sm transition-colors';

                    dayEl.addEventListener('click', function() {
                        selectedDate = new Date(year, month, day);
                        const formattedDate = selectedDate.toISOString().split('T')[0];
                        const displayDate = selectedDate.toLocaleDateString('en-US', {
                            weekday: 'short',
                            year: 'numeric',
                            month: 'short',
                            day: 'numeric'
                        });

                        dateDisplay.value = displayDate;
                        dateHidden.value = formattedDate;
                        hideCalendar();
                    });

                    calendarDays.appendChild(dayEl);
                }
            }

            dateDisplay.addEventListener('click', showCalendar);
            prevMonthBtn.addEventListener('click', function() {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar();
            });
            nextMonthBtn.addEventListener('click', function() {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar();
            });

            document.addEventListener('click', function(e) {
                if (!calendarPopup.contains(e.target) && e.target !== dateDisplay) {
                    hideCalendar();
                }
            });

            const timeDisplay = document.getElementById('preferred_time_display');
            const timeHidden = document.getElementById('preferred_time_hidden');
            const timePopup = document.getElementById('time_popup');
            const hourInput = document.getElementById('hour_input');
            const minuteInput = document.getElementById('minute_input');
            const hourUpBtn = document.getElementById('hour_up');
            const hourDownBtn = document.getElementById('hour_down');
            const minuteUpBtn = document.getElementById('minute_up');
            const minuteDownBtn = document.getElementById('minute_down');
            const amBtn = document.getElementById('am_btn');
            const pmBtn = document.getElementById('pm_btn');
            const timeConfirmBtn = document.getElementById('time_confirm');

            let selectedPeriod = 'AM';

            function showTimePicker() {
                timePopup.classList.remove('hidden');
                updatePeriodButtons();
            }

            function hideTimePicker() {
                timePopup.classList.add('hidden');
            }

            function updatePeriodButtons() {
                if (selectedPeriod === 'AM') {
                    amBtn.classList.add('bg-[#d1b07a]', 'text-black');
                    amBtn.classList.remove('border-white/30', 'text-white');
                    pmBtn.classList.add('border-white/30', 'text-white');
                    pmBtn.classList.remove('bg-[#d1b07a]', 'text-black');
                } else {
                    pmBtn.classList.add('bg-[#d1b07a]', 'text-black');
                    pmBtn.classList.remove('border-white/30', 'text-white');
                    amBtn.classList.add('border-white/30', 'text-white');
                    amBtn.classList.remove('bg-[#d1b07a]', 'text-black');
                }
            }

            function formatTime() {
                const hour = parseInt(hourInput.value);
                const minute = minuteInput.value.padStart(2, '0');
                const period = selectedPeriod;

                const displayTime = `${hour}:${minute} ${period}`;
                let hour24 = hour;
                if (period === 'PM' && hour !== 12) {
                    hour24 += 12;
                } else if (period === 'AM' && hour === 12) {
                    hour24 = 0;
                }

                const hiddenTime = `${hour24.toString().padStart(2, '0')}:${minute}`;

                timeDisplay.value = displayTime;
                timeHidden.value = hiddenTime;
                hideTimePicker();
            }

            timeDisplay.addEventListener('click', showTimePicker);

            hourUpBtn.addEventListener('click', function() {
                let hour = parseInt(hourInput.value);
                hour = hour === 12 ? 1 : hour + 1;
                hourInput.value = hour;
            });

            hourDownBtn.addEventListener('click', function() {
                let hour = parseInt(hourInput.value);
                hour = hour === 1 ? 12 : hour - 1;
                hourInput.value = hour;
            });

            minuteUpBtn.addEventListener('click', function() {
                let minute = parseInt(minuteInput.value);
                minute = minute === 59 ? 0 : minute + 1;
                minuteInput.value = minute.toString().padStart(2, '0');
            });

            minuteDownBtn.addEventListener('click', function() {
                let minute = parseInt(minuteInput.value);
                minute = minute === 0 ? 59 : minute - 1;
                minuteInput.value = minute.toString().padStart(2, '0');
            });

            amBtn.addEventListener('click', function() {
                selectedPeriod = 'AM';
                updatePeriodButtons();
            });

            pmBtn.addEventListener('click', function() {
                selectedPeriod = 'PM';
                updatePeriodButtons();
            });

            timeConfirmBtn.addEventListener('click', formatTime);

            document.addEventListener('click', function(e) {
                if (!timePopup.contains(e.target) && e.target !== timeDisplay) {
                    hideTimePicker();
                }
            });

            updatePeriodButtons();

            // Custom Checkbox Functionality
            const consentCheckbox = document.getElementById('consent');
            const checkboxLabel = consentCheckbox.nextElementSibling;
            const checkboxDisplay = checkboxLabel.querySelector('div');

            function updateCheckboxDisplay() {
                if (consentCheckbox.checked) {
                    checkboxDisplay.classList.add('checked', 'border-[#d1b07a]', 'bg-[#d1b07a]/10');
                    checkboxDisplay.classList.remove('border-white/40');
                } else {
                    checkboxDisplay.classList.remove('checked', 'border-[#d1b07a]', 'bg-[#d1b07a]/10');
                    checkboxDisplay.classList.add('border-white/40');
                }
            }

            consentCheckbox.addEventListener('change', updateCheckboxDisplay);

            // Initialize checkbox state
            updateCheckboxDisplay();
        });
    </script>
@endsection
