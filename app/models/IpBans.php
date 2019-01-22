<?php
class IpBans extends Rails\ActiveRecord\Base
{
    protected $duration;
    
    static public function tableName()
    {
        return 'ip_bans';
    }
    
    protected function associations()
    {
        return array(
            'belongs_to' => array(
                'user' => array('foreign_key' => 'banned_by')
            )
        );
    }

    public function setDuration($dur)
    {
        if (!$dur) {
            $this->expires_at = '00-00-00 00:00:00';
            $duration = null;
        } else {
            $this->expires_at = date('Y-m-d H:i:s', time() + ((int)$dur *60*60*24));
            $duration = $dur;
        }
        
        $this->duration = $duration;
    }
    
    public function duration()
    {
        return $this->duration;
    }
}
