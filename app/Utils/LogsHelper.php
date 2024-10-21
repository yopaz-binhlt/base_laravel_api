<?php

namespace App\Utils;


use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class LogsHelper
{


    /**
     * Write custom logs
     *
     * @param $text
     */
    public static function writeLog($text, $fileName='custom.log')
    {
        File::append(storage_path()."/logs/{$fileName}", Carbon::now().' '.print_r($text, true).PHP_EOL);

    }//end writeLog()


    /**
     * Write log to custom file name
     *
     * @param $fileName
     * @param $text
     * @param string $subFolder
     */
    public static function trackByFile($fileName, $text, $subFolder='')
    {
        if (empty($subFolder)) {
            File::append(
                storage_path().'/logs/'.$fileName.'_'.Carbon::now()->toDateString().'.log',
                Carbon::now().' '.print_r($text, true).PHP_EOL
            );
        } else {
            File::append(
                storage_path().'/logs/'.$subFolder.'/'.$fileName.'_'.Carbon::now()->toDateString().'.log',
                Carbon::now().' '.print_r($text, true).PHP_EOL
            );
        }

    }//end trackByFile()


    /**
     * Write log exception
     *
     * @param $fileName
     * @param \Throwable $exception
     * @param $data
     * @param $subFolder
     *
     * @return void
     */
    public static function exceptionByFile($fileName, \Throwable $exception, $data='', $subFolder='')
    {
        if (config('app.debug')) {
            try {
                self::trackByFile(
                    $fileName,
                    'Exception: '.$exception->getMessage().' on Line '.$exception->getLine(
                    ).' in File '.$exception->getFile().', Data: '.print_r(
                        [$data],
                        true
                    ).')',
                    $subFolder
                );
            } catch (\Throwable $exception) {
                self::trackByFile('system_logs', 'Cannot write exception, please check write permission', $subFolder);
            }
        }

    }//end exceptionByFile()


}//end class
