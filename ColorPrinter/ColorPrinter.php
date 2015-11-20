<?php

namespace ColorPrinter;

/**
 * ColorPrinter
 *
 * Static class that exposes methods to print colors to the console.
 */
class ColorPrinter
{
    /**
     * Maps the color string to its respective code (0-7)
     *
     * @var array
     */
    private static $colors = [
        'black', 'red', 'green', 'yellow', 'blue', 'magenta', 'cyan', 'white'
    ];

    /**
     * Maps the text decorations strings to their respective codes (0-4)
     *
     * @var array
     */
    private static $decos = [
        'n',  // normal
        'b',  // bold,
        'l',  // faint (not widely supported)
        'i',  // italic (not widely supported)
        'u',  // underline
    ];

    /**
     * Code used to reset all color modifications
     *
     * @var string
     */
    private static $resetCode = "\x1b[0m";

    /**
     * Given a list of modifier strings, returns the code to enable these
     *
     * @param array $mods
     *
     * @return string
     */
    private static function code($mods) {
        // merge all codes and remember where it wraps to become decos
        $modifiers = array_merge(self::$colors, self::$decos);
        $wrap = count(self::$colors);

        $codes = [];
        foreach ($mods as $mod) {
            // determine the base (decoration=10, color=30, bgcolor=40)
            $base = 30;
            if (strlen($mod) == 1) {
                $base = 10;
            } elseif (substr($mod, 0, 2) == "bg") {
                $base = 40;

                // strip "bg" from given mod
                $mod = substr($mod, 2);
            }

            // retrieve modifier index
            $index = array_search($mod, $modifiers);
            if ($index !== false) {
                $codes[] = $base + ($index % $wrap);
            }
        }

        // implicit conversion to string
        return implode(";", $codes);
    }

    /**
     * Given a string with tags, formats the strang to contain the respective
     * ANSI codes
     *
     * @param string $str
     *
     * @return string
     */
    private static function format($str)
    {
        // Grammar: <[/]mod[:mod[:mod[:...]]]>
        preg_match_all("/<(\/)?([\w:]+)>/i", $str, $tags, PREG_SET_ORDER);

        // Keep track of active modifiers
        $active = [];

        foreach ($tags as $raw) {
            $tag = $raw[0];                 // the full tag as string
            $closing = $raw[1] == "/";      // isit a closing tag?
            $mods = explode(":", $raw[2]);  // get all modifiers

            if ($closing) {
                // Remove all mods from the active mods
                $active = array_diff($active, $mods);
                // Cancel all and reapply remaining active mods
                $codes = self::code($active);
                $replacement = self::$resetCode."\x1b[{$codes}m";
            } else {
                // Update active mods with the new mods
                $active = array_merge($active, $mods);
                // Apply new codes
                $codes = self::code($mods);
                $replacement = "\x1b[{$codes}m";
            }

            // Replace in original string
            $str = str_replace($tag, $replacement, $str);
        }

        return $str;
    }

    /**
     * Formats the given string and prints it to the console
     *
     * @param $str
     */
    public static function put($str)
    {
        print self::format($str);
    }

    /**
     * Formats the given string and prints it to the console followed by a
     * color reset and a newline
     *
     * @param string|null $str
     */
    public static function putln($str = null)
    {
        self::put($str . self::$resetCode . "\n");
    }
}
