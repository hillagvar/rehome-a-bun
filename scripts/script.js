let bunnyNames = document.querySelectorAll(".bunny-name");

for (i = 0; i < bunnyNames.length; i++) {
  bunnyNames[i].addEventListener("click", function (event) {
    let bunny = {
      id: event.target.parentElement.attributes["data-id"].value,
      name: event.target.parentElement.attributes["data-name"].value,
      story: event.target.parentElement.attributes["data-story"].value,
      picture: event.target.parentElement.attributes["data-picture"].value,
    };

    let modal = document.querySelector(".modal-wrapper");
    modal.classList.add("active");
    modal.querySelector(".modal-name").innerText = `${bunny.name}`;
    modal.querySelector(".modal-button span").innerText = `${bunny.name}`;
    modal.querySelector(".modal-story").innerText = `${bunny.story}`;
    modal.querySelector(".modal-img").setAttribute("src", `${bunny.picture}`);
    modal
      .querySelector(".modal-link")
      .setAttribute("href", `view.php?id=${bunny.id}`);
  });
}

if (document.querySelector(".modal-wrapper") !== null) {
  document
    .querySelector(".modal-wrapper")
    .addEventListener("click", function (event) {
      event.target.classList.remove("active");
    });
}

let abilities = document.querySelectorAll(".ability");

for (i = 0; i < abilities.length; i++) {
  abilities[i].addEventListener("click", function (event) {
    let ability = {
      ability: event.target.attributes["data-ability"].value,
      description: event.target.attributes["data-description"].value,
    };

    let modal = document.querySelector(".modal-wrapper-ability");
    modal.classList.add("active");
    modal.querySelector(".ability-name").innerText = `${ability.ability}`;
    modal.querySelector(
      ".ability-description"
    ).innerText = `${ability.description}`;
  });
}

if (document.querySelector(".modal-wrapper-ability") !== null) {
  document
    .querySelector(".modal-wrapper-ability")
    .addEventListener("click", function (event) {
      event.target.classList.remove("active");
    });
}

// let slider = document.querySelector(".fluffySlider");
// let output = document.querySelector(".fluffyValue");
// output.innerHTML = slider.value;

// slider.oninput = function() {
//   output.innerHTML = this.value;
// }

if (document.querySelector(".splide") !== null) {
  let splide = new Splide(".splide", {
    perMove: 1,
    gap: "24px",
    pagination: true,
    arrows: true,
    fixedWidth: "200px",
  });

  splide.mount();
}
