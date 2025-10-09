<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class ResetDatabase extends BaseCommand
{
    protected $group       = 'Database';
    protected $name        = 'db:reset';
    protected $description = 'Reset database dengan migrations dan seeder';

    public function run(array $params)
    {
        CLI::write('Mereset database...', 'yellow');
        
        // Rollback semua migrations
        command('migrate:rollback');
        
        // Jalankan migrations
        command('migrate');
        
        // Jalankan seeder
        command('db:seed DatabaseSeeder');
        
        CLI::write('Database berhasil direset!', 'green');
    }
}