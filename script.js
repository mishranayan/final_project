// script.js - basic interactivity
document.addEventListener("DOMContentLoaded", function() {
    const eventBoxes = document.querySelectorAll('.event-box');
    eventBoxes.forEach(box => {
        box.addEventListener('click', () => {
            alert("You clicked on event: " + box.querySelector('h3').innerText);
        });
    });
});
