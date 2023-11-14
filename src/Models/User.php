<?php

namespace Sitebrew\Models;

// use App\Injectable\StripeClient;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/*use Laravel\Sanctum\HasApiTokens;
use Plank\Mediable\Mediable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;*/

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles;

    //HasApiTokens, HasFactory, HasSlug, Mediable,
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'full_name',
        'email',
        'password',
    ];

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
    }

    protected static function booted()
    {
        static::updated(function ($customer) {
            $customer->syncStripe();
        });
    }*/

    /*public function syncStripe()
    {
        $stripe = StripeClient::init();
        if (! $this->stripe_id) {
            $customer = $stripe->customers->create([
                'name' => $this->name,
                'email' => $this->email,
                'preferred_locales' => ['de-DE'],
            ]);
            $this->stripe_id = $customer->id;
            $this->save();
        } else {
            $stripe->customers->update($this->stripe_id, [
                'name' => $this->name,
                'email' => $this->email,
            ]);
        }
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }*/
}
