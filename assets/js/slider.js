// CARREGANDO AS NOTICIAS DE EXEMPLO
const url = "https://rapidapi.p.rapidapi.com/api/search/NewsSearchAPI?autoCorrect=false&pageNumber=1&pageSize=20&q=Taylor+Swift&safeSearch=true&withThumbnails=true";
const options = {
	"method": "GET",
	"headers": {
		"x-rapidapi-key": "558406e5f7msha7f77d49d1fd093p19ba96jsnc048720abfdb",
		"x-rapidapi-host": "contextualwebsearch-websearch-v1.p.rapidapi.com"
    }
}

// O ARMAZENAMENTO INTERNO PARA GUARDAR AS NOTICIAS
let newsResult = localStorage.getItem("newsResult");
if(!newsResult) {
    fetch(url, options)
    .then(response => {
        response.json().then(result => {
            const newsResult = result.value;
            localStorage.setItem("newsResult", JSON.stringify(newsResult));
            loadNotices(newsResult)
        })
    })
    .catch(err => {
        console.error(err);
    });
} else {
    newsResult = JSON.parse(newsResult);
    loadNotices(newsResult);
}

// PASSA AS IMAGENS E OS TITULOS PARA AS NOTICIAS
function loadNotices(newsResult) {
    const noticesImgs = document.querySelectorAll("#notices .notice img");
    const noticesTitles = document.querySelectorAll("#notices .notice .title");

    const slideImgs = document.querySelectorAll("#slider-container ul li img");
    const titles = document.querySelectorAll("#slider-container ul li .title");
    
    for (let i = 0; i < slideImgs.length; i++) {
        const img = slideImgs[i];
        const title = titles[i];
        const result = newsResult[i];
        
        img.setAttribute("src", result.image.url);
        img.classList.add("remove-drag-select");
        title.classList.add("remove-drag-select");
        title.innerText = result.title;
    }

    for(let i = 0; i < noticesImgs.length; i++) {
        const result = newsResult[i + 8];
        const img = noticesImgs[i];
        const title = noticesTitles[i];

        img.setAttribute("src", result.image.url);
        title.innerText = result.title;
    }
}

// CLASSE SLIDER
class Slider {
    constructor(ul, slideSize = 485, slideMargin = 30) {
        this.ul = ul; // Lista
        this.lis = this.ul.getElementsByTagName("li"); // Todos os items
        this.slideSize = slideSize + slideMargin; // Tamanho do slide
        this.slideSizeDefault = slideSize + slideMargin; // Tamanho do slide
        this.slideMargin = slideMargin; // Margin

        this.currentSlide = 1;
        this.currentSlideSize = this.currentSlide * this.slideSize;
        this.slideLength = ul.getElementsByTagName("li").length;

        this.ul.style.width = this.slideSize * (this.slideLength + 4) + "px";

        const btnSlide = document.querySelectorAll("#slider-container .btn-slide");
        btnSlide[0].addEventListener("click", () => this.prev());
        btnSlide[1].addEventListener("click", () => this.next());

        this.addAutoAdjustSize();
        if(this.slideLength > 2) {
            this.addBottomMenuController();
            this.addTouchAndDragging();
            this.goTo(1, false);
            this.ul.addEventListener(this.getTransitionEndEventName(), () => this.transitionFinished());
        } else {
            btnSlide[0].style.display = "none";
            btnSlide[1].style.display = "none";
        }
    }

    // Vai para o slide informado
    goTo(slideNumber, animation = true) {
        this.currentSlide = slideNumber;
        if(!animation) {
            this.ul.style.transitionDuration = "0ms";
        } else {
            this.ul.style.transitionDuration = "400ms";
        }
        this.update();
    }

    // Volta um slide
    prev() {
        if(this.currentSlide !== 0) {
            this.ul.style.transitionDuration = "400ms";
            this.currentSlide--;
            this.update();
        }
    }

    // Avança um slide
    next() {
        if(this.currentSlide !== this.slideLength + 1) {
            this.ul.style.transitionDuration = "400ms";
            this.currentSlide++;
            this.update();
        }   
    }

    // Atualiza as informações na tela
    update() {
        this.currentSlideSize = this.slideSize * this.currentSlide;
        this.ul.style.transform = `translate3d(${-this.currentSlideSize}px, 0px, 0px)`;

        const divActived = document.querySelector("#slider-container .slider-controller div.active");
        if(divActived) {
            divActived.className = "";
        }

        if((this.currentSlide > 0) && (this.currentSlide < 9)) {
            const divControllers = document.querySelectorAll("#slider-container .slider-controller div");
            divControllers.item(this.currentSlide - 1).className = "active";
        }
    }

    moveDistance(distance) {
        const moved = this.currentSlideSize - distance;
        const maxValue = this.slideSize * (this.slideLength + 1);
        this.ul.style.transitionDuration = "0ms";
    
        if(moved < 0) {
            this.ul.style.transform = `translate3d(${0}px, 0px, 0px)`;
        } else if(moved > maxValue) {
            this.ul.style.transform = `translate3d(${-maxValue}px, 0px, 0px)`;
        } else {
            this.ul.style.transform = `translate3d(${-moved}px, 0px, 0px)`;
        }
    }

    moveEnd(distance) {
        if(Math.abs(distance) >= this.slideMargin) {
            let slidesMoved = Math.ceil(Math.abs(distance / this.slideSize));

            if(this.currentSlideSize - distance <= 0) {
                this.goTo(this.slideLength, false);
                return;
            } else if(this.currentSlideSize - distance >= (this.slideLength + 1) * this.slideSize) {
                this.goTo(1, false);
                return;
            }

            if(distance > 0) {
                this.goTo(this.currentSlide - slidesMoved);
            } else if (distance < 0) {
                this.goTo(this.currentSlide + slidesMoved);
            }
        } else {
            this.goTo(this.currentSlide);
        }
    }

    addTouchAndDragging() {
        let startCoord, endCoord;
        let isDragging = false;
        let distance;

        // TOUCH
        ul.addEventListener('touchstart', (e) => {
            startCoord = e.targetTouches[0].pageX;
            this.ul.style.transitionDuration = "0ms";
        });

        ul.addEventListener("touchmove", (e) => {
            e.preventDefault();
            endCoord = e.targetTouches[0].pageX;
            distance = endCoord - startCoord;
            this.moveDistance(distance);
        });

        ul.addEventListener("touchend", () => {
            this.moveEnd(distance);
        });

        // MOUSE
        ul.addEventListener("mousedown", (e) => {
            startCoord = e.pageX;
            isDragging = true;
            this.ul.style.transitionDuration = "0ms";
        });

        window.addEventListener("mousemove", (e) => {
            if(isDragging) {
                endCoord = e.pageX;
                distance = endCoord - startCoord;
                this.moveDistance(distance);
            }
        });

        window.addEventListener("mouseup", () => {
            if(isDragging) {
                isDragging = false;
                this.moveEnd(distance);
            }
        });
    }

    // Ajusta a quantidade de clones do elemento inicial e final
    addAutoAdjustSize() {
        const firstChild = ul.firstElementChild;
        const afterFirstChildClone = firstChild.nextElementSibling.cloneNode(true);
        afterFirstChildClone.id = "clone-element";
        const lastChild = ul.lastElementChild;

        this.ul.insertBefore(lastChild.cloneNode(true), firstChild);
        this.ul.appendChild(firstChild.cloneNode(true));

        if(window.innerWidth > 1040) {
            this.ul.appendChild(afterFirstChildClone);
        } 
        
        if(window.innerWidth <= 494) {
            this.slideSize = window.innerWidth + this.slideMargin;
            this.currentSlideSize = this.currentSlide * this.slideSize;
        }

        window.addEventListener("resize", () => {
            this.slideSize = this.slideSizeDefault;

            if(window.innerWidth <= 1040) {
                if(ul.querySelector("#clone-element")) {
                    ul.removeChild(afterFirstChildClone);
                }
            } else {
                if(!ul.querySelector("#clone-element")) {
                    ul.appendChild(afterFirstChildClone);
                }
            }

            if(window.innerWidth <= 494) {
                this.slideSize = window.innerWidth + this.slideMargin;
            }

            this.currentSlideSize = this.currentSlide * this.slideSize;
            this.goTo(this.currentSlide, false);
        });
    }

    // Adiciona um menu para navegar entre os slides
    addBottomMenuController() {
        const sliderController = document.querySelector("#slider-container > .slider-controller");
        for (let i = 0; i < this.slideLength; i++) {
            const div = document.createElement("div");
            div.id = i + 1;
            div.addEventListener("click", (e) => {
                this.goTo(parseInt(e.target.id));
            });
            sliderController.append(div);
        }
    }

    // Chamada quando a animação é finalizada
    transitionFinished() {
        if(this.currentSlide === 0) {
            this.goTo(this.slideLength, false);
        } else if (this.currentSlide === this.slideLength + 1) {
            this.goTo(1, false);
        }
    }

    // Helper: detecta quando o animação esá finalizada, se passada para um event listener
    getTransitionEndEventName() {
        var transitions = {
            "transition"      : "transitionend",
            "OTransition"     : "oTransitionEnd",
            "MozTransition"   : "transitionend",
            "WebkitTransition": "webkitTransitionEnd"
         }
        let bodyStyle = document.body.style;
        for(let transition in transitions) {
            if(bodyStyle[transition] != undefined) {
                return transitions[transition];
            } 
        }
    }
}

// IMPLEMENTAÇÃO DO SLIDER
const ul = document.querySelector("#slider-container ul");
const sliderController = new Slider(ul);