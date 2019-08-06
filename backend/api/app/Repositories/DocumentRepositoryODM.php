<?php


namespace App\Repositories;

use App\Interfaces\DocumentValidation;
use Doctrine\MongoDB\Query\Query;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Repositories\DocumentRepositoryInterface;
use Nord\Lumen\Doctrine\ODM\MongoDB\Traits\ManagesDocuments;

class DocumentRepositoryODM implements DocumentRepositoryInterface
{
    use ManagesDocuments;

    public function __construct(DocumentValidation $document)
    {
        $this->document = $document;
        $this->repository = $this->getDocumentManager()->getRepository(Document::class);
    }

    public function showAllDocuments()
    {
        $values =  $this->repository->findAll();

        return $values;
    }

    public function showOneDocument($id)
    {
        return $this->repository->find($id);
    }

    public function create(Document $document)
    {
        try {
            $this->getDocumentManager()->persist($document);
            $this->getDocumentManager()->flush();
            return $document->getId();
        } catch (\MongoDuplicateKeyException $exception) {
            return false;
        }
    }

    public function update($id, Document $document)
    {
        $instance = $this->repository->find($id);

        if(isset($instance)) {
            $document->setId($instance->getId());
            $this->getDocumentManager()->persist($document);
            $this->getDocumentManager()->flush();
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $document = $this->repository->find($id);
        if (isset($document)) {
            $this->deleteDocument($document);
            $this->getDocumentManager()->flush();
            return true;
        }
        return false;
    }
}