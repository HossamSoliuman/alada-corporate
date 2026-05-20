<?php

namespace App\Services;

use App\Models\SeoMeta;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;

class SeoService
{
    /**
     * Build the SEO data array for a given model (or fallback to site defaults).
     */
    public function for(Model $model): array
    {
        $seo      = $model->seo ?? new SeoMeta();
        $siteName = Setting::get('site_name', config('app.name'));
        $current  = url()->current();

        return [
            'title'              => $seo->meta_title       ?? $this->defaultTitle($model, $siteName),
            'description'        => $seo->meta_description ?? Setting::get('meta_description', ''),
            'keywords'           => $seo->meta_keywords    ?? '',
            'canonical'          => $seo->canonical_url    ?? $current,
            'og_title'           => $seo->og_title         ?? $seo->meta_title ?? $this->defaultTitle($model, $siteName),
            'og_description'     => $seo->og_description   ?? $seo->meta_description ?? '',
            'og_image'           => $seo->og_image         ?? Setting::get('default_og_image', ''),
            'twitter_title'      => $seo->twitter_title    ?? $seo->og_title ?? '',
            'twitter_description'=> $seo->twitter_description ?? $seo->og_description ?? '',
            'twitter_image'      => $seo->twitter_image    ?? $seo->og_image ?? '',
            'robots'             => $seo->robots           ?? 'index,follow',
            'schema_json'        => $seo->schema_json      ?? null,
            'site_name'          => $siteName,
        ];
    }

    /**
     * Upsert the SeoMeta row for a model from request data.
     */
    public function saveFor(Model $model, array $data): SeoMeta
    {
        return $model->seo()->updateOrCreate(
            ['seoable_type' => get_class($model), 'seoable_id' => $model->id],
            array_filter([
                'meta_title'          => $data['meta_title']          ?? null,
                'meta_description'    => $data['meta_description']    ?? null,
                'meta_keywords'       => $data['meta_keywords']       ?? null,
                'canonical_url'       => $data['canonical_url']       ?? null,
                'og_title'            => $data['og_title']            ?? null,
                'og_description'      => $data['og_description']      ?? null,
                'og_image'            => $data['og_image']            ?? null,
                'twitter_title'       => $data['twitter_title']       ?? null,
                'twitter_description' => $data['twitter_description'] ?? null,
                'twitter_image'       => $data['twitter_image']       ?? null,
                'robots'              => $data['robots']              ?? 'index,follow',
            ], fn($v) => $v !== null)
        );
    }

    public function generateJsonLdOrganization(): string
    {
        $data = [
            '@context' => 'https://schema.org',
            '@type'    => 'Organization',
            'name'     => Setting::get('site_name', config('app.name')),
            'url'      => config('app.url'),
            'logo'     => Setting::get('logo_url', ''),
            'contactPoint' => [
                '@type'       => 'ContactPoint',
                'telephone'   => Setting::get('phone', ''),
                'contactType' => 'customer service',
            ],
            'sameAs' => array_filter([
                Setting::get('social_facebook', ''),
                Setting::get('social_twitter', ''),
                Setting::get('social_linkedin', ''),
                Setting::get('social_instagram', ''),
            ]),
        ];
        return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public function generateJsonLdArticle(mixed $blog): string
    {
        $data = [
            '@context'        => 'https://schema.org',
            '@type'           => 'Article',
            'headline'        => $blog->title,
            'description'     => $blog->excerpt ?? '',
            'image'           => $blog->featured_image ? asset('storage/' . $blog->featured_image) : '',
            'datePublished'   => $blog->published_at?->toIso8601String(),
            'dateModified'    => $blog->updated_at->toIso8601String(),
            'author'          => [
                '@type' => 'Person',
                'name'  => $blog->author?->name ?? Setting::get('site_name'),
            ],
            'publisher'       => [
                '@type' => 'Organization',
                'name'  => Setting::get('site_name', config('app.name')),
                'logo'  => ['@type' => 'ImageObject', 'url' => Setting::get('logo_url', '')],
            ],
        ];
        return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public function generateBreadcrumbSchema(array $items): string
    {
        $listItems = [];
        foreach ($items as $position => $item) {
            $listItems[] = [
                '@type'    => 'ListItem',
                'position' => $position + 1,
                'name'     => $item['name'],
                'item'     => $item['url'] ?? '',
            ];
        }
        return json_encode([
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => $listItems,
        ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    private function defaultTitle(Model $model, string $siteName): string
    {
        $title = $model->title ?? $model->name ?? $siteName;
        return "{$title} | {$siteName}";
    }
}
