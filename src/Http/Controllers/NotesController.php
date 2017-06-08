<?php
namespace Awz\Note\Http\Controllers;

use Awz\Note\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NotesController extends \App\Http\Controllers\Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct () {
        $this->middleware ( 'auth' , [ 'index' ] );
    }

    /**
     * Display a listing of the notes .
     *
     * @return Illuminate\View\View
     */
    public function index () {
        $notes = Note::paginate ( 25 );
        return view ( 'notes::notes.index' , compact ( 'notes' ) );
    }

    /**
     * Show the form for creating a new note.
     *
     * @return Illuminate\View\View
     */
    public function create () {
        return view ( 'notes::notes.create' );
    }

    /**
     * Store a new note  in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store ( Request $request ) {
        $this->affirm ( $request );
        $data = $this->getData ( $request );
        Note::create ( $data );
        Session::flash ( 'success_message' , 'Note was added!' );
        return redirect ()->route ( 'notes.note.index' );
    }

    /**
     * Show the form for editing the specified note.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit ( $id ) {
        $note = Note::findOrFail ( $id );
        return view ( 'notes::notes.edit' , compact ( 'note' ) );
    }

    /**
     * Update the specified note in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update ( $id , Request $request ) {
        $this->affirm ( $request );
        $data = $this->getData ( $request );
        $note = Note::findOrFail ( $id );
        $note->update ( $data );
        Session::flash ( 'success_message' , 'Note was updated!' );
        return redirect ()->route ( 'notes.note.index' );
    }

    /**
     * Remove the specified note from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy ( $id ) {
        $note = Note::findOrFail ( $id );
        $note->delete ();
        Session::flash ( 'success_message' , 'Note was deleted!' );
        return redirect ()->route ( 'notes.note.index' );
    }

    /**
     * Validate the given request with the defined rules.
     *
     * @param  Illuminate\Http\Request $request
     *
     * @return boolean
     */
    protected function affirm ( Request $request ) {
        return $this->validate ( $request , [ ] );
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
            list( $width , $height , $content ) = $this->getUploadedFileContent ( $request->photo->getRealPath () );
            $data[ 'image' ] = $content;
            $data[ 'width' ] = $width;
            $data[ 'height' ] = $height;
        } else {
            $data[ 'width' ] = 0;
            $data[ 'height' ] = 0;
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