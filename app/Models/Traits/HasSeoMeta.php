<?php

namespace App\Models\Traits;

use App\Models\SeoMeta;

trait HasSeoMeta
{
    public function seo()
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }

    public function seoOrNew(): SeoMeta
    {
        return $this->seo ?? new SeoMeta();
    }
}
