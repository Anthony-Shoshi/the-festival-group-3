document.addEventListener("DOMContentLoaded", function () {
    const currentUrl = window.location.pathname;
    const menuItems = document.querySelectorAll('.menu-item');

    menuItems.forEach(item => {
        const menuItemUrl = item.getAttribute('data-url');
        if (currentUrl === menuItemUrl) {
            item.classList.add('active');
        }

        item.addEventListener('click', function () {
            window.location.href = menuItemUrl;
        });
    });
});

$(document).ready(function () {
    $('.summernote').summernote({
        placeholder: 'Enter your content . . .',
        height: 200,
        fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana'],
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['codeview', 'help']]
        ]
    });
});

var button = document.getElementById("event-section__button-dj");

    button.addEventListener("click", function() {
    window.location.href = "http://localhost/dance/index";
});
var button = document.getElementById("event-section__button-history");

button.addEventListener("click", function() {
    window.location.href = "http://localhost/history/index";
});
var button = document.getElementById("event-section__button-yummy");

button.addEventListener("click", function() {
    window.location.href = "http://localhost/yummy/index";
});




/// Function to fetch artist details from the backend
function fetchArtistDetails(artistId) {
    // Construct the URL of the backend PHP script
    const url = `/artists-details?artist_id=${artistId}`; // Adjust the URL as needed

    // Fetch artist details from the backend
    fetch(url)
        .then(response => {
            // Check if the response is successful
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            // Parse the JSON response
            return response.json();
        })
        .then(artistDetails => {
            // Handle the artist details
            displayArtistDetails(artistDetails);
        })
        .catch(error => {
            // Handle errors
            console.error('Error fetching artist details:', error);
        });
}

// Function to display artist details on the frontend
function displayArtistDetails(artistDetails) {
    // Check if artist details are available
    if (artistDetails) {
        // Display artist details on the frontend
        const artistName = artistDetails.artist_name;
        const artistImageUrl = `/images/${artistDetails.image_url}`; // Assuming image_url contains the filename of the image
        // Update the HTML content to display the artist details
        document.getElementById('artistName').textContent = artistName;
        document.getElementById('artistImage').src = artistImageUrl;
    } else {
        // Display a message if artist details are not available
        console.log('Artist details not found');
    }
}

// Example usage: Fetch and display artist details when the page loads
document.addEventListener('DOMContentLoaded', function () {
    // Retrieve the artist ID from the URL query parameters
    const urlParams = new URLSearchParams(window.location.search);
    const artistId = urlParams.get('artist_id');
    // Fetch artist details using the artist ID
    fetchArtistDetails(artistId);
});

