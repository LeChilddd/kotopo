require("@assets/styles/calendar.scss");
import { Calendar } from "@fullcalendar/core";
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";


document.addEventListener("DOMContentLoaded", () => {
    let calendarEl = document.getElementById("calendar-holder");

    let { eventsUrl } = calendarEl.dataset;

    let calendar = new Calendar(calendarEl, {
        editable: true,
        eventSources: [
            {
                url: eventsUrl,
                method: "POST",
                extraParams: {
                    filters: JSON.stringify({}) // pass your parameters to the subscriber
                },
                failure: () => {
                    // alert("There was an error while fetching FullCalendar!");
                },
            },
        ],
        eventDrop: function(info) {
            modifyEvent(info.event)
        },
        eventResize: function(info) {
            modifyEvent(info.event)
        },
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek"
        },
        buttonText: {
            today: "aujourd'hui",
            dayGridMonth: 'mois',
            timeGridWeek: 'semaine',
            timeGridDay: 'jour',
            listWeek: 'liste'
        },
        initialView: "dayGridMonth",
        navLinks: true, // can click day/week names to navigate views
        plugins: [ interactionPlugin, dayGridPlugin, timeGridPlugin, listPlugin],
        timeZone: "UTC",
        locale: "fr",
    });

    calendar.render();
});

function modifyEvent(event) {
    console.log(event)
    let eventId = event.url.charAt(event.url.length - 1)
    let start = event.start;
    let end = event.end;
    let url = "/booking/api/edit/" + eventId;
    console.log(start.toISOString(),end.toISOString());
    $.ajax({
        type:"POST",
        url: url,
        data: JSON.stringify({"beginAt" : start, "endAt" : end}),
        headers: {
            "Content-Type": "application/json",
        },
        success:function(msg){
        },
        error:function(msg){
            alert('Impossible de mettre a jour l\'événement');
        }
    });
}