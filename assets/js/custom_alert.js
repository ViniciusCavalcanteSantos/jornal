class CustomAlert {
    constructor(customAlert) {
        this.customAlert = customAlert;

        this.customAlert.className = "alert hide";

        // Adiciona todos os elementos necessários
        const spanSimbol = document.createElement("span");
        spanSimbol.className = "fas fa-exclamation-circle symbol";

        const spanMsg = document.createElement("span");
        spanMsg.className = "msg";

        const spanCloseContainer = document.createElement("span");
        spanCloseContainer.className = "close-btn";
        spanCloseContainer.addEventListener("click", () => {
            this.hideAlert();
        });

        const spanCloseSymbol = document.createElement("span");
        spanCloseSymbol.className = "fas fa-times";
        spanCloseContainer.append(spanCloseSymbol);


        this.customAlert.append(spanSimbol);
        this.customAlert.append(spanMsg);
        this.customAlert.append(spanCloseContainer);

    }

    showAlert(msg, level = 1) {
        this.customAlert.className = "alert";
        switch(level) {
            case 1:
                this.customAlert.classList.add("success")
                this.customAlert.querySelector(".fas").className = "fas fa-check-circle symbol";
                break
            case 2:
                this.customAlert.classList.add("info")
                this.customAlert.querySelector(".fas").className = "fas fa-check-circle symbol";
                break
            case 3:
                this.customAlert.classList.add("warning")
                this.customAlert.querySelector(".fas").className = "fas fa-exclamation-circle symbol";
                break
            case 4:
                this.customAlert.classList.add("error")
                this.customAlert.querySelector(".fas").className = "fas fa-exclamation-circle symbol";
                break
        }
        this.customAlert.querySelector(".msg").textContent = msg;
        this.customAlert.classList.remove("hide");
        this.customAlert.classList.add("show");
        this.customAlert.classList.add("showAlert");
    }

    hideAlert() {
        this.customAlert.classList.remove("show");
        this.customAlert.classList.add("hide");
    }
}