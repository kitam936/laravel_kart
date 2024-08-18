import flatpickr from "flatpickr";

import { Japanese } from "flatpickr/dist/l10n/ja.js";

import 'flatpickr/dist/flatpickr.css';

const setting = {
    "locale" : Japanese,
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true,
    minTime: "8:00",
    maxTime: "16:00"
   }


flatpickr("#date", {
    "locale": Japanese,
    // minDate: "today",
    minDate: "2020-01",
    maxDate: new Date().fp_incr(30)
    });
flatpickr("#start_time", setting);

