// filepath: /var/www/html/TAWSSIL-DZ/Assets/js/dz-map-hover.js

document.addEventListener('DOMContentLoaded', () => {
    console.log('dz-map-hover.js loaded'); // Log when the script is loaded

    // Get the map URL from the data attribute
    const svgContainer = document.querySelector('.dz-map-svg');
    const mapUrl = svgContainer.getAttribute('data-map-url');
    console.log('Map URL:', mapUrl); // Log the map URL

    // Fetch the SVG file
    fetch(mapUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to load SVG');
            }
            return response.text();
        })
        .then(svgContent => {
            // Inject the SVG content into the container
            svgContainer.innerHTML = svgContent;

            // Add hover effects to the paths
            const regions = svgContainer.querySelectorAll('path');
            console.log('Regions found:', regions); // Log the list of paths found

            if (regions.length === 0) {
                console.error('No <path> elements found in the loaded SVG.');
            }

            regions.forEach(region => {
                // console.log('Adding hover event to region:', region); // Log each region being processed

                region.addEventListener('mouseenter', () => {
                    console.log('Hovered over region:', region.name); // Log when a region is hovered
                    region.style.fill = '#EEB869'; // Highlight color on hover
                });

                region.addEventListener('mouseleave', () => {
                    // console.log('Mouse left region:', region); // Log when the mouse leaves a region
                    region.style.fill = ''; // Reset to default color
                });
            });
        })
        .catch(error => {
            console.error('Error loading SVG:', error);
        });
});