<?php
/**
 * ヘルパーブロックパターンの登録処理
 * 
 * @package ruijinen-block-patterns
 * @author mgn
 * @license GPL-2.0+
 */

namespace Ruijinen\Pattern\HelperPattern;

class RegisterHelperPatterns {

	public function __construct() {
		define( 'RJE_R000HELPER_KEY', 'RJE_R000HELPER' ); // どの類人猿プロダクトなのかを示すキー
		$this->init();
	}

	/**
	 * ブロックパターンの登録に関する処理を実行する
	 */
	public function init() {
		add_action( 'init', array( $this, 'register_pattern_cat' ), 10 ); //パターンカテゴリー登録
		add_action( 'plugins_loaded', array( $this, 'register_add_pettern_args' ) ); //ヘルパーパターンの情報を追加

		//ヘルパーパターン共通のスタイルを読み込む
		// add_action(
		// 	'wp_enqueue_scripts',
		// 	function () {
		// 		$path = 'dist/css/sample-pattern-common.css';
		// 		wp_enqueue_style( RJE_R000HELPER_KEY . 'sample-pattern-common', RJE_BP_PLUGIN_URL . $path, array( 'snow-monkey', 'snow-monkey-blocks', 'snow-monkey-snow-monkey-blocks', 'snow-monkey-blocks-background-parallax' ), filemtime( RJE_BP_PLUGIN_PATH . $path ) );
		// 	},
		// 	10
		// );
		// add_action(
		// 	'enqueue_block_editor_assets',
		// 	function () {
		// 		$path = 'dist/css/sample-pattern-common.css';
		// 		wp_enqueue_style( RJE_R000HELPER_KEY . 'sample-pattern-common', RJE_BP_PLUGIN_URL . $path,  array( 'snow-monkey-snow-monkey-blocks-editor' ), filemtime( RJE_BP_PLUGIN_PATH . $path ) );
		// 	},
		// 	10
		// );
	}

	/**
	* ヘルパーパターンのカテゴリを登録
	*/
	public function register_pattern_cat () {
		register_block_pattern_category( RJE_R000HELPER_KEY, array( 'label' => '[類人猿] ヘルパー' ) );
	}

	/**
	* ヘルパーパターンの情報を追加
	*/
	public function register_add_pettern_args() {
		add_filter( 'rje_register_patterns_args', array( $this, 'rje_r000helper_fullwidth_min_padding' ), 10 );
		add_filter( 'rje_register_patterns_args', array( $this, 'rje_r000helper_enforcement_fullwidth' ), 10 );
	}
	public function rje_r000helper_fullwidth_min_padding ( $args ) {
		$args[] = array(
			'key'            => RJE_R000HELPER_KEY . '_fullwidth_min_padding',
			'title'          => 'フル幅時に最低限余白を保持',
			'cat'            => array( RJE_R000HELPER_KEY ),
			'specific-style' => false,
			'block-style'    => array( RJE_R000HELPER_KEY . '_fullwidth_min_padding' ),
			'path'           => RJE_BP_PLUGIN_PATH,
		);
		return $args;
	}
	public function rje_r000helper_enforcement_fullwidth ( $args ) {
		$args[] = array(
			'key'            => RJE_R000HELPER_KEY . '_enforcement_fullwidth',
			'title'          => '強制的にフル幅にする',
			'cat'            => array( RJE_R000HELPER_KEY ),
			'specific-style' => false,
			'block-style'    => array( RJE_R000HELPER_KEY . '_enforcement_fullwidth' ),
			'path'           => RJE_BP_PLUGIN_PATH,
		);
		return $args;
	}
}

new RegisterHelperPatterns();