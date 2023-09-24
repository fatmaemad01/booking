<x-main-layout title="Calender">


    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.css" rel="stylesheet" />
    
    <style>
        .calendar-container{
            height: 600px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }
    </style>
    
    
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    
    <script> 
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var branchStart = @json($events[0]['branch_start']);
            var branchEnd = @json($events[0]['branch_end']); 
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                slotMinTime: branchStart,
                slotMaxTime: branchEnd,
                events: @json($events),
            });
            calendar.render();
        });
    </script>
    
        <h1>Calender</h1>
        <div id='calendar' class='calendar-container p-4'></div>
      
    </x-main-layout>