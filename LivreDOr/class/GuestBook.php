<!-- Utiliser une classe pour représenter le livre d'or (GuestBook)
    - new GuestBook($file)
    - addMessage(Message $message)
    - getMessages(): array -->

<?php
require_once 'Message.php';
class GuestBook   {

    private  $file;
    
    /**
     * __construct
     *
     * @param  mixed $file
     * @return void
     */
    public function __construct (string $file){
       $directory=dirname($file);
      if (!is_dir($directory)) 
      {
          mkdir($directory,0777,true);
      }
      if (!file_exists($file))
      {
          touch($file);
      }
        $this->file=$file;
         
    }
    
    // methodes
    
    /**
     * addMessage
     *
     * @param  mixed $message
     * @return void
     */
    public function addMessage(Message $message):void{       
        // var_dump($message);
        file_put_contents($this->file,$message->toJSON().PHP_EOL,FILE_APPEND);
    }
   
    /**
     * getMessages
     *
     * @return array
     */
    public function getMessages() :array {
       $content=trim(file_get_contents($this->file));
        $lines=explode(PHP_EOL,$content);
        $messages=[];
        foreach ($lines as $line) {
            $messages[] = Message::fromJSON(($line)); // appel methode static avec '::'
        }
        
         return array_reverse($messages);
        // 
    }
}