import icons from './icons.js';

const { registerBlockType }        = wp.blocks;
const { SelectControl, PanelBody } = wp.components;
const { InspectorControls }        = wp.editor;

registerBlockType( 'convertflow/cta', {
	title: 'ConvertFlow CTA',
	icon: icons.convertflow,
	category: 'embed',
	supports: {
		align: [ 'wide', 'full' ],
	},
	attributes: {
		selectField: {
			type: 'string',
		},
	},

	edit( { attributes, setAttributes } ) {
		const { selectField } = attributes;
		const ctas            = convertflowData.ctas;
		const firstCta        = ctas[ Object.keys( ctas )[ 0 ] ].toString();
		const ctaOptions      = [];

		for ( const key of Object.keys( ctas ) ) {
			ctaOptions.push( {
				value: ctas[ key ],
				label: key
			} );
		}

		let screenshot = convertflowData.screenshots[ selectField ];

		if ( 1 === Object.keys( ctas ).length ) {
			screenshot = convertflowData.screenshots[ firstCta ];
		}

		if ( 'undefined' === typeof selectField ) {
			setAttributes( { selectField: firstCta } );
		}

		function onChangeSelectField( newValue ) {
			setAttributes( { selectField: newValue } );
		}

		return (
			<>
				<InspectorControls>
					<PanelBody
						title={__( 'Settings', 'convertflow' )}
						initialOpen={true}
						className={'convertflow-cta-settings'}
					>
						<SelectControl
							label={__( 'Select Call to Action', 'convertflow' )}
							value={selectField}
							options={ctaOptions}
							onChange={onChangeSelectField}
						/>
					</PanelBody>
				</InspectorControls>
				<div className={'wp-block-convertflow-cta'}>
					<img src={screenshot}/>
				</div>
			</>
		);
	},

	save( { attributes } ) {
		const { selectField } = attributes;
		const websiteID       = convertflowData.website_id;
		const classes         = 'cf-cta-snippet cta' + selectField;

		return (
			<div
				className={classes}
				website-id={websiteID}
				cta-id={selectField}
			>
			</div>
		);
	},
} );
