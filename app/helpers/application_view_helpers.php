<?php

/**
 * Alias for the HTML helper "html_encode".
 *
 * @param string A string to HTML encode.
 * @return string HTML encoded string.
 */
function h($str) {
  return html_encode($str);
}

function x($str) {
  $str = str_replace('&', '&amp;', $str);
  $str = str_replace('>', '&gt;', $str);
  $str = str_replace('<', '&lt;', $str);
  $str = str_replace('"', '&quot;', $str);
  $str = str_replace("'", '&apos;', $str);  
  return $str;
}

/**
 * For development environment, append the timestamp of static files like
 * style sheets, javascripts and so on as query string to the file path. This
 * will prevent the browser caching the file for the current session without
 * forcing a reload manually.
 *
 * @param string
 *   A public file path, like "/stylesheets/screen.css".
 *
 * @return string
 *   In development env, returns the file path but with the file timestamp
 *   appended as query string. Otherwise the path will be returned as it is.
 *
 *   Example:
 *     "/stylesheets/screen.css" => "/stylesheets/screen.css?t=1263199885"
 */
function with_timestamp_param($static_file) {
  if (is_development()) {
    $full_path_to_static_file = PUBLIC_DIR . DS . $static_file;

    if (file_exists($full_path_to_static_file)) {
      return $static_file . '?t=' . filemtime($full_path_to_static_file);
    }
  }

  return $static_file;
}

function shorten($str, $length) {
  if (strlen($str) <= $length) {
    return $str;
  }
  
  $str = substr($str, 0, $length/2) . '…' . substr($str, -($length/2));
  return $str;
}

function format_number($number) {
  return number_format($number, 0, '.', ',');
}

function markdown_to_html($markdown) {
  include_once LIB_DIR . DS . 'markdown/markdown.php';
  $html = Markdown($markdown);
  return $html;
}

function relative_date($time) {
    $today = strtotime(date('M j, Y'));
    $reldays = ($time - $today)/86400;
    if ($reldays >= 0 && $reldays < 1) {
        return 'today';
    } else if ($reldays >= 1 && $reldays < 2) {
        return 'tomorrow';
    } else if ($reldays >= -1 && $reldays < 0) {
        return 'yesterday';
    }
    if (abs($reldays) < 7) {
        if ($reldays > 0) {
            $reldays = floor($reldays);
            return 'in ' . $reldays . ' day' . ($reldays != 1 ? 's' : '');
        } else {
            $reldays = abs(floor($reldays));
            return $reldays . ' day'  . ($reldays != 1 ? 's' : '') . ' ago';
        }
    }
    if (abs($reldays) < 182) {
        return date('l, F j',$time ? $time : time());
    } else {
        return date('l, F j, Y',$time ? $time : time());
    }
}

function datetime_to_relative_date($datetime_string) {
  $timestamp = strtotime($datetime_string);
  return relative_date($timestamp);
}

# EOF