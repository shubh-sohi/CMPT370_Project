var preview = [];
function previewImages() {

    var preview = document.querySelector('#preview');

    if (this.files) {
        [].forEach.call(this.files, readAndPreview);
    }

    function readAndPreview(file) {

        // Make sure `file.name` matches our extensions criteria
        if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
            return alert(file.name + " is not an image");
        } // else...

        var reader = new FileReader();

        reader.addEventListener("load", function() {
            var image = new Image();
            image.height = 150;
            image.tagName = file.name;
            image.title  = file.name;
            image.src    = this.result;
            preview.appendChild(image);
        });

        reader.readAsDataURL(file);

    }

}

function delImg() {

}

document.querySelector('#job-pictures').addEventListener("change", previewImages);