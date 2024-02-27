<?php

namespace Sitebrew\Misc;

use Illuminate\Support\Collection;
use Sitebrew\Data\Content\ContentTypeData;
use Sitebrew\Data\Theme\TemplateUsageData;

class TemplateUsageRegistry
{

    /**
     * @var Collection<string, TemplateUsageData>
     */
    protected static Collection $templateUsages;

    public static function registerTemplateUsages(array $templateUsages): void
    {
        if(!isset(self::$templateUsages)) {
            self::$templateUsages = new Collection();
        }
        foreach ($templateUsages as $key => $templateUsage) {
            self::$templateUsages->put($key, TemplateUsageData::from($templateUsage));
        }
    }

    public static function getTemplateUsages(): Collection
    {
        $usages = self::$templateUsages;

        ContentTypeRegistry::getContentTypes()->each(function (ContentTypeData $contentType, string $key) use(&$usages){
            $usages->put($key, TemplateUsageData::from([
                'name' => $contentType->name
            ]));

            if($contentType->listable) {
                $usages->put($key . '_list', TemplateUsageData::from([
                    'name' => __('sitebrew::blocks.content_type_list', ['contentType' => $contentType->name])
                ]));
                $usages->put($key . '_card', TemplateUsageData::from([
                    'name' => __('sitebrew::blocks.content_type_card', ['contentType' => $contentType->name])
                ]));
            }
        });

        return $usages;
    }
}
