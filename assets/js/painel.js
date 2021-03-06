
const customAlert = new CustomAlert(document.getElementById("custom-alert"));

function deleteNotice(id) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", `${URLROOT}/admin/painel`, false);

    xhr.addEventListener("load", () => {
        const response = JSON.parse(xhr.responseText);

        if(response.success) {
            // customAlert.showAlert("noticia apagada com sucesso", 1)
            window.location.href= `${URLROOT}/admin/painel`;
        } else {
            customAlert.showAlert("Não foi possivel deletar a noticia", 4)
        }
    });

    const data = new FormData();
    data.append('requestxhr', "deletenotice");
    data.append("id", id);

    xhr.send(data);
}

function toggleActive(id) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", `${URLROOT}/admin/painel`, false);

    xhr.addEventListener("load", () => {
        const response = JSON.parse(xhr.responseText);

        if(response.success) {
            // customAlert.showAlert("noticia apagada com sucesso", 1)
            window.location.href= `${URLROOT}/admin/painel`;
        } else {
            customAlert.showAlert(response.message, 4);
        }
    });

    const data = new FormData();
    data.append('requestxhr', "toggleactive");
    data.append("id", id);

    xhr.send(data);
}
