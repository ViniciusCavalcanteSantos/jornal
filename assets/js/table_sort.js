/**
 * Ordena uma tabela HTML
 * 
 * @param {HTMLTableElement} table Ordena a table
 * @param {number} column Coluna a ser ordena
 * @param {boolean} asc Define se a ordenação será ascendente
 * @param {boolean} isDate Define se a coluna é do tipo data
 */
 function sortTableByColumn(table, column, asc = true, isDate = false) {
    const dirModifier = asc ? 1 : -1;
    const tBody = table.tBodies[0];
    const rows = Array.from(tBody.querySelectorAll("tr"));

    // Ordena cada linha
    const sortedRows = rows.sort((a, b) => {
        const aColText = a.querySelector(`td:nth-child(${column + 1})`).textContent.trim();
        const bColText = b.querySelector(`td:nth-child(${column + 1})`).textContent.trim();
        
        if(!isDate) {
            return aColText > bColText ? (1 * dirModifier) : (-1 * dirModifier);
        } else {
            return (new Date(formatDate(aColText)).valueOf() - new Date(formatDate(bColText)).valueOf()) * dirModifier;
        }
    });

    // Limpa a tabela
    while(tBody.firstChild) {
        tBody.removeChild(tBody.firstChild);
    }

    // Adiciona novamente os items agora ordenados
    tBody.append(...sortedRows);

    // Salva como a tabela esta atualmente ordenada
    table.querySelectorAll("th").forEach(th => th.classList.remove("th-sort-asc", "th-sort-desc"));
    table.querySelector(`th:nth-child(${column + 1})`).classList.toggle("th-sort-asc", asc);
    table.querySelector(`th:nth-child(${column + 1})`).classList.toggle("th-sort-desc", !asc);
}

document.querySelectorAll(".table-sortable th").forEach(headerCell => {
    if(headerCell.dataset.sort) {
        headerCell.addEventListener("click", () => {
            const tableElement = headerCell.parentElement.parentElement.parentElement;
            const headerIndex = Array.prototype.indexOf.call(headerCell.parentElement.children, headerCell);
            const currentIsAscending = headerCell.classList.contains("th-sort-asc");
            sortTableByColumn(tableElement, headerIndex, !currentIsAscending, headerCell.dataset.date);
        });
    }
});

function formatDate(date) {
    const dateTime = date.trim().split(" "); // Separa a data do tempo
    const dateArray = dateTime[0].split("/"); // Divide a data
    return `${dateArray[1]}/${dateArray[0]}/${dateArray[2]} ${dateTime[1]}`;
    
}

document.querySelector(".table-sortable th").click();