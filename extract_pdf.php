<?php
// Simple PDF text extractor
$pdfFile = 'C:/Users/HP/Downloads/11 SIJA ASAT PRAKTEK.pdf';
$content = file_get_contents($pdfFile);

// Method 1: Extract text between BT and ET markers after decompressing streams
preg_match_all('/stream\r?\n(.*?)\r?\nendstream/s', $content, $matches);

$allText = '';
foreach ($matches[1] as $stream) {
    $decoded = @gzinflate($stream);
    if ($decoded === false) {
        $decoded = @gzuncompress($stream);
    }
    if ($decoded === false) {
        $decoded = $stream;
    }
    
    // Extract text from decoded stream
    // Look for text showing operators: Tj, TJ, '
    preg_match_all('/\[(.*?)\]\s*TJ/s', $decoded, $tjMatches);
    foreach ($tjMatches[1] as $tj) {
        preg_match_all('/\((.*?)\)/', $tj, $textParts);
        foreach ($textParts[1] as $part) {
            $allText .= $part;
        }
    }
    
    preg_match_all('/\((.*?)\)\s*Tj/s', $decoded, $tjSingle);
    foreach ($tjSingle[1] as $single) {
        $allText .= $single;
    }
    
    $allText .= "\n";
}

file_put_contents('C:/Users/HP/Downloads/exam_text.txt', $allText);
echo "Text extracted. Length: " . strlen($allText) . " bytes\n";
echo "Preview:\n";
echo substr($allText, 0, 3000);
