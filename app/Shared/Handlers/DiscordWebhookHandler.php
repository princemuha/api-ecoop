<?php

namespace App\Shared\Handlers;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;
use Monolog\Level;

class DiscordWebhookHandler extends AbstractProcessingHandler
{
    private string $webhookUrl;
    private ?string $username;

    public function __construct(
        string $webhookUrl,
        ?string $username = null,
        $level = Level::Debug,
        bool $bubble = true
    ) {
        parent::__construct($level, $bubble);
        $this->webhookUrl = $webhookUrl;
        $this->username = $username;
    }

    protected function write(LogRecord $record): void
    {
        $content = $record->formatted;

        // Discord limit is 2000 characters
        if (strlen($content) > 2000) {
            $content = substr($content, 0, 1997) . '...';
        }

        $data = [
            'content' => $content,
        ];

        if ($this->username) {
            $data['username'] = $this->username;
        }

        $headers = ['Content-Type: application/json'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->webhookUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        curl_exec($ch);
        curl_close($ch);
    }
}
