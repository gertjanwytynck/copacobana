<?php

namespace Backend\Modules\Festival\Actions;

use Backend\Core\Engine\Base\ActionIndex;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Model as FrontendModel;
use Backend\Modules\Festival\Engine\Model as BackendFestivalModel;

/**
 * This is the print-action, it will print the overview of all artists.
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class PrintArtists extends ActionIndex
{
    /**
     * Execute the action
     */
    public function execute()
    {
        parent::execute();

        $this->generateExcel();
    }

    /**
     * Generate excel file for the artists
     *
     */
    public static function generateExcel()
    {
        $phpExcelObject = FrontendModel::get('phpexcel')->createPHPExcelObject();

        // Set document properties
        $phpExcelObject->getProperties()->setCreator("Copacobana")
            ->setLastModifiedBy("Copacobana")
            ->setTitle('Artiesten')
            ->setSubject('Artiesten overzicht');

        // get active sheet
        $sheet = $phpExcelObject->setActiveSheetIndex(0);

        // rename sheet
        $sheet->setTitle('Artiesten');

        // generate header
        $sheet
            ->setCellValue('A1', 'Artiest')
            ->setCellValue('B1', 'Dag')
            ->setCellValue('C1', 'Locatie')
            ->setCellValue('D1', 'Contactpersoon')
            ->setCellValue('E1', 'Contact Gsm')
            ->setCellValue('F1', 'Contact Email')
            ->setCellValue('G1', 'Opmerking')
            ->setCellValue('H1', 'Onstage')
            ->setCellValue('I1', 'Backstage')
            ->setCellValue('J1', 'Aantal wagens')
            ->setCellValue('K1', 'Vleesmaaltijd')
            ->setCellValue('L1', 'Vegetarische maaltijd')
            ->setCellValue('M1', 'Geluidstechnieker')
            ->setCellValue('N1', 'Contract')
            ->setCellValue('O1', 'Technisch');

        // format header
        $sheet->getStyle('A1:O1')->applyFromArray(
            array(
                'fill' => array(
                    'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => '94c11a')
                ),
                'font'  => array(
                    'color' => array('rgb' => 'FFFFFF')
                ),
                'alignment' => array(
                    'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                ),
                'borders' => array(
                    'bottom' => array(
                        'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    )
                )
            )
        );

        // export students
        $em = FrontendModel::get('doctrine.orm.entity_manager');
        $artistRepo = $em->getRepository(BackendFestivalModel::ARTIST_ENTITY_CLASS);
        $artists = $artistRepo->getAll();

        $totalHot = 0;
        $totalVeggie = 0;
        setlocale(LC_TIME, 'nl' .'_' . strtoupper('nl'));

        if ($artists != null) {
            foreach ($artists as $i => $artist) {
                $practical = $artist->getPractical();
                foreach ( $practical as $practic) {
                    $soundEngineer =$practic->getSoundEngineer() ? 'Ja' : 'Nee';
                    $techFile =$practic->getTechnicalFilename() != '' ? 'Ja' : 'Nee';
                    $contractFile =$practic->getContractFilename() ? 'Ja' : 'Nee';

                    // get backstage artist
                    if ( $practic->getBackstage() ) {
                        $arrBackstage = '';
                        foreach ($practic->getBackstage() as $key=>$backstage) {
                            $arrBackstage .= $backstage->getName() . ' - ';
                        }
                    }

                    // get onstage artist
                    if ( $practic->getOnstage() ) {
                        $arrOnstage = '';
                        foreach ($practic->getOnstage() as $key=>$onstage) {
                            $arrOnstage .= $onstage->getName() . ' - ';
                        }
                    }

                    $i = $i+2;
                    $sheet->setCellValue('A' . $i, html_entity_decode($artist->getName()));
                    $sheet->setCellValue('B' . $i, html_entity_decode(strftime("%A", $artist->getStartOn()->getTimestamp()) . ' om ' . strftime("%H:%M", $artist->getStartOn()->getTimestamp()) . ' uur'));
                    $sheet->setCellValue('C' . $i, html_entity_decode($artist->getStage()->getStageName()));
                    $sheet->setCellValue('D' . $i, html_entity_decode($practic->getContactFirstName() . ' ' . $practic->getContactName()));
                    $sheet->setCellValue('E' . $i, html_entity_decode($practic->getContactPhone()));
                    $sheet->setCellValue('F' . $i , html_entity_decode($practic->getContactEmail()));
                    $sheet->setCellValue('G' . $i , html_entity_decode($practic->getRemark()));
                    $sheet->setCellValue('H' . $i , html_entity_decode($arrBackstage));
                    $sheet->setCellValue('I' . $i , html_entity_decode($arrOnstage));
                    $sheet->setCellValue('J' . $i , html_entity_decode($practic->getTotalCars()));
                    $sheet->setCellValue('K' . $i, html_entity_decode($practic->getHotMeal()));
                    $sheet->setCellValue('L' . $i, html_entity_decode($practic->getVeggieMeal()));
                    $sheet->setCellValue('M' . $i, html_entity_decode($soundEngineer));
                    $sheet->setCellValue('N' . $i, html_entity_decode($techFile));
                    $sheet->setCellValue('O' . $i, html_entity_decode($contractFile));


                    $totalHot += $practic->getHotMeal();
                    $totalVeggie += $practic->getVeggieMeal();
                }

            }
        }

        // generate header
        $i = $i+3;
        $sheet
            ->setCellValue('A' . $i, 'Totalen')
            ->setCellValue('G' . $i, $totalHot)
            ->setCellValue('H' . $i, $totalVeggie);


    /*    // create new lines
        for ($i = (2 + count($artists)); $i < ($count + count($artists) + 2); $i++) {
            $sheet->setCellValue('A' . $i, self::getSodaCode());
        }*/

        // auto-size columns
        foreach(range('A','L') as $columnID) {
            $phpExcelObject->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
        }

        // set headers
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="artiesten.xls"');
        header('Cache-Control: max-age=1');
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
        header ('Cache-Control: cache, must-revalidate');
        header ('Pragma: public');

        // send excel
        $objWriter = \PHPExcel_IOFactory::createWriter($phpExcelObject, 'Excel5');
        $objWriter->save('php://output');
        exit();
    }


}
