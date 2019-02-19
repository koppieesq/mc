# Master of Ceremonies
[![github](https://img.shields.io/badge/github-0a0.svg?logo=github)](https://github.com/koppieesq/mc)
[![packagist](https://img.shields.io/badge/packagist-orange.svg?logo=php&logoColor=white)](https://packagist.org/packages/koppie/mc)
[![License](https://img.shields.io/badge/license-GPL3-teal.svg?logo=gnu)](LICENSE)

Plugin for [Robo](https://robo.li).

The MC greets you and tells you what's up.  They do it with flair, and they make you feel glad you're here.

## Contents:

MC is a collection of next-generation output styles and interactions for your command line.

### check_success

Checks your task stack and lets you know whether it succeeded.

**Usage:** `check_success($result, $string)`
$result = the task stack result object
$string = human description to be repeated back to the user

### check_app

Check if an app exists.  If it doesn't, replace with `echo`.

**Usage:** `check_app($name)`

### stopwatch

Tell the user how long your script took to complete.  Use `time()` to get the start time when you start, and pass it to `stopwatch()` when your script ends.

**Usage:** `stopwatch($start_time)`

### catlet

The Master of Ceremonies' crown jewel: Catlet!  It's a combination of `lolcat` and `figlet`.  Renders your string as a colorful title banner.  Example:
```
   _   _      _ _        __        __         _     _
  | | | | ___| | | ___   \ \      / /__  _ __| | __| |
  | |_| |/ _ \ | |/ _ \   \ \ /\ / / _ \| '__| |/ _` |
  |  _  |  __/ | | (_) |   \ V  V / (_) | |  | | (_| |
  |_| |_|\___|_|_|\___/     \_/\_/ \___/|_|  |_|\__,_|
```
But, like, with color.  It's awesome, man.

**Usage:** `catlet($string)`

### intro

The MC's grand introduction.  Includes banner, welcome message, list of steps, and confirmation prompt.

**Usage:** `intro($banner, $message, $list)`
$banner = short intro title
$message = plain text welcome message under the banner
$list = list of steps that your script will perform

### tput

Output text in color.  Great for emphasizing something in a block of plain text.  This is a php wrapper for the `tput` command line tool.

Colors:
* black
* red
* green
* yellow
* blue
* magenta
* cyan
* white

**Usage:** `tput($string, $color)`
      
# Roadmap

Add tutorial creating & using plugins:
* Rewrite what's currently there, but with:
  * reorder
  * more formatting (headers, &c.)
  * change tone (less technical, active voice)
  * links to other things
  * demo code snippets: composer.json
  * point to example file
* second page: how to USE plugins (stub for now?)
      
# Credits

Brought to you by [Jordan Koplowicz](http://koplowiczandsons.com).  
With gratitude to [Greg Andersen](https://github.com/g1a/starter).  
This software is free to use, modify, and distribute under the GPL 3 license.
