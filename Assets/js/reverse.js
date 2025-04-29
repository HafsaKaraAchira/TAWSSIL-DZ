import { selectedPaths, setSelectValue } from './shared.js';
import { drawArrow } from './dz-map.js';

document.addEventListener('DOMContentLoaded', () => {
    const reverseButton = document.getElementById('reverse-button');
    const depart = document.getElementById('depart');
    const arriv = document.getElementById('arriv');
    const svgContainer = document.querySelector('.dz-map-svg'); // Ensure svgContainer is defined here

    if (reverseButton && depart && arriv) {
        reverseButton.addEventListener('click', () => {
            if (selectedPaths.depart && selectedPaths.arriv) {
                // Swap depart and arriv
                const temp = selectedPaths.depart;
                selectedPaths.depart = selectedPaths.arriv;
                selectedPaths.arriv = temp;

                // Update the select fields
                setSelectValue(depart, parseInt(selectedPaths.depart.getAttribute('id').replace('DZ', ''), 10));
                setSelectValue(arriv, parseInt(selectedPaths.arriv.getAttribute('id').replace('DZ', ''), 10));

                // Redraw the arrow
                drawArrow(selectedPaths.depart, selectedPaths.arriv, svgContainer);

                console.log('Reversed the arrow direction');
            } else {
                console.warn('Cannot reverse: Both depart and arriv must be selected.');
            }
        });
    } else {
        console.error('One or more elements (reverse-button, depart, arriv) are missing in the DOM.');
    }
});