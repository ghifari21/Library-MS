function previewImage() {
    const image = document.querySelector("#photo");
    const img_preview = document.querySelector(".img-preview");

    img_preview.style.display = "block";
    img_preview.classList.remove("d-none");

    const of_reader = new FileReader();
    of_reader.readAsDataURL(image.files[0]);

    of_reader.onload = function (oFREvent) {
        img_preview.src = oFREvent.target.result;
    };
}
