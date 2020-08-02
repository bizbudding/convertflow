# ConvertFlow

Connects your WordPress site to your ConvertFlow account 

## Installation

1. Download the plugin ZIP file [here](https://github.com/bizbudding/convertflow/archive/master.zip)
2. Upload plugin ZIP file from Plugins > Add New
3. Activate the plugin from the Plugins page

## Usage

1. From the admin screen, navigate to the ConverFlow page
2. Enter API Key and Website ID (available from the Integrations page from your ConvertFlow account)
3. Click Connect
4. The ConvertFlow Install Code script will now be output on the front end of your site
5. Two new blocks will now be available in the WordPress editor:
 - ConvertFlow CTA
 - ConvertFlow Area

## Development

### Requirements

- Node v12.18.2+
- NPM v6.14.5+

If using (nvm)[https://github.com/nvm-sh/nvm], run the following command to update to the latest Node version:

`nvm use --lts`

### Build

1. From the plugin root directory, run `npm install` to install dependencies
2. Run `npm run build` to compile scripts

Proudly developed by BizBudding Inc. and ConvertFlow Inc.
https://bizbudding.com

### i18n

To generate the translatable POT file, run the following WP CLI command from the plugin root directory:

`wp i18n make-pot . assets/lang/convertflow.pot`
