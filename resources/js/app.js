import './bootstrap';

//import $ from 'jquery';
//window.$ = window.jQuery = $; // Make jQuery globally available
//DataTables
import DataTable from 'datatables.net-dt';


document.addEventListener('DOMContentLoaded', function() {
    //datatables
    let tableElement = document.querySelector('.dt');
    let table = new DataTable(tableElement, {
        pageLength: 50
    });
});


document.addEventListener('DOMContentLoaded', function() {
    // Select all forms with the class 'form'
    const forms = document.querySelectorAll('.form');

    forms.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            // Prevent the form from submitting for demonstration purposes
            // Remove this line if you want the form to actually submit
            //event.preventDefault(); 

            // Find all button elements within the form
            const buttons = form.querySelectorAll('button');

            // Disable and style buttons to appear grayed out
            buttons.forEach(function(button) {
                button.disabled = true; // Disable the button
                button.classList.add('disabled-button'); // Add a class to style the button (optional)
            });
        });
    });
});

 