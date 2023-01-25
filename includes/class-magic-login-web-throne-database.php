<?php
class Mll_Database {

    /**
	 * Create new column in DB (wp_users) for token store
	 * Check later for /maybe_add_column( $queried_table, 'user_token', "ALTER TABLE $queried_table ADD user_token TEXT DEFAULT ''" );/
	 * @since    1.0.0
	 */
	public function mll_new_table_column() {

		global $wpdb;
		$queried_table = "{$wpdb->prefix}users";
		$query = $wpdb->get_results("SELECT mll_user_token FROM $queried_table");
	
		if( empty($query) ){
			$wpdb->query("ALTER TABLE $queried_table ADD mll_user_token TEXT DEFAULT ''");
		}

	}

    /**
	 * Delete new column in DB (wp_users) for token store
	 * @since    1.0.0
	 */
	public function mll_delete_new_table_column() {

		// global $wpdb;
		// $queried_table = "{$wpdb->prefix}users";
		// $query = $wpdb->get_results("SELECT mll_user_token FROM $queried_table");
	
		// if( empty($query) ){
		// 	$wpdb->query("ALTER TABLE $queried_table ADD mll_user_token TEXT DEFAULT ''");
		// }

	}

}