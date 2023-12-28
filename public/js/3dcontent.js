

document.addEventListener('DOMContentLoaded', function () {
    
    console.log('Initializing 3D scene...');
    initScene();
});

function initScene() {
    console.log('Inside initScene function');
    const scene = new THREE.Scene();
    scene.background = new THREE.Color(0xdddddd);
    const camera = new THREE.PerspectiveCamera(75, 1, 0.1, 1000);
    camera.rotation.y = 45/180*Math.PI;
    camera.position.x = 800;
    camera.position.y = 100;
    camera.position.z = 5;

    hlight = new THREE.AmbientLight (0x404040, 100);
    scene.add(hlight);

    //Adding directional lights
    directionalLight = new THREE.DirectionalLight(0xffffff, 100);
    directionalLight.position.set(0,1,0);
    directionalLight.castShadow = true;
    scene.add(directionalLight);

    //Adding Shadow
    light = new THREE.PointLight(0xc4c4c4,10);
    light.position.set(0,300,500);
    scene.add(light);

    light2 = new THREE.PointLight(0xc4c4c4,10);
    light2.position.set(500,100,0);
    scene.add(light2);

    light3 = new THREE.PointLight(0xc4c4c4,10);
    light3.position.set(0,100,-500);
    scene.add(light3);

    light4 = new THREE.PointLight(0xc4c4c4,10);
    light4.position.set(-500,300,0);
    scene.add(light4);

    const renderer = new THREE.WebGLRenderer();
    

    document.querySelectorAll('.model-container').forEach(function (container) {
        container.innerHTML = '';
        const { width, height } = container.getBoundingClientRect();
        camera.aspect = width / height;
        camera.updateProjectionMatrix();
        renderer.setSize(width, height);
        container.appendChild(renderer.domElement);

        loadModel(container, scene, camera, renderer);
        
    });
}

function loadModel(container, scene, camera, renderer) {
    console.log('loading model');
    const loader = new THREE.GLTFLoader();
    const modelPath = container.dataset.modelPath;
   // const modelPath = '/storage/models/gltf/scene.gltf';

    loader.load(modelPath, (gltf) => {
        scene.add(gltf.scene);
        adjustCameraPosition(camera, gltf);

        renderer.render(scene, camera);
        console.log('rendering camera');
    }, undefined, (error) => {
        console.error('Error loading 3D model:', error);
    });
}


function adjustCameraPosition(camera, gltf) {
    const boundingBox = new THREE.Box3().setFromObject(gltf.scene);
    const modelSize = boundingBox.getSize(new THREE.Vector3());
    const modelCenter = boundingBox.getCenter(new THREE.Vector3());

    camera.position.copy(modelCenter);
    camera.position.z += Math.max(modelSize.x, modelSize.y, modelSize.z) * 2;
}
