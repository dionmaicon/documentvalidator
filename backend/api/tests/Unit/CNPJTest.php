<?php


class CNPJTest extends TestCase
{
    public function testInvalidCNPJ(){
        $cnpj = new \App\Models\CNPJ();

        $document = "00.000.000/0000-00";
        $cnpj->setDocument($document);

        $this->assertFalse($cnpj->isValid());
    }

    public function testValidCNPJ(){
        $cnpj = new \App\Models\CNPJ();

        $document = "67.731.529/0001-56";
        $cnpj->setDocument($document);

        $this->assertTrue($cnpj->isValid());

        $document = "35.847.114/0001-56";
        $cnpj->setDocument($document);

        $this->assertTrue($cnpj->isValid());

        $document = "28.423.737/0001-36";
        $cnpj->setDocument($document);

        $this->assertTrue($cnpj->isValid());
        $this->assertEquals("28423737000136", $cnpj->getDocument());

        $document = "28423737000136";
        $cnpj->setDocument($document);

        $this->assertTrue($cnpj->isValid());

        $this->assertEquals("28423737000136", $cnpj->getDocument());
    }

}