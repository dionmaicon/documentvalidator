<?php


class CPFTest extends TestCase
{
    public function testInvalidCPF(){
        $cpf = new \App\Models\CPF();

        $document = "001.030.000-00";
        $cpf->setDocument($document);

        $this->assertFalse($cpf->isValid());
    }

    public function testValidCPF(){
        $cpf = new \App\Models\CPF();

        $document = "008.335.910-96";
        $cpf->setDocument($document);
        $this->assertTrue($cpf->isValid());

        $document = "008.335.910-96";
        $cpf->setDocument($document);
        $this->assertTrue($cpf->isValid());

        $document = "00833591096";
        $cpf->setDocument($document);
        $this->assertTrue($cpf->isValid());
    }

}