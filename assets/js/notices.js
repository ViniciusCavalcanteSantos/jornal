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