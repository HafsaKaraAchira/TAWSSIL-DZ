// dz-map.js

// Define selectedPaths globally
import { selectedPaths, setSelectValue } from './shared.js';

// Retrieve Tailwind custom colors
const rootStyles = getComputedStyle(document.documentElement);
const primaryColor = rootStyles.getPropertyValue('--tw-color-primary-DEFAULT').trim(); // Green
const accentBlueColor = rootStyles.getPropertyValue('--tw-color-accentBlue-DEFAULT').trim(); // Blue
const accentYellowColor = rootStyles.getPropertyValue('--tw-color-accentYellow-DEFAULT').trim(); // Yellow
const errorColor = rootStyles.getPropertyValue('--tw-color-error-light').trim(); // Red

// Export the drawArrow function
export function drawArrow(departRegion, arrivRegion, svgContainer) {
    // Remove existing arrow if it exists
    const arrow = svgContainer.querySelector('#map-arrow');
    if (arrow) arrow.remove();

    // Remove existing marker if it exists
    const marker = svgContainer.querySelector('#arrowhead-marker');
    if (marker) marker.remove();

    const departBBox = departRegion.getBBox();
    const arrivBBox = arrivRegion.getBBox();

    const startX = departBBox.x + departBBox.width / 2;
    const startY = departBBox.y + departBBox.height / 2;
    const endX = arrivBBox.x + arrivBBox.width / 2;
    const endY = arrivBBox.y + arrivBBox.height / 2;

    // Define the marker for the arrowhead
    let defs = svgContainer.querySelector('defs');
    if (!defs) {
        defs = document.createElementNS('http://www.w3.org/2000/svg', 'defs');
        svgContainer.querySelector('svg').appendChild(defs);
    }

    const arrowMarker = document.createElementNS('http://www.w3.org/2000/svg', 'marker');
    arrowMarker.setAttribute('id', 'arrowhead-marker');
    arrowMarker.setAttribute('viewBox', '0 0 10 10');
    arrowMarker.setAttribute('refX', '5'); // Position of the arrowhead tip
    arrowMarker.setAttribute('refY', '5');
    arrowMarker.setAttribute('markerWidth', '6'); // Size of the arrowhead
    arrowMarker.setAttribute('markerHeight', '6');
    arrowMarker.setAttribute('orient', 'auto-start-reverse'); // Automatically adjust orientation

    // Define the arrowhead shape
    const arrowhead = document.createElementNS('http://www.w3.org/2000/svg', 'path');
    arrowhead.setAttribute('d', 'M 0 0 L 10 5 L 0 10 Z'); // Triangle shape
    arrowhead.setAttribute('fill', errorColor); // Use the error color for the arrowhead
    arrowMarker.appendChild(arrowhead);

    defs.appendChild(arrowMarker);

    // Draw the arrow line
    const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
    line.setAttribute('x1', startX);
    line.setAttribute('y1', startY);
    line.setAttribute('x2', endX);
    line.setAttribute('y2', endY);
    line.setAttribute('stroke', errorColor); // Use the error color for the line
    line.setAttribute('stroke-width', '4');
    line.setAttribute('stroke-dasharray', '5,5');
    line.setAttribute('marker-end', 'url(#arrowhead-marker)'); // Attach the arrowhead marker
    line.id = 'map-arrow';
    line.classList.add('map-arrow');

    console.log(`Drawing arrow from (${startX}, ${startY}) to (${endX}, ${endY}) with arrowhead`); // Log arrow details
    svgContainer.querySelector('svg').appendChild(line);
}

document.addEventListener('DOMContentLoaded', () => {
    console.log('dz-map-hover.js loaded'); // Log when the script is loaded

    const svgContainer = document.querySelector('.dz-map-svg');
    const mapUrl = svgContainer.getAttribute('data-map-url');

    // Retrieve Tailwind custom colors
    const rootStyles = getComputedStyle(document.documentElement);
    const primaryColor = rootStyles.getPropertyValue('--tw-color-primary-DEFAULT').trim(); // Green
    const accentBlueColor = rootStyles.getPropertyValue('--tw-color-accentBlue-DEFAULT').trim(); // Blue
    const accentYellowColor = rootStyles.getPropertyValue('--tw-color-accentYellow-DEFAULT').trim(); // Yellow
    const errorColor = rootStyles.getPropertyValue('--tw-color-error-light').trim(); // Red

    console.log('Primary Color:', primaryColor);
    console.log('Accent Blue Color:', accentBlueColor);
    console.log('Accent Yellow Color:', accentYellowColor);
    console.log('Error Color:', errorColor);

    // Fetch the SVG file
    fetch(mapUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to load SVG');
            }
            return response.text();
        })
        .then(svgContent => {
            svgContainer.innerHTML = svgContent;

            const regions = svgContainer.querySelectorAll('path');
            const departSelect = document.querySelector('#depart');
            const arrivSelect = document.querySelector('#arriv');

            regions.forEach(region => {
                const wilayaCode = region.getAttribute('id').replace('DZ', ''); // Extract numeric code
                console.log(`Region ID: ${region.getAttribute('id')}, Extracted Code: ${wilayaCode}`); // Log region details

                // Add hover effect to show floating label
                region.addEventListener('mouseenter', (event) => {
                    const label = document.createElement('div');
                    label.className = 'floating-label absolute bg-white text-black text-sm px-2 py-1 rounded shadow-lg';
                    label.textContent = `${wilayaCode} - ${region.getAttribute('name')}`;
                    label.style.left = `${event.pageX + 10}px`;
                    label.style.top = `${event.pageY + 10}px`;
                    label.id = 'hover-label';
                    document.body.appendChild(label);
                });

                region.addEventListener('mousemove', (event) => {
                    const label = document.querySelector('#hover-label');
                    if (label) {
                        label.style.left = `${event.pageX + 10}px`;
                        label.style.top = `${event.pageY + 10}px`;
                    }
                });

                region.addEventListener('mouseleave', () => {
                    const label = document.querySelector('#hover-label');
                    if (label) {
                        label.remove();
                    }
                });

                // Add click event to select depart/arriv
                region.addEventListener('click', () => {
                    const wilayaCodeNumber = parseInt(wilayaCode, 10); // Convert to a number
                    console.log(`Clicked Wilaya Code: ${wilayaCodeNumber}`); // Log the clicked code

                    if (!selectedPaths.depart) {
                        // First click: Set depart
                        selectedPaths.depart = region;
                        setSelectValue(departSelect, wilayaCodeNumber); // Update the select field
                        highlightPath(region, true);
                        addPin(region, 'depart');
                    } else if (!selectedPaths.arriv && region !== selectedPaths.depart) {
                        // Second click: Set arriv
                        selectedPaths.arriv = region;
                        setSelectValue(arrivSelect, wilayaCodeNumber); // Update the select field
                        highlightPath(region, true);
                        addPin(region, 'arriv');
                        drawArrow(selectedPaths.depart, selectedPaths.arriv, svgContainer);
                    } else {
                        // Reset if both are already selected
                        resetSelection();
                    }
                });
            });

            // Listen for changes in the select fields
            departSelect.addEventListener('change', () => {
                const selectedCode = parseInt(departSelect.value, 10); // Convert to a number
                console.log(`Depart Select Changed: ${selectedCode}`); // Log the selected value
                const selectedRegion = [...regions].find(region => parseInt(region.getAttribute('id').replace('DZ', ''), 10) === selectedCode);
                if (selectedRegion) {
                    if (selectedPaths.depart) resetPath(selectedPaths.depart);
                    selectedPaths.depart = selectedRegion;
                    highlightPath(selectedRegion, true);
                    addPin(selectedRegion, 'depart');
                    if (selectedPaths.arriv) drawArrow(selectedPaths.depart, selectedPaths.arriv, svgContainer);
                }
            });

            arrivSelect.addEventListener('change', () => {
                const selectedCode = parseInt(arrivSelect.value, 10); // Convert to a number
                console.log(`Arriv Select Changed: ${selectedCode}`); // Log the selected value
                const selectedRegion = [...regions].find(region => parseInt(region.getAttribute('id').replace('DZ', ''), 10) === selectedCode);
                if (selectedRegion) {
                    if (selectedPaths.arriv) resetPath(selectedPaths.arriv);
                    selectedPaths.arriv = selectedRegion;
                    highlightPath(selectedRegion, true);
                    addPin(selectedRegion, 'arriv');
                    if (selectedPaths.depart) drawArrow(selectedPaths.depart, selectedPaths.arriv, svgContainer);
                }
            });

            // Helper functions
            function highlightPath(region, highlight) {
                region.style.fill = highlight ? accentYellowColor : '';
            }

            function resetPath(region) {
                region.style.fill = '';
                const pin = document.querySelector(`#pin-${region.getAttribute('id')}`);
                if (pin) pin.remove();
            }

            function addPin(region, type) {
                const bbox = region.getBBox();
                const pin = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                pin.classList.add('map-pin');
                pin.setAttribute('id', `pin-${region.getAttribute('id')}`);
                
                // Position the pin so that its bottom tip is at the center of the region
                const pinWidth = 24; // Approximate width of the pin icon
                const pinHeight = 48; // Approximate height of the pin icon
                pin.setAttribute('x', bbox.x + bbox.width / 2); // Center horizontally
                pin.setAttribute('y', bbox.y + bbox.height / 2 - pinHeight / 2); // Adjust vertically so the tip is centered
                pin.setAttribute('font-size', '48');
                pin.setAttribute('text-anchor', 'middle');
                pin.setAttribute('dominant-baseline', 'central');
                pin.setAttribute('fill', type === 'depart' ? errorColor : errorColor); // Use custom colors
                pin.innerHTML = type === 'depart'
                    ? `<tspan font-family="FontAwesome" font-size="48">&#xf041;</tspan>` // Font Awesome map pin icon for departure
                    : `<tspan font-family="FontAwesome" font-size="48">&#xf041;</tspan>`; // Font Awesome map pin icon for arrival

                console.log(`Adding pin: ${type} at (${pin.getAttribute('x')}, ${pin.getAttribute('y')})`); // Log pin details
                svgContainer.querySelector('svg').appendChild(pin);
            }

            function resetSelection() {
                if (selectedPaths.depart) resetPath(selectedPaths.depart);
                if (selectedPaths.arriv) resetPath(selectedPaths.arriv);

                // Update the properties of selectedPaths instead of reassigning the object
                selectedPaths.depart = null;
                selectedPaths.arriv = null;

                const arrow = document.querySelector('#map-arrow');
                if (arrow) arrow.remove();

                console.log('Resetting selection'); // Log reset action
            }

        })
        .catch(error => {
            console.error('Error loading SVG:', error);
        });
});