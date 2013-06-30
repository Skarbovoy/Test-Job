<?php

ini_set('upload_max_filesize', '200M');
ini_set('post_max_size', '200M');

include_once('functions.php');
include_once('File.php');
?>

<?php if (empty($_GET['m'])): ?>

<?php if ($_FILES['file']['type'] != 'video/mp4'): ?>
    Bad file format
<?php elseif ($_FILES['file']['size'] > '209715200'): ?>
    Bad file size
<?php else: ?>
    <?php  move_uploaded_file($_FILES["file"]["tmp_name"], File::getVideoPath() . $_FILES["file"]["name"]); ?>
    Stored in: <?php echo File::getVideoPath() . $_FILES["file"]["name"]; ?>
    <?php header('Location: index.php') ?>
<?php endif ?>

<?php endif ?>

<?php if ($_GET['m'] == 'watermark' && $_GET['file_name']): ?>
    <?php if ( !file_exists(File::getVideoPath() . 'new.mp4') ): ?>
        <?php File::addWatermark($_GET['file_name'], 'new.mp4'); ?>
    <?php endif ?>
<?php endif ?>

<?php if ($_GET['m'] == 'frame' && $_GET['file_name'] && (int)($_GET['frame_nr'])): ?>
<!--    --><?php //debugvar(File::getVideoPath() . 'new.mp4') ?>
    <?php if ( file_exists(File::getVideoPath() . 'new.mp4') ): ?>
        <?php File::getFramePhoto($_GET['file_name'], $_GET['frame_nr']) ?>
    <?php endif ?>

<?php endif ?>