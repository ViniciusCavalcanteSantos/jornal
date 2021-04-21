class CustomPopup {
    constructor(customPopup) {
        this.customPopup = customPopup;
        this.customPopup.className = "popup-container";

        // Adiciona todos os elementos necessários
        const popup = document.createElement("div");
        popup.className = "popup";

        const p = document.createElement("p");
        p.textContent = "Deseja realmente selecionar este título, não sera possivel mudar depois";

        const resolveButton = document.createElement("button");
        resolveButton.textContent = "Selecionar título";
        resolveButton.addEventListener("click", () => {
            createNotice();
        });

        const rejectButton = document.createElement("button");
        rejectButton.textContent = "Cancelar";
        rejectButton.addEventListener("click", () => {
            this.closePopup();
        });

        popup.append(p);
        popup.append(resolveButton);
        popup.append(rejectButton);

        this.customPopup.append(popup);

    }

    openPopup() {
        this.customPopup.classList.add("active");
    }

    closePopup() {
        this.customPopup.classList.remove("active");
    }
}
