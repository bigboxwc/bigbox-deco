/**
 * External dependencies
 */
const webpack = require( 'webpack' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );
const FixStyleOnlyEntriesPlugin = require( 'webpack-fix-style-only-entries' );

const config = {
	mode: process.env.NODE_ENV === 'production' ? 'production' : 'development',
	entry: {
		app: './resources/assets/js',
		'app-css': './resources/assets/scss/style.scss',
	},
	output: {
		filename: 'public/js/[name].min.js',
		path: __dirname,
	},
	module: {
		rules: [
			{
				test: /.js$/,
				use: 'babel-loader',
				exclude: /node_modules/,
				include: /js/,
			},
			{
				test: /\.(scss|css)$/,
				use: [
					MiniCssExtractPlugin.loader,
					{
						loader: 'css-loader',
						options: {
							url: false,
						},
					},
					{
						loader: 'postcss-loader',
						options: {
							plugins: [
								require( 'autoprefixer' ),
							],
						},
					},
					{
						loader: 'sass-loader',
						query: {
							outputStyle: 'production' === process.env.NODE_ENV ? 'compressed' : 'nested',
						},
					},
				],
				exclude: /node_modules/,
				include: /scss/,
			},
		],
	},
	plugins: [
		new FixStyleOnlyEntriesPlugin(),
		new MiniCssExtractPlugin( {
			filename: './public/css/[name].min.css',
		} ),
	],
	externals: {
		'@wordpress/element': 'wp.element',
	},
};

if ( config.mode !== 'production' ) {
	config.devtool = process.env.SOURCEMAP || 'source-map';
}

module.exports = config;
