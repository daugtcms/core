<?php

namespace Sitebrew\Misc;

use Illuminate\Support\Collection;
use Sitebrew\Data\Theme\ThemeData;

class ThemeRegistry
{

    /**
     * @var Collection<string, ThemeData>
     */
    protected static Collection $themes;

    public static function registerThemes(array $themes): void
    {
        if(!isset(self::$themes)) {
            self::$themes = new Collection();
        }
        foreach ($themes as $key => $theme) {
            self::$themes->put($key, ThemeData::from($theme));
        }
    }

    /**
     * @return Collection<string, ThemeData>
     */
    public static function getThemes(): Collection
    {
        return self::$themes;
    }

    public static function getThemeBlocks(): array
    {
        $blocks = [];
        foreach (self::$themes as $theme) {
            $blocks = array_merge($blocks, $theme->blocks->toArray());
        }
        return $blocks;
    }

    public static function getThemeBlock($blockName)
    {
        foreach (self::$themes as $theme) {
            if ($theme->blocks->get($blockName) !== null) {
                return $theme->blocks->get($blockName);
            }
        }
    }

    public static function getThemeBlockAttributes($templateName)
    {
        $attributes = [];
        foreach (self::getThemeBlock($templateName)->attributes as $key => $attribute) {
            $attributes[$key] = '';
        }
        return $attributes;
    }

    public static function getThemeTemplates()
    {
        $templates = [];
        foreach (self::$themes as $theme) {
            $templates = array_merge($templates, $theme->templates->toArray());
        }
        return $templates;
    }

    public static function getThemeTemplate($templateName)
    {
        foreach (self::$themes as $theme) {
            if ($theme->templates->get($templateName) !== null) {
                return $theme->templates->get($templateName);
            }
        }
    }

    public static function getThemeTemplateAttributes($templateName)
    {
        $attributes = [];
        foreach (self::getThemeTemplate($templateName)->attributes as $key => $attribute) {
            $attributes[$key] = '';
        }
        return $attributes;
    }
}
