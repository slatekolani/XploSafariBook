<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 1/2/19
 * Time: 5:24 PM
 */

namespace App\Services\Storage\Traits\Pdf;


trait PdfUploadingHandler
{

    public function saveDocument($path, $uploadedDocument)
    {

        dd($path." - ".$uploadedDocument);

        if (request()->hasFile($uploadedDocument)) {
            $file = request()->file($uploadedDocument);
            if ($file->isValid()) {
                $uploadedDocument->name = $file->getClientOriginalName();
                $uploadedDocument->size = $file->getSize();
                $uploadedDocument->mime = $file->getMimeType();
                $uploadedDocument->ext = $file->getClientOriginalExtension();
                $uploadedDocument->save();
                $this->makeDocumentDirectory($path);
                $file->move($path , $uploadedDocument->id  . "." . $file->getClientOriginalExtension());
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function makeDirectory($path)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }

    public function makeDocumentDirectory($path)
    {
            $this->makeDirectory($path);
    }


}
