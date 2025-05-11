<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <style>
        body {
            text-align: center;
        }

        .main-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 70vh;
            padding: 40px 20px;
        }
    </style>
</head>

<body>
<h1><a href="index.php" style="color: black">Traffic Signs</a></h1>
<p>Entre le nom du panneau et la description, puis clique sur <strong>Enregistrer</strong> pour sauvegarder.</p>

<div class="main-container">
    <div class="dropzone" ondrop="dropHandler(event, 'fileHandler')" ondragover="event.preventDefault()">
    </div>

    <form class="form file-info" action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="fileHandler" style="display: none;" accept="image/*">

        <div class="form-control" style="width: 100% !important;">
            <label for="name">Nom du panneau</label>
            <input name="name" type="text" required>
        </div>

        <div class="form-control" style="width: 100% !important;">
            <label for="description">Description</label>
            <textarea name="description" rows="3"></textarea>
        </div>

        <button id="exportBtn" type="submit">Enregistrer</button>
    </form>
</div>

<script src="../public/js/script.js">
</script>

<script>
    const form = document.querySelector(".file-info");
    form.addEventListener("submit", (evt) => {
        evt.preventDefault();

        const dropZone = document.querySelector(".dropzone");
        if (!dropZone.classList.contains("dropped"))
            return alert("Veuillez choisir un fichier")

        const formData = new FormData(form);
        console.log(formData);
    });

    const dropZone = document.querySelector(".dropzone");
    dropZone.addEventListener("click", (evt) => {
        evt.preventDefault();

        let fileInput = document.querySelector("#fileHandler");
        fileInput.onchange = () => {
            const file = this.files[0];

            dropZone.style.background = "url(" + URL.createObjectURL(file) + ") no-repeat center center";
            dropZone.style.backgroundSize = "50%";
            dropZone.style.filter = "opacity(1)";
            dropZone.classList.add("dropped");
        }

        fileInput.click();
    })
</script>
</body>
</html>