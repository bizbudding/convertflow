import icons from './icons.js';

const { __ }                       = wp.i18n;
const { registerBlockType }        = wp.blocks;
const { SelectControl, PanelBody } = wp.components;
const { InspectorControls }        = wp.editor;

registerBlockType( 'convertflow/area', {
	title: 'ConvertFlow Area',
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
		const logoUrl         = convertflowData.logo;
		const areas           = convertflowData.areas;
		const areaLabel       = areas[ selectField ];
		const areaOptions     = [];
		const imgSrc = () => {
			let imgName = 'custom';

			if ( 'Sidebar' === areas[ selectField ] ) {
				imgName = 'sidebar';
			} else if ( 'Content' === areas[ selectField ] ) {
				imgName = 'bumper';
			} else if ( 'Section' === areas[ selectField ] ) {
				imgName = 'section';
			}

			return 'https://assets.convertflow.com/images/area-' + imgName + '.png';
		};

		for ( const key of Object.keys( areas ) ) {
			areaOptions.push( {
				value: areas[ key ],
				label: key
			} );
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
						className={'convertflow-area-settings'}
					>
						<SelectControl
							label={__( 'Select Area', 'convertflow' )}
							value={selectField}
							options={areaOptions}
							onChange={onChangeSelectField}
						/>
					</PanelBody>
				</InspectorControls>
				<div className={'wp-block-convertflow-area'}>
					<img src={logoUrl} alt="ConvertFlow" width="200"/>
					<br/>
					<p>{areaLabel} {__( 'Area', 'convertflow' )}</p>
					<img src={imgSrc()} alt={areaLabel} width="220"/>
				</div>
			</>
		);
	},

	save( { attributes } ) {
		const { selectField } = attributes;
		const classes         = 'cf-' + convertflowData.website_id + '-area-' + selectField;

		return (
			<div className={classes}/>
		);
	},
} );
