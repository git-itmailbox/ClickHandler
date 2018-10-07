<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Click extends Model
{
    /**
     * Disable auto-incrementing the primary key field for this model.
     *
     * @var bool $incrementing
     */
    public $incrementing = false;


    protected $fillable =['user_agent', 'ip', 'ref', 'param1', 'param2'];

    /**
     * Generating unique id using model fields
     *
     * @return string
     */
    public function generateId()
    {
        return sha1($this->user_agent.$this->ip.$this->ref.$this->param1);
    }

    public function setId()
    {
        $this->id = $this->generateId();
    }

    /**
     *increments field error
     */
    public function incrementError()
    {
        return $this->error++;
    }


    /**
     *     *increments field bad_domain
     */
    public function incrementBadDomain()
    {
        return $this->bad_domain++;
    }
}
