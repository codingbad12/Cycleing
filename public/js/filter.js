// Ship filter functionality
document.addEventListener('DOMContentLoaded', function() {
    // Get filter form elements
    const filterForm = document.getElementById('filter-form');
    const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
    const minPriceInput = document.getElementById('min_price');
    const maxPriceInput = document.getElementById('max_price');
    const minCapacitySelect = document.getElementById('min_capacity');
    
    // Add event listeners for real-time filtering
    if (filterForm) {
        // Handle checkbox changes
        filterCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                submitFilterForm();
            });
        });
        
        // Handle price range changes
        if (minPriceInput && maxPriceInput) {
            minPriceInput.addEventListener('change', validatePriceRange);
            maxPriceInput.addEventListener('change', validatePriceRange);
        }
        
        // Handle capacity changes
        if (minCapacitySelect) {
            minCapacitySelect.addEventListener('change', function() {
                submitFilterForm();
            });
        }
    }
    
    // Handle active filter removal
    const activeFilterBadges = document.querySelectorAll('#active-filters .badge');
    activeFilterBadges.forEach(badge => {
        badge.addEventListener('click', function() {
            // Extract filter type and value from badge text
            const badgeText = this.textContent.trim();
            
            if (badgeText.startsWith('Search:')) {
                // Clear search parameter and submit
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.delete('search');
                window.location.search = urlParams.toString();
            } else if (badgeText.startsWith('Type:')) {
                // Find and uncheck the corresponding type checkbox
                const typeName = badgeText.replace('Type:', '').replace(' ×', '').trim();
                const typeCheckbox = document.querySelector(`input[name="type[]"][value="${typeName}"]`);
                if (typeCheckbox) {
                    typeCheckbox.checked = false;
                    submitFilterForm();
                }
            } else if (badgeText.startsWith('Amenity:')) {
                // Find and uncheck the corresponding amenity checkbox
                const amenityName = badgeText.replace('Amenity:', '').replace(' ×', '').trim();
                const amenityCheckbox = document.querySelector(`input[name="amenities[]"][value="${amenityName}"]`);
                if (amenityCheckbox) {
                    amenityCheckbox.checked = false;
                    submitFilterForm();
                }
            } else if (badgeText.startsWith('Price:')) {
                // Reset price range inputs to defaults
                if (minPriceInput && maxPriceInput) {
                    minPriceInput.value = 0;
                    maxPriceInput.value = 2000;
                    submitFilterForm();
                }
            } else if (badgeText.startsWith('Min Capacity:')) {
                // Reset capacity select to default
                if (minCapacitySelect) {
                    minCapacitySelect.value = '';
                    submitFilterForm();
                }
            }
        });
    });
    
    // Validate price range
    function validatePriceRange() {
        const minPrice = parseInt(minPriceInput.value) || 0;
        const maxPrice = parseInt(maxPriceInput.value) || 2000;
        
        if (minPrice > maxPrice) {
            maxPriceInput.value = minPrice;
        }
        
        submitFilterForm();
    }
    
    // Submit filter form
    function submitFilterForm() {
        if (filterForm) {
            filterForm.submit();
        }
    }
});