<?php

namespace Hydrators;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\Hydrator\HydratorInterface;
use Doctrine\ODM\MongoDB\Query\Query;
use Doctrine\ODM\MongoDB\UnitOfWork;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadataInfo;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ODM. DO NOT EDIT THIS FILE.
 */
class AppModelsCPFHydrator implements HydratorInterface
{
    private $dm;
    private $unitOfWork;
    private $class;

    public function __construct(DocumentManager $dm, UnitOfWork $uow, ClassMetadata $class)
    {
        $this->dm = $dm;
        $this->unitOfWork = $uow;
        $this->class = $class;
    }

    public function hydrate($document, $data, array $hints = array())
    {
        $hydratedData = array();

        /** @Field(type="id") */
        if (isset($data['_id']) || (! empty($this->class->fieldMappings['id']['nullable']) && array_key_exists('_id', $data))) {
            $value = $data['_id'];
            if ($value !== null) {
                $typeIdentifier = $this->class->fieldMappings['id']['type'];
                $return = $value instanceof \MongoId ? (string) $value : $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['id']->setValue($document, $return);
            $hydratedData['id'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['document']) || (! empty($this->class->fieldMappings['document']['nullable']) && array_key_exists('document', $data))) {
            $value = $data['document'];
            if ($value !== null) {
                $typeIdentifier = $this->class->fieldMappings['document']['type'];
                $return = (string) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['document']->setValue($document, $return);
            $hydratedData['document'] = $return;
        }

        /** @Field(type="boolean") */
        if (isset($data['blacklist']) || (! empty($this->class->fieldMappings['blacklist']['nullable']) && array_key_exists('blacklist', $data))) {
            $value = $data['blacklist'];
            if ($value !== null) {
                $typeIdentifier = $this->class->fieldMappings['blacklist']['type'];
                $return = (bool) $value;
            } else {
                $return = null;
            }
            $this->class->reflFields['blacklist']->setValue($document, $return);
            $hydratedData['blacklist'] = $return;
        }

        /** @Field(type="date") */
        if (isset($data['createdAt'])) {
            $value = $data['createdAt'];
            if ($value === null) { $return = null; } else { $return = \Doctrine\ODM\MongoDB\Types\DateType::getDateTime($value); }
            $this->class->reflFields['createdAt']->setValue($document, clone $return);
            $hydratedData['createdAt'] = $return;
        }

        /** @Field(type="date") */
        if (isset($data['updatedAt'])) {
            $value = $data['updatedAt'];
            if ($value === null) { $return = null; } else { $return = \Doctrine\ODM\MongoDB\Types\DateType::getDateTime($value); }
            $this->class->reflFields['updatedAt']->setValue($document, clone $return);
            $hydratedData['updatedAt'] = $return;
        }
        return $hydratedData;
    }
}