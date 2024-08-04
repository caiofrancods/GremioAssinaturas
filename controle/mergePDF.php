<?php
ob_start();
require_once '../vendor/autoload.php';
require_once '../PDFMerger/PDFMerger.php';
use PDFMerger\PDFMerger;
function merge($file1, $file2, $nomefinal)
{
    // Arquivos PDF que você deseja mesclar
    
    $pdf = new PDFMerger;
    $pdf->addPDF($file1, 'all');
    $pdf->addPDF($file2, 'all');
    $pdf->merge('download', $nomefinal);
    return;
}


