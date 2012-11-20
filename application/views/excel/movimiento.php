<?php
ini_set('memory_limit', '512M');
error_reporting(E_ALL);
/** PHPExcel */
require_once 'Classes/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set properties
$objPHPExcel->getProperties()->setCreator("IVAN ZUÑIGA PEREZ")
							 ->setLastModifiedBy("IVAN ZUÑIGA PEREZ")
							 ->setTitle("Movimiento")
							 ->setSubject("Movimiento")
							 ->setDescription("Movimiento")
							 ->setKeywords("Movimiento")
							 ->setCategory("Movimiento");



$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C1', 'Movimiento '.strtoupper($row->movimiento))
            ->setCellValue('D1', 'ID:')
            ->setCellValue('E1', $row->id)
            ;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Sucursal y/o Proveedor a: '.$row->sucursal.' '.$row->proveedor)
            ;
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:G2');

$ini=4;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'Clave')
            ->setCellValue('B'.$ini, 'Descripcion')
            ->setCellValue('C'.$ini, 'Unidad')
            ->setCellValue('D'.$ini, 'Lote')
            ->setCellValue('E'.$ini, 'Caducidad')
            ->setCellValue('F'.$ini, 'Cantidad')
;            

$num = 5;
//serie, folio, rec_rfc, rec_razon, subtotal, estatus
foreach ($query as $row1)
{
			

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, $row1->clave)
            ->setCellValue('B'.$num, $row1->descripcion)
            ->setCellValue('C'.$num, $row1->unidad)
            ->setCellValue('D'.$num, $row1->lote)
            ->setCellValue('E'.$num, $row1->caducidad)
            ->setCellValue('F'.$num, $row1->piezas)

;

            $num++;

}
        $num2 = $num - 1;
$objPHPExcel->getActiveSheet()->setCellValue('F'.$num,'=SUM(F5:F'.$num2.')');

        $num3 = $num + 2;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C'.$num3, date('Y-m-d H:s:i'))
            ;


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Movimiento '.$row->id);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="movimiento_'.$row->id.'_'.date('YmsHsi').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;