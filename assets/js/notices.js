const cropperEditor = document.getElementById("cropper-editor");
const img = document.getElementById("background");
const config = {
    aspectRatio: 16 / 9,
    preview: '.img-preview',
    viewMode: 3
}

let uploadedImageURL;

let cropper;
let canvas = "";

const URL = window.URL || window.webkitURL;
if(URL) {
    const inputImage = document.getElementById("file-background");

    inputImage.onchange = function() {
        const files = this.files;
        let file;

        if(files && files.length) {
            file = files[0];

            if(/^image\/\w+/.test(file.type)) {
                if(uploadedImageURL) {
                    URL.revokeObjectURL(uploadedImageURL);
                }

                img.src = uploadedImageURL = URL.createObjectURL(file);
                if(cropper) {
                    cropper.destroy();
                }

                openCropperEditor();
                cropper = new Cropper(img, config);
                inputImage.value = null;
            }
        }
    }
}

function saveCrop() {
    if(cropper) {
        canvas = (cropper.getCroppedCanvas()).toDataURL();
        closeCropperEditor();
    }
}

function openCropperEditor() {
    cropperEditor.classList.add("active");
}

function closeCropperEditor() {
    cropperEditor.classList.remove("active");
}

function saveNotice(event) {
    if(!event) {
        event = window.event;
    }

    if(event.preventDefault()) {
        event.preventDefault();
    } else {
        event.returnValue = false;
    }

    const titleValue = document.getElementById("title").value;
    const subtitleValue = document.getElementById("subtitle").value;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", URLROOT + "/admin/editor", false);

    xhr.addEventListener("load", () => {
        const response = JSON.parse(xhr.responseText);

        if(response.success) {
            customAlert.showAlert(response.message, 1);
        } else {
            customAlert.showAlert(response.message, 3);
        }
    });

    const data = new FormData();
    data.append("requestxhr", "savenotice"); // Tipo de requisição]
    // Id, conteúdo e imagens em uso da noticia
    data.append("id", id);
    data.append("title", titleValue);
    data.append("subtitle", subtitleValue);
    data.append("editor", editor.getData());
    data.append("background", canvas);
    canvas = "";
    data.append("imagesUsed", getAllUrlsFromEditor().toString());

    xhr.send(data);
}

function getAllUrlsFromEditor() {
    return Array.from(new DOMParser().parseFromString(editor.getData(), 'text/html')
        .querySelectorAll('img'))
        .map(img => {
            const imgSrc = img.getAttribute('src');
            const pos = imgSrc.lastIndexOf("/") + 1;
            return imgSrc.slice(pos);
        });
}