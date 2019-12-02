<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
     * @return BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * @return BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
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
            return $this->allow();
        }

        return $this->disallow();
    }

    public function remove()
    {
        $this->delete();
    }

    public static function status()
    {
        return self::where('status', 0)->count();
    }
}
