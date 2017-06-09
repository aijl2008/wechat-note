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
            $this->line ( "php artisan make:auth" );
            Artisan::call ( 'make:auth' );
            $this->line ( "php artisan vendor:publish --force" );
            Artisan::call ( 'vendor:publish' , [
                '--force' => true ,
            ] );
            $this->line ( 'php artisan migrate' );
            Artisan::call ( 'migrate' );
            $this->line ( 'php artisan db:seed --class=SettingsTableSeeder' );
            Artisan::call ( 'db:seed' , [
                '--class' => 'SettingsTableSeeder' ,
            ] );
            system ( 'composer dump-autoload' );
            $this->line ( 'php artisan db:seed --class=UsersTableSeeder' );
            Artisan::call ( 'db:seed' , [
                '--class' => 'UsersTableSeeder' ,
            ] );
            $this->line ( 'Installed successfully.' );
        } catch ( Exception $e ) {
            $this->line ( PHP_EOL . '<error>An unexpected error occurred. Installation could not continue.</error>' );
            $this->error ( "[✘] {$e->getMessage()}" );
        }
    }
}
