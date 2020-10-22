<?php

namespace App\Helpers;

trait FlashMessage

{    
    /**
     * Define o tipo e a mensagem a ser enviada para view
     *
     * @param  mixed $type
     * @param  mixed $message
     * @return void
     */
    public function flashMessage(string $type, string $message): void
    {
        $_SESSION['message_type'] = $type;
        $_SESSION['message'] = $message;
    }
}
