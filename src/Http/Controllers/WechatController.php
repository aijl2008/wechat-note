<?php
namespace Jerry\Note\Http\Controllers;

use App\Models\Note;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\Text;
use Session;

class WechatController extends Controller {

    protected $config = [ ];
    protected $app    = null;

    function __construct () {
        $this->config = [
            'debug' => config ( 'wechat.debug' ) ,
            'app_id' => config ( 'wechat.app_id' ) ,
            'secret' => config ( 'wechat.secret' ) ,
            'token' => config ( 'wechat.token' ) ,
            'aes_key' => config ( 'wechat.aes_key' ) ,
            'log' => config ( 'wechat.log' )
        ];
    }

    public function api () {
        try {
            $this->app = new Application( $this->config );
            // 从项目实例中得到服务端应用实例。
            $server = $this->app->server;
            $server->setMessageHandler ( function ( $message ) {
                switch ( $message->MsgType ) {
                    case "text":
                        return $this->handleTextMessage ( $message );
                        break;
                    case "image":
                        return $this->handleImageMessage ( $message );
                        break;
                    case "event":
                        return $this->handleEventMessage ( $message );
                        break;
                    case "link":
                        return $this->handleLinkMessage ( $message );
                        break;
                    default:
                        return new Text( [
                            'content' => var_export ( $message , true )
                        ] );
                        break;
                }
            } );
            return $server->serve ();
        } catch ( \Exception $e ) {
            return '<xml><ToUserName><![CDATA[o2n-VuDJR0GoWfc3NMiPWrgzsRrA]]></ToUserName><FromUserName><![CDATA[gh_5fa95ff46b17]]></FromUserName><CreateTime>1496033878</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[' . $e->getMessage () . ']]></Content></xml>';
        }
    }


    /**
     * 处理图像消息
     * @param $message
     * @return Text
     */
    protected function handleImageMessage ( $message ) {
        $Note = new Note();
        list ( $width , $height , $image ) = $this->getRemoteImage ( $message->PicUrl , true );
        $Note->create ( [
            'height' => $height ,
            'width' => $width ,
            'image' => $image ,
            'openid' => $message->FromUserName
        ] );
        return new Text( [
            'content' => '您的图片已发出[Kiss][Kiss]'
        ] );
    }

    /**
     * 处理文本消息
     * @param $message
     * @return Text
     */
    protected function handleTextMessage ( $message ) {
        $title = '';
        if ( $this->isUrl ( $message->Content ) ) {
            $client = new \GuzzleHttp\Client();
            $res = $client->request ( 'GET' , $message->Content );
            $pattern = ' /<title>( [ \S\s ] *?) < \/title >/';
            preg_match ( $pattern , $res->getBody () , $match );
            $title = ( isset( $match[ 1 ] ) ? strip_tags ( trim ( $match[ 1 ] ) ) . PHP_EOL : '' ) . $message->Content = $title . $message->Content;
        }
        $Note = new Note();
        $Note->create ( [
            'content' => $message->Content ,
            'openid' => $message->FromUserName
        ] );
        return new Text( [
            'content' => $title . '您的消息已发出[Kiss][Kiss]'
        ] );
    }

    /**
     * 处理Link消息
     * @param $message
     * @return Text
     */
    protected function handleLinkMessage ( $message ) {
        $Note = new Note();
        $Note->create ( [
            'content' => $message->Title . PHP_EOL . $message->Description . PHP_EOL . $message->Url ,
            'openid' => $message->FromUserName
        ] );
        return new Text( [
            'content' => $message->Title . '您的消息已发出[Kiss][Kiss]'
        ] );
    }

    /**
     * 处理事件消息
     * @param $message
     * @return Text
     */
    protected function handleEventMessage ( $message ) {
        switch ( $message->Event ) {
            case 'subscribe':
                return new Text( [
                    'content' => '谢谢关注'
                ] );
                break;
            default:
                return new Text( [
                    'content' => '欢迎下次再来'
                ] );
                break;
        }
    }

    protected function getRemoteImage ( $url , $extra = false ) {
        $client = new \GuzzleHttp\Client();
        $res = $client->get ( $url );
        if ( !$extra ) {
            return base64_encode ( $res->getBody () );
        }
        list ( $width , $height , ) = getimagesizefromstring ( $res->getBody () );
        return [
            $width ,
            $height ,
            base64_encode ( $res->getBody () )
        ];
    }

    protected function isUrl ( $url ) {
        $http = substr ( $url , 0 , 7 ) == 'http://';
        $https = substr ( $url , 0 , 8 ) == 'https://';
        return $http || $https;
    }

    public function image ( $id ) {
        $Note = Note::where ( [ 'id' => $id ] )->first ();
        if ( !$Note ) {
            abort ( 404 );
        }
        return response ( base64_decode ( $Note->image ) , 200 , [
            'Content-Type' => 'image/jpg' ,
        ] );
    }

}
