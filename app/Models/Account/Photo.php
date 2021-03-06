<?php

namespace App\Models\Account;

use App\Helpers\StorageHelper;
use App\Models\Contact\Contact;
use App\Models\ModelBinding as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Photo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'photos';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the account record associated with the photo.
     *
     * @return BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Get the contacts record associated with the photo.
     *
     * @return BelongsToMany
     */
    public function contacts()
    {
        return $this->belongsToMany(Contact::class)->withTimestamps();
    }

    /**
     * Get the first contact record associated with the photo.
     *
     * @return Contact
     */
    public function contact()
    {
        return $this->contacts()->first();
    }

    /**
     * Gets the full path of the photo.
     *
     * @return string
     */
    public function url()
    {
        $url = $this->new_filename;

        return asset(StorageHelper::disk(config('filesystems.default'))->url($url));
    }
}
