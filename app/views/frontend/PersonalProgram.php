<?php
include __DIR__ . '/inc/header.php';
include __DIR__ . '/inc/message.php';

$isLoggedIn = isset($_SESSION['username']);
$reservations = $_SESSION['basket'] ?? [];

$reservations_json = json_encode($reservations);
?>
<link rel="stylesheet" href="/frontend/css/PersonalProgram.css"/>
</head>
<body>

<div class="container">
    <div class="view-container">
        <button id="list-view-btn">List View</button>
        <button id="agenda-view-btn">Agenda View</button>
    </div>

    <div class="list-view active" id="list-view"></div>

    <div class="agenda-view" id="agenda-view">
        <div class="calendar">
            <div class="timeline">
                <?php
                for ($hour = 0; $hour < 24; $hour++) {
                    echo "<div>{$hour}:00</div>";
                }
                ?>
            </div>
            <div class="days">
            </div>
        </div>
    </div>
</div>
<script>
    const reservations = <?php echo $reservations_json; ?>;

    function createListItem(item) {
        const listItem = document.createElement('div');
        listItem.className = 'list-view__item';

        let itemTitle = '';
        let itemDetails = '';
        let itemQuantity = '';
        let itemCost = '';

        if (item.reservation_date) {
            itemTitle = `${item.name} - ${item.reservation_date}`;
            itemQuantity = `${item.total_adult + item.total_children} ${item.quantity}`;
            itemCost = `€${item.cost}.00`;
        } else if (item.ticketType) {
            itemTitle = `${item.start_location} - ${item.timeslot}`;
            itemDetails = `Ticket Type: ${item.ticketType.ticket_type}`;
            itemQuantity = `Participants: ${item.participants}`;
            itemCost = `€${item.price}.00`;
        } else if (item.music_performance_id !== undefined) {
            itemTitle = `${item.event_name} - ${item.event_date} - ${item.event_start_time}-${calculateEndTime(item.event_start_time, item.event_duration)}`;
            itemDetails = `Session Type: ${item.session_type}`;
            itemQuantity = `Quantity: ${item.quantity}`;
            itemCost = `€${item.event_price}.00`;
        } else if (item.passType) {
            itemTitle = `${item.passName} - ${item.passDescription}`;
            itemQuantity = `Quantity: ${item.quantity}`;
            itemCost = `€${item.cost}.00`;
        } else {
            listItem.innerText = 'Event information missing or invalid.';
            return listItem;
        }

        listItem.innerHTML = `
        <div class="list-view__item__left">
            <div class="list-view__item__title">${itemTitle}</div>
            <div class="list-view__item__subheading">${itemDetails}</div>
            <div class="list-view__item__info">${itemQuantity}</div>
        </div>
        <div class="list-view__item__right">
            <div class="list-view__item__price">${itemCost}</div>
        </div>
    `;

        if (item.ticketType) {
            listItem.setAttribute('data-type', 'History Ticket');
        } else if (item.music_performance_id !== undefined) {
            listItem.setAttribute('data-type', 'Dance Ticket');
        } else if (item.passType) {
            listItem.setAttribute('data-type', 'Dance Pass');
        }

        return listItem;
    }

    function populateListView(reservations) {
        const listView = document.getElementById('list-view');
        listView.innerHTML = '';

        reservations.forEach(item => {
            const listItem = createListItem(item);
            listView.appendChild(listItem);
        });
    }


    // Function to populate Agenda View
    function populateAgendaView(reservations) {
        const daysContainer = document.querySelector('.days');
        daysContainer.innerHTML = ''; // Clear existing content

        const datesToDisplay = ['2024-07-26', '2024-07-27', '2024-07-28', '2024-07-29', '2024-07-30']; // Example dates to display

        datesToDisplay.forEach(date => {
            const dayDiv = document.createElement('div');
            dayDiv.className = 'date';

            // Display date and day name
            const dayName = new Date(date).toLocaleDateString('en-US', {weekday: 'long'});
            dayDiv.innerHTML = `
            <span class="date-num">${date}</span>
            <span class="date-day">${dayName}</span>
        `;

            const eventsDiv = document.createElement('div');
            eventsDiv.className = 'events';

            const eventsOnDate = reservations.filter(item => {
                if (item.music_event_id !== undefined) {
                    return item.event_date === date;
                } else if (item.timeslot) {
                    const eventDate = item.timeslot.split(' ')[0];
                    return eventDate === date;
                }
                return false;
            });

            // Populate events for this date
            eventsOnDate.forEach(item => {
                const eventDiv = document.createElement('div');
                eventDiv.className = 'event';

                if (item.music_event_id !== undefined) {
                    // Music event
                    eventDiv.innerHTML = `
                    <div class="title">${item.event_name}</div>
                    <p>${item.session_type}</p>
                    <p>${item.event_start_time} - ${calculateEndTime(item.event_start_time, item.event_duration)}</p>
                    <p>Price: €${item.event_price}</p>
                    <p>Quantity: ${item.quantity}</p>
                `;
                } else {
                    // Other event
                    const startTime = item.timeslot.split(' ')[1].substring(0, 5);
                    const endTime = item.timeslot.split(' ')[2].substring(0, 5);
                    eventDiv.innerHTML = `
                    <div class="title">${item.start_location}</div>
                    <p>${item.ticketType.ticket_type}</p>
                    <p>${startTime} - ${endTime}</p>
                    <p>Price: €${item.price}</p>
                    <p>Participants: ${item.participants}</p>
                `;
                }

                eventsDiv.appendChild(eventDiv);
            });

            dayDiv.appendChild(eventsDiv);
            daysContainer.appendChild(dayDiv);
        });
    }

    function addTypeContent(element, type) {
        const beforeContent = document.createElement('div');
        beforeContent.className = 'before-content';
        beforeContent.innerText = type;
        element.insertBefore(beforeContent, element.firstChild);
    }

    function calculateEndTime(startTime, duration) {
        const start = new Date(`2000-01-01T${startTime}`);
        const end = new Date(start.getTime() + duration * 60000);
        return end.toLocaleTimeString('en-US', {hour12: false});
    }

    populateListView(reservations);
    populateAgendaView(reservations);

</script>

<?php include __DIR__ . '/inc/footer.php'; ?>

</body>
</html>

