<!DOCTYPE html>
<html>
<head>
    <title>Unggah File JSON</title>
</head>
<body>
    <form action="/upload-json" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="jsonFile">Pilih File JSON:</label>
        <input type="file" name="jsonFile" id="jsonFile" required>
        <button type="submit">Unggah</button>
    </form>
</body>
</html>
