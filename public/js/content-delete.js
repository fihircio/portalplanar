// content-delete.js

function confirmDeleteContent(button) {
    if (confirm("Are you sure you want to delete this content?")) {
        const contentId = button.getAttribute('data-content-id');
        deleteContent(contentId);
    }
}

function deleteContent(contentId) {
    fetch(`/content/delete/${contentId}`, {
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
        console.log('Content deleted successfully:', data);
        // Remove the deleted content item from the DOM
        const deletedItem = document.querySelector(`.content-item[data-content-id="${contentId}"]`);
        if (deletedItem) {
            deletedItem.remove();
        }
        // You can perform additional actions if needed
    })
    .catch(error => {
        console.error('Error deleting content:', error);
        // Handle errors as needed
    });
}
