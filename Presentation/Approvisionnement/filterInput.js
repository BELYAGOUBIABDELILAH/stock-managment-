// filterInput.js
function allowLettersAndSpaces(event) {
    let inputValue = event.target.value;
    inputValue = inputValue.replace(/[^A-Za-z ]/g, '');
    event.target.value = inputValue;
}
