
    <title>History Ticket</title>
    </head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #780B1E;
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #app {
            width: 80%;
            max-width: 600px;
            text-align: center;
        }

        h1 {
            font-size: 2em;
        }

        .section {
            margin: 20px 0;
        }

        .languages img {
            width: 40px;
            height: 30px;
            margin: 0 5px;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .languages img.selected {
            border-color: white;
        }

        .timetable .date {
            margin: 10px 0;
        }

        .timetable .date button {
            background-color: #FCEBBD;
            border: none;
            color: #780B1E;
            padding: 10px;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
        }

        .timetable .date button:hover {
            background-color: #FCEBBD;
        }

        .regularParticipants,
        .familyParticipants {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            margin: 10px 0; /* Add margin to space out the sections */
        }

        .participants label, .participants input {
            margin: 5px;
            font-size: 1.2em; /* Increase the font size */
        }

        input[type="radio"] {
            width: 20px; /* Increase the size of radio buttons */
            height: 20px;
            margin-right: 10px; /* Add some space between radio button and label */
        }

        input[type="number"] {
            font-size: 1.2em; /* Increase the size of the number input */
            padding: 5px; /* Add some padding */
            width: 80px; /* Adjust the width */
        }

        button {
            background-color: #FCEBBD;
            border: none;
            color: #780B1E;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            margin: 10px;
        }

        button:hover {
            background-color: #FCEBBD;
        }

        #total {
            font-weight: bold;
        }



    </style>
    <body>
    <div id="app">
        <div id="app">
            <h1>A Stroll Through History</h1>
            <p>EMBARK ON YOUR HAARLEM JOURNEY WITH JUST A FEW CLICKS</p>

            <div class="section">
                <label>Select Language:</label>
                <div id="languages" class="languages" data-languages='<?php echo json_encode($tours); ?>'>

                </div>
            </div>
        </div>
            <div class="section">
                <label>Select Date and Time:</label>
                <div id="timetable" class="timetable">
                    <!-- JavaScript will populate this section -->
                </div>
            </div>

        <div class="section">
            <label>Select number of Participants:</label>
            <div class="regularParticipants">
                <label for="regular"></label>
                <input type="radio" id="regular" name="ticketType" value="regular">
                <label for="regularParticipants">Regular Participant</label>
                <input type="number" id="regularParticipants" min="0" value="0" >
            </div>
            <div class="familyParticipants">
                <label for="family"></label>
                <input type="radio" id="family" name="ticketType" value="family">
                <label for="familyParticipants">Family Ticket (max 4 participants)</label>
                <input type="number" id="familyParticipants" min="0" max="4" value="0">
            </div>
        </div>

        <div class="section">
            <p>Total: € <span id="total">00,00</span></p>
            <button onclick="addToCart()">Add to Cart</button>
            <button onclick="addToWishList()">Add to Wish List</button>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            populateLanguages();
            // fetchTours(); // Fetch all tours when the page loads
        });

        function populateLanguages() {
            const languagesDiv = document.getElementById('languages');
            const tours = JSON.parse(languagesDiv.getAttribute('data-languages'));

            const languages = [];
            tours.forEach(tour => {
                if (!languages.includes(tour.language_name)) {
                    languages.push(tour.language_name);
                    const button = document.createElement('button');
                    button.innerHTML = `<img src="${tour.flag_image}" alt="${tour.language_name}">`;
                    button.onclick = () => filterByLanguage(tour.language_name);
                    languagesDiv.appendChild(button);
                }
            });
        }
        function fetchTours(language = null) {
            let url = '/history/getToursByLanguage';
            if (language) {
                url += `?language_name=${encodeURIComponent(language)}`;
            }

            fetch(url)
                .then(response => response.json())  // Parse the JSON response
                .then(data => {
                    if (data.error) {
                        console.error('Error fetching tours:', data.error);
                    } else {
                        console.log('Fetched tours:', data);
                        populateTimetable(data);  // Use the data directly
                    }
                })
                .catch(error => console.error('Error fetching tours:', error));
        }
        function populateTimetable(tours) {
            const timetableDiv = document.getElementById('timetable');
            timetableDiv.innerHTML = ''; // Clear previous content

            const dates = new Set(tours.map(tour => tour.date));

            dates.forEach(date => {
                const dateDiv = document.createElement('div');
                dateDiv.classList.add('date');
                dateDiv.textContent = date;

                tours.filter(tour => tour.date === date).forEach(tour => {
                    // Check if the available guides are greater than 0
                    if (tour.available_guides > 0) {
                        const timeBtn = document.createElement('button');
                        timeBtn.classList.add('timeslot');
                        timeBtn.textContent = `${tour.start_time}-${tour.end_time}`;
                        timeBtn.onclick = () => selectTimeslot(tour.tour_id);
                        dateDiv.appendChild(timeBtn);
                    }
                });

                timetableDiv.appendChild(dateDiv);
            });
        }



        function filterByLanguage(language) {
            fetchTours(language);
        }
    </script>
    </body>
    <br>
<?php //include __DIR__ . '/../inc/footer.php'; ?>