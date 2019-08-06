<?php
namespace App\Repositories;

use App\Models\Document;

interface DocumentRepositoryInterface
{
    public function showAllDocuments();

    public function showOneDocument($id);

    public function create(Document $document);

    public function update($id, Document $document);

    public function delete($id);

}