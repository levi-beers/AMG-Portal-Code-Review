<?php

namespace AMGPortal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailingResponders extends Model
{
    use HasFactory;

    protected $table = 'mailing_responders';

    public function getEmailsForCampaign($data)
    {
        $query = $this->where('list_status', 'Active')
            ->where('last_open_date', '>=', now()->subDays(90));

        foreach ($data as $condition) {
            if (count($condition) === 3) {
                list($column, $operator, $value) = $condition;
                $query->where($column, $operator, $value);
            }
        }
        return $query->get();
    }
}
