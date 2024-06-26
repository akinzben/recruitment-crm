<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Shifts Board</title>
  <link rel="stylesheet" href="../css/main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <style>
    
  </style>
</head>
<body>

  <div class="main-container">
    <section class="container-top">
      <button id="showCalendarByWeek">Week</button>
      <button id="showCalendarByMonth">Month</button>
    </section>

    <section class="records-container">
      <div class="calendar-side-container">
        <div class="calender-top calender-box">Clients</div>
      </div>
      <div class="calendars-container">
        <!-- Calendars will be populated dynamically using JavaScript -->
      </div>
    </section>
  </div>  


<script>
// Array of job titles
let jobTitles = ["Kitchen Potter", "Care Assistat", "Nurse", "Chef", "Warehouse Assistant"];
let totalJobs = jobTitles.length+5;

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
      <div class="calender-top calender-box ">
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


$(document).ready(function() {
  $('.records-container').on("scroll", function() {
    var scrollY = $(this).scrollTop();
    $(".calender-top").css("top", scrollY);
  });
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
