<?php
namespace App\Controller\Component;
 
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use \SplFileObject;

class CSVComponent extends Component
{
    public function getLinesFromCsv(&$csv){
        $csv_path = '../webroot/uploaded/'.$csv->getClientFilename();
        $csv->moveTo(sprintf($csv_path,$csv->getClientFilename()));
        chmod("../webroot/uploaded/" . $csv->getClientFilename(), 0644);
        $file = file($csv_path);
        //$ret = explode(PHP_EOL, $csvData);
        unlink('../webroot/uploaded/'.$csv->getClientFilename());
        return $file;
    }
}
