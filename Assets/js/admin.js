document.addEventListener('DOMContentLoaded', function () {
    // Navigation functionality
    const navLinks = document.querySelectorAll('.nav-links li[data-tab]');
    const contentSections = document.querySelectorAll('.content-section');

    // Function to switch tabs
    function switchTab(tabId) {
        navLinks.forEach(link => link.classList.remove('active'));
        contentSections.forEach(section => section.classList.remove('active'));

        const activeLink = document.querySelector(`[data-tab="${tabId}"]`);
        const activeSection = document.getElementById(tabId);

        if (activeLink && activeSection) {
            activeLink.classList.add('active');
            activeSection.classList.add('active');
        }
    }

    // Add click event listeners to nav links
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            const tabId = link.getAttribute('data-tab');
            switchTab(tabId);
        });
    });

    // Logout functionality
   

    
}); 