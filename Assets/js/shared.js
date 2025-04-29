// Shared state for selected paths
export const selectedPaths = { depart: null, arriv: null };

// Shared function to set the value of a select field
export function setSelectValue(selectElement, value) {
    const options = selectElement.options;
    for (let i = 0; i < options.length; i++) {
        if (parseInt(options[i].value, 10) === value) {
            options[i].selected = true; // Set the matching option as selected
            console.log(`Setting select value: ${value}`); // Log value setting
            return;
        }
    }
    // If no match is found, reset the select field
    selectElement.value = '';
    console.log(`No match found for value: ${value}, resetting select field`); // Log reset
}

export const rootStyles = getComputedStyle(document.documentElement);
export const primaryColor = rootStyles.getPropertyValue('--tw-color-primary-DEFAULT').trim(); // Green
export const accentBlueColor = rootStyles.getPropertyValue('--tw-color-accentBlue-DEFAULT').trim(); // Blue
export const accentYellowColor = rootStyles.getPropertyValue('--tw-color-accentYellow-DEFAULT').trim(); // Yellow
export const errorColor = rootStyles.getPropertyValue('--tw-color-error-light').trim(); // Red