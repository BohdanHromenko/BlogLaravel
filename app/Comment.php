<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 *
 * @package App
 *
 * @property string             $text;
 * @property integer            user_id;
 * @property integer            post_id;
 * @property integer            status;
 */
class Comment extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function allow()
    {
        $this->status = 1;
        $this->save();
    }

    public function disallow()
    {
        $this->status = 0;
        $this->save();
    }

    public function toggleStatus()
    {
        if ($this->status == 0)
        {
            $this->allow();
        }

        return $this->disallow();
    }

    public function remove()
    {
        $this->delete();
    }
}
