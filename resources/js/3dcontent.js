document.addEventListener('DOMContentLoaded', function () {
    
    console.log('Initializing 3D scene...');
    initScene();

    let renderer, scene, camera;

function initScene() {
    console.log('Inside initScene function');
  

    document.querySelectorAll('.model-container').forEach(function (container) {
        container.innerHTML = '';
        
         scene = new THREE.Scene();
        scene.background = new THREE.Color(0xdddddd);
       
         camera = new THREE.PerspectiveCamera( 20, window.innerWidth / window.innerHeight, 1, 2000 );
        camera.position.z = 250;
        
         renderer = new THREE.WebGLRenderer();
        renderer.setClearColor(0xccccff);
        container.appendChild(renderer.domElement);
        //renderer.setSize(width, height);
        //renderer.setSize( window.innerWidth, window.innerHeight );

         controls = new THREE.OrbitControls(camera, renderer.domElement);
        controls.addEventListener('change', function () {
            renderer.render(scene, camera);
        });
        
        const hlight = new THREE.AmbientLight (0x404040, 100);
        scene.add(hlight);
    
        //Adding directional lights
        const directionalLight = new THREE.DirectionalLight(0xffffff, 100);
        directionalLight.position.set(0,1,0);
        directionalLight.castShadow = true;
        scene.add(directionalLight);
    
        //Adding Shadow
        const light = new THREE.PointLight(0xc4c4c4,10);
        light.position.set(0,300,500);
        scene.add(light);
        
        const { width, height } = container.getBoundingClientRect();
        //camera.aspect = width / height;
        camera.updateProjectionMatrix();
        
        renderer.setSize(width, height);
        renderer.setClearColor(0xccccff);

        loadModel(container, scene, camera, renderer);
        animate();
        
    });
}

function loadModel(container, scene, camera, renderer) {
    console.log('loading model');
     loader = new THREE.GLTFLoader();
     modelPath = container.dataset.modelPath;


    loader.load(modelPath, (gltf) => {
        scene.add(gltf.scene);
        adjustCameraPosition(camera, gltf);

        renderer.render(scene, camera);
        
        console.log('rendering camera');
    }, undefined, (error) => {
        console.error('Error loading 3D model:', error);
        
    });
}
       

function animate() {
    requestAnimationFrame(function () {
        animate(renderer, scene, camera);
    });

    controls.update(); // Update controls in the animation loop
    renderer.render(scene, camera);
}


function adjustCameraPosition(camera, gltf) {
            const boundingBox = new THREE.Box3().setFromObject(gltf.scene);
            const modelSize = boundingBox.getSize(new THREE.Vector3());
            const modelCenter = boundingBox.getCenter(new THREE.Vector3());

            camera.position.copy(modelCenter);
            camera.position.z += Math.max(modelSize.x, modelSize.y, modelSize.z) * 2;
}
  
    });