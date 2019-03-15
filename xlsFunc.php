<?php

require_once(dirname(__FILE__) . '/xlsClasses/PHPExcel.php');

function exportMini($title, $cells, $creator = 'Alexander Eberle')
{
    $props['creator'] = $creator;
    $props['lastModifiedBy'] = $creator;
    $props['title'] = $title;
    $props['subject'] = $title;
    $props['description'] = $title;
    $props['keywords'] = $title;
    $props['category'] = 'Default';
    exportXLS($props, $cells);
}

function exportXLS($props, $sheets)
{
    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();
    
    // Set document properties
    $objPHPExcel->getProperties()->setCreator($props['creator'])
                                 ->setLastModifiedBy($props['lastModifiedBy'])
                                 ->setTitle($props['title'])
                                 ->setSubject($props['subject'])
                                 ->setDescription($props['description'])
                                 ->setKeywords($props['keywords'])
                                 ->setCategory($props['category']);
    
    
    // Add some data
    foreach($sheets as $key => $data)
    {
        if($key > 0) $objPHPExcel->createSheet();
        $cells = $data['cells'];
        $sheetObj = $objPHPExcel->setActiveSheetIndex($key);
        foreach($cells as $cellKey => $cellVal)
        {
            $sheetObj->setCellValue($cellKey, $cellVal);
        }
        $sheetObj->setTitle(substr($data['title'],0,30));
    }
    $objPHPExcel->setActiveSheetIndex(0);
    
    // Redirect output to a client’s web browser (Excel5)
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$props['title'].'.xls"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');
    
    // If you're serving to IE over SSL, then the following may be needed
    header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header ('Pragma: public'); // HTTP/1.0
    
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    exit;
}