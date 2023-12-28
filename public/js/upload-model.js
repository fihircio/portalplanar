document.addEventListener('DOMContentLoaded', function () {
    const sketchfabInput = document.getElementById('sketchfab-input'); // Assuming you have an input field with the id 'sketchfab-input'
    const modelFileInput = document.getElementById('model-file');

    modelFileInput.addEventListener('change', function () {
        handleModelFileUpload(this.files[0]);
    });

    sketchfabInput.addEventListener('change', function () {
        handleSketchfabUpload(this.value);
    });

    function handleModelFileUpload(file) {
        // Handle model file upload logic
        // You can use the FormData API to send the file to your server
        const formData = new FormData();
        formData.append('model_file', file);
        formData.append('title', document.getElementById('title').value); // Add title field
        formData.append('description', document.getElementById('description').value); // Add description field

         // Assuming you have an element to display the file path
         const modelPathElement = document.getElementById('model-path');
         if (modelPathElement) {
             // Set the file path in the element (you might need to adjust this based on your actual HTML structure)
             modelPathElement.textContent = `Selected Model File: ${file.name}`;
         }
 
         console.log('Model file uploaded:', file);
    }

    function handleSketchfabUpload(sketchfabUrlOrId) {
        const sketchfabApiUrl = `https://api.sketchfab.com/v3/models/${sketchfabUrlOrId}`;
        console.log('Sketchfab model uploaded:', sketchfabUrlOrId);

        fetch(sketchfabApiUrl, {
            headers: {
                Authorization: 'Bearer 73b96b3d2d524ac6ad964f45206b032d',
            },
        })
        .then(response => response.json())
        .then(data => {
            const modelTitle = data.name;
            const modelDescription = data.description;
            const modelFileUrl = data.files.find(file => file.quality === 'original').url;

            // Now you can handle the retrieved information as needed in your application
            console.log('Model Title:', modelTitle);
            console.log('Model Description:', modelDescription);
            console.log('Model File URL:', modelFileUrl);

            // You may want to trigger the actual upload or save the information to your database here
        })
        .catch(error => {
            console.error('Error fetching Sketchfab model:', error);
        });
    }
});



