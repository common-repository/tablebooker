<div>
<h2>tablebooker</h2>
<p><?php _e('Set up the tablebooker plugin.', 'tablebooker') ?></p>
<form action="options.php" method="post">
<?php settings_fields('tablebooker_options'); ?>
<?php do_settings_sections('tablebooker'); ?>
<?php submit_button(); ?>
</form></div>