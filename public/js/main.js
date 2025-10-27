
// Animacion del phone-inicio img
const boxes = document.querySelectorAll(".phone-box");
const presentacionImg = document.querySelector(".container-img-inicio");
const divInicio = document.getElementById("top-page");

function animateBoxes(boxes, add = true, i = 0) {
  if (i >= boxes.length) return;

  if (add) {
    boxes[i].classList.add("in-place");
  } else {
    boxes[i].classList.remove("in-place");
  }

  setTimeout(() => animateBoxes(boxes, add, i + 1), 100);
}

let animating = false;

// Esperar a que la animacion de dropDown termine antes de desglozar las cartas
presentacionImg.addEventListener("animationend", (e) => {
  
  if (e.animationName === "dropDownMain") {
    // Inicializar con animaci贸n completa
    animateBoxes(boxes, false);

    
    divInicio.addEventListener("mouseenter", () => {
      if (animating) return;
      animating = true;
      animateBoxes(boxes, false); // Quita la clase
      setTimeout(() => animating = false, boxes.length * 100);
    });

    divInicio.addEventListener("mouseleave", () => {
      if (animating) return;
      animating = true;
      animateBoxes(boxes, true); // Agrega la clase
      setTimeout(() => animating = false, boxes.length * 100);
    });

  }
});