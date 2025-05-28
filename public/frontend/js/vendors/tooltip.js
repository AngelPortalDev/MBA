$(document).ready(function() {
    // Function to initialize tooltips with proper content
    function initializeTooltips() {
        tippy(".bookmark, .addwishlist, .addwishlistBrowse", {
            content: "Add to Wishlist",
            theme: "light",
            animation: "scale",
            onShow(instance) {
                const icon = instance.reference.querySelector('.heart-icon');
                if (icon.classList.contains('bi-heart-fill')) {
                    instance.setContent("Remove from Wishlist");
                } else {
                    instance.setContent("Add to Wishlist");
                }
            }
        });

        tippy(".removeBookmark", {
            content: "Remove from Wishlist",
            animation: "scale",
        });
    }

    initializeTooltips();

 
    $(document).on('click', '.heart-icon', function() {
        $(this).toggleClass('bi-heart bi-heart-fill');

        const icon = $(this);
        const tooltipInstance = tippy(icon[0]);

        if (tooltipInstance) {
            tooltipInstance.setContent(icon.hasClass('bi-heart-fill') ? "Remove from Wishlist" : "Add to Wishlist");
        }
    });
});
