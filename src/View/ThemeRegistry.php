<?php

namespace Sitebrew\View;

class ThemeRegistry
{
    protected static $themes = [];

    public static function registerThemes(array $themes)
    {
        self::$themes = array_merge(self::$themes, $themes);
    }

    public static function getThemes()
    {
        return self::$themes;
    }

    public static function getThemeBlocks(): array
    {
        $blocks = [];
        foreach (config('sitebrew.themes') as $themeName) {
            $blocks = array_merge($blocks, self::$themes[$themeName]['blocks']);
        }
        return $blocks;
    }

    public static function getThemeBlock($blockName)
    {
        foreach (config('sitebrew.themes') as $themeName) {
            if (isset(self::$themes[$themeName]['blocks'][$blockName])) {
                return self::$themes[$themeName]['blocks'][$blockName];
            }
        }
    }

    public static function getThemeBlockAttributes($templateName)
    {
        $attributes = [];
        foreach (self::getThemeBlock($templateName)['attributes'] as $key => $attribute) {
            $attributes[$key] = '';
        }
        return $attributes;
    }

    public static function getThemeTemplates()
    {
        $templates = [];
        foreach (config('sitebrew.themes') as $themeName) {
            $templates = array_merge($templates, self::$themes[$themeName]['templates']);
        }
        return $templates;
    }

    public static function getThemeTemplate($templateName)
    {
        foreach (config('sitebrew.themes') as $themeName) {
            if (isset(self::$themes[$themeName]['templates'][$templateName])) {
                return self::$themes[$themeName]['templates'][$templateName];
            }
        }
    }

    public static function getThemeTemplateAttributes($templateName)
    {
        $attributes = [];
        foreach (self::getThemeTemplate($templateName)['attributes'] as $key => $attribute) {
            $attributes[$key] = '';
        }
        return $attributes;
    }
}
