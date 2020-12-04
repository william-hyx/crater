<?php
namespace Crater\Models;

use Crater\Models\Address;
use Illuminate\Database\Eloquent\Model;
use Crater\Models\User;
use Crater\Models\CompanySetting;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model implements HasMedia
{
    use InteractsWithMedia;

    use HasFactory;

    protected $fillable = ['name', 'logo', 'unique_hash'];

    protected $appends=['logo'];

    public function getLogoAttribute()
    {
        $logo = $this->getMedia('logo')->first();
        if ($logo) {
            return  asset($logo->getUrl());
        }
        return ;
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function settings()
    {
        return $this->hasMany(CompanySetting::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
