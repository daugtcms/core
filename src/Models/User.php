<?php

namespace Daugt\Models;

// use App\Injectable\StripeClient;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Daugt\Jobs\Shop\SyncStripeUser;
use Daugt\Models\Shop\Order;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Sluggable\SlugOptions;

/*use Laravel\Sanctum\HasApiTokens;
use Plank\Mediable\Mediable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;*/

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles, SoftDeletes, Prunable, Impersonate;

    //HasApiTokens, HasFactory, HasSlug, Mediable,

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'address' => 'array',
    ];

    public function prunable()
    {
        return static::where('created_at', '<=', now()->subWeek());
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    protected static function boot(): void
    {
        parent::boot();
        // sync stripe user on creation syncronously and on update asyncronously
        static::created(function ($user) {
            SyncStripeUser::dispatchSync($user);
        });
        static::updated(function ($user) {
            SyncStripeUser::dispatch($user);
        });
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function canImpersonate()
    {
        return $this->can('impersonate');
    }

    public function canBeImpersonated()
    {
        return !$this->canImpersonate();
    }

    /*public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }*/
}
