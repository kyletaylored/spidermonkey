<?php
require_once __DIR__ . '/vendor/autoload.php';

use NestedJsonFlattener\Flattener\Flattener;

$dataJson = '{
    "ab": false,
    "ab_variation": false,
    "absolute_url": "https://www.lever.co/-temporary-slug-c6024f28-b847-4461-9394-ea2065f3fb93",
    "analytics_page_id": "4297425504",
    "analytics_page_type": "landing-page",
    "archived": false,
    "attached_stylesheets": [],
    "author": "akavanagh@newbreedmarketing.com",
    "author_at": 1472074558054,
    "author_email": "akavanagh@newbreedmarketing.com",
    "author_name": "Alex Kavanagh",
    "author_user_id": 761469,
    "author_username": "akavanagh@newbreedmarketing.com",
    "blueprint_type_id": 0,
    "category": 1,
    "category_id": 1,
    "content_type_category": 1,
    "content_type_category_id": 1,
    "created": 1472074558054,
    "created_by_id": 761469,
    "created_time": 1472074558054,
    "css": {},
    "css_text": "",
    "ctas": null,
    "current_state": "DRAFT",
    "currently_published": false,
    "deleted_at": 0,
    "domain": "",
    "featured_image": "",
    "featured_image_alt_text": "",
    "featured_image_height": 0,
    "featured_image_length": 0,
    "featured_image_width": 0,
    "flex_areas": {},
    "freeze_date": 1472074558054,
    "has_user_changes": true,
    "id": 4297425504,
    "is_draft": true,
    "is_published": false,
    "keywords": [],
    "label": "confirmation test",
    "landing_page": true,
    "layout_sections": {},
    "live_domain": "www.lever.co",
    "mab": false,
    "mab_master": false,
    "mab_variant": false,
    "meta": {
        "style_override_id": null,
        "campaign_name": null,
        "author_email": "akavanagh@newbreedmarketing.com",
        "author_username": "akavanagh@newbreedmarketing.com",
        "author_user_id": 761469,
        "has_user_changes": true,
        "last_edit_session_id": null,
        "last_edit_update_id": null
    },
    "name": "confirmation test",
    "page_redirected": false,
    "past_mab_experiment_ids": [],
    "personas": [],
    "placement_guids": [],
    "portal_id": 463671,
    "preview_key": "JHYLzyxN",
    "processing_status": "",
    "public_access_rules": [],
    "public_access_rules_enabled": false,
    "publish_date": 0,
    "publish_date_local_time": 0,
    "published_url": "",
    "resolved_domain": "www.lever.co",
    "site_page": false,
    "slug": "-temporary-slug-c6024f28-b847-4461-9394-ea2065f3fb93",
    "state": "DRAFT",
    "subcategory": "landing_page",
    "team_perms": [],
    "template_path": "generated_layouts/4477022415.html",
    "template_path_for_render": "generated_layouts/4477022415.html",
    "translated_content": {},
    "tweet_immediately": false,
    "unpublished_at": 0,
    "updated": 1472074558054,
    "updated_by_id": 761469,
    "upsize_featured_image": false,
    "url": "https://www.lever.co/-temporary-slug-c6024f28-b847-4461-9394-ea2065f3fb93",
    "use_featured_image": false,
    "user_perms": [],
    "widget_containers": {},
    "widgetcontainers": {},
    "widgets": {},
    "body": ""
}';

$flattener = new Flattener();
$flattener->setJsonData($dataJson);
$flattener->writeCsv("nameofCSV");
$flat = $flattener->getFlatData();
$json_flat = json_encode($flat);
krumo($json_flat);