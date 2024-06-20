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
    <P class="checkoutText">Do you want to Checkout? Go to  your Shopping Cart ➡️</P>
    <a class="checkout-btn" href="/personalprogram/basket">Shopping Cart</a>
    <div class="view-container">
        <button id="list-view-btn">List View</button>
    </div>

    <div class="list-view active" id="list-view"></div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    // Ensure reservations JSON is correctly populated
    const reservations = <?php echo $reservations_json; ?>;

    function createListItem(item, index) {
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
                <button class="delete-btn" data-index="${index}">Delete</button>
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

        reservations.forEach((item, index) => {
            const listItem = createListItem(item, index);
            listView.appendChild(listItem);
        });

        // Attach event listeners after items are created
        $('.delete-btn').on('click', deleteItem);
    }

    function deleteItem(event) {
        const button = $(this);
        const index = button.data('index');

        $.ajax({
            url: '/personalprogram/removeItem',
            type: 'GET',
            data: { index: index },
            success: function(response) {
                console.log('Item deleted successfully');
                reservations.splice(index, 1);
                populateListView(reservations);
            },
            error: function(xhr, status, error) {
                console.error('Error deleting item:', error);
            }
        });
    }

    function calculateEndTime(startTime, duration) {
        const start = new Date(`2000-01-01T${startTime}`);
        const end = new Date(start.getTime() + duration * 60000);
        return end.toLocaleTimeString('en-US', {hour12: false});
    }

    $(document).ready(function() {
        populateListView(reservations);
    });

    $(document).ready(function() {
        $('.checkout-btn').on('click', function() {
            window.location.href = '/personalprogram/basket';
        });

</script>

<?php include __DIR__ . '/inc/footer.php'; ?>

</body>
</html>
