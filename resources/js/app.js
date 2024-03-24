import './bootstrap';

//import $ from 'jquery';
//window.$ = window.jQuery = $; // Make jQuery globally available
//DataTables
import DataTable from 'datatables.net-dt';

document.addEventListener('DOMContentLoaded', function() {
    let tableElement = document.querySelector('.dt');
    let table = new DataTable(tableElement, {
        pageLength: 50
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('.form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            const buttons = form.querySelectorAll('button');
            buttons.forEach(function(button) {
                button.disabled = true; // Disable the button
                button.classList.add('disabled-button'); // Add a class to style the button (optional)
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var footerHTML = `
        <footer class="p-4" id="customFooter">
            <div class="row">
                <div class="col-md-12 text-center">
                    Copyright © SITA ${new Date().getFullYear()}. All rights reserved.
                </div>
            </div>
        </footer>`;
    document.getElementById('content').insertAdjacentHTML('afterend', footerHTML);
});
