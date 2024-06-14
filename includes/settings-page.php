<?php
function lightning_border_settings_page() {
    ?>
    <div class="wrap">
        <h1>Lightning Border Einstellungen</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('lightning_border_settings_group');
            do_settings_sections('lightning_border_settings_group');
            ?>
            <table class="form-table">
                <tr valign="top">
                <th scope="row">Blitzfarbe</th>
                <td>
                    <input type="text" name="lightning_color" value="<?php echo esc_attr(get_option('lightning_color', 'white')); ?>" />
                    <p class="description">Geben Sie die Farbe des Blitzes ein. Standardwert ist "weiß".</p>
                </td>
                </tr>
                
                <tr valign="top">
                <th scope="row">Häufigkeit (in Sekunden)</th>
                <td>
                    <input type="number" step="0.1" name="lightning_frequency" value="<?php echo esc_attr(get_option('lightning_frequency', 5)); ?>" />
                    <p class="description">Bestimmt, wie oft die Blitze erscheinen. Werte zwischen 0,1 und 5 Sekunden sind empfehlenswert.</p>
                </td>
                </tr>
                
                <tr valign="top">
                <th scope="row">Abstand von der Mitte (als Bruchteil der Bildschirmbreite)</th>
                <td>
                    <input type="number" step="0.01" name="lightning_offset" value="<?php echo esc_attr(get_option('lightning_offset', 0.4)); ?>" />
                    <p class="description">Bestimmt den Abstand der Blitze von der Mitte des Bildschirms. Werte zwischen 0,1 und 0,5 sind empfehlenswert.</p>
                </td>
                </tr>
                
                <tr valign="top">
                <th scope="row">Menge der Blitze</th>
                <td>
                    <input type="number" name="lightning_amount" value="<?php echo esc_attr(get_option('lightning_amount', 2)); ?>" />
                    <p class="description">Gibt die Anzahl der gleichzeitig erscheinenden Blitze an. Werte zwischen 1 und 5 sind empfehlenswert.</p>
                </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function lightning_border_register_settings() {
    register_setting('lightning_border_settings_group', 'lightning_color');
    register_setting('lightning_border_settings_group', 'lightning_frequency');
    register_setting('lightning_border_settings_group', 'lightning_offset');
    register_setting('lightning_border_settings_group', 'lightning_amount');
}
add_action('admin_init', 'lightning_border_register_settings');
?>
