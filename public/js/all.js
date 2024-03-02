/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/3dcontent.js":
/*!***********************************!*\
  !*** ./resources/js/3dcontent.js ***!
  \***********************************/
/***/ (() => {

document.addEventListener('DOMContentLoaded', function () {
  console.log('Initializing 3D scene...');
  initScene();
  var renderer, scene, camera;
  function initScene() {
    console.log('Inside initScene function');
    document.querySelectorAll('.model-container').forEach(function (container) {
      container.innerHTML = '';
      scene = new THREE.Scene();
      scene.background = new THREE.Color(0xdddddd);
      camera = new THREE.PerspectiveCamera(20, window.innerWidth / window.innerHeight, 1, 2000);
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
      var hlight = new THREE.AmbientLight(0x404040, 100);
      scene.add(hlight);

      //Adding directional lights
      var directionalLight = new THREE.DirectionalLight(0xffffff, 100);
      directionalLight.position.set(0, 1, 0);
      directionalLight.castShadow = true;
      scene.add(directionalLight);

      //Adding Shadow
      var light = new THREE.PointLight(0xc4c4c4, 10);
      light.position.set(0, 300, 500);
      scene.add(light);
      var _container$getBoundin = container.getBoundingClientRect(),
        width = _container$getBoundin.width,
        height = _container$getBoundin.height;
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
    loader.load(modelPath, function (gltf) {
      scene.add(gltf.scene);
      adjustCameraPosition(camera, gltf);
      renderer.render(scene, camera);
      console.log('rendering camera');
    }, undefined, function (error) {
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
    var boundingBox = new THREE.Box3().setFromObject(gltf.scene);
    var modelSize = boundingBox.getSize(new THREE.Vector3());
    var modelCenter = boundingBox.getCenter(new THREE.Vector3());
    camera.position.copy(modelCenter);
    camera.position.z += Math.max(modelSize.x, modelSize.y, modelSize.z) * 2;
  }
});

/***/ }),

/***/ "./resources/js/ar-mode.js":
/*!*********************************!*\
  !*** ./resources/js/ar-mode.js ***!
  \*********************************/
/***/ (() => {

document.addEventListener('DOMContentLoaded', function () {
  console.log('armode loaded');
  function openARModePopup() {
    var arPopup = document.getElementById('ar-popup');
    if (arPopup) {
      arPopup.style.display = 'block';
    }
  }
  function closeARModePopup() {
    var arPopup = document.getElementById('ar-popup');
    if (arPopup) {
      arPopup.style.display = 'none';
    }
  }
  function generateQRCode(mode, contentId) {
    // Call the Laravel route to generate QR code URL
    axios.post('/generate-qrcode', {
      contentId: contentId,
      mode: mode
    }).then(function (response) {
      // Get the generated QR code URL
      var qrCodeURL = response.data.qrCodeURL;

      // Use the qrCodeURL as needed (e.g., display, redirect, etc.)
      console.log('QR Code URL:', qrCodeURL);
    })["catch"](function (error) {
      console.error('Failed to generate QR code:', error);
    });
  }
  window.openARModePopup = openARModePopup;
  window.closeARModePopup = closeARModePopup;
  window.generateQRCode = generateQRCode;
});

/***/ }),

/***/ "./resources/js/confirm-data.js":
/*!**************************************!*\
  !*** ./resources/js/confirm-data.js ***!
  \**************************************/
/***/ (() => {

document.addEventListener('DOMContentLoaded', function () {
  // Add Data button click event
  console.log('Confirm data js Script loaded');
  window.confirmData = function (row) {
    if (confirm("Are you sure you want to confirm this data?")) {
      // Perform the confirm action here
      // You can add new data or take any other necessary action
      addNewDataToContent(row);
      console.log("Confirm data action performed");
    } else {
      console.log("Confirm canceled");
    }
  };
  function addNewDataToContent(row) {
    // Get the content ID and entry key associated with the row
    var contentId = row.dataset.contentId;
    var entryKey = row.dataset.entryKey;
    // Get values from additional data fields
    var data1 = row.querySelector('.data1-input');
    /*   const data2 = row.querySelector('.data2-input');
       const data3 = row.querySelector('.data3-input');
       const data4 = row.querySelector('.data4-input');
       const data5 = row.querySelector('.data5-input');*/
    var inputText = row.querySelector('.input-text-input');
    // Make an AJAX request to store the data
    fetch('/data/store', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Add CSRF token
      },
      body: JSON.stringify({
        content_id: contentId,
        entry_key: entryKey,
        data1: data1,
        /*  data2: data2.value,
         data3: data3.value,
         data4: data4.value,
         data5: data5.value,*/
        input_text: inputText
        // Add other data fields as needed
      })
    }).then(function (response) {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    }).then(function (data) {
      console.log('Data stored successfully:', data);
      // You can perform additional actions if needed
    })["catch"](function (error) {
      console.error('Error storing data:', error);
      // Handle errors as needed
    });

    // Clone the row template
    var newRow = document.getElementById('data-row-template').cloneNode(true);
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
});

/***/ }),

/***/ "./resources/js/confirm-delete.js":
/*!****************************************!*\
  !*** ./resources/js/confirm-delete.js ***!
  \****************************************/
/***/ (() => {

document.addEventListener('DOMContentLoaded', function () {
  // Add Data button click event
  console.log('Confirm delete js Script loaded');
  window.confirmDeleteRow = function (row) {
    if (confirm("Are you sure you want to delete this data?")) {
      // Perform the delete action here
      // You can remove the row or take any other necessary action
      row.remove();
      console.log("Delete confirmed");
    } else {
      console.log("Delete canceled");
    }
  };
  window.confirmDelete = function (button) {
    if (confirm("Are you sure you want to delete this data?")) {
      var dataId = button.getAttribute('data-id');
      deleteData(dataId);
    }
  };
  function deleteData(dataId) {
    fetch("/data/delete/".concat(dataId), {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    }).then(function (response) {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    }).then(function (data) {
      console.log('Data deleted successfully:', data);
      // Remove the deleted row from the table
      var deletedRow = document.querySelector("tr[data-id=\"".concat(dataId, "\"]"));
      if (deletedRow) {
        deletedRow.remove();
      }
      window.location.reload(); // You can perform additional actions if needed
    })["catch"](function (error) {
      console.error('Error deleting data:', error);
      // Handle errors as needed
    });
  }
});

/***/ }),

/***/ "./resources/js/content-delete.js":
/*!****************************************!*\
  !*** ./resources/js/content-delete.js ***!
  \****************************************/
/***/ (() => {

document.addEventListener('DOMContentLoaded', function () {
  // Add Data button click event
  console.log('Content delete js Script loaded');
  window.confirmDeleteContent = function (button) {
    if (confirm("Are you sure you want to delete this content?")) {
      var contentId = button.getAttribute('data-content-id');
      deleteContent(contentId);
    }
  };
  function deleteContent(contentId) {
    fetch("/content/delete/".concat(contentId), {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    }).then(function (response) {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    }).then(function (data) {
      console.log('Content deleted successfully:', data);
      // Remove the deleted content item from the DOM
      var deletedItem = document.querySelector(".content-item[data-content-id=\"".concat(contentId, "\"]"));
      if (deletedItem) {
        deletedItem.remove();
      }
      window.location.reload(); // You can perform additional actions if needed
    })["catch"](function (error) {
      console.error('Error deleting content:', error);
      // Handle errors as needed
    });
  }
});

/***/ }),

/***/ "./resources/js/content.js":
/*!*********************************!*\
  !*** ./resources/js/content.js ***!
  \*********************************/
/***/ (() => {

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }
document.addEventListener('DOMContentLoaded', function () {
  // Add Data button click event
  console.log('Content js Script loaded');
  window.downloadModelAndMetadata = function (title, description, modelPath) {
    //function downloadModelAndMetadata(title, description, modelPath) {
    var metadata = {
      title: title,
      description: description
    };

    // Fetch the 3D model file
    fetch(modelPath).then(function (response) {
      return response.blob();
    }).then(function (modelBlob) {
      var modelFile = new File([modelBlob], "".concat(title, "_model_with_metadata.glb"), {
        type: 'model/gltf-binary'
      });

      // Fetch additional files (e.g., .bin and textures)
      Promise.all([fetch("".concat(modelPath.replace('.glb', '.bin'))).then(function (response) {
        return response.blob();
      }), fetch("".concat(modelPath.replace('.glb', '_textures.zip'))).then(function (response) {
        return response.blob();
      }) // Modify this based on your file structure
      ]).then(function (_ref) {
        var _ref2 = _slicedToArray(_ref, 2),
          binBlob = _ref2[0],
          texturesBlob = _ref2[1];
        var zip = new JSZip();
        zip.file("".concat(title, ".bin"), binBlob, {
          binary: true
        });
        zip.file("".concat(title, "_textures.zip"), texturesBlob, {
          binary: true
        });

        // Create a Blob from the zipped files
        zip.generateAsync({
          type: 'blob'
        }).then(function (zipBlob) {
          // Combine the model and additional files into a single Blob
          var combinedBlob = new Blob([modelFile, zipBlob], {
            type: 'application/zip'
          });

          // Create an anchor element for download
          var link = document.createElement('a');
          link.href = URL.createObjectURL(combinedBlob);
          link.download = "".concat(title, "_model_with_metadata.zip");

          // Trigger the download
          link.click();
        });
      });
    });
  };
  function embedMetadata(gltfData, metadata) {
    // Convert the Uint8Array to a string
    var gltfString = new TextDecoder().decode(gltfData);

    // Parse the glTF JSON
    var gltfJson = JSON.parse(gltfString);

    // Embed metadata into the glTF JSON
    gltfJson.metadata = metadata;

    // Convert the modified glTF JSON back to a Uint8Array
    var embeddedGltfData = new TextEncoder().encode(JSON.stringify(gltfJson));
    return embeddedGltfData;
  }
});

/***/ }),

/***/ "./resources/js/data.js":
/*!******************************!*\
  !*** ./resources/js/data.js ***!
  \******************************/
/***/ (() => {

document.addEventListener('DOMContentLoaded', function () {
  // Add Data button click event
  console.log('data js Script loaded');
  window.addData = function (contentId) {
    console.log('Button clicked for Content ID:', contentId);

    // Clone the row template
    var newRowTemplate = document.getElementById('data-row-template-' + contentId);
    if (newRowTemplate) {
      var newRow = newRowTemplate.cloneNode(true);

      // Remove the 'style' attribute to make the new row visible
      newRow.removeAttribute('style');

      // Append the new row to the correct table
      var dataTable = document.getElementById('data-table-' + contentId);
      if (dataTable) {
        console.log('Table found for Content ID:', contentId);
        var tbody = dataTable.getElementsByTagName('tbody')[0];
        if (tbody) {
          console.log('Tbody found for Content ID:', contentId);
          tbody.appendChild(newRow);
        } else {
          console.log('Tbody not found for Content ID:', contentId);
        }
      } else {
        console.log('Table not found for Content ID:', contentId);
      }
    } else {
      console.log('New row template not found for Content ID:', contentId);
    }
  };
  var addButton = document.getElementById('add-data-button');
  if (addButton) {
    addButton.addEventListener('click', window.addData);
  } else {
    console.log('Button not found');
  }
});

/***/ }),

/***/ "./resources/js/upload-model.js":
/*!**************************************!*\
  !*** ./resources/js/upload-model.js ***!
  \**************************************/
/***/ (() => {

document.addEventListener('DOMContentLoaded', function () {
  console.log('upload model loaded');
  var sketchfabInput = document.getElementById('sketchfab-input');
  var modelFileInput = document.getElementById('model-file');
  var form = document.getElementById('uploadfileform'); // Replace 'your-form-id' with the actual ID of your form

  modelFileInput.addEventListener('change', function () {
    // handleModelFileUpload(this.files[0]);
    var modelPathElement = document.getElementById('model-path');
    if (modelPathElement) {
      modelPathElement.textContent = "Selected Model File: ".concat(selectedFile.name);
    }
  });
  form.addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent the default form submission behavior

    // Check if the file input has a file selected
    var selectedFile = modelFileInput.files[0];
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
  function handleModelFileUpload(file) {
    var formData = new FormData();
    formData.append('model_file', file);
    formData.append('title', document.getElementById('title').value);
    formData.append('description', document.getElementById('description').value);
    var modelPathElement = document.getElementById('model-path');
    if (modelPathElement) {
      modelPathElement.textContent = "Selected Model File: ".concat(file.name);
    }
    console.log('Model file uploaded:', file);
    var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
    fetch('/content/store', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      body: formData
      //redirect: 'follow',  // Follow the redirect
    }).then(function (response) {
      return response.json();
    }).then(function (data) {
      console.log('Server response:', data);
      // Handle the response as needed
    })["catch"](function (error) {
      console.error('Error:', error);
      if (error.response) {
        // Log the full response for debugging
        return error.response.text().then(function (text) {
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
    var sketchfabApiUrl = "https://api.sketchfab.com/v3/models/".concat(sketchfabUrlOrId);
    console.log('Sketchfab model uploaded:', sketchfabUrlOrId);
    fetch(sketchfabApiUrl, {
      headers: {
        Authorization: 'Bearer 73b96b3d2d524ac6ad964f45206b032d'
      }
    }).then(function (response) {
      return response.json();
    }).then(function (data) {
      var modelTitle = data.name;
      var modelDescription = data.description;
      var modelFileUrl = data.files.find(function (file) {
        return file.quality === 'original';
      }).url;
      console.log('Model Title:', modelTitle);
      console.log('Model Description:', modelDescription);
      console.log('Model File URL:', modelFileUrl);

      // You may want to trigger the actual upload or save the information to your database here
    })["catch"](function (error) {
      console.error('Error fetching Sketchfab model:', error);
    });
  }
});

/***/ }),

/***/ "./resources/css/app.css":
/*!*******************************!*\
  !*** ./resources/css/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/all": 0,
/******/ 			"css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkportalplanar"] = self["webpackChunkportalplanar"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/js/upload-model.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/js/data.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/js/content.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/js/3dcontent.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/js/content-delete.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/js/confirm-delete.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/js/confirm-data.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/js/ar-mode.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/css/app.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;