// assets/js/script.js
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: 'ajax/calendar_events.php', // Fetch events
        dateClick: function (info) {
            // Show popup for adding new event
            var eventModal = document.getElementById('eventModal');
            eventModal.style.display = 'block';
            document.getElementById('eventTime').value = info.dateStr;
        }
    });
    calendar.render();

    // Close event modal
    var closeModal = document.getElementsByClassName("close")[0];
    closeModal.onclick = function () {
        document.getElementById('eventModal').style.display = "none";
    }

    // Handle form submission for new event
    document.getElementById('eventForm').onsubmit = function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        fetch('ajax/calendar_events.php', {
            method: 'POST',
            body: formData
        }).then(response => response.json())
          .then(data => {
            if (data.success) {
                location.reload(); // Refresh calendar after adding event
            } else {
                alert("Error: " + data.message);
            }
        });
    }
});

// assets/js/analytics.js
document.addEventListener('DOMContentLoaded', function () {
    fetch('includes/insta_analytics.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('engagement').innerText = data.engagement;
            document.getElementById('likeCount').innerText = data.likeCount;
            document.getElementById('ageSegment').innerText = data.ageSegment;
            document.getElementById('genderSegment').innerText = data.genderSegment;
        });
});

