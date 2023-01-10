<?php

use PHPUnit\Framework\TestCase;

use Dagai\PhpFlatFile\Record;
use Dagai\PhpFlatFile\Field;
use Dagai\PhpFlatFile\FieldFormat;

class RecordWriterTest extends TestCase {
    
    public const LINE = "902012020OK  0102";

    public $result = [
        "data"    => "2020-01-02",
        "texto"   => "OK",
        "decimal" => 1.02,
    ];

    public function testReturnData(){
        $this->record = new Record([
            "id" => 9,
            "name" => "RecordTest" ,
            "description" => "Teste de leitura do Record",
            "fields" => [
                new Field( "id"       , 1 , null   , null       , null      ,   9 ),
                new Field( "data"     , 8 , "DATE" , "DDMMYYYY" ),
                new Field( "texto"    , 4 ),
                new Field( "decimal"  , 4 , "DECIMAL" , "DD" , "ZERO_LEFT" , null ),
            ]
        ]);

        $this->assertEquals( RecordReaderTest::LINE , $this->record->write( $this->result ) );
    }

}