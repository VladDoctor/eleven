<?php

namespace application\lib\modules;

interface FileManagerInt
{
    public static function read($filePath, $mode, $text);
    public static function write($filePath, $mode, $text);
    public static function append($filePath, $mode, $text);

    public static function info();
    public static function rename();
    public static function copy();
    public static function unlink();

    public static function mkdir();
    public static function rmdir();
}

final class FileManager implements FileManagerInt
{
    public static function read($filePath, $mode, $text=NULL)
    {
        if( file_exists($filePath) ) {
            if ( (gettype($mode) == true) && ($text != NULL) ):
                FileManager::append($filePath, false, $text);
            endif;

            return file_get_contents($filePath);
        }else{
            return null;
        }
    }

    public static function write($filePath, $mode, $text=NULL)
    {
        if( gettype($mode) == true ){
            switch ($text):
                case NULL:
                    $file = fopen($filePath, 'w+');
                    $fileResult = fread($file);
                    fclose($file);
                    break;
                default:
                    $file = fopen($filePath, 'w+');
                    $fileResult = fread($file);
                    fwrite($filePath, $text);
                    fclose($file);
                    break;
            endswitch;
        }
    }

    public static function append($filePath, $mode, $text=NULL)
    {
        if( is_array($text) ){
            file_put_contents($filePath, json_encode($text));
        }

        if( (gettype($mode) == true ) && !(is_array($text)) ){
            switch ($text):
                case NULL:
                    $file = fopen($filePath, 'a+');
                    //$fileResult = fread($file);
                    fclose($file);
                    break;
                default:
                    $file = fopen($filePath, 'a+');
                    //$fileResult = fread($file);
                    fwrite($filePath, $text);
                    fclose($file);
                    break;
            endswitch;
        }else{
            $file = fopen($filePath, 'a');
            fwrite($file, $text);
            fclose($file);
        }
    }

    public static function info()
    {
        // TODO: Implement info() method.
    }

    public static function rename()
    {
        // TODO: Implement rename() method.
    }

    public static function copy()
    {
        // TODO: Implement copy() method.
    }

    public static function unlink()
    {
        // TODO: Implement unlink() method.
    }

    public static function mkdir()
    {
        // TODO: Implement mkdir() method.
    }

    public static function rmdir()
    {
        // TODO: Implement rmdir() method.
    }
}

?>