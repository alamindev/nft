<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'name',
        'slug',
        'photo',
        'website_link',
        'discord_link',
        'twitter_link',
        'launch_date',
        'launch_time',
        'description',
        'user_id ',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function promoted_project()
    {
        return $this->hasOne(PromotedProject::class);
    }
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
    public function custom_vote()
    {
        return $this->hasMany(CustomVote::class);
    }

    public function favourite()
    {
        return $this->hasMany(Favourite::class);
    }
}
