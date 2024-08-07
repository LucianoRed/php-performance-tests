<?php

$directory = '/tmp/pv';

// Verifica se o diretório existe
if (!is_dir($directory)) {
    echo "O diretório $directory não existe.\n";
    exit;
}

// Abre o diretório
if ($handle = opendir($directory)) {
    while (false !== ($file = readdir($handle))) {
        $filePath = $directory . '/' . $file;
        
        // Ignora as entradas "." e ".."
        if ($file !== '.' && $file !== '..') {
            // Verifica se é um arquivo antes de tentar deletar
            if (is_file($filePath)) {
                if (unlink($filePath)) {
                    echo "Arquivo $file deletado.\n";
                } else {
                    echo "Erro ao deletar o arquivo $file.\n";
                }
            }
        }
    }
    closedir($handle);
} else {
    echo "Erro ao abrir o diretório $directory.\n";
}
