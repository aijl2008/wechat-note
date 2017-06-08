<?php
namespace Awz\Note\Http\Controllers;

use Awz\Note\Models\Setting;
use Illuminate\Http\Request;
use Session;

class SettingsController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct () {
        $this->middleware ( 'auth' );
    }

    /**
     * Show the form for editing the specified setting.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit () {
        $setting = Setting::first ();
        return view ( 'notes::settings.edit' , compact ( 'setting' ) );
    }

    /**
     * Update the specified setting in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update ( Request $request ) {
        $this->affirm ( $request );
        $data = $this->getData ( $request );
        $setting = Setting::first ();
        $setting->update ( $data );
        Session::flash ( 'success_message' , 'Setting was updated!' );
        return redirect ()->route ( 'settings.setting.edit' );
    }

    /**
     * Validate the given request with the defined rules.
     *
     * @param  Illuminate\Http\Request $request
     *
     * @return boolean
     */
    protected function affirm ( Request $request ) {
        return $this->validate ( $request , [
            'name' => 'required|max:255'
        ] );
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData ( Request $request ) {
        $data = $request->all ();
        if ( $request->hasFile ( 'photo' ) ) {
            list( , , $content ) = $this->getUploadedFileContent ( $request->photo->getRealPath () );
            $data[ 'logo' ] = $content;
        }
        $data[ 'created_at' ] = !empty( $request->input ( 'created_at' ) ) ? $request->input ( 'created_at' ) : null;
        $data[ 'updated_at' ] = !empty( $request->input ( 'updated_at' ) ) ? $request->input ( 'updated_at' ) : null;
        return $data;
    }

    public function getUploadedFileContent ( $path ) {
        $content = file_get_contents ( $path );
        list ( $width , $height , ) = getimagesizefromstring ( $content );
        return [
            $width ,
            $height ,
            base64_encode ( $content )
        ];
    }

}