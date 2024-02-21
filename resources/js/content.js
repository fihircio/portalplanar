document.addEventListener('DOMContentLoaded', function () {
    // Add Data button click event
    console.log('Content js Script loaded');

    window.downloadModelAndMetadata=function(title, description, modelPath) {
//function downloadModelAndMetadata(title, description, modelPath) {
    const metadata = {
        title: title,
        description: description,
    };

    // Fetch the 3D model file
    fetch(modelPath)
        .then(response => response.blob())
        .then(modelBlob => {
            const modelFile = new File([modelBlob], `${title}_model_with_metadata.glb`, { type: 'model/gltf-binary' });

            // Fetch additional files (e.g., .bin and textures)
            Promise.all([
                fetch(`${modelPath.replace('.glb', '.bin')}`).then(response => response.blob()),
                fetch(`${modelPath.replace('.glb', '_textures.zip')}`).then(response => response.blob()), // Modify this based on your file structure
            ])
                .then(([binBlob, texturesBlob]) => {
                    const zip = new JSZip();
                    zip.file(`${title}.bin`, binBlob, { binary: true });
                    zip.file(`${title}_textures.zip`, texturesBlob, { binary: true });

                    // Create a Blob from the zipped files
                    zip.generateAsync({ type: 'blob' })
                        .then(zipBlob => {
                            // Combine the model and additional files into a single Blob
                            const combinedBlob = new Blob([modelFile, zipBlob], { type: 'application/zip' });

                            // Create an anchor element for download
                            const link = document.createElement('a');
                            link.href = URL.createObjectURL(combinedBlob);
                            link.download = `${title}_model_with_metadata.zip`;

                            // Trigger the download
                            link.click();
                        });
                });
        });
}

function embedMetadata(gltfData, metadata) {
    // Convert the Uint8Array to a string
    const gltfString = new TextDecoder().decode(gltfData);

    // Parse the glTF JSON
    const gltfJson = JSON.parse(gltfString);

    // Embed metadata into the glTF JSON
    gltfJson.metadata = metadata;

    // Convert the modified glTF JSON back to a Uint8Array
    const embeddedGltfData = new TextEncoder().encode(JSON.stringify(gltfJson));

    return embeddedGltfData;
}

});


