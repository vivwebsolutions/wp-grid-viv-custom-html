# WP Grid Builder ViV Custom HTML Facet

Adds a Custom HTML facet type to WP Grid Builder. Inject arbitrary HTML into the grid sidebar.

## Requirements

- WordPress 5.2+
- PHP 7.2+
- [WP Grid Builder](https://wpgridbuilder.com/)
- [WP Grid Builder ViV Addon](https://github.com/vivwebsolutions/wp-grid-viv-addon)

## Installation

1. Upload the plugin folder to `/wp-content/plugins/`
2. Activate the plugin through the Plugins menu in WordPress
3. The plugin auto-registers with the ViV Addon plugin registry (`vivgb_data` option)

## How it works

On activation, the plugin registers itself in the `vivgb_data` WordPress option. The facet type is registered with WP Grid Builder via the `wp_grid_builder/facets` filter.

## Development notes for future agents

- The plugin follows the standard ViV plugin pattern (see wp-grid-viv-facet-tooltips as reference)
- CSS/JS must be injected via `wp_footer` in normal WP context (not in AJAX response)
- The `VIVGB_ON_PAGE` constant signals that a ViV grid is present on the page

## Live Demo

[https://p1glossary.wpenginepowered.com/resources-grid/](https://p1glossary.wpenginepowered.com/resources-grid/) — Resources Grid uses custom HTML facets in the sidebar.

