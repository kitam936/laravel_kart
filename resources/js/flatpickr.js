import flatpickr from "flatpickr";

import { Japanese } from "flatpickr/dist/l10n/ja.js";

import 'flatpickr/dist/flatpickr.css';

const setting = {
    "locale" : Japanese,
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true,
    minTime: "9:00",
    maxTime: "20:00"
   }


flatpickr("#event_date", {
    "locale": Japanese,
    minDate: "today",
    maxDate: new Date().fp_incr(180)
    });
flatpickr("#start_time", setting);
flatpickr("#end_time",setting);
