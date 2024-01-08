import Dropzone from "dropzone";
import Swal from "sweetalert2";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "",
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    maxFiles: 1,
    uploadMultiple: false,

    init: function () {
        if (document.querySelector('[name="image"]').value.trim()) {
            const deliveredImage = {};
            deliveredImage.size = 123;
            deliveredImage.name =
                document.querySelector('[name="image"]').value;

            this.options.addedfile.call(this, deliveredImage);
            this.options.thumbnail.call(
                this,
                deliveredImage,
                `/uploads/${deliveredImage.name}`
            );
            deliveredImage.previewElement.classList.add(
                "dz-success",
                "dz-complete"
            );
        }
    },
});

dropzone.on("success", function (file, response) {
    console.log(response.image);
    document.querySelector('[name="image"]').value = response.image;
});

dropzone.removeFile("removedFile"),
    function () {
        document.querySelector('[name="image"]').value = "";
    };

//script para generar un mensaje de salida 
document.addEventListener("DOMContentLoaded", (event) => {
    if (window.successMessage) {
        Swal.fire({
            icon: "success",
            title: "Success",
            text: window.successMessage,
            timer: 3000,
            timerProgressBar: true,
            toast: true,
            position: "top-end",
            showConfirmButton: false,
        });
    }
});
