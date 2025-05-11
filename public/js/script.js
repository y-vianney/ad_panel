const dropHandler = (event, fileInput) => {
    event.preventDefault();
    // console.log("File dropped");

    const target = event.target;
    const dt = event.dataTransfer;

    if (dt.items) {
        [...dt.items].forEach((item, i) => {
            if (item.kind === 'file') {
                const file = item.getAsFile();
                const dataTransfer = new DataTransfer();

                dataTransfer.items.add(file);
                document.querySelector(`#${fileInput}`).files = dataTransfer.files;

                target.style.background = "url(" + URL.createObjectURL(file) + ") no-repeat center center";
                target.style.backgroundSize = "50%";
                target.style.filter = "opacity(1)";
                target.classList.add("dropped");
            }
        });
    }
};
