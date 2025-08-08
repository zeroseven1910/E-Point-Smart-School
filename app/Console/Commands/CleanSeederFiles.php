<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

class CleanSeederFiles extends Command
{
    protected $signature = 'clean:seeders';
    protected $description = 'Remove BOM and blank lines before PHP opening tag in seeder files';

    public function handle()
    {
        $seederPath = base_path('database/seeders');
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($seederPath));

        foreach ($files as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $content = file_get_contents($file->getRealPath());

                // Hapus BOM
                $content = preg_replace('/^\xEF\xBB\xBF/', '', $content);

                // Hapus baris kosong atau spasi sebelum <?php
                $content = preg_replace('/^\s*<\?php/', '<?php', $content);

                file_put_contents($file->getRealPath(), $content);
                $this->info("Cleaned: " . $file->getFilename());
            }
        }

        $this->info('✅ Semua file seeder sudah dibersihkan.');
        return Command::SUCCESS;
    }
}
