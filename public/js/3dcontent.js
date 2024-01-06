

document.addEventListener('DOMContentLoaded', function () {
    
    console.log('Initializing 3D scene...');
    initScene();


function initScene() {
    console.log('Inside initScene function');
    scene = new THREE.Scene();
    scene.background = new THREE.Color(0xdddddd);
    //const camera = new THREE.PerspectiveCamera(75, 1, 0.1, 1000);
    camera = new THREE.PerspectiveCamera( 20, window.innerWidth / window.innerHeight, 1, 2000 );
   /* camera.rotation.y = 45/180*Math.PI;
    camera.position.x = 800;
    camera.position.y = 100;*/
    camera.position.z = 250;

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

    document.querySelectorAll('.model-container').forEach(function (container) {
        container.innerHTML = '';
        const { width, height } = container.getBoundingClientRect();
        //camera.aspect = width / height;
        camera.updateProjectionMatrix();
        renderer = new THREE.WebGLRenderer();
        //renderer.setSize(width, height);
        renderer.setClearColor(0xccccff);
        //renderer.setSize( window.innerWidth, window.innerHeight );
        container.appendChild(renderer.domElement);

        loadModel(container, scene, camera, renderer);

        controls = new THREE.OrbitControls(camera, renderer.domElement);
        controls.addEventListener('change', renderer);

        animate();
        
    });
}

function loadModel(container, scene, camera, renderer) {
    console.log('loading model');
    const loader = new THREE.GLTFLoader();
    const modelPath = container.dataset.modelPath;
    //const modelPath = '/storage/models/gltf/scene.gltf';

    loader.load(modelPath, (gltf) => {
        scene.add(gltf.scene);
        adjustCameraPosition(camera, gltf);

        renderer.render(scene, camera);
        
        console.log('rendering camera');
    }, undefined, (error) => {
        console.error('Error loading 3D model:', error);
        
        //obj & mtl load
        var mesh = null;

        var mtlLoader = new THREE.MTLLoader(); 
         
        mtlLoader.load( '/storage/models/obj/ToyCar.mtl', function( materials ) {
          materials.preload();
          var objLoader = new THREE.OBJLoader();
          objLoader.setMaterials( materials );
         
          objLoader.load( '/storage/models/obj/ToyCar.obj', function ( object ) {    
              mesh = object;
              scene.add( mesh );
          });
        });
    });
}
       

        function animate() {
            renderer.render( scene, camera );
            requestAnimationFrame( animate );
        }


        function adjustCameraPosition(camera, gltf) {
            const boundingBox = new THREE.Box3().setFromObject(gltf.scene);
            const modelSize = boundingBox.getSize(new THREE.Vector3());
            const modelCenter = boundingBox.getCenter(new THREE.Vector3());

            camera.position.copy(modelCenter);
            camera.position.z += Math.max(modelSize.x, modelSize.y, modelSize.z) * 2;
        }
  
    });