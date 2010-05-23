<?php

class Mail_model extends Model
{
    function Mail_model()
    {
        parent::Model();
    }
    
    function send_mail($to, $subj, $msg)
    {
        $this->email->from('MegBeg@mail.ru', 'MegBeg');
        $this->email->to($to);
        $this->email->reply_to('no-reply@jk.ru', 'No-Reply'); 
        $this->email->subject($subj);
        $this->email->message($msg);
        
        return $this->email->send();
        
        //echo $this->email->print_debugger();
    }
    
    function new_user_to_admin($name)
    {
        $this->email->from('MegBeg@mail.ru', 'MegBeg');
        $this->email->to('MegBeg@mail.ru');
        $this->email->reply_to('no-reply@jk.ru', 'No-Reply'); 
        $this->email->subject('New user in site');
        $this->email->message("New user: $name in your site");
        
        return $this->email->send();
        
        //echo $this->email->print_debugger();
    }

}