document.addEventListener('DOMContentLoaded', function () {
    // Add Data button click event
    console.log('Script loaded');
    
    var addButton = document.getElementById('add-data-button');
    if (addButton) {
        addButton.addEventListener('click', function () {
            console.log('Button clicked');
            
           
            // Clone the row template
            var newRow = document.getElementById('data-row-template').cloneNode(true);

            // Remove the 'style' attribute to make the new row visible
            newRow.removeAttribute('style');

            // Append the new row to the table
            var dataTable = document.getElementById('data-table');
            if (dataTable) {
                console.log('Table found');
                var tbody = dataTable.getElementsByTagName('tbody')[0];
                if (tbody) {
                    console.log('Tbody found');
                    tbody.appendChild(newRow);
                } else {
                    console.log('Tbody not found');
                }
            } else {
                console.log('Table not found');
            }
        });
    } else {
        console.log('Button not found');
    }
    function confirmDelete(button) {
        if (confirm("Are you sure you want to delete this data?")) {
            // Perform the delete action here
            // You can remove the row or take any other necessary action
            deleteDataRow(button);
            console.log("Delete confirmed");
        } else {
            console.log("Delete canceled");
        }
    }
    
    function deleteDataRow(button) {
        // Get the parent row of the button (the row to be deleted)
        var rowToDelete = button.closest('tr');
    
        // Remove the row from the table
        if (rowToDelete) {
            rowToDelete.remove();
            console.log("Row deleted successfully");
        } else {
            console.error("Error deleting row: Row not found");
        }
    }

    function downloadMetadata(title, description) {
        const metadata = {
            title: title,
            description: description,
        };
    
        const blob = new Blob([JSON.stringify(metadata)], { type: 'application/json' });
        const link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = `${title}_metadata.json`;
        link.click();
    }
    
});
