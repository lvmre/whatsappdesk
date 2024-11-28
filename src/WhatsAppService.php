text/x-generic WhatsAppService.php ( PHP script, ASCII text, with CRLF line terminators )
<?php

namespace ChatC\WhatsAppDesk;

use Illuminate\Support\Facades\Http;

class WhatsAppService
{
    protected $appkey;
    protected $authkey;
    protected $apiUrl = 'https://chatc.cloud/api/create-message';

    public function __construct($appkey, $authkey)
    {
        $this->appkey = $appkey;
        $this->authkey = $authkey;
    }

    public function sendMessage($to, $message = null, $file = null, $templateId = null, $variables = [])
    {
        $payload = [
            'appkey' => $this->appkey,
            'authkey' => $this->authkey,
            'to' => $to,
        ];

        if ($message) {
            $payload['message'] = $message;
        }

        if ($file) {
            $payload['file'] = $file;
        }

        if ($templateId) {
            $payload['template_id'] = $templateId;
            foreach ($variables as $key => $value) {
                $payload["variables[{$key}]"] = $value;
            }
        }

        $response = Http::asForm()->post($this->apiUrl, $payload);

        return $response->json();
    }
}
