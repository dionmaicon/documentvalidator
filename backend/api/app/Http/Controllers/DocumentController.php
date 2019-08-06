<?php

namespace App\Http\Controllers;

use App\Services\DocumentService;
use Illuminate\Http\Request;


class DocumentController extends Controller
{
    private $documentService;

    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    public function showAllDocuments()
    {
        return $this->documentService->showAllDocuments();
    }

    public function showOneDocument($id)
    {
        return $this->documentService->showOneDocument($id);
    }
    
    public function create(Request $request)
    {
     return $this->documentService->create($request);
    }

    public function update($id, Request $request)
    {
        return $this->documentService->update($id, $request);
    }

    public function delete($id)
    {
        return $this->documentService->delete($id);
    }

}
