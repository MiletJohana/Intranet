<?php 
if (isset($_GET['doc'])) {
    $fileName = basename($_GET['doc']);
    $filePath = "../../documentos/credito/$fileName";
    if (!empty($fileName) && file_exists($filePath)) {
        // Define headers
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: '. filesize($filePath));
        readfile($filePath);
    }
}

if (isset($_GET['doc1'])) {
    $fileName = basename($_GET['doc1']);
    $filePath = "../../documentos/credito/$fileName";
    if (!empty($fileName) && file_exists($filePath)) {
        // Define headers
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: '. filesize($filePath));
        readfile($filePath);
    }
}


if (isset($_GET['doc2'])) {
    $fileName = basename($_GET['doc2']);
    $filePath = "../../documentos/credito/$fileName";
    if (!empty($fileName) && file_exists($filePath)) {
        // Define headers
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: '. filesize($filePath));
        readfile($filePath);
    }
}


if (isset($_GET['doc3'])) {
    $fileName = basename($_GET['doc3']);
    $filePath = "../../documentos/credito/$fileName";
    if (!empty($fileName) && file_exists($filePath)) {
        // Define headers
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: '. filesize($filePath));
        readfile($filePath);
    }
}

if (isset($_GET['doc4'])) {
    $fileName = basename($_GET['doc4']);
    $filePath = "../../documentos/credito/$fileName";
    if (!empty($fileName) && file_exists($filePath)) {
        // Define headers
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: '. filesize($filePath));
        readfile($filePath);
    }
}
if (isset($_GET['doc5'])) {
    $fileName = basename($_GET['doc5']);
    $filePath = "../../documentos/credito/$fileName";
    if (!empty($fileName) && file_exists($filePath)) {
        // Define headers
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($fileName) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: '. filesize($filePath));
        readfile($filePath);
    }
}
?>