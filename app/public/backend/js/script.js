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

$('.page-switch').change(function() {
    var pageId = $(this).data('id');
    var isActive = $(this).is(':checked') ? 1 : 0;

    $.ajax({
        url: '/page/status?id=' + pageId,
        type: 'POST',
        data: {
            active: isActive
        },
        success: function(response) {
            console.log('Page status updated successfully.');
        },
        error: function(xhr, status, error) {
            console.error('Error updating page status:', error);
        }
    });
});

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
