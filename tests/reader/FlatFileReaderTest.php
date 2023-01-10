<?php

use PHPUnit\Framework\TestCase;

use Dagai\PhpFlatFile\Record;
use Dagai\PhpFlatFile\Field;
use Dagai\PhpFlatFile\Layout;
use Dagai\PhpFlatFile\FlatFile;
use Dagai\PhpFlatFile\LayoutReader;

class FlatFileReaderTest extends TestCase {

    public function testReadFile1(){
        $flatFile = new FlatFile( "tests/examples/layout_00.xml" );
        $result   = $flatFile->read( "tests/examples/layout_00.txt" );

        $this->assertEquals( $this->getResult() , $result );
    }

    public function getResult(){
        return [[
            "CodigoRegistro"           => 0,
            "CodigoPortador"           => "992",
            "NomePortador"             => "PROCURADORIA GERAL DO ESTADO DE PERNAMBU",
            "DataMovimento"            => "2022-08-05",
            "CodigoRemetente"          => "BFO",
            "CodigoDestinatario"       => "SDT",
            "CodigoTipo"               => "TPR",
            "NumeroSequencialRemessa"  => "001027",
            "QuantidadeRegistros"      => "0002",
            "CodigoAgencia"            => "",
            "versaoLayout"             => "043",
            "CodigoMunicipio"          => "2607604",
            "NumeroSequencialRegistro" => "0001"
        ], [
            "CodigoRegistro"           => "0",
            "CodigoPortador"           => "992",
            "NomePortador"             => "PROCURADORIA GERAL DO ESTADO DE PERNAMBU",
            "DataMovimento"            => "2022-08-05",
            "CodigoRemetente"          => "BFO",
            "CodigoDestinatario"       => "SDT",
            "CodigoTipo"               => "TPR",
            "NumeroSequencialRemessa"  => "001028",
            "QuantidadeRegistros"      => "0001",
            "CodigoAgencia"            => "",
            "versaoLayout"             => "043",
            "CodigoMunicipio"          => "2607604",
            "NumeroSequencialRegistro" => "0001"
        ]];
    }
    
}