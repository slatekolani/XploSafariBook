<?php

namespace App\Services\Storage\Traits;

use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FileHandler
 * @author Erick Chrysostom <e.chrysostom@nextbyte.co.tz>
 * @package App\Services\Storage\Traits
 */
trait FileHandler {

    /**
     * @description : Inspect if the path exists and make sure that is the sub directory of the base path
     * @param type $path
     * @return type
     * @throws GeneralException
     */
    protected function real($path) {
        $temp = realpath($path);
        if (!$temp) {
            throw new GeneralException('Path does not exist: ' . $path);
        }
        if ($this->base && strlen($this->base)) {
            if (strpos($temp, $this->base) !== 0) {
                throw new GeneralException('Path is not inside base (' . $this->base . '): ' . $temp);
            }
        }
        return $temp;
    }

    /**
     * @description : Create a full path of the subdirectory including the base path.
     * @param type $path
     * @return type
     */
    protected function path($path) {
        $path = str_replace('/', DIRECTORY_SEPARATOR, $path);
        $path = trim($path, DIRECTORY_SEPARATOR);
        $path = $this->real($this->base . DIRECTORY_SEPARATOR . $path);
        return $path;
    }

    /**
     * @description : Remove the base directory part from a long path with subdirectories from the base path.
     * @param type $path
     * @return type
     */
    protected function id($path) {
        $path = $this->real($path);
        $path = substr($path, strlen($this->base));
        $path = str_replace(DIRECTORY_SEPARATOR, '/', $path);
        $path = trim($path, '/');
        return strlen($path) ? $path : '/';
    }

    /**
     * @param $id
     * @param bool $with_root
     * @return array
     */
    public function lst($id, $with_root = false) {
        $dir = $this->path($id);
        $lst = @scandir($dir);

        if (!$lst) {
            return ['success' => false, 'message' => trans('exceptions.backend.storage.list_error', ['dir' => $dir])];
        }
        $res = [];

        foreach ($lst as $item) {

            if ($item == '.' || $item == '..' || $item === null) {
                continue;
            }
            $tmp = preg_match('([^ a-zа-я-_0-9.]+)ui', $item);
            if ($tmp === false || $tmp === 1) {
                continue;
            }

            if (is_dir($dir . DIRECTORY_SEPARATOR . $item)) {

                if (array_key_exists($item, $this->documents)) {
                    /* this check is important to exclude all the document groups which has been excluded during updates ... */
                    $res[] = array('text' => $this->documents[$item], 'children' => true, 'id' => $this->id($dir . DIRECTORY_SEPARATOR . $item), 'icon' => 'folder');
                }
            } else {
                $id = substr($item, 0, strrpos($item, '.'));
                           if (array_key_exists($id, $this->uploadedDocuments)) {
                    /* this check is important to exclude all the documents which has been soft deleted */
                    $res[] = array('text' => $this->uploadedDocuments[$id], 'children' => false, 'id' => $id, 'type' => 'file', 'icon' => 'file file-' . substr($item, strrpos($item, '.') + 1));
                }
            }
        }
        if ($with_root && $this->id($dir) === '/') {
            $res = array(array('text' => "Notification_#: " . $this->notificationReportFolder[basename($this->base)], 'children' => $res, 'id' => '/', 'icon' => 'folder', 'state' => array('opened' => true, 'disabled' => true)));
        }
        return $res;
    }



    /**
     * @param $id
     * @param bool $with_root
     * @return array
     */
    public function lst_general($id, $with_root = false) {
        $dir = $this->path($id);
        $lst = @scandir($dir);
        if (!$lst) {
            return ['success' => false, 'message' => trans('exceptions.backend.storage.list_error', ['dir' => $dir])];
        }
        $res = [];
        foreach ($lst as $item) {
            if ($item == '.' || $item == '..' || $item === null) {
                continue;
            }
            $tmp = preg_match('([^ a-zа-я-_0-9.]+)ui', $item);
            if ($tmp === false || $tmp === 1) {
                continue;
            }
            if (is_dir($dir . DIRECTORY_SEPARATOR . $item)) {
                if (array_key_exists($item, $this->documents)) {
                    /* this check is important to exclude all the document groups which has been excluded during updates ... */
                    $res[] = array('text' => $this->documents[$item], 'children' => true, 'id' => $this->id($dir . DIRECTORY_SEPARATOR . $item), 'icon' => 'folder');
                }
            } else {
                $id = substr($item, 0, strrpos($item, '.'));
                if (array_key_exists($id, $this->uploadedDocuments)) {
                    /* this check is important to exclude all the documents which has been soft deleted */
                    $res[] = array('text' => $this->uploadedDocuments[$id], 'children' => false, 'id' => $id, 'type' => 'file', 'icon' => 'file file-' . substr($item, strrpos($item, '.') + 1));
                }
            }
        }
        if ($with_root && $this->id($dir) === '/') {
            $res = array(array('text' => "ID_#: " . $this->id_no, 'children' => $res, 'id' => '/', 'icon' => 'folder', 'state' => array('opened' => true, 'disabled' => true)));
        }
        return $res;
    }


    public function makeDirectory($path)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }



    public function makeDocumentDirectory(Model $model)
    {
        foreach ($model->documents as $document) {
            $path = $this->base . DIRECTORY_SEPARATOR . $model->id;
            $this->makeDirectory($path);
        }
    }


}
