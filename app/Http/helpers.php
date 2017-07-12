<?php
/**
 * Created by PhpStorm.
 * User: amrit
 * Date: 6/9/15
 * Time: 5:16 PM
 */

/**
 * Human Readable Filesize
 * @param $bytes
 * @param int $dec
 * @return string
 */
function humanize_filesize($bytes, $dec = 2)
{
    $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    $factor = floor((strlen($bytes) - 1) / 3);

    return sprintf("%.{$dec}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}

/**
 * Is Super User
 * @return bool
 */
function is_super_admin()
{
    $user = auth()->user();

    return $user->type == 'Super Admin';
}

/**
 * Super Echo
 *
 * @author Amrit
 * @param $object
 * @param array $keys
 * @param null $default
 * @return string
 */
function super_echo($object, array $keys,$default = null)
{
    if (is_null($object)) return null;

    foreach ($keys as $key) {
        if (isset($object->$key)) {

            $object = $object->$key;
        } else {
            $object = null;
            break;
        }
    }

    return (is_null($object))?$default:$object;
}

/**
 * Upload file
 *
 * @author Amrit G.C
 * @param $formRequest Request
 * @param $destination destination path where you want to upload file
 * @param $name file form name
 * @return array
 */
function uploadFile($formRequest,$destination,$name)
{
    $file = $formRequest->file($name);

    $destinationPath = public_path($destination);

    $filename = microtime(true).'-'.$file->getClientOriginalName();

    $fileInformation = [];

    $fileInformation['file_type'] = $file->getClientMimeType();

    $fileInformation['file_size'] = $file->getSize();

    $fileInformation['file_name'] = basename($file->getClientOriginalName(),'.'.$file->getClientOriginalExtension());

    $fileInformation['file_path'] = $destination.$filename;

    $file->move($destinationPath,$filename);

    return $fileInformation;

}

