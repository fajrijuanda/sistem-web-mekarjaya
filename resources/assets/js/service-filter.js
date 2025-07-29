/**
 * Handles filtering of service cards based on category selection.
 */
document.addEventListener('DOMContentLoaded', function () {
    const filterContainer = document.getElementById('service-filter');
    const serviceItems = document.querySelectorAll('.service-item-col');

    // Exit if the filter container doesn't exist on the page
    if (!filterContainer) {
        return;
    }

    filterContainer.addEventListener('click', function (e) {
        // Prevent the default link behavior
        e.preventDefault();
        const target = e.target;

        // Ensure the clicked element is a filter link
        if (!target.classList.contains('nav-link')) {
            return;
        }

        // Update the active state on the filter buttons
        filterContainer.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active');
        });
        target.classList.add('active');

        const filterValue = target.getAttribute('data-filter');

        // Loop through all service items to show or hide them
        serviceItems.forEach(item => {
            const itemCategory = item.getAttribute('data-category');
            const shouldBeVisible = filterValue === 'all' || filterValue === itemCategory;
            const isCurrentlyHidden = item.classList.contains('is-hidden');

            if (shouldBeVisible && isCurrentlyHidden) {
                // --- SHOW ITEM ---
                // Remove the 'd-none' class to allow it to take up space
                item.classList.remove('d-none');
                
                // Use a minimal timeout to ensure the browser registers the element
                // before starting the transition. This prevents the animation from skipping.
                setTimeout(() => {
                    item.classList.remove('is-hidden');
                }, 20);

            } else if (!shouldBeVisible && !isCurrentlyHidden) {
                // --- HIDE ITEM ---
                // Add the 'is-hidden' class to trigger the fade-out/scale-down animation
                item.classList.add('is-hidden');

                // Listen for the end of the transition, then add 'd-none'
                // to completely remove the element from the layout.
                item.addEventListener('transitionend', () => {
                    item.classList.add('d-none');
                }, { once: true }); // The event listener is removed after it runs once
            }
        });
    });
});
