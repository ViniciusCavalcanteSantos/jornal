// Configurações o ckeditor
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
            document.getElementById("title").value = title;
            document.getElementById("subtitle").value = subtitle;
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

        xhr.open("POST", URLROOT+"/admin/editor", true);
    }

    // Configura como a resposta da requisição ajax deve ser tratada
    _initListeners(resolve, reject, file) {
        const xhr = this.xhr;
        const loader = this.loader;
        const genericErrorText = `Não foi possivel fazer o upload da imagem: ${file.name}.`;

        xhr.addEventListener("error", () => reject(genericErrorText));
        xhr.addEventListener("abort", () => reject() );
        xhr.addEventListener("load",  () => {
            const response = JSON.parse(xhr.responseText);

            if(!response.success) {
                return reject(response.message);
            }

            resolve({
                default: URLROOT+"/"+response.url
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