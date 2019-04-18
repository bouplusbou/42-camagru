<h1>Upload file</h1>

<form method="post" action="test_recup_img.php" enctype="multipart/form-data">
     <label for="img">Icône du fichier (PNG uniquement | max. 1 Mo) :</label><br />
     <input type="file" name="img" id="img" /><br />
     <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
     <input type="submit" name="submit" value="Envoyer" />
</form>
