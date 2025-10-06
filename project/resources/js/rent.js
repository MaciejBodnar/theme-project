/**
 * Rent Form JavaScript
 * Handles custom date picker, time picker, and checkbox functionality for rent space form
 */

document.addEventListener('DOMContentLoaded', function () {
  // Date Picker Functionality
  const dateDisplay = document.getElementById('preferred_date_display');
  const dateHidden = document.getElementById('preferred_date_hidden');
  const calendarPopup = document.getElementById('calendar_popup');

  if (dateDisplay && dateHidden && calendarPopup) {
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
        year: 'numeric',
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

        dayEl.addEventListener('click', function () {
          selectedDate = new Date(year, month, day);
          const formattedDate = selectedDate.toISOString().split('T')[0];
          const displayDate = selectedDate.toLocaleDateString('en-US', {
            weekday: 'short',
            year: 'numeric',
            month: 'short',
            day: 'numeric',
          });

          dateDisplay.value = displayDate;
          dateHidden.value = formattedDate;
          hideCalendar();
        });

        calendarDays.appendChild(dayEl);
      }
    }

    dateDisplay.addEventListener('click', showCalendar);

    if (prevMonthBtn) {
      prevMonthBtn.addEventListener('click', function () {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
      });
    }

    if (nextMonthBtn) {
      nextMonthBtn.addEventListener('click', function () {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
      });
    }

    document.addEventListener('click', function (e) {
      if (!calendarPopup.contains(e.target) && e.target !== dateDisplay) {
        hideCalendar();
      }
    });
  }

  // Time Picker Functionality
  const timeDisplay = document.getElementById('preferred_time_display');
  const timeHidden = document.getElementById('preferred_time_hidden');
  const timePopup = document.getElementById('time_popup');

  if (timeDisplay && timeHidden && timePopup) {
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
        if (amBtn) {
          amBtn.classList.add('bg-[#d1b07a]', 'text-black');
          amBtn.classList.remove('border-white/30', 'text-white');
        }
        if (pmBtn) {
          pmBtn.classList.add('border-white/30', 'text-white');
          pmBtn.classList.remove('bg-[#d1b07a]', 'text-black');
        }
      } else {
        if (pmBtn) {
          pmBtn.classList.add('bg-[#d1b07a]', 'text-black');
          pmBtn.classList.remove('border-white/30', 'text-white');
        }
        if (amBtn) {
          amBtn.classList.add('border-white/30', 'text-white');
          amBtn.classList.remove('bg-[#d1b07a]', 'text-black');
        }
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

    if (hourUpBtn) {
      hourUpBtn.addEventListener('click', function () {
        let hour = parseInt(hourInput.value);
        hour = hour === 12 ? 1 : hour + 1;
        hourInput.value = hour;
      });
    }

    if (hourDownBtn) {
      hourDownBtn.addEventListener('click', function () {
        let hour = parseInt(hourInput.value);
        hour = hour === 1 ? 12 : hour - 1;
        hourInput.value = hour;
      });
    }

    if (minuteUpBtn) {
      minuteUpBtn.addEventListener('click', function () {
        let minute = parseInt(minuteInput.value);
        minute = minute === 59 ? 0 : minute + 1;
        minuteInput.value = minute.toString().padStart(2, '0');
      });
    }

    if (minuteDownBtn) {
      minuteDownBtn.addEventListener('click', function () {
        let minute = parseInt(minuteInput.value);
        minute = minute === 0 ? 59 : minute - 1;
        minuteInput.value = minute.toString().padStart(2, '0');
      });
    }

    if (amBtn) {
      amBtn.addEventListener('click', function () {
        selectedPeriod = 'AM';
        updatePeriodButtons();
      });
    }

    if (pmBtn) {
      pmBtn.addEventListener('click', function () {
        selectedPeriod = 'PM';
        updatePeriodButtons();
      });
    }

    if (timeConfirmBtn) {
      timeConfirmBtn.addEventListener('click', formatTime);
    }

    document.addEventListener('click', function (e) {
      if (!timePopup.contains(e.target) && e.target !== timeDisplay) {
        hideTimePicker();
      }
    });

    updatePeriodButtons();
  }

  // Custom Checkbox Functionality
  function initializeCheckbox(checkboxId) {
    const checkbox = document.getElementById(checkboxId);
    if (checkbox) {
      const checkboxLabel = checkbox.nextElementSibling;
      const checkboxDisplay = checkboxLabel.querySelector('div');

      function updateCheckboxDisplay() {
        if (checkbox.checked) {
          checkboxDisplay.classList.add(
            'checked',
            'border-[#d1b07a]',
            'bg-[#d1b07a]/10'
          );
          checkboxDisplay.classList.remove('border-white/40');
        } else {
          checkboxDisplay.classList.remove(
            'checked',
            'border-[#d1b07a]',
            'bg-[#d1b07a]/10'
          );
          checkboxDisplay.classList.add('border-white/40');
        }
      }

      checkbox.addEventListener('change', updateCheckboxDisplay);
      updateCheckboxDisplay();
    }
  }

  // Initialize both checkboxes
  initializeCheckbox('consent');
  initializeCheckbox('disclaimer');
});
