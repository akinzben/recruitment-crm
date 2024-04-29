<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Shifts Board</title>
  <link rel="stylesheet" href="../css/main.css">
  <style>
    
  </style>
</head>
<body>
    <button id="showCalendarByWeek">Week</button>
    <button id="showCalendarByMonth">Month</button>
  <div class="calendars-container">
    <!-- Calendars will be populated dynamically using JavaScript -->
  </div>


  <script>
    // JavaScript code
    // Function to get the number of days in a specific month
    function getDaysInMonth(month, year) {
      return new Date(year, month, 0).getDate();
    }

// Function to populate days in the calendar
function populateCalendars() {

    const calendarsContainer = document.querySelector(".calendars-container");
    for(i=1;i<=1;i++){

        const calenderDiv = document.createElement('div');
        calenderDiv.classList.add('calendar');

        const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        const currentDate = new Date();
        const currentMonth = currentDate.getMonth() + 1;
        const currentDay = currentDate.getDate();
        const screenWidth = window.innerWidth;

        // Calculate the width of each day dynamically
        const dayWidth = Math.floor(screenWidth / 7) - 2; // Subtracting 2px for borders

        // Loop through each month from January to December
        for (let month = 1; month <= 12; month++) {
            const daysInMonth = getDaysInMonth(month, 2024);

            // Create container for each month
            const monthContainer = document.createElement('div');
            monthContainer.classList.add('month');

            // Give the first calendar a unique ID
            if (month === 1) {
            monthContainer.id = 'uniqueCalendar';
            }

            // Create header for each month
            const monthHeader = document.createElement('div');
            monthHeader.classList.add('header');
            monthHeader.textContent = new Date(2024, month - 1, 1).toLocaleString('default', { month: 'long' });
            monthContainer.appendChild(monthHeader);

            // Create days container for each month
            const daysContainer = document.createElement('div');
            daysContainer.classList.add('days');

            // Create day elements for each month
            for (let day = 1; day <= daysInMonth; day++) {
                const dayElement = document.createElement('div');
                dayElement.classList.add('calendar-day');
                dayElement.innerHTML = `
                    <div class="calender-top">
                        <span class="day">${day}</span><br>
                        ${daysOfWeek[new Date(2024, month - 1, day).getDay()]}
                        <span class="shift-hours">0 Hrs</span>
                    </div>`;

                // Add 5 divs with different classes
                for (let i = 1; i <= 5; i++) {
                    const innerDiv = document.createElement('div');
                    innerDiv.classList.add('inner-div-' + i);
                    dayElement.appendChild(innerDiv);
                }

                dayElement.style.width = dayWidth + 'px';
                daysContainer.appendChild(dayElement);

                // If it's the current day, add a class to style it differently
                if (month === currentMonth && day === currentDay) {
                    dayElement.classList.add('current-day');
                }
            }


            monthContainer.appendChild(daysContainer);
            calenderDiv.appendChild(monthContainer)
            calendarsContainer.appendChild(calenderDiv);

            // If it's the current month, scroll to the current day
            if (month === currentMonth) {
                const currentDayElement = monthContainer.querySelector('.current-day');
                if (currentDayElement) {
                    const scrollOffset = currentDayElement.offsetLeft - (calendarsContainer.offsetWidth / 2);
                    calendarsContainer.scrollLeft = scrollOffset;
                }
            }
        }
    }

}

    // Call the function to populate days when the page loads
    window.onload = populateCalendars;

    // Function to show all days when the button is clicked
    function showCalendarByMonth() {
      const screenWidth = window.innerWidth;
        // Calculate the width of each day dynamically
      const dayWidth30 = Math.floor(screenWidth / 30) - 2; // Subtracting 2px for borders
      const dayElements = document.querySelectorAll('.calendar-day');
      dayElements.forEach(dayElement => {
        dayElement.style.width = dayWidth30 + 'px';
      });
    }

    // Function to show all days when the button is clicked
    function showCalendarByWeek() {
      const screenWidth = window.innerWidth;
        // Calculate the width of each day dynamically
      const dayWidth30 = Math.floor(screenWidth / 7) - 2; // Subtracting 2px for borders
      const dayElements = document.querySelectorAll('.calendar-day');
      dayElements.forEach(dayElement => {
        dayElement.style.width = dayWidth30 + 'px';
      });
    }

    // Add event listener to the button
    document.getElementById('showCalendarByMonth').addEventListener('click', showCalendarByMonth);
    document.getElementById('showCalendarByWeek').addEventListener('click', showCalendarByWeek);
  </script>
</body>
</html>
