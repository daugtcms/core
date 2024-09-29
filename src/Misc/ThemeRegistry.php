<?php

namespace Daugt\Misc;

use Daugt\Data\Theme\ThemeData;
use Daugt\Enums\Content\ContentGroup;
use Illuminate\Support\Collection;

class ThemeRegistry
{
    /**
     * @var Collection<string, ThemeData>
     */
    protected static Collection $themes;

    public static function registerThemes(array $themes): void
    {
        if (! isset(self::$themes)) {
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

    public static function getThemeBlockByGroup(ContentGroup $group) {
        $blocks = collect();
        foreach (self::$themes as $theme) {
            foreach ($theme->blocks as $key => $block) {
                if (isset($block->groups) && in_array($group, $block->groups)) {
                    $blocks->put($key, $block);
                }
            }
        }

        return $blocks;
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

    public static function getThemeTemplatesByUsage($usage)
    {
        $templates = [];
        foreach (self::$themes as $theme) {
            foreach ($theme->templates as $key => $template) {
                if (!isset($template->usages) || in_array($usage, $template->usages)) {
                    $templates[$key] = $template;
                }
            }
        }
        return $templates;
    }

    public static function getDefaultTemplate($usage)
    {
        $templates = self::getThemeTemplatesByUsage($usage);
        return array_key_first($templates);
    }
}
