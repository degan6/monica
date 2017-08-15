<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property Account $account
 * @property Contact $contact
 * @property Contact|Kid|SignificantOther $recipient
 * @method static Builder offered()
 * @method static Builder isIdea()
 */
class Gift extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['date_offered'];

    /**
     * Get the account record associated with the gift.
     *
     * @return BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Get the contact record associated with the gift.
     *
     * @return BelongsTo
     */
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    /**
     * Get the contact record associated with the gift.
     *
     * @return BelongsTo
     */
    public function recipient()
    {
        return $this->contact();
    }

    /**
     * Limit results to already offered gifts.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOffered(Builder $query)
    {
        return $query->where('has_been_offered', true);
    }

    /**
     * Limit results to gifts at the idea stage.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeIsIdea(Builder $query)
    {
        return $query->where('is_an_idea', true);
    }

    /**
     * Check whether the gift is meant for a particular member
     * of the contact's family.
     *
     * @return bool
     */
    public function hasParticularRecipient()
    {
        return $this->about_object_type !== null;
    }

    /**
     * Set the recipient for the gift.
     *
     * @param string $recipient
     * @return static
     */
    public function forRecipient($recipient)
    {
        $this->about_object_id = $recipient;
        return $this;
    }

    public function getRecipientNameAttribute()
    {
        if ($this->hasParticularRecipient()) {
            return $this->recipient->first_name;
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getValue()
    {
        return $this->value_in_dollars;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }
}
