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
    $('#summernote').summernote({
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