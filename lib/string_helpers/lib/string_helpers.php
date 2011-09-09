<?php

function str_is_empty($str) {
  return (str_length($str) === 0);
}

function str_length($str) {
  if (function_exists('mb_strlen')) {
    return mb_strlen($str);
  }

  return strlen($str);
}

function str_begins_with($str, $start_str) {
  return str_starts_with($str, $start_str);
}

function str_starts_with($str, $start_str) {
  return(strpos($str, $start_str) === 0);
}

function str_ends_with($str, $end_str) {
  return(preg_match('|' . preg_quote($end_str) . '$|', $str));
}

function str_prepend_string($str, $prepend_str) {
    return $this->str = $str . $this->str;
}

function str_append_string($str) {
    return $this->str .= $str;
}

function str_preprend_string_once() {

}

function str_append_string_once() {

}

function str_contains($str, $search_str) {
  return (strstr($str, $search_str) != false);
}

function str_equals($str_a, $str_b) {
  return (strcmp($str_a, $str_b) == 0);
}

function str_make_teaser_from_string() {

}

function str_excerpt() {

}

function str_truncate($str, $length, $symbol = '…') {
  if(strlen($str) > $length) {
    $str = substr($str, 0, $length) . $symbol;
  }

  return $str;
}

function str_html_encode() {

}

function str_with_leading_slash() {
  /*if(string_begins_with($value, '/')) {
    $value = substr($value, 1);
  }

  return $value;*/
}

function str_without_leading_slash() {
  /*if(!string_begins_with($value, '/')) {
    $value = '/' . $value;
  }

  return $value;*/
}

function str_without_trailing_slash() {
  //return(string_ends_with($value, '/') ? substr($value, 0, -1) : $value);
}

function str_with_trailing_slash() {
  //return(string_ends_with($value, '/') ? $value : $value . '/');
}

function str_insert_string_at_index() {

}

function str_with_http() {

}

/**
 * Converts some string to a friendly filename format, consisting only of
 * lowercase characters, underscore, dash and no special chars.
 *
 * NOTE: This function uses the mbstring extension to handle multibyte
 * string encodings. If it is not installed, the caller is responsible to
 * decode the string appropiately first (e.g. utf8_decode).
 *
 * @example
 *  "Some ugly FileName.txt" => "some_ugly_filename.txt"
 *  "Glückwunsch, lieber Dieter!.pdf" => "glueckwunsch_lieber_dieter.pdf"
 *
 * @param $str Some string
 * @return string Typical filename-friendly string
 */
function str_nice_filename($str) {
  if (function_exists('mb_strtolower') && function_exists('mb_detect_encoding')) {
    $str = mb_strtolower($str, mb_detect_encoding($str));
  } else {
    $str = strtolower($str);
  }

  $find_and_replace = array(
    '/ {1,}/' => '_',
    '/-/' => '_',
    '/ä/' => 'ae',
    '/ö/' => 'oe',
    '/ü/' => 'ue',
    '/ß/' => 'ss',
    "/[^\w\d\/\.]/" => ''
  );

  $find = array_keys($find_and_replace);
  $replace = array_values($find_and_replace);
  return preg_replace($find, $replace, $str);
}

/**
 * Converts the string into a URL friendly format.
 *
 * NOTE: This function uses the mbstring extension to handle multibyte
 * string encodings. If it is not installed, the caller is responsible to
 * decode the string appropiately first (e.g. utf8_decode).
 *
 * @example
 *  "Some title with dash - and so on..." => "some-title-with-dash-and-so-on"
 *
 * @param string Some string
 * @return string URL-friendly formatted name.
 */
function str_nice_url_name($str) {
  if (function_exists('mb_strtolower') && function_exists('mb_detect_encoding')) {
    $str = mb_strtolower($str, mb_detect_encoding($str));
  } else {
    $str = strtolower($str);
  }

  $find_and_replace = array(
    '/ {1,}/' => '-',
    '/[_]/' => '-',
    '/ä/' => 'ae',
    '/ö/' => 'oe',
    '/ü/' => 'ue',
    '/ß/' => 'ss',
    "/[^\w\d\-]/" => '',
    '/-{2,}/' => '-'
  );

  $find = array_keys($find_and_replace);
  $replace = array_values($find_and_replace);

  return preg_replace($find, $replace, $str);
}

function str_capitalize($str) {
  return ucwords($str);
}

function str_decapitalize($str) {
  $str[0] = lower_case($str[0]);
  return $str;
}

function str_camelize($str) {
  $str = str_replace(" ", "", ucwords(str_replace("_", " ", $str)));

  if(isset($str[0])) {
    $str[0] = strtolower($str[0]);
  }

  return $str;
}

/**
 * Converts a string to lowercase.
 *
 * NOTE: This function uses the mbstring extension to handle multibyte
 * string encodings. If it is not installed, the caller is responsible to
 * decode the string appropriately first (e.g. utf8_decode).
 *
 * @param string Some string
 * @return string The string converted to lowercase
 */
function str_lowercase($str) {
  if (function_exists('mb_strtolower') && function_exists('mb_detect_encoding')) {
    $str = mb_strtolower($str, mb_detect_encoding($str));
  } else {
    $str = strtolower($str);
  }

  return $str;
}

function str_uppercase($str) {
  if (function_exists('mb_strtoupper') && function_exists('mb_detect_encoding')) {
    $str = mb_strtoupper($str, mb_detect_encoding($str));
  } else {
    $str = strtoupper($str);
  }

  return $str;
}

function str_underscores($str) {
  $str = strtolower(preg_replace('/(?<=\\w)([A-Z])/', '_\\1', $str));
  return $str;
}

function str_is_absolute_path($path) {

}

function str_last_path_component($path) {

}

function str_path_extension($path) {

}

function str_path_components($path) {

}

function str_substring_from_first_string_occurence($str, $search_str) {

}

function str_substring_from_last_string_occurence($str, $search_str) {

}

function str_substring_to_first_string_occurence($str, $search_str) {

}

function str_substring_to_last_string_occurence($str, $search_str) {

}

function str_substring_from_index($str, $index) {

}

function str_substring_to_index($str, $index) {

}

function str_append_path_component() {

}

function str_append_path_extension($extension) {
  return $this->str .= $extension;
}

function str_delete_last_path_component() {

}

function str_delete_path_extension() {

}

function str_reverse_string($str) {

}

function str_pad_left($str, $length, $char) {
  return str_pad($str, $length, $char, STR_PAD_LEFT);
}

function str_leading_zeroes($str, $length) {
  return str_pad($str, $length, '0', STR_PAD_LEFT);
}