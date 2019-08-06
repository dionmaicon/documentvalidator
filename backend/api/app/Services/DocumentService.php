<?php

namespace App\Services;

use App\Interfaces\DocumentValidation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;
use Symfony\Component\Debug\Exception\ClassNotFoundException;

class DocumentService
{
    public static $TYPES = [
        'CPF'  => 'CPF',
        'CNPJ' => 'CNPJ',
    ];

    public function __construct(DocumentValidation $document, \App\Repositories\DocumentRepositoryInterface $odm)
    {
        $this->document = $document;
        $this->odm = $odm;
    }

    public function showAllDocuments()
    {
        return response()->json($this->odm->showAllDocuments(), Response::HTTP_OK);
    }

    public function showOneDocument($id)
    {
        return response()->json($this->odm->showOneDocument($id), Response::HTTP_OK);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'document'  => 'required|string',
            'type'      => 'required|string',
            'blacklist' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            $this->document = $this->getClass($request);
            $values = $request->all();

            if (!isset($this->document)) {
                return response()->json([
                    'type' => 'Type is invalid. Accept: '. implode("," , self::$TYPES)
                ], Response::HTTP_BAD_REQUEST);
            }

            $this->document->setDocument($values['document']);
            $this->document->setBlackList($values['blacklist']);
            $this->document->setCreatedAt(new \DateTime());

            if (!$this->isValid()) {
                return response()->json(['document' => 'Document is invalid.'], Response::HTTP_BAD_REQUEST);
            }

            if ($this->odm->create($this->document)) {
                return response()->json(['success' => "New Document created with success."], Response::HTTP_CREATED);
            }
            return response()->json(['error' => "Document already exist. Duplicate key."], Response::HTTP_CONFLICT);
        }
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'document'  => 'required|string',
            'type'      => 'required|string',
            'blacklist' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            $this->document = $this->getClass($request);
            $values = $request->all();

            if (!isset($this->document)) {
                return response()->json([
                    'type' => 'Type is invalid. Accept: '. implode("," , self::$TYPES)
                ], Response::HTTP_BAD_REQUEST);
            }

            $this->document->setDocument($values['document']);
            $this->document->setBlackList($values['blacklist']);
            $this->document->setUpdatedAt(new \DateTime());

            if (!$this->isValid()) {
                return response()->json(['document' => 'Document is invalid.'], Response::HTTP_BAD_REQUEST);
            }

            if ($this->odm->update($id, $this->document)) {
                return response()->json(['success' => "Document updated with success."], Response::HTTP_OK);
            }
            return response()->json(['error' => "Document not found."], Response::HTTP_NOT_FOUND);
        }

    }

    public function delete($id)
    {
        if ($this->odm->delete($id)) {
            return response()->json(['success' => "Document deleted with success."], Response::HTTP_OK);
        }
        return response()->json(['error' => "Document already was deleted."], Response::HTTP_NOT_FOUND);
    }

    /**
     * @return Object|null
     */
    public function getClass($request)
    {
        $type = $request->all()['type'];
        $class = "App\\Models\\$type";

        if (in_array($type, self::$TYPES)) {
            return new $class();
        }

        return null;
    }

    /**
     * @return bool
     */
    private function isValid()
    {
        return $this->document->isValid();
    }

}