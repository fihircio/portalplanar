function confirmDelete(row) {
    if (confirm("Are you sure you want to delete this data?")) {
        // Perform the delete action here
        // You can remove the row or take any other necessary action
        row.remove();
        console.log("Delete confirmed");
    } else {
        console.log("Delete canceled");
    }
}

function confirmDelete(button) {
    if (confirm("Are you sure you want to delete this data?")) {
        const dataId = button.getAttribute('data-id');
        deleteData(dataId);
    }
}

function deleteData(dataId) {
    fetch(`/data/delete/${dataId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log('Data deleted successfully:', data);
        // Remove the deleted row from the table
        const deletedRow = document.querySelector(`tr[data-id="${dataId}"]`);
        if (deletedRow) {
            deletedRow.remove();
        }
        // You can perform additional actions if needed
    })
    .catch(error => {
        console.error('Error deleting data:', error);
        // Handle errors as needed
    });
}
