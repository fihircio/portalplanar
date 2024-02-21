document.addEventListener('DOMContentLoaded', function () {
    // Add Data button click event
    console.log('data js Script loaded');

    window.addData = function (contentId) {
        console.log('Button clicked for Content ID:', contentId);
    
        // Clone the row template
        var newRowTemplate = document.getElementById('data-row-template-' + contentId);
        if (newRowTemplate) {
            var newRow = newRowTemplate.cloneNode(true);
    
            // Remove the 'style' attribute to make the new row visible
            newRow.removeAttribute('style');
    
            // Append the new row to the correct table
            var dataTable = document.getElementById('data-table-' + contentId);
            if (dataTable) {
                console.log('Table found for Content ID:', contentId);
                var tbody = dataTable.getElementsByTagName('tbody')[0];
                if (tbody) {
                    console.log('Tbody found for Content ID:', contentId);
                    tbody.appendChild(newRow);
                } else {
                    console.log('Tbody not found for Content ID:', contentId);
                }
            } else {
                console.log('Table not found for Content ID:', contentId);
            }
        } else {
            console.log('New row template not found for Content ID:', contentId);
        }
    };

    var addButton = document.getElementById('add-data-button');
    if (addButton) {
        addButton.addEventListener('click', window.addData);
    } else {
        console.log('Button not found');
    }
});
