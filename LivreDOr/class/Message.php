<!-- - new Message(string $username, string $message, DateTime $date)
    - isValid(): bool
    - getErrors(): array
    - toHTML(): string
    - toJSON(): string
    - Message::fromJSON(string): Message -->
<?php

class Message
{

    protected   $username;
    protected   $message;
    protected   $date;

   
    public function __construct(string $username, string $message   )
    {
        $this->username   = $username;
        $this->message = $message;
        $this->date = new DateTime();
    }

    /**
     * si le tableau error$ est vide alors la focntionne retounera false
     */
    public function isValid (): bool{
        return   empty($this->getErrors());
    }


    /**
     * si la longueur de username est < 3 alors on remplira la cle du tableau correspondante
     * si la longueur de message est < 10 alors on remplira la cle du tableau correspondante
     */
     public function getErrors(): array
     {
        $errors = [];
        $this->username=trim($this->username);
        $this->message=trim($this->message);
        if (strlen($this->username) < 3) { 
            $errors['username'] = 'Votre pseudo est trop court';
        }
        if (strlen($this->message) < 10) {
            $errors['message'] = 'Votre message est trop court';
        }
        return $errors;
    }
    // affichage dans la zone area des resultats
    public function toHTML(): string
    {
       $username = htmlentities($this->username);
        $this->date->setTimezone(new DateTimeZone('Europe/Paris'));
        $date=$this->date->format('d/m/Y à H:i');
        $message=nl2br(htmlentities($this->message)); //nl2br rajoute des br au html pour faire les sauts d elignes fait au cas ou messge sur plusieurs lignes 
         return <<<HTML
        <p>
            <strong>{$username}</strong> <em>le {$date}</em><br>
            {$message}
        </p>
        HTML;
    }
    
    /**
     * toJSON
     *
     * @return string
     */
    public function toJSON() : string{
        
           return json_encode(
            [
                'pseudo' => $this->username,
                'message'=> $this->message,
                 'date'   => $this-> date->format('d-m-y')         
                                
            ]
            );
    }

    public static function fromJSON(string $messageDecoder):Message {
        
         $data=json_decode($messageDecoder,true);
        return new self ($data['pseudo'],$data['message'], $data['date']); 
    
        
    }
}