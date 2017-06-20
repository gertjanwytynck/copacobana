<?php

namespace Backend\Modules\Festival\Actions;

use Common\Uri as CommonUri;


use Backend\Core\Engine\Base\ActionIndex;
use Backend\Core\Engine\Language;
use Backend\Core\Engine\Model;
use Backend\Modules\Festival\Engine\Model as BackendFestivalModel;
/**
 * This is the add-action, it will display a form to add a new artist.
 *
 * @author Gertjan Wytynck <gertjan.wytynck@gmail.com>
 */
class PrintArtists extends ActionIndex
{

    /** @var array dates */
    private $arrDates = array();

    /** @var array backstage */
    private $arrBackstage = array();

    /** @var array car */
    private $arrCar = array('','','');

    /**
     * Execute the action.
     */
    public function execute()
    {
        parent::execute();

        $this->export();

    }

    /**
     * Parse the form
     */
    protected function export()
    {
        $phpExcelObject = Model::get('phpexcel')->createPHPExcelObject();

        // Set document properties
        $phpExcelObject->getProperties()->setCreator("Copacobana")
            ->setLastModifiedBy("Copacobana")
            ->setTitle('Artiesten')
            ->setSubject('Artiesten overzicht');

        // get active sheet
        $sheet = $phpExcelObject->setActiveSheetIndex(0);

        // Create a new worksheet, after the default sheet
        $phpExcelObject->createSheet();
        $sheet2 = $phpExcelObject->setActiveSheetIndex(1);

        // Create a new worksheet, after the default sheet
        $phpExcelObject->createSheet();
        $sheet3 = $phpExcelObject->setActiveSheetIndex(2);

        // rename sheet
        $sheet->setTitle('Artiesten');
        $sheet2->setTitle('Crew');
        $sheet3->setTitle('Nummerplaten');

        // generate header
        $sheet
            ->setCellValue('A1', 'Artiest')
            ->setCellValue('B1', 'Dag')
            ->setCellValue('C1', 'Locatie')
            ->setCellValue('D1', 'Contactpersoon')
            ->setCellValue('E1', 'Contact Gsm')
            ->setCellValue('F1', 'Contact Email')
            ->setCellValue('G1', 'Opmerking')
            ->setCellValue('H1', 'Aantal personen opgegeven')
            ->setCellValue('I1', 'Vleesmaaltijd')
            ->setCellValue('J1', 'Vegetarische maaltijd')
            ->setCellValue('K1', 'Vegan maaltijd')
            ->setCellValue('L1', 'Technical file')
            ->setCellValue('M1', 'Contract file')
            ->setCellValue('N1', 'Stage file')
            ->setCellValue('O1', 'Extra file')
            ->setCellValue('P1', 'Nummerplaat 1')
            ->setCellValue('Q1', 'Nummerplaat 2')
            ->setCellValue('R1', 'Nummerplaat 3');

        $sheet2
            ->setCellValue('A1', 'Artiest')
            ->setCellValue('B1', 'Naam')
            ->setCellValue('C1', 'Functie');

        $sheet3
            ->setCellValue('A1', 'Artiest')
            ->setCellValue('B1', 'Nummerplaat');


        // format header
        $sheet->getStyle('A1:R1')->applyFromArray(
            array(
                'fill' => array(
                    'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => '94c11a')
                ),
                'font'  => array(
                    'color' => array('rgb' => 'FFFFFF')
                ),
                'borders' => array(
                    'bottom' => array(
                        'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    )
                )
            )
        );

        // format header
        $sheet2->getStyle('A1:C1')->applyFromArray(
            array(
                'fill' => array(
                    'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => '94c11a')
                ),
                'font'  => array(
                    'color' => array('rgb' => 'FFFFFF')
                ),
                'borders' => array(
                    'bottom' => array(
                        'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    )
                )
            )
        );

        // format header
        $sheet3->getStyle('A1:B1')->applyFromArray(
            array(
                'fill' => array(
                    'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => '94c11a')
                ),
                'font'  => array(
                    'color' => array('rgb' => 'FFFFFF')
                ),
                'borders' => array(
                    'bottom' => array(
                        'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    )
                )
            )
        );

        $em = Model::get('doctrine.orm.entity_manager');
        $artists = $em->getRepository(BackendFestivalModel::ARTIST_ENTITY_CLASS)->getExport($em);

        $totalHot = 0;
        $totalVeggie = 0;
        $totalVegan = 0;

        setlocale(LC_TIME, 'nl' .'_' . strtoupper('nl'));

        if ($artists != null) {

            // CREW SHEEt
            $sheet2i = 1;
            foreach ($artists as $i2 => $artist2) {
                $practical2 = $artist2->getPractical();
                foreach ( $practical2 as $practic2) {
                    if ( $practic2->getBackstage() ) {
                        foreach ($practic2->getBackstage() as $key=>$backstage) {
                            $sheet2i++;
                            $type = '';

                            if ($backstage->getType() == 0 ) {
                                $type = "artiest";
                            } else if ($backstage->getType() == 1 ) {
                                $type = "geluidstechnieker";
                            } else if ($backstage->getType() == 2 ) {
                                $type = "technieker";
                            } else if ($backstage->getType() == 3 ) {
                                $type = "manager";
                            }

                            $sheet2->setCellValue('A' . $sheet2i, html_entity_decode($artist2->getName()));
                            $sheet2->setCellValue('B' . $sheet2i, html_entity_decode($backstage->getName()));
                            $sheet2->setCellValue('C' . $sheet2i, html_entity_decode($type));
                        }
                    }
                }
            }

            // CAR SHEET
            $sheet3i = 1;
            foreach ($artists as $i3 => $artist3) {
                $practical3 = $artist3->getPractical();
                foreach ( $practical3 as $practic3) {
                    if ( $practic3->getCar() ) {
                        foreach ($practic3->getCar() as $key=>$plate) {
                            $sheet3i++;

                            $sheet3->setCellValue('A' . $sheet3i, html_entity_decode($artist3->getName()));
                            $sheet3->setCellValue('B' . $sheet3i, html_entity_decode($plate->getLicencePlate()));
                        }
                    }
                }
            }

            // ARTIST SHEET
            foreach ($artists as $i => $artist) {
                $practical = $artist->getPractical();

                // artist dates
                $stages = "";
                $dates = "";
                foreach ($artist->getDate() as $key => $date) {
                    if ($key > 0 ) {
                        $stages .= " - " . $date->getStage()->getStageName();
                        $dates .= " - " . $date->getStartOn()->format('d/m/Y') . " (" . $date->getStartOn()->format('H:i') . " - " . $date->getEndOn()->format('H:i') . ")";
                    } else {
                        $stages .= $date->getStage()->getStageName();
                        $dates .=  $date->getStartOn()->format('d/m/Y') . " (" . $date->getStartOn()->format('H:i') . " - " . $date->getEndOn()->format('H:i') . ")";
                    }
                }

                foreach ( $practical as $practic) {
                    // get backstage artist
                    if ( $practic->getBackstage() ) {
                        $totalBackstage = 0;
                        foreach ($practic->getBackstage() as $key=>$backstage) {
                            $totalBackstage = $key;
                        }
                    }

                    // get car artist
                    if ( $practic->getCar() ) {
                        $this->arrCar[0] = '';
                        $this->arrCar[1] = '';
                        $this->arrCar[2] = '';

                        foreach ($practic->getCar() as $key=>$plate) {
                            $this->arrCar[$key] = $plate->getLicencePlate();
                        }
                    }

                    $i = $i+2;
                    $sheet->setCellValue('A' . $i, html_entity_decode($artist->getName()));
                    $sheet->setCellValue('B' . $i, html_entity_decode($dates));
                    $sheet->setCellValue('C' . $i, html_entity_decode($stages));
                    $sheet->setCellValue('D' . $i, html_entity_decode($practic->getContactFirstName() . ' ' . $practic->getContactName()));
                    $sheet->setCellValue('E' . $i, html_entity_decode($practic->getContactPhone()));
                    $sheet->setCellValue('F' . $i, html_entity_decode($practic->getContactEmail()));
                    $sheet->setCellValue('G' . $i, strip_tags(html_entity_decode(html_entity_decode($practic->getRemark()))));
                    $sheet->setCellValue('H' . $i, html_entity_decode($totalBackstage));
                    $sheet->setCellValue('I' . $i, html_entity_decode($practic->getHotMeal()));
                    $sheet->setCellValue('J' . $i, html_entity_decode($practic->getVeggieMeal()));
                    $sheet->setCellValue('K' . $i, html_entity_decode($practic->getVeganMeal()));
                    $sheet->setCellValue('L' . $i, html_entity_decode($practic->getTechnicalFilename()));
                    $sheet->setCellValue('M' . $i, html_entity_decode($practic->getContractFilename()));
                    $sheet->setCellValue('N' . $i, html_entity_decode($practic->getStageFilename()));
                    $sheet->setCellValue('O' . $i, html_entity_decode($practic->getExtraFilename()));
                    $sheet->setCellValue('P' . $i, html_entity_decode($this->arrCar[0]));
                    $sheet->setCellValue('Q' . $i, html_entity_decode($this->arrCar[1]));
                    $sheet->setCellValue('R' . $i, html_entity_decode($this->arrCar[2]));

                    $totalHot += $practic->getHotMeal();
                    $totalVeggie += $practic->getVeggieMeal();
                    $totalVegan += $practic->getVeganMeal();
                }
            }
        }

        // generate header
        $i = $i+3;
        $sheet
            ->setCellValue('A' . $i, 'TOTALEN')
            ->setCellValue('B' . $i, 'Warm: ' . $totalHot)
            ->setCellValue('C' . $i, 'Veggie: ' . $totalVeggie)
            ->setCellValue('D' . $i, 'Vegan: ' . $totalVegan);

        // auto-size columns
            $phpExcelObject->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
            $phpExcelObject->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);

        // set headers
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Artists.xls"');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        // send excel
        $objWriter = \PHPExcel_IOFactory::createWriter($phpExcelObject, 'Excel5');
        $objWriter->save('php://output');
        exit();
    }
}
