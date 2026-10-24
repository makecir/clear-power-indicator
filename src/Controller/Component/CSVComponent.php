<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Psr\Http\Message\UploadedFileInterface;

class CSVComponent extends Component
{
    public function getLinesFromCsv(UploadedFileInterface $csv){
        // アップロードされたファイルを公開ディレクトリに置かず、そのまま読み込む。
        // クライアントのファイル名はパスに使わない (パストラバーサルや同名ファイルの同時アップロードを防ぐ)
        $contents = (string)$csv->getStream();
        // file() と同じく、改行の直後で分割し、各行の改行文字は残す
        return preg_split('/(?<=\n)/', $contents, -1, PREG_SPLIT_NO_EMPTY);
    }
}
