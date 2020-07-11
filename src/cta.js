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
		const screenshot      = convertflowData.screenshots[ selectField ];

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
							options={convertflowData.ctas.map( cta => {
								return {
									value: cta.value,
									label: cta.label,
								};
							} )}
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
