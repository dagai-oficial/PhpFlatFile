<?php

use PHPUnit\Framework\TestCase;

use Dagai\PhpFlatFile\Record;
use Dagai\PhpFlatFile\Field;
use Dagai\PhpFlatFile\FieldFormat;

class RecordReaderTest extends TestCase {
    
    public const LINE = "902012020OK  0102";

    public $result = [
        "id"      => 9,
        "data"    => "2020-01-02",
        "texto"   => "OK",
        "decimal" => 1.02,
    ];

    public function testReturnData(){
        $this->record = new Record([
            "name" => "RecordTest" ,
            "description" => "Teste de leitura do Record",
            "fields" => [
                new Field( "id"       , 1 , null   , null       , 9 ),
                new Field( "data"     , 8 , "DATE" , "DDMMYYYY" ),
                new Field( "texto"    , 4 ),
                new Field( "decimal"  , 4 , "DECIMAL" , "DD" ),
            ]
        ]);

        $this->assertEquals( $this->result , $this->record->read( RecordReaderTest::LINE ) );
    }

    public function testReturnIs(){
        $this->record = new Record([
            "name" => "RecordTest" ,
            "description" => "Teste de leitura do Record",
            "fields" => [
                new Field( "id"       , 1 , null   , null       , 9 ),
                new Field( "data"     , 8 , "DATE" , "DDMMYYYY" ),
                new Field( "texto"    , 4 ),
                new Field( "decimal"  , 4 , "DECIMAL" , "DD" ),
            ]
        ]);

        $this->assertEquals( true , $this->record->is( RecordReaderTest::LINE ) );
    }

}