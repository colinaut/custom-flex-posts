( function( blocks, components, data, editor, element, i18n ) {
	var el = element.createElement;
	var __ = i18n.__;

	blocks.registerBlockType( 'flex-posts/list', {
		title: __( 'Flex Posts', 'flex-posts' ),

		icon: 'grid-view',

		category: 'widgets',

		attributes: {
			layout: {
				type: 'number',
				default: 1
			},
			title: {
				type: 'string',
				default: ''
			},
			cat: {
				type: 'string',
				default: ''
			},
			tag: {
				type: 'string',
				default: ''
			},
			order_by: {
				type: 'string',
				default: 'newest'
			},
			number: {
				type: 'number',
				default: 4
			},
			skip: {
				type: 'number',
				default: 0
			},
			show_categories: {
				type: 'boolean',
				default: false
			},
			show_author: {
				type: 'boolean',
				default: false
			},
			show_date: {
				type: 'boolean',
				default: true
			},
			show_comments: {
				type: 'boolean',
				default: true
			},
			show_excerpt: {
				type: 'boolean',
				default: false
			}
		},

		edit: function( props ) {
			var attr = props.attributes;
			return [
				el( components.ServerSideRender, {
					block: 'flex-posts/list',
					attributes: props.attributes
				} ),
				el(
					editor.InspectorControls,
					{ key: 'inspector' },
					el(
						components.PanelBody,
						{
							title: __( 'Flex Posts Settings', 'flex-posts' ),
							initialOpen: true
						},
						el(
							components.SelectControl,
							{
								label: 'Layout',
								options: [
									{ value: 1, label: __( 'Layout 1', 'flex-posts' ) },
									{ value: 2, label: __( 'Layout 2', 'flex-posts' ) },
									{ value: 3, label: __( 'Layout 3', 'flex-posts' ) },
									{ value: 4, label: __( 'Layout 4', 'flex-posts' ) },
								],
								value: attr.layout,
								onChange: function( val ) {
									props.setAttributes( { layout: parseInt( val ) } )
								}
							}
						),
						el(
							components.TextControl,
							{
								type: 'text',
								label: __( 'Title', 'flex-posts' ),
								value: attr.title,
								onChange: function( val ) {
									props.setAttributes( { title: val } )
								}
							}
						),
						el(
							components.SelectControl,
							{
								label: __( 'Filter by category', 'flex-posts' ),
								value: attr.cat,
								options: custom_flex_posts.categories,
								onChange: function( val ) {
									props.setAttributes( { cat: val } )
								}
							}
						),
						el(
							components.TextControl,
							{
								type: 'text',
								label: __( 'Filter by tag(s)', 'flex-posts' ),
								value: attr.tag,
								onChange: function( val ) {
									props.setAttributes( { tag: val } )
								}
							}
						),
						el(
							components.SelectControl,
							{
								label: __( 'Order by', 'flex-posts' ),
								value: attr.order_by,
								options: [
									{ value: 'newest', label: __( 'Newest', 'flex-posts' ) },
									{ value: 'oldest', label: __( 'Oldest', 'flex-posts' ) },
									{ value: 'comments', label: __( 'Most commented', 'flex-posts' ) },
									{ value: 'title', label: __( 'Alphabetical', 'flex-posts' ) },
									{ value: 'random', label: __( 'Random', 'flex-posts' ) }
								],
								onChange: function( val ) {
									props.setAttributes( { order_by: val } )
								}
							}
						),
						el(
							components.RangeControl,
							{
								label: __( 'Number of posts to show', 'flex-posts' ),
								value: attr.number,
								min: 1,
								max: 20,
								onChange: function( val ) {
									props.setAttributes( { number: val } )
								}
							}
						),
						el(
							components.RangeControl,
							{
								label: __( 'Number of posts to skip', 'flex-posts' ),
								value: attr.skip,
								min: 0,
								max: 20,
								onChange: function( val ) {
									props.setAttributes( { skip: val } )
								}
							}
						),
						el(
							components.CheckboxControl,
							{
								label: __( 'Show categories', 'flex-posts' ),
								checked: attr.show_categories,
								onChange: function( val ) {
									props.setAttributes( { show_categories: val } )
								}
							}
						),
						el(
							components.CheckboxControl,
							{
								label: __( 'Show author', 'flex-posts' ),
								checked: attr.show_author,
								onChange: function( val ) {
									props.setAttributes( { show_author: val } )
								}
							}
						),
						el(
							components.CheckboxControl,
							{
								label: __( 'Show date', 'flex-posts' ),
								checked: attr.show_date,
								onChange: function( val ) {
									props.setAttributes( { show_date: val } )
								}
							}
						),
						el(
							components.CheckboxControl,
							{
								label: __( 'Show comments number', 'flex-posts' ),
								checked: attr.show_comments,
								onChange: function( val ) {
									props.setAttributes( { show_comments: val } )
								}
							}
						),
						el(
							components.CheckboxControl,
							{
								label: __( 'Show excerpt', 'flex-posts' ),
								checked: attr.show_excerpt,
								onChange: function( val ) {
									props.setAttributes( { show_excerpt: val } )
								}
							}
						)
					)
				)
			];
		},

		save: function() {
			// Rendering in PHP
			return null;
		},
	} );
} )(
	window.wp.blocks,
	window.wp.components,
	window.wp.data,
	window.wp.editor,
	window.wp.element,
	window.wp.i18n
);
