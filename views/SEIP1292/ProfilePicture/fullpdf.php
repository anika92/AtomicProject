<?php
require_once('../../../vendor/mpdf/mpdf/mpdf.php');
include_once('../../../vendor/autoload.php');
use App\Bitm\SEIP1292\Book\Book;
$pdf= new Book();

$allData=$pdf->prepare($_GET)->index();
//var_dump($single);
$trs="";
$sl=0;
foreach($allData as $data):
    $sl++;
    $trs.="<tr>";
    $trs.="<td>$sl</td>";
    $trs.="<td>$data->id</td>";
    $trs.="<td>$data->title</td>";
    $trs.="</tr>";
endforeach;
$html= <<<BITM
<div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>SL#</th>
                <th>ID</th>
                <th>Book Title</th>

           </tr>
            </thead>
            <tbody>
                 $trs
            </tbody>
        </table>
BITM;
//echo $html;
//die();

$mpdf = new mPDF();

// Write some HTML code:

$mpdf->WriteHTML($html);

// Output a PDF file directly to the browser
$mpdf->Output('newfff.pdf', 'D');