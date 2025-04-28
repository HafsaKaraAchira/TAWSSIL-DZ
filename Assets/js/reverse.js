document.addEventListener('DOMContentLoaded', () => {
    const reverseButton = document.getElementById('reverse-button');
    const depart = document.getElementById('depart');
    const arriv = document.getElementById('arriv');

    console.log('Reverse Button:', reverseButton);
    console.log('Depart Select:', depart);
    console.log('Arriv Select:', arriv);

    if (reverseButton && depart && arriv) {
        reverseButton.addEventListener('click', function () {
            // Swap the values of the two select fields
            const tempValue = depart.value;
            depart.value = arriv.value;
            arriv.value = tempValue;
        });
    } else {
        console.error('One or more elements (reverse-button, depart, arriv) are missing in the DOM.');
    }
});