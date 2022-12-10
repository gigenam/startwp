module.exports = {
	env: {
		browser: true,
		es2021: true,
	},
	extends: [
		'eslint:recommended',
		'plugin:@wordpress/eslint-plugin/es5',
		'plugin:@wordpress/eslint-plugin/esnext',
	],
	parserOptions: {
		ecmaVersion: 'latest',
		sourceType: 'module',
		ecmaFeatures: {
			jsx: true,
			modules: true,
		},
	},
	rules: {
		indent: [
			'error',
		],
		'no-multi-spaces': 0,
		'no-tabs': 0,
		'no-unused-vars': 0,
		'no-undef': 0,
		'space-unary-ops': 0,
		'wrap-iife': [
			'error',
			'inside',
		],
	},
};
