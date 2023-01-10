<?php

use PHPUnit\Framework\TestCase;

use Dagai\PhpFlatFile\Record;
use Dagai\PhpFlatFile\Field;
use Dagai\PhpFlatFile\Layout;
use Dagai\PhpFlatFile\FlatFile;
use Dagai\PhpFlatFile\LayoutReader;

class LayoutReaderTest extends TestCase {

    public function testReadFile1(){
        $this->assertEquals( 
            $this->getLayout() , 
            LayoutReader::readFromFile( "tests/examples/layout_00.xml" ) 
        );
    }

    public function testReadFile2(){
        $flatFile = new FlatFile( "tests/examples/layout_00.xml" );

        $this->assertEquals( 
            $this->getLayout() , 
            $flatFile->layout
        );
    }

    private function getLayout(){
        return new Layout([
            "name" => "Name",
            "version" => "1.0",
            "description" => "Description",
            "records" => [ new Record([
                "name" => "Header",
                "description" => "Registro inicial, abertura do arquivo.",
                "fields" => [
                    new Field( "CodigoRegistro"          ,  1 , null   , null        , null        , 0      ),
                    new Field( "CodigoPortador"          ,  3 , null   , null        , "ZERO_LEFT" , null   ),
                    new Field( "NomePortador"            , 40 , null   , null        , null        , null   ),
                    new Field( "DataMovimento"           ,  8 , "DATE" , "DDMMYYYY"  , null        , null   ),
                    new Field( "CodigoRemetente"         ,  3 , null   , null        , null        , null   ),
                    new Field( "CodigoDestinatario"      ,  3 , null   , null        , null        , null   ),
                    new Field( "CodigoTipo"              ,  3 , null   , null        , null        , null   ),
                    new Field( "NumeroSequencialRemessa" ,  6 , null   , null        , "ZERO_LEFT" , null   ),
                    new Field( "QuantidadeRegistros"     ,  4 , null   , null        , "ZERO_LEFT" , null   ),
                    new Field( "filler"                  ,  4 , null   , null        , "ZERO_LEFT" , "0000" ),
                    new Field( "filler"                  ,  4 , null   , null        , "ZERO_LEFT" , "0000" ),
                    new Field( "filler"                  ,  4 , null   , null        , "ZERO_LEFT" , "0000" ),
                    new Field( "CodigoAgencia"           ,  6 , null   , null        , null        , null   ),
                    new Field( "versaoLayout"            ,  3 , null   , null        , null        , "050"  ),
                    new Field( "CodigoMunicipio"         ,  7 , null   , null        , null        , null   ),
                    new Field( "filler"                  ,497 , null   , null        , null        , null   ),
                    new Field( "NumeroSequencialRegistro" , 4 , null   , null        , "ZERO_LEFT" , "0001" ),
                ],
            ])]
        ]);
    }
    
}