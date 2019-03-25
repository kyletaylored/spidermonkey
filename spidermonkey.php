<?php
require_once __DIR__ . '/vendor/autoload.php';

use NestedJsonFlattener\Flattener\Flattener;
use PhpQuery\PhpQuery;
use SimpleHtmlDom as SHD;

class Spidermonkey {

  /**
   * Utilities
   */
  public $flattener;
  public $request_options;

  /**
   * Set up configuration
   */
  public $baseurl = "https://api.hubapi.com";
  public $hapikey;
  public $get_blogs = "/content/api/v2/blogs";
  public $get_blog_by_id = "/content/api/v2/blog-posts/:blog_post_id";
  public $get_pages = "/content/api/v2/pages";
  public $get_page_by_id = "/content/api/v2/pages/";
  /**
   * Any page attribute that needs to be extracted from the page object.
   * All others will be removed before saved.
   */
  public $page_keys;

  function  __construct() {
    // Create flattener.
    $this->flattener = new Flattener();

    // Load ENV
    $dotenv = Dotenv\Dotenv::create(__DIR__);
    $dotenv->load();

    // Hubspot API key
    $this->hapikey = getenv('HUBSPOT_API');

    // Default options.
    $this->request_options = [
      'hapikey' => $this->hapikey,
      'is_draft' => 'false',
    ];

    $this->page_keys = [
      'absolute_url' => "",
      'archived' => "",
      'author' => "",
      'author_at' => "",
      'author_email' => "",
      'author_name' => "",
      'author_username' => "",
      'author_user_id' => "",
      'category' => "",
      'category_id' => "",
      'content_type_category' => "",
      'content_type_category_id' => "",
      'created' => "",
      'created_by_id' => "",
      'css_text' => "",
      'currently_published' => "",
      'html_title' => "",
      'id' => "",
      'label' => "",
      'name' => "",
      'page_title' => "",
      'published_url' => "",
      'publish_date' => "",
      'site_page' => "",
      'slug' => "",
      'subcategory' => "",
      'title' => "",
      'updated' => "",
      'updated_by_id' => "",
      'url' => "",
    ];
  }

  public function getBody($content) {
    $dom = SHD\str_get_html($content);
    $styles = ($s = $dom->find('style#hs_editor_style', 0)) ? $s->outerText() : '';
    $body = ($d = $dom->find('body > div.body-container-wrapper', 0)) ? $d->outerText() : '';
    return $styles . $body;
  }

  public function getPages($offset = 0, $limit = 300) {
    $this->request_options['offset'] = (is_numeric($offset)) ? $offset : 0;
    $this->request_options['limit'] = (is_numeric($limit)) ? $limit : 300;
    try {
      $params = http_build_query($this->request_options);
      $pages = file_get_contents($this->baseurl . $this->get_pages . "?" . $params);
      return $pages;
    } catch (Exception $e) {
      print_r($e);
      return NULL;
    }
  }

  public function fetchPage($url){
    try {
      $request = Requests::get($url);
      return $request;
    } catch (Exception $e) {
      return NULL;
    }
  }

  public function checkPageKey($key = NULL) {
    if (!empty($key) && isset($this->page_keys[$key])) {
      return TRUE;
    }
    return FALSE;
  }

  public function cleanKeys(&$arr) {
    foreach ($arr as $k => $v) {
      if (!$this->checkPageKey($k)) {
        unset($arr[$k]);
      }
    }
    return $arr;
  }

}