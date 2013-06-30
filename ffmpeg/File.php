<?php
include_once('functions.php');

class File
{

    private static $_fileList = array();
    private static $_ffmpeg = "/usr/bin/ffmpeg"; //ffmpeg Installed path
    private $_uploadDir = '/upload/';
    private static $_videoDir = '/upload/video/';

    public static function uploadFile()
    {
//        debugvar($_FILES['fileName']);
    }

    public static function getFileList()
    {
        if (empty(self::$_fileList))
        {
            self::$_fileList = glob(self::getVideoPath() . '*.mp4');
        }

        return self::$_fileList;
    }

    public static function addWatermark($inputName, $outputName)
    {
        $inputName = self::getVideoPath() . $inputName;
        $outputName = self::getVideoPath() . $outputName;
        $pngPath = self::getVideoPath() . 'watermarklogo.png';

        if ( file_exists($inputName) && file_exists($pngPath) )
        {
            $output = shell_exec(self::$_ffmpeg .' -i ' . $inputName . ' -vf "movie='. $pngPath. ' [watermark]; [in][watermark] overlay=main_w-overlay_w-0:0 [out]" ' . $outputName);
            debugvar($output);
//            shell_exec('killall ffmpeg');
            header('Location: index.php');
        }
    }

    public static function getFramePhoto($fileName, $frame)
    {
        if ( file_exists(self::getVideoPath() . $fileName) )
        {
            $inputName = self::getVideoPath() . $fileName;
            $output = shell_exec(self::$_ffmpeg . ' -i ' . $inputName . ' -an -ss ' . $frame . ' -vframes 1 -s 960x540 -y -f mjpeg ' . self::getVideoPath() . 'frame-' . $frame . '.jpg');
            debugvar($output);
            header('Location: index.php');
        }
//        shell_exec('killall ffmpeg');

    }

    public static function getVideoPath()
    {
        return realpath(dirname(__FILE__)) . self::$_videoDir;
    }
}

?>