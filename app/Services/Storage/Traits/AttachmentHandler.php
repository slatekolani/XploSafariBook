<?php

namespace App\Services\Storage\Traits;

use App\Exceptions\GeneralException;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

trait AttachmentHandler {



    protected function checkExcel($extension) {
        if ($extension == 'xls'|| $extension == 'xlsx') {
            return $extension; // Allowed proceed
        }
        throw new GeneralException("error: " . trans('exceptions.backend.finance.receipt_codes.linked_file_not_allowed'));
    }





    public function saveDocument(Model $model, $document_file_name ,$path,$uploadedDocument)
    {
        if (request()->hasFile($document_file_name)) {
            $file = request()->file($document_file_name);
            if ($file->isValid()) {
                $uploadedDocument->name = $file->getClientOriginalName();
                $uploadedDocument->size = $file->getSize();
                $uploadedDocument->mime = $file->getMimeType();
                $uploadedDocument->ext = $file->getClientOriginalExtension();
                $uploadedDocument->save();
                $this->makeDocumentDirectory($model);
                $file->move($path , $uploadedDocument->id  . "." . $file->getClientOriginalExtension());
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }



    public function saveMultipleDocuments(Model $model, $document_file_name ,$path,$uploadedDocument, $x)
    {
        if (request()->hasFile($document_file_name)) {
            $file = request()->file($document_file_name)[$x];
            if ($file->isValid()) {
                /*$file = request()->file($document_file_name)[$x];*/
                $uploadedDocument->name = $file->getClientOriginalName();
                $uploadedDocument->size = $file->getSize();
                $uploadedDocument->mime = $file->getMimeType();
                $uploadedDocument->ext = $file->getClientOriginalExtension();
                $uploadedDocument->save();
                $this->makeDocumentDirectory($model);
                $file->move($path , $uploadedDocument->id  . "." . $file->getClientOriginalExtension());
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }




    /**
     * @param $linked_file_input
     * @param $file_name
     * @param $base_dir
     * @return bool
     * @throws GeneralException
     * Save to specified path and filename for all type of documents
     */
    public function saveDocumentBasic($linked_file_input, $file_name, $base_dir)
    {
        if (request()->hasFile($linked_file_input)) {
            $file = request()->file($linked_file_input);
            if ($file->isValid()) {
                             $file->move($base_dir, $file_name);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }



    public function deleteDocument($filename){
//        FIlename in full path

        Storage::delete($filename);
    }

    public function deleteDirectory($directory_name){
//        Directory in full path

        Storage::deleteDirectory($directory_name);
    }


    /**
     * @param $path
     * Delete all files on the folder of give path
     */
    public function deleteAllFilesOnFolder($path)
    {
        $folder = $path;
        $files = glob($folder . '/*');
        foreach($files as $file){
            //Make sure that this is a file and not a directory.
            if(is_file($file)){
                //Use the unlink function to delete the file.
                unlink($file);
            }
        }
    }

    /*Get doc extension*/
    public function getDocExtension($file_name_input)
    {
        $file = request()->file($file_name_input);
        if($file->isValid()) {
            return $file->getClientOriginalExtension();
        }else{
            return null;
        }
    }



}
