<!DOCTYPE html>
<html>

<body>

    <form action="/testing_save" method="post" enctype="multipart/form-data">
        @csrf
        Select image to upload:<br>
        <input type="file" name="foto" id="foto"><br><br>
        <input type="submit" value="Upload Image" name="submit">
    </form>

</body>

</html>
