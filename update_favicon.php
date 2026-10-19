<?php
$viewsDir = __DIR__ . '/resources/views';

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($viewsDir));

$faviconTag = "    <link rel=\"icon\" type=\"image/png\" href=\"{{ asset('images/facc-logo.png') }}\">\n";

$count = 0;
foreach ($iterator as $file) {
    if ($file->isFile() && strpos($file->getFilename(), '.blade.php') !== false) {
        $content = file_get_contents($file->getPathname());
        
        // Skip if already has icon
        if (strpos($content, '<link rel="icon"') !== false) {
            continue;
        }

        // Replace <title> with favicon + <title>
        if (preg_match('/( *<title>.*?<\/title>)/is', $content, $matches)) {
            $titleTag = $matches[1];
            $newContent = str_replace($titleTag, $faviconTag . $titleTag, $content);
            file_put_contents($file->getPathname(), $newContent);
            $count++;
            echo "Updated " . $file->getFilename() . "\n";
        }
    }
}
echo "Total updated: $count\n";
