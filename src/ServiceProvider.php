<?php
namespace Awz\Note;

use Awz\Note\Models\Setting;

class ServiceProvider extends \Illuminate\Support\ServiceProvider {
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot () {
        require realpath ( __DIR__ . '/../routes/web.php' );
        $this->loadViewsFrom ( __DIR__ . '/../resources/views' , 'notes' );
        if ( php_sapi_name () != 'cli' ) {
            $setting = Setting::first ();
            if ( !$setting ) {
                $setting = new Setting();
                $setting->name = 'Awz\'s Blog';
                $setting->logo = '/9j/4AAQSkZJRgABAQAAAQABAAD/4QDKRXhpZgAATU0AKgAAAAgABgESAAMAAAABAAEAAAEaAAUAAAABAAAAVgEbAAUAAAABAAAAXgEoAAMAAAABAAIAAAITAAMAAAABAAEAAIdpAAQAAAABAAAAZgAAAAAAAABIAAAAAQAAAEgAAAABAAeQAAAHAAAABDAyMjGRAQAHAAAABAECAwCgAAAHAAAABDAxMDCgAQADAAAAAQABAACgAgAEAAAAAQAAAISgAwAEAAAAAQAAAISkBgADAAAAAQAAAAAAAAAAAAD/2wBDAAYEBQYFBAYGBQYHBwYIChAKCgkJChQODwwQFxQYGBcUFhYaHSUfGhsjHBYWICwgIyYnKSopGR8tMC0oMCUoKSj/2wBDAQcHBwoIChMKChMoGhYaKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCj/wgARCACEAIQDASIAAhEBAxEB/8QAGgABAQADAQEAAAAAAAAAAAAAAAQCAwUBB//EABQBAQAAAAAAAAAAAAAAAAAAAAD/2gAMAwEAAhADEAAAAfpYAAAAAAAAAAAAAAAAAAAANfNznMrIR22raAAAAAAcjXZGD06NOGYAAAAAB5x+lzDy6Gk6Tz0AAAAAwg0YgAGdvPHbR2AAAAEfloiWiJaIlo07gAAAAAAAAAAAAAAAAAAAA//EACEQAAEDAwQDAAAAAAAAAAAAAAEAAgMREzAEEBIhIDJg/9oACAEBAAEFAvinu4hz3OQKilzTGr94jVmST330/pknb3sO0wcW5CKgihWnbmfIG7xScUCDjc4NT5S7xaSEyauImp89OesFhWFYVhWFYVhWFGzh8T//xAAUEQEAAAAAAAAAAAAAAAAAAABg/9oACAEDAQE/ASP/xAAUEQEAAAAAAAAAAAAAAAAAAABg/9oACAECAQE/ASP/xAAlEAAABQIEBwAAAAAAAAAAAAAAATAyoRAhESAxYAISIkBRYXH/2gAIAQEABj8C2XrTDiW+ZCVPsebIRK4GDKmK3ut9BZO48FlsOpK6BkjqHQHQHQHQHQHQHRsr/8QAIxABAAEEAAYDAQAAAAAAAAAAAREAITAxECBBUWBhcYGRsf/aAAgBAQABPyHwoZ38pS6jsUg2UpJPrc04dLOSWO9OWz5+T+uWKLTxCgN16Uygmhr1YxwCF70ZpwL9lLKrt4TU2UTKkxm3fVWI5RWXFFZY9+mJmbnAyhsawom0T4wAAAAQ3lfCf//aAAwDAQACAAMAAAAQ8888888888888888888888M088888808c888888U4088888M88c88888MMMM888888888888888888888//EABQRAQAAAAAAAAAAAAAAAAAAAGD/2gAIAQMBAT8QI//EABQRAQAAAAAAAAAAAAAAAAAAAGD/2gAIAQIBAT8QI//EACYQAQABAwIFBQEBAAAAAAAAAAERACExMPBBUWGh8RAgYHHRgbH/2gAIAQEAAT8Q+FZvuAZXlUwJwIgVJnMyMNKYGUP11mnLED/d9PY7iQfYmzVCFzN7+wIl4tO35qqQYR+9nb1EtUwRV4cLpz599U2JKErjBNL6fTMINzhudYNIdgYHrTX0kvW/pBJWlTI86Em6TpyWJcC61MXS0Dd/vtFsXHl9UkR4gZflF4R6iaK1KMq8NBfCoy6zbtosa8lhlHet/lW/yrf5Vv8AKt/lW/yrf5USjYSpGJt3fhP/2Q==';
                $setting->save ();
            }
            view ()->share ( 'setting' , $setting );
        }
        $this->loadMigrationsFrom ( __DIR__ . '/../database/migrations' );
        $this->publishes ( [
            __DIR__ . '/../config/wechat.php' => config_path ( 'wechat.php' ) ,
        ] , 'config' );
        $this->publishes ( [
            __DIR__ . '/../resources/views/auth/login.blade.php' => base_path ( 'resources/views' ) . '/auth/login.blade.php' ,
        ] , 'view' );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register () {
        //
    }
}
