document.addEventListener("DOMContentLoaded", function() {
    const currentUrl = window.location.pathname;
    const menuItems = document.querySelectorAll('.menu-item');

    menuItems.forEach(item => {
        const menuItemUrl = item.getAttribute('data-url');
        if (currentUrl === menuItemUrl) {
            item.classList.add('active');
        }

        item.addEventListener('click', function() {
            window.location.href = menuItemUrl;
        });
    });
});