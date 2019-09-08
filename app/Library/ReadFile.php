<?php

  namespace app\Library;

  use App\Library\Validation;
  use App\Library\CommissionFees;

class ReadFile extends Validation
{

    /**
     * Open given input file.
     *
     * @param $file
     * @return \Generator
     */
    private function readCSV($file)
    {
        if (($handle = fopen($file, "r")) !== false) {
            while (!feof($handle)) {
                yield fgetcsv($handle, 1000, ",");
            }

            fclose($handle);
        }
    }

    /**
     * Write in output file the results.
     *
     * @param $list
     */
    private function writeCSV($list)
    {
        $fp = fopen('output.csv', 'a');
        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
    }

    /**
     * Do calculation print out the results in command line and write them in output.csv file.
     *
     * @param $filePointer
     */
    public function calculate($filePointer)
    {

        $commissionFees = new CommissionFees();

        foreach ($this->readCSV($filePointer) as $post) {
            if (!$post) {
                continue;
            }

            $process = $this->validateEntryLine($post);

            if (!$process['process']) {
                $list = [
                    [$process[0], $process[1], $process[2], $process[3], $process[4], $process[5]]
                ];

                echo $process[0] ,
                     $process[1] ,
                     $process[2] ,
                     $process[3] ,
                     $process[4] ,
                     $process[5] ,
                     "\n";
            } else {

                switch ($post[3]) {
                    case 'cash_in':
                        $fee = $commissionFees->cashIn($post[4], $post[5]);
                        $list = [
                          [$fee]
                        ];
                        echo $fee , "\n";
                        break;

                    case 'cash_out':
                        $fee = $commissionFees->cashOut($post[4], $post[2], $post[5]);
                        $list = [
                          [$fee]
                        ];
                        echo $fee , "\n";
                        break;
                }
            }

            $this->writeCSV($list);

        }
    }
}
