<?php
namespace Awz\Note\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Install extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'note:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install and setup wechat-note';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct () {
        parent::__construct ();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle () {
        try {
            $this->line ( PHP_EOL . 'Scaffold basic login and registration views and routes' . PHP_EOL );
            Artisan::call ( 'make:auth' );
            $this->line ( PHP_EOL . 'Publish all of publishable assets.' . PHP_EOL );
            Artisan::call ( 'vendor:publish' , [
                '--force' => true ,
            ] );
            $this->line ( PHP_EOL . 'Create the migration repository.' . PHP_EOL );
            Artisan::call ( 'migrate' );
            $this->line ( PHP_EOL . 'Seed the database with records.' . PHP_EOL );
            Artisan::call ( 'db:seed' , [
                '--class' => 'SettingsTableSeeder' ,
            ] );
            Artisan::call ( 'db:seed' , [
                '--class' => 'UsersTableSeeder' ,
            ] );
            $this->line ( PHP_EOL . 'Installed successfully.' . PHP_EOL );
        } catch ( Exception $e ) {
            $this->line ( PHP_EOL . '<error>An unexpected error occurred. Installation could not continue.</error>' );
            $this->error ( "[✘] {$e->getMessage()}" );
        }
    }
}
