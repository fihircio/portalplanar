
function confirmData(row) {
    if (confirm("Are you sure you want to confirm this data?")) {
        // Perform the confirm action here
        // You can add new data or take any other necessary action
        addNewDataToContent(row);
        console.log("Confirm data action performed");
    } else {
        console.log("Confirm canceled");
    }
}

function addNewDataToContent(row) {
    // Get the content ID and entry key associated with the row
    const contentId = row.dataset.contentId;
    const entryKey = row.dataset.entryKey;
     // Get values from additional data fields
     const data1 = row.querySelector('.data1-input');
  /*   const data2 = row.querySelector('.data2-input');
     const data3 = row.querySelector('.data3-input');
     const data4 = row.querySelector('.data4-input');
     const data5 = row.querySelector('.data5-input');*/
     const inputText = row.querySelector('.input-text-input');
     // Make an AJAX request to store the data
     fetch('/data/store', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Add CSRF token
        },
        body: JSON.stringify({
        content_id: contentId,
        entry_key: entryKey,
       data1: data1.value,
       /*  data2: data2.value,
        data3: data3.value,
        data4: data4.value,
        data5: data5.value,*/
        input_text: inputText.value,
        // Add other data fields as needed
        }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
        console.log('Data stored successfully:', data);
        // You can perform additional actions if needed
        })
        .catch(error => {
        console.error('Error storing data:', error);
        // Handle errors as needed
        });
        
  

    // Clone the row template
    const newRow = document.getElementById('data-row-template').cloneNode(true);
    newRow.removeAttribute('style'); // Remove the 'style' attribute to make the new row visible

    // Set the data attributes for the new row
    //newRow.dataset.contentId = contentId;
   // newRow.dataset.entryKey = entryKey;

    console.log("New Row:", newRow);

    // Append the new row to the table
    document.getElementById('data-table').getElementsByTagName('tbody')[0].appendChild(newRow);
    
    // Update the new row content as needed
    // For example, you might want to clear input fields or update dropdowns
    // newRow.querySelector('select').value = ''; // Update this line based on your actual structure

    console.log("New Row Appended:", newRow);

    // Perform any additional actions needed for the new row
}
