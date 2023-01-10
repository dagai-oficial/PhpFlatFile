# PhpFlatFile
API para trabalhar com FlatFile usando o PHP.

Arquivos Flat são arquivos textos padronizados. 

Por exemplo, vamos imaginar um arquivo para importação/exportação de várias contas. Cada linha, tem 50 linhas e está relacionada com uma pessoa. Em cada linha, começa obrigatoriamente 0 (zero), seguido pelo nome da pessa, data de nascimento e o valor da conta.

Segue uma exemplo de linha desse arquivo:
0NOME 1                 0102202000000000000010000
0NOME 2                 2212202200000000000000100

podemos representar esse arquivo da seguinte forma:

´´´
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<FlatFile>
    <layout>
        <name>Pessoa</name>
        <version>1.0</version>
        <description>Arquivo de exportação/importação de pessoas</description>
    </layout>
    
    <Records>
        <Record name="Pessoa" description="Conta de pessoa." >
            <Fields>
                <IdType name="Codigo"           length="1"  value="0" position="1" />
                <Field  name="Nome"             length="23" />
                <Field  name="DataDeNascimento" length="8"  type="DATE" format="DDMMYYYY" />
                <Field  name="valor"            length="18" format="DD" padding="ZERO_LEFT" />
            </Fields>
        </Record>
    </Records>
</FlatFile>
´´´

# Exemplo de arquivo
