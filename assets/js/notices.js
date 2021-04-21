// Configurações gerais do ckeditor + vinculação do uploadAdpterPlugin
const ckeditorConfig = {
    extraPlugins: [ UploadAdapterPlugin ],
    toolbar: {
        items: [
            'heading',
            '|',
            'bold',
            'italic',
            'underline',
            'link',
            '|',
            'bulletedList',
            'numberedList',
            'outdent',
            'indent',
            '|',
            'imageUpload',
            'blockQuote',
            'insertTable',
            'mediaEmbed',
            'undo',
            'redo',
            '|',
            'fontColor',
            'fontSize',
            'fontFamily'
        ]
    },
    language: 'pt-br',
    image: {
        toolbar: [
            'imageTextAlternative',
            'imageStyle:full',
            'imageStyle:side',
            'linkImage'
        ]
    },
    table: {
        contentToolbar: [
            'tableColumn',
            'tableRow',
            'mergeTableCells',
            'tableCellProperties'
        ]
    },
    licenseKey: '',
}

// Inicia o ckeditor
ClassicEditor.create(document.getElementById("editor"), ckeditorConfig)
.then(newEditor => {
    editor = newEditor;

    if(id) {
        editor.setData(notice)
        paths = getAllUrlsFromEditor();

        document.getElementById("title").value = title;
        document.getElementById("notice-form").classList.remove("blocked");
        document.getElementById("select-title").classList.add("blocked");
    }
})
.catch(error => {
    console.log(error);
});

// Criação do upload adapter para o ckeditor
class UploadAdapter {
    constructor(loader) {
        this.loader = loader;
    }

    // Chama os metódos responsaveis por preaparar e enviar a requisição ajax, e retorna ao ckeditor
    upload() {
        return this.loader.file
            .then(file => new Promise((resolve, reject) => {
                this._initRequest();
                this._initListeners(resolve, reject, file);
                this._sendRequest(file);
            }));
    }

    abort() {
        if (this.xhr) {
            this.xhr.abort();
        }
    }

    // Inicia a preaparação da requisição ajax
    _initRequest() {
        const xhr = this.xhr = new XMLHttpRequest();

        xhr.open("POST", urlRoot+"/admin/editor", true);
    }

    // Configura como a resposta da requisição ajax deve ser tratada
    _initListeners( resolve, reject, file ) {
        const xhr = this.xhr;
        const loader = this.loader;
        const genericErrorText = `Couldn't upload file: ${ file.name }.`;

        xhr.addEventListener("error", () => reject(genericErrorText));
        xhr.addEventListener("abort", () => reject() );
        xhr.addEventListener("load",  () => {
            console.log(xhr.responseText);
            const response = JSON.parse(xhr.responseText);

            if(!response.success) {
                return reject(response.message);
            }

            paths.push(response.url);

            resolve({
                default: urlRoot+"/"+response.url
            });
        });
    }

    // Envia a requisão ajax
    _sendRequest(file) {
        const data = new FormData();

        data.append('requestxhr', "uploadimage");
        data.append('upload', file);
        data.append('id', id);

        this.xhr.send(data);
    }
}

// Crialção do plugin do uploadAdapter
function UploadAdapterPlugin(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
        return new UploadAdapter(loader);
    };
}

function createNotice() {
    const titleValue = document.getElementById("title").value;

    if(titleValue) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", urlRoot + "/admin/editor", false);

        xhr.addEventListener("load", () => {
            const response = JSON.parse(xhr.responseText);

            if(response.success) {
                id = response.id;
                title = response.title;

                document.getElementById("notice-form").classList.remove("blocked");
                document.getElementById("select-title").classList.add("blocked");
            } else {
                customAlert.showAlert("O título já esta em uso", 3);
            }
        });

        const data = new FormData();
        data.append('requestxhr', "createnotice");
        data.append("title", titleValue);

        xhr.send(data);

    } else {
        customAlert.showAlert("O título não pode ser vazio", 3);
    }

    customPopup.closePopup();
}

function saveNotice() {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", urlRoot + "/admin/editor", false);

    xhr.addEventListener("load", () => {
        console.log(xhr.responseText);


    });

    const data = new FormData();
    data.append('requestxhr', "savenotice"); // Tipo de requisição]
    // Id, conteúdo e imagens em uso da noticia
    data.append("id", id); 
    data.append("editor", editor.getData());
    data.append("imagesUsed", getAllUrlsFromEditor().toString());

    xhr.send(data);
}

function submitForm() {
    document.getElementById("filesdeleted").value = getAllUrlsFromEditor().toString();
}

function checkPermission() {
    if(!title) {
        customAlert.showAlert("Selecione um titúlo primeiro", 3);
    }
}

function getAllUrlsFromEditor() {
    const paths = Array.from(new DOMParser().parseFromString(editor.getData(), 'text/html')
        .querySelectorAll('img'))
        .map(img => {
            const imgSrc = img.getAttribute('src');
            const pos = imgSrc.lastIndexOf("/") + 1;
            return imgSrc.slice(pos);
        });

    return paths;
}