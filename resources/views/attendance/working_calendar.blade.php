@include('common.inner_header')
@include('common.sidebar')








 <div class="vertical-overlay"></div>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

<!-- ==========================================================Table Start====================================================================== -->
        <div class="page-content">
            <div class="container-fluid">
                <div class="card" id="contactList">
                    <div class="card-header">
                    </div><!--end card-header-->
                    <div class="card-body">
                        <div class="table-responsive table-card">
                           <div id="fullcalendar"></div>
               
                        </div>
      
                    </div><!--end card-body-->
                </div><!--end card-->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
<!-- ==========================================================Table End====================================================================== -->
    </div>
@include('common.inner_footer')
<script type="text/javascript">
	var events = [
  {
    daysOfWeek: [7], //Sundays and saturdays
    rendering: "background",
    color: "red",
    overLap: false,
    allDay: true
  },

  { start: "2020-06-01", title: "8h 0m, 3 issues" },
  { start: "2020-06-02", title: "2h, 1 issue", classNames: "warning" },
  { start: "2020-06-03", title: "8h 0m, 1 issue" },
  { start: "2020-06-04", title: "8h 15m, 2 issues" },
  { start: "2020-06-05", title: "8h, 1 issue" },
  //start: '2020-06-06', title: '8h' },
  //start: '2020-06-07', title: '8h' },
  { start: "2020-06-08", title: "8h, 2 issues" },
  { start: "2020-06-09", title: "8h, 4 issues" },
  { start: "2020-06-10", title: "8h, 1 issue" },
  { start: "2020-06-11", title: "0h", classNames: "error" },
  // Multiple event on one day example
  { start: "2020-06-15", title: "2h", issueKey: "TAS-123" },
  { start: "2020-06-15", title: "2h", issueKey: "TT-456" },
  { start: "2020-06-15", title: "2h", issueKey: "IDT-123" },
  { start: "2020-06-15", title: "2h", issueKey: "IDT-124" }
  // Future events not displayed...
  // { start: '2020-06-12', title: '8h' },
  // //start: '2020-06-13', title: '8h' },
  // //start: '2020-06-14', title: '8h' },
  // { start: '2020-06-15', title: '8h' },
  // { start: '2020-06-16', title: '8h' },
  // { start: '2020-06-17', title: '8h' },
  // { start: '2020-06-18', title: '8h' },
  // { start: '2020-06-19', title: '8h' },
  // //start: '2020-06-20', title: '8h' },
  // //start: '2020-06-21', title: '8h' },
  // { start: '2020-06-22', title: '8h' },
  // { start: '2020-06-23', title: '8h' },
  // { start: '2020-06-24', title: '8h' },
  // { start: '2020-06-25', title: '8h' },
  // { start: '2020-06-26', title: '8h' },
  // //start: '2020-06-27', title: '8h' },
  // //start: '2020-06-28', title: '8h' },
  // { start: '2020-06-29', title: '8h' },
  // { start: '2020-06-30', title: '8h' },
];

$(function () {
  var calendarEl = document.getElementById("fullcalendar");

  var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: ["dayGrid", "timeGrid", "list", "interaction"],
    timeZone: "Asia/Kolkata",
    themeSystem: "standard",
    eventOrder: "start,title,-duration",
    header: {
      //left: 'prevYear,prev, today next,nextYear',
      left: "prev,next today",
      center: "title",
      //right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      right: "dayGridMonth,listYear"
    },
    defaultDate: "2020-06-01",
    firstDay: 1,
    weekNumbers: true,
    eventLimit: false, // allow "more" link when too many events
    //events: 'https://fullcalendar.io/demo-events.json',
    events: events,
    //editable: true,
    droppable: true,
    eventResizableFromStart: true,
    eventResizableFromEnd: true,
    eventDurationEditable: true,
    eventRender: function (info) {
      if (info.view.type === "listMonth") {
        return;
      }

      let eventEl = info.el.querySelector(".fc-content");
      let eventID = info.event.extendedProps.issueKey;
      if (!eventID || !eventEl) return;

      let link = document.createElement("a");
      link.innerHTML = eventID;
      link.title = "Open in Jira";
      link.href = "https://jira.dummyurl.com/browse/" + eventID;
      link.classList.add("float-right");

      eventEl.appendChild(link);
    }
  });

  calendar.render();
});


</script>


