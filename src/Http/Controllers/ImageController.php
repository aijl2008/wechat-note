<?php
namespace Jerry\Note\Http\Controllers;
class ImageController extends Controller {

    public function image ( $model , $id ) {
        switch ( $model ) {
            case 'setting':
                $image = \Jerry\Note\Models\Setting::where ( [ 'id' => $id ] )->select ( 'logo as image' )->first ();
                break;
            case 'note':
                $image = \Jerry\Note\Models\Note::where ( [ 'id' => $id ] )->select ( 'image' )->first ();
                break;
            default:
                abort ( 404 );
                break;
        }
        if ( !$image ) {
            abort ( 404 );
        }
        return response ( base64_decode ( $image->image ) , 200 , [
            'Content-Type' => 'image/jpg' ,
        ] );
    }
}
