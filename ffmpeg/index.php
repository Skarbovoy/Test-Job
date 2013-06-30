<?php include_once('File.php') ?>

<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="file">Filename:</label>
    <input type="file" name="file" id="file"><br>
    <input type="submit" name="submit" value="Submit">
</form>

<?php foreach(File::getFileList() as $file): ?>
    <a href="<?php echo dirname(__DIR) . '/upload/video/' . basename($file) ?>" target="_blank"><?php echo basename($file) ?></a>
    <?php if (basename($file) != 'new.mp4'): ?>
        <a href="upload.php?m=watermark&file_name=<?php echo basename($file) ?>">Add Watermark</a><br />
    <?php endif ?>

    <?php if ( file_exists(File::getVideoPath() . 'new.mp4') && basename($file) != 'new.mp4' ): ?>
        <a href="upload.php?m=frame&file_name=new.mp4&frame_nr=55">Frame 55 Photo</a><br />
        <a href="upload.php?m=frame&file_name=new.mp4&frame_nr=155">Frame 332 Photo</a><br />
    <?php endif ?><br />
<?php endforeach ?>




</body>
</html>
