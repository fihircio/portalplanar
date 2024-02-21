document.addEventListener('DOMContentLoaded', function () {
    console.log('upload model loaded');
    const sketchfabInput = document.getElementById('sketchfab-input');
    const modelFileInput = document.getElementById('model-file');
    const form = document.getElementById('uploadfileform'); // Replace 'your-form-id' with the actual ID of your form

    modelFileInput.addEventListener('change', function () {
       // handleModelFileUpload(this.files[0]);
        const modelPathElement = document.getElementById('model-path');
        if (modelPathElement) {
            modelPathElement.textContent = `Selected Model File: ${selectedFile.name}`;
        }
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission behavior

        // Check if the file input has a file selected
        const selectedFile = modelFileInput.files[0];
        if (!selectedFile) {
            console.log('No file selected. Please choose a file.');
            return;
        }
        // Handle the file upload when the form is submitted
        handleModelFileUpload(selectedFile);
    });
    
    sketchfabInput.addEventListener('change', function () {
        handleSketchfabUpload(this.value);
    });

   function handleModelFileUpload (file) {
        const formData = new FormData();
        formData.append('model_file', file);
        formData.append('title', document.getElementById('title').value);
        formData.append('description', document.getElementById('description').value);
    
        const modelPathElement = document.getElementById('model-path');
        if (modelPathElement) {
            modelPathElement.textContent = `Selected Model File: ${file.name}`;
        }
        console.log('Model file uploaded:', file);
        
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
       
        fetch('/content/store', {
            method: 'POST',
            headers: {   
                'X-CSRF-TOKEN': csrfToken,
            },
            body: formData,
            //redirect: 'follow',  // Follow the redirect
        })
        .then(response => response.json())
        .then(data => {
            console.log('Server response:', data);
            // Handle the response as needed
        })
        .catch(error => {
            console.error('Error:', error);
    
            if (error.response) {
                // Log the full response for debugging
                return error.response.text().then(text => {
                    console.error('Full server response:', text);
                });
            } else {
                console.error('No response received.');
    
                // Log additional information about the error
             /*   console.error('Error name:', error.name);
                console.error('Error message:', error.message);
                console.error('Error stack:', error.stack);*/
            }
        });
        
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
