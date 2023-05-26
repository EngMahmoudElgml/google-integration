<?php


namespace EngMahmoudElgml\GoogleIntegration;


class SpreadSheet extends GoogleConnection
{
    private $fileId;

    public function __construct($fileId)
    {
        parent::__construct();
        $this->fileId = $fileId ;
        $this->service  = new \Google_Service_Sheets($this->client);
    }

    public function updateCells( $sheetName , array $cells ){

        $dataToInsert = array();
        foreach ($cells as $cellName => $value){
            array_push($dataToInsert , array(
                'range' => $sheetName . '!'.$cellName ,
                'values' =>   array(array($value))
            ));
        }
        $body = new \Google_Service_Sheets_BatchUpdateValuesRequest([
            'valueInputOption' => 'USER_ENTERED',
            'data' => $dataToInsert
        ]);

        return $this->service->spreadsheets_values->batchUpdate($this->fileId, $body) ;
    }


    public function override( $sheetName , array $rows){

        $dataToInsert = array();
        array_push($dataToInsert , array(
            'range' => $sheetName . '!A1',
            'values' =>   $rows
        ));

        $body = new \Google_Service_Sheets_BatchUpdateValuesRequest([
            'valueInputOption' => 'USER_ENTERED',
            'data' => $dataToInsert
        ]);

        return $this->service->spreadsheets_values->batchUpdate($this->fileId, $body) ;
    }

    public function list(){
        $list = [];

        $sheets  = $this->service->spreadsheets->get($this->fileId)->getSheets();

        foreach ($sheets as $sheet) {
            $list[$sheet->getProperties()->getSheetId()] = $sheet->getProperties()->getTitle();
        }

        return $list;
    }

    public function read($sheetName , $range  = '' ){

        if (!empty($range))
            $range = '!'.$range;

        return $this->service->spreadsheets_values->get($this->fileId , [$sheetName.$range])->getValues();
    }
}
