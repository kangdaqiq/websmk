<?php

$directories = [
    __DIR__ . '/resources/views/public',
    __DIR__ . '/resources/views/layouts'
];

foreach ($directories as $dir) {
    if (is_dir($dir)) {
        $files = glob($dir . '/*.blade.php');
        foreach ($files as $file) {
            $content = file_get_contents($file);
            $content = str_replace('blue-', 'primary-', $content);
            $content = str_replace('indigo-', 'primary-', $content);
            $content = str_replace('purple-', 'primary-', $content);
            $content = str_replace('sky-', 'primary-', $content);
            // Replace specific gradients from-[hex] to-[hex] 
            $content = str_replace("from-['#20a306']", 'from-primary-600', $content); // if any
            file_put_contents($file, $content);
        }
    }
}
echo "Colors updated successfully!";
