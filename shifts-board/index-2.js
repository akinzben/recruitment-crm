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

  

  <section class="records-container">
    <div class="calendar-side-container">
      <div class="calender-top">Clients</div>
    </div>
    <div class="calendars-container">
      <!-- Calendars will be populated dynamically using JavaScript -->
    </div>
  </section>
  


<script>
// Array of job titles
let jobTitles = ["Kitchen Potter", "Care Assistat", "Nurse", "Chef", "Warehouse Assistant"];
let totalJobs = jobTitles.length;

const calendarsContainer = document.querySelector(".calendars-container");

const calenderDiv = document.createElement('div');
calenderDiv.classList.add('calendar');

// Create days container for each month
const daysContainer = document.createElement('div');
daysContainer.classList.add('days');

//monthContainer.appendChild(daysContainer);
calenderDiv.appendChild(daysContainer);
calendarsContainer.appendChild(calenderDiv);

// Define the from and to dates
const fromDate = new Date('2023-12-28'); // Assuming format: YYYY-MM-DD
const toDate = new Date('2024-01-12');   // Assuming format: YYYY-MM-DD


    // JavaScript code
    // Function to get the number of days in a specific month
    function getDaysInMonth(month, year) {
      return new Date(year, month, 0).getDate();
    }


// Function to populate days in the calendar
function populateCalendars() {
  
  const screenWidth = window.innerWidth;

  const containerWidth = calendarsContainer.getBoundingClientRect().width; // Get the width of the container
  const dayWidth7 = Math.floor(containerWidth / 7) - 2; // Calculate the width of each day dynamically

  // Function to get the week of the year
  const getWeek = (date) => {
      const onejan = new Date(date.getFullYear(), 0, 1);
      return Math.ceil((((date - onejan) / 86400000) + onejan.getDay() + 1) / 7);
  }

  const formatDate = (date) => {
    const options = { day: 'numeric', weekday: 'short', month: 'short', year: 'numeric' };
    const formattedDate = new Intl.DateTimeFormat('en-GB', options).format(date);
    const week = getWeek(date);
    
    // Extract individual parts of the formatted date
    const [dayMonth, month, year, weekday] = formattedDate.split(' ');

    return {
        dayMonth: dayMonth.replace(',', ''), // Remove comma after day of the month
        month,
        year,
        weekday,
        week: `Week ${week}` // Add week number
    };
  };

  // Loop through each date from 'fromDate' to 'toDate'
  const currentDate = new Date(fromDate);
  while (currentDate <= toDate) {
    const formatted = formatDate(currentDate);

    const date = new Date(currentDate);

    // Extract individual date components
    const dayOfWeek = date.getDay(); // Get the day of the week (0-6, where 0 represents Sunday)
    const dayOfMonth = date.getDate(); // Get the day of the month (1-31)
    const month = date.getMonth(); // Get the month (0-11)
    const year = date.getFullYear(); // Get the full year (e.g., 2023)

    // Calculate ISO week of the year
    const isoWeek = getISOWeek(date); // Custom function to get ISO week of the year

    // Define an array to map day of the week index to its name
    const daysOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

    // Create an array containing the extracted date components
    const dateInfo = [daysOfWeek[dayOfWeek], dayOfMonth, month, year, isoWeek];

    const dayElement = document.createElement('div');
    dayElement.classList.add('calendar-day');
    dayElement.innerHTML = `
      <div class="calender-top">
                        <span class="day">${dayOfMonth}</span><br>
                        ${daysOfWeek[dayOfWeek]}
                        <span class="shift-hours">0 Hrs</span>
                    </div>
    `;

    // Add 5 divs with different classes
    for (let i = 1; i <= totalJobs; i++) {
        const innerDiv = document.createElement('div');
        innerDiv.classList.add('calendar-box');
        dayElement.appendChild(innerDiv);
    }

    dayElement.style.width = dayWidth7 + 'px';
    daysContainer.appendChild(dayElement);

    console.log(formatted);
    currentDate.setDate(currentDate.getDate() + 1); // Increment the date by 1 day
  }

    for(i=1;i<=0;i++){

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
            //monthContainer.appendChild(monthHeader);

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
                for (let i = 1; i <= totalJobs; i++) {
                    const innerDiv = document.createElement('div');
                    innerDiv.classList.add('calendar-box');
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


// Function to populate side with job titles
function populateSide() {
  const calendarSide = document.querySelector(".calendar-side-container");
  let i = 0; // Initialize loop counter

  // Loop through each job title and add to inner divs
  while (i < totalJobs) {
    const innerDiv = document.createElement('div');
    innerDiv.classList.add('calendar-box'); // Add class based on current loop number
    innerDiv.textContent = jobTitles[i]; // Set inner text to current job title
    calendarSide.appendChild(innerDiv);
    i++; // Increment loop counter
  }
}


// Call the functions when the page loads
window.addEventListener('load', function() {
    populateCalendars();
    populateSide();
});


function getISOWeek(date) {
    const dayOfWeek = date.getDay() || 7; // Adjust for JavaScript's 0-indexed day of the week where Sunday is 0
    const startOfYear = new Date(date.getFullYear(), 0, 1);
    const startOfWeek = new Date(startOfYear);
    startOfWeek.setDate(startOfWeek.getDate() + (1 - startOfWeek.getDay())); // Find the start of the week containing the first Thursday of the year
    const weekNumber = Math.ceil(((date - startOfWeek) / 86400000 + 1) / 7); // Calculate the week number
    return weekNumber;
}

    // Function to show all days when the button is clicked
    function showCalendarByMonth() {
      const calendarsContainer = document.querySelector('.calendars-container');
      const containerWidth = calendarsContainer.getBoundingClientRect().width; // Get the width of the container
      const dayWidth30 = Math.floor(containerWidth / 30) - 2; // Calculate the width of each day dynamically

      const dayElements = document.querySelectorAll('.calendar-day');
      dayElements.forEach(dayElement => {
        dayElement.style.width = dayWidth30 + 'px';
      });
    }

    // Function to show all days when the button is clicked
    function showCalendarByWeek() {
      const calendarsContainer = document.querySelector('.calendars-container');
      const containerWidth = calendarsContainer.getBoundingClientRect().width; // Get the width of the container
      const dayWidth7 = Math.floor(containerWidth / 7) - 2; // Calculate the width of each day dynamically

      const dayElements = document.querySelectorAll('.calendar-day');
      dayElements.forEach(dayElement => {
        dayElement.style.width = dayWidth7 + 'px';
      });
    }


    // Add event listener to the button
    document.getElementById('showCalendarByMonth').addEventListener('click', showCalendarByMonth);
    document.getElementById('showCalendarByWeek').addEventListener('click', showCalendarByWeek);
  </script>
</body>
</html>
