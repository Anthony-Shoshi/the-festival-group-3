<?php include __DIR__ . '/../inc/header.php'; ?>
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
        let selectedLanguage = null;
        let selectedDate = null;
        let selectedTimeSlot = null;
        let regularParticipants = 0;
        let familyParticipants = 0;

        document.addEventListener('DOMContentLoaded', function () {
            populateLanguages();
            attachEventListeners();
        });

        function attachEventListeners() {
            document.getElementById('regularParticipants').addEventListener('input', handleParticipantChange);
            document.getElementById('familyParticipants').addEventListener('input', handleParticipantChange);
            document.getElementById('regular').addEventListener('change', handleTicketTypeChange);
            document.getElementById('family').addEventListener('change', handleTicketTypeChange);
        }

        function handleTicketTypeChange(event) {
            calculateTotal();
        }

        function handleParticipantChange(event) {
            if (event.target.id === 'regularParticipants') {
                regularParticipants = parseInt(event.target.value);
                if (regularParticipants >= 4) {
                    alert('Buy a family ticket and save 10 euros');
                }
            } else if (event.target.id === 'familyParticipants') {
                familyParticipants = parseInt(event.target.value);
            }
            calculateTotal();
        }

        function calculateTotal() {
            let total = 0;
            if (document.getElementById('regular').checked) {
                total = regularParticipants * 17.50;
            } else if (document.getElementById('family').checked) {
                total = familyParticipants > 0 ? 60 : 0;
            }
            document.getElementById('total').textContent = total.toFixed(2);
        }

        function populateLanguages() {
            const languagesDiv = document.getElementById('languages');
            const tours = JSON.parse(languagesDiv.getAttribute('data-languages'));

            const languages = [];
            tours.forEach(tour => {
                if (!languages.includes(tour.language_name)) {
                    languages.push(tour.language_name);
                    const button = document.createElement('button');
                    button.innerHTML = `<img src="/images/ ${tour.flag_image}" alt="${tour.language_name}">`;
                    button.onclick = () => {
                        selectedLanguage = tour.language_name;
                        filterByLanguage(tour.language_name);
                    };
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
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error('Error fetching tours:', data.error);
                    } else {
                        populateTimetable(data);
                    }
                })
                .catch(error => console.error('Error fetching tours:', error));
        }

        function populateTimetable(tours) {
            const timetableDiv = document.getElementById('timetable');
            timetableDiv.innerHTML = '';

            const dates = new Set(tours.map(tour => tour.date));

            dates.forEach(date => {
                const dateDiv = document.createElement('div');
                dateDiv.classList.add('date');
                dateDiv.textContent = date;

                tours.filter(tour => tour.date === date).forEach(tour => {
                    if (tour.available_guides > 0) {
                        const timeBtn = document.createElement('button');
                        timeBtn.classList.add('timeslot');
                        timeBtn.textContent = `${tour.start_time}-${tour.end_time}`;
                        timeBtn.onclick = () => {
                            selectedDate = date;
                            selectedTimeSlot = `${tour.start_time}-${tour.end_time}`;
                        };
                        dateDiv.appendChild(timeBtn);
                    }
                });

                timetableDiv.appendChild(dateDiv);
            });
        }

        function filterByLanguage(language) {
            fetchTours(language);
        }

        function addToCart() {
            const ticketType = document.querySelector('input[name="ticketType"]:checked');

            if (!ticketType) {
                alert('Please select a ticket type (Regular or Family) before adding to cart.');
                return;
            }

            const payload = {
                ticketType: ticketType.value,
                price: ticketType.value === 'regular' ? regularParticipants * 17.50 : 60,
                start_location: selectedLanguage,
                timeslot: selectedDate + ' ' + selectedTimeSlot,
                participants: ticketType.value === 'regular' ? regularParticipants : familyParticipants
            };

            console.log('Adding to cart:', payload); // Debugging line

            fetch('/historyTicket/create', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(payload),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Ticket added to basket successfully!');
                    } else {
                        alert('Error adding ticket to basket.');
                    }
                })
                .catch(error => console.error('Error adding to cart:', error));
        }
    </script>
    </body>
    <br>
