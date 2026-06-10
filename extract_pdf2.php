<?php
// Better PDF text extractor - cleans up TJ/Tj operators properly
$pdfFile = 'C:/Users/HP/Downloads/11 SIJA ASAT PRAKTEK.pdf';
$content = file_get_contents($pdfFile);

// Extract all streams
preg_match_all('/stream\r?\n(.*?)\r?\nendstream/s', $content, $matches);

$pages = [];
$currentPage = '';

foreach ($matches[1] as $stream) {
    $decoded = @gzinflate($stream);
    if ($decoded === false) {
        $decoded = @gzuncompress($stream);
    }
    if ($decoded === false) {
        continue; // skip binary/image streams
    }
    
    // Check if this contains text operators
    if (strpos($decoded, 'BT') === false) {
        continue;
    }
    
    $text = '';
    
    // Process TJ arrays: [(text1) kern (text2)] TJ
    $decoded2 = $decoded;
    preg_match_all('/\[((?:[^]]*?))\]\s*TJ/s', $decoded2, $tjArrays);
    foreach ($tjArrays[1] as $tjContent) {
        preg_match_all('/\(([^)]*)\)/', $tjContent, $parts);
        foreach ($parts[1] as $part) {
            // Decode PDF string escapes
            $part = str_replace(['\\(', '\\)', '\\\\', '\\n', '\\r', '\\t'], ['(', ')', '\\', "\n", "\r", "\t"], $part);
            $text .= $part;
        }
    }
    
    // Process single Tj: (text) Tj
    preg_match_all('/\(([^)]*)\)\s*Tj/s', $decoded2, $tjSingles);
    foreach ($tjSingles[1] as $single) {
        $single = str_replace(['\\(', '\\)', '\\\\'], ['(', ')', '\\'], $single);
        $text .= $single;
    }
    
    // Process text with ' operator (move to next line and show text)
    preg_match_all("/\(([^)]*)\)\s*'/s", $decoded2, $tjQuotes);
    foreach ($tjQuotes[1] as $quote) {
        $text .= $quote . "\n";
    }
    
    if (!empty(trim($text))) {
        $pages[] = $text;
    }
}

// Clean up and output
$output = '';
foreach ($pages as $i => $page) {
    $output .= "=== PAGE " . ($i + 1) . " ===\n";
    // Remove non-printable chars but keep unicode
    $clean = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F]/', '', $page);
    $output .= $clean . "\n\n";
}

file_put_contents('C:/Users/HP/Downloads/exam_clean.txt', $output);
echo $output;
